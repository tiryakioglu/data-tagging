<?php
if ($_SESSION['authority'] != "5" ){ 
  exit('<div class="alert alert-danger" role="alert">Yetersiz yetki</div>
  <meta http-equiv="refresh" content="3;index.php">');

   }

   $datasetid = $_GET['datasetid'];

              ?>
             
             <div class="container px-5 my-5">
<form class="row g-3" action="index.php?page=add-tag&process=4&datasetid=<?=  $datasetid ?>" method="post">
<div class="mb-3">
  <label for="formcontroltag" class="form-label">Etiket Adı</label>
  <input type="text" class="form-control" id="formcontroltag" name="tagname" placeholder="Etiket Adı" required>
</div>
<div class="mb-3">
  <button class="btn btn-primary" type="submit"> Ekle</button>
</div>
</form>
</div>