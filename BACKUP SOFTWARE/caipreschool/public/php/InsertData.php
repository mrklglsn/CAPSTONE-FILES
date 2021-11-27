<?php
header("Access-Control-Allow-Origin: *");
date_default_timezone_set('Asia/Manila');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "caipreschool_db";

$student_id = $_POST['student_id'];
$subject = $_POST['subject'];
$game_title = $_POST['game_title'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$sql = "INSERT INTO gamerecords (student_id, subject, game_title, finished_at)
VALUES ($student_id, $subject, $game_title,date('d-m-Y H:i:s'))";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

?>
