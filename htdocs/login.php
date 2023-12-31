<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Login</title>
    <link href="styles.css" rel="stylesheet" type = "text/css"/>
    <link rel="stylesheet" media="screen and (max-width: 600px)" href="mobile.css">
</head>
<body>
    <div class = "container clearfix">
    <div class = "menu-panel">
            <ul>
              <li> <a href="welcome.html">Home</a></li>
              <li> <a href="aboutsai.html">About SAI</a></li>
              <li> <a href="faqs.html">FAQs</a></li>
              <li> <a href="MITStuff.html">For MITS</a></li>
              <li> <a href="interestform.html">Interest Form</a></li>
              <li> <a href = "login.php">Member Login</a></li>
              <li> <a href = "store.php">Merch Store</a></li>
              </ul>
          </div>
    <div class = "content">
    <h1>Member Login</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Login">
    </form>
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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Protect against SQL injection (you may use prepared statements)
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    if (strlen($username) < 1){
        echo '<div class = "error-message"> Error: Please enter your username </div>';
    }
    else if (strlen($password) < 1){
        echo '<div class = "error-message"> Error: Please enter your password </div>';
    }
    else {
        // Query to check if the user exists with the given credentials
        $sql = "SELECT * FROM member WHERE username='$username' AND password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            header("Location: index.php"); 
            session_start();
            $cookie_name = "user";
            $cookie_value = $username;
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
            $_SESSION["username"] = $username;
            exit();
        
        } else {
            echo '<div class = "error-message"> Error: Invalid username or password </div>';
        }
    }

}

$conn->close();
?>
    <p>New to SAI? Click <a href = "newaccount.php">here</a> to make an account!</p>
    <div>
    <div>
</body>
</html>