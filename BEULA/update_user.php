<?php
include('database_connection.php');

// Check if user_id is set
if(isset($_REQUEST['userid'])) {
    $uid = $_REQUEST['userid'];
    
    $stmt = $connection->prepare("SELECT * FROM user WHERE userid=?");
    $stmt->bind_param("i", $uid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['userid'];
        $u = $row['username'];
        $y = $row['email'];
        $z = $row['gender'];
    } else {
        echo "user not found.";
    }
}
?>

<html>
<body>
    <form method="POST">
        <label for="uid">userid:</label>
        <input type="number" name="uid" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="un">username:</label>
        <input type="text" name="un" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="e">email:</label>
        <input type="text" name="e" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="g">gender:</label>
        <input type="text" name="g" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $userid = $_POST['uid'];
    $username = $_POST['un'];
    $email = $_POST['e'];
    $gender = $_POST['g'];
    
    // Update the user in the database
    $stmt = $connection->prepare("UPDATE user SET userid=?, username=?, email=?, gender=? WHERE username=?");
    $stmt->bind_param("ssdii", $userid, $username, $email, $gender, $uid);
    $stmt->execute();
    
    // Redirect to user.php
    header('Location: user.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
