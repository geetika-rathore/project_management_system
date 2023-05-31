<?php
session_start();

// Destroy all session data
session_destroy();

// Redirect to the login page or any other page you desire
header("Location: index.php");
exit;
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
          <a href="index.html">Home</a>
          <a href="signin.html">Sign In</a>
          <a href="signup.html">Sign Up</a>
        </div>
      </nav>
    </header>

    <div class="section">
      <h2>Logout</h2>
      <p>You have been successfully logged out.</p>
      <p>Your email has been removed.</p>
      <p>Thank you for using our system!</p>
    </div>
  </div>
  <footer>
    <p>&copy; 2023 Project Management System. All rights reserved.</p>
  </footer>
</body>
</html>
