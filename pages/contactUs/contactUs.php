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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sendMessage'])) {
  $subject = trim($_POST['subject']);
  $message = trim($_POST['message']);
  $sender_id = $_SESSION['user_id'];

  if (!empty($subject) && !empty($message)) {
    if ($messageObj->sendMessage($sender_id, $subject, $message)) {
      echo "<script>alert('Message sent!');</script>";
    } else {
      echo "<script>alert('Error sending message');</script>";
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>LifeFlow - Contact Us</title>
  <link rel="icon" type="image/x-icon" href="../../images/lifeFlow.png" />
  <link rel="stylesheet" href="../../pages/contactUs/contactUs.css" />
  <link rel="stylesheet" href="../../components/globalCSS/globalCSS.css" />
  <link rel="stylesheet" href="../../components/header/header.css?v=<?php echo time(); ?>" />
  <link rel="stylesheet" href="../../components/footer/footer.css" />
  <script src="../../components/footer/footer.js?v=1.1"></script>
</head>

<body>
  <section class="contactSection">
    <?php include "../../components/header/header.php"; ?>

    <div class="sectionTitle">
      <h1>Contact Us</h1>
      <p>Contact us and help save lives through blood donation 🩸</p>
    </div>

    <div class="contactContainer">
      <section class="contactInfo">
        <div class="infoCard">
          <img
            src="../../images/svg/phone.svg"
            alt="Phone Icon"
            class="infoCardImg" />
          <div>
            <h3>Phone</h3>
            <p>+383 44 123 456</p>
          </div>
        </div>

        <div class="infoCard">
          <img
            src="../../images/svg/whatsapp.svg"
            alt="WhatsApp Icon"
            class="infoCardImg" />
          <div>
            <h3>WhatsApp</h3>
            <p>+383 49 123 456</p>
          </div>
        </div>

        <div class="infoCard">
          <img
            src="../../images/svg/email.svg"
            alt="Email Icon"
            class="infoCardImg" />
          <div>
            <h3>Email</h3>
            <p>contact@lifeflow.org</p>
          </div>
        </div>

        <div class="infoCard">
          <img
            src="../../images/svg/location.svg"
            alt="Location Icon"
            class="infoCardImg" />
          <div>
            <h3>LifeFlow Staff</h3>
            <p>Podujeve, Kosovo</p>
          </div>
        </div>

        <div class="map">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d34705.240214150006!2d21.160770180309136!3d42.90970397716583!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1354abf83623947d%3A0xbf237766868191c9!2sPodujev%C3%AB%2011000!5e0!3m2!1sen!2s!4v1765748534613!5m2!1sen!2s"
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>
      </section>

      <section class="contactForm">
        <h2>Get In Touch</h2>
        <!-- MESSAGES -->
        <form id="contactForm" method="POST" novalidate>
          <div class="inputGroup">
            <img
              src="../../images/svg/tag.svg"
              alt="Subject Icon"
              class="inputIconImg" />
            <input type="text" id="subject" name="subject" placeholder="Subject" />
          </div>
          <span class="error" id="subjectError"></span>

          <div class="inputGroup">
            <img
              src="../../images/svg/message.svg"
              alt="Message Icon"
              class="inputIconImg" />
            <textarea id="message" name="message" placeholder="Message"></textarea>
          </div>
          <span class="error" id="messageError"></span>

          <button type="submit" name="sendMessage">Send Now</button>
        </form>
      </section>
    </div>
  </section>

  <custom-footer></custom-footer>
  <script src="../../pages/contactUs/contactUs.js?v=<?php echo time(); ?>"></script>
</body>

</html>