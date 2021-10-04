<svg style="display: none;">
  <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </symbol>
  <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
  </symbol>
  <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </symbol>
</svg>
<?php
if ($_SESSION['authority'] != "5" ){ 
  exit('<div class="alert alert-danger" role="alert">Yetersiz yetki</div>
  <meta http-equiv="refresh" content="3;index.php">');

   }

   //file upload start
   $last_id = $_POST['dslastid'];
   $dstype = $_POST['dstype'];
   //metin ise
   if($dstype == 1){

if (move_uploaded_file($_FILES['datasetfile']['tmp_name'], "uploads/veriseti-".$last_id.".csv"))
{
  echo('<div class="alert alert-success d-flex align-items-center" role="alert">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
  <div>
   Veriseti dosyası yüklendi
  </div>
 </div>');
} else {
    exit('<div class="alert alert-danger d-flex align-items-center" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
    <div>
     Veriseti dosyası yüklenemedi
    </div>
    </div>');
}


//file upload end

//db yukle
// prepare and bind
$stmt = $conn->prepare("INSERT INTO datas(dataset_id, datas, datarow, datacolumn) VALUES (?, ?, ?, ?)");
$stmt->bind_param('isii', $datasetid, $datas, $datarow, $datacolumn);

$row = 1;

if (($handle = fopen("uploads/veriseti-".$last_id.".csv", "r")) !== FALSE) {
while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
$num = count($data);

for ($c=0; $c < $num; $c++) {

// set parameters and execute
$datas = $data[$c] ;
$datasetid = $last_id;
$datarow = $row;
$datacolumn = $c+1;
$stmt->execute();
}

$row++;
}
fclose($handle);
}
echo('<div class="alert alert-success d-flex align-items-center" role="alert">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
  <div>
   '.($row-2).' satır veri eklendi.
  </div>
 </div>');
$stmt->close();

//db yukle



} else {
//grafik ise

$grafikdizi=array("Message");
//varsa klasoru sil
if (file_exists("uploads/dataset".$last_id."/")){ //dosyalar dizininin içerisinde resimler klasörü mevcut ise
	array_map('unlink', glob("uploads/dataset".$last_id."/*")); //bütün dosyalar siliniyor
	rmdir("uploads/dataset".$last_id."/"); //klasör siliniyor
}
//varsa klasoru sil
$target_dir = "uploads/dataset".$last_id."/";
if (!file_exists($target_dir)) {
  mkdir($target_dir);
  touch($target_dir."index.php");
                                     }

 
 // Count total files
 $countfiles = count($_FILES['fileToUpload']['name']);

 // Looping all files
 for($i=0;$i<$countfiles;$i++){



  //file upload func

  
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"][$i]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"][$i]);
  if($check !== false) {
    echo "<br>File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "<br>File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "<br>Dosya zaten yüklü.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"][$i] > 500000) {
  echo "<br>Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo('<div class="alert alert-danger d-flex align-items-center" role="alert">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
  <div>');
  echo "<br>Yalnızca JPG, JPEG, PNG & GIF dosyalarını yükleyebilirsiniz. Yüklenemeyen dosya:  <strong>".$_FILES["fileToUpload"]["name"][$i];
  echo('
  </strong> </div>
  </div>');
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  // echo "<br>Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file)) {
   // echo "<br>The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"][$i])). " has been uploaded.";
    array_push($grafikdizi,$_FILES["fileToUpload"]["name"][$i]);
  } else {
    echo "<br>Sorry, there was an error uploading your file.";
  }
}

  //file upload

 
 }

 //grafikleri db yukle
//db yukle
// prepare and bind
$stmt = $conn->prepare("INSERT INTO datas(dataset_id, datas, datarow, datacolumn) VALUES (?, ?, ?, ?)");
$stmt->bind_param('isii', $datasetid, $datas, $datarow, $datacolumn);

  $i = 0;
  $c = count($grafikdizi);
 while ($i < $c) {
    // set parameters and execute
$datas = $grafikdizi[$i] ;
$datasetid = $last_id;
$datarow = $i+1;
$datacolumn = 1;
$stmt->execute();
    $i++;
 }
 echo('<div class="alert alert-success d-flex align-items-center" role="alert">
 <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
 <div>
  '.($c-1).' grafik eklendi.
 </div>
</div>');
$stmt->close();
 //grafikleri db yukle

}
//etiketleri yukle
if($_FILES['dstagfile']['size'] > 0) {
  if (move_uploaded_file($_FILES['dstagfile']['tmp_name'], "uploads/etiket-".$last_id.".csv"))
{
  echo('<div class="alert alert-success d-flex align-items-center" role="alert">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
  <div>
   Etiket dosyası yüklendi
  </div>
 </div>');
} else {
  exit('<div class="alert alert-danger d-flex align-items-center" role="alert">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
  <div>
   Etiket dosyası yüklenemedi
  </div>
  </div>');
}
  

  

  //etiket db yukle
//db yukle
// prepare and bind
$stmt = $conn->prepare("INSERT INTO data_tag( dataset_id, tagrow, tagname) VALUES (?, ?, ?)");
$stmt->bind_param('iis', $datasetid, $tagrow, $tagname);

$row = 1;

if (($handle = fopen("uploads/etiket-".$last_id.".csv", "r")) !== FALSE) {
while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
$num = count($data);

for ($c=0; $c < $num; $c++) {

// set parameters and execute
$tagname = $data[$c] ;
$datasetid = $last_id;
$tagrow = $row;
$stmt->execute();
}

$row++;
}
fclose($handle);
}
$stmt->close();
echo('<div class="alert alert-success d-flex align-items-center" role="alert">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
  <div>
   '.($row-2).' etiket eklendi.
  </div>
 </div>');
}
//etiketleri yukle


$query = "SELECT `datas`, `datacolumn` FROM `datas` WHERE dataset_id = ? AND datarow = 1";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $last_id);
$stmt->execute();
$stmt->bind_result($rdatas ,$rdatacolumn);

$adatacolumn = array();
$adatas = array();
$acount = 0 ;
while ($stmt->fetch()) {
  array_push($adatas,$rdatas);
  array_push($adatacolumn,$rdatacolumn);
  $acount++;
}
/* close statement */
$stmt->close();



$i = 0;
while ($i < $acount) {
  if($i == 0){
    $ctatus = 1;
  }
  else{
    $ctatus = 0;
  }
   $sql = "INSERT INTO data_column(dataset_id, columnr, column_name, column_status) VALUES  (".$last_id.",".$adatacolumn[$i].",'".$adatas[$i]."',$ctatus) ";
if ($conn->query($sql) === TRUE) {
 //basarili
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
   $i++;
}

//etiket var mi
$query = "SELECT count(dataset_id) FROM data_tag WHERE dataset_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $last_id);
$stmt->execute();
$stmt->bind_result($tagcount);
$stmt->fetch();
$stmt->close();
//etiket var mi
//etiket yoksa ekle
if($tagcount == 0){
  $sql = "INSERT INTO data_tag( dataset_id, tagrow, tagname)  VALUES ($last_id, 1, 'Etiket')";

if ($conn->query($sql) === TRUE) {
  //echo "New record created successfully";
} else {
  //echo "Error: " . $sql . "<br>" . $conn->error;
}

}

//etiket yoksa eklle


$conn->close();


              ?>
