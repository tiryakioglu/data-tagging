<?php
if ($_SESSION['authority'] != "5" ){ 
  exit('<div class="alert alert-danger" role="alert">Yetersiz yetki</div>
  <meta http-equiv="refresh" content="3;index.php">');

   }

              ?>
<div class="container px-5 my-5">
<form  action="index.php?page=columndb&process=5" method="post" id="form-main">
<?php
 $datasetid = intval($_GET['datasetid']);
$query = "SELECT columnid, dataset_id, columnr , column_name , column_status FROM data_column WHERE dataset_id = ? ";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $datasetid);
$stmt->execute();
$stmt->bind_result($rcolumnid ,$rdataset_id , $rcolumnr , $rcolumn_name , $rcolumn_status);



while ($stmt->fetch()) {
  $rcolumnh = "";
  $rcolumns = "";
  if($rcolumn_status == 0){
    $rcolumnh = "checked";
  }
  else{$rcolumns = "checked";}
  echo '<div class="mb-1">
  <label for="formcontroldataset" class="form-label">'.$rcolumn_name.'</label>
<br>
<input type="radio" class="btn-check" name="sutun'.$rcolumnid.'" value="'.$rcolumnr.'"  id="tag1'.$rcolumnid.'" autocomplete="off" '.$rcolumns.'>
<label class="btn btn-outline-primary" for="tag1'.$rcolumnid.'">Göster</label>
 / 
<input type="radio" class="btn-check" name="sutun'.$rcolumnid.'" value="0" id="tag0'.$rcolumnid.'" autocomplete="off" '.$rcolumnh.'>
<label class="btn btn-outline-primary" for="tag0'.$rcolumnid.'">Gizle</label>

</div>';
}
/* close statement */
$stmt->close();

$conn->close();



    ?>
</form>

<form  action="index.php?page=columndb&datasetid=<?=  $datasetid ?>" method="post" >
<input type="hidden" id="dscolumns" name="dscolumns"><br><br>
<div class="mb-3">
  <button class="btn btn-primary" type="submit">Kaydet</button><span style="visibility: hidden;" id="results"></span>
</div>


<script>
  function showValues() {
    var fields = $( "#form-main :input" ).serializeArray();
    $( "#results" ).empty();
    jQuery.each( fields, function( i, field ) {
      $( "#results" ).append( field.value + "," );
    });
    document.getElementById("dscolumns").value = $('#results').html();
  }
 
 
  $( ":checkbox, :radio" ).click( showValues );
  
  showValues();
</script> 