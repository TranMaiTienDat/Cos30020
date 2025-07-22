<?php
function is_prime($num) {
    if ($num <= 1) {
        return false;
    }
    for ($i = 2; $i <= sqrt($num); $i++) {
        if ($num % $i == 0) {
            return false;
        }
    }
    return true;
}

$message = ""; // Biến lưu kết quả

if (isset($_GET['number'])) {
    $number = intval($_GET['number']);
    
    if ($number >= 1 && $number <= 999) {
        if (is_prime($number)) {
            $message = "The number $number is a prime number.";
        } else {
            $message = "The number $number is not a prime number.";
        }
    } else {
        $message = "Please enter a number between 1 and 999.";
    }
} else {
    $message = "Please enter a number.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prime Number Result</title>
</head>
<body>
    <h2><?php echo $message; ?></h2>
</body>
</html>
