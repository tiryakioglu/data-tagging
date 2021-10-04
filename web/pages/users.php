<div class="container px-5 my-5"><?php
if ($_SESSION['authority'] != "5" ){ 
  exit('<div class="alert alert-danger" role="alert">Yetersiz yetki</div>
  <meta http-equiv="refresh" content="3;index.php">');

   }
   if ($_GET['process'] == "1" or $_GET['process'] == "" ){  
              ?><div class="d-flex justify-content-center">
              <a href="index.php?page=users&process=2" >
  <button type="button" class="btn btn-success btn-lg btn-block" >
  <i class="bi bi-plus-square"></i> Kullanıcı Ekle
</button>
      </a> </div>
<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th scope="col">UserID</th>
      <th scope="col">Kullanıcı Adı</th>
      <th scope="col">Yetki</th>
      <th scope="col">Duzenle</th>
    </tr>
  </thead>
  <tbody>
    <?php

$sql = "SELECT userid, username, userpass, authority FROM user_role";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $yetkiliabi = (5 == $row["authority"]) ? 'Admin' : 'Kullanıcı';
    echo "<tr>
    <td>" . $row["userid"]. " 
    </td><td>" . $row["username"]. "
    </td><td>" . $yetkiliabi. " </td>
        <td><a style ='text-decoration: none;' href=\"index.php?page=users&process=4&dsuserid=" . $row["userid"]. "\" >
        <button type=\"button\" class=\"btn btn-primary\" >
        <i class=\"bi bi-pencil-square\"></i>
     </button>
            </a>
            <a href=\"index.php?page=users&process=6&dsuserid=" . $row["userid"]. "\" >
            <button type=\"button\" class=\"btn btn-danger\" >
            <i class=\"bi bi-trash\"></i>
         </button>
                </a></td>
    </tr>";
  }
} else {
  echo "0 results";
}
echo "</tbody></table >";
$conn->close();

}
elseif ($_GET['process'] == "2" ){
    ?>
<form class="row g-3" action="index.php?page=users&process=3" method="post">
<div class="mb-3">
  <label for="formcontroluser" class="form-label">Kullanıcı Adı</label>
  <input type="text" class="form-control" id="formcontroluser" name="username" placeholder="Kullanıcı Adı" required>
</div>
<div class="mb-3">
  <label for="formcontrolpass" class="form-label">Şifre</label>
  <input type="password" class="form-control" id="formcontrolpass" name="userpass" placeholder="Şifre" required>
</div>

<div class="mb-3">
  <label for="formcontrolend" class="form-label">Yetki</label>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="yetki" id="flexRadioDefault1" value="1"  checked>
  <label class="form-check-label" for="flexRadioDefault1">
  Kullanıcı
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="yetki" id="flexRadioDefault2" value="2">
  <label class="form-check-label" for="flexRadioDefault2">
    Admin
  </label>
</div>
</div>
<div class="mb-3">
  <button class="btn btn-primary" type="submit">Ekle</button>
</div>
</form>

<?php

}elseif ($_GET['process'] == "3" ){

    $username = $_POST['username'];
   $userpass = $_POST['userpass'];
   $yetki = $_POST['yetki'];

   //kullanici var mi
   $query = "SELECT count(userid) FROM user_role WHERE username = ?";
   $stmt = $conn->prepare($query);
   $stmt->bind_param("s", $username);
   $stmt->execute();
   $stmt->bind_result($usercount);
   $stmt->fetch();
   $stmt->close();
   //kullanici var mi
   $yetkir = (2 == $yetki) ? 5 : 1;
   if($usercount == 0){
   // prepare and bind
   $stmt = $conn->prepare("INSERT INTO user_role( username, userpass, authority)  VALUES (?, ?, ?)");
   $stmt->bind_param('ssi', $busername, $buserpass, $bauthority);
    // set parameters and execute
    $busername = $username;
    $buserpass = $userpass;
    $bauthority = $yetkir;
    $stmt->execute();
    $stmt->close();
    echo '<div class="alert alert-success" role="alert">
        Kullanıcı eklendi.</div><meta http-equiv="refresh" content="3;index.php?page=users&process=2">';
    }else{
        echo '<div class="alert alert-danger" role="alert">
        Kullanıcı adı kullanılıyor.</div><meta http-equiv="refresh" content="3;index.php?page=users&process=2">';
    }
  $conn->close();

}elseif ($_GET['process'] == "4" ){
    $dsuserid = $_GET['dsuserid'];
    $query = "SELECT username, authority FROM user_role WHERE userid = ?";
   $stmt = $conn->prepare($query);
   $stmt->bind_param("i", $dsuserid);
   $stmt->execute();
   $stmt->bind_result($username,$authority);
   $stmt->fetch();
   $stmt->close();
   if($authority == 5){$checka = "checked";}else{$checku = "checked";}
    ?>
<form class="row g-3" action="index.php?page=users&process=5&dsuserid=<?=$dsuserid ?>" method="post">
<div class="mb-3">
  <label for="formcontroluser" class="form-label">Kullanıcı Adı</label>
  <input type="text" class="form-control" id="formcontroluser" name="username" value="<?=$username ?>" required>
</div>
<div class="mb-3">
  <label for="formcontrolpass" class="form-label">Şifre</label>
  <input type="password" class="form-control" id="formcontrolpass" name="userpass" placeholder="Şifre" required>
</div>

<div class="mb-3">
  <label for="formcontrolend" class="form-label">Yetki</label>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="yetki" id="flexRadioDefault1" value="1"  <?=$checku ?>>
  <label class="form-check-label" for="flexRadioDefault1">
  Kullanıcı
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="yetki" id="flexRadioDefault2" value="2" <?=$checka ?>>
  <label class="form-check-label" for="flexRadioDefault2">
    Admin
  </label>
</div>
</div>
<div class="mb-3">
  <button class="btn btn-primary" type="submit">Güncelle</button>
</div>
</form>

<?php

}elseif ($_GET['process'] == "5" ){
    $dsuserid = $_GET['dsuserid'];
    $username = $_POST['username'];
   $userpass = $_POST['userpass'];
   $yetki = $_POST['yetki'];

   //kullanici var mi
   $query = "SELECT count(userid) FROM user_role WHERE username = ? and userid != ?";
   $stmt = $conn->prepare($query);
   $stmt->bind_param("si", $username,$dsuserid);
   $stmt->execute();
   $stmt->bind_result($usercount);
   $stmt->fetch();
   $stmt->close();
   //kullanici var mi
   if($yetki == 2){}
   $yetkir = (2 == $yetki) ? 5 : 1;
   if($usercount == 0){
   // prepare and bind
   $stmt = $conn->prepare("UPDATE user_role SET username= ? , userpass= ? , authority = ? WHERE userid = ?");
   $stmt->bind_param('ssii', $busername, $buserpass, $bauthority, $bdsuserid);
    // set parameters and execute
    $busername = $username;
    $buserpass = $userpass;
    $bauthority = $yetkir;
    $bdsuserid = $dsuserid;
    $stmt->execute();
    $stmt->close();
    echo '<div class="alert alert-success" role="alert">
        Kullanıcı Guncellendi.</div><meta http-equiv="refresh" content="3;index.php?page=users&process=1">';
    }else{
        echo '<div class="alert alert-danger" role="alert">
        Kullanıcı adı kullanılıyor.</div><meta http-equiv="refresh" content="3;index.php?page=users&process=4&dsuserid='.$dsuserid.'">';
    }
  $conn->close();

}elseif ($_GET['process'] == "6" ){

    $dsuserid = $_GET['dsuserid'];

   //kullanici var mi
   $query = "SELECT count(userid) FROM user_role WHERE userid = ?";
   $stmt = $conn->prepare($query);
   $stmt->bind_param("i", $dsuserid);
   $stmt->execute();
   $stmt->bind_result($usercount);
   $stmt->fetch();
   $stmt->close();
   //kullanici var mi
   if($usercount == 1){
   // prepare and bind
   $query = "DELETE FROM user_role WHERE userid = ?";
   $stmt = $conn->prepare($query);
   $stmt->bind_param("i", $dsuserid);
   $stmt->execute();
   $stmt->close();
    echo '<div class="alert alert-success" role="alert">
        Kullanıcı silindi.</div><meta http-equiv="refresh" content="3;index.php?page=users&process=1">';
    }else{
        echo '<div class="alert alert-danger" role="alert">
        Kullanıcı bulunamadı.</div><meta http-equiv="refresh" content="3;index.php?page=users&process=1">';
    }
  $conn->close();


}
    ?>
  </div>