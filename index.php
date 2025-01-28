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
        <title>Document</title>
        <?php include 'source/head.php'; ?>
    </head>
    <body>
        <?php include_once 'source/header.php'; ?>
        <content>
        <div class="content-default">
            <section>
                aighoaehgipo
            </section>
            
            <?php 
                include_once 'php/get_posts.php';
            ?>
        </div>
        </content>
    </body>
</html>