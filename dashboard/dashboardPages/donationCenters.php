<style>
    .bloodCenterContainer {
        display: flex;
        flex-direction: column;
        gap: 40px;
    }

    .headerContainer {
        display: flex;
        justify-content: space-between;
    }
</style>

<?php
include "../config.php";
include "../crud/user/userLogic.php";
$db = new Database();
$user = new User($db->getConnection());
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_center'])) {

    $role    = $_POST['role_id'];
    $username   = $_POST['username'];
    $email      = $_POST['email'];
    $password   = $_POST['password'];

    $name = $_POST['center_name'];
    $city  = $_POST['city'];
    $phone  = $_POST['phone'];
    $desc   = $_POST['desc'];
    $img   = $_POST['img'];
    $map = $_POST['map'];

    if ($user->registerBloodCenter($username, $email, $password, $role, $name, $city, $phone, $desc, $map, $img)) {
        header("Location: index.php?page=donationCenters");
        exit();
    } else {
        echo "Diçka shkoi keq!";
    }
}

$centerData = null;

if (isset($_GET['edit_id'])) {
    $id = $_GET['edit_id'];
    $centerData = $user->getCenterById($id);
    if (!$centerData) {
        echo "Center not found!";
        exit;
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_center'])) {
    $id       = $_POST['id'];
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $name     = $_POST['center_name'];
    $city     = $_POST['city'];
    $phone    = $_POST['phone'];
    $desc     = $_POST['desc'];
    $map      = $_POST['map'];
    $img      = $_POST['img'];

    if ($user->editCenter($id, $username, $email, $name, $city, $phone, $desc, $map, $img)) {
        header("Location: index.php?page=donationCenters");
        exit();
    } else {
        echo "<script>alert('Something went wrong!');</script>";
    }
}

if (isset($_GET['delete_id'])) {
    $id_to_delete = $_GET['delete_id'];

    if ($user->deleteUser($id_to_delete)) {
        header("Location: index.php?page=donationCenters");
        exit();
    } else {
        echo "<script>alert('Delete failed!');</script>";
    }
}
?>
<div class="bloodCenterContainer">
    <div class="headerContainer">
        <h2>Manage Blood Centers</h2>
        <button class="btnAdd" onclick="openCenterModal()">+ Add New Center</button>
    </div>

    <table class="styledTable">
        <thead>
            <tr>
                <th>Center Name</th>
                <th>Location</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <tbody>
            <?php
            $centers = $user->getAllCenters();
            if ($centers) {
                foreach ($centers as $center) {
            ?>
                    <tr>
                        <td><?php echo $center['center_name']; ?></td>
                        <td><?php echo $center['city']; ?></td>
                        <td><?php echo $center['phone_number']; ?></td>
                        <td class="actionsColumn">
                            <button class="btn" onclick="openEditCenterModal(<?php echo $center['id']; ?>)">
                                <img src="../images/svg/editIcon.svg" alt="Edit">
                            </button>
                            <button class="btn" onclick="confirmDelete(<?php echo $center['id']; ?>)">
                                <img src="../images/svg/deleteIcon.svg" alt="Delete">
                            </button>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='4'>There is no center registered.</td></tr>";
            }
            ?>
        </tbody>

        </tbody>
    </table>
</div>
<!-- Add Center Modal -->
<div id="centerModal" class="modal">
    <div class="modalContent">
        <div class="modalHeader">
            <h3 id="modalTitle">Add New Blood Center</h3>
            <img src="../images/svg/closeIcon.svg" class="closeBtn" onclick="closeCenterModal()" alt="Close Icon">
        </div>
        <form id="centerForm" action="" method="POST" novalidate>
            <div class="formGrid">
                <input type="hidden" name="role_id" value="3">
                <div class="inputGroup">
                    <label>Username</label>
                    <input type="text" name="username" value="username" placeholder="username">
                </div>

                <div class="inputGroup">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="Email Address">
                </div>
                <div class="inputGroup">
                    <label>Center Name</label>
                    <input type="text" id="name" name="center_name" placeholder="Center Name" required>
                </div>
                <div class="inputGroup">
                    <label>Location (City)</label>
                    <input type="text" id="location" name="city" placeholder="City" required>
                </div>
                <div class="inputGroup">
                    <label>Phone Number</label>
                    <input type="text" id="phone" name="phone" placeholder="+383 44 123 456">
                </div>
                <div class="inputGroup">
                    <label>Description (Bio)</label>
                    <textarea id="desc" rows="3" name="desc" placeholder="About Center..."></textarea>
                </div>
                <div class="inputGroup">
                    <label>Google Maps Iframe Link (src only)</label>
                    <input type="text" name="map" placeholder="Attach source from Google Maps">
                </div>
                <div class="inputGroup">
                    <label>Image src (src only)</label>
                    <input type="text" name="img" placeholder="Attach image source">
                </div>
                <div class="inputGroup">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Password">
                </div>
            </div>
            <div class="modalFooter">
                <button type="button" onclick="closeCenterModal()" class="btnCancel">Cancel</button>
                <button type="submit" name="add_center" class="btnSave">Add Center</button>
            </div>
        </form>
    </div>
</div>
<!-- Edit Center Modal -->
<div id="editCenterModal" class="modal" style="display: <?php echo isset($_GET['edit_id']) ? 'block' : 'none'; ?>;">
    <div class="modalContent">
        <div class="modalHeader">
            <h3>Edit Blood Center</h3>
            <img src="../images/svg/closeIcon.svg" class="closeBtn" onclick="closeEditCenterModal()" alt="Close Icon">
        </div>
        <form id="editCenterForm" action="" method="POST" novalidate>
            <div class="formGrid">
                <input type="hidden" name="id" value="<?php echo $centerData['id'] ?? ''; ?>">
                <div class="inputGroup">
                    <label>Username</label>
                    <input type="text" name="username" value="<?php echo $centerData['username'] ?? ''; ?>" placeholder="username">
                </div>

                <div class="inputGroup">
                    <label>Email Address</label>
                    <input type="email" name="email" value="<?php echo $centerData['email'] ?? ''; ?>" placeholder="Email Address">
                </div>
                <div class="inputGroup">
                    <label>Center Name</label>
                    <input type="text" id="name" name="center_name" value="<?php echo $centerData['center_name'] ?? ''; ?>" placeholder="Center Name" required>
                </div>
                <div class="inputGroup">
                    <label>Location (City)</label>
                    <input type="text" id="location" name="city" value="<?php echo $centerData['city'] ?? ''; ?>" placeholder="City" required>
                </div>
                <div class="inputGroup">
                    <label>Phone Number</label>
                    <input type="text" id="phone" name="phone" value="<?php echo $centerData['phone_number'] ?? ''; ?>" placeholder="+383 44 123 456">
                </div>
                <div class="inputGroup">
                    <label>Description (Bio)</label>
                    <textarea id="desc" rows="3" name="desc"><?php echo $centerData['description'] ?? ''; ?></textarea>
                </div>
                <div class="inputGroup">
                    <label>Google Maps Iframe Link (src only)</label>
                    <input type="text" name="map" value="<?php echo $centerData['map_link'] ?? ''; ?>">
                </div>
                <div class="inputGroup">
                    <label>Image src (src only)</label>
                    <input type="text" name="img" value="<?php echo $centerData['img_src'] ?? ''; ?>" placeholder="Attach image source">
                </div>
            </div>
            <div class="modalFooter">
                <button type="button" onclick="closeEditCenterModal()" class="btnCancel">Cancel</button>
                <button type="submit" name="edit_center" class="btnSave">Update Center</button>
            </div>
        </form>
    </div>
</div>
<script>
    <?php
    include "assets/js/donationCenters.js"
    ?>
</script>