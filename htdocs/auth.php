<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Establish database connection (assuming MySQL)
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "saimerchshop";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
if ($_SERVER["REQUEST_METHOD"] == "POST") 
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Protect against SQL injection (you may use prepared statements)
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Query to check if the user exists with the given credentials
    $sql = "SELECT * FROM member WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $stored_password = $row['password'];

        // Verify entered password against the hashed password
        if (password_verify($password, $stored_password)) {
            // Passwords match - login successful
            header("Location: merchstore.php"); // Redirect to dashboard or authenticated page
            exit();
            
        // Redirect to a dashboard or another page
        // header("Location: dashboard.php");
    } else {
        // Invalid credentials
        echo "Invalid username or password";
    }
}

$conn->close();
?>

