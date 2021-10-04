<div class="container px-5 my-5"><?php
if ($_SESSION['authority'] != "5" ){ 
  exit('<div class="alert alert-danger" role="alert">Yetersiz yetki</div>
  <meta http-equiv="refresh" content="3;index.php">');

   }
   $datasetid = intval($_GET['datasetid']);
   $dscolumns = $_POST['dscolumns'];
   $kontrol=0;
   $dscolumns = rtrim($dscolumns,",");  
   $columnsa = explode(",", $dscolumns);
   $columnsa = array_unique($columnsa);
   foreach ($columnsa as &$deger) {
    $deger = intval($deger);
    $columnsql .= $deger.",";
    if($deger > 0){
      $kontrol=1;
    }
}

if($kontrol == 1){
  $sql = "UPDATE data_column SET column_status = 0 WHERE dataset_id = $datasetid";

  $conn->query($sql);
  $columnsql = rtrim($columnsql,",");  

  $sql = "UPDATE data_column SET column_status = 1 WHERE dataset_id = $datasetid AND columnr IN($columnsql)";

  if ($conn->query($sql) === TRUE) {
    echo '<div class="alert alert-success" role="alert">
    İşlem Başarılı
  </div><meta http-equiv="refresh" content="3;index.php?page=column&datasetid='.$datasetid.'">';
  } else {
    echo "Error updating record: " . $conn->error;
  }
  
  $conn->close();
  
}else{
  echo '<div class="alert alert-warning" role="alert">
  En az bir sütun gösterilmeli
</div><meta http-equiv="refresh" content="3;index.php?page=column&datasetid='.$datasetid.'">';
}
              ?>


</div>