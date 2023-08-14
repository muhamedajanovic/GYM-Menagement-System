<?php

require_once 'config.php';


if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $sql = "SELECT admin_id, password FROM admins WHERE username = ?";

  $run = $conn->prepare($sql);

  $run->bind_param("s", $username);

  $run->execute();

  $results = $run->get_result();

  if ($results->num_rows == 1) {
    $admin = $results->fetch_assoc();
    if (password_verify($password, $admin['password'])) {
      header('location: admin_dashboard.php');
      $_SESSION["admin_id"] = $admin["admin_id"];
    } else {
      header('location: index.php');
      $_SESSION["error"] = "Netacan password";
      exit;
    }
  } else {
    header('location: index.php');
    $_SESSION["error"] = "Netacan username";
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <?php
    if (isset($_SESSION["error"])) {
      echo '<p class="error-message">' . $_SESSION["error"] . '</p>';
      unset($_SESSION["error"]);
    }
    ?>

    <form action="" method="post">
      Username: <input type="text" name="username"><br>
      Password: <input type="password" name="password"><br>
      <input type="submit" value="Login">
    </form>
  </div>
</body>

</html>