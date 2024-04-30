<?php
include('database_connection.php');

// Check if Courseid is set
if(isset($_REQUEST['Courseid'])) {
    $cid = $_REQUEST['Courseid'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM course WHERE Courseid=?");
    $stmt->bind_param("i", $cid);
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Courseid is not set.";
}

$connection->close();
?>
