<?php
session_start();
require_once "./connect.php";

// Przygotuj zapytanie SQL do dodania oceny
$sql = "INSERT INTO oceny (id_nauczyciela, id_przedmiotu, id_ucznia) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $_POST['id_nauczyciela'], $_POST['id_przedmiotu'], $_POST['id_ucznia']);
$stmt->execute();

// Pobierz ID dodanej oceny
$sql2 = "SELECT * FROM oceny ORDER BY id_oceny DESC LIMIT 1";
$result = $conn->query($sql2);
$row = $result->fetch_assoc();
$id_oceny = $row['id_oceny'];

// Dodaj wpis o wartości oceny
$sql3 = "INSERT INTO wpisy (id_oceny, wartosc) VALUES (?, ?)";
$stmt2 = $conn->prepare($sql3);
$stmt2->bind_param("is", $id_oceny, $_POST['wartosc']);
$stmt2->execute();

// Sprawdź, czy dodanie wpisu zakończyło się sukcesem
$successMessage = "Pomyślnie dodano ocenę!";
$failureMessage = "Nie udało się dodać oceny!";
if ($stmt2->affected_rows == 1) {
    $_SESSION["error"] = "success";
    $_SESSION["message"] = $successMessage;
} else {
    $_SESSION["error"] = "failure";
    $_SESSION["message"] = $failureMessage;
}

// Zamknij połączenie z bazą danych
$stmt->close();
$stmt2->close();
$conn->close();

// Przygotuj dane do przekierowania (utrzymanie klasy i przedmiotu)
$id_przedmiotu = $_POST['id_przedmiotu'];
$id_klasy = $_POST['id_klasy']; // Dodaj pole id_klasy w formularzu
header("location: ../pages/logged.php?subjectId=$id_przedmiotu&classId=$id_klasy");
exit();
?>
