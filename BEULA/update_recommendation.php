<?php
include('database_connection.php');

// Check if recommendationid is set
if(isset($_REQUEST['recommendationid'])) {
    $rid = $_REQUEST['recommendationid'];
    
    $stmt = $connection->prepare("SELECT * FROM recommendation WHERE recommendationid=?");
    $stmt->bind_param("i", $rid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['recommendationid'];
        $u = $row['userid'];
        $y = $row['recommendedcourseid'];
    } else {
        echo "recommendation not found.";
    }
}
?>

<html>
<body>
    <form method="POST">
        <label for="uid">userid:</label>
        <input type="text" name="uid" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="rcid">recommendedcourseid:</label>
        <input type="text" name="rcid" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $userid = $_POST['uid'];
    $recommendedcourseid = $_POST['rcid'];
    
    
    // Update the recommendation in the database
    $stmt = $connection->prepare("UPDATE recommendation SET userid=?, recommendedcourseid=? WHERE recommendationid=?");
    $stmt->bind_param("ssd", $recommendationid, $userid, $rcid);
    $stmt->execute();
    
    // Redirect to recommendation.php
    header('Location: recommendation.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
