<?php
$page = $_GET['page'] ?? 'users';
?>
<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
     <link rel="icon" type="image/x-icon" href="../../images/lifeFlow.png" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styledTables.css">
    <link rel="stylesheet" href="../../components/globalCSS/globalCSS.css" />
</head>
<body>

<div class="container">
    <?php include 'sidebar.php'; ?>

    <div class="content">
        <?php
        if (file_exists("dashboardPages/$page.php")) {
            include "dashboardPages/$page.php";
        } else {
            echo "<h2>Faqja nuk ekziston</h2>";
        }
        ?>
    </div>
</div>

</body>
</html>
