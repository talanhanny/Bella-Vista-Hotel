
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking | Modern Kubo</title>
    <link rel="stylesheet" href="Design.css">
</head>
<body>

<?php include __DIR__ . '/navbar.php'; ?>
<section class="form-section">

    <h1>Hotel Reservation</h1>
    <p>Complete the information below to reserve your stay.</p>

    <form action="booking_process.php" method="POST">

        <h3>Stay Information</h3>

        <label>Check-in Date</label>
        <input type="date" name="check_in" id="check_in" required>

        <label>Check-out Date</label>
        <input type="date" name="check_out" id="check_out" required>

        <label>Number of Guests</label>
        <input type="number" name="guests" min="1" max="20" required>

        <h3>Guest Information</h3>

        <label>Full Name</label>
        <input type="text" name="fullname" required>

        <label>Email Address</label>
        <input type="email" name="email" required>

        <label>Contact Number</label>
        <input type="tel" name="contact" required>

        <h3>Room Selection</h3>

        <label>Select Room</label>

        <select name="room_id" required>
            <option value="">Choose a Room</option>
            <option value="1">Standard Room</option>
            <option value="2">Deluxe Room</option>
            <option value="3">Family Room</option>
        </select>

        <h3>Membership</h3>

        <label>
            <input type="checkbox" name="is_member" value="1">
            I am a registered member.
        </label>

        <h3>Policies and Rules</h3>

        <label>
            <input type="checkbox" name="agree" value="1" required>
            I agree to the hotel's policies and rules.
        </label>

        <button type="submit" class="btn">
            Continue Reservation
        </button>

    </form>

</section>

<footer>
    <p>&copy; 2026 Modern Kubo Hotel.</p>
</footer>

<script src="JavaScriptt.js"></script>

</body>
</html>
