<?php
session_start();
require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role_id = intval($_POST['role_id']);
    $birthday = $_POST['birthday'];
    $term = isset($_POST['term']) ? true : false;

    if (!empty($firstName) && !empty($lastName) && !empty($email) && !empty($password) && !empty($role_id) && !empty($birthday) && $term) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (firstName, lastName, email, password, role_id, birthday) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("ssssss", $firstName, $lastName, $email, $hashedPassword, $role_id, $birthday);

            if ($stmt->execute()) {
                $_SESSION["message"] = "Użytkownik został dodany pomyślnie!";
                $_SESSION["error"] = "success";
            } else {
                $_SESSION["message"] = "Błąd podczas dodawania użytkownika: " . $stmt->error;
                $_SESSION["error"] = "failure";
            }
            $stmt->close();
        } else {
            $_SESSION["message"] = "Błąd zapytania SQL: " . $conn->error;
            $_SESSION["error"] = "failure";
        }
    } else {
        $_SESSION["message"] = "Wszystkie pola muszą być wypełnione i regulamin zaakceptowany!";
        $_SESSION["error"] = "failure";
    }

    header("Location: ../pages/logged.php?view=users");
    exit;
} else {
    $_SESSION["message"] = "Nieprawidłowa metoda żądania.";
    $_SESSION["error"] = "failure";
    header("Location: ../pages/logged.php?view=users");
    exit;
}

$conn->close();
?>
