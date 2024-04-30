<?php
include('database_connection.php');

// Check if enrollmentid is set
if(isset($_REQUEST['enrollmentid'])) {
    $cid = $_REQUEST['enrollmentid'];
    
    $stmt = $connection->prepare("SELECT * FROM enrollment WHERE enrollmentid=?");
    $stmt->bind_param("i", $eid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $w = $row['enrollmentid'];
        $x = $row['courseid'];
        $u = $row['userid'];
        $y = $row['enrollmentdate'];
        $z = $row['grade'];
    } else {
        echo "enrollment not found.";
    }
}
?>

<html>
<body>
    <form method="POST">
        <label for="cid">courseid:</label>
        <input type="number" name="cid" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="uid">userid:</label>
        <input type="number" name="uid" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for=edt>enrollmentdate:</label>
        <input type="date" name="edt" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for=gr>grade:</label>
        <input type="text" name="gr" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $courseid = $_POST['cid'];
    $userid = $_POST['uid'];
    $enrollmentdate = $_POST['edt'];
    $grade = $_POST['gr'];
    
    // Update the enrollment in the database
    $stmt = $connection->prepare("UPDATE enrollment SET courseid=?, userid=?,enrollmentdate=?,grade=? WHERE enrollmentid=?");
    $stmt->bind_param("ssdii", $courseid, $userid, $enrollmentdate, $grade,$eid);
    $stmt->execute();
    
    // Redirect to enrollment.php
    header('Location: enrollment.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
