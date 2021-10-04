<?php
if ($_SESSION['authority'] != "5" ){ 
  exit('<div class="alert alert-danger" role="alert">Yetersiz yetki</div>
  <meta http-equiv="refresh" content="3;index.php">');

   }

              ?>
              <div class="container px-5 my-5">
<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th scope="col">Etiket ID</th>
      <th scope="col">Dataset ID</th>
      <th scope="col">Etiket Adı</th>
      <th scope="col">Duzenle</th>
    </tr>
  </thead>
  <tbody>
    <?php
 $datasetid = $_GET['datasetid'];
$query = "SELECT tagid, dataset_id, tagrow , tagname FROM data_tag WHERE dataset_id = ? AND tagrow != 1 ";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $datasetid);
$stmt->execute();
$stmt->bind_result($rtagid ,$rdataset_id , $rtagrow , $rtagname);

$whilei=0;

while ($stmt->fetch()) {
  echo "<tr>
    <td>" . $rtagid. " 
    </td><td>" . $rdataset_id. "
    </td><td>" . $rtagname. " </td>
    <td><a href=\"index.php?page=add-tag&process=5&datasetid=". $datasetid ."&tagid=". $rtagid ." \" >
    <button type=\"button\" class=\"btn btn-primary\" >
    <i class=\"bi bi-pencil-square\"></i>
 </button>
        </a>
        <a href=\"index.php?page=add-tag&process=7&datasetid=". $datasetid ."&tagid=". $rtagid ." \" >
        <button type=\"button\" class=\"btn btn-danger\" >
        <i class=\"bi bi-x-lg\"></i>
     </button>
            </a>
        </td>
    </tr>";
   
}
/* close statement */
$stmt->close();

$conn->close();



    ?></tbody></table >
  </div> 
  <div class="d-flex justify-content-center">
  <?php
  echo "<a href=\"index.php?page=add-tag&process=3&datasetid=". $datasetid ." \" >
  <button type=\"button\" class=\"btn btn-success btn-lg btn-block\" >
  <i class=\"bi bi-plus-square\"></i> Etiket Ekle
</button>
      </a>";
  
      ?> </div>