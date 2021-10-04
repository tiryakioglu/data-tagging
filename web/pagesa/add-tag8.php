<?php
$datasetid = $_GET['datasetid'];

//dataset var mi
$query = "SELECT count(dataset_id) FROM dataset WHERE dataset_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $datasetid);
$stmt->execute();
$stmt->bind_result($tagcount);
$stmt->fetch();
$stmt->close();
//dataset var mi
if($tagcount == 1){
// prepare and bind
$query = "DELETE FROM data_tag WHERE dataset_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $datasetid);
$stmt->execute();
$stmt->close();
$query = "DELETE FROM datas_tagged WHERE dataset_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $datasetid);
$stmt->execute();
$stmt->close();
$query = "DELETE FROM data_column WHERE dataset_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $datasetid);
$stmt->execute();
$stmt->close();
$query = "DELETE FROM datas WHERE dataset_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $datasetid);
$stmt->execute();
$stmt->close();
$query = "DELETE FROM dataset WHERE dataset_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $datasetid);
$stmt->execute();
$stmt->close();
 echo '<div class="alert alert-success" role="alert">
     Veri seti silindi.</div><meta http-equiv="refresh" content="3;index.php?page=add-tag&process=1">';
 }else{
     echo '<div class="alert alert-danger" role="alert">
     Veri seti bulunamadı.</div><meta http-equiv="refresh" content="3;index.php?page=add-tag&process=1">';
 }
$conn->close();
              ?>
 