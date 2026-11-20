<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
   

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register | Bella Vista</title>

    <link rel="stylesheet" href="Design.css">
</head>
<body>

<section class="form-section">

    <h1>Become a Member!</h1>

    <p>
        Register today and enjoy exclusive
        hotel promotions and discounts.
    </p>

    <form action="register_process.php" method="POST">

        <label>Full Name</label>
        <input type="text" name="fullname" required>

        <label>Email Address</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password"
               minlength="8" required>

        <label>Confirm Password</label>
        <input type="password" name="confirm_password"
               minlength="8" required>

        <button type="submit" class="btn">
            Create Account
        </button>

    </form>

    <p>Already have an account?</p>

    <a href="login.php">Login Here</a>

    <p>
        <a href="Homepage.php">Back to Homepage</a>
    </p>

</section>

</body>
</html>
