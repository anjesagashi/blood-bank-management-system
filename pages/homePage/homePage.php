<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../pages/loginPage/loginPage.php"); 
    exit();
}
include "../../config.php";
include "../../crud/user/userLogic.php";
 $db = new Database();
 $user = new User($db->getConnection());
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LifeFlow</title>
    <link rel="icon" type="image/x-icon" href="../../images/lifeFlow.png" />
    <link rel="stylesheet" href="homePage.css" />
    <link rel="stylesheet" href="../../components/globalCSS/globalCSS.css" />
    <link rel="stylesheet" href="../../components/header/header.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="../../components/footer/footer.css" />
    <script src="../../components/footer/footer.js?v=1.1"></script>
    <link rel="stylesheet" href="../../components/stats/stats.css" />
    <script src="../../components/stats/stats.js"></script>
  </head>
  <body>
    <section class="hero">
    <?php include "../../components/header/header.php";?>

      <div class="heroBox">
        <div class="heroContent">
          <h1>Save Lives By Donating Blood</h1>
          <p>Join our mission to help people in need</p>
         
          <div class="homeBtns">
            <a href="#" class="primaryBtn">Donate now</a>
  <?php 
    
    if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1): 
    ?>
        <a href="../../dashboard/index.php" class="primaryBtn">Go to Dashboard</a>
    <?php endif; ?>
          </div>
          
          
   
        </div>
        <img src="../../images/lifeFlow.png" class="lifeFlowImg" />
      </div>
    </section>

    <section class="statsSection">
      <custom-stats
        src="../../images/svg/bloodDrop.svg"
        value="<?php echo $totalDonors = $user->countTotalDonors()?>"
        description="Donors"
      ></custom-stats>

      <custom-stats
        src="../../images/svg/vitalSigns.svg"
        value="850"
        description="Lives Saved"
      ></custom-stats>

      <custom-stats
        src="../../images/svg/hospital.svg"
         value="<?php echo $totalDonors = $user->countTotalCenters()?>"
        description="Partner Hospitals"
      ></custom-stats>
    </section>

    <section class="donationGuideSection">
      <h1>About Blood Donation</h1>

      <div class="donationGuideWrapper">
        <div class="donationGuideContainer">
          <img
            src="../../images/svg/person.svg"
            class="donationGuideImg"
            alt="Donation Guide Svg"
          />
          <div class="donationGuideContent">
            <h3>Who can donate</h3>
            <p>Almost anyone who is in good health can donate blood.</p>
          </div>
        </div>

        <div class="donationGuideContainer">
          <img
            src="../../images/svg/heart_plus.svg"
            class="donationGuideImg"
            alt="Donation Guide Svg"
          />
          <div class="donationGuideContent">
            <h3>Why is it important?</h3>
            <p>Donating blood saves lives and improves health.</p>
          </div>
        </div>

        <div class="donationGuideContainer">
          <img
            src="../../images/svg/info.svg"
            class="donationGuideImg"
            alt="Donation Guide Svg"
          />
          <div class="donationGuideContent">
            <h3>How does it work?</h3>
            <ol>
              <li>Register</li>
              <li>Check up</li>
              <li>Donate</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="bloodGroupSection">
      <h1>Blood Groups Facts</h1>
      <div class="sliderBtns">
        <button class="prevBtn">&#10094;</button>
        <button class="nextBtn">&#10095;</button>
      </div>

      <div class="bloodGroupSlider"></div>
    </section>

    <section class="faqSections">
      <h1>FAQ</h1>
      <div class="faqItem">
        <div class="faqQuestion">
          Who can donate blood?
          <span class="arrow">➤</span>
        </div>
        <div class="faqAnswer">
          Anyone in good health, over the age of 18, meeting the standard
          donation requirements.
        </div>
      </div>

      <div class="faqItem">
        <div class="faqQuestion">
          Why should I donate blood?
          <span class="arrow">➤</span>
        </div>
        <div class="faqAnswer">
          Donating blood saves lives and helps hospitals maintain emergency
          blood supplies.
        </div>
      </div>

      <div class="faqItem">
        <div class="faqQuestion">
          Is the donation process safe?
          <span class="arrow">➤</span>
        </div>
        <div class="faqAnswer">
          Yes. All equipment is sterile and used only once. The process is
          supervised by medical professionals.
        </div>
      </div>

      <div class="faqItem">
        <div class="faqQuestion">
          How often can I donate blood?
          <span class="arrow">➤</span>
        </div>
        <div class="faqAnswer">
          Men can donate every 12 weeks, women every 16 weeks. Guidelines vary
          by country.
        </div>
      </div>
    </section>

    <custom-footer></custom-footer>
  </body>

  <script src="../../pages/bloodDetails/bloodGroupArray.js"></script>
  <script src="homePage.js"></script>
</html>
