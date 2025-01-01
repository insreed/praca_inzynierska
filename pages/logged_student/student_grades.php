<h2 class="m-1">Twoje oceny</h2>
<hr>
<div class="oceny">
    <?php
    $user_id = $_SESSION["logged"]["user_id"];
    require_once "../scripts/connect.php";

    // Pobranie klasy
    $klasa_query = "SELECT * FROM przydział_klasy INNER JOIN klasa ON przydział_klasy.id_klasy = klasa.id_klasy WHERE id_uzytkownika = $user_id";
    $klasa_result = $conn->query($klasa_query);

    while ($klasa_row = mysqli_fetch_assoc($klasa_result)) {
        $klasa = $klasa_row['nazwa'];
        $id_klasy = $klasa_row['id_klasy'];
    }

    // Pobranie przedmiotów i ocen
    $przedmioty_query = "SELECT DISTINCT przedmioty.nazwa_przedmiotu, przedmioty.id_przedmiotu 
                         FROM users 
                         INNER JOIN oceny ON users.id = oceny.id_ucznia 
                         NATURAL JOIN przedmioty 
                         WHERE users.id = $user_id";
    $przedmioty_result = $conn->query($przedmioty_query);

    while ($przedmiot_row = mysqli_fetch_assoc($przedmioty_result)) {
        $nazwa_przedmiotu = $przedmiot_row['nazwa_przedmiotu'];
        $id_przedmiotu = $przedmiot_row['id_przedmiotu'];

        echo "<div class='przedmiot'>";
        echo "<h4>$nazwa_przedmiotu</h4>";

        $oceny_query = "SELECT * 
                        FROM oceny 
                        INNER JOIN users ON users.id = oceny.id_nauczyciela 
                        WHERE oceny.id_ucznia = $user_id AND oceny.id_przedmiotu = $id_przedmiotu";
        $oceny_result = $conn->query($oceny_query);

        while ($ocena_row = mysqli_fetch_assoc($oceny_result)) {
            $nauczyciel = $ocena_row['lastName'] . " " . $ocena_row['firstName'];
            $id_oceny = $ocena_row['id_oceny'];

            $wpisy_query = "SELECT * 
                            FROM wpisy 
                            INNER JOIN oceny ON oceny.id_oceny = wpisy.id_oceny 
                            INNER JOIN users ON users.id = oceny.id_nauczyciela 
                            WHERE wpisy.id_oceny = $id_oceny 
                            ORDER BY data_wpisu DESC LIMIT 1";
            $wpisy_result = $conn->query($wpisy_query);

            while ($wpis_row = mysqli_fetch_assoc($wpisy_result)) {
                $modyfikacje_query = "SELECT * 
                                      FROM wpisy 
                                      INNER JOIN oceny ON oceny.id_oceny = wpisy.id_oceny 
                                      INNER JOIN users ON users.id = oceny.id_nauczyciela 
                                      WHERE wpisy.id_oceny = $id_oceny 
                                      ORDER BY data_wpisu DESC";
                $modyfikacje_result = $conn->query($modyfikacje_query);

                $info = "<b>Wpisana przez:<br>$nauczyciel</b><br>Modyfikacje:<br>";
                while ($modyfikacja_row = mysqli_fetch_assoc($modyfikacje_result)) {
                    $info .= "Ocena: " . $modyfikacja_row["wartosc"] . " ";
                    $info .= $modyfikacja_row["data_wpisu"] . " ";
                }

                echo '<span class="ocena kolor' . $wpis_row['wartosc'] . '" title="' . $info . '" data-html="true" data-toggle="tooltip" data-placement="top">' . $wpis_row['wartosc'] . '</span>';
            }
        }
        echo "</div>";
    }
    ?>
</div>