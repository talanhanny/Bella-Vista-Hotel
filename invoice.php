<?php
session_start();

$booking = $_SESSION['booking'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Invoice | Modern Kubo</title>
    <link rel="stylesheet" href="Design.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<section class="invoice">

    <h1>Modern Kubo</h1>
    <h2>Hotel Booking Receipt</h2>

    <?php if ($booking): ?>

        <p><strong>Reservation No:</strong>
            <?php echo htmlspecialchars($booking['reservation_id']); ?>
        </p>

        <p><strong>Guest Name:</strong>
            <?php echo htmlspecialchars($booking['fullname']); ?>
        </p>

        <p><strong>Email:</strong>
            <?php echo htmlspecialchars($booking['email']); ?>
        </p>

        <p><strong>Room:</strong>
            <?php echo htmlspecialchars($booking['room_name']); ?>
        </p>

        <p><strong>Check-in:</strong>
            <?php echo htmlspecialchars($booking['check_in']); ?>
        </p>

        <p><strong>Check-out:</strong>
            <?php echo htmlspecialchars($booking['check_out']); ?>
        </p>

        <p><strong>Guests:</strong>
            <?php echo htmlspecialchars($booking['guests']); ?>
        </p>

        <hr>

        <h3>Reservation Payment Declaration</h3>

        <p>
            This document confirms that your reservation
            information has been recorded.
        </p>

        <p><strong>Payment Status:</strong>
            Pending payment verification
        </p>

        <p><strong>Amount:</strong>
            <?php echo number_format($booking['total_amount'], 2); ?>
        </p>

        <button class="btn" onclick="window.print()">
            Print Receipt
        </button>

    <?php else: ?>

        <p>No booking information found.</p>

        <a href="booking.php" class="btn">Book a Room</a>

    <?php endif; ?>

    <a href="Homepage.php" class="btn">
        Back to Homepage
    </a>

</section>

<script src="JavaScriptt.js"></script>

</body>
</html>
