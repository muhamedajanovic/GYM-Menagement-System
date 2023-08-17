<!DOCTYPE html>
<html lang="en">

<head>
  <title>Register member</title>
  <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
</head>

<body>



  <?php require_once '../backend/config.php' ?>
  <?php require_once '../style.php' ?>

  <div class="container py-5">
    <?php require_once 'navbar.php' ?>

    <div class="col-md-6">
      <h2>Register Member</h2>
      <form action="../backend/register_member.php" method="post" enctype="multipart/form-data"> First Name: <input class=" form-control" type="text" name="first_name"><br>
        Last Name: <input class="form-control" type="text" name="last_name"><br>
        Email: <input class="form-control" type="email" name="email"><br>
        Phone Number: <input class="form-control" type="text" name="phone_number"><br> Training Plan:
        <?php
        $sql = "SELECT * FROM training_plans";
        $run = $conn->query($sql);
        $results = $run->fetch_all(MYSQLI_ASSOC);
        ?>

        <select class="form-select" name="training_plan_id">
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

  <?php require_once '../scripts.php' ?>
</body>

</html>