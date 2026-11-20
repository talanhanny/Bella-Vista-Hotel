<?php

session_start();


// Only accept POST requests
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: register.php");
    exit();
}

// Get form data
$fullname = trim($_POST['fullname'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$confirm = $_POST['confirm_password'] ?? '';

// Validate information
if (
    empty($fullname) ||
    !filter_var($email, FILTER_VALIDATE_EMAIL) ||
    strlen($password) < 8 ||
    $password !== $confirm
) {
    die("Invalid information. Please check your registration form.");
}

// Check if email already exists
$stmt = $conn->prepare(
    "SELECT user_id FROM users WHERE email = ?"
);

$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    die("Email already registered. Please use another email.");
}

$stmt->close();

// Hash password
$hashedPassword = password_hash(
    $password,
    PASSWORD_DEFAULT
);

// Insert new account
$stmt = $conn->prepare(
    "INSERT INTO users 
    (fullname, email, password, user_type)
    VALUES (?, ?, ?, 'member')"
);

$stmt->bind_param(
    "sss",
    $fullname,
    $email,
    $hashedPassword
);

// Execute query
if ($stmt->execute()) {

    $stmt->close();
    $conn->close();

    header("Location: login.php?registered=success");
    exit();

} else {

    die("Registration failed: " . $stmt->error);

}

?>
