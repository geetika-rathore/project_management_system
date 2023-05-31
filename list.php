<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin'])) {
    // Redirect to the login page or display an error message
    header("Location: signin.php");
    exit;
}

$host = "localhost";
$username = "root";
$password = "";
$database = "dbgeet";

// Create a database connection
$connection = mysqli_connect($host, $username, $password, $database);

// Check if the connection was successful
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Check if a project ID is provided for deletion
if (isset($_GET['delete'])) {
    $projectId = $_GET['delete'];

    // Prepare and execute the SQL query to delete the project from the database
    $query = "DELETE FROM projects WHERE id = $projectId";
    $result = mysqli_query($connection, $query);

    if ($result) {
        // Project deleted successfully
        header("Location: list.php");
        exit;
    } else {
        // Error occurred while deleting the project
        $errorMessage = "Error: " . mysqli_error($connection);
    }
}

// Retrieve the list of projects from the database
$query = "SELECT * FROM projects";
$result = mysqli_query($connection, $query);

// Close the database connection
mysqli_close($connection);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<!-- The  HTML code -->
<body>
    <div class="container">
        <header>
            <nav class="navbar">
                <h1 class="logo">Project Management System</h1>
                <div class="navbar-buttons">
           <a href="addproject.php">Add Project</a>
          <!-- <a href="list.php">View List</a> -->
          <a href="logout.php">Logout</a>
        </div>
    </nav>
</header>


    <div class="add-section">
      <h2>List of Projects</h2>
      <table>
        <thead>
          <tr>
          <th>Project Id</th>
            <th>Project Name</th>
            <th>Branch</th>
            <th>Session</th>
            <th>Semester</th>
            <th>Technology</th>
            <th>Section</th>
            <th>Team Members</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($result && mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                  $projectId = $row['id'];
                  $projectName = $row['project_name'];
                  $branch = $row['branch'];
                  $session = $row['session'];
                  $semester = $row['semester'];
                  $technology = $row['technology'];
                  $section = $row['section'];
                  $teamMembers = $row['team_member1'] . ', ' . $row['team_member2'];
                  ?>

                  <tr>
                  <td><?php echo $projectId; ?></td>
                    <td><?php echo $projectName; ?></td>
                    <td><?php echo $branch; ?></td>
                    <td><?php echo $session; ?></td>
                    <td><?php echo $semester; ?></td>
                    <td><?php echo $technology; ?></td>
                    <td><?php echo $section; ?></td>
                    <td><?php echo $teamMembers; ?></td>
                    <td>
                      <a href="editproject.php?id=<?php echo $row['id'] ?>" class="edit-link">Edit</a>
                      <a href="list.php?delete=<?php echo $projectId; ?>" class="delete-link" onclick="return confirm('Are you sure you want to delete this project?')">Delete</a>
                    </td>
                  </tr>

                  <?php
              }
          } else {
              echo "<tr><td colspan='8'>No projects found.</td></tr>";
          }
            // Free the result set
            mysqli_free_result($result);
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <footer>
    <p>&copy; 2023 Project Management System. All rights reserved.</p>
  </footer>
</body>
</html>
