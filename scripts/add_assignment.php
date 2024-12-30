<?php
session_start();
require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $teacherId = intval($_POST['teacher_id']);
    $classId = intval($_POST['class_id']);
    $subjectId = intval($_POST['subject_id']);

    if ($teacherId > 0 && $classId > 0 && $subjectId > 0) {
        $sql = "INSERT INTO przydział_nauczyciel (id_nauczyciela, id_klasy, id_przedmiotu) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iii", $teacherId, $classId, $subjectId);

        if ($stmt->execute()) {
            $_SESSION["message"] = "Przydział został dodany pomyślnie.";
            $_SESSION["error"] = "success";
        } else {
            $_SESSION["message"] = "Błąd podczas dodawania przydziału: " . $stmt->error;
            $_SESSION["error"] = "failure";
        }

        $stmt->close();
    } else {
        $_SESSION["message"] = "Wszystkie pola muszą być wypełnione.";
        $_SESSION["error"] = "failure";
    }

    $conn->close();
    header("Location: ../pages/logged.php?view=assign_teacher&teacher_id={$teacherId}");
    exit();
}
?>