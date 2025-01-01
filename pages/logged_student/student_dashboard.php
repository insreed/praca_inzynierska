<div class="container mt-5 pt-5">
    <!-- Content Header -->
    <div class="text-center mb-5">
        <h1 class="display-4">Panel Studenta</h1>
    </div>

    <div class="row justify-content-center">
        <!-- Nowe oceny -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0">Nowe Oceny</h5>
                </div>
                <div class="card-body text-center">
                    <div class="oceny">
                        <?php
                        $user_id = $_SESSION["logged"]["user_id"];
                        require_once "../scripts/connect.php";

                        // Pobranie ostatnich ocen, które nie zostały jeszcze oznaczone jako widoczne
                        $queryNewGrades = "
                            SELECT wpisy.id_wpisu, wpisy.wartosc, wpisy.data_wpisu, wpisy.komentarz, users.firstName, users.lastName, przedmioty.nazwa_przedmiotu
                            FROM wpisy
                            INNER JOIN oceny ON wpisy.id_oceny = oceny.id_oceny
                            INNER JOIN users ON oceny.id_nauczyciela = users.id
                            INNER JOIN przedmioty ON oceny.id_przedmiotu = przedmioty.id_przedmiotu
                            WHERE oceny.id_ucznia = ? AND wpisy.widzial = 0
                            ORDER BY wpisy.data_wpisu DESC
                            LIMIT 10";
                        $stmtNewGrades = $conn->prepare($queryNewGrades);
                        $stmtNewGrades->bind_param("i", $user_id);
                        $stmtNewGrades->execute();
                        $resultNewGrades = $stmtNewGrades->get_result();

                        if ($resultNewGrades->num_rows > 0) {
                            $idsToUpdate = [];
                            while ($grade = $resultNewGrades->fetch_assoc()) {
                                $wartosc = $grade['wartosc'];
                                $data_wpisu = date("d-m-Y H:i", strtotime($grade['data_wpisu']));
                                $nauczyciel = $grade['firstName'] . " " . $grade['lastName'];
                                $przedmiot = $grade['nazwa_przedmiotu'];
                                $komentarz = !empty($grade['komentarz']) ? $grade['komentarz'] : "Brak";

                                $info = "Przedmiot: $przedmiot<br>Ocena: $wartosc<br>Nauczyciel: $nauczyciel<br>Data: $data_wpisu<br>Komentarz: $komentarz";

                                echo '<span class="ocena kolor' . $wartosc . '" title="' . $info . '" data-html="true" data-toggle="tooltip" data-placement="top">' . $wartosc . '</span>';

                                // Zbieraj ID wpisów, które mają zostać oznaczone jako widoczne
                                $idsToUpdate[] = $grade['id_wpisu'];
                            }

                            // Oznacz oceny jako widoczne w bazie danych
                            if (!empty($idsToUpdate)) {
                                $idsToUpdateList = implode(',', $idsToUpdate);
                                $updateQuery = "UPDATE wpisy SET widzial = 1 WHERE id_wpisu IN ($idsToUpdateList)";
                                $conn->query($updateQuery);
                            }
                        } else {
                            echo "<p class='text-muted'>Brak nowych ocen</p>";
                        }
                        ?>
                    </div>
                    <div class="mt-3">
                        <a href="?view=grades" class="btn btn-info">Przejdź do ocen</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informacje -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">Informacje</h5>
                </div>
                <div class="card-body text-center">
                    <p>Witaj w swoim panelu! Tutaj możesz sprawdzić swoje najnowsze oceny, średnie oraz przeglądać
                        szczegóły ocen z każdego przedmiotu.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
</div>

<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>