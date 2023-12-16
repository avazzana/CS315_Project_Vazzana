<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Login</title>
    <link href="styles.css" rel="stylesheet" type = "text/css"/>
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
    <h1>Create new account</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <label for="fname">First Name:</label><br>
        <input type="text" id="fname" name="fname" value="<?php echo isset($_POST['fname']) ? htmlspecialchars($_POST['fname']) : ''; ?>"><br>
        <label for="lname">Last Name:</label><br>
        <input type="text" id="lname" name="lname"><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br>
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br>
        <label for="password2">Retype Password:</label><br>
        <input type="password" id="password2" name="password2"><br><br>
        <input type="submit" value="Create account">
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

// Function to sanitize and validate input data
function validateInput($data) {
    return htmlspecialchars(trim($data));
}

// Validate and process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = validateInput($_POST['username']);
    $password = validateInput($_POST['password']);
    $password2 = validateInput($_POST['password2']);
    $fname = validateInput($_POST['fname']);
    $lname = validateInput($_POST['lname']);
    $email = validateInput($_POST['email']);


    // Validate username and password criteria
    $errors = [];
    if (strlen($username) < 4 || strlen($username) > 20) {
        $errors[] = "Username must be between 4 and 20 characters.";
    }
    if (strlen($password) < 8 || strlen($password) > 20 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[!@#$%^&*()_+\-=\[\]{};:\'",.<>?]/', $password)) {
        $errors[] = "Password must be between 8 and 20 characters and include at least one uppercase letter, one lowercase letter, one number, and one special character.";
    }
    if ($password != $password2){
        $errors[] = "Passwords must match";
     }
    if (strlen($fname) < 1){
        $errors[] = "First name cannot be empty";
    }
    if (strlen($lname) < 1){
        $errors[] = "Last name cannot be empty";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] = "Please enter a valid email address";
    }
    $sql1 = "SELECT * FROM member WHERE username='$username'";
    $result1 = $conn->query($sql1);
    if ($result1 -> num_rows > 0){
        $errors[] = "The username you selected is not available. Please try another username";
    }
    $sql2 = "SELECT * FROM member WHERE email='$email'";
    $result2 = $conn->query($sql2);
    if ($result2 -> num_rows > 0){
        $errors[] = "There is already an existing account with the email address you entered. Please choose a different one";
    }
    // If no errors, insert into database and redirect to login page
    if (empty($errors)) {
        // Hash the password (for security)
        // Prepare and execute query to insert user data
        $sql = "INSERT INTO member (username, password, firstname, lastname, email) VALUES ('$username', '$password', '$fname', '$lname', '$email')";
        if ($conn->query($sql) === TRUE) {
            // Account created successfully
            header("Location: login.php"); // Redirect to login page
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Display errors if criteria not met
        foreach ($errors as $error) {
            echo '<div class = "error-message"> Error: ' . $error . "</div><br>";
        }
    }
}

    $conn->close();
    ?>
    </div>
</div>
</body>
</html>