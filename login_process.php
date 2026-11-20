<?php

session_start();

include __DIR__ . "/database.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: login.php");
    exit;
}

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

$stmt = $conn->prepare(
    "SELECT * FROM users WHERE email = ?"
);

$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 1) {

    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {

        session_regenerate_id(true);

        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['fullname'] = $user['fullname'];
        $_SESSION['user_type'] = $user['user_type'];

        header("Location: user_page.php");
        exit;
    }
}

header("Location: login.php?error=1");
exit;

?>
