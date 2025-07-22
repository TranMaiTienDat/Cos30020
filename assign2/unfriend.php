<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET["id"])) {
    $friendId = $_GET["id"];
    include 'config.php';

    $email = $_SESSION["email"];
    $sql = "SELECT friend_id FROM friends WHERE friend_email = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userId = $row["friend_id"];

        $sql = "DELETE FROM myfriends WHERE friend_id1 = $userId AND friend_id2 = $friendId";
        if ($conn->query($sql) === TRUE) {
            echo "<p>Friend removed successfully!</p>";
        } else {
            echo "<p>Error removing friend: " . $conn->error . "</p>";
        }
    }

    $conn->close();
    header("Location: friendlist.php");
}
?>
