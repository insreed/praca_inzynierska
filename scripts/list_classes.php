<?php
require_once 'connect.php';

$query = "SELECT * FROM klasa";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $classes = [];
    while ($row = $result->fetch_assoc()) {
        $classes[] = $row;
    }
    echo json_encode($classes);
} else {
    echo json_encode([]);
}
?>
