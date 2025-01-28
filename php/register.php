<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

include "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    var_dump($_POST);

    if (isset($_POST["email"], $_POST["password"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Check if user already exists
        $stmt = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
        if ($stmt === false) {
            die($conn->error);
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();
        
        if ($result->num_rows > 0) {
            // login existing user
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['loggedIn'] = true;
                $_SESSION['email'] = $email;
                header("Location: ../profile.php?login=loggedintoexistingaccount&userid=" . $user['id']);
            } else {
                $_SESSION['loggedIn'] = false;
                header("Location: ../profile.php?login=wrongpassword");
            }
        } else {
            // register new user
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO `users`(`email`, `password`) VALUES (?, ?)");
            if ($stmt === false) {
                die($conn->error);
            }
            $stmt->bind_param("ss", $email, $hashed_password);
            $stmt->execute();
            $userId = $stmt->insert_id;
            $stmt->close();

            $_SESSION['loggedIn'] = true;
            $_SESSION['email'] = $email;
            header("Location: ../profile.php?login=registerednewaccount&userid=$userId");
        }

        $conn->close();
    }
}