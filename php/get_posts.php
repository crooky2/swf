<?php
include 'db.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare('SELECT * FROM posts');
if ($stmt === false) {
    die("Statement preparation failed: " . $conn->error);
}

$stmt->execute();
$result = $stmt->get_result();

if ($result === false) {
    die("Error retrieving results: " . $stmt->error);
}

$stmt->close();

while ($row = $result->fetch_assoc()) {
    echo "<section>";
    echo $row['text'];
    echo "</section>";
}