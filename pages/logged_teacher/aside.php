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
				<a href="http://localhost/praca_inzynierska/pages/logged.php" class="d-block"><?php echo $_SESSION["logged"]["firstName"]." ".$_SESSION["logged"]["lastName"] ?></a>
			</div>
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<li class="nav-header">PRZEDMIOTY</li>
				<?php
				require_once "../scripts/connect.php";
				$user_id = $_SESSION["logged"]["user_id"];
				
				// Pobierz przedmioty nauczyciela
				$sql = "SELECT DISTINCT przedmioty.nazwa_przedmiotu, przedmioty.id_przedmiotu 
				        FROM przedmioty 
				        INNER JOIN przydział_nauczyciel ON przedmioty.id_przedmiotu = przydział_nauczyciel.id_przedmiotu 
				        WHERE przydział_nauczyciel.id_nauczyciela = $user_id";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
				    while ($subject = $result->fetch_assoc()) {
				        echo "<li class='nav-item'>
				                <a href='./logged.php?subjectId={$subject['id_przedmiotu']}' class='nav-link'>
				                    <i class='nav-icon fas fa-book'></i>
				                    <p>{$subject['nazwa_przedmiotu']}</p>
				                </a>
				              </li>";
				    }
				} else {
				    echo "<li class='nav-item'><p class='text-muted ml-3'>Brak przedmiotów</p></li>";
				}
				?>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>
