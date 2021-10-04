<?php
if ($_SESSION['authority'] == "" ){ 
  exit('<div class="alert alert-danger" role="alert">Yetersiz yetki</div>
  <meta http-equiv="refresh" content="3;index.php">');

   }else{

    if ($_GET['process'] == "1" ){    
      include 'pagesa/dataset1.php';
                                }
    elseif ($_GET['process'] == "2" ){
      include 'pagesa/dataset2.php';
                                     }

}
              ?>