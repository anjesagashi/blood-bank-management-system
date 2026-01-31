<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../pages/loginPage/loginPage.php"); 
    exit();
}

include_once "../../config.php";
include_once "../../crud/messages/messagesLogic.php";

$db = new Database();
$messageObj = new Message($db->getConnection());

// Marrim ID-në e përdoruesit të loguar nga Session
$userId = $_SESSION['user_id'];

// Krijojmë një metodë të re në Logic për të marrë mesazhet e një përdoruesi specifik
// Nëse nuk e ke krijuar ende, përdor getAllMessagesForUser($userId)
$messages = $messageObj->getMessagesByReceiverId($userId); 

$selectedId = $_GET['notif_id'] ?? null;
$currentMsg = null;

if ($selectedId) {
    $currentMsg = $messageObj->getMessageById($selectedId);
    
    if ($currentMsg && $currentMsg['receiver_id'] != $userId) {
        $currentMsg = null;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LifeFlow - Notifications</title>
    <link rel="stylesheet" href="../../dashboard/assets/css/messages.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="../../components/globalCSS/globalCSS.css" />
        <link rel="stylesheet" href="notificationsPage.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="../../components/header/header.css?v=<?php echo time(); ?>" />
     <link rel="stylesheet" href="../../components/footer/footer.css?v=<?php echo time(); ?>" />
     <script src="../../components/footer/footer.js?v=1.1"></script>
</head>
<body>
    

    <section class="notifSection" >
      <?php include "../../components/header/header.php";?>
        <div class="messagesContainer">
            <div class="messagesSidebar">
                <div class="sidebarHeader">
                    <h3>Notifications</h3>
                </div>
                <div class="messageList">
                    <?php if ($messages): foreach($messages as $msg): ?>
                        <div class="messageItem <?= ($selectedId == $msg['id']) ? 'active' : '' ?> <?= ($msg['is_read'] == 0) ? 'unread' : '' ?>" 
                             onclick="window.location.href='notificationsPage.php?notif_id=<?= $msg['id'] ?>'">
                            
                            <div class="msgUserImg">AD</div> <div class="msgPreview">
                                <div class="msgHeader">
                                    <strong>Admin Support</strong>
                                    <span class="msgTime"><?= date('d M, H:i', strtotime($msg['created_at'])) ?></span>
                                </div>
                                <p><?= htmlspecialchars($msg['subject']) ?></p>
                            </div>
                        </div>
                    <?php endforeach; else: ?>
                        <p style="padding: 20px;">No notifications yet.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="messageContent">
                <?php if ($currentMsg): ?>
                    <div class="contentHeader">
                        <div class="userInfo">
                            <div class="msgUserImg">AD</div>
                            <div>
                                <h4>From: Administrator</h4>
                                <small>lifeflow.support@email.com</small>
                                <p style="margin-top: 10px; font-weight: bold;"><?= htmlspecialchars($currentMsg['subject']) ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="msgBody">
                        <p><?= nl2br(htmlspecialchars($currentMsg['message_text'])) ?></p>
                    </div>
                <?php else: ?>
                    <div style="padding: 40px; text-align: center;">
                        <img src="../../images/svg/no-notif.svg" alt="" style="width: 100px; opacity: 0.5;">
                        <h3>Select a notification to read</h3>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <custom-footer></custom-footer>
</body>
</html>