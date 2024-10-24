<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Registration Page (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <?php
    if (isset($_SESSION["error"])){
      echo <<< ERROR
        <div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-ban"></i> Uwaga!</h5>
    $_SESSION[error]
  </div>
ERROR;
      unset($_SESSION["error"]);
    }

  if (isset($_SESSION["success"])){
	  echo <<< ERROR
        <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-ban"></i> Uwaga!</h5>
    $_SESSION[success]
  </div>
ERROR;
	  unset($_SESSION["success"]);
  }
  ?>

  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="./" class="h1"><b>Admin</b>LTE</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Rejestracja użytkownika</p>

      <form action="../scripts/register.php" method="post">

        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Podaj imię" name="firstName">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Podaj nazwisko" name="lastName">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Podaj email" name="email1">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Powtórz email" name="email2">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Podaj dodatkowy email" name="additional_email1">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Powtórz dodatkowy email" name="additional_email2">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Podaj hasło" name="pass1">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Powtórz hasło" name="pass2">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="date" class="form-control" name="birthday">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-calendar"></span>
            </div>
          </div>
        </div>

<!-- płeć -->
        <div class="input-group mb-1">
          <div class="custom-control custom-radio">
            <input class="custom-control-input" type="radio" id="w" name="avatar" value="w" checked>
            <label for="w" class="custom-control-label">Kobieta</label>
          </div>
        </div>

        <div class="input-group mb-1">
          <div class="custom-control custom-radio">
            <input class="custom-control-input" type="radio" id="m" name="avatar" value="m">
            <label for="m" class="custom-control-label">Mężczyzna</label>
          </div>
        </div>
        <hr>
<!-- Typ -->
        <div class="input-group mb-1">
          <div class="custom-control custom-radio">
            <input class="custom-control-input" type="radio" id="s" name="typ" value="s" checked>
            <label for="s" class="custom-control-label">Student</label>
          </div>
        </div>
        <div class="input-group mb-1">
          <div class="custom-control custom-radio">
            <input class="custom-control-input" type="radio" id="n" name="typ" value="n">
            <label for="n" class="custom-control-label">Nauczyciel</label>
          </div>
        </div>
        <hr>

        <div class="row">
          <div class="col-7">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               Zatwierdź regulamin <a href="#">Regulamin</a>
              </label>
            </div>
          </div>
          <hr>
          <!-- /.col -->
          <div class="col-5">
            <button type="submit" class="btn btn-primary btn-block">Rejestracja</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


      <br>
      <a href="./" class="text-center">Masz konto? Zaloguj się</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
</body>
</html>
