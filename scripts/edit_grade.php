<?php
session_start();
require_once "./connect.php";

header('Content-Type: application/json'); // Zwracaj dane w formacie JSON

$response = ["success" => false, "message" => ""];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_oceny = $_POST['id_oceny'];
    $wartosc = $_POST['wartosc'];
    $opis_oceny = $_POST['opis_oceny'];

    $sql = "UPDATE wpisy SET wartosc = ?, opis_oceny = ? WHERE id_oceny = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isi", $wartosc, $opis_oceny, $id_oceny);

    if ($stmt->execute()) {
        $response["success"] = true;
        $response["message"] = "Ocena została pomyślnie zaktualizowana!";
        $_SESSION["message"] = $response["message"];
        $_SESSION["error"] = "success";
    } else {
        $response["message"] = "Nie udało się zaktualizować oceny!";
        $_SESSION["message"] = $response["message"];
        $_SESSION["error"] = "failure";
    }

    $stmt->close();
    $conn->close();
} else {
    $response["message"] = "Nieprawidłowe żądanie!";
    $_SESSION["message"] = $response["message"];
    $_SESSION["error"] = "failure";
}

echo json_encode($response); // Zwróć odpowiedź JSON
exit();


