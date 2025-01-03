<?php
require_once '../scripts/connect.php';

// Pobranie danych z tabel oceny i wpisy
$sql = "SELECT 
            wpisy.id_wpisu,
            wpisy.data_wpisu,
            wpisy.wartosc,
            wpisy.opis_oceny,
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

<div class="container mt-5 pt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="text-center mb-0">Oceny z Wpisami</h2>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Lista Ocen</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="bg-dark text-white thead-dark">
                        <tr>
                            <th>ID Wpisu</th>
                            <th>Uczeń</th>
                            <th>Przedmiot</th>
                            <th>Ocena</th>
                            <th>Nauczyciel</th>
                            <th>Data Wpisu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $wartosc = intval($row['wartosc']);
                                $data_wpisu = date("d-m-Y H:i", strtotime($row['data_wpisu']));
                                $opis_oceny = !empty($row['opis_oceny']) ? htmlspecialchars($row['opis_oceny']) : "Brak opisu";

                                $info = "Uczeń: {$row['uczen']}<br>Przedmiot: {$row['nazwa_przedmiotu']}<br>Nauczyciel: {$row['nauczyciel']}<br>Data: $data_wpisu<br>Komentarz: $opis_oceny";

                                echo "<tr>";
                                echo "<td>{$row['id_wpisu']}</td>";
                                echo "<td>{$row['uczen']}</td>";
                                echo "<td>{$row['nazwa_przedmiotu']}</td>";
                                echo '<td><span class="ocena kolor' . $wartosc . '" title="' . $info . '" data-html="true" data-toggle="tooltip" data-placement="top">' . $wartosc . '</span></td>';
                                echo "<td>{$row['nauczyciel']}</td>";
                                echo "<td>$data_wpisu</td>";
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
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<?php
$conn->close();
?>