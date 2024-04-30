<?php
include('database_connection.php');

// Check if userid is set
if(isset($_REQUEST['userid'])) {
    $uid = $_REQUEST['userid'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM user WHERE userid=?");
    $stmt->bind_param("i", $uid);
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "userid is not set.";
}

$connection->close();
?>
