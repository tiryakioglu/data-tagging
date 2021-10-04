<?php
if ($_SESSION['authority'] == "" ){ 
  exit('<div class="alert alert-danger" role="alert">Yetersiz yetki</div>
  <meta http-equiv="refresh" content="3;index.php">');

   }

              ?>
              <div class="container px-5 my-5">
<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th scope="col">Veri Seti NO</th>
      <th scope="col">Veri Seti Adı</th>
      <th scope="col">Başlangıç</th>
      <th scope="col">Bitiş</th>
      <th scope="col">İşlem</th>
    </tr>
  </thead>
  <tbody>
    <?php

$sql = "SELECT dataset_id, name, start_date , end_date FROM dataset WHERE start_date < now() and end_date >  now()";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr>
    <td>" . $row["dataset_id"]. " 
    </td><td>" . $row["name"]. "
    </td><td>" . $row["start_date"]. " 
    </td><td>" . $row["end_date"]. " </td>
    <td><a href=\"index.php?page=dataset&process=2&datasetid=". $row['dataset_id'] ." \" >
    <button type=\"button\" class=\"btn btn-primary\" >
    <i class=\"bi bi-tag\"></i>
 </button>
        </a>
        </td>
    </tr>";
  }
} else {
  echo "0 results";
}
$conn->close();


    ?>
  </div>