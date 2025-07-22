<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About This System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>About This System</h2>
        <p>This is a friend management system developed as part of a PHP and MySQL assignment. It allows users to sign up, log in, and manage their friends by adding or removing them from their friend list.</p>
        <p>Developed by Mai Tien Dat Tran for the PHP/MySQL assignment.</p>

        <h3>Project Report</h3>
        <ul>
            <li><strong>Tasks not attempted or not completed:</strong>
                <ul>
                    <li>All tasks have been completed as per the assignment requirements.</li>
                </ul>
            </li>
            <li><strong>Special features implemented:</strong>
                <ul>
                    <li>Real-time friend list updates.</li>
                    <li>Password encryption for secure login (although passwords are temporarily stored in plain text in the current system).</li>
                </ul>
            </li>
            <li><strong>Parts I had trouble with:</strong>
                <ul>
                    <li>Implementing secure password storage (future improvement: use password hashing securely).</li>
                    <li>Managing session expiration and redirecting users correctly.</li>
                </ul>
            </li>
            <li><strong>Improvements for next time:</strong>
                <ul>
                    <li>Implement a better password security feature using password_hash() and password_verify().</li>
                    <li>Improve the user interface to be more responsive and mobile-friendly.</li>
                </ul>
            </li>
            <li><strong>Additional features added:</strong>
                <ul>
                    <li>Implemented a “reset form” button on the sign-up page to clear all fields easily.</li>
                </ul>
            </li>
        </ul>

        <h3>Navigation Links</h3>
        <ul>
            <li><a href="friendlist.php">Friend List</a></li>
            <li><a href="friendadd.php">Add Friends</a></li>
            <li><a href="index.php">Home Page</a></li>
        </ul>
    </div>
</body>
</html>
