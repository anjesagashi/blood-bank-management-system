<style>
    <?php include "assets/css/profile.css" ?>
</style>
<?php
include_once "../config.php";
include_once "../crud/user/userLogic.php";

$db = new Database();
$user = new User($db->getConnection());

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['createAdmin'])) {
    $username = trim($_POST['new_admin_username']);
    $email    = trim($_POST['new_admin_email']);
    $password = $_POST['new_admin_password'];

    if (!empty($username) && !empty($email) && !empty($password)) {
        $success = $user->createAdmin($username, $email, $password);

        if ($success) {
            echo "<p style='color:green'>Admin created successfuly!</p>";
        } else {
            echo "<p style='color:red'>Something went wrong</p>";
        }
    } else {
        echo "<p style='color:red'>Pleas enter all data needed!</p>";
    }
}
?>



<div class="profileWrapper">
    <div class="profileHeader">
        <h2>Admin Dashboard</h2>
        <p>Manage your account settings and administrative privileges</p>
    </div>

    <div class="profileFormArea">
        <div class="formCard">
            <h3>My Personal Information</h3>
            <form id="personalInfoForm">
                <div class="formGrid ">
                    <div class="inputGroup fullWidth">
                        <label>Email Address</label>
                        <input type="email" name="email" value="admin@example.com">
                    </div>
                     <div class="inputGroup fullWidth">
                        <label>Current Password</label>
                        <input type="password" name="current_pass" placeholder="Enter current password">
                    </div>
                    <div class="inputGroup fullWidth">
                        <label>New Password</label>
                        <input type="password" name="new_pass" placeholder="New Password">
                    </div>
                    <div class="inputGroup fullWidth">
                        <label>Confirm New Password</label>
                        <input type="password" name="confirm_pass" placeholder="Confirm Password">
                    </div>
                </div>
                <button type="submit" class="btnUpdate">Save My Changes</button>
            </form>
        </div>

       

        <div class="formCard createAdminCard">
            <h3>Add New Administrator</h3>
            <p >Create a new account with full administrative access.</p>
            <form id="createNewAdminForm" action="" method="POST" novalidate>
                <div class="formGrid">
                     <div class="inputGroup fullWidth">
                        <label>New Admin Username</label>
                        <input type="text"  name="new_admin_username" placeholder="username123">
                    </div>
                    <div class="inputGroup fullWidth">
                        <label>New Admin Email</label>
                        <input type="email" name="new_admin_email" placeholder="email@example.com">
                    </div>
                    <div class="inputGroup fullWidth">
                        <label>Temporary Password</label>
                        <input type="password" name="new_admin_password" placeholder="Set a password">
                    </div>
                </div>
                <button type="submit" name="createAdmin" class="btnUpdate">Create Admin Account</button>
            </form>
        </div>
       
    </div>
</div>