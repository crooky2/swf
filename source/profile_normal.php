<?php
include 'php/db.php';

$userid = $_GET['userid'] ?? null;

$stmt = $conn->prepare('SELECT * FROM users WHERE id = ?');
if ($stmt === false) { die($conn->error); }

$stmt->bind_param('i', $userid);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
?>

<div class="content-default">
    <section class="section-profileActions" style="display: flex; gap: 10px;">
        <form>
            <input type="submit" value="Edit">
        </form>
        <form action="php/logout.php" method="POST">
            <input type="submit" value="Logout">
        </form>
        <form>
            <input type="submit" value="Action 3">
        </form>
    </section>

    <section class="section-profileHeader">
        <img src="https://via.placeholder.com/150" alt="Profile Picture" class="profile-picture">
        <h3>User / <?php echo $user["id"]; ?> /</h3>
        <p><?php echo $user["email"]; ?></p>
        
    </section>
    
    <section class="section-profileDetails">
        <h2>About Me</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae egestas erat. Quisque non ex id lorem vulputate fermentum.</p>
    </section>
</div>