<?php
// Database credentials
$host = "localhost";
$username = "root";
$password = "";
$database = "dbgeet";

// Create a new MySQLi instance
$mysqli = new mysqli($host, $username, $password, $database);

// Check the connection
if ($mysqli->connect_errno) {
    // Connection error
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

$login = false;

// Handle sign-in form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize the user input
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the SQL statement
    $checksql = "SELECT count(*) FROM `users` WHERE username='$username' AND password='$password'";
    $result = $mysqli->query($checksql);
    $count = $result->fetch_row()[0];
    
    if ($count == 1) {
        // User credentials are valid
        $login = true;
        session_start();
        $_SESSION['loggedin'] = true;
        header("location: addproject.php");
        exit();
    } else {
        // User credentials are invalid
        header("location: signin.php");
        exit();
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="script.js"></script>
</head>

<body>
    <div class="outerBox">
        <div class="alert alert-primary" role="alert">
        Your username is your college email ID and password is your registration number!
        </div>
        <div class="innerBox">
            <div class="signinHead">
                <h1>Login</h1>
                <p>It just takes 30 seconds</p>
            </div>
            <main class="signinBody">
                <form action="signin.php" method="POST">
                    <p>
                        <label for="username">Username</label>
                        <input type="text" id="username" required placeholder="Username" name="username">
                    </p>

                    <p>
                        <label for="password">Your password</label>
                        <input type="password" id="password" required placeholder="Enter Your Password" name="password">
                    </p>
                    <p>
                        <input type="submit" id="submit" value="Login"onclick=" location.href=' addproject.php'">
                    </p>
                </form>
            </main>
            <!-- <div class="signinFooter">
                <p>Don't have an account? <a href="signup.php">Sign up</a></p>
            </div> -->
        </div>
        <div class="circle c1"></div>
        <div class="circle c2"></div>
    </div>
</body>

</html>
