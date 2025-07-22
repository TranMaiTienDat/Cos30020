<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2> My Friend System Log In Page</h2>
        <form action="login.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <input type="submit" value="Log In">
            <input type="reset" value="Clear">

        </form>
        <a href="index.php">Home</a>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include 'config.php';

            $email = $_POST["email"];
            $password = $_POST["password"];

            $checkUser = "SELECT * FROM friends WHERE friend_email = '$email'";
            $result = $conn->query($checkUser);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                //  Check password directly
                if ($password === $row["password"]) {
                    session_start();
                    $_SESSION["email"] = $email;
                    header("Location: friendlist.php");
                    exit();
                } else {
                    echo "<p class='error'>Invalid password!</p>";
                }
            } else {
                echo "<p class='error'>Email not found!</p>";
            }

            $conn->close();
        }
        ?>
    </div>
</body>
</html>
