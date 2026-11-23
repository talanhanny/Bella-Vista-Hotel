<?php
session_start();

$b = $_SESSION['booking'] ?? null;
if (!$b) {
    header("Location: booking.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice | Modern Kubo</title>
    <link rel="stylesheet" href="Design.css">
    <style>
        .invoice-box { max-width:600px; margin:20px auto; background:#fff; border:1px solid #ddd; padding:24px; }
        .invoice-box table { width:100%; border-collapse:collapse; }
        .invoice-box td { padding:8px 4px; border-bottom:1px solid #eee; }
        .invoice-box td:last-child { text-align:right; }
        .total-row td { font-weight:bold; font-size:1.1em; }
        .notice { background:#f7f3ea; border-left:4px solid #8b6b3d; padding:10px 14px; margin-top:16px; }
    </style>
</head>
<body>

<?php include __DIR__ . '/navbar.php'; ?>

<section class="form-section">
    <div class="invoice-box">
        <h1>Reservation Invoice</h1>
        <p>Reservation #<?= (int)$b['reservation_id'] ?></p>

        <table>
            <tr><td>Guest</td><td><?= htmlspecialchars($b['fullname']) ?></td></tr>
            <tr><td>Email</td><td><?= htmlspecialchars($b['email']) ?></td></tr>
            <tr><td>Room</td><td><?= htmlspecialchars($b['room_name']) ?></td></tr>
            <tr><td>Check-in</td><td><?= htmlspecialchars($b['check_in']) ?> (<?= htmlspecialchars($b['check_in_time']) ?>)</td></tr>
            <tr><td>Check-out</td><td><?= htmlspecialchars($b['check_out']) ?> (<?= htmlspecialchars($b['check_out_time']) ?>)</td></tr>
            <tr><td>Nights</td><td><?= (int)$b['nights'] ?></td></tr>
            <tr><td>Guests</td><td><?= (int)$b['guests'] ?></td></tr>
            <tr><td>Extra guest fee</td><td>₱<?= number_format($b['extra_fee'], 2) ?></td></tr>
            <tr class="total-row"><td>Total Amount</td><td>₱<?= number_format($b['total_amount'], 2) ?></td></tr>
            <tr><td>Downpayment (50%)</td><td>₱<?= number_format($b['downpayment'], 2) ?></td></tr>
            <tr><td>Balance upon check-in</td><td>₱<?= number_format($b['balance'], 2) ?></td></tr>
        </table>

        <div class="notice">
            A downpayment is required to confirm your reservation. Cancellations made
            less than 3 days before check-in are strictly non-refundable.
        </div>

        <p style="margin-top:16px;"><a href="Homepage.php" class="btn">Back to Home</a></p>
    </div>
</section>

<footer>
    <p>&copy; 2026 Modern Kubo Hotel.</p>
</footer>

</body>
</html>