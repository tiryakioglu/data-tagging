

<?php
$datasetid = $_GET['datasetid'];
$dsmainarray = array();
$dsbassarr = array();
//rapor indir
$query = "SELECT COUNT(name) as countname  FROM dataset WHERE dataset_id = ? AND end_date <  now()";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("i", $datasetid);
  $stmt->execute();
  $stmt->bind_result($tarihgectimi);
  $stmt->fetch();
  $stmt->close();
//rapor indir

if($tarihgectimi > 0){
    echo '<div class="d-flex justify-content-center">
    <a href="uploads/rapor'.$datasetid.'.csv" download>
<button type="button" class="btn btn-success btn-lg btn-block" >
<i class="bi bi-cloud-download"></i> Raporu İndir
</button>
</a> </div>';

}else{
    echo '<div class="container px-5 my-5">
    <div class="alert alert-danger" role="alert">
         Etiketleme tarihi bitmediği için rapor oluşturulmadı.</div>
    </div>';

}

 //basliklari cek
 $query = "SELECT datas FROM datas WHERE dataset_id = ? AND datarow = 1 ";
 $stmt = $conn->prepare($query);
 $stmt->bind_param("i", $datasetid);
 $stmt->execute();
 $stmt->bind_result($basdatas);
 $bascount = 0;
 while ($stmt->fetch()) {
    $bascount++;
    array_push($dsbassarr,$basdatas);
 }
 $stmt->close();
 array_push($dsbassarr,"Etiket");
 foreach ($dstags as $key => $val) {
 }
 $key1 = 2;
 $key2 = 3;
 //basliklari cek
?>
<div class="container px-5 my-5">
<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th scope="col">Veri</th>
      <th scope="col">Veri ID</th>
      <th scope="col">Etiket</th>
      <?php
       
      $query = "SELECT tagid,tagname FROM data_tag WHERE dataset_id = ? AND tagrow != 1 order by tagid asc ";
      $stmt = $conn->prepare($query);
      $stmt->bind_param("i", $datasetid);
      $stmt->execute();
      $stmt->bind_result($tagid,$tagname);
      while ($stmt->fetch()) {
         echo ' <th scope="col">'.$tagname.'</th>';
         array_push($dsbassarr,$tagname);
      }
      $stmt->close();
      array_push($dsmainarray,$dsbassarr);
      ?>
    </tr>
  </thead>
  <tbody>
    <?php


 
 //etiketleri cek
$query = "SELECT tagid,tagname FROM data_tag WHERE dataset_id = ? AND tagrow != 1 order by tagid asc  ";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $datasetid);
$stmt->execute();
$stmt->bind_result($tagid,$tagname);
while ($stmt->fetch()) {
    $dstags[$tagid] = $tagname;
}
$stmt->close();

//etiket bilgisi al
   

    function ftagcount($fdatarow, $ftagid) {
        include('ayar.php');
        $query = "SELECT COUNT(tagid) as counttag  FROM datas_tagged WHERE datarow = ? AND tagid = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("ii", $fdatarow,$ftagid);
  $stmt->execute();
  $stmt->bind_result($key1s);
  $stmt->fetch();
  $stmt->close();
  return $key1s;
      }

    

//etiket bilgisi al

//veri bilgisi al


function fvericek($fdataset_id, $fdatacolumn,$fdatarow) {
    include('ayar.php');
    $query = "SELECT datas FROM datas WHERE dataset_id = ? AND datacolumn = ? AND datarow = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("iii", $fdataset_id,$fdatacolumn,$fdatarow);
$stmt->execute();
$stmt->bind_result($key1s);
$stmt->fetch();
$stmt->close();
return $key1s;
  }



//veri bilgisi al


//etiketleri cek

$query = "SELECT datas,datarow FROM datas WHERE dataset_id = ? AND datarow != 1 GROUP BY datarow ";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $datasetid);
$stmt->execute();
$stmt->bind_result($datas,$datarow);
$whilei=0;

while ($stmt->fetch()) {
    $whilei++;
    foreach ($dstags as $key => $val) {

        $gettagcount2[$key] =  ftagcount($datarow,$key);
      }
      arsort($gettagcount2);

  echo "<tr>
    <td>" . $datas. "</td>
    <td>" . $datarow. "</td>";
    
      echo '<td>'.$dstags[array_key_first($gettagcount2)].'</td>';
    foreach ($dstags as $key => $val) {

        $gettagcount[$key] =  ftagcount($datarow,$key);
        echo "<td>".$gettagcount[$key]."</td>";
      }
      
   echo "</tr>";

   //array icine al
   $dsarr = array();
   for ($x = 1; $x <= $bascount; $x++) {
    array_push($dsarr,fvericek($datasetid, $x,$datarow));
  }
   array_push($dsarr,$dstags[array_key_first($gettagcount2)]);
    foreach ($dstags as $key => $val) {

        $gettagcount[$key] =  ftagcount($datarow,$key);
        array_push($dsarr,$gettagcount[$key]);
      }
      
      array_push($dsmainarray,$dsarr);
   //array icine al
}
/* close statement */
$stmt->close();
$conn->close();

if($tarihgectimi > 0){
    if (!file_exists('uploads/rapor'.$datasetid.'.csv')){
$dt = fopen('uploads/rapor'.$datasetid.'.csv', 'w');

foreach ($dsmainarray as $alan) {
    fputcsv($dt, $alan);
}

fclose($dt);
}}

    ?></tbody></table >
  </div> 