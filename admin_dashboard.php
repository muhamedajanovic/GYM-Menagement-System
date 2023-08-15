<?php
require 'config.php';

if (!isset($_SESSION["admin_id"])) {
  header('location:index.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
</head>

<body>
  <?php
  if (isset($_SESSION["success_message"])) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <?php

      echo $_SESSION["success_message"];
      unset($_SESSION["success_message"]);

      ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <div class="container">
    <div class="row mb-5">
      <div class="col-md-6">
        <h2>Register Member</h2>
        <form action="register_member.php" method="post" enctype="multipart/form-data"> First Name: <input class=" form-control" type="text" name="first_name"><br>
          Last Name: <input class="form-control" type="text" name="last_name"><br>
          Email: <input class="form-control" type="email" name="email"><br>
          Phone Number: <input class="form-control" type="text" name="phone_number"><br> Training Plan:
          <?php
          $sql = "SELECT * FROM training_plans";
          $run = $conn->query($sql);
          $results = $run->fetch_all(MYSQLI_ASSOC);
          ?>

          <select class="form-control" name="training_plan_id">
            <option value="" disabled selected>Training Plan</option>
            <?php foreach ($results as $plan) : ?>
              <option value="<?= $plan['plan_id'] ?>">
                <?= $plan['name'] ?>
              </option>
            <?php endforeach; ?>
          </select><br>
          <input type="hidden" name="photo_path" id="photoPathInput">
          <div id="dropzone-upload" class="dropzone"></div>
          <input class="btn btn-primary mt-3" type="submit" value="Register Member">
        </form>
      </div>
    </div>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

  <script></script>

</body>

</html>