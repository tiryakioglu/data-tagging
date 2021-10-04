<?php
error_reporting(E_ERROR | E_PARSE);
ob_start();
session_start();
require_once('ayar.php');
session_destroy ();



if ( isset($_POST['username'] , $_POST['password']) ){           
  $username = $_POST['username'];
  $userpass = $_POST['password'];
  }

  $query = "SELECT userid, username, userpass , authority FROM user_role WHERE username = ? and userpass = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("ss", $username,$userpass);
  $stmt->execute();
  $stmt->bind_result($ruserid ,$rusername , $ruserpass , $rauthority);
  $stmt->fetch();
  $stmt->close();
  
  $conn->close();

 if ($rusername == $username && $username != '') {
$_SESSION['userid'] = $ruserid;
 $_SESSION['username'] = $rusername;
 $_SESSION['authority'] = $rauthority;
 $response['success'] = 1;
 $response['message'] = 'successfully';
  }
 else {
  $response['success'] = 0;
  $response['message'] = 'error '.$username;
}
echo json_encode($response);
              ?>