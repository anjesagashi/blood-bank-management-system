<style>
    <?php include "assets/css/profile.css" ?>
</style>

<div class="profileWrapper">
    <div class="profileHeader">
        <h2>Admin Dashboard</h2>
        <p>Manage your account settings and administrative privileges</p>
    </div>

    <div class="profileFormArea">
        <div class="formCard">
            <h3>My Personal Information</h3>
            <form id="personalInfoForm">
                <div class="formGrid ">
                    <div class="inputGroup fullWidth">
                        <label>Email Address</label>
                        <input type="email" name="email" value="admin@example.com">
                    </div>
                     <div class="inputGroup fullWidth">
                        <label>Current Password</label>
                        <input type="password" name="current_pass" placeholder="Enter current password">
                    </div>
                    <div class="inputGroup fullWidth">
                        <label>New Password</label>
                        <input type="password" name="new_pass" placeholder="New Password">
                    </div>
                    <div class="inputGroup fullWidth">
                        <label>Confirm New Password</label>
                        <input type="password" name="confirm_pass" placeholder="Confirm Password">
                    </div>
                </div>
                <button type="submit" class="btnUpdate">Save My Changes</button>
            </form>
        </div>

       

        <div class="formCard createAdminCard">
            <h3>Add New Administrator</h3>
            <p >Create a new account with full administrative access.</p>
            <form id="createNewAdminForm">
                <div class="formGrid">
                    <div class="inputGroup fullWidth">
                        <label>New Admin Email</label>
                        <input type="email" placeholder="email@example.com">
                    </div>
                    <div class="inputGroup fullWidth">
                        <label>Temporary Password</label>
                        <input type="password" placeholder="Set a password">
                    </div>
                    <div class="inputGroup fullWidth">
                        <label>Confirm Password</label>
                        <input type="password" placeholder="Repeat password">
                    </div>
                </div>
                <button type="submit" class="btnUpdate">Create Admin Account</button>
            </form>
        </div>
       
    </div>
</div>