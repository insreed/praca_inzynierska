<?php
session_start();
require_once 'connect.php';

if (isset($_GET['deleteUserId'])) {
  $userId = intval($_GET['deleteUserId']);

  // Przygotowanie zapytania do usunięcia użytkownika
  $sql = "DELETE FROM users WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $userId);

  if ($stmt->execute()) {
    $_SESSION["message"] = "Pomyślnie usunięto użytkownika";
    $_SESSION["error"] = "success";
  } else {
    $_SESSION["message"] = "Błąd podczas usuwania użytkownika";
    $_SESSION["error"] = "failure";
  }

  $stmt->close();
  $conn->close();

  // Przekierowanie z parametrem do admin_users.php
  header("Location: ../pages/logged.php?view=users");
  exit();
}
?>