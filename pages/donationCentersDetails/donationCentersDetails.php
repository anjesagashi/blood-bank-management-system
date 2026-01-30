<?php
include "../../config.php";
include "../../crud/user/userLogic.php";

$db = new Database();
$user = new User($db->getConnection());
$centerId = isset($_GET['id']) ? $_GET['id'] : null;
$center = null;

if ($centerId) {
    $center = $user->getCenterById($centerId);
}
if (!$center) {
    header("Location: ../donationCenters/donationCenters.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Doha Medical Emergency</title>

    <link rel="icon" type="image/x-icon" href="../../images/lifeFlow.png" />
    <link rel="stylesheet" href="../../components/globalCSS/globalCSS.css" />
    <link rel="stylesheet" href="donationCentersDetails.css" />

    <link rel="stylesheet" href="../../components/header/header.css" />
    <link rel="stylesheet" href="../../components/footer/footer.css" />

    <script src="../../components/header/header.js"></script>
    <script src="../../components/footer/footer.js"></script>
  </head>
  <body>
   <section class="centerDetailsSection">
  <custom-header></custom-header>
  <div class="centerDetailsContainer">
    <img
      src="<?php echo !empty($center['img_src']) ? $center['img_src'] : '../../images/donationCenters/default.jpg'; ?>"
      alt="<?php echo $center['center_name']; ?>"
      class="centerImage"
    />

    <div class="centerDetailsContent">
      <h1><?php echo $center['center_name']; ?></h1>

      <div class="infoRow">
        <img src="../../images/svg/pin_drop.svg" alt="location" />
        <p><?php echo $center['city']; ?></p>
      </div>

      <div class="infoRow">
        <img src="../../images/svg/clock.svg" alt="hours" />
        <p>Monday – Friday: 08:00 – 16:00</p>
      </div>

      <div class="infoRow">
        <img src="../../images/svg/callPhone.svg" alt="phone" />
        <p><?php echo $center['phone_number']; ?></p>
      </div>

      <p class="description">
        <?php echo !empty($center['description']) ? $center['description'] : 'No description available for this center.'; ?>
      </p>

      <a href="../donationForm/donationForm.php?center_id=<?php echo $center['id']; ?>" class="donateBtn">
        Donate Blood
      </a>
    </div>
  </div>
</section>

<div class="mapWrapper">
  <p class="mapHint">Click on the map to open directions</p>
  <iframe
    src="<?php echo $center['map_link']; ?>"
    class="locationMap"
    allowfullscreen=""
    loading="lazy"
    referrerpolicy="no-referrer-when-downgrade"
  ></iframe>
</div>
    <custom-footer></custom-footer>
  </body>
</html>
