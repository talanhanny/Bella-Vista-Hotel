
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Bella Vista </title>
    <link rel="stylesheet" href="Design.css">
</head>
<body>

<section class="form-section">

    <h1>Welcome Back!</h1>
    <p>Login to your Bella Vista account.</p>

    <?php
    if (isset($_GET['registered'])) {
        echo "<p>Your account was created. Please log in.</p>";
    }
    if (isset($_GET['error'])) {
        echo "<p class='error'>Invalid email or password.</p>";
    }
    ?>

    <form action="login_process.php" method="POST">

        <label>Email Address</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit" class="btn">
            Login
        </button>

    </form>

    <p>Don't have an account?</p>

    <a href="register.php">Create an Account</a>

    <p><a href="Homepage.php">Back to Homepage</a></p>

</section>

</body>
</html>
