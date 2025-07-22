<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}
// Include database configuration to establish a connection

include 'config.php';

$email = $_SESSION["email"]; // Include database configuration to establish a connection

// Query to get the list of friends for the logged-in user by joining the 'friends' and 'myfriends' tables

$sql = "SELECT f.friend_id, f.profile_name 
        FROM friends f
        JOIN myfriends mf ON f.friend_id = mf.friend_id2
        JOIN friends u ON mf.friend_id1 = u.friend_id
        WHERE u.friend_email = '$email'";
$result = $conn->query($sql);
 // Query to count the total number of friends the logged-in user has

$sqlCount = "SELECT COUNT(*) AS total_friends
             FROM myfriends mf
             JOIN friends u ON mf.friend_id1 = u.friend_id
             WHERE u.friend_email = '$email'";
$countResult = $conn->query($sqlCount);
$totalFriends = $countResult->fetch_assoc()['total_friends']; // Fetch the total number of friends
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Friend List</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <h2>Your Friends</h2>
    <p>Total friends: <?php echo $totalFriends; ?></p>

    <?php if ($result->num_rows > 0): ?>
    <ul>
        <?php while ($row = $result->fetch_assoc()): ?>
        <li>
            <?php echo $row["profile_name"]; ?>
            <a href="unfriend.php?id=<?php echo $row["friend_id"]; ?>">Unfriend</a>
        </li>
        <?php endwhile; ?>
    </ul>
    <?php else: ?>
    <p>You have no friends yet.</p>
    <?php endif; ?>
    
    <a href="friendadd.php">Add Friend</a> | 
    <a href="logout.php">Log Out</a>
</div>
</body>
</html>

<?php $conn->close(); ?>
