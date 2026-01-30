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
    <title>Page Not Found</title>
    <link rel="icon" type="image/x-icon" href="../../images/lifeFlow.png" />
    <link rel="stylesheet" href="../../components/globalCSS/globalCSS.css" />
    <link rel="stylesheet" href="../../pages/pageNotFound/pageNotFound.css" />
    <link rel="stylesheet" href="../../components/header/header.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="../../components/footer/footer.css" />
    <script src="../../components/footer/footer.js?v=1.1"></script>
  </head>
  <body>
    <section class="notFoundSection">
       <?php include "../../components/header/header.php";?>
      <div class="notFoundContent">
        <h1 class="notFoundHeading">404 Not Found</h1>
        <p>You visited page not found. You may go to home page.</p>

        <a href="../../pages/homePage/homePage.php" class="backToHomeButton"
          >Back to home page</a
        >
      </div>
    </section>
    <custom-footer></custom-footer>
  </body>
</html>
