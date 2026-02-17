<?php
// Display errors for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rd_websoft_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data safely
$fullname = isset($_POST['fullname']) ? trim($_POST['fullname']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$subject = isset($_POST['subject']) ? trim($_POST['subject']) : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

// Validate
if (!$fullname || !$email || !$subject || !$message) {
    echo "<h3 style='color:red;text-align:center;margin-top:50px;'>Error: All fields are required.</h3>";
    echo "<p style='text-align:center;'><a href='contact.html'>Go Back to Contact Form</a></p>";
    exit();
}

// Prepare statement
$stmt = $conn->prepare("INSERT INTO contacts (fullname, email, subject, message) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $fullname, $email, $subject, $message);

// Execute
if ($stmt->execute()) {
    header("Location: submit.php");
    exit();
} else {
    echo "<h3 style='color:red;text-align:center;margin-top:50px;'>Database Error: " . $stmt->error . "</h3>";
    echo "<p style='text-align:center;'><a href='contact.html'>Go Back to Contact Form</a></p>";
}

// Close
$stmt->close();
$conn->close();
?>
