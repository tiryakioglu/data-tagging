<?php
$tagid = $_GET['tagid'];
$datasetid = $_GET['datasetid'];

$query = "SELECT count(tagid) FROM data_tag WHERE tagid = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $tagid);
$stmt->execute();
$stmt->bind_result($tagcount);
$stmt->fetch();
$stmt->close();
if($tagcount == 1){
// prepare and bind
$query = "DELETE FROM data_tag WHERE tagid = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $tagid);
$stmt->execute();
$stmt->close();
$query = "DELETE FROM datas_tagged WHERE tagid = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $tagid);
$stmt->execute();
$stmt->close();
 echo '<div class="alert alert-success" role="alert">
     Etiket silindi.</div><meta http-equiv="refresh" content="3;index.php?page=add-tag&process=2&datasetid='.$datasetid.'">';
 }else{
     echo '<div class="alert alert-danger" role="alert">
     Etiket bulunamadı.</div><meta http-equiv="refresh" content="3;index.php?page=add-tag&process=2&datasetid='.$datasetid.'">';
 }
$conn->close();
              ?>
 