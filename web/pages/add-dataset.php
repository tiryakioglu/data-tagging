<?php
if ($_SESSION['authority'] != "5" ){ 
  exit('<div class="alert alert-danger" role="alert">Yetersiz yetki</div>
  <meta http-equiv="refresh" content="3;index.php">');

   }else{

    if ($_GET['process'] == "1" ){    
      include 'pagesa/add-dataset1.php';
                                }
    elseif ($_GET['process'] == "2" ){
      include 'pagesa/add-dataset2.php';
                                     }
    elseif ($_GET['process'] == "3" ){
     include 'pagesa/add-dataset3.php';
                                     }
     elseif ($_GET['process'] == "4" ){
      include 'pagesa/add-dataset4.php';
                                       }
    elseif ($_GET['process'] == "5" ){
      include 'pagesa/add-dataset5.php';
                                                                         }

}
              ?>