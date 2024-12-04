<?php
session_start();
foreach ($_POST as $key => $value) {
	if (empty($value) && $key !== 'additional_email') { // Dodatkowy email nie jest wymagany
		$_SESSION["error"] = "Wypełnij wszystkie pola";
		echo "<script>history.back();</script>";
		exit();
	}
}

require_once "./connect.php";

// Zmienione - Pobieramy ID użytkownika bezpośrednio z formularza
$userId = $_POST['user_id'];

// Przygotowanie zapytania do aktualizacji danych użytkownika
$query = 'UPDATE `users` SET `firstName` = ?, `lastName` = ?, `email` = ?, `role_id` = ?, `birthday` = ? WHERE `id` = ?';
$stmt = $conn->prepare($query);
$stmt->bind_param("sssssi", $_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['role_id'], $_POST['birthday'], $userId);

if ($stmt->execute()) {
	$affectedRows = $stmt->affected_rows;

	if ($affectedRows > 0) {
		$_SESSION["message"] = "Pomyślnie zaktualizowano użytkownika";
		header("location: ../pages/logged.php?view=users&action=edit&success=true");
	} else {
		$_SESSION["message"] = "Nie wprowadzono żadnych zmian";
		header("location: ../pages/logged.php?view=users&action=edit&success=false");
	}
} else {
	$_SESSION["message"] = "Nie udało się zaktualizować użytkownika";
	header("location: ../pages/logged.php?view=users&action=edit&success=false");
}

// Zamknięcie połączenia
$stmt->close();
$conn->close();
?>
