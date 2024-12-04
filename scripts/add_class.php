<?php
session_start();
require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $class_name = trim($_POST['className']);

    if (!empty($class_name)) {
        $query = "INSERT INTO klasa (nazwa) VALUES (?)";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("s", $class_name);
            if ($stmt->execute()) {
                $_SESSION["message"] = "Klasa została dodana pomyślnie!";
                $_SESSION["error"] = "success";
                header("Location: ../pages/logged.php?view=classes&action=add&success=true");
            } else {
                $_SESSION["message"] = "Błąd podczas dodawania klasy: " . $stmt->error;
                $_SESSION["error"] = "failure";
                header("Location: ../pages/logged.php?view=classes&action=add&success=false");
            }
            $stmt->close();
        } else {
            $_SESSION["message"] = "Błąd podczas przygotowywania zapytania SQL: " . $conn->error;
            $_SESSION["error"] = "failure";
            header("Location: ../pages/logged.php?view=classes&action=add&success=false");
        }
    } else {
        $_SESSION["message"] = "Nazwa klasy nie może być pusta!";
        $_SESSION["error"] = "failure";
        header("Location: ../pages/logged.php?view=classes&action=add&success=false");
    }
} else {
    $_SESSION["message"] = "Nieprawidłowa metoda żądania.";
    $_SESSION["error"] = "failure";
    header("Location: ../pages/logged.php?view=classes&action=add&success=false");
}

$conn->close();
?>