<?php
if ($_SESSION['authority'] != "5" ){ 
  exit('<div class="alert alert-danger" role="alert">Yetersiz yetki</div>
  <meta http-equiv="refresh" content="3;index.php">');

   }

              ?>
              <div class="table-responsive">
<table class="table align-middle table-striped table-bordered">
  <thead>
    <tr >
      <th scope="col">Veri Seti NO</th>
      <th scope="col">Veri Seti Adı</th>
      <th scope="col">Başlangıç</th>
      <th scope="col">Bitiş</th>
      <th scope="col">İşlemler</th>
    </tr>
  </thead>
  <tbody>
    <?php

$sql = "SELECT dataset_id, name, start_date , end_date FROM dataset";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr>
    <td>" . $row["dataset_id"]. " 
    </td><td>" . $row["name"]. "
    </td><td>" . $row["start_date"]. " 
    </td><td>" . $row["end_date"]. " </td>
    <td><a href=\"index.php?page=add-tag&process=2&datasetid=". $row['dataset_id'] ." \" >Etiket</a> 
    / <a href=\"index.php?page=column&datasetid=". $row['dataset_id'] ." \" >Sütun</a>
    / <a href=\"index.php?page=rapor&datasetid=". $row['dataset_id'] ." \" >Rapor</a> 
    / <a href=\"index.php?page=add-tag&process=8&datasetid=". $row['dataset_id'] ."\" onclick=\"return confirm('" . $row["name"]. " veri setini sil')\">Sil</a>
        </td>
    </tr>";
  }
} else {
  echo "0 results";
}
$conn->close();


    ?>
  </div>