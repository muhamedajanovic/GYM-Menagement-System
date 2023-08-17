<?php
require_once 'backend/config.php';


if (!isset($_SESSION["admin_id"])) {
  header('location:index.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
  <?php require_once 'style.php' ?>
  <style>
    .table {
      border-radius: 10px;
      overflow: hidden;
    }

    .table th,
    .table td {
      vertical-align: middle;
    }

    .table-striped tbody tr:nth-of-type(odd) {
      background-color: #f8f9fa;
    }

    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }

    .btn-primary:hover {
      background-color: #0056b3;
      border-color: #0056b3;
    }
  </style>
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

  <div class="container py-5">

    <?php require_once 'frontend/navbar.php' ?>
    <div class="row">
      <div class="col-md-12">
        <div class=" d-flex p-2 justify-content-between mb-2">

          <h2>Member list</h2>


          <a class="btn btn-success" href="backend/export.php?what=members" style="color:white; text-decoration: none;">Export</a>

        </div>
        <table class="table table-bordered table-striped">
          <thead class="table-dark">
            <tr>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Email</th>
              <th>Phone Number</th>
              <th>Trainer</th>
              <th>Photo</th>
              <th>Training Plan</th>
              <th>Access Card</th>
              <th>Created At</th>
              <th>Action</th>

            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT `member_id`, `first_name`, `last_name`, `email`, `phone_number`, `photo_path`, `training_plan_id`, `trainer_id`, `access_card_pdf_path`, `created_at` FROM `members`";
            $run = $conn->query($sql);
            $results = $run->fetch_all(MYSQLI_ASSOC);

            foreach ($results as $result) :
            ?>

              <tr>
                <td><?php echo $result['first_name'] ?></td>
                <td><?php echo $result['last_name'] ?></td>
                <td><?php echo $result['email'] ?></td>
                <td><?php echo $result['phone_number'] ?></td>
                <td><?php
                    $sql = "SELECT t.trainer_id, t.first_name, t.last_name FROM members m LEFT JOIN trainers t ON m.trainer_id = t.trainer_id WHERE m.trainer_id = ?";
                    $run = $conn->prepare($sql);
                    $run->bind_param("i", $result['trainer_id']);
                    $run->execute();
                    $trainer_results = $run->get_result()->fetch_assoc();
                    if ($trainer_results["trainer_id"]) {
                      echo $trainer_results["first_name"] . " " . $trainer_results["last_name"];
                    } else {
                      echo "Nema trenera";
                    }
                    ?></td>
                <td><img style="width: 60px;" src="<?php echo $result['photo_path'] ?>" alt=""></td>
                <td><?php
                    $sql = "SELECT p.plan_id, p.name FROM members m LEFT JOIN training_plans p ON m.training_plan_id = p.plan_id WHERE m.training_plan_id = ?";
                    $run = $conn->prepare($sql);
                    $run->bind_param("i", $result['training_plan_id']);
                    $run->execute();
                    $plan_results = $run->get_result()->fetch_assoc();
                    if ($plan_results["name"]) {
                      echo $plan_results["name"];
                    } else {
                      echo "Nema plana";
                    }
                    ?></td>
                <td><a href="<?php echo $result['access_card_pdf_path'] ?>" target="_blank" class="btn btn-light">Access card</a></td>
                <td><?php echo $result['created_at'] ?></td>

                <td>
                  <form action="backend/delete_member.php" method="POST">
                    <input type="hidden" name="member_id" value="
                    <?php echo $result['member_id'] ?>">
                    <button class="btn btn-danger" type="submit">DELETE</button>

                  </form>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="row mt-5">
      <div class="col-md-12">
        <div class=" d-flex p-2 justify-content-between mb-2">

          <h2>Trainer list</h2>

          <a class="btn btn-success" href="backend/export.php?what=trainers" style="color:white; text-decoration: none;">Export</a>

        </div>
        <table class="table table-bordered table-striped">
          <thead class="table-dark">
            <tr>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Email</th>
              <th>Phone Number</th>
              <th>Photo</th>
              <th>Created at</th>


            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT `trainer_id`, `first_name`, `last_name`, `email`, `phone_number`, `photo_path`, `created_at` FROM `trainers`";
            $run = $conn->query($sql);
            $results = $run->fetch_all(MYSQLI_ASSOC);

            foreach ($results as $result) :
            ?>

              <tr>
                <td><?php echo $result['first_name'] ?></td>
                <td><?php echo $result['last_name'] ?></td>
                <td><?php echo $result['email'] ?></td>
                <td><?php echo $result['phone_number'] ?></td>
                </td>
                <td><img style="width: 60px;" src="<?php echo $result['photo_path'] ?>" alt=""></td>
                <td><?php echo $result['created_at'] ?></td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <?php require_once 'scripts.php' ?>

</body>

</html>