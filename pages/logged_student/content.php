<style media="screen">
.ocena {
	 padding: 5px 10px 5px 10px;
	 margin-right: 10px;
	 border-radius: 5px;
	 color:black;
	 margin-top:20px;
}
.oceny{
	padding-left: 20px;
}

.kolor1{background-color: rgb(255, 0, 0)}
.kolor2{background-color: rgb(255, 145, 0)}
.kolor3{background-color: rgb(255, 208, 0)}
.kolor4{background-color: rgb(204, 255, 0)}
.kolor5{background-color: rgb(72, 255, 0)}
.kolor6{background-color: rgb(0, 255, 149)}

.przedmiot{
	margin-bottom: 20px;
}
</style>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<?php
							$user_id=$_SESSION["logged"]["user_id"];
							require_once "../scripts/connect.php";

							$klasa="SELECT * FROM przydział_klasy INNER JOIN klasa ON przydział_klasy.id_klasy=klasa.id_klasy WHERE id_uzytkownika=$user_id";
							$result = $conn->query($klasa);
							while ($row = mysqli_fetch_assoc($result)){
								$klasa= $row['nazwa'];
								$id_klasy=$row['id_klasy'];
							}

					 ?>
					<h1 class="m-0">Panel Studenta - <?php echo 	$_SESSION["logged"]["firstName"]." ".$_SESSION["logged"]["lastName"]." ".$klasa; ?></h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<!-- <ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Panel Studenta</li>
					</ol> -->
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<section class="content">
			<h2 class="m-1">Twoje oceny</h2><hr>
			<div class="oceny">
			<?php

				$przedmioty="SELECT DISTINCT(`nazwa_przedmiotu`), `id_przedmiotu` FROM `users` INNER JOIN oceny ON users.id=oceny.id_ucznia NATURAL JOIN przedmioty WHERE id=$user_id";
				$result5 = $conn->query($przedmioty);
				while ($row5 = mysqli_fetch_assoc($result5)){

					$nazwa_przedmiotu=$row5['nazwa_przedmiotu'];
					$id_przedmiotu=$row5['id_przedmiotu'];

					// $nauczyciel_sql="SELECT DISTINCT(id_nauczyciela), firstName, lastName FROM przydział_nauczyciel INNER JOIN users ON users.id=przydział_nauczyciel.id_nauczyciela WHERE id_przedmiotu=$id_przedmiotu AND id_klasy=$id_klasy";
					// $result6 = $conn->query($nauczyciel_sql);
					// while ($row6 = mysqli_fetch_assoc($result6))
					// 	$nauczyciel_przed = $row6['firstName']." ".$row['lastName'];

					echo "<div class='przedmiot'>";
					echo "<h4>".$nazwa_przedmiotu."</h4>";

					$sql="SELECT * FROM oceny INNER JOIN users ON users.id = oceny.id_nauczyciela WHERE id_ucznia=$user_id AND id_przedmiotu=$id_przedmiotu";
					$result = $conn->query($sql);

					while ($row = mysqli_fetch_assoc($result)) {
						$nauczyciel = $row['lastName']." ".$row['firstName'];
						$id_oceny = $row['id_oceny'];

						$ocena = "SELECT * FROM wpisy INNER JOIN oceny ON oceny.id_oceny = wpisy.id_oceny INNER JOIN users ON users.id = oceny.id_nauczyciela WHERE wpisy.id_oceny=$id_oceny ORDER BY data_wpisu DESC limit 1";
						$result1 = $conn->query($ocena);
						$info="<b>Wpisana przez:<br> ".$nauczyciel."</b><br>Modyfikacje:<br> ";

						while ($row1 = mysqli_fetch_assoc($result1)){
							$modyfikacje = "SELECT * FROM wpisy INNER JOIN oceny ON oceny.id_oceny = wpisy.id_oceny INNER JOIN users ON users.id = oceny.id_nauczyciela WHERE wpisy.id_oceny=$id_oceny ORDER BY data_wpisu DESC";
							$result2 = $conn->query($modyfikacje);

							while ($row2 = mysqli_fetch_assoc($result2)){
								$info.="Ocena: ".$row2["wartosc"]." ";
								$info.=$row2["data_wpisu"]." ";
						}
						echo '<span class="ocena kolor'.$row1['wartosc'].'" title="'.$info.'" data-html="true" data-toggle="tooltip" data-placement="top">'.$row1['wartosc'].'</span>';
					}
				 }
				 echo "</div>";
			 }
			 ?>
			 </div>
	 </div>
		</div><!--/. container-fluid -->
	</section>
	<!-- /.content -->
</div>
