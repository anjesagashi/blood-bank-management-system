<?php

$role_id = $_SESSION['role_id'] ?? 0; // 1 = admin, 3 = center staff
?>
<div class="sidebar">
    <div class="sidebarContent">
        <h2><?php  if($role_id == 1) echo "Admin's Dashboard"; 
                elseif($role_id == 3) echo "Center Staff Dashboard";  ?></h2>
        <ul class="sidebarLinks">
           <?php if($role_id == 1): ?>
              
                <a href="index.php?page=donors" class="<?php echo ($page == 'donors') ? 'active' : ''; ?>">Donors</a>
                <a href="index.php?page=donationCenters" class="<?php echo ($page == 'donationCenters') ? 'active' : ''; ?>">Donation Centers</a>
                <a href="index.php?page=donations" class="<?php echo ($page == 'donations') ? 'active' : ''; ?>">Donations</a>
                <a href="index.php?page=bloodRequests" class="<?php echo ($page == 'bloodRequests') ? 'active' : ''; ?>">Blood Requests</a>
                <a href="index.php?page=bloodInventory" class="<?php echo ($page == 'bloodInventory') ? 'active' : ''; ?>">Blood Inventory</a>
                <a href="index.php?page=messages" class="<?php echo ($page == 'messages') ? 'active' : ''; ?>">Messages</a>
                <a href="../pages/homePage/homePage.php">Back to HomePage</a>
            <?php elseif($role_id == 3): ?>
                
                <a href="index.php?page=appointments" class="<?php echo ($page == 'appointments') ? 'active' : ''; ?>">Appointments</a>
                <a href="index.php?page=createRequest" class="<?php echo ($page == 'createRequest') ? 'active' : ''; ?>">Create a Request</a>
            <?php endif; ?>
            <a href="../pages/loginPage/logout.php">Logout</a>
        </ul>
    </div>

    <?php if($role_id == 1): ?>
    <a href="index.php?page=adminProfile" class="profileContainer">
        <img src="../images/profilePic.png" class="profilePic" alt="Profile Image">
        <div class="adminInfo">
            <h5>Profile</h5>
            <p><?php echo   $_SESSION['user_email']?></p>
        </div>  
    </a>
     <?php elseif($role_id == 3): ?>
        <a href="index.php?page=centerProfile" class="profileContainer">
        <img src="../images/profilePic.png" class="profilePic" alt="Profile Image">
        <div class="adminInfo">
            <h5>Profile</h5>
            <p><?php echo   $_SESSION['user_email']?></p>
        </div>  
    </a>
    <?php endif; ?>
</div>