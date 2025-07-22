<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Experimenting with arrays</title>
</head>
<body>
<h1>Web Programming - Lab 2</h1>
<?php
$days = array ("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
echo "<p>The Days of the week in English are: " . implode(", ", $days) . ".</p>";

// Reassign the values in French
$days = array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");
echo "<p>The Days of the week in French are: " . implode(", ", $days) . ".</p>"; // output days in French
?>
</body>
</html>