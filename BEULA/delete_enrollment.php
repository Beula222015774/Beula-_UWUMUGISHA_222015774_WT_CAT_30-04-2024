<?php
include('database_connection.php');

// Check if enrollmentid is set
if(isset($_REQUEST['enrollmentid'])) {
    $cid = $_REQUEST['enrollmentid'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM enrollment WHERE enrollmentid=?");
    $stmt->bind_param("i", $eid);
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "enrollmentid is not set.";
}

$connection->close();
?>
