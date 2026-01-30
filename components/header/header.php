<?php 

$isLoggedIn = isset($_SESSION['user_id']);
?>
            <header class="headerSection">
      <div class="headerContainer">
        <div class="burgerMenu">
          <img src="../../images/svg/burgerMenu.svg" alt="Burger Menu" />
        </div>
        <div class="logoContainer">
          <h1>LifeFlow</h1>
        </div>

        <nav class="navigationBar">
          <li><a href="../../pages/homePage/homePage.php">Home</a></li>
          <li><a href="../../pages/aboutUsPage/aboutUsPage.php">About Us</a></li>
          <li><a href="../../pages/howItWorksPage/howItWorksPage.php">How it Works</a></li>
          <li><a href="../../pages/contactUs/contactUs.php">Contact</a></li>
        </nav>

        <div class="headerActions">
          <div class="searchContainer">
            <input
              type="text"
              placeholder="Search Center"
              class="searchInput"
            />
            <img
              src="../../images/svg/searchIcon1.svg"
              alt="Search Icon"
              class="searchIcon"
            />
          </div>

          <div class="notificationContainer">
            <img src="../../images/svg/bellIcon.svg" alt="Notifications" class="notificationIcon" />
            <span class="notificationBadge">3</span> 
          </div>
          
          <?php if($isLoggedIn): ?>
          <a href="../../pages/loginPage/logout.php" class="loginButton">
            Logout
          </a>
      <?php else: ?>
          <a href="../../pages/login/loginPage.php" class="loginButton">Login</a>
      <?php endif; ?>
        </div>
      </div>
    </header>
        <script>
  // Presim që faqja të ngarkohet
  document.addEventListener("DOMContentLoaded", () => {
    const burgerMenu = document.querySelector(".burgerMenu");
    const navigationBar = document.querySelector(".navigationBar");
    const headerContainer = document.querySelector(".headerContainer");

    burgerMenu.addEventListener("click", () => {
      if (navigationBar.style.maxHeight && navigationBar.style.maxHeight !== "0px") {
        navigationBar.style.maxHeight = "0";
        headerContainer.style.borderRadius = "25px";
      } else {
        navigationBar.style.maxHeight = navigationBar.scrollHeight + "px";
        headerContainer.style.borderRadius = "25px 25px 0 0";
      }
    });
  });
</script>



