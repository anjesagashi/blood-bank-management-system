<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../pages/loginPage/loginPage.php"); 
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LifeFlow - How It Works</title>
    <link rel="stylesheet" href="howItWorksPage.css" />
    <link rel="stylesheet" href="../../components/globalCSS/globalCSS.css" />
    <link rel="stylesheet" href="../../components/header/header.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="../../components/footer/footer.css" />
    <script src="../../components/footer/footer.js?v=1.1"></script>
  </head>
  <body>
    <section class="heroSection">
       <?php include "../../components/header/header.php";?>
      <img
        src="../../images/howItWorks/blood1.jpg"
        alt="Bg Image"
        class="bgImage"
      />
      <div class="heroContent">
        <div class="heroText">
          <h1>Why Blood Donation Matters.</h1>
          <p>
            It doesn’t have to be complicated. Learn the simple steps to help
            save lives.
          </p>
        </div>
      </div>
    </section>

    <section class="reasonsSection">
      <h2>3 Reasons to Donate With Us</h2>

      <div class="reasonsContainer">
        <div class="reasonCard">
          <span class="icon">💉</span>
          <h3>Full Transparency</h3>
          <p>See where your donation goes and how it helps people in need.</p>
        </div>

        <div class="reasonCard">
          <span class="icon">🩸</span>
          <h3>Maximum Safety</h3>
          <p>We follow strict medical standards using sterile equipment.</p>
        </div>

        <div class="reasonCard">
          <span class="icon">❤️</span>
          <h3>24/7 Support</h3>
          <p>
            Our team is available to assist you before, during, and after
            donation.
          </p>
        </div>
      </div>
    </section>

    <section class="stepsSection">
      <h2>Follow These 3 Simple Steps</h2>

      <div class="stepsContainer">
        <div class="stepItem">
          <div class="stepNumber">1</div>
          <div class="stepText">
            <h3>Register & Check Eligibility</h3>
            <p>Make sure you meet the basic requirements for donating blood.</p>
          </div>
        </div>

        <div class="stepItem">
          <div class="stepNumber">2</div>
          <div class="stepText">
            <h3>Book an Appointment and Visit the Center</h3>
            <p>
              Book an appointment online, show up on time, and donate blood
              under supervision.
            </p>
          </div>
        </div>

        <div class="stepItem">
          <div class="stepNumber">3</div>
          <div class="stepText">
            <h3>Save Lives</h3>
            <p>
              After donating, relax, have a refreshing drink, and feel your
              impact.
            </p>
          </div>
        </div>
      </div>

      <div class="info">
        <div class="infoText">
          <h3>Choose the Right Time for You</h3>
          
        </div>

        
      </div>
    </section>
    <custom-footer></custom-footer>
  </body>
</html>
