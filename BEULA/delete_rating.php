<?php
include('database_connection.php');

// Check if ratingid is set
if(isset($_REQUEST['ratingid'])) {
    $cid = $_REQUEST['ratingid'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM rating WHERE ratingid=?");
    $stmt->bind_param("i", $rid);
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ratingid is not set.";
}

$connection->close();
?>
