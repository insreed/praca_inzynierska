<?php
  session_start();
  if (!isset($_SESSION["logged"]) || session_status() != 2 || session_id() != $_SESSION["logged"]["session_id"]){
    $_SESSION["error"] = "Zaloguj się!";
    echo "<script>history.back();</script>";
  }else{
    switch ($_SESSION["logged"]["role_id"]){
      case 1:
        $role = "logged_student";
        break;
	    case 2:
		    $role = "logged_teacher";
        break;
	    case 3:
		    $role = "logged_admin";
        break;
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dziennik elektroniczny</title>
  <link rel="stylesheet" href="../styles/custom.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Table style -->
  <link rel="stylesheet" type="text/css" href="../styles/tableStyle.css">
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="../dist/img/LOGO.png" alt="LOGO" height="60" width="60">
  </div>

  <!-- Navbar -->
    <?php
      require_once "./navbar.php";
    ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
	<?php
	  require_once "./$role/aside.php";
	?>

  <!-- Content Wrapper. Contains page content -->
	<?php
	  require_once "./$role/content.php";
	?>
  <!-- /.content-wrapper -->


  <!-- Main Footer -->
	<?php
	  require_once "./footer.php";
	?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="../plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="../plugins/raphael/raphael.min.js"></script>
<script src="../plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="../plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="./main.js"></script>
</body>
</html>
