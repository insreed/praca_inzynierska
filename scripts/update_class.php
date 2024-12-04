<?php
session_start();
require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $class_id = intval($_POST['class_id']);
    $class_name = trim($_POST['className']);

    if (!empty($class_id) && !empty($class_name)) {
        $query = "UPDATE klasa SET nazwa = ? WHERE id_klasy = ?";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("si", $class_name, $class_id);
            if ($stmt->execute()) {
                $_SESSION["message"] = "Klasa została zaktualizowana pomyślnie!";
                $_SESSION["error"] = "success";
                header("Location: ../pages/logged.php?view=classes&action=edit&success=true");
            } else {
                $_SESSION["message"] = "Błąd podczas aktualizacji klasy: " . $stmt->error;
                $_SESSION["error"] = "failure";
                header("Location: ../pages/logged.php?view=classes&action=edit&success=false");
            }
            $stmt->close();
        } else {
            $_SESSION["message"] = "Błąd podczas przygotowywania zapytania SQL: " . $conn->error;
            $_SESSION["error"] = "failure";
            header("Location: ../pages/logged.php?view=classes&action=edit&success=false");
        }
    } else {
        $_SESSION["message"] = "Wszystkie pola muszą być wypełnione!";
        $_SESSION["error"] = "failure";
        header("Location: ../pages/logged.php?view=classes&action=edit&success=false");
    }
} else {
    $_SESSION["message"] = "Nieprawidłowa metoda żądania.";
    $_SESSION["error"] = "failure";
    header("Location: ../pages/logged.php?view=classes&action=edit&success=false");
}

$conn->close();
?>
