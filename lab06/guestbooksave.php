<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Your Name" />
    <title>Guest Book Save</title>
</head>
<body>
<h1>Lab06 Task 2 - Guestbook</h1>

<?php
if (isset($_POST["name"]) && isset($_POST["email"]) && !empty($_POST["name"]) && !empty($_POST["email"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];

    // Biểu thức kiểm tra email hợp lệ
    $regexp = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/";

    if (!preg_match($regexp, $email)) {
        echo "<p style='color: red;'>Email address is not valid.</p>";
    } else {
        $filename = "../../data/lab06/guestbook.txt";
        $guests = array();
        $guestNames = array();
        $guestEmails = array();

        // Kiểm tra nếu file tồn tại
        if (file_exists($filename)) {
            $handle = fopen($filename, "r");
            while (!feof($handle)) {
                $line = fgets($handle);
                if ($line != "") {
                    $guest = explode(",", trim($line));
                    $guests[] = $guest;
                    $guestNames[] = $guest[0];  // Tên khách
                    $guestEmails[] = $guest[1]; // Email khách
                }
            }
            fclose($handle);
        } else {
            // Tạo thư mục và file nếu chưa tồn tại
            if (!file_exists('../../data/lab06')) {
                mkdir('../../data/lab06', 0777, true);
            }
        }

        // Kiểm tra trùng lặp
        if (in_array($name, $guestNames) || in_array($email, $guestEmails)) {
            echo "<p style='color: red;'>You have already signed the guest book!</p>";
        } else {
            // Ghi dữ liệu mới vào file
            $handle = fopen($filename, "a");
            $data = $name . "," . $email . "\n";
            fputs($handle, $data);
            fclose($handle);
            
            echo "<p>Thank you for signing our guest book</p>";
            echo "<p>Name: $name <br>Email: $email</p>";
        }
    }
} else {
    echo "<p style='color: red;'>You must enter your name and email address!</p>";
}
?>

<p><a href="guestbookform.php">Add Another Visitor</a></p>
<p><a href="guestbookshow.php">View Guest Book</a></p>

</body>
</html>
