<?php

session_start();

// Only logged-in users may see this page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include __DIR__ . "/database.php";

$userId = (int) $_SESSION['user_id'];

// Get the account details
$stmt = $conn->prepare(
    "SELECT fullname, email, user_type FROM users WHERE user_id = ?"
);
$stmt->bind_param("i", $userId);
$stmt->execute();

$user = $stmt->get_result()->fetch_assoc();

// The account no longer exists: log the visitor out
if (!$user) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}

// Get this user's reservations
$stmt = $conn->prepare(
    "SELECT r.reservation_id, rm.room_name, r.check_in, r.check_out,
            r.guests, r.total_amount, r.status
     FROM reservations r
     JOIN rooms rm ON rm.room_id = r.room_id
     WHERE r.user_id = ?
     ORDER BY r.check_in DESC"
);
$stmt->bind_param("i", $userId);
$stmt->execute();

$reservations = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account | Bella Vista</title>
    <link rel="stylesheet" href="Design.css">
</head>
<body>

<?php include __DIR__ . '/navbar.php'; ?>

<section class="account">

    <h1>Welcome, <?php echo htmlspecialchars($user['fullname']); ?>!</h1>

    <div class="account-box">
        <h2>Your Details</h2>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($user['fullname']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>Account type:</strong> <?php echo htmlspecialchars(ucfirst($user['user_type'])); ?></p>
    </div>

    <div class="account-box">
        <h2>Your Reservations</h2>

        <?php if ($reservations->num_rows === 0): ?>

            <p>You have no reservations yet.</p>

        <?php else: ?>

            <div class="table-wrap">
            <table class="booking-table">
                <tr>
                    <th>No.</th>
                    <th>Room</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Guests</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>

                <?php while ($row = $reservations->fetch_assoc()): ?>
                <tr>
                    <td><?php echo (int) $row['reservation_id']; ?></td>
                    <td><?php echo htmlspecialchars($row['room_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['check_in']); ?></td>
                    <td><?php echo htmlspecialchars($row['check_out']); ?></td>
                    <td><?php echo (int) $row['guests']; ?></td>
                    <td>&#8369;<?php echo number_format((float) $row['total_amount'], 2); ?></td>
                    <td><?php echo htmlspecialchars($row['status'] ?? 'Pending'); ?></td>
                </tr>
                <?php endwhile; ?>
            </table>
            </div>

        <?php endif; ?>

    </div>

    <p class="account-links">
        <a class="btn" href="booking.php">Book a Room</a>
        <a class="btn" href="logout.php">Log Out</a>
    </p>

</section>

</body>
</html>
