<?php
	session_start();
	foreach ($_POST as $key => $value){
		if (empty($value)){
			$_SESSION["error"] = "Wypełnij wszystkie pola";
			echo "<script>history.back();</script>";
			exit();
		}
	}

	require_once "./connect.php";

$query = 'UPDATE `users` SET `firstName` = "%s", `lastName` = "%s", `email` = "%s", `role_id` = %d, `birthday` = "%s" WHERE id = %d';
$sql = sprintf($query, $_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['role_id'], $_POST['birthday'], $_SESSION['updateUserId']);
$conn->query($sql);

$successMessage = "Pomyślnie zaktualizowano użytkownika";
$failureMessage = "Nie udało się zaktualizwoać użytkownika";

if ($conn->affected_rows == 1){
	$_SESSION["error"] = "success";
	$_SESSION["message"] = $successMessage;
	header("location: ../pages/logged.php?success=true");
} else {
	$_SESSION["error"] = "failure";
	$_SESSION["message"] = $failureMessage;
	header("location: ../pages/logged.php?success=false");
}
$conn->close();
