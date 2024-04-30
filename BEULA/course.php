<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Our Course</title>
  <style>
    /* Normal link */
    a {
      padding: 10px;
      color: white;
      background-color: pink;
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color: purple;
    }
    /* Unvisited link */
    a:link {
      color: brown; /* Changed to lowercase */
    }
    /* Hover effect */
    a:hover {
      background-color: white;
    }

    /* Active link */
    a:active {
      background-color: red;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 1200px; /* Adjust this value as needed */

      padding: 8px;
     
    }
    section{
    padding:71px;
    border-bottom: 1px solid #ddd;
    }
    footer{
    text-align: center;
    padding: 15px;
    background-color:darkgray;
    }

  </style>
  </head>

  <header>

<body bgcolor="blue">
  <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
    <img src="./Images/arsnl.jpg" width="90" height="60" alt="Logo">
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a>
  </li>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./Service.html">SERVICE</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./User.php">USER</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./Enrollment.php">ENROLLMENT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./Recommendation.php">RECOMMENDATION</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./Rating.php">RATING</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./Course.php">COURSE</a>
  </li>
   
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li><br><br>
    
    
    
  </ul>

</header>
<section>

    <h1><u> Course Form </u></h1>
    <form method="post">
            
        <label for="cid">courseid:</label>
        <input type="number" id="cid" name="cid"><br><br>

        <label for="fnm">coursename:</label>
        <input type="text" id="cnm" name="cnm"><br><br>

        <label for="lnm">coursecode:</label>
        <input type="text" id="cc" name="cc" required><br><br>

        <label for=adr>userid:</label>
        <input type="text" id="uid" name="uid" required><br><br>

        <input type="submit" name="add" value="Insert">
      

    </form>


<?php
include('database_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO course(cid, cnm, cc, uid) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $cid, $cnm, $cc, $uid);
    // Set parameters and execute
    $cid = $_POST['cid'];
    $cnm = $_POST['cnm'];
    $cc = $_POST['cc'];
    $uid = $_POST['uid'];
   
    if ($stmt->execute() == TRUE) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$connection->close();
?>

<?php
include('database_connection.php');
// SQL query to fetch data from the Course table
$sql = "SELECT * FROM course";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of Course</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <center><h2>Table of Course</h2></center>
    <table border="5">
        <tr>
            <th>courseid</th>
            <th>coursename</th>
            <th>coursecode</th>
            <th>userid</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        include('database_connection.php');

        // Prepare SQL query to retrieve all Course
        $sql = "SELECT * FROM course";
        $result = $connection->query($sql);

        // Check if there are any courses
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $cid = $row['courseid']; // Fetch the Courseid
                echo "<tr>
                    <td>" . $row['courseid'] . "</td>
                    <td>" . $row['coursename'] . "</td>
                    <td>" . $row['coursecode'] . "</td>
                    <td>" . $row['userid'] . "</td>
                    <td><a style='padding:4px' href='delete_course.php?courseid=$cid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_course.php?courseid=$cid'>Update</a></td> 
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No data found</td></tr>";
        }
        // Close the database connection
        $connection->close();
        ?>
    </table>
</body>

    </section>


  
<footer>
  <center> 
    <b><h2>UR CBE BIT &copy, 2024 &reg, Designer by: @Beula UWUMUGISHA</h2></b>
  </center>
</footer>
</body>
</html>