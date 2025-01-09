<?php
session_start();
require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$userId = intval($_POST['user_id']);
	$firstName = trim($_POST['firstName']);
	$lastName = trim($_POST['lastName']);
	$email = trim($_POST['email']);
	// Pobranie roli użytkownika bez możliwości zmiany
	$sqlRole = "SELECT role_id FROM users WHERE id = ?";
	$stmtRole = $conn->prepare($sqlRole);
	$stmtRole->bind_param("i", $userId);
	$stmtRole->execute();
	$resultRole = $stmtRole->get_result();
	$roleRow = $resultRole->fetch_assoc();

	$roleId = $roleRow['role_id']; // Ustaw stałą wartość roli

	$birthday = $_POST['birthday'];
	$classId = isset($_POST['class_id']) ? intval($_POST['class_id']) : null;

	$conn->begin_transaction();
	try {
		// Aktualizacja danych użytkownika
		$sql = "UPDATE users SET firstName = ?, lastName = ?, email = ?, role_id = ?, birthday = ? WHERE id = ?";
		$stmt = $conn->prepare($sql);
		if (!$stmt) {
			throw new Exception("Błąd przygotowania zapytania: " . $conn->error);
		}
		$stmt->bind_param("sssssi", $firstName, $lastName, $email, $roleId, $birthday, $userId);

		if (!$stmt->execute()) {
			throw new Exception("Błąd wykonania zapytania: " . $stmt->error);
		}

		// Aktualizacja klasy dla studenta
		if ($roleId == 1) { // Rola studenta
			$deleteClassSql = "DELETE FROM `przydzial_klasy` WHERE id_uzytkownika = ?";
			$stmt = $conn->prepare($deleteClassSql);
			if (!$stmt) {
				throw new Exception("Błąd przygotowania zapytania (usunięcie klasy): " . $conn->error);
			}
			$stmt->bind_param("i", $userId);
			$stmt->execute();

			if ($classId) {
				$insertClassSql = "INSERT INTO `przydzial_klasy` (id_uzytkownika, id_klasy) VALUES (?, ?)";
				$stmt = $conn->prepare($insertClassSql);
				if (!$stmt) {
					throw new Exception("Błąd przygotowania zapytania (wstawienie klasy): " . $conn->error);
				}
				$stmt->bind_param("ii", $userId, $classId);
				if (!$stmt->execute()) {
					throw new Exception("Błąd wykonania zapytania (wstawienie klasy): " . $stmt->error);
				}
			}
		}

		$conn->commit();
		$_SESSION["message"] = "Dane użytkownika zostały zaktualizowane pomyślnie.";
		$_SESSION["error"] = "success";
	} catch (Exception $e) {
		$conn->rollback();
		$_SESSION["message"] = "Błąd podczas aktualizacji danych użytkownika: " . $e->getMessage();
		$_SESSION["error"] = "failure";
	}

	$conn->close();
	header("Location: ../pages/logged.php?view=users");
	exit();
}
?>