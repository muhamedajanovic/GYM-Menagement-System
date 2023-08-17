<!DOCTYPE html>
<html lang="en">

<head>
  <title>Register trainer</title>
  <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
</head>

<body>
  <?php require_once '../backend/config.php' ?>
  <?php require_once '../style.php' ?>

  <div class="container py-5">
    <?php require_once 'navbar.php' ?>


    <div class="col-md-6">
      <h2>Assign Trainer to Member</h2>
      <form action="../backend/assing_trainer.php" method="POST">
        <?php
        $sql = "SELECT * FROM members";
        $run = $conn->query($sql);
        $member_result = $run->fetch_all(MYSQLI_ASSOC);
        ?>

        <select class="form-select" name="member_id">
          <option value="" disabled selected>Member</option>
          <?php foreach ($member_result as $member) : ?>
            <option value="<?= $member['member_id'] ?>">
              <?= $member['first_name'] . " " . $member['last_name'] ?>
            </option>
          <?php endforeach; ?>
        </select><br>
        <?php
        $sql = "SELECT * FROM trainers";
        $run = $conn->query($sql);
        $trainer_result = $run->fetch_all(MYSQLI_ASSOC);
        ?>

        <select class="form-select" name="trainer_id">
          <option value="" disabled selected>Trainer</option>
          <?php foreach ($trainer_result as $trainer) : ?>
            <option value="<?= $trainer['trainer_id'] ?>">
              <?= $trainer['first_name'] . " " . $trainer['last_name'] ?>
            </option>
          <?php endforeach; ?>
        </select><br>
        <input class="btn btn-primary mt-3" type="submit" value="Assign Trainer">
      </form>
    </div>

    <?php require_once '../scripts.php' ?>
</body>

</html>