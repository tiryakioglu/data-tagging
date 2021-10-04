<?php
if ($_SESSION['authority'] != "5" ){ 
  exit('<div class="alert alert-danger" role="alert">Yetersiz yetki</div>
  <meta http-equiv="refresh" content="3;index.php">');

   }

   $tagname = $_POST['tagname'];
   $datasetid = $_GET['datasetid'];
   $tagid = $_GET['tagid'];
   $stmt = $conn->prepare("UPDATE data_tag SET tagname= ?  WHERE tagid = ?");
   $stmt->bind_param('si', $btagname, $btagid);
    // set parameters and execute
    $btagname = $tagname;
    $btagid = $tagid;
    $stmt->execute();
    $stmt->close();
  echo('<div class="alert alert-success" role="alert">Etiket Güncellendi</div>
  <meta http-equiv="refresh" content="3;index.php?page=add-tag&process=2&datasetid='.$datasetid.'">');
              ?>
 