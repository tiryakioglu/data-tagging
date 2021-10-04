<?php
if ($_SESSION['authority'] != "5" ){ 
  exit('<div class="alert alert-danger" role="alert">Yetersiz yetki</div>
  <meta http-equiv="refresh" content="3;index.php">');

   }

   $datasetid = $_GET['datasetid'];
   $tagid = $_GET['tagid'];
    $query = "SELECT tagname FROM data_tag WHERE tagid = ?";
   $stmt = $conn->prepare($query);
   $stmt->bind_param("i",  $tagid);
   $stmt->execute();
   $stmt->bind_result($tagname);
   $stmt->fetch();
   $stmt->close();

              ?>
             
             <div class="container px-5 my-5">
<form class="row g-3" action="index.php?page=add-tag&process=6&datasetid=<?=  $datasetid ?>&tagid=<?=  $tagid ?>" method="post">
<div class="mb-3">
  <label for="formcontroltag" class="form-label">Etiket Adı</label>
  <input type="text" class="form-control" id="formcontroltag" name="tagname" placeholder="Etiket Adı" value="<?=$tagname ?>" required>
</div>
<div class="mb-3">
  <button class="btn btn-primary" type="submit"> Güncelle</button>
</div>
</form>
</div>