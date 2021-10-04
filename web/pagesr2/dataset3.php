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
      <th scope="col">Veri Seti NO</th>
      <th scope="col">Veri Seti Adı</th>
      <th scope="col">Başlangıç</th>
      <th scope="col">Bitiş</th>
      <th scope="col">Duzenle</th>
    </tr>
  </thead>
  <tbody>
    <?php

 $datasetid = $_GET['datasetid'];
 $dataid = $_GET['dataid'];
 if (isset($dataid)) {
  $dataidsql = "dataid >=".intval($dataid)." AND ";
}else{
  $dataidsql = " ";
}
$query = "SELECT dataid, dataset_id, datas , datarow , datacolumn FROM datas WHERE ".$dataidsql." dataset_id = ? 
and dataid NOT IN(SELECT dataid FROM datas_tagged WHERE userid = ? and dataset_id = ?) ORDER BY dataid ASC";
$stmt = $conn->prepare($query);
$stmt->bind_param("isi", $datasetid, $_SESSION['userid'], $datasetid);
$stmt->execute();
$stmt->bind_result($rdataid ,$rdataset_id , $rdatas , $rdatarow , $rdatacolumn);



$whilei=0;

while ($stmt->fetch()) {
  $whilei++;
  if($whilei == 1){
  echo "<tr>
    <td>" . $rdataid. " 
    </td><td>" . $rdataset_id. "
    </td><td>" . $rdatas. " 
    </td><td>" . $rdatarow. " </td>
    <td><a href=\"index.php?page=add-tag&process=3&datasetid=". $datasetid ." \" >
    <button type=\"button\" class=\"btn btn-primary\" >
    <i class=\"bi bi-pencil-square\"></i>
 </button>
        </a>
        </td>
    </tr>";
  }
    
    if ($whilei == 2) {
      break;  
  }
}

/* close statement */
$stmt->close();

$conn->close();



    ?></tbody></table >
  </div> 
  <div class="d-flex justify-content-center">
  <?php
  echo "<a href=\"index.php?page=add-tag&process=3&datasetid=". $datasetid ." \" >
  <button type=\"button\" class=\"btn btn-success \" >
  1
</button>
      </a> 
      <a href=\"index.php?page=add-tag&process=3&datasetid=". $datasetid ." \" >
  <button type=\"button\" class=\"btn btn-success  \" >
 2
</button>
      </a>";
  
      ?> </div>