<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$errors = [];

	foreach ($_POST as $key => $value) {
		if (empty($value)) {
			$errors[] = "Pole <b>$key</b> musi być wypełnione";
		}
	}

	$login = $_POST["email"];
	$pass = $_POST["pass"];

	// W przypadku błędów przekieruj z komunikatami
	if (!empty($errors)) {
		$error_message = implode("<br>", $errors);
		header("location: ../pages/index.php?error=" . urlencode($error_message));
		exit();
	}

	require_once "./connect.php";
	$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
	$stmt->bind_param("s", $login);
	$stmt->execute();
	$result = $stmt->get_result();

	// Sprawdzenie, czy użytkownik istnieje
	if ($result->num_rows != 0) {
		$user = $result->fetch_assoc();

		// Weryfikacja hasła
		if (password_verify($pass, $user["password"])) {
			// Inicjalizacja sesji użytkownika
			$_SESSION["logged"]["firstName"] = $user["firstName"];
			$_SESSION["logged"]["lastName"] = $user["lastName"];
			$_SESSION["logged"]["role_id"] = $user["role_id"];
			$_SESSION["logged"]["avatar"] = $user["avatar"];
			$_SESSION["logged"]["user_id"] = $user["id"];

			session_regenerate_id();
			$_SESSION["logged"]["session_id"] = session_id();

			// Przekierowanie po zalogowaniu
			header("location: ../pages/logged.php");
			exit();
		} else {
			// Nieprawidłowe hasło
			header("location: ../pages/index.php?error=" . urlencode("Błędny login lub hasło!"));
			exit();
		}
	} else {
		// Użytkownik nie istnieje
		header("location: ../pages/index.php?error=" . urlencode("Błędny login lub hasło!"));
		exit();
	}
} else {
	// Jeśli nie POST, przekieruj z powrotem
	header("location: ../pages/index.php");
	exit();
}
