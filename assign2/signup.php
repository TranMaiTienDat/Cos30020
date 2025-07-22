<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Sign Up</h2>
        <form name="signupForm" action="signup.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="profile_name">Profile Name:</label>
            <input type="text" name="profile_name" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" required>

            <input type="submit" value="Register">
            <input type="reset" value="Clear">
        </form>
        <a href="index.php">Home</a>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include 'config.php';

            $email = $_POST["email"];
            $profile_name = $_POST["profile_name"];
            $password = $_POST["password"];
            $confirm_password = $_POST["confirm_password"];

            $isValid = true;
            $errors = [];

            // Check valid email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid email format.";
                $isValid = false;
            }

            //// Check profile_name contains only letters
            if (empty($profile_name) || !preg_match("/^[a-zA-Z]+$/", $profile_name)) {
                $errors[] = "Profile name must contain only letters and cannot be empty.";
                $isValid = false;
            }

            // Check if the password matches and contains letters and numbers
            if ($password !== $confirm_password) {
                $errors[] = "Passwords do not match.";
                $isValid = false;
            } elseif (!preg_match("/^[A-Za-z0-9]+$/", $password)) {
                $errors[] = "Password must contain only letters and numbers.";
                $isValid = false;
            }

            if ($isValid) {
                // Check if email already exists
                $checkEmail = "SELECT * FROM friends WHERE friend_email = '$email'";
                $result = $conn->query($checkEmail);

                if ($result->num_rows == 0) {
                    // Save password in plain text
                    $hashedPassword = $password;
                    $dateStarted = date('Y-m-d');
                    $insert = "INSERT INTO friends (friend_email, password, profile_name, date_started, num_of_friends) 
                               VALUES ('$email', '$hashedPassword', '$profile_name', '$dateStarted', 0)";
                    if ($conn->query($insert) === TRUE) {
                        session_start();
                        $_SESSION["email"] = $email;
                        header("Location: friendadd.php");
                    } else {
                        echo "<p class='error'>Error: " . $conn->error . "</p>";
                    }
                } else {
                    echo "<p class='error'>Email already exists!</p>";
                }
            } else {
                // Show errors if any
                foreach ($errors as $error) {
                    echo "<p class='error'>$error</p>";
                }
            }

            $conn->close();
        }
        ?>
    </div>
</body>
</html>
