<?php
session_start();
require_once "../scripts/connect.php";
?>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Panel administratora</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Panel administratora</li>
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
		// get users
		$sql="SELECT `users`.`id`, `users`.`firstName`,`users`.`lastName`,`roles`.`role`,`users`.`email` FROM USERS INNER JOIN roles ON `users`.`role_id` = `roles`.`role` ORDER BY `id`" ;
		$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Wyświetlanie danych w tabeli
    echo "<table style='width: 100%; min-width: 960px'>
            <tr>
                <th>ID</th>
                <th>Imię</th>
                <th>Nazwisko</th>
                <th>Rola</th>
                <th>Email</th>
            </tr>";

    while ($user = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $user["id"] . "</td>";
        echo "<td>" . $user["firstName"] . "</td>";
        echo "<td>" . $user["lastName"] . "</td>";
        echo "<td>" . $user["role"] . "</td>";
        echo "<td>" . $user["email"] . "</td>";
				echo "<td> <a href='../pages/logged.php?updateUserId=$user[id]'>Edytuj</a></td>";
				echo "<td> <a href='../scripts/delete_user.php?deleteUserId=$user[id]'>Usuń</a></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Brak użytkowników w bazie danych.";
}
?>
</div>
<?php
		//dodawanie użytkownika
		if (isset($_GET["addUserForm"]))
		{
			echo <<< ADDUSERFORM
			<div style="display: grid;background: rgba(0,0,0,.8);place-items: center;position: absolute;width: 100%;height: 100%;left: 0;top: 0;z-index: 1111;" onclick="window.location.href='./logged.php'">
				<div style="background: #333; padding: 32px;" onclick="event.stopPropagation()">
					<h4>Dodawanie użytkownika</h4>
					<form action="../scripts/add_user.php" method="post">
						<input type="text" name="firstName" placeholder="Podaj imię" autofocus><br><br>
						<input type="text" name="lastName" placeholder="Podaj nazwisko"><br><br>
						<input type="password" name="password" placeholder="Podaj hasło"><br><br>
						<input type="text" name="email" placeholder="Podaj email"><br><br>
						<input type="text" name="additional_email" placeholder="Podaj pomocniczy email"><br><br>
						<select name="role_id">
ADDUSERFORM;

						$roles = [];
						$sql = "SELECT DISTINCT `roles`.`role`, `users`.`role_id` FROM `users` JOIN `roles` ON `users`.`role_id` = `roles`.`id`";
						$result = $conn->query($sql);
						while ($role = $result->fetch_assoc()){
							$selected = $role["role_id"] == $updateUserId ? 'selected' : '';
							$roles[] = sprintf('<option value="%d" %s>%s</option>', $role['role_id'], $selected, $role['role']);
						}
						echo implode('', $roles);


	echo <<< ADDUSERFORM
						</select><br><br>
						<input type="date" name="birthday">Data urodzenia<br><br>
						<input type="checkbox" name="term" checked> Regulamin<br><br>
						<input type="submit" value="Dodaj użytkownika">
					</form>
				</div>
				<div>
ADDUSERFORM;

$message = isset($_SESSION["message"]) ? $_SESSION["message"] : "";
if(!empty($message)){
	echo <<< ALERT
	<div class="alert alert-danger alert-dismissible" style="width: 550px; margin: 5px; z-index: 2000; position: absolute; top: 0; right: 0;">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h5><i class="icon fas fa-check"></i> Alert!</h5>
			$message
	</div>
	ALERT;

unset($_SESSION["message"]);
}
	}
else
{
	echo "<hr><a href=\"./logged.php?addUserForm=1\">Dodaj użytkownika</a>";
}

// aktualizacja uzytkownika
		if (isset($_GET["updateUserId"])){
	    $sql = "SELECT * FROM users WHERE id=$_GET[updateUserId];";
	    $result = $conn->query($sql);
	    $updateUser = $result->fetch_assoc();
	    $_SESSION["updateUserId"] = $_GET["updateUserId"];
		  echo <<< UPDATEUSERFORM
				<div style="display: grid;background: rgba(0,0,0,.8);place-items: center;position: absolute;width: 100%;height: 100%;left: 0;top: 0;z-index: 1111;" onclick="window.location.href='./logged.php'">
					<div style="background: #333; padding: 32px;" onclick="event.stopPropagation()">
		        <h4>Aktualizacja użytkownika</h4>
		        <form action="../scripts/update_user.php" method="post">
		          Imię: <input type="text" name="firstName" placeholder="Podaj imię" value="$updateUser[firstName]" autofocus><br><br>
		          Nazwisko: <input type="text" name="lastName" placeholder="Podaj nazwisko" value="$updateUser[lastName]"><br><br>
							Email: <input type="text" name="email" placeholder="Podaj email" value="$updateUser[email]"><br><br>
							Email pomocniczy: <input type="text" name="additional_email" placeholder="Podaj email zastępczy" value="$updateUser[additional_email]"><br><br>
							Rola: <select name="role_id">
	UPDATEUSERFORM;
						$roles = [];
						$sql = "SELECT DISTINCT `roles`.`role`, `users`.`role_id` FROM `users` JOIN `roles` ON `users`.`role_id` = `roles`.`id`";
						$result = $conn->query($sql);
						while ($role = $result->fetch_assoc()){
							$selected = $role["role_id"] == $updateUserId ? 'selected' : '';
							$roles[] = sprintf('<option value="%d" %s>%s</option>', $role['role_id'], $selected, $role['role']);
						}
						echo implode('', $roles);


				echo <<< UPDATEUSERFORM
		          </select><br><br>
		          <input type="date" name="birthday" value="$updateUser[birthday]"> Data urodzenia<br><br>
		          <input type="submit" value="Aktualizuj użytkownika">
		        </form>
					</div>
				</div>
UPDATEUSERFORM;
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

// Zamknięcie połączenia z bazą danych
$conn->close();
?>

		</div><!--/. container-fluid -->
	</section>
	<!-- /.content -->
</div>
