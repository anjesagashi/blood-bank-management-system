<?php
include "../../config.php"; 
include "../../crud/user/userLogic.php";

$db = new Database();
$connection = $db->getConnection();
$user = new User($connection);
 $centers = $user->getAllCenters(); 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Donation Centre</title>
    <link rel="icon" type="image/x-icon" href="../../images/lifeFlow.png" />
    <link
      rel="stylesheet"
      href="../../pages/donationCenters/donationCenters.css"
    />
    <link rel="stylesheet" href="../../components/globalCSS/globalCSS.css" />
    <link rel="stylesheet" href="../../components/header/header.css" />
    <link rel="stylesheet" href="../../components/footer/footer.css" />
    <script src="../../components/header/header.js"></script>
    <script src="../../components/footer/footer.js"></script>
  </head>
  <body>
    <section class="centersSection">
      <custom-header></custom-header>
      <div class="centersIntroContainer">
        <h1>Donation Centers</h1>
        <p>Find trusted medical centers where you can donate blood safely.</p>
      </div>
      <div class="centerCardWrapper">
    <?php
    if ($centers): 
        foreach ($centers as $center): 
            $imagePath = !empty($center['img_src']) ? $center['img_src'] : "../../images/donationCenters/default.jpg";
    ?>
        <div class="card" onclick="goToDetails(<?php echo $center['id']; ?>)">
            <img src="<?php echo $imagePath; ?>" alt="<?php echo $center['center_name']; ?>" />
            <div class="cardContent">
                <h5><?php echo $center['center_name']; ?></h5>
                
                <div class="centerInfo">
                    <img src="../../images/svg/pin_drop.svg" alt="Pin Drop" />
                    <p class="location"><?php echo $center['city']; ?></p>
                </div>

                <div class="centerInfo">
                    <img src="../../images/svg/clock.svg" alt="Clock" />
                    <p class="hours">Mon – Fri: 08:00 – 16:00</p> 
                    </div>

                <a href="../../pages/donationCentersDetails/donationCentersDetails.php?id=<?php echo $center['id']; ?>" 
                   class="cardBtn">View Details</a>
            </div>
        </div>
    <?php 
        endforeach; 
    else: 
    ?>
        <p>Nuk u gjet asnjë qendër donacioni.</p>
    <?php endif; ?>
</div>
    </section>
    <custom-footer></custom-footer>
    <script src="../../pages/donationCenters/donationCenters.js?v=1.1"></script>
  </body>
</html>
