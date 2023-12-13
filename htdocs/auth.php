<?php
// Check if username and password are set in POST request
if (isset($_POST['username']) && isset($_POST['password'])) {
    // In a real scenario, you'd validate credentials against a database
    $valid_username = "user";
    $valid_password = "password";

    // Get user input
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if credentials match
    if ($username === $valid_username && $password === $valid_password) {
        // Successful login
        echo "<h2>Welcome, $username!</h2>";
        // You can redirect to another page or perform additional actions here
    } else {
        // Invalid credentials
        echo "<h2>Invalid username or password. Please try again.</h2>";
    }
} else {
    // Redirect to login page if accessed directly without form submission
    header("Location: login.php");
    exit();
}
?>