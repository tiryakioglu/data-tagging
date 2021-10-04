<!doctype html>
<html lang="tr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Veri Seti - Giriş</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="dist/css/bootstrap.min.css">
    <!-- Favicons -->
<link rel="apple-touch-icon" href="dist/images/logo.png" sizes="180x180">
<link rel="icon" href="dist/images/logo.png" sizes="32x32" type="image/png">
<link rel="icon" href="dist/images/logo.png" sizes="16x16" type="image/png">
<link rel="icon" href="dist/images/favicon.ico">
<meta name="theme-color" content="#7952b3">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="dist/css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin">
  <form action="giris2.php" method="post">
    <img class="mb-4" src="dist/images/logo.png" alt="" width="100" height="100">
    <h1 class="h3 mb-3 fw-normal">Lütfen giriş yapın.</h1>
    <label for="inputEmail" class="visually-hidden">Kullanıcı Adı</label>
    <input type="input" id="input" name="username" class="form-control" placeholder="Kullanıcı Adı" required autofocus>
    <label for="inputPassword" class="visually-hidden">Şifre</label>
    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Şifre" required>

    <button class="w-100 btn btn-lg btn-primary" type="submit">Giriş Yap</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2021</p>
  </form>
</main>


    
  </body>
</html>
