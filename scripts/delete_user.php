<?php
session_start();
require_once "./connect.php";

// Sprawdzenie, czy ID użytkownika zostało przekazane i jest liczbą
if (!isset($_GET['deleteUserId']) || !is_numeric($_GET['deleteUserId'])) {
  $_SESSION["message"] = "Nieprawidłowe ID użytkownika!";
  header("location: ../pages/logged.php?view=users&action=delete&success=false");
  exit();
}

// Przygotowanie zapytania do usunięcia użytkownika
$userId = $_GET['deleteUserId'];
$query = "DELETE FROM `users` WHERE `id` = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);

if ($stmt->execute()) {
  if ($stmt->affected_rows > 0) {
    $_SESSION["message"] = "Pomyślnie usunięto użytkownika";
    header("location: ../pages/logged.php?view=users&action=delete&success=true");
  } else {
    $_SESSION["message"] = "Nie udało się usunąć użytkownika. Użytkownik o podanym ID nie istnieje.";
    header("location: ../pages/logged.php?view=users&action=delete&success=false");
  }
} else {
  $_SESSION["message"] = "Błąd podczas usuwania użytkownika!";
  header("location: ../pages/logged.php?view=users&action=delete&success=false");
}

// Zamknięcie połączenia
$stmt->close();
$conn->close();
?>
