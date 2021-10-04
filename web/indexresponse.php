<?php
error_reporting(E_ERROR | E_PARSE);
ob_start();
session_start();
require_once('ayar.php');
if ($_SESSION['authority'] == ''){
    if ( isset($_GET['username'] , $_GET['password']) ){           
        $username = $_GET['username'];
       $userpass = $_GET['password'];
        }
      
        $query = "SELECT userid, username, userpass , authority FROM user_role WHERE username = ? and userpass = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $username,$userpass);
        $stmt->execute();
        $stmt->bind_result($ruserid ,$rusername , $ruserpass , $rauthority);
        $stmt->fetch();
        $stmt->close();
        
      
       if ($rusername == $username) {
      $_SESSION['userid'] = $ruserid;
       $_SESSION['username'] = $rusername;
       $_SESSION['authority'] = $rauthority;
        }
       else {
      echo('<div class="alert alert-danger d-flex align-items-center" role="alert">
      <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
      <div>
        Kullanıcı adı ve şifre uyumsuz.
      </div>
      </div>
      <meta http-equiv="refresh" content="3;giris.php">');
      }

}


	$page= isset($_GET['page']) ? $_GET['page'] : '';
				if($page == ''){
            include('pages/home.php');
				}else{
					if(file_exists('pagesr1/' . $page.'.php')){
						include('pagesr1/' . $page.'.php');
					}else{
						echo 'Sayfa Bulunamadı.';
					}
				
				}	
             
              ?>