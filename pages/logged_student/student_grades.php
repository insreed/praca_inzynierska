<div class="container mt-5 pt-5">
    <!-- Content Header -->
    <div class="text-center mb-5">
        <h1 class="display-4">Twoje Oceny</h1>
    </div>

    <div class="row justify-content-center">
        <?php
        $user_id = $_SESSION["logged"]["user_id"];
        require_once "../scripts/connect.php";

        // Pobranie przedmiotów i ocen
        $przedmioty_query = "SELECT DISTINCT przedmioty.nazwa_przedmiotu, przedmioty.id_przedmiotu 
                             FROM users 
                             INNER JOIN oceny ON users.id = oceny.id_ucznia 
                             NATURAL JOIN przedmioty 
                             WHERE users.id = $user_id";
        $przedmioty_result = $conn->query($przedmioty_query);

        $colors = ['bg-primary', 'bg-success', 'bg-info', 'bg-warning', 'bg-danger', 'bg-secondary'];
        $color_index = 0;

        while ($przedmiot_row = mysqli_fetch_assoc($przedmioty_result)) {
            $nazwa_przedmiotu = $przedmiot_row['nazwa_przedmiotu'];
            $id_przedmiotu = $przedmiot_row['id_przedmiotu'];

            // Pobranie średniej ocen dla przedmiotu
            $srednia_query = "SELECT ROUND(AVG(wpisy.wartosc), 2) AS avg_grade 
                              FROM wpisy 
                              INNER JOIN oceny ON wpisy.id_oceny = oceny.id_oceny 
                              WHERE oceny.id_ucznia = $user_id AND oceny.id_przedmiotu = $id_przedmiotu";
            $srednia_result = $conn->query($srednia_query);
            $srednia_row = $srednia_result->fetch_assoc();
            $avg_grade = $srednia_row['avg_grade'] ?: "Brak";

            // Przypisanie koloru na podstawie id_przedmiotu
            $color_class = $colors[$color_index % count($colors)];
            $color_index++;

            echo '<div class="col-12 mb-4">';
            echo '<div class="card shadow-sm">';
            echo '<div class="card-header ' . $color_class . ' text-white d-flex justify-content-between align-items-center">';
            echo "<span class='card-title'>$nazwa_przedmiotu</span>";
            echo "<span class='fw-bold ml-auto'>Średnia: $avg_grade</span>";
            echo '</div>';
            echo '<div class="card-body">';

            $oceny_query = "SELECT wpisy.wartosc, wpisy.data_wpisu, wpisy.opis_oceny, users.firstName, users.lastName 
                            FROM wpisy 
                            INNER JOIN oceny ON wpisy.id_oceny = oceny.id_oceny 
                            INNER JOIN users ON oceny.id_nauczyciela = users.id 
                            WHERE oceny.id_ucznia = $user_id AND oceny.id_przedmiotu = $id_przedmiotu 
                            ORDER BY wpisy.data_wpisu DESC";
            $oceny_result = $conn->query($oceny_query);

            if ($oceny_result->num_rows > 0) {
                while ($ocena_row = mysqli_fetch_assoc($oceny_result)) {
                    $wartosc = $ocena_row['wartosc'];
                    $data_wpisu = date("d-m-Y H:i", strtotime($ocena_row['data_wpisu']));
                    $nauczyciel = $ocena_row['firstName'] . " " . $ocena_row['lastName'];
                    $opis_oceny = $ocena_row['opis_oceny'] ?: "Brak";

                    $info = "Ocena: $wartosc<br>Nauczyciel: $nauczyciel<br>Data: $data_wpisu<br>Komentarz:<br>$opis_oceny";
                    echo '<span class="ocena kolor' . $wartosc . '" title="' . $info . '" data-html="true" data-toggle="tooltip" data-placement="top">' . $wartosc . '</span>';
                }
            } else {
                echo '<p class="text-muted">Brak ocen dla tego przedmiotu</p>';
            }

            echo '</div>'; // card-body
            echo '</div>'; // card
            echo '</div>'; // col-12
        }
        ?>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>