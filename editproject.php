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

    // Prepare and execute the SQL query to update the project in the database
    $query = "UPDATE projects SET project_name = '$projectName', branch = '$branch', session = '$session', semester = '$semester', technology = '$technology', section = '$section', team_member1 = '$teamMember1', team_member2 = '$teamMember2' WHERE id = $projectId";
    $result = mysqli_query($connection, $query);

    if ($result) {
        // Project updated successfully
        header("Location: list.php");
        exit;
    } else {
        // Error occurred while updating the project
        $errorMessage = "Error: " . mysqli_error($connection);
    }
}

// Retrieve the project details from the database based on the project ID
if (isset($_GET['id'])) {
    $projectId = $_GET['id'];
    $query = "SELECT * FROM projects WHERE id = $projectId";
    $result = mysqli_query($connection, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $project = mysqli_fetch_assoc($result);
    } else {
        // Project not found
        $errorMessage = "Project not found.";
    }
}

// Close the database connection
mysqli_close($connection);
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
          <a href="addproject.php">Add Project</a>
          <a href="list.php">View List</a>
          <a href="logout.php">Logout</a>
        </div>
      </nav>
    </header>

    <div class="add-section">
      <h2>Edit Project</h2>
      <form method="POST">
        <input type="hidden" name="project-id" value="<?php echo $project['id']; ?>">
        <label for="project-name">Project Name:</label>
        <input type="text" id="project-name" name="project-name" value="<?php echo $project['project_name']; ?>" required>

        <label for="branch">Branch:</label>
        <div class="radio-group">
          <input type="radio" id="branch-cs" name="branch" value="cs" <?php if ($project['branch'] == 'cs') echo 'checked'; ?> required>
          <label for="branch-cs">CS</label>

          <input type="radio" id="branch-cs-ai-ds" name="branch" value="cs-ai-ds" <?php if ($project['branch'] == 'cs-ai-ds') echo 'checked'; ?> required>
          <label for="branch-cs-ai-ds">CS(AI & DS)</label>
        
        <input type="radio" id="branch-cs-ds" name="branch" value="cs-ds" <?php if ($project['branch'] == 'cs-ds') echo 'checked'; ?> required>
        <label for="branch-cs-ds">CS (DS)</label>
      
      <input type="radio" id="branch-cs-ai" name="branch" value="cs-ai" <?php if ($project['branch'] == 'cs-ai') echo 'checked'; ?> required>
        <label for="branch-cs-ai">CS (AI)</label>
        </div>

        <label for="session">Session:</label>
        <div class="radio-group">
        <input type="radio" id="session-2020-21" name="session" value="2020-21" <?php if ($project['session'] == '2020-21') echo 'checked'; ?> required>
          <label for="session-2020-21">2020-21</label>

          <input type="radio" id="session-2021-22" name="session" value="2021-22" <?php if ($project['session'] == '2021-22') echo 'checked'; ?>  required>
          <label for="session-2021-22">2021-22</label>

          <input type="radio" id="session-2022-23" name="session" value="2022-23" <?php if ($project['session'] == '2022-23') echo 'checked'; ?>  required>
          <label for="session-2022-23">2022-23</label>

          <input type="radio" id="session-2023-24" name="session" value="2023-24"  <?php if ($project['session'] == '2023-24') echo 'checked'; ?> required>
          <label for="session-2023-24">2023-24</label>
        </div>

        <label for="semester">Semester:</label>
        <select id="semester" name="semester" required>
          <option value="1" <?php if ($project['semester'] == '1') echo 'selected'; ?>>1</option>
          <option value="2" <?php if ($project['semester'] == '2') echo 'selected'; ?>>2</option>
          <option value="3" <?php if ($project['semester'] == '3') echo 'selected'; ?>>3</option>
          <option value="4" <?php if ($project['semester'] == '4') echo 'selected'; ?>>4</option>
          <option value="5" <?php if ($project['semester'] == '5') echo 'selected'; ?>>5</option>
          <option value="6" <?php if ($project['semester'] == '6') echo 'selected'; ?>>6</option>
          <option value="7" <?php if ($project['semester'] == '7') echo 'selected'; ?>>7</option>
          <option value="8" <?php if ($project['semester'] == '8') echo 'selected'; ?>>8</option>
        </select>

        <label for="technology">Technology:</label>
        <div class="radio-group">
          <input type="radio" id="technology-php" name="technology" value="php" <?php if ($project['technology'] == 'php') echo 'checked'; ?> required>
          <label for="technology-php">PHP</label>
          <input type="radio" id="technology-mysql" name="technology" value="mysql" <?php if ($project['technology'] == 'mysql') echo 'checked'; ?> required>
          <label for="technology-mysql">MySQL</label>
        </div>

        <label for="section">Section:</label>
        <div class="radio-group">
          <input type="radio" id="section-a" name="section" value="a" <?php if ($project['section'] == 'a') echo 'checked'; ?> required>
          <label for="section-a">A</label>

          <input type="radio" id="section-b" name="section" value="b" <?php if ($project['section'] == 'b') echo 'checked'; ?> required>
          <label for="section-b">B</label>
          <input type="radio" id="section-c" name="section" value="c"  <?php if ($project['section'] == 'c') echo 'checked'; ?>required>
        <label for="section-c">C</label>
      
      <input type="radio" id="section-d" name="section" value="d" <?php if ($project['section'] == 'd') echo 'checked'; ?> required>
      <label for="section-d">D</label>
      <input type="radio" id="section-e" name="section" value="e" <?php if ($project['section'] == 'e') echo 'checked'; ?> required>
      <label for="section-e">E</label>
        </div>

        <label for="team-member-1">Team Member 1:</label>
        <input type="text" id="team-member-1" name="team-member-1" value="<?php echo $project['team_member1']; ?>" required>

        <label for="team-member-2">Team Member 2:</label>
        <input type="text" id="team-member-2" name="team-member-2" value="<?php echo $project['team_member2']; ?>" required>

        <div class="button-group">
          <button type="submit" class="add-btn">Update</button>
          <button type="reset" class="add-btn">Reset</button>
        </div>
      </form>
    </div>
  </div>
  <footer>
    <p>&copy; 2023 Project Management System. All rights reserved.</p>
  </footer>
</body>
</html>
