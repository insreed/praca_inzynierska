<?php
session_start();
require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject_id = intval($_POST['subject_id']);
    $subject_name = trim($_POST['subjectName']);

    if (!empty($subject_id) && !empty($subject_name)) {
        $query = "UPDATE przedmioty SET nazwa_przedmiotu = ? WHERE id_przedmiotu = ?";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("si", $subject_name, $subject_id);
            if ($stmt->execute()) {
                $_SESSION["message"] = "Przedmiot został zaktualizowany pomyślnie!";
                $_SESSION["error"] = "success";
            } else {
                $_SESSION["message"] = "Błąd podczas aktualizacji przedmiotu: " . $stmt->error;
                $_SESSION["error"] = "failure";
            }
            $stmt->close();
        } else {
            $_SESSION["message"] = "Błąd zapytania SQL: " . $conn->error;
            $_SESSION["error"] = "failure";
        }
    } else {
        $_SESSION["message"] = "Wszystkie pola muszą być wypełnione!";
        $_SESSION["error"] = "failure";
    }

    header("Location: ../pages/logged.php?view=subjects");
    exit;
}
?>