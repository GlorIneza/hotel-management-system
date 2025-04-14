<!-- filepath: c:\xampp\htdocs\hotel-management-system\register_admin.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin</title>
</head>
<body>
    <h1>Register as Admin</h1>
    <form action="register_admin_process.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone"><br><br>

        <label for="address">Address:</label>
        <textarea id="address" name="address"></textarea><br><br>

        <button type="submit">Register</button>
    </form>
</body>
</html>
<?php
use Illuminate\Support\Facades\Hash;

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel_management_system";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$password = Hash::make($_POST['password']); // Hash the password
$phone = $_POST['phone'];
$address = $_POST['address'];

// Insert admin data into the database
$sql = "INSERT INTO users (name, email, password, role, phone, address, is_admin) 
        VALUES (?, ?, ?, 'admin', ?, ?, 1)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $name, $email, $password, $phone, $address);

if ($stmt->execute()) {
    echo "Admin registered successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Close connection
$stmt->close();
$conn->close();
?>