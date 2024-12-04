<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="./logged.php" class="brand-link">
		<img src="../dist/img/LOGO.png" alt="LOGO" class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-light">Dziennik Elektroniczny</span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="../img/<?php echo $_SESSION["logged"]["avatar"]; ?>" class="img-circle elevation-2" alt="User Image">
			</div>
			<div class="info">
				<a href="#" class="d-block"><?php echo $_SESSION["logged"]["firstName"]." ".$_SESSION["logged"]["lastName"] ?></a>
			</div>
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav flex-column">
				<li class="nav-item">
					<a class="nav-link active" href="?view=dashboard">Pulpit</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="?view=users">Zarządzanie Użytkownikami</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="?view=add_user">Dodaj Użytkownika</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="?view=classes">Zarządzanie Klasami</a>
				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>
