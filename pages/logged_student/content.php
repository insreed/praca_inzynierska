<div class="content-wrapper">
	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<?php
			if (isset($_GET['view'])) {
				$view = $_GET['view'];

				switch ($view) {
					case 'dashboard':
						include 'student_dashboard.php';
						break;

					case 'grades':
						include 'student_grades.php';
						break;

					case 'averages':
						include 'student_averages.php';
						break;

					default:
						echo "<h2 class='text-center text-danger'>Nieznany widok!</h2>";
						echo "<p class='text-center'>Widok, który próbujesz załadować, nie istnieje. Wróć do pulpitu.</p>";
						echo "<div class='text-center mt-4'><a href='?view=dashboard' class='btn btn-primary'>Powrót do pulpitu</a></div>";
						break;
				}
			} else {
				// Domyślny widok
				include 'student_dashboard.php';
			}
			?>
		</div>
	</section>
	<!-- /.content -->
</div>
