<?php
require_once 'config.php';

if (isset($_GET["what"])) {
  if ($_GET["what"] == 'members') {
    $sql = "SELECT * FROM members";
    $csv_cols = ["member_id", "first_name", "last_name", "email", "phone_number", "photo_path", "trainer_plan_id", "training_id", "access_card_pdf_path", "created_at"];
    $csv_filename = "members.csv";
  } else if ($_GET["what"] == "trainers") {
    $sql = "SELECT * FROM trainers";
    $csv_cols = ["trainer_id", "first_name", "last_name", "email", "phone_number", "created_at"];
    $csv_filename = "trainers.csv";
  } else {
    echo "Pokušajte ponovo";
    die();
  }
}

$run = $conn->query($sql);
$results = $run->fetch_all(MYSQLI_ASSOC);

$output = fopen('php://output', 'w');

// Postavi zaglavlje za preuzimanje CSV datoteke
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename=' . $csv_filename);
fputcsv($output, $csv_cols, ";", ' ');

foreach ($results as $result) {

  $formatted_result = array_map(function ($value) {
    return is_numeric($value) ? "'" . $value . "'" : $value;
  }, $result);

  fputcsv($output, array_values($formatted_result), ";", " ");
}

fclose($output);
