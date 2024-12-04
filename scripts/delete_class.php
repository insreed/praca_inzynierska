<?php
session_start();
require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['deleteClassId'])) {
    $class_id = intval($_GET['deleteClassId']);

    if (!empty($class_id)) {
        $query = "DELETE FROM klasa WHERE id_klasy = ?";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("i", $class_id);
            if ($stmt->execute()) {
                $_SESSION["message"] = "Klasa została usunięta!";
                $_SESSION["error"] = "success";
                header("Location: ../pages/logged.php?view=classes&action=delete&success=true");
            } else {
                $_SESSION["message"] = "Błąd podczas usuwania klasy: " . $stmt->error;
                $_SESSION["error"] = "failure";
                header("Location: ../pages/logged.php?view=classes&action=delete&success=false");
            }
            $stmt->close();
        } else {
            $_SESSION["message"] = "Błąd podczas przygotowywania zapytania SQL: " . $conn->error;
            $_SESSION["error"] = "failure";
            header("Location: ../pages/logged.php?view=classes&action=delete&success=false");
        }
    } else {
        $_SESSION["message"] = "ID klasy jest wymagane!";
        $_SESSION["error"] = "failure";
        header("Location: ../pages/logged.php?view=classes&action=delete&success=false");
    }
} else {
    $_SESSION["message"] = "Nieprawidłowa metoda żądania.";
    $_SESSION["error"] = "failure";
    header("Location: ../pages/logged.php?view=classes&action=delete&success=false");
}

$conn->close();
?>