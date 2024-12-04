<?php
session_start();
require_once "./connect.php";

// Walidacja pól
$errors = [];

// Sprawdzenie czy pola są wypełnione
foreach ($_POST as $key => $value) {
    if (empty($value) && $key !== 'additional_email') { // "additional_email" nie jest wymagany
        $errors[] = "Pole $key nie może być puste";
    }
}

// Walidacja szczegółowa
if (empty($_POST["firstName"])) {
    $errors[] = "Wpisz imię";
}

if (empty($_POST["lastName"])) {
    $errors[] = "Wpisz nazwisko";
}

if (empty($_POST["password"])) {
    $errors[] = "Wpisz hasło";
} else {
    // Sprawdzamy, czy hasło spełnia kryteria bezpieczeństwa
    $password = $_POST["password"];
    if (strlen($password) < 8) {
        $errors[] = "Hasło musi mieć co najmniej 8 znaków";
    }
    if (!preg_match("/[A-Z]/", $password)) {
        $errors[] = "Hasło musi zawierać co najmniej jedną wielką literę";
    }
    if (!preg_match("/[a-z]/", $password)) {
        $errors[] = "Hasło musi zawierać co najmniej jedną małą literę";
    }
    if (!preg_match("/[0-9]/", $password)) {
        $errors[] = "Hasło musi zawierać co najmniej jedną cyfrę";
    }
}

if (empty($_POST["email"])) {
    $errors[] = "Wpisz adres email";
} elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Niepoprawny format adresu email";
}

if (!isset($_POST["term"])) {
    $errors[] = "Zatwierdź regulamin!";
}

// Jeśli są błędy, wróć do poprzedniej strony
if (count($errors) > 0) {
    $_SESSION["error"] = "failure";
    $_SESSION["message"] = implode("<br>", $errors);
    header("location: ../pages/logged.php?view=add_user&action=add&success=false");
    exit();
}

// Haszowanie hasła przed zapisaniem do bazy danych
$hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Przygotowanie zapytania do dodania użytkownika
$query = "INSERT INTO `users` (`email`, `additional_email`, `firstName`, `lastName`, `birthday`, `password`) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssssss", $_POST['email'], $_POST['additional_email'], $_POST['firstName'], $_POST['lastName'], $_POST['birthday'], $hashedPassword);

if ($stmt->execute()) {
    $affectedRows = $stmt->affected_rows;

    if ($affectedRows > 0) {
        $_SESSION["error"] = "success";
        $_SESSION["message"] = "Pomyślnie dodano użytkownika!";
        header("location: ../pages/logged.php?view=add_user&action=add&success=true");
    } else {
        $_SESSION["error"] = "failure";
        $_SESSION["message"] = "Nie udało się dodać użytkownika!";
        header("location: ../pages/logged.php?view=add_user&action=add&success=false");
    }
} else {
    $_SESSION["error"] = "failure";
    $_SESSION["message"] = "Błąd podczas dodawania użytkownika!";
    header("location: ../pages/logged.php?view=add_user&action=add&success=false");
}

// Zamknięcie połączenia
$stmt->close();
$conn->close();
?>