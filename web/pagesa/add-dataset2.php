<?php
if ($_SESSION['authority'] != "5" ){ 
  exit('<div class="alert alert-danger" role="alert">Yetersiz yetki</div>
  <meta http-equiv="refresh" content="3;index.php">');

   }

  // /*   
   $datasetname = $_POST['datasetname'];
   $startdate = $_POST['startdate'];
   $enddate = $_POST['enddate'];
   $dscomment = $_POST['dscomment'];
   $dstype = $_POST['dstype'];

   // prepare and bind
   $stmt = $conn->prepare("INSERT INTO dataset( name, dscomment, start_date, end_date, dataset_type)  VALUES (?, ?, ?, ?, ?)");
   $stmt->bind_param('ssssi', $bdatasetname, $bdscomment, $bstartdate, $benddate, $bdstype);
    // set parameters and execute
    $bdatasetname = $datasetname;
    $bstartdate = $startdate;
    $benddate = $enddate;
    $bdscomment = $dscomment;
    $bdstype = $dstype;
    $stmt->execute();
   
    $last_id = $stmt->insert_id;;
  
  $stmt->close();
  $conn->close();

    // */

    if($dstype == 1){
              ?>
 <div class="container px-5 my-5">
     
<form class="row g-3" action="index.php?page=add-dataset&process=3" method="post" enctype="multipart/form-data">
<div class="mb-3">
  <label for="formcontroldataset" class="form-label">Veri Seti Dosyası</label>
  <input type="file" class="form-control" id="formcontroldataset" name="datasetfile" placeholder="Veri Seti Dosyası" required>
</div>
<div class="mb-3">
  <label for="formcontroltag" class="form-label">Etiket Dosyası</label>
  <input type="file" class="form-control" id="formcontroltag" name="dstagfile" placeholder="Etiket Dosyası">
</div>
<input type="hidden" name="dslastid"  value="<?=$last_id ?>" >
<input type="hidden" name="dstype"  value="<?=$dstype ?>" >

<div class="mb-3">
  <button class="btn btn-primary" type="submit">> Adım 3</button>
</div>
</form>
</div>

<?php
}else {

?>

<div class="container px-5 my-5">
     
     <form class="row g-3" action="index.php?page=add-dataset&process=3" method="post" enctype="multipart/form-data">
     <div class="mb-3">
       <label for="formcontroldataset" class="form-label">Grafik Dosyaları</label>
       <input type="file" class="form-control" id="formcontroldataset" name="fileToUpload[]" placeholder="Grafik Dosyaları" required multiple>
     </div>
     <div class="mb-3">
       <label for="formcontroltag" class="form-label">Etiket Dosyası</label>
       <input type="file" class="form-control" id="formcontroltag" name="dstagfile" placeholder="Etiket Dosyası">
     </div>
     <input type="hidden" name="dslastid"  value="<?=$last_id ?>" >
     <input type="hidden" name="dstype"  value="<?=$dstype ?>" >
     
     <div class="mb-3">
       <button class="btn btn-primary" type="submit">> Adım 3</button>
     </div>
     </form>
     </div>



<?php
}
?>