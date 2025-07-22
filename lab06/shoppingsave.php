<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Your Name" />
    <title>Shopping List</title>
</head>
<body>
<h1>Web Programming - Lab06</h1>
<?php
if (isset($_POST["item"]) && isset($_POST["quantity"])) { // (1)
    $item = $_POST["item"]; // (2)
    $qty = $_POST["quantity"]; // (3)
    $filename = "../../data/shop.txt"; 
    $alldata = array(); // Tạo mảng rỗng để lưu dữ liệu

    if (file_exists($filename)) { // (4)
        $itemdata = array(); // Tạo mảng rỗng để lưu tên các item
        $handle = fopen($filename, "r"); // (6) Mở file ở chế độ đọc
        while (!feof($handle)) { // (7) Đọc file cho đến hết
            $onedata = fgets($handle); // Đọc từng dòng
            if ($onedata != "") { // Nếu không phải dòng trống
                $data = explode(",", $onedata); // (8) Tách dòng thành mảng
                $alldata[] = $data; // Thêm dữ liệu vào mảng
                $itemdata[] = $data[0]; // Lưu tên item vào mảng
            }
        }
        fclose($handle); // (9) Đóng file
        $newdata = !in_array($item, $itemdata); // (10) Kiểm tra item có tồn tại
    } else {
        $newdata = true; // File không tồn tại, là dữ liệu mới
    }

    if ($newdata) {
        $handle = fopen($filename, "a"); // (11) Mở file ở chế độ ghi thêm
        $data = $item . "," . $qty . "\n"; // Tạo chuỗi dữ liệu
        fputs($handle, $data); // (12) Ghi dữ liệu vào file
        fclose($handle); // (13) Đóng file
        $alldata[] = array($item, $qty); // Thêm item mới vào mảng
        echo "<p>Shopping item added</p>";
    } else {
        echo "<p>Shopping item already exists</p>";
    }

    sort($alldata); // (14) Sắp xếp mảng theo bảng chữ cái
    echo "<p>Shopping List</p>";
    foreach ($alldata as $data) { // (15) Lặp qua từng phần tử trong mảng
        echo "<p>", $data[0], " -- ", $data[1], "</p>";
    }
} else { // Không có dữ liệu form
    echo "<p>Please enter item and quantity in the input form.</p>";
}
?>
</body>
</html>
