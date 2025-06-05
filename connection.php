<?php
include 'db_connect.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    
    // Prevent SQL Injection
    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);
    $subject = mysqli_real_escape_string($conn, $subject);
    $message = mysqli_real_escape_string($conn, $message);
    

    // Insert query using prepared statement
$sql = $conn->prepare("INSERT INTO contact_form (name, email, subject, message) VALUES (?, ?, ?, ?)");

if ($sql) {
    $sql->bind_param("ssss", $name, $email, $subject, $message);
    if ($sql->execute()) {
        echo "<script>alert('Your information is being submitted. I will connect with you as soon as possible!'); window.location.href='index.html';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
    $sql->close();
} else {
    echo "Error preparing statement: " . $conn->error;
}

}



$conn->close();


?>