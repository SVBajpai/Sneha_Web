<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "sneha_db";

$conn = new mysqli($host, $user, $pass, $dbname);

// Check Connection
if ($conn->connect_error) {
    die("DB Connection Failed: " . $conn->connect_error);
}

// Get Form Values
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Insert Query (table name = contact)
$sql = "INSERT INTO contact (fullname, email, subject, message)
        VALUES ('$fullname', '$email', '$subject', '$message')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Your message was sent successfully!'); window.location.href='contact.html';</script>";
} else {
    echo "Database Error: " . $conn->error;
}

$conn->close();
?>
