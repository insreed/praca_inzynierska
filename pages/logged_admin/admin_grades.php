<?php
require_once '../scripts/connect.php';

// Pobranie danych z tabel oceny i wpisy
$sql = "SELECT 
            wpisy.id_wpisu,
            wpisy.data_wpisu,
            wpisy.wartosc,
            przedmioty.nazwa_przedmiotu,
            CONCAT(uczniowie.firstName, ' ', uczniowie.lastName) AS uczen,
            CONCAT(nauczyciele.firstName, ' ', nauczyciele.lastName) AS nauczyciel
        FROM wpisy
        INNER JOIN oceny ON wpisy.id_oceny = oceny.id_oceny
        INNER JOIN przedmioty ON oceny.id_przedmiotu = przedmioty.id_przedmiotu
        INNER JOIN users AS uczniowie ON oceny.id_ucznia = uczniowie.id
        INNER JOIN users AS nauczyciele ON oceny.id_nauczyciela = nauczyciele.id
        ORDER BY wpisy.id_wpisu DESC";

$result = $conn->query($sql);
?>

<div class="container mt-4">
    <h2>Oceny z Wpisami</h2>

    <div class="table-responsive mt-4">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID Wpisu</th>
                    <th>Uczeń</th>
                    <th>Przedmiot</th>
                    <th>Wartość Oceny</th>
                    <th>Nauczyciel</th>
                    <th>Data Wpisu</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$row['id_wpisu']}</td>";
                        echo "<td>{$row['uczen']}</td>";
                        echo "<td>{$row['nazwa_przedmiotu']}</td>";
                        echo "<td>{$row['wartosc']}</td>";
                        echo "<td>{$row['nauczyciel']}</td>";
                        echo "<td>{$row['data_wpisu']}</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>Brak wpisów ocen w bazie danych.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
$conn->close();
?>
