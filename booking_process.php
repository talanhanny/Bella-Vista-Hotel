<?php
session_start();
include __DIR__ . "/database.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: booking.php");
    exit;
}

// Form data
$fullname = trim($_POST['fullname'] ?? '');
$email    = trim($_POST['email'] ?? '');
$contact  = trim($_POST['contact'] ?? '');
$checkIn  = $_POST['check_in'] ?? '';
$checkOut = $_POST['check_out'] ?? '';
$guests   = filter_var($_POST['guests'] ?? null, FILTER_VALIDATE_INT);
$roomId   = filter_var($_POST['room_id'] ?? null, FILTER_VALIDATE_INT);

if (
    $fullname === '' ||
    !filter_var($email, FILTER_VALIDATE_EMAIL) ||
    $contact === '' ||
    !$guests || $guests < 1 ||
    !$roomId || $roomId < 1 ||
    empty($_POST['agree'])
) {
    die("Please provide valid booking information and accept the Terms and Conditions.");
}

// Dates
$in    = DateTime::createFromFormat('!Y-m-d', $checkIn);
$out   = DateTime::createFromFormat('!Y-m-d', $checkOut);
$today = new DateTime('today');

if (!$in || !$out ||
    $in->format('Y-m-d') !== $checkIn ||
    $out->format('Y-m-d') !== $checkOut ||
    $in < $today || $out <= $in) {
    die("Invalid reservation dates.");
}

// Room
$stmt = $conn->prepare("SELECT * FROM rooms WHERE room_id = ?");
$stmt->bind_param("i", $roomId);
$stmt->execute();
$room = $stmt->get_result()->fetch_assoc();

if (!$room) {
    die("Room not found.");
}
if ($guests > (int)$room['max_capacity']) {
    die("The selected room allows a maximum of {$room['max_capacity']} guests.");
}

// Overlapping reservations
$stmt = $conn->prepare(
    "SELECT reservation_id FROM reservations
     WHERE room_id = ? AND status <> 'Cancelled'
     AND check_in < ? AND check_out > ?"
);
$stmt->bind_param("iss", $roomId, $checkOut, $checkIn);
$stmt->execute();

if ($stmt->get_result()->num_rows > 0) {
    die("Sorry, this room is already reserved for those dates.");
}

// Pricing (always computed on the server)
$nights      = $in->diff($out)->days;
$roomTotal   = $nights * (float)$room['price'];

$extraPeople = ((float)$room['extra_fee'] > 0)
    ? max(0, $guests - (int)$room['extra_after'])
    : 0;
$extraTotal  = $extraPeople * (float)$room['extra_fee'] * $nights;

$totalAmount = $roomTotal + $extraTotal;
$downpayment = round($totalAmount * 0.50, 2);   // change 0.50 if your downpayment % differs
$balance     = $totalAmount - $downpayment;

$userId = $_SESSION['user_id'] ?? null;

// Save reservation
$stmt = $conn->prepare(
    "INSERT INTO reservations
    (user_id, room_id, fullname, email, contact, check_in, check_out,
     guests, total_amount, extra_fee_total, downpayment, balance)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
);
$stmt->bind_param(
    "iisssssidddd",
    $userId, $roomId, $fullname, $email, $contact,
    $checkIn, $checkOut, $guests,
    $totalAmount, $extraTotal, $downpayment, $balance
);

if (!$stmt->execute()) {
    die("Unable to save reservation.");
}

$_SESSION['booking'] = [
    'reservation_id' => $conn->insert_id,
    'fullname'       => $fullname,
    'email'          => $email,
    'room_name'      => $room['room_name'],
    'check_in'       => $checkIn,
    'check_out'      => $checkOut,
    'check_in_time'  => '2:00 PM',
    'check_out_time' => '12:00 NN',
    'guests'         => $guests,
    'nights'         => $nights,
    'extra_fee'      => $extraTotal,
    'total_amount'   => $totalAmount,
    'downpayment'    => $downpayment,
    'balance'        => $balance
];

header("Location: invoice.php");
exit;