<?php
include('database_connection.php');

// Check if recommendationid is set
if(isset($_REQUEST['recommendationid'])) {
    $rid = $_REQUEST['recommendationid'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM recommendation WHERE recommendationid=?");
    $stmt->bind_param("i", $rid);
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "recommendationid is not set.";
}

$connection->close();
?>
