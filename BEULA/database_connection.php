<?php
// Connection details
$host = "localhost";
$user = "Beula";
$pass = "2206;
$database = "academic_recommendation_system";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}