<?php
include('database_connection.php');

// Check if ratingid is set
if(isset($_REQUEST['ratingid'])) {
    $cid = $_REQUEST['ratingid'];
    
    $stmt = $connection->prepare("SELECT * FROM rating WHERE ratingid=?");
    $stmt->bind_param("i", $rid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['ratingid'];
        $u = $row['userid'];
        $y = $row['courseid'];
        $z = $row['rating'];
        $w = $row['review'];
    } else {
        echo "rating not found.";
    }
}
?>

<html>
<body>
    <form method="POST">
        <label for="uid">userid:</label>
        <input type="number" name="uid" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="cid">courseid:</label>
        <input type="number" name="cid" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for=rtg>rating:</label>
        <input type="number" name="rtg" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="rvw">review:</label>
        <input type="text" name="rvw" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $userid = $_POST['uid'];
    $courseid = $_POST['cid'];
    $rating = $_POST['rtg'];
    $review = $_POST['rvw'];
    
    // Update the transactions in the database
    $stmt = $connection->prepare("UPDATE rating SET userid=?, courseid=?, rating=?, review=? WHERE ratingid=?");
    $stmt->bind_param("ssdii", $userid, $courseid, $rating, $review;
    $stmt->execute();
    
    // Redirect to rating.php
    header('Location: rating.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
