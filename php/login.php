<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

include "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    var_dump($_POST);

    if (isset($_POST['email'], $_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $conn->prepare('SELECT * FROM `users` WHERE email = ?');
        if ($stmt === false) {
            die($conn->error);
        }
        $stmt->bind_param('s', $email);
        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['loggedIn'] = true;
                $_SESSION['email'] = $email;
                header("Location: ../profile.php?login=success&userid=" . $user['id']);
            } else {
                $_SESSION['loggedIn'] = false;
                header("Location: ../profile.php?login=wrongpassword");
            }
        } else {
            $_SESSION['loggedIn'] = false;
            header("Location: ../profile.php?login=usernotfound");
        }
    }

    $conn->close();
}