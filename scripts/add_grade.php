<?php
session_start();
require_once "./connect.php";

// Obsługa dodawania wielu ocen
$grades = $_POST['grades']; // Oczekuje tablicy z ocenami (id_ucznia, wartosc)
$id_nauczyciela = $_POST['id_nauczyciela'];
$id_przedmiotu = $_POST['id_przedmiotu'];
$id_klasy = $_POST['id_klasy'];

$success = true;

// Przechodzimy przez każdą ocenę w tablicy $grades
foreach ($grades as $grade) {
    $id_ucznia = $grade['id_ucznia'];
    $wartosc = $grade['wartosc'];

    // Przygotuj zapytanie SQL do dodania oceny
    $sql = "INSERT INTO oceny (id_nauczyciela, id_przedmiotu, id_ucznia) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $id_nauczyciela, $id_przedmiotu, $id_ucznia);
    $stmt->execute();

    // Pobierz ID dodanej oceny
    $sql2 = "SELECT * FROM oceny ORDER BY id_oceny DESC LIMIT 1";
    $result = $conn->query($sql2);
    $row = $result->fetch_assoc();
    $id_oceny = $row['id_oceny'];

    // Dodaj wpis o wartości oceny
    $sql3 = "INSERT INTO wpisy (id_oceny, wartosc) VALUES (?, ?)";
    $stmt2 = $conn->prepare($sql3);
    $stmt2->bind_param("is", $id_oceny, $wartosc);
    $stmt2->execute();

    // Sprawdź, czy dodanie wpisu zakończyło się sukcesem
    if ($stmt2->affected_rows != 1) {
        $success = false;
        break;
    }

    // Zamknij bieżące zapytania
    $stmt->close();
    $stmt2->close();
}

// Ustaw wiadomość o sukcesie lub porażce
if ($success) {
    $_SESSION["error"] = "success";
    $_SESSION["message"] = "Pomyślnie dodano wszystkie oceny!";
} else {
    $_SESSION["error"] = "failure";
    $_SESSION["message"] = "Nie udało się dodać wszystkich ocen!";
}

// Zamknij połączenie z bazą danych
$conn->close();

// Przygotuj dane do przekierowania (utrzymanie klasy i przedmiotu)
header("location: ../pages/logged.php?subjectId=$id_przedmiotu&classId=$id_klasy");
exit();
?>
