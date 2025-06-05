<?php
include 'db_connect.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $location = $_POST['location'];
    $items = $_POST['items'];
    $quantity = $_POST['quantity'];

    // Prevent SQL Injection
    $full_name = mysqli_real_escape_string($conn, $full_name);
    $email = mysqli_real_escape_string($conn, $email);
    $mobile = mysqli_real_escape_string($conn, $mobile);
    $location = mysqli_real_escape_string($conn, $location);
    $items = mysqli_real_escape_string($conn, $items);
    $quantity = mysqli_real_escape_string($conn, $quantity);

    // Insert query
    $sql = "INSERT INTO drinking_donations(name, email, mobile, location, items, quantity) 
            VALUES ('$full_name', '$email', '$mobile', '$location', '$items', '$quantity')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Donation successfully recorded! Our volunteer will contact you at '+$mobile); window.location.href='index.html';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
