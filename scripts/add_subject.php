<?php
session_start();
require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject_name = trim($_POST['subjectName']);

    if (!empty($subject_name)) {
        $query = "INSERT INTO przedmioty (nazwa_przedmiotu) VALUES (?)";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("s", $subject_name);
            if ($stmt->execute()) {
                $_SESSION["message"] = "Przedmiot został dodany pomyślnie!";
                $_SESSION["error"] = "success";
            } else {
                $_SESSION["message"] = "Błąd podczas dodawania przedmiotu: " . $stmt->error;
                $_SESSION["error"] = "failure";
            }
            $stmt->close();
        } else {
            $_SESSION["message"] = "Błąd zapytania SQL: " . $conn->error;
            $_SESSION["error"] = "failure";
        }
    } else {
        $_SESSION["message"] = "Nazwa przedmiotu nie może być pusta!";
        $_SESSION["error"] = "failure";
    }

    header("Location: ../pages/logged.php?view=subjects");
    exit;
}
?>
