<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header class="navbar">

    <h2 class="logo">Bella Vista</h2>

    <nav class="nav-links">
        <a href="Homepage.php">Home</a>
        <a href="aboutus.php">About Us</a>
        <a href="history.php">History</a>
        <a href="hotel_gallery.php">Hotel Gallery</a>
        <a href="rooms.php">Rooms</a>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="user_page.php">My Account</a>
        <?php else: ?>
            <a href="login.php">Login</a>
        <?php endif; ?>
        <a href="booking.php" class="nav-cta">Book now</a>
    </nav>

</header>