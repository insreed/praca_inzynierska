<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dziennik | Logowanie</title>
  <link rel="stylesheet" href="../styles/custom.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body class="hold-transition dark-mode login-page">
  <div class="login-box">
    <!-- Komunikaty błędów -->
    <?php
    if (isset($_GET["error"])) {
      echo <<<ERROR
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Błąd!</strong> {$_GET["error"]}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
ERROR;
    }
    if (isset($_GET["logout"])) {
      echo <<<LOGOUT
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong>Info!</strong> Prawidłowo wylogowano użytkownika.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
LOGOUT;
    }
    ?>

    <!-- Karta logowania -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="#" class="h1"><b>Dziennik </b>Elektroniczny</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Zaloguj się, aby kontynuować</p>

        <!-- Formularz logowania -->
        <form action="../scripts/login.php" method="post">
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email" name="email" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Hasło" name="pass" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <!-- Możliwość rejestracji (opcjonalne, można odkomentować) -->
              <!-- <a href="register.php" class="text-center">Rejestracja</a> -->
            </div>
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Zaloguj</button>
            </div>
          </div>
        </form>

        <!-- Szybkie logowanie do testowania -->
        <div class="card card-outline card-secondary mt-4">
          <div class="card-header">
            <h5 class="text-center">Szybkie logowanie do testowania</h5>
          </div>
          <div class="card-body">
            <div class="d-grid gap-2">
              <button class="btn btn-info btn-block" onclick="quickLogin('jan.kowalski@example.com', 'QWERTYuiop1!')">
                Zaloguj jako Student
              </button>
              <button class="btn btn-success btn-block"
                onclick="quickLogin('piotr.majewski@example.com', 'QWERTYuiop1!')">
                Zaloguj jako Nauczyciel
              </button>
              <button class="btn btn-danger btn-block" onclick="quickLogin('admin1@example.com', 'QWERTYuiop1!')">
                Zaloguj jako Admin
              </button>
            </div>
          </div>
        </div>
        <!-- Koniec sekcji Szybkie logowanie -->
      </div>
    </div>
  </div>

  <script>
    // Funkcja do automatycznego wypełniania formularza logowania
    function quickLogin(email, password) {
      document.querySelector('input[name="email"]').value = email;
      document.querySelector('input[name="pass"]').value = password;
      document.querySelector('form').submit();
    }
  </script>

  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
</body>

</html>