<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}
else{
	$loggedin = false;
  }

?>
<?php

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

?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="container">
    <header>
      <nav class="navbar">
        <h1 class="logo">Project Management System</h1>
        <div class="navbar-buttons">
          <a href="list.php">View list</a>
          <a href="logout.php">logout</a>
        </div>
      </nav>
    </header>

    <div class="add-section">
      <h2>Add Project</h2>
      <form action="addproject.php" method ="POST">
      <!-- <label for="project-name">Project ID:</label> -->
        <input type="hidden" id="project-id" name="project-id" required>
        <label for="project-name">Project Name:</label>
        <input type="text" id="project-name" name="project-name" required>
        <!-- <label for="team-members">Team Members:</label>
        <input type="text" id="team-member-1" name="team-member-1" required>
        <input type="text" id="team-member-2" name="team-member-2" required> -->
        <br>
        <label for="branch">Branch:</label>
        <div class="radio-group">
          <input type="radio" id="branch-cs" name="branch" value="cs" required>
          <label for="branch-cs">CS</label>

          <input type="radio" id="branch-cs-ai-ds" name="branch" value="cs-ai-ds" required>
          <label for="branch-cs-ai-ds">CS(AI & DS)</label>
        
        <input type="radio" id="branch-cs-ds" name="branch" value="cs-ds" required>
        <label for="branch-cs-ds">CS (DS)</label>
      
      <input type="radio" id="branch-cs-ai" name="branch" value="cs-ai" required>
        <label for="branch-cs-ai">CS (AI)</label>
      </div>

        <label for="session">Session:</label>
        <div class="radio-group">
          <input type="radio" id="session-2020-21" name="session" value="2020-21" required>
          <label for="session-2020-21">2020-21</label>

          <input type="radio" id="session-2021-22" name="session" value="2021-22" required>
          <label for="session-2021-22">2021-22</label>

          <input type="radio" id="session-2022-23" name="session" value="2022-23" required>
          <label for="session-2022-23">2022-23</label>

          <input type="radio" id="session-2023-24" name="session" value="2023-24" required>
          <label for="session-2023-24">2023-24</label>
        </div>
        <label for="semester">Semester:</label>
        <select id="semester" name="semester" required>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
        </select>

        <label for="technology">Technology:</label>
        <div class="radio-group">
          <input type="radio" id="technology-php" name="technology" value="php" required>
          <label for="technology-php">PHP</label>

          <input type="radio" id="technology-mysql" name="technology" value="mysql" required>
          <label for="technology-mysql">MySQL</label>
        </div>

        <label for="section">Section:</label>
        <div class="radio-group">
          <input type="radio" id="section-a" name="section" value="a" required>
          <label for="section-a">A</label>

          <input type="radio" id="section-b" name="section" value="b" required>
          <label for="section-b">B</label>
        
        <input type="radio" id="section-c" name="section" value="c" required>
        <label for="section-c">C</label>
      
      <input type="radio" id="section-d" name="section" value="d" required>
      <label for="section-d">D</label>
      <input type="radio" id="section-e" name="section" value="e" required>
      <label for="section-e">E</label>

  </div>
  
          <label for="Team-Member-name">Team Member Name:</label>
         <label for="team-member-1">Team Member 1</label>
         <input type="text" id="team-member-1" name="team-member-1" required>
      
         <label for="team-member-2">Team Member 2</label>
         <input type="text" id="team-member-2" name="team-member-2" required>

        <div class="button-group">
          <button type="submit" class="add-btn">Add Project</button>
          <button type="reset" class="add-btn">Reset</button>
        </div>
      </form>
      <?php
      // Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the project details from the form
    $projectId = $_POST['project-id'];
    $projectName = $_POST['project-name'];
    $branch = $_POST['branch'];
    $session = $_POST['session'];
    $semester = $_POST['semester'];
    $technology = $_POST['technology'];
    $section = $_POST['section'];
    $teamMember1 = $_POST['team-member-1'];
    $teamMember2 = $_POST['team-member-2'];
    // Prepare and execute the SQL query to insert the project into the database
    $query = "INSERT INTO projects ( id ,project_name, branch, session, semester, technology, section, team_member1, team_member2) VALUES ('$projectId','$projectName', '$branch', '$session', '$semester', '$technology', '$section', '$teamMember1', '$teamMember2')";
    $result = mysqli_query($connection, $query);
    if ($result) {
        header("Location:list.php");
        exit;
    } else {
        // Error occurred while adding the project
        $errorMessage = "Error: " . mysqli_error($connection);
    }
}
?>
    </div>
  </div>
  <footer>
    <p>&copy; 2023 Project Management System. All rights reserved.</p>
  </footer>
</body>
</html>
