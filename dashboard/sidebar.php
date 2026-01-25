<div class="sidebar">
    <div class="sidebarContent">
        <h2>Admin's Dashboard</h2>
        <ul class="sidebarLinks">
            <a href="index.php?page=donors" class="<?php echo ($page == 'donors') ? 'active' : ''; ?>">Donors</a>
             <a href="index.php?page=donationCenters" class="<?php echo ($page == 'donationCenters') ? 'active' : ''; ?>">Donation Centers</a>
            <a href="index.php?page=donations" class="<?php echo ($page == 'donations') ? 'active' : ''; ?>">Donations</a>
            <a href="index.php?page=bloodRequests" class="<?php echo ($page == 'bloodRequests') ? 'active' : ''; ?>">Blood Requests</a>
            <a href="index.php?page=bloodInventory" class="<?php echo ($page == 'bloodInventory') ? 'active' : ''; ?>">Blood Inventory</a>
            <a href="index.php?page=messages" class="<?php echo ($page == 'messages') ? 'active' : ''; ?>">Messages</a>
            <a href="index.php?page=appointments" class="<?php echo ($page == 'appointments') ? 'active' : ''; ?>">Appointments for CENTERS</a>
            <a href="index.php?page=createRequest" class="<?php echo ($page == 'createRequest') ? 'active' : ''; ?>">Create a Request</a>
        </ul>
    </div>

    <a href="index.php?page=profile" class="profileContainer">
        <img src="../images/profilePic.png" class="profilePic" alt="Profile Image">
        <div class="adminInfo">
            <h5>Profile</h5>
            <p>admin@exmple.com</p>
        </div>
       
    </a>
</div>