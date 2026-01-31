<?php
session_start();
include_once "../../config.php";
include_once "../../crud/user/userLogic.php";

$db = new Database();
$user = new User($db->getConnection());

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {

  $username   = $_POST['username'];
  $email      = $_POST['user_email'];
  $password   = $_POST['password'];
  $role_id    = $_POST['role_id'];
  $first_name = $_POST['first_name'];
  $last_name  = $_POST['last_name'];
  $birthdate  = $_POST['birthdate'];
  $blood_id   = $_POST['blood_group_id'];

  if ($user->registerDonors($username, $email, $password, $role_id, $first_name, $last_name, $birthdate, $blood_id)) {
    header("Location: loginPage.php");
    exit();
  } else {
    echo "Something went wrong!";
  }
}

$loginError = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {

  $username = $_POST['username'];
  $password = $_POST['password'];

  $loggedUser = $user->login($username, $password);

  if ($loggedUser) {
    $_SESSION['user_id'] = $loggedUser['id'];
    $_SESSION['username'] = $loggedUser['username'];
    $_SESSION['first_name'] = $loggedUser['first_name'];
    $_SESSION['user_email'] = $loggedUser['email'];
    $_SESSION['role_id'] = $loggedUser['role_id'];


    if ($loggedUser['role_id'] == 1) {
      header("Location: ../../pages/homePage/homePage.php");
    } elseif ($loggedUser['role_id'] == 3) {
      header("Location: ../../dashboard/index.php");
    } else {
      header("Location: ../../pages/homePage/homePage.php");
    }
    exit();
  } else {
    $loginError = "Username or password are wrong!";
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>LifeFlow - Login</title>
  <link rel="stylesheet" href="loginPage.css?v=<?php echo time(); ?>" />
  <link rel="stylesheet" href="../../components/globalCSS/globalCSS.css" />
</head>

<body>
  <div class="container">
    <div class="formBox login">
      <form id="loginForm" method="POST" action="" novalidate>
        <h1>Login</h1>
        <div class="inputBox">
          <input type="text" id="loginUsername" name="username" placeholder="Username" />
          <img
            src="../../images/svg/user.svg"
            alt="User icon"
            class="iconImg" />
          <span class="errorMessage"></span>
        </div>
        <div class="inputBox">
          <input type="password" id="loginPassword" name="password" placeholder="Password" />
          <img
            src="../../images/svg/lock.svg"
            alt="Lock icon"
            class="iconImg" />
          <span class="errorMessage"></span>
        </div>
        <?php if (!empty($loginError)): ?>
          <div class="loginError" style="color:red; margin-bottom:10px;">
            <?php echo htmlspecialchars($loginError); ?>
          </div>
        <?php endif; ?>
        <button type="submit" name="login" class="btn loginButton">Login</button>
      </form>
    </div>
    <!-- REGISTER -->
    <div class="formBox register">
      <form id="registerForm" action="" method="POST" novalidate>
        <input type="hidden" name="role_id" value="2">
        <h1>Registration</h1>
        <div class="regInputBox">
          <input type="text" id="regUsername" name="username" placeholder="Username" />
          <img
            src="../../images/svg/user.svg"
            alt="User icon"
            class="iconImg" />
          <span class="errorMessage"></span>
        </div>
        <div class="regInputBox">
          <input type="text" id="regFirstname" name="first_name" placeholder="FirstName" />
          <img
            src="../../images/svg/user.svg"
            alt="User icon"
            class="iconImg" />
          <span class="errorMessage"></span>
        </div>
        <div class="regInputBox">
          <input type="text" id="regLastname" name="last_name" placeholder="Lastname" />
          <img
            src="../../images/svg/user.svg"
            alt="User icon"
            class="iconImg" />
          <span class="errorMessage"></span>
        </div>

        <div class="regInputBox">
          <input type="email" id="regEmail" name="user_email" placeholder="Email" />
          <img
            src="../../images/svg/email.svg"
            alt="User icon"
            class="iconImg" />
          <span class="errorMessage"></span>
        </div>
        <div class="regInputBox">
          <input type="date" id="regBirthdate" name="birthdate" class="inputBirthdate" />
          <span class="errorMessage"></span>
        </div>
        <div class="regInputBox">
          <select id="regBlood" name="blood_group_id">
            <option value="" disabled selected>Select Blood Group</option>

            <option value="1">A+</option>
            <option value="2">A-</option>
            <option value="3">B+</option>
            <option value="4">B-</option>
            <option value="5">O+</option>
            <option value="6">O-</option>
            <option value="7">AB+</option>
            <option value="8">AB-</option>
          </select>
          <span class="errorMessage"></span>
        </div>

        <div class="regInputBox">
          <input type="password" id="regPassword" name="password" placeholder="Password" />
          <img
            src="../../images/svg/lock.svg"
            alt="Lock icon"
            class="iconImg" />
          <span class="errorMessage"></span>
        </div>
        <button type="submit" name="register" class="btn">Register</button>
      </form>
    </div>
    <div class="toggleBox">
      <div class="togglePanel toggleLeft">
        <h1>Hello, Welcome</h1>
        <p>Don’t have an account?</p>
        <button class="btn registerBtn">Register</button>
      </div>
      <div class="togglePanel toggleRight">
        <h1>Welcome Back!</h1>
        <p>Already have an account?</p>
        <button class="btn loginBtn">Login</button>
      </div>
    </div>
  </div>

  <script src="loginPage.js?v=1.1"></script>
</body>

</html>