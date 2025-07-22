<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Web Application Development :: Lab 3" />
    <meta name="keywords" content="Web,programming" />
    <title>Using if and while statements</title>
</head>
<body>
    <?php
    include("mathfunctions.php");
    ?>
    <h1>Web Programming - Lab 3</h1>
    <?php
    if (isset($_GET["number"])) { // kiểm tra xem form đã gửi dữ liệu hay chưa
        $num = $_GET["number"]; // lấy dữ liệu từ form

        if ($num > 0) { // kiểm tra nếu số là số dương
            if ($num == round($num)) { // kiểm tra nếu số là số nguyên
                echo "<p>", $num, "! is ", factorial($num), ".</p>";
            } else {
                echo "<p>Please enter an integer.</p>";
            }
        } else {
            echo "<p>Please enter a positive integer.</p>";
        }
    } else {
        echo "<p>Please enter a positive integer.</p>";
    }
    ?>
</body>
</html>
