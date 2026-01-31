<?php
session_start();

if (!isset($_SESSION['role_id'])) {
    header("Location: ../pages/loginPage/loginPage.php");
    exit();
}

$role_id = $_SESSION['role_id'];

if (!isset($_GET['page'])) {
    if ($role_id == 1) {
        header("Location: index.php?page=donors");
        exit();
    } elseif ($role_id == 3) {

        header("Location: index.php?page=appointments");
        exit();
    }
} else {
    $page = $_GET['page'];
}
?>
<!DOCTYPE html>
<html lang="sq">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="icon" type="image/x-icon" href="../images/lifeFlow.png" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styledTables.css">
    <link rel="stylesheet" href="../components/globalCSS/globalCSS.css" />
</head>

<body>

    <div class="container">
        <?php include 'sidebar.php'; ?>

        <div class="content">
            <?php
            if (file_exists("dashboardPages/$page.php")) {
                include "dashboardPages/$page.php";
            } else {
                echo "<h2>Page does not exist!</h2>";
            }
            ?>
        </div>
    </div>

</body>

</html>