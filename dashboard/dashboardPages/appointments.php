<?php

include "../config.php";
include "../crud/donations/donationLogic.php";
$db = new Database();
$donationObj = new Donation($db->getConnection());

$center_id = $_SESSION['user_id']; 
$appointments = $donationObj->getTodaysAppointmentsByCenter($center_id);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_status'])) {
    $donationObj->updateAppointmentStatus($_POST['appointment_id'], $_POST['new_status']);
     header("Location: index.php?page=appointments");
    exit();
}
?>

<style>
    <?php include "assets/css/appointments.css"; ?>
</style>

<div class="appointmentsContainer">
    <div class="headerSection">
        <h1>Today's Appointments</h1>
        <p>Processing donors for: <strong><?php echo date('d-m-Y'); ?></strong></p>
    </div>

    <table class="styledTable">
        <thead>
            <tr>
                <th>Donor Name</th>
                <th>Blood Type</th>
                <th>Mark Process</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($appointments) > 0): ?>
                <?php foreach ($appointments as $app): ?>
                    <tr>
                        <td><strong><?php echo $app['first_name'] . " " . $app['last_name']; ?></strong></td>
                        <td><span class="bloodType"><?php echo $app['group_name']; ?></span></td>
                        <form method="POST">
                            <td>
                                <input type="hidden" name="appointment_id" value="<?php echo $app['id']; ?>">
                               <select name="new_status" class="statusSelect">
    <option value="2" selected>Approved / Awaiting Arrival</option>
    
    <option value="3">Completed</option>
    
    <option value="4">Cancelled</option>
    
    <option value="5">Rejected</option>
</select>
                            </td>
                            <td>
                                <button type="submit" class="btnSave" name="update_status" class="btnUpdate">Update</button>
                            </td>
                        </form>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4" style="text-align:center;">No appointments scheduled for today.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>