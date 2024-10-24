<style>
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


.tooltip{
	z-index:1112;
	position:absolute;
}
</style>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Panel Nauczyciela</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Panel Nauczyciela</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div style='margin: 0 auto; height: 700px; overflow-y: scroll;'>
			<?php
        require_once "../scripts/connect.php";
				$user_id=$_SESSION["logged"]["user_id"];
        // get users
        // $sql="SELECT * FROM `przydział_nauczyciel` INNER JOIN przydział_klasy ON przydział_klasy.id_klasy=przydział_klasy.id_klasy INNER JOIN users ON users.id=przydział_klasy.id_uzytkownika WHERE przydział_nauczyciel.id_nauczyciela=31 and role_id=1" ;
        // $result = $conn->query($sql);
				//
				// if(isset($_GET['id'])){
				// 	echo "<form action='logged.php'>";
				// 	echo "Wpisz ocenę uzytkownikowi ".$_GET['id'].": ";
				// 	echo "<input style='width:30px;' type='text' palceholder=''></input>";
				// 	echo "<input type='submit' value='Dodaj'></input>";
				// 	echo "</form>";
				// }

						// get users
						$sql="SELECT users.id as id, firstName, lastName, nazwa, email FROM USERS INNER JOIN roles ON `users`.`role_id` = `roles`.`role` INNER JOIN przydział_klasy ON przydział_klasy.id_uzytkownika=users.id NATURAL JOIN klasa WHERE role='student' ORDER BY `users`.`id`" ;
						$result = $conn->query($sql);

				if ($result->num_rows > 0) {
				    // Wyświetlanie danych w tabeli
				    echo "<table style='width: 100%; min-width: 960px'>
				            <tr>
				                <th>ID</th>
				                <th>Imię</th>
				                <th>Nazwisko</th>
				                <th>Klasa</th>
				                <th>Email</th>
				            </tr>";

				    while ($user = $result->fetch_assoc()) {
				        echo "<tr>";
				        echo "<td>" . $user["id"] . "</td>";
				        echo "<td>" . $user["firstName"] . "</td>";
				        echo "<td>" . $user["lastName"] . "</td>";
				        echo "<td>" . $user["nazwa"] . "</td>";
				        echo "<td>" . $user["email"] . "</td>";
								echo "<td> <a href='../pages/logged.php?showUserId=$user[id]'>Zobacz oceny</a></td>";
								echo "<td> <a href='../pages/logged.php?addGrade=$user[id]'>Dodaj ocenę</a></td>";
				        echo "</tr>";
				    }

				    echo "</table>";
				} else {
				    echo "Brak użytkowników w bazie danych.";
				}

				if (isset($_GET["showUserId"])){
					//$sql = "SELECT * FROM users WHERE id=$_GET[showUserId];";

					$_SESSION["showUserId"] = $_GET["showUserId"];
					$showUserId = $_GET["showUserId"];
					echo <<< UPDATEUSERFORM
						<div style="display: grid;background: rgba(0,0,0,.8);place-items: center;position: absolute;width: 100%;height: 100%;left: 0;top: 0;z-index: 1111;" onclick="window.location.href='./logged.php'">
							<div style="background: #333; padding: 32px;" onclick="event.stopPropagation()">
								<h4>Oceny użytkownika</h4>

UPDATEUSERFORM;
								$przedmioty="SELECT DISTINCT(`nazwa_przedmiotu`), `id_przedmiotu` FROM `users` INNER JOIN oceny ON users.id=oceny.id_ucznia NATURAL JOIN przedmioty WHERE id=$showUserId";
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

									$sql6="SELECT * FROM oceny INNER JOIN users ON users.id = oceny.id_nauczyciela WHERE id_ucznia=$showUserId AND id_przedmiotu=$id_przedmiotu";
									$result6 = $conn->query($sql6);

									while ($row6 = mysqli_fetch_assoc($result6)) {
										$nauczyciel = $row6['lastName']." ".$row6['firstName'];
										$id_oceny = $row6['id_oceny'];

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
																echo <<< UPDATEUSERFORM
							</div>
						</div>
UPDATEUSERFORM;
}

if (isset($_GET["addGrade"])){
	$sql = "SELECT * FROM users WHERE id=$_GET[addGrade];";
	$result = $conn->query($sql);
	$updateUser = $result->fetch_assoc();
	$_SESSION["addGrade"] = $_GET["addGrade"];
	echo <<< addGrade
		<div style="display: grid;background: rgba(0,0,0,.8);place-items: center;position: absolute;width: 100%;height: 100%;left: 0;top: 0;z-index: 1111;" onclick="window.location.href='./logged.php'">
			<div style="background: #333; padding: 32px;" onclick="event.stopPropagation()">
				<h4>Dodawanie oceny</h4>
				<form action="../scripts/add_grade.php" method="post">
				<input style='display:none;' name='id_ucznia' value='$_GET[addGrade]'></input>
				<input style='display:none;' name='id_nauczyciela' value='$_GET[addGrade]'></input>
				<br>Ocena: <select name="wartosc">
					<option value='1'>1</option>
					<option value='2'>2</option>
					<option value='3'>3</option>
					<option value='4'>4</option>
					<option value='5'>5</option>
					<option value='6'>6</option>
				</select><br><br>
					Przedmiot: <select name="id_przedmiotu">
addGrade;
				// print(getRolesOptions($updateUser["role_id"]));
				$subjects = [];
				$sql = "SELECT * FROM przedmioty";
				$result = $conn->query($sql);
				while ($subject = $result->fetch_assoc()){
					$subjects[] = sprintf('<option value="%d">%s</option>', $subject['id_przedmiotu'], $subject['nazwa_przedmiotu']);
				}
				echo implode('', $subjects);


		echo <<< addGrade
					</select><br><br>
					<input type="submit" value="Dodaj ocenę">
				</form>
			</div>
		</div>
addGrade;
}

// alerty
if (isset($_GET["success"])) {
$alertClass = ($_GET["success"] === "true") ? "alert-success" : "alert-danger";
$message = isset($_SESSION["message"]) ? $_SESSION["message"] : "";

if (!empty($message)) {
        echo <<< ALERT
        <div class="alert $alertClass alert-dismissible" style="width: 550px; margin: 5px; z-index: 2000; position: absolute; top: 0; right: 0;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                $message
        </div>
ALERT;
        // Usunięcie komunikatu z sesji
        unset($_SESSION["message"]);
}
}

				?>
		</div>
		</div><!--/. container-fluid -->
	</section>
	<!-- /.content -->
</div>
