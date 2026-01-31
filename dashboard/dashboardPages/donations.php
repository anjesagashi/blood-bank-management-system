<?php
include "../config.php";
include "../crud/donations/donationLogic.php";
$db = new Database();
$donationObj = new Donation($db->getConnection());
$pendingRequests = $donationObj->getPendingAppointments();
$historyRecords = $donationObj->getDonationHistory();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['approve_btn'])) {
    $appointment_id = $_POST['appointment_id'];
    $scheduled_date = $_POST['scheduled_date'];

    if (!empty($appointment_id) && !empty($scheduled_date)) {
        if ($donationObj->approveAppointment($appointment_id, $scheduled_date)) {
            header("Location: index.php?page=donations");
            exit();
        } else {
            header("Location: donations_management.php?error=1");
            exit();
        }
    }
}
?>

<style>
    <?php include "assets/css/donations.css"; ?>
</style>

<div class="donationContainer">
    <div class="pageHeader">
        <h2 class="mainTitle">Blood Donations Management</h2>
    </div>

    <div class="card">
        <div class="cardHeader">
            <h3>New Donation Requests</h3>
            <p>Users have selected their preferred center. Please set the date.</p>
        </div>
        <table class="styledTable">
            <thead>
                <tr>
                    <th>Donor Name</th>
                    <th>Blood Type</th>
                    <th>Requested Center</th>
                    <th>Appointment Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($pendingRequests) > 0): ?>
                    <?php foreach ($pendingRequests as $request): ?>
                        <tr>
                            <td><strong><?php echo $request['first_name'] . " " . $request['last_name']; ?></strong></td>
                            <td><span class="bloodBadge"><?php echo $request['group_name']; ?></span></td>
                            <td><?php echo $request['center_name']; ?></td>
                            <form method="POST" action="">
                                <td>
                                    <input type="hidden" name="appointment_id" value="<?php echo $request['id']; ?>">
                                    <input type="date" name="scheduled_date" class="inputField" required>
                                </td>
                                <td>
                                    <button type="submit" name="approve_btn" class="btn confirm">Approve & Schedule</button>
                                </td>
                            </form>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align:center;">No pending requests found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="card" style="margin-top: 30px;">
        <div class="cardHeader">
            <h3>Donation History</h3>
        </div>
        <table class="styledTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Donor Name</th>
                    <th>Center</th>
                    <th>Scheduled Date</th>
                    <th>Amount (ml)</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($historyRecords) > 0): ?>
                    <?php foreach ($historyRecords as $record): ?>
                        <tr>
                            <td>#<?php echo $record['id']; ?></td>
                            <td><?php echo $record['first_name'] . " " . $record['last_name']; ?></td>
                            <td><?php echo $record['center_name']; ?></td>
                            <td><?php echo $record['scheduled_date']; ?></td>
                            <td><?php echo $record['amount_ml']; ?> ml</td>
                            <td>
                                <span class="statusBadge <?php echo strtolower($record['status_name']); ?>">
                                    <?php echo $record['status_name']; ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align:center;">No history records found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>