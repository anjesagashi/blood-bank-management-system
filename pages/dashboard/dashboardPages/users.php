<style>
    <?php include "assets/css/users.css"; ?>
</style>
<div class="userContainer">
    <div class="headerSection">
        <h1>Users Management</h1>
        <button class="btnAdd" onclick="openUserModal()">Add New User +</button>
    </div>

    <div class="statsContainer">
        <div class="statCard">
            <h3>Total Users</h3>
            <p>1,240</p>
        </div>
        <div class="statCard">
            <h3>New This Week</h3>
            <p>+12</p>
        </div>
        <div class="statCard">
            <h3>Administrators</h3>
            <p>4</p>
        </div>
    </div>

    <table class="styledTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Birthdate</th>
                <th>Blood Type</th>
                <th>Phone Number</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Filan Fisteku</td>
                <td>filan@email.com</td>
                <td>16/06/2008</td>
                <td>NULL</td>
                <td>+383 44 111 222</td>
                <td class="actionsColumn">
                    <button class="btn" onclick="openEditModal()"><img src="../../images/svg/editIcon.svg" alt="Edit"></button>
                    <button class="btn"><img src="../../images/svg/deleteIcon.svg" alt="Delete"></button>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Filane Fisteku</td>
                <td>filane@email.com</td>
                <td>19/04/2006</td>
                <td>AB</td>
                <td>+383 44 111 222</td>
                <td class="actionsColumn">
                    <button class="btn" onclick="openEditModal()"><img src="../../images/svg/editIcon.svg" alt="Edit"></button>
                    <button class="btn"><img src="../../images/svg/deleteIcon.svg" alt="Delete"></button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Modal for add user -->
 <div id="userModal" class="modal">
    <div class="modalContent">
        <div class="modalHeader">
            <h3 id="modalTitle">Add New User</h3>
            <img src="../../images/svg/closeIcon.svg" class="closeBtn" onclick="closeUserModal()" alt="Close">
        </div>
        <form id="userForm" novalidate>
            <div class="formGrid">
                <div class="inputGroup">
                    <label>First Name</label>
                    <input type="text" id="userFirstName" placeholder="First Name" required>
                </div>

                 <div class="inputGroup">
                    <label>Last Name</label>
                    <input type="text" id="userLastName" placeholder="Last Name" required>
                </div>

                <div class="inputGroup">
                    <label>Email Address</label>
                    <input type="email" id="userEmail" placeholder="user@exmple.com" required>
                </div>

                <div class="inputGroup">
                    <label>Birthdate</label>
                    <input type="date" id="userBirthdate" required>
                </div>

                <div class="inputGroup">
                    <label>Blood Type</label>
                    <select id="userBloodType" required>
                        <option value="">Select Type</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="NULL">Unknown</option>
                    </select>
                </div>

                <div class="inputGroup">
                    <label>System Role</label>
                    <select id="userRole" required>
                        <option value="User">User (Donor)</option>
                        <option value="Admin">Admin</option>
                        <option value="Staff">Staff (Center)</option>
                    </select>
                </div>

                <div class="inputGroup fullWidth">
                    <label>Password</label>
                    <input type="password" id="userPassword" placeholder="Create a password" required>
                </div>
            </div>

            <div class="modalFooter">
                <button type="button" onclick="closeUserModal()" class="btnCancel">Cancel</button>
                <button type="submit" class="btnSave">Add User</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal for editing user -->
 <div id="editUserModal" class="modal">
    <div class="modalContent">
        <div class="modalHeader">
            <h3>Edit User Details</h3>
            <img src="../../images/svg/closeIcon.svg" class="closeBtn" onclick="closeEditModal()" alt="Close">
        </div>
        <form id="editUserForm" novalidate>
            <input type="hidden" id="editUserId">

            <div class="formGrid">
                <div class="inputGroup">
                    <label>First Name</label>
                    <input type="text" id="editFirstName" value="First Name" required>
                </div>

                 <div class="inputGroup">
                    <label>Last Name</label>
                    <input type="text" id="editLastName" value="Last Name" required>
                </div>

                <div class="inputGroup">
                    <label>Email Address</label>
                    <input type="email" id="editEmail" value="user@example.com" required>
                </div>

                <div class="inputGroup">
                    <label>Birthdate</label>
                    <input type="date" id="editBirthdate" value="2006-04-19" required>
                </div>

                <div class="inputGroup">
                    <label>Blood Type</label>
                    <select id="editBloodType" required>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="NULL">Unknown</option>
                    </select>
                </div>

                <div class="inputGroup">
                    <label>System Role</label>
                    <select id="editRole" required>
                        <option value="User">User</option>
                        <option value="Admin">Admin</option>
                        <option value="Staff">Staff</option>
                    </select>
                </div>
            </div>

            <div class="modalFooter">
                <button type="button" onclick="closeEditModal()" class="btnCancel">Cancel</button>
                <button type="submit" class="btnSave">Update User</button>
            </div>
        </form>
    </div>
</div>
<script>
       <?php include "assets/js/users.js"; ?>
   
</script>

