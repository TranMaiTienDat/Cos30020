<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Welcome to the Friend Management System</h1>
        <p>Name: Mai Tien Dat Tran</p>
        <p>Student ID: 104207944</p>
        <p>Email: 104207944@student.swin.edu.au</p>
        <p>
            I declare that this assignment is my individual work. 
            I have not worked collaboratively nor have I copied from any other student’s work or from any other source.
        </p>
        <div class="links">
            <a href="signup.php">Sign Up</a> | 
            <a href="login.php">Log In</a> | 
            <a href="about.php">About</a>
        </div>
        <?php
// Connect to database
include 'config.php';

// Create 'friends' table if not exist
$sqlFriends = "CREATE TABLE IF NOT EXISTS friends (
                friend_id INT AUTO_INCREMENT PRIMARY KEY,
                friend_email VARCHAR(50) NOT NULL,
                password VARCHAR(20) NOT NULL,
                profile_name VARCHAR(30) NOT NULL,
                date_started DATE NOT NULL,
                num_of_friends INT UNSIGNED DEFAULT 0
            )";

// Create 'myfriends' table if not exist
$sqlMyFriends = "CREATE TABLE IF NOT EXISTS myfriends (
                friend_id1 INT NOT NULL,
                friend_id2 INT NOT NULL,
                PRIMARY KEY (friend_id1, friend_id2),
                FOREIGN KEY (friend_id1) REFERENCES friends(friend_id),
                FOREIGN KEY (friend_id2) REFERENCES friends(friend_id)
            )";

// Check if tables created successfully
if ($conn->query($sqlFriends) === TRUE && $conn->query($sqlMyFriends) === TRUE) {
    echo "<p class='success'>Tables created successfully!</p>";

    // Insert sample data into 'friends' table if it's empty
    $result = $conn->query("SELECT COUNT(*) AS count FROM friends");
    $row = $result->fetch_assoc();

    if ($row['count'] == 0) { // Only insert if no friends exist
        $sampleFriends = [
            ['friend_email' => 'john@example.com', 'password' => 'password1', 'profile_name' => 'John', 'date_started' => '2024-01-01'],
            ['friend_email' => 'jane@example.com', 'password' => 'password2', 'profile_name' => 'Jane', 'date_started' => '2024-01-02'],
            ['friend_email' => 'alice@example.com', 'password' => 'password3', 'profile_name' => 'Alice', 'date_started' => '2024-01-03'],
            ['friend_email' => 'bob@example.com', 'password' => 'password4', 'profile_name' => 'Bob', 'date_started' => '2024-01-04'],
            ['friend_email' => 'chris@example.com', 'password' => 'password5', 'profile_name' => 'Chris', 'date_started' => '2024-01-05'],
            ['friend_email' => 'david@example.com', 'password' => 'password6', 'profile_name' => 'David', 'date_started' => '2024-01-06'],
            ['friend_email' => 'emily@example.com', 'password' => 'password7', 'profile_name' => 'Emily', 'date_started' => '2024-01-07'],
            ['friend_email' => 'frank@example.com', 'password' => 'password8', 'profile_name' => 'Frank', 'date_started' => '2024-01-08'],
            ['friend_email' => 'george@example.com', 'password' => 'password9', 'profile_name' => 'George', 'date_started' => '2024-01-09'],
            ['friend_email' => 'helen@example.com', 'password' => 'password10', 'profile_name' => 'Helen', 'date_started' => '2024-01-10']
        ];

        foreach ($sampleFriends as $friend) {
            $sqlInsertFriend = "INSERT INTO friends (friend_email, password, profile_name, date_started, num_of_friends)
                                VALUES ('{$friend['friend_email']}', '{$friend['password']}', '{$friend['profile_name']}', '{$friend['date_started']}', 0)";
            $conn->query($sqlInsertFriend);
        }

        echo "<p class='success'>Sample friends data inserted successfully!</p>";
    } else {
        echo "<p class='info'>Friends data already exists!</p>";
    }

    // Insert sample data into 'myfriends' table if it's empty
    $result = $conn->query("SELECT COUNT(*) AS count FROM myfriends");
    $row = $result->fetch_assoc();

    if ($row['count'] == 0) { // Only insert if no friends relationships exist
        $sampleMyFriends = [
            ['friend_id1' => 1, 'friend_id2' => 2],
            ['friend_id1' => 1, 'friend_id2' => 3],
            ['friend_id1' => 1, 'friend_id2' => 4],
            ['friend_id1' => 2, 'friend_id2' => 3],
            ['friend_id1' => 2, 'friend_id2' => 5],
            ['friend_id1' => 3, 'friend_id2' => 6],
            ['friend_id1' => 3, 'friend_id2' => 7],
            ['friend_id1' => 4, 'friend_id2' => 5],
            ['friend_id1' => 4, 'friend_id2' => 6],
            ['friend_id1' => 5, 'friend_id2' => 7],
            ['friend_id1' => 5, 'friend_id2' => 8],
            ['friend_id1' => 6, 'friend_id2' => 9],
            ['friend_id1' => 7, 'friend_id2' => 8],
            ['friend_id1' => 7, 'friend_id2' => 9],
            ['friend_id1' => 8, 'friend_id2' => 10],
            ['friend_id1' => 9, 'friend_id2' => 10],
            ['friend_id1' => 10, 'friend_id2' => 1],
            ['friend_id1' => 10, 'friend_id2' => 2],
            ['friend_id1' => 8, 'friend_id2' => 3],
            ['friend_id1' => 9, 'friend_id2' => 4]
        ];

        foreach ($sampleMyFriends as $pair) {
            $sqlInsertMyFriend = "INSERT INTO myfriends (friend_id1, friend_id2) VALUES ({$pair['friend_id1']}, {$pair['friend_id2']})";
            $conn->query($sqlInsertMyFriend);
        }

        echo "<p class='success'>Sample myfriends data inserted successfully!</p>";
    } else {
        echo "<p class='info'>Myfriends data already exists!</p>";
    }
} else {
    echo "<p class='error'>Error creating tables: " . $conn->error . "</p>";
}

$conn->close();
?>

    </div>
</body>
</html>
