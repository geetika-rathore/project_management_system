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

// Connection successful
// echo "Connected to the database successfully!";

// Close the database connection
$mysqli->close();
?>

<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="script.js"></script>
</head>

<body>
    <div class="container">
        <header>
            <nav class="navbar">
                <h1 class="logo">Project Management System</h1>
                <div class="navbar-buttons">
                    <a href="signin.php" id="signin-btn">Sign In</a>
          <!-- <a href="signup.php" id="signup-btn">Sign Up</a> -->
        </div>
    </nav>
</header>

<div class="section">
        <img src="image2.jpg" alt="Background Image" class="bg-image">
      <h2>Welcome to the Project Management System!</h2>
 <p>Manage your projects effectively with our intuitive project management system.</p>
      <a href="signin.php">Get Started</a>      
    </div>
  </div>

  <footer>
    <p>&copy; 2023 Project Management System. All rights reserved.</p>
  </footer>
</body>

</html>
