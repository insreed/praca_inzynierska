<?php
session_start();
require_once 'connect.php';

if (isset($_GET['deleteSubjectId'])) {
    $subject_id = intval($_GET['deleteSubjectId']);

    if (!empty($subject_id)) {
        $query = "DELETE FROM przedmioty WHERE id_przedmiotu = ?";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("i", $subject_id);
            if ($stmt->execute()) {
                $_SESSION["message"] = "Przedmiot został usunięty pomyślnie!";
                $_SESSION["error"] = "success";
            } else {
                $_SESSION["message"] = "Błąd podczas usuwania przedmiotu: " . $stmt->error;
                $_SESSION["error"] = "failure";
            }
            $stmt->close();
        } else {
            $_SESSION["message"] = "Błąd zapytania SQL: " . $conn->error;
            $_SESSION["error"] = "failure";
        }
    } else {
        $_SESSION["message"] = "Nieprawidłowe ID przedmiotu!";
        $_SESSION["error"] = "failure";
    }

    header("Location: ../pages/logged.php?view=subjects");
    exit;
}
?>