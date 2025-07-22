<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guestbook - View Entries</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 8px;
        }
        th, td {
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Guestbook Entries</h1>
    <a href="guestbookform.php">Add Another Visitor</a>

    <?php
    // Define the file path
    $filename = "../../data/lab06/guestbook.txt";

    // Check if the file exists
    if (file_exists($filename)) {
        // Read the file content
        $handle = fopen($filename, "r");
        $guestArray = [];

        // Loop through the file and store data in the array
        while (!feof($handle)) {
            $line = fgets($handle);
            if (trim($line) != "") {
                $guestArray[] = explode(",", trim($line));
            }
        }
        fclose($handle);

        // Sort array by Name (first element of the sub-array)
        usort($guestArray, function($a, $b) {
            return strcmp($a[0], $b[0]);
        });

        // Display the guestbook entries in a table
        echo "<table>";
        echo "<tr><th>Number</th><th>Name</th><th>Email</th></tr>";

        $number = 1;
        foreach ($guestArray as $guest) {
            echo "<tr>";
            echo "<td>" . $number . "</td>";
            echo "<td>" . htmlspecialchars($guest[0]) . "</td>";
            echo "<td>" . htmlspecialchars($guest[1]) . "</td>";
            echo "</tr>";
            $number++;
        }
        echo "</table>";
    } else {
        echo "<p>No visitors have signed the guestbook yet.</p>";
    }


    
    ?>

    <p><a href="guestbookform.php">Add Another Visitor</a></p>
</body>
</html>
