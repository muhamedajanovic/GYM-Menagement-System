<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $member_id = $_POST["member_id"];
  $trainer_id = $_POST["trainer_id"];
}

$sql = "UPDATE members SET trainer_id = ? WHERE member_id = ?";
$run = $conn->prepare($sql);
$run->bind_param("ii", $trainer_id, $member_id);
$run->execute();
$conn->close();

$_SESSION["success_message"] = 'Trener uspjesno dodijeljen clanu';
header('location: ../admin_dashboard.php');
