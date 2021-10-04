<?php
if ($_SESSION['authority'] != "5" ){ 
  exit('<div class="alert alert-danger" role="alert">Yetersiz yetki</div>
  <meta http-equiv="refresh" content="3;index.php">');

   }

              ?>
<div class="container px-5 my-5">
<form class="row g-3" action="index.php?page=add-dataset&process=2" method="post">
<div class="mb-3">
  <label for="formcontroldataset" class="form-label">Veri Seti Adı</label>
  <input type="text" class="form-control" id="formcontroldataset" name="datasetname" placeholder="Veri Seti Adı" required>
</div>
<div class="mb-3">
  <label for="formcontrolstart" class="form-label">Başlangıç Tarihi</label>
  <input type="datetime-local" class="form-control" id="formcontrolstart" name="startdate" placeholder="Başlangıç Tarihi" required>
</div>
<div class="mb-3">
  <label for="formcontrolend" class="form-label">Bitiş Tarihi</label>
  <input type="datetime-local" class="form-control" id="formcontrolend" name="enddate" placeholder="Bitiş Tarihi" required>
</div>
<div class="mb-3">
  <label for="formcontrolend" class="form-label">Veri Seti Tipi</label>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="dstype" id="flexRadioDefault1" value="1"  checked>
  <label class="form-check-label" for="flexRadioDefault1">
    Metin
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="dstype" id="flexRadioDefault2" value="2">
  <label class="form-check-label" for="flexRadioDefault2">
    Grafik
  </label>
</div>
</div>
<div class="mb-3">
  <label for="formcontrolaciklama" class="form-label">Açıklama</label>
  <textarea class="form-control" id="formcontrolaciklama" name="dscomment" rows="3" required></textarea>
</div>
<div class="mb-3">
  <button class="btn btn-primary" type="submit">> Adım 2</button>
</div>
</form>
</div>
