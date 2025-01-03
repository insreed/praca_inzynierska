<?php
session_start();
require_once "./connect.php";

// Pobierz dane z żądania
$data = json_decode(file_get_contents("php://input"), true);
$id_oceny = $data['id_oceny'];

$response = ['success' => false];

if ($id_oceny) {
    // Usuń wpis z tabeli wpisy
    $sql1 = "DELETE FROM wpisy WHERE id_oceny = ?";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param("i", $id_oceny);
    $stmt1->execute();

    // Sprawdź, czy usunięto wpis
    if ($stmt1->affected_rows > 0) {
        // Usuń ocenę z tabeli oceny
        $sql2 = "DELETE FROM oceny WHERE id_oceny = ?";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param("i", $id_oceny);
        $stmt2->execute();

        // Sprawdź, czy usunięto ocenę
        if ($stmt2->affected_rows > 0) {
            $response['success'] = true;
            $response["message"] = "Ocena została usunięta pomyślnie!";
            $_SESSION["message"] = $response["message"];
            $_SESSION["error"] = "success";
        }
        else{
            $response["message"] = "Nie udało się zaktualizować oceny!";
            $_SESSION["message"] = $response["message"];
            $_SESSION["error"] = "failure"; 
        }
    }

    // Zamknij zapytania
    $stmt1->close();
    $stmt2->close();
}

// Zamknij połączenie z bazą danych
$conn->close();

// Wyślij odpowiedź jako JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
