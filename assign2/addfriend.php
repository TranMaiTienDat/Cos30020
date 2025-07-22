<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

// Check if the 'id' parameter is passed via the URL (ID of the friend to add)
if (isset($_GET["id"])) {
    $friendId = $_GET["id"]; // Get the ID of the friend to be added from the URL
    include 'config.php'; // Include the database connection from config.php

    $email = $_SESSION["email"]; // Get the logged-in user's email from the session
    $sql = "SELECT friend_id FROM friends WHERE friend_email = '$email'"; // Get the 'friend_id' of the current user
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); // Fetch the 'friend_id' of the current user
        $userId = $row["friend_id"];
        
        // Check if they are already friends
        $checkFriendSql = "SELECT * FROM myfriends WHERE (friend_id1 = $userId AND friend_id2 = $friendId) 
            OR (friend_id1 = $friendId AND friend_id2 = $userId)";
        $checkResult = $conn->query($checkFriendSql);

        if ($checkResult->num_rows > 0) {
            echo "<p>You are already friends with this user!</p>";
        } else {
            // Proceed to add friend
            $sql = "INSERT INTO myfriends (friend_id1, friend_id2) VALUES ($userId, $friendId)";
            if ($conn->query($sql) === TRUE) {
                echo "<p>Friend added successfully!</p>";
            } else {
                echo "<p>Error adding friend: " . $conn->error . "</p>";
            }
        }
    }

    $conn->close();
    header("Location: friendlist.php");
}
?>
