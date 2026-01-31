<style>
    <?php include "assets/css/profile.css" ?>
</style>

<?php
include_once "../config.php";
include_once "../crud/user/userLogic.php";

$db = new Database();
$user = new User($db->getConnection());

$centerId = $_SESSION['user_id'];

$centerData = $user->getCenterById($centerId);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editCenterProfile'])) {
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $centerName = trim($_POST['center_name']);
    $city = trim($_POST['city']);
    $phone = trim($_POST['phone_number']);
    $description = trim($_POST['description']);
    $mapLink = trim($_POST['map_link']);
    $newPass = $_POST['password'];

    if ($user->updateCenterProfile($centerId, $username, $email, $centerName, $city, $phone, $description, $mapLink, $newPass)) {
        echo "<p style='color:green; text-align:center;'>Profile updated successfully!</p>";
        $centerData = $user->getCenterById($centerId);
    } else {
        echo "<p style='color:red; text-align:center;'>Something went wrong during update.</p>";
    }
}
?>

<div class="profileWrapper">
    <div class="profileHeader">
        <h2>Blood Center Profile</h2>
        <p>Update your center's information and public details</p>
    </div>

    <div class="profileFormArea">
        <div class="formCard">
            <h3>Account Access</h3>
            <form id="accountInfoForm" action="" method="POST">
                <div class="formGrid">
                    <div class="inputGroup fullWidth">
                        <label>Email Address</label>
                        <input type="email" name="email" value="<?php echo $centerData['email'] ?? ''; ?>" required>
                    </div>
                    <div class="inputGroup fullWidth">
                        <label>Username</label>
                        <input type="text" name="username" value="<?php echo $centerData['username'] ?? ''; ?>" required>
                    </div>
                    <div class="inputGroup fullWidth">
                        <label>New Password (leave blank to keep current)</label>
                        <input type="password" name="password" placeholder="New password">
                    </div>



                    <div class="inputGroup fullWidth">
                        <label>Center Name</label>
                        <input type="text" name="center_name" value="<?php echo $centerData['center_name'] ?? ''; ?>" required>
                    </div>
                    <div class="inputGroup fullWidth">
                        <label>City</label>
                        <input type="text" name="city" value="<?php echo $centerData['city'] ?? ''; ?>" required>
                    </div>
                    <div class="inputGroup fullWidth">
                        <label>Phone Number</label>
                        <input type="text" name="phone_number" value="<?php echo $centerData['phone_number'] ?? ''; ?>">
                    </div>
                    <div class="inputGroup fullWidth">
                        <label>Google Maps Link</label>
                        <input type="text" name="map_link" value="<?php echo $centerData['map_link'] ?? ''; ?>">
                    </div>
                    <div class="inputGroup fullWidth">
                        <label>Description</label>
                        <textarea name="description" rows="4" style="width: 100%; border: 1px solid #ddd; border-radius: 4px; padding: 10px;"><?php echo $centerData['description'] ?? ''; ?></textarea>
                    </div>
                </div>

                <button type="submit" name="editCenterProfile" class="btnUpdate">Save Center Changes</button>
            </form>
        </div>
    </div>
</div>