<style>
    <?php include "assets/css/users.css"; ?>
</style>

<?php
include "../config.php";
include "../crud/user/userLogic.php";
 $db = new Database();
 $user = new User($db->getConnection());
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

    $username   = $_POST['username'];
    $email      = $_POST['user_email'];
    $password   = $_POST['password'];
    $role_id    = $_POST['role_id'];
    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $birthdate  = $_POST['birthdate'];
    $blood_id   = $_POST['blood_group_id'];

    if ($user->registerDonors($username, $email, $password, $role_id, $first_name, $last_name, $birthdate, $blood_id)) {
        header("Location: index.php?page=donors");
        exit();
    } else {
        echo "Diçka shkoi keq!";
    }
}

$editDonorData = null;

if (isset($_GET['edit_id'])) {
    $id = $_GET['edit_id'];
    $editDonorData = $user->getDonorById($id);
    if (!$editDonorData) {
        echo "Donori nuk u gjet!";
        exit;
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_user'])) {
    $id        = $_POST['id']; 
    $fName     = $_POST['first_name'];
    $lName     = $_POST['last_name'];
    $email     = $_POST['email'];
    $birthdate = $_POST['birthdate'];
    $blood_id  = $_POST['blood_group_id'];
    if ($user->editDonor($id, $fName, $lName, $email, $birthdate, $blood_id)) {
       header("Location: index.php?page=donors");
    }
}

if (isset($_GET['delete_id'])) {
    $id_to_delete = $_GET['delete_id'];
    
    if ($user->deleteUser($id_to_delete)) {
         header("Location: index.php?page=donors");
        exit();
    } else {
        echo "<script>alert('Fshirja dështoi!');</script>";
    }
}
?>

<div class="userContainer">
    <div class="headerSection">
        <h1>Donors Management</h1>
        <button class="btnAdd" onclick="openUserModal()">Add New Donor +</button>
    </div>

    <div class="statsContainer">
        <div class="statCard">
            <h3>Total Donors</h3>
           
            <p> <?php echo $totalDonors = $user->countTotalDonors()?></p>
        </div>
        
        <div class="statCard">
            <h3>Administrators</h3>
            <p><?php echo $totalAdmins = $user->countTotalAdmins()?></p>
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
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $donors = $user->getAllDonors();

            if ($donors) {
                foreach ($donors as $donor) {
                    ?>
                    <tr>
                        <td><?php echo $donor['id']; ?></td>
                        <td><?php echo $donor['first_name'] . " " . $donor['last_name']; ?></td>
                        <td><?php echo $donor['email']; ?></td>
                        <td><?php echo $donor['birthdate']; ?></td>
                        <td><?php echo $donor['blood_group']; ?></td>
                        <td class="actionsColumn">

                            <button class="btn" onclick="openEditModal(<?php echo $donor['id']; ?>)"><img src="../images/svg/editIcon.svg" alt="Edit"></button> 
                            <button class="btn" onclick="confirmDelete(<?php echo $donor['id']; ?>)"><img src="../images/svg/deleteIcon.svg" alt="Delete"></button>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='6'>Nuk ka të dhëna në databazë.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<!-- ADD DONOR -->
<div id="userModal" class="modal">
    <div class="modalContent">
        <div class="modalHeader">
            <h3 id="modalTitle">Add New Donor</h3>
            <img src="../images/svg/closeIcon.svg" class="closeBtn" onclick="closeUserModal()" alt="Close">
        </div>
        <form id="userForm" action="" method="POST" novalidate>
            <div class="formGrid">
                <input type="hidden" name="role_id" value="2">

                <div class="inputGroup">
                    <label>First Name</label>
                    <input type="text" id="userFirstName" name="first_name" placeholder="First Name" required>
                </div>

                <div class="inputGroup">
                    <label>Last Name</label>
                    <input type="text" id="userLastName" name="last_name" placeholder="Last Name" required>
                </div>

                <div class="inputGroup">
                    <label>Username</label>
                    <input type="text" id="userName" name="username" placeholder="username12" required>
                </div>

                <div class="inputGroup">
                    <label>Email Address</label>
                    <input type="email" id="userEmail" name="user_email" placeholder="user@exmple.com" required>
                </div>

                <div class="inputGroup">
                    <label>Birthdate</label>
                    <input type="date" id="userBirthdate" name="birthdate" required>
                </div>

                <div class="inputGroup">
                    <label>Blood Type</label>
                    <select id="userBloodType" name="blood_group_id" required>
                        <option value="">Select Type</option>
                        <option value="1">A+</option>
                        <option value="2">A-</option>
                        <option value="3">B+</option>
                        <option value="4">B-</option>
                        <option value="5">O+</option>
                        <option value="6">O-</option>
                        <option value="7">AB+</option>
                        <option value="8">AB-</option>
                    </select>
                </div>

                <div class="inputGroup fullWidth">
                    <label>Password</label>
                    <input type="password" id="userPassword" name="password" placeholder="Create a password" required>
                </div>
            </div>

            <div class="modalFooter">
                <button type="button" onclick="closeUserModal()" class="btnCancel">Cancel</button>
                <button type="submit" name="submit" class="btnSave">Add Donor</button>
            </div>
        </form>
    </div>
</div>
<!-- EDIT DONOR -->
<div id="editUserModal" class="modal" style="display: <?php echo isset($_GET['edit_id']) ? 'block' : 'none'; ?>;">
    <div class="modalContent">
        <div class="modalHeader">
            <h3>Edit User Details</h3>
            <img src="../images/svg/closeIcon.svg" class="closeBtn" onclick="closeEditModal()" alt="Close">
        </div>
       <form id="editUserForm" action="" method="POST" novalidate>
       <input type="hidden" name="id" value="<?php echo $editDonorData['id'] ?? ''; ?>">

    <div class="formGrid">
        <div class="inputGroup">
            <label>First Name</label>
            <input type="text" id="editFirstName" name="first_name" value="<?php echo $editDonorData['first_name'] ?? ''; ?>" required>
        </div>

        <div class="inputGroup">
            <label>Last Name</label>
            <input type="text" id="editLastName" name="last_name" value="<?php echo $editDonorData['last_name'] ?? ''; ?>" required>
        </div>

        <div class="inputGroup">
            <label>Email Address</label>
            <input type="email" id="editEmail" name="email" value="<?php echo $editDonorData['email'] ?? ''; ?>" required>
        </div>

        <div class="inputGroup">
            <label>Birthdate</label>
            <input type="date" id="editBirthdate" name="birthdate" value="<?php echo $editDonorData['birthdate'] ?? ''; ?>" required>
        </div>

        <div class="inputGroup">
            <label>Blood Type</label>
            <select id="editBloodType" name="blood_group_id" required>
                <option value="1">A+</option>
                <option value="2">A-</option>
                <option value="3">B+</option>
                <option value="4">B-</option>
                <option value="5">O+</option>
                <option value="6">O-</option>
                <option value="7">AB+</option>
                <option value="8">AB-</option>
            </select>
        </div>

    </div>

    <div class="modalFooter">
        <button type="button" onclick="closeEditModal()" class="btnCancel">Cancel</button>
        <button type="submit" name="update_user" class="btnSave">Update User</button>
    </div>
</form>
    </div>
</div>

<script>
    <?php include "assets/js/users.js"; ?>
</script>