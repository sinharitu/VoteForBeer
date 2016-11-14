<?php
@session_start();
$servername = "localhost:8889";
$db = "test_vote";
$username = "root";
$password = "root";// Create connection
$votingDb = new mysqli($servername, $username, $password, $db);

// Check connection
if ($votingDb->connect_error) {
    die("Connection failed: " . $votingDb->connect_error);
}
?>
