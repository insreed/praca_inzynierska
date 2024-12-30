<?php
session_start();
require_once 'connect.php';

if (isset($_GET['assignment_id']) && isset($_GET['teacher_id'])) {
    $assignmentId = intval($_GET['assignment_id']);
    $teacherId = intval($_GET['teacher_id']);

    if ($assignmentId > 0) {
        $sql = "DELETE FROM przydział_nauczyciel WHERE id_przydzialu = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $assignmentId);

        if ($stmt->execute()) {
            $_SESSION["message"] = "Przydział został usunięty pomyślnie.";
            $_SESSION["error"] = "success";
        } else {
            $_SESSION["message"] = "Błąd podczas usuwania przydziału: " . $stmt->error;
            $_SESSION["error"] = "failure";
        }

        $stmt->close();
    } else {
        $_SESSION["message"] = "Nieprawidłowy identyfikator przydziału.";
        $_SESSION["error"] = "failure";
    }

    $conn->close();
    header("Location: ../pages/logged.php?view=assign_teacher&teacher_id={$teacherId}");
    exit();
}
?>
