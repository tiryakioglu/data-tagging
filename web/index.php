<?php
error_reporting(E_ERROR | E_PARSE);
ob_start();
session_start();
if ($_SESSION['authority'] > '0'){
require_once('ayar.php');
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Dataset</title>
  <link rel="stylesheet" href="dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="dist/font/bootstrap-icons.css">
  <script
  src="dist/js/jquery-3.6.0.min.js" ></script>
  <script src="dist/js/bootstrap.bundle.min.js"></script>
   <style>
@media (min-width: 576px) {
    .h-sm-100 {
        height: 100%;
    }
}
</style>
</head>

<body>

<div class="container-fluid overflow-hidden">
    <div class="row vh-100 overflow-auto">
        <div class="col-12 col-sm-3 col-xl-2 px-sm-2 px-0 bg-dark d-flex sticky-top">
            <div class="d-flex flex-sm-column flex-row flex-grow-1 align-items-center align-items-sm-start px-3 pt-2 text-white">
                <a href="index.php" class="d-flex align-items-center pb-sm-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-5">D<span class="d-none d-sm-inline">ataset</span></span>
                </a>
                <ul class="nav nav-pills flex-sm-column flex-row flex-nowrap flex-shrink-1 flex-sm-grow-0 flex-grow-1 mb-sm-auto mb-0 justify-content-center align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link px-sm-0 px-2">
                            <i class="fs-5 bi-house"></i><span class="ms-1 d-none d-sm-inline">Anasayfa</span>
                        </a>
                    </li>
                    <?php if ($_SESSION['authority'] == '5'){ ?>
                    <li>
                        <a href="index.php?page=add-dataset&process=1"  class="nav-link px-sm-0 px-2">
                            <i class="fs-5 bi-folder-plus"></i><span class="ms-1 d-none d-sm-inline">Veriseti Ekle</span> </a>
                    </li>
                    <li>
                        <a href="index.php?page=add-tag&process=1" class="nav-link px-sm-0 px-2">
                            <i class="fs-5 bi-briefcase"></i><span class="ms-1 d-none d-sm-inline">Verisetleri</span></a>
                    </li>
                    <li>
                        <a href="index.php?page=users" class="nav-link px-sm-0 px-2">
                            <i class="fs-5 bi-people"></i><span class="ms-1 d-none d-sm-inline">Kullanıcılar</span></a>
                    </li> <?php } ?>
                    <li>
                        <a href="index.php?page=dataset&process=1" class="nav-link px-sm-0 px-2">
                            <i class="fs-5 bi-tag"></i><span class="ms-1 d-none d-sm-inline">Etiketle</span></a>
                    </li>
                </ul>
                <div class="dropdown py-sm-4 mt-sm-auto ms-auto ms-sm-0 flex-shrink-1">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="dist/images/user.png" alt="hugenerd" width="28" height="28" class="rounded-circle">
                        <span class="d-none d-sm-inline mx-1"><?php
		echo $_SESSION['username'];
              ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="cikis.php">Çıkış Yap</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col d-flex flex-column h-sm-100">
            <main class="row overflow-auto">
                <div class="col pt-4">
                <?php
	$page= isset($_GET['page']) ? $_GET['page'] : '';
				if($page == ''){
            include('pages/home.php');
				}else{
					if(file_exists('pages/' . $page.'.php')){
						include('pages/' . $page.'.php');
					}else{
						echo 'Sayfa Bulunamadı.';
					}
				
				}	
              ?>
                   
                  </div>
            </main>
            
        </div>
    </div>
</div>






</body>
</html>
<?php
		}else{  header("Location:giris.php");
					}	
              ?>