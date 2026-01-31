<?php
session_start();

// Kontrolli i sesionit
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../pages/loginPage/loginPage.php"); 
    exit();
}

include "../../config.php";
include "../../crud/donations/donationLogic.php"; 
include "../../crud/user/userLogic.php";

 $db = new Database();
 $userObj = new User($db->getConnection());
$donationObj = new Donation($db->getConnection());

$centers = $userObj->getAllCenters();

$message = "";
$messageClass = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['createDonation'])) {
    $donor_id = $_SESSION['user_id'];
    $center_id = $_POST['center_id'];
    $amount = $_POST['amount_ml'];

    if (!empty($center_id) && !empty($amount)) {
        if ($donationObj->createAppointment($donor_id, $center_id, $amount)) {
            $message = "Application submitted successfully! Status: Pending.";
            $messageClass = "success-msg";
        } else {
            $message = "Error! The application could not be processed. Please try again.";
            $messageClass = "error-msg";
        }
    } else {
        $message = "Please fill in all fields.";
        $messageClass = "error-msg";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LifeFlow - Donate now</title>
    <link rel="stylesheet" href="donateNowPage.css" />
    <link rel="stylesheet" href="../../components/globalCSS/globalCSS.css" />
    <link rel="stylesheet" href="../../components/header/header.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="../../components/footer/footer.css" />
    <style>
        .success-msg { color: #28a745; background: #e8f5e9; padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align: center; }
        .error-msg { color: #dc3545; background: #fdecea; padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align: center; }
    </style>
    <script src="../../components/footer/footer.js?v=1.1"></script>
</head>
<body>

<section class="donateNowSection">
    <?php include "../../components/header/header.php";?>

    <div class="donateContainer">
        <div class="donateHeader">
            <h1>Donate Blood</h1>
            <p>Select your preferred center and donation amount.</p>
        </div>

        <div class="donateCard">
            <?php if (!empty($message)): ?>
                <div class="<?php echo $messageClass; ?>">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <form class="donateForm" method="POST" action="">

                <div class="formGroup">
                    <label for="center_id">Donation Center</label>
                    <select name="center_id" id="center_id" required>
                        <option value="">Select center</option>
                        <?php if ($centers): ?>
                            <?php foreach ($centers as $center): ?>
                                <option value="<?php echo $center['id']; ?>">
                                    <?php echo htmlspecialchars($center['center_name']) . " (" . htmlspecialchars($center['city']) . ")"; ?>
                                </option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="">No centers available</option>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="formGroup">
                    <label for="amount_ml">Donation Amount (ml)</label>
                    <input type="number" name="amount_ml" id="amount_ml" placeholder="e.g. 450" min="350" max="500" required>
                    <small class="hint">Typical donation: 450–500 ml</small>
                </div>

                <button type="submit" name="createDonation" class="btnDonate">
                    Confirm Donation
                </button>

            </form>
        </div>
    </div>
</section>

<custom-footer></custom-footer>
    
</body>
</html>