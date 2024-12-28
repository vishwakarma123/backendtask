<?php
// Database connection configuration
$host = 'localhost';  // Database server
$dbname = 'crud';  // Your database name
$username = 'root';  // Your MySQL username (default is root)
$password = '';  // Your MySQL password (default is empty for XAMPP)

try {
    // Create a PDO instance (PHP Data Objects)
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // Error handling
} catch (PDOException $e) {
    // If the connection fails, stop the script and display the error
    die("Connection failed: " . $e->getMessage());
}
?>
