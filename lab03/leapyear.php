<?php
function is_leapyear($year) {
    return (is_numeric($year) && (($year % 4 == 0 && $year % 100 != 0) || ($year % 400 == 0)));
}

$message = ""; // Biến để lưu thông điệp kết quả

if (isset($_GET['year'])) {
    $year = $_GET['year'];

    if (is_leapyear($year)) {
        $message = "<p style='color: green;'>The year you entered $year is a leap year.</p>";
    } else {
        $message = "<p style='color: red;'>The year you entered $year is not a leap year.</p>";
    }
} else {
    $message = "Please enter a year.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Leap Year Result" />
    <meta name="keywords" content="Web,programming" />
    <title>Leap Year Result</title>
</head>
<body>
    <h2><?php echo $message; ?></h2>
</body>
</html>
