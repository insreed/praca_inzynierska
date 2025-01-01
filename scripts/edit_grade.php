<?php
session_start();
require_once "./connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_oceny = $_POST['id_oceny'];
    $wartosc = $_POST['wartosc'];
    $opis_oceny = $_POST['opis_oceny'];

    // Aktualizacja oceny w bazie danych
    $sql = "UPDATE wpisy SET wartosc = ?, opis_oceny = ? WHERE id_oceny = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isi", $wartosc, $opis_oceny, $id_oceny);
    $stmt->execute();

    if ($stmt->affected_rows >= 0) {
        $_SESSION["error"] = "success";
        $_SESSION["message"] = "Ocena została pomyślnie zaktualizowana!";
    } else {
        $_SESSION["error"] = "failure";
        $_SESSION["message"] = "Nie udało się zaktualizować oceny!";
    }

    $stmt->close();
    $conn->close();

    // Powrót do strony
    header("location: ../pages/logged.php");
    exit();
}
?>
