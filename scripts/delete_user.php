<?php
session_start();
require_once"./connect.php";
// Usuwanie
$sql = "DELETE FROM `users` WHERE `users`.`id` = $_GET[deleteUserId]";
$result = $conn->query($sql);
echo $conn->affected_rows;

$successMessage = "Pomyślnie usunięto użytkownika";
$failureMessage = "Nie udało się usunąć użytkownika";

if ($conn->affected_rows == 0) {
  $_SESSION["error"] = "failure";
  $_SESSION["message"] = $failureMessage;
  header("location: ../pages/logged.php?success=false");
} else {
  $_SESSION["error"] = "success";
  $_SESSION["message"] = $successMessage;
  header("location: ../pages/logged.php?success=true");
}
$conn->close();
