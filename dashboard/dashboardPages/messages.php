<style>
    <?php include "assets/css/messages.css" ?>
</style>

<?php

include_once "../config.php";
include_once "../crud/messages/messagesLogic.php";

$db = new Database();
$messageObj = new Message($db->getConnection());

$messages = $messageObj->getAllMessagesForAdmin();

$selectedId = $_GET['message_id'] ?? ($messages[0]['id'] ?? null);
$currentMsg = null;

if ($selectedId) {
    $currentMsg = $messageObj->getMessageById($selectedId);
}

if (isset($_POST['replySubmit'])) {
    $admin_id = $_SESSION['user_id'];
    $receiver_id = $currentMsg['sender_id'];
    $subject = $_POST['subject'];
    $reply_text = $_POST['reply_text'];

    if (!empty($reply_text)) {
        if ($messageObj->sendReply($admin_id, $receiver_id, $subject, $reply_text)) {
            echo "<script>alert('Sent successfuly!'); window.location.href='index.php?page=messages';</script>";
        } else {
            echo "<script>alert('Something went wrong !');</script>";
        }
    } else {
        echo "<script>alert('Please write a message!');</script>";
    }
}

if (isset($_GET['delete_id'])) {
    $idToDelete = $_GET['delete_id'];
    if ($messageObj->deleteMessage($idToDelete)) {

        echo "<script>alert('Message deleted!'); window.location.href='index.php?page=messages';</script>";
    } else {
        echo "<script>alert('Something went wrong!');</script>";
    }
}
?>

<div class="messagesWrapper">
    <div class="messagesContainer">
        <div class="messagesSidebar">
            <div class="sidebarHeader">
                <h3>Inbox</h3>
            </div>
            <div class="messageList">
                <?php if ($messages): foreach ($messages as $msg): ?>
                        <div class="messageItem <?php echo ($selectedId == $msg['id']) ? 'active' : '' ?> <?php echo ($msg['is_read'] == 0) ? 'unread' : '' ?>"
                            onclick="window.location.href='index.php?page=messages&message_id=<?php echo $msg['id'] ?>'">

                            <div class="msgUserImg">
                                <?php echo strtoupper($msg['first_name'][0] . $msg['last_name'][0]) ?>
                            </div>

                            <div class="msgPreview">
                                <div class="msgHeader">
                                    <strong><?php echo $msg['first_name'] . ' ' . $msg['last_name'] ?></strong>
                                    <span class="msgTime"><?php echo date('h:i A', strtotime($msg['created_at'])) ?></span>
                                </div>
                                <p><?php echo $msg['subject'] ?></p>
                            </div>
                        </div>
                    <?php endforeach;
                else: ?>
                    <p style="padding: 20px;">There is no message.</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="messageContent">
            <?php if ($currentMsg): ?>
                <div class="contentHeader">
                    <div class="userInfo">
                        <div class="msgUserImg">
                            <?php echo strtoupper($currentMsg['first_name'][0] . $currentMsg['last_name'][0]) ?>
                        </div>
                        <div>
                            <h4><?php echo $currentMsg['first_name'] . ' ' . $currentMsg['last_name'] ?></h4>
                            <small><?php echo $currentMsg['email'] ?></small>
                            <p style="margin-top: 5px; font-weight: bold;"><?php echo $currentMsg['subject'] ?></p>
                        </div>
                    </div>
                    <div class="contentActions">
                        <button class="btnSave" onclick="openReplyModal()">Reply</button>
                        <button class="btnSave" onclick="confirmDelete(<?php echo $currentMsg['id'] ?>)">Delete</button>
                    </div>
                </div>
                <div class="msgBody">
                    <p><?php echo $currentMsg['message_text'] ?></p>
                </div>
            <?php else: ?>
                <div style="padding: 40px; text-align: center;">
                    <h3>Choose a message to read</h3>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<div id="replyModal" class="modal">
    <div class="modalContent">
        <div class="modalHeader">
            <h3>Reply to: <?php echo $currentMsg['first_name'] ?? '' ?></h3>
            <img src="../images/svg/closeIcon.svg" class="closeBtn" onclick="closeReplyModal()" alt="Close">
        </div>
        <form action="" method="POST">
            <div class="formGrid">
                <input type="hidden" name="receiver_email" value="<?php echo $currentMsg['email'] ?? '' ?>">

                <div class="inputGroup fullWidth">
                    <label>Subject</label>
                    <input type="text" name="subject" value="Re: <?php echo $currentMsg['subject'] ?? '' ?>">
                </div>

                <div class="inputGroup fullWidth">
                    <label>Message</label>
                    <textarea name="reply_text" rows="6" style="width:100%; border:1px solid #ddd; border-radius:8px; padding:10px;" placeholder="Type the answer..."></textarea>
                </div>
            </div>

            <div class="modalFooter">
                <button type="button" onclick="closeReplyModal()" class="btnCancel">Cancel</button>
                <button type="submit" name="replySubmit" class="btnSave">Send Reply</button>
            </div>
        </form>
    </div>
</div>

<script>
    const replyModal = document.getElementById("replyModal");

    function openReplyModal() {
        replyModal.style.display = "block";
    }

    function closeReplyModal() {
        replyModal.style.display = "none";
    }

    function confirmDelete(id) {
        if (confirm("Are you sure that you want do delete this message?")) {
            window.location.href = "index.php?page=messages&delete_id=" + id;
        }
    }

    window.onclick = function(event) {
        if (event.target == replyModal) {
            closeReplyModal();
        }
    }
</script>