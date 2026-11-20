
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooms & Amenities | Bella Vista</title>
    <link rel="stylesheet" href="Design.css">
    <link rel="stylesheet" href="room.css">
</head>
<body>

<?php include __DIR__ . '/navbar.php'; ?>
<section class="section">
    <h1>Our Rooms</h1>

    <p>Choose the perfect room for your stay.</p>

    <div class="card-container">

        <div class="card">
            <img src="standard.jpg" alt="Standard Room">

            <h3>Standard Room</h3>

            <p>Comfortable room for regular guests.</p>

            <h3>₱1,500 / night</h3>

            <a href="booking.php" class="btn">
                Book Now
            </a>
        </div>

        <div class="card">
            <img src="deluxe.jpg" alt="Deluxe Room">

            <h3>Deluxe Room</h3>

            <p>Enjoy additional comfort and space.</p>

            <h3>₱2,500 / night</h3>

            <a href="booking.php" class="btn">
                Book Now
            </a>
        </div>

        <div class="card">
            <img src="family.jpg" alt="Family Room">

            <h3>Family Room</h3>

            <p>Perfect for families and groups.</p>

            <h3>₱3,500 / night</h3>

            <a href="booking.php" class="btn">
                Book Now
            </a>
        </div>

    </div>
</section>

<section class="section">
    <h2>Hotel Amenities</h2>

    <div class="card-container">
        <div class="card">Free Wi-Fi</div>
        <div class="card">Swimming Pool</div>
        <div class="card">Restaurant</div>
        <div class="card">Parking Area</div>
    </div>
    <p><a href="Homepage.php">Back to Homepage</a></p>

</section>

<footer>
    <p>&copy; 2026 Modern Kubo Hotel.</p>
</footer>

<script src="JavaScriptt.js"></script>
</body>
</html>
