<div class="sidebar">
    <div class="sidebarContent">
        <h2>Admin's Dashboard</h2>
        <ul class="sidebarLinks">
            <a href="index.php?page=users" class="<?php echo ($page == 'users') ? 'active' : ''; ?>">Users</a>
             <a href="index.php?page=centers" class="<?php echo ($page == 'centers') ? 'active' : ''; ?>">Blood Centers</a>
            <a href="index.php?page=donations" class="<?php echo ($page == 'donations') ? 'active' : ''; ?>">Donations</a>
            <a href="index.php?page=bloodRequests" class="<?php echo ($page == 'bloodRequests') ? 'active' : ''; ?>">Blood Requests</a>
            <a href="index.php?page=bloodInventory" class="<?php echo ($page == 'bloodInventory') ? 'active' : ''; ?>">Blood Inventory</a>
            <a href="index.php?page=messages" class="<?php echo ($page == 'messages') ? 'active' : ''; ?>">Messages</a>
        </ul>
    </div>

    <a href="index.php?page=profile" class="profileContainer">
        <img src="../../images/profilePic.png" class="profilePic" alt="Profile Image">
        <div class="adminInfo">
            <h5>Profile</h5>
            <p>admin@exmple.com</p>
        </div>
       
    </a>
</div>