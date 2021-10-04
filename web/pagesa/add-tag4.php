<?php
if ($_SESSION['authority'] != "5" ){ 
  exit('<div class="alert alert-danger" role="alert">Yetersiz yetki</div>
  <meta http-equiv="refresh" content="3;index.php">');

   }

   $tagname = $_POST['tagname'];
   $datasetid = $_GET['datasetid'];
   $query = "SELECT MAX(tagrow) as maxtagrow FROM data_tag WHERE dataset_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $datasetid);
$stmt->execute();
$stmt->bind_result($maxtagrow);
$stmt->fetch();

if($maxtagrow >= 0)
{
  $amaxtagrow = $maxtagrow + 1;
}
else{
  $amaxtagrow = 1;
}

$stmt->close();

   $stmt = $conn->prepare("INSERT INTO data_tag( dataset_id, tagrow, tagname)  VALUES (?, ?, ?)");
   $stmt->bind_param('iis', $bdataset_id, $btagrow, $btagname);
    $bdataset_id = $datasetid;
    $btagrow = $amaxtagrow;
    $btagname = $tagname;
    $stmt->execute();
   
    $last_id = $stmt->insert_id;;
  
  $stmt->close();
  $conn->close();
  echo('<div class="alert alert-success" role="alert">Etiket Eklendi.</div>
  <meta http-equiv="refresh" content="3;index.php?page=add-tag&process=2&datasetid='.$datasetid.'">');
              ?>
 