<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

include 'config.php';

$email = $_SESSION["email"];
$limit = 10; 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Query to get list of friends that can be added
$sql = "SELECT f.friend_id, f.profile_name 
        FROM friends f 
        WHERE f.friend_id NOT IN (
            SELECT mf.friend_id2 
            FROM myfriends mf 
            JOIN friends u ON mf.friend_id1 = u.friend_id 
            WHERE u.friend_email = '$email'
        ) AND f.friend_email != '$email' 
        LIMIT $limit OFFSET $offset";

$result = $conn->query($sql);

// Query to count the total number of friends that can be added
$totalSql = "SELECT COUNT(*) as total FROM friends 
             WHERE friend_id NOT IN (
                 SELECT mf.friend_id2 
                 FROM myfriends mf 
                 JOIN friends u ON mf.friend_id1 = u.friend_id 
                 WHERE u.friend_email = '$email'
             ) AND friend_email != '$email'";
$totalResult = $conn->query($totalSql);
$totalRow = $totalResult->fetch_assoc();
$totalFriends = $totalRow['total'];
$totalPages = ceil($totalFriends / $limit);

// Query to count the total number of current friends of a user
$currentFriendsSql = "SELECT COUNT(*) as current_total_friends 
                      FROM myfriends 
                      WHERE friend_id1 = (SELECT friend_id FROM friends WHERE friend_email = '$email' LIMIT 1)";
$currentFriendsResult = $conn->query($currentFriendsSql);
$currentFriendsRow = $currentFriendsResult->fetch_assoc();
$currentTotalFriends = $currentFriendsRow['current_total_friends'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Friends</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <h2>Add New Friends</h2>
    <!-- Show total current friends -->
    <p>You currently have: <?php echo $currentTotalFriends; ?> friends.</p>

    <?php if ($result->num_rows > 0): ?>
    <ul>
        <?php while ($row = $result->fetch_assoc()): ?>
        <li>
            <?php echo $row["profile_name"]; ?>
            <?php
            $friend_id = $row["friend_id"];
            // Adjust the query to properly limit results and avoid multiple rows
            $mutualFriendsSql = "
                SELECT COUNT(DISTINCT mf2.friend_id2) as mutual_count 
                FROM myfriends mf1 
                JOIN myfriends mf2 ON mf1.friend_id2 = mf2.friend_id2
                WHERE mf1.friend_id1 = '$friend_id' 
                AND mf2.friend_id1 = (SELECT friend_id FROM friends WHERE friend_email = '$email' LIMIT 1)";
            $mutualFriendsResult = $conn->query($mutualFriendsSql);
            if ($mutualFriendsResult) {
                $mutualCountRow = $mutualFriendsResult->fetch_assoc();
                $mutualCount = $mutualCountRow['mutual_count'];
            } else {
                $mutualCount = 0; 
            }
            ?>
            <span>(<?php echo $mutualCount; ?> mutual friends)</span>
            <a href="addfriend.php?id=<?php echo $row["friend_id"]; ?>">Add Friend</a>
        </li>
        <?php endwhile; ?>
    </ul>
    <?php else: ?>
    <p>No available friends to add.</p>
    <?php endif; ?>

    <!-- Pagination -->
    <div class="pagination">
        <?php if ($page > 1): ?>
        <a href="friendadd.php?page=<?php echo $page - 1; ?>">Previous</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="friendadd.php?page=<?php echo $i; ?>" class="<?php echo $i == $page ? 'active' : ''; ?>">
            <?php echo $i; ?>
        </a>
        <?php endfor; ?>

        <?php if ($page < $totalPages): ?>
        <a href="friendadd.php?page=<?php echo $page + 1; ?>">Next</a>
        <?php endif; ?>
    </div>

    <a href="friendlist.php">Back to Friend List</a>
    <a href="logout.php">Log Out</a>
</div>
</body>
</html>

<?php $conn->close(); ?>
