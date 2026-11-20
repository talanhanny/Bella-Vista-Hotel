
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bella Vista| Home</title>
    <link rel="stylesheet" href="Design.css">
</head>
<body>


<header class="navbar">

    <div class="logo">
        Bella Vista
    </div>

    <nav class="nav-links">

        <a href="Homepage.php">Home</a>

        <a href="aboutus.php">About Us</a>

        <a href="history.php">History</a>

        <a href="hotel_gallery.php">Hotel Gallery</a>

        <a href="rooms.php">Rooms & Amenities</a>

    </nav>

    <a href="login.php" class="profile-icon">
        <span></span>
    </a>

</header>

<section class="hero">
    <div class="hero-content">
        <h1>Welcome to Bella Vista</h1>

        <p>
            Experience Filipino Hospitality
            in a Modern and Natural Environment.
        </p>

        <a href="booking.php" class="btn">
            Book Your Stay
        </a>
    </div>
</section>

<section class="section">
    <h2>Discover Bella Vista</h2>

    <p>
        Bella Vista combines traditional Filipino
        hospitality with modern comfort and relaxation.
        Enjoy a peaceful and memorable stay with us.
    </p>

    <a href="aboutus.php" class="btn">
        Learn More
    </a>
</section>

<section class="section features">
    <h2>Our Services</h2>

    <div class="card-container">

        <div class="card">
            <h3>Comfortable Rooms</h3>
            <p>Enjoy relaxing and comfortable accommodations.</p>
        </div>

        <div class="card">
            <h3>Modern Amenities</h3>
            <p>Experience convenient hotel facilities.</p>
        </div>

        <div class="card">
            <h3>Easy Reservation</h3>
            <p>Book your stay through our online system.</p>
        </div>

    </div>
</section>

<footer>
    <p>&copy; 2026 Bella Vista Hotel. All Rights Reserved.</p>
</footer>

<script src="JavaScriptt.js"></script>


<!-- BELLA VISTA BACKGROUND MUSIC -->
 
<audio id="backgroundMusic" loop preload="auto">
    <source src="/modern-kubo-fixed/bella_vista_bgm.mp3" type="audio/mpeg">
</audio>

<button id="musicButton" class="music-toggle" 
        aria-label="Play background music" 
        title="Play Music">
    <span id="musicIcon">♫</span>
</button>



</body>
</html>
