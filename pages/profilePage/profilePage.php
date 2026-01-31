<?php
session_start();
include_once "../../config.php"; 
include_once "../../crud/user/userLogic.php"; 

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../pages/loginPage/loginPage.php"); 
    exit();
}

$db = new Database();
$userObj = new User($db->getConnection());

$userData = $userObj->getDonorById($_SESSION['user_id']);

if (isset($_POST['update_profile'])) {
    $id = $_SESSION['user_id'];
    $fName = $_POST['first_name'];
    $lName = $_POST['last_name'];
    $email = $_POST['email'];
    $bDate = $_POST['birthdate'];
    $bType = $_POST['blood_group_id'];
    $newPass = $_POST['password']; 

    if ($userObj->editProfile($id, $fName, $lName, $email, $bDate, $bType, $newPass)) {
        header("Location: profilePage.php?success=1");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LifeFlow - Profile</title>
    <link rel="stylesheet" href="profilePage.css" />

    <link rel="stylesheet" href="../../components/globalCSS/globalCSS.css" />
    <link rel="stylesheet" href="../../components/header/header.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="../../components/footer/footer.css" />

    <script src="../../components/footer/footer.js?v=1.1"></script>
  </head>
  <body>
    <section class="profileSection">
      <?php include "../../components/header/header.php";?>

      <div class="profilePage">
        <h2>My Profile</h2>

        <button id="editBtn" class="editBtn">Edit Profile</button>

        <form class="profileForm" action="" method="POST">
          <div class="row">
            <div class="inputBox">
              <label>First Name</label>
              <input type="text" placeholder="First name" name="first_name" value="<?php echo $userData['first_name'] ?? ''; ?>" disabled />
            </div>

            <div class="inputBox">
              <label>Last Name</label>
              <input type="text" placeholder="Last name" name="last_name" value="<?php echo $userData['last_name'] ?? ''; ?>"  disabled />
            </div>
          </div>

          <div class="inputBox">
            <label>Email</label>
            <input type="email" placeholder="email@example.com" name="email" value="<?php echo $userData['email'] ?? ''; ?>" disabled />
          </div>

          <div class="row">

            <div class="inputBox">
              <label>Birthdate</label>
              <input type="date" name="birthdate" value="<?php echo $userData['birthdate'] ?? ''; ?>" disabled />
            </div>
          </div>

          <div class="row">
            <div class="inputBox">
              <label>Blood Group</label>
              <select  name="blood_group_id" value="<?php echo $userData['blood_group_id'] ?? ''; ?>" disabled>
                
                <option value="1">A+</option>
                <option value="2">A-</option>
                <option value="3">B+</option>
                <option value="4">B-</option>
                <option value="5">O+</option>
                <option value="6">O-</option>
                <option value="7">AB+</option>
                <option value="8">AB-</option>
              </select>
            </div>

            <div class="inputBox">
              <label>Password</label>
              <input type="password" placeholder="New password" name="password"  disabled />
            </div>
          </div>

          <div class="actions">
            <button class="saveBtn" name="update_profile" disabled>Save Changes</button>
            <button type="button" id="cancelBtn"  class="cancelBtn" disabled>
              Cancel
            </button>
          </div>
        </form>
      </div>

      <script src="profilePage.js"></script>
    </section>
    <custom-footer></custom-footer>
  </body>
</html>
