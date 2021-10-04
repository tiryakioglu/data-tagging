<?php
if ($_SESSION['authority'] == "" ){ 
  exit('<div class="alert alert-danger" role="alert">Yetersiz yetki</div>
  <meta http-equiv="refresh" content="3;index.php">');

   }

           
$dataidsql = " ";
 $datasetid = $_GET['datasetid'];
 $dataid = $_GET['dataid'];
 $ciktikontrol = 0;

 //veriyi etiketle baslangic
 if (isset($_GET['edatarow'],$_GET['etagid'])) {
    //daha once etikenlenmismi
    $query = "SELECT count(tagid) FROM `datas_tagged` WHERE dataset_id = ?  AND userid = ? AND datarow = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iii", $datasetid, $_SESSION['userid'], $_GET['edatarow']);
    $stmt->execute();
    $stmt->bind_result($rcountdatatagged);
    $stmt->fetch();
    $stmt->close();
    //daha once etikenlenmismi bitis
if($rcountdatatagged==0){
  $stmt = $conn->prepare("INSERT INTO datas_tagged(dataset_id, datarow, userid, tagid) VALUES (?, ?, ?, ?)");
  $stmt->bind_param('iisi', $datasetid, $_GET['edatarow'],  $_SESSION['userid'], $_GET['etagid']);
   // set parameters and execute
   $bdatasetname = $datasetname;
   $bstartdate = $startdate;
   $benddate = $enddate;
   $bdscomment = $dscomment;
   $bdstype = $dstype;
   $stmt->execute();
  
   $last_id = $stmt->insert_id;;
 
 $stmt->close();
}
 }
  //veriyi etiketle bitis


 if (isset($dataid)) {
  $dataidsql = "dataid >=".intval($dataid)." AND ";
   //belirtilen id veritabaninda varmi 
   $query = "SELECT count(datarow) FROM datas WHERE ".$dataidsql." dataset_id = ? 
   and datarow NOT IN(SELECT datarow FROM datas_tagged WHERE userid = ? and dataset_id = ?) AND datarow NOT IN(1) ORDER BY dataid ASC";
   $stmt = $conn->prepare($query);
   $stmt->bind_param("isi", $datasetid, $_SESSION['userid'], $datasetid);
   $stmt->execute();
   $stmt->bind_result($rcountdataid);
   $stmt->fetch();
   $stmt->close();
   //kontrol bitis
   if ($rcountdataid == 0) {
  $dataidsql = " ";
}
}else{
  $dataidsql = " ";
}
//dataset tip kontrol
//kullanici var mi
$query = "SELECT dataset_type FROM dataset WHERE dataset_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $datasetid);
$stmt->execute();
$stmt->bind_result($dataset_type);
$stmt->fetch();
$stmt->close();
//dataset tip kontrol
$query = "SELECT dataid, dataset_id, datas , datarow , datacolumn FROM datas WHERE ".$dataidsql." dataset_id = ? 
and datarow NOT IN(SELECT datarow FROM datas_tagged WHERE userid = ? and dataset_id = ?) AND datarow NOT IN(1) AND datacolumn IN(SELECT columnr FROM data_column WHERE column_status = 1 AND dataset_id = ?) ORDER BY dataid ASC";
$stmt = $conn->prepare($query);
$stmt->bind_param("isii", $datasetid, $_SESSION['userid'], $datasetid, $datasetid);
$stmt->execute();
$stmt->bind_result($rdataid ,$rdataset_id , $rdatas , $rdatarow , $rdatacolumn);


$oldrdatarow =0;
$whilei=0;
$ciktiveriler = "";
while ($stmt->fetch()) {
  $whilei++;
  if($whilei == 1){
    $oldrdatarow = $rdatarow;
  }
  if($dataset_type == 2){
    $rdatas = '<img src="uploads/dataset'.$datasetid.'/'.$rdatas.'" style="display: block;margin-left: auto;margin-right: auto;width: 100%;max-width: 500px;height: auto;" alt="Responsive image">';
  }

    if($rdatarow == $oldrdatarow){
    $ciktiveriler .= "<div class=\"overflow-auto\">" . $rdatas. "</div>";
    }else{$rdataid2=$rdataid;
      break;}
  
  
}

/* close statement */
$stmt->close();



//etiketleri listele
$query = "SELECT tagid, dataset_id, tagrow , tagname  FROM data_tag WHERE dataset_id = ? AND tagrow NOT IN(1)";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $datasetid);
$stmt->execute();
$stmt->bind_result($rtagid ,$rdataset_id , $rtagrow , $rtagname);


$ciktietiketler = "<div class=\"overflow-auto d-flex justify-content-center\"> ";
while ($stmt->fetch()) {
    $ciktietiketler .= "<a href=\"index.php?page=dataset&process=2&datasetid=". $datasetid ."&dataid=$rdataid2&edatarow=$oldrdatarow&etagid=$rtagid \" >
    <button type=\"button\" class=\"btn btn-primary \" >
    ".$rtagname."
  </button>
        </a>&nbsp;";
  
  
}
$ciktietiketler .= "<a href=\"index.php?page=dataset&process=2&datasetid=". $datasetid ."&dataid=$rdataid2\" >
<button type=\"button\" class=\"btn btn-secondary \" >
Pas
</button>
    </a></div>";
/* close statement */
$stmt->close();

//etiketleri listele bitis

//sayfalama 
$query = "SELECT dataid, dataset_id, datas , datarow , datacolumn FROM datas WHERE dataset_id = ? 
and datarow NOT IN(SELECT datarow FROM datas_tagged WHERE userid = ? and dataset_id = ?)  AND datarow NOT IN(1) GROUP BY datarow ORDER BY dataid ASC";
$stmt = $conn->prepare($query);
$stmt->bind_param("isi", $datasetid, $_SESSION['userid'], $datasetid);
$stmt->execute();
$stmt->bind_result($rdataid ,$rdataset_id , $rdatas , $rdatarow , $rdatacolumn);



$whilei=0;
$ciktisayfalar = "";
while ($stmt->fetch()) {
  $whilei++;
  $ciktisayfalar .= "<a href=\"index.php?page=dataset&process=2&datasetid=". $datasetid ."&dataid=$rdataid \" >
  <button type=\"button\" class=\"btn btn-success \" >
  ".$whilei."
</button>
      </a>&nbsp;";
  
}
if($whilei ==0){$ciktikontrol = 1;}

/* close statement */
$stmt->close();
//sayfalama

$conn->close();



    ?>
    <div class="container px-5 my-5" >
  <?php
  if($ciktikontrol ==0){
  echo $ciktiveriler;
      ?>
    </div> 
    <div class="container px-5 my-5" > 
    <?php
  echo $ciktietiketler;
      ?></div>
      <div class="container px-5 my-5">  
      <div class="overflow-auto d-flex justify-content-center"> 
      <?php
    echo $ciktisayfalar;
  }else{echo " <div class='overflow-auto d-flex justify-content-center'>Etiketlenebilecek veri kalmadı. ";}
        ?> </div></div>