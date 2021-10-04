<?php
if ($_SESSION['authority'] == "66" ){ 
  exit('<div class="alert alert-danger" role="alert">Yetersiz yetki</div>
  <meta http-equiv="refresh" content="3;index.php">');

   }

$sql = "SELECT dataset_id, name, start_date , end_date FROM dataset WHERE start_date < now() and end_date >  now()";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  $response['Datasets'] = array();
  while($row = $result->fetch_assoc()) {
    $datasets = array();
    $datasets['dataset_id'] = $row["dataset_id"];
    $datasets['name'] = $row["name"];
    $datasets['start_date'] = $row["start_date"];
    $datasets['end_date'] = $row["end_date"];

   array_push($response['Datasets'], $datasets);
  }
  $response['success'] = 1;
  echo json_encode($response);
} else {
  echo "0 results";
}
$conn->close();


    ?>