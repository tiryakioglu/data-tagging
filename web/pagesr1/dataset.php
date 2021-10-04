<?php
if ($_SESSION['authority'] == "66" ){ 
  exit('<div class="alert alert-danger" role="alert">Yetersiz yetki</div>
  <meta http-equiv="refresh" content="3;index.php">');

   }else{

    if ($_GET['process'] == "1" ){    
      include 'pagesr2/dataset1.php';
                                }
    elseif ($_GET['process'] == "2" ){
      include 'pagesr2/dataset2.php';
                                     }
    elseif ($_GET['process'] == "3" ){
     include 'pagesr2/dataset3.php';
                                     }

}
              ?>