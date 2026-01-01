<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "contact";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("DB Connection Failed: " . $conn->connect_error);
}

$fullname = $_POST['fullname'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

$sql = "INSERT INTO messages (fullname, email, subject, message)
        VALUES ('$fullname', '$email', '$subject', '$message')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Your message was sent successfully!'); window.location.href='contact.html';</script>";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
