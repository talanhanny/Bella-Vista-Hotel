<?php

session_start();

include __DIR__ . "/database.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: booking.php");
    exit;
}

// Get form information

$fullname = trim($_POST['fullname'] ?? '');
$email = trim($_POST['email'] ?? '');
$contact = trim($_POST['contact'] ?? '');

$checkIn = $_POST['check_in'] ?? '';
$checkOut = $_POST['check_out'] ?? '';

$guests = filter_var(
    $_POST['guests'] ?? null,
    FILTER_VALIDATE_INT
);

$roomId = filter_var(
    $_POST['room_id'] ?? null,
    FILTER_VALIDATE_INT
);

// Validate information

if (
    $fullname === '' ||
    !filter_var($email, FILTER_VALIDATE_EMAIL) ||
    $contact === '' ||
    !$guests || $guests < 1 ||
    !$roomId || $roomId < 1 ||
    empty($_POST['agree'])
) {
    die("Please provide valid booking information.");
}

// Validate dates

$in = DateTime::createFromFormat('!Y-m-d', $checkIn);
$out = DateTime::createFromFormat('!Y-m-d', $checkOut);
$today = new DateTime('today');

if (
    !$in || !$out ||
    $in->format('Y-m-d') !== $checkIn ||
    $out->format('Y-m-d') !== $checkOut ||
    $in < $today ||
    $out <= $in
) {
    die("Invalid reservation dates.");
}

// Get selected room

$stmt = $conn->prepare(
    "SELECT * FROM rooms WHERE room_id = ?"
);

$stmt->bind_param("i", $roomId);
$stmt->execute();

$room = $stmt->get_result()->fetch_assoc();

if (!$room) {
    die("Room not found.");
}

if ($guests > $room['capacity']) {
    die("The selected room cannot accommodate that number of guests.");
}

// Check overlapping reservations

$stmt = $conn->prepare(
    "SELECT reservation_id
     FROM reservations
     WHERE room_id = ?
     AND status <> 'Cancelled'
     AND check_in < ?
     AND check_out > ?"
);

$stmt->bind_param(
    "iss",
    $roomId,
    $checkOut,
    $checkIn
);

$stmt->execute();

if ($stmt->get_result()->num_rows > 0) {
    die("Sorry, this room is already reserved for those dates.");
}

// Calculate total amount

$nights = $in->diff($out)->days;

$totalAmount = $nights * $room['price'];

// Get logged-in user if available

$userId = $_SESSION['user_id'] ?? null;

// Save reservation

$stmt = $conn->prepare(
    "INSERT INTO reservations
    (user_id, room_id, fullname, email, contact,
     check_in, check_out, guests, total_amount)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
);

$stmt->bind_param(
    "iisssssid",
    $userId,
    $roomId,
    $fullname,
    $email,
    $contact,
    $checkIn,
    $checkOut,
    $guests,
    $totalAmount
);

if (!$stmt->execute()) {
    die("Unable to save reservation.");
}

$reservationId = $conn->insert_id;

// Store booking information for invoice

$_SESSION['booking'] = [
    'reservation_id' => $reservationId,
    'fullname' => $fullname,
    'email' => $email,
    'room_name' => $room['room_name'],
    'check_in' => $checkIn,
    'check_out' => $checkOut,
    'guests' => $guests,
    'total_amount' => $totalAmount
];

// Redirect to invoice

header("Location: invoice.php");
exit;

?>
