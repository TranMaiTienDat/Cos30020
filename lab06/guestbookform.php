<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Your Name" />
    <title>Guest Book</title>
</head>
<body>
<h1>Enter your detail to sign our guest book</h1>
<form action="guestbooksave.php" method="post">
    <p>Name: <input type="text" name="name" /></p>
    <p>Email: <input type="text" name="email" /></p>
    <p><input type="submit" value="Sign Guest Book" /></p>
    <input type="reset" value="Reset" />

</form>
<p><a href="guestbookshow.php">View Guest Book</a></p>
</body>
</html>
