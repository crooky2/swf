<header class="main-header">
    <div class="logo">
        <a href="index.php">SWF</a>
    </div>
    <nav class="navigation">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="">Explore</a></li>
            <li><a href="">Services</a></li>
            

            <?php
                if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] === false) {
                    echo '<li><a href="profile.php">Login</a></li>';
                } else {
                    echo '<li><a href="profile.php">Profile</a></li>';
                }
            ?>
        </ul>
    </nav>
</header>