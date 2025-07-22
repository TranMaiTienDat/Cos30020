<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="description" content="Web Programming :: Lab 2">
    <meta name="keywords" content="Web,programming">
    <title>Using expressions and functions</title>
</head>
<body>
    <h1>Web Programming - Lab 2</h1>
    <?php
    if (isset($_GET['number'])) {
        $number = $_GET['number']; // get the value from the form
        
        if (is_numeric($number)) { // check if it is a number
            $number = round($number); // round to nearest whole number
            $message = ($number % 2 == 0) ? "$number is even." : "$number is odd."; // check if it's even or odd
        } else {
            $message = "The value is not a number.";
        }
    } else {
        $message = "No number provided.";
    }
    
    echo "<p>$message</p>"; // output the message
    ?>
</body>
</html>
