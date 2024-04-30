<?phps
include('database_connection.php');

// Check if CustomerID is set
if(isset($_REQUEST['Courseid'])) {
    $cid = $_REQUEST['Courseid'];
    
    $stmt = $connection->prepare("SELECT * FROM course WHERE Courseid=?");
    $stmt->bind_param("i", $cid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['cid'];
        $u = $row['cnm'];
        $y = $row['cc'];
    } else {
        echo "Course not found.";
    }
}
?>

<html>
<body>
    <form method="POST">
        <label for="fnm">Coursename:</label>
        <input type="text" name="cnm" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="lnm">Coursecode:</label>
        <input type="text" name="cc" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for=adr>userid:</label>
        <input type="text" name="uid" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $coursename = $_POST['cnm'];
    $coursecode = $_POST['cc'];
    $userid = $_POST['uid'];
    
    // Update the course in the database
    $stmt = $connection->prepare("UPDATE course SET cnm=?, cc=?, uid=? WHERE Courseid=?");
    $stmt->bind_param("ssdii", $cnm, $cc, $uid);
    $stmt->execute();
    
    // Redirect to course.php
    header('Location: course.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
