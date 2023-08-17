<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $phone_number = $_POST['phone_number'];
  $photo_path = $_POST['photo_path'];
}

$sql = "INSERT INTO `trainers` (`first_name`, `last_name`, `email`, `phone_number`, `photo_path`) VALUES (?, ?, ?, ?, ?)";

$run = $conn->prepare($sql);
$run->bind_param("sssss", $first_name, $last_name, $email, $phone_number, $photo_path);
$run->execute();

$conn->close();

$_SESSION["success_message"] = 'Trener uspjesno dodan';
header('location: ../admin_dashboard.php');
