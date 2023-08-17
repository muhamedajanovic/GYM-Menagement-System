<?php
require_once 'backend/config.php';

$username = 'lazar';
$password = 'sifra123';

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

echo $hashed_password;

$sql = "INSERT INTO admins (username, password) VALUES (?,?)";

$run = $conn->prepare($sql);
$run->bind_param("ss", $username, $hashed_password);
$run->execute();
