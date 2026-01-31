<?php
session_start();
include_once "../../config.php";
include_once "../../crud/donations/donationLogic.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../pages/loginPage/loginPage.php");
    exit();
}

$db = new Database();
$donationObj = new Donation($db->getConnection());
$myAppointments = $donationObj->getMyAppointments($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LifeFlow - My Appointments</title>
    <link rel="stylesheet" href="../../components/globalCSS/globalCSS.css" />
    <link rel="stylesheet" href="../../components/header/header.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="../../components/footer/footer.css" />
    <link rel="stylesheet" href="../../dashboard/styledTables.css">
    <link rel="stylesheet" href="myAppointments.css">

    <script src="../../components/footer/footer.js?v=1.1"></script>
</head>

<body>
    <section class="appointmentsSection">
        <?php include "../../components/header/header.php"; ?>

        <div class="appointmentsPage">
            <h2>My Donation Appointments</h2>
            <p>Track the status of your blood donation requests below.</p>

            <table class="styledTable">
                <thead>
                    <tr>
                        <th>Center</th>
                        <th>City</th>
                        <th>Amount (ml)</th>
                        <th>Scheduled Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($myAppointments)): ?>
                        <?php foreach ($myAppointments as $app): ?>
                            <tr>
                                <td><strong><?php echo $app['center_name']; ?></strong></td>
                                <td><?php echo $app['city']; ?></td>
                                <td><?php echo $app['amount_ml']; ?> ml</td>
                                <td>
                                    <?php
                                    echo ($app['scheduled_date'])
                                        ? date('d-m-Y', strtotime($app['scheduled_date']))
                                        : '<i>Not set yet</i>';
                                    ?>
                                </td>
                                <td>
                                    <span class="statusBadge <?php echo strtolower($app['status_name']); ?>">
                                        <?php echo $app['status_name']; ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 30px;">
                                You haven't made any donation appointments yet.
                                <a href="../donateNow/donateNowPage.php" style="color: var(--main-color);">Donate now?</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>

    <custom-footer></custom-footer>
</body>

</html>