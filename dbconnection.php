<?php
// dbconnection.php
$servername = "localhost";  // Your DB host
$username = "root";         // Your DB username
$password = "";             // Your DB password
$dbname = "flowsync";       // Your DB name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>