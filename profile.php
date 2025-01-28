<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile Page</title>
        <?php include 'source/head.php'; ?>

        <link rel="stylesheet" href="css/profile.css">
    </head>
    <body>
        <?php include_once 'source/header.php'; ?>

        <content>
            <?php
                if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] === false) {
                    include_once 'source/profile_login.php';
                } else {
                    include_once 'source/profile_normal.php';
                }
            ?>
        </content>
    </body>
</html>
