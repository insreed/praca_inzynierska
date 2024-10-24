<?php
session_start();
require_once "./connect.php";

$error = 0;
foreach ($_POST as $key => $value){
    if (empty($value)){
        $_SESSION["message"] = "Wypełnij wszystkie pola";
        $error++;
    }
}

// Add field-specific validation rules here
if (empty($_POST["firstName"])) {
    $_SESSION["message"] = "Wpisz imię";
    $error++;
}

if (empty($_POST["lastName"])) {
    $_SESSION["message"] = "Wpisz nazwisko";
    $error++;
}

if (empty($_POST["password"])) {
    $_SESSION["message"] = "Wpisz hasło";
    $error++;
}

if (empty($_POST["email"])) {
    $_SESSION["message"] = "Wpisz adres email";
    $error++;
}

// Add more field validations if needed

if (!isset($_POST["term"])){
    $_SESSION["message"] = "Zatwierdź regulamin!";
    $error++;
}

if ($error != 0){
    echo "<script>history.back();</script>";
    exit();
}

$sql = "INSERT INTO `users` (`id`, `email`,`additional_email`,`firstName`, `lastName`, `birthday`, `password`) VALUES (NULL,'$_POST[email]','$_POST[additional_email]', '$_POST[firstName]', '$_POST[lastName]', '$_POST[birthday]', '$_POST[password]');";
$conn->query($sql);

$successMessage = "Pomyślnie dodano użytkownika!";
$failureMessage = "Nie udało się dodać użytkownika!";

if ($conn->affected_rows == 1) {
    $_SESSION["error"] = "success";
    $_SESSION["message"] = $successMessage;
    header("location: ../pages/logged.php?success=true");
} else {
    $_SESSION["error"] = "failure";
    $_SESSION["message"] = $failureMessage;
    header("location: ../pages/logged.php?success=false");
}
$conn->close();
//header("location: ../pages/logged.php");
