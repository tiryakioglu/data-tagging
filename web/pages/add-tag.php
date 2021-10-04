<?php
if ($_SESSION['authority'] != "5" ){ 
  exit('<div class="alert alert-danger" role="alert">Yetersiz yetki</div>
  <meta http-equiv="refresh" content="3;index.php">');

   }else{

    if ($_GET['process'] == "1" ){    
      include 'pagesa/add-tag1.php';
                                }
    elseif ($_GET['process'] == "2" ){
      include 'pagesa/add-tag2.php';
                                     }
    elseif ($_GET['process'] == "3" ){
     include 'pagesa/add-tag3.php';
                                     }
    elseif ($_GET['process'] == "4" ){
      include 'pagesa/add-tag4.php';
                                     }
    elseif ($_GET['process'] == "5" ){
      include 'pagesa/add-tag5.php';
                                     }
    elseif ($_GET['process'] == "6" ){
      include 'pagesa/add-tag6.php';
                                     }
    elseif ($_GET['process'] == "7" ){
      include 'pagesa/add-tag7.php';
                                      }
    elseif ($_GET['process'] == "8" ){
     include 'pagesa/add-tag8.php';
                                     }

}
              ?>