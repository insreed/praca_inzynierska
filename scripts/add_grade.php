<?php
	session_start();
  //print_r($_POST);


	require_once "./connect.php";
	$sql = "INSERT INTO `oceny` (`id_nauczyciela`,`id_przedmiotu`,`id_ucznia`) VALUES ('$_POST[id_nauczyciela]','$_POST[id_przedmiotu]', '$_POST[id_ucznia]');";
	$conn->query($sql);

	$sql2 = "SELECT * FROM `oceny` ORDER BY `id_oceny` DESC LIMIT 1";
	$result = $conn->query($sql2);
	$row = $result->fetch_assoc();
	$id_oceny=$row['id_oceny'];

	$sql3 = "INSERT INTO `wpisy` (`id_oceny`,`wartosc`) VALUES ($id_oceny, '$_POST[wartosc]');";
	$conn->query($sql3);

	// echo $conn->affected_rows;
	$successMessage = "Pomyślnie dodano ocenę!";
	$failureMessage = "Nie udało się dodać oceny!";
	if ($conn->affected_rows == 1) {
	    $_SESSION["error"] = "success";
	    $_SESSION["message"] = $successMessage;
	    header("location: ../pages/logged.php?success=true");
	} else {
	    $_SESSION["error"] = "failure";
	    $_SESSION["message"] = $failureMessage;
	    header("location: ../pages/logged.php?success=false");
	}
	$conn->close();
