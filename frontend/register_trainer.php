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
      <h2>Register Trainer</h2>
      <form action="../backend/register_trainer.php" method="post" enctype="multipart/form-data"> First Name: <input class=" form-control" type="text" name="first_name"><br>
        Last Name: <input class="form-control" type="text" name="last_name"><br>
        Email: <input class="form-control" type="email" name="email"><br>
        Phone Number: <input class="form-control" type="text" name="phone_number"><br>
        <input type="hidden" name="photo_path" id="photoPathInput">
        <div id="dropzone-upload" class="dropzone"></div>
        <input class="btn btn-primary mt-3" type="submit" value="Register Trainer">
      </form>
    </div>

    <?php require_once '../scripts.php' ?>
</body>

</html>