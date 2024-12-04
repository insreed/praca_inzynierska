<style>
.ocena {
    padding: 5px 10px 5px 10px;
    margin-right: 10px;
    border-radius: 5px;
    color: black;
    margin-top: 20px;
}
.oceny {
    padding-left: 20px;
}
.kolor1 {background-color: rgb(255, 0, 0)}
.kolor2 {background-color: rgb(255, 145, 0)}
.kolor3 {background-color: rgb(255, 208, 0)}
.kolor4 {background-color: rgb(204, 255, 0)}
.kolor5 {background-color: rgb(72, 255, 0)}
.kolor6 {background-color: rgb(0, 255, 149)}

.tooltip {
    z-index: 1112;
    position: absolute;
}
</style>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Panel Nauczyciela</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Panel Nauczyciela</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div style='margin: 0 auto; height: 700px; overflow-y: scroll;'>
            <?php
            require_once "../scripts/connect.php";

            // Display classes assigned to the teacher after selecting a subject
            $teacher_id = $_SESSION["logged"]["user_id"];

            if (!isset($_GET["subjectId"])) {
                echo "<h3>Wybierz przedmiot z panelu bocznego, aby kontynuować.</h3>";
            }

            if (isset($_GET["subjectId"])) {
                $subject_id = intval($_GET["subjectId"]);
                
                if (!isset($_GET["classId"])) {
                    // Fetch classes assigned to the teacher for the selected subject
                    $class_sql = "SELECT DISTINCT klasa.id_klasy, klasa.nazwa 
                                  FROM przydział_nauczyciel
                                  INNER JOIN klasa ON przydział_nauczyciel.id_klasy = klasa.id_klasy
                                  WHERE przydział_nauczyciel.id_nauczyciela = $teacher_id AND przydział_nauczyciel.id_przedmiotu = $subject_id";
                    $class_result = $conn->query($class_sql);

                    if ($class_result->num_rows > 0) {
                        echo "<h3>Wybierz klasę:</h3>";
                        echo "<ul>";
                        while ($class = $class_result->fetch_assoc()) {
                            echo "<li><a href='logged.php?subjectId=$subject_id&classId=" . $class['id_klasy'] . "'>" . $class['nazwa'] . "</a></li>";
                        }
                        echo "</ul>";
                    } else {
                        echo "Brak klas przypisanych do tego nauczyciela dla wybranego przedmiotu.";
                    }
                }
            }

            // Display students and their grades for the selected class and subject
            if (isset($_GET["classId"]) && isset($_GET["subjectId"])) {
                $class_id = intval($_GET["classId"]);
                $subject_id = intval($_GET["subjectId"]);
                
                // Display the selected class information
                $class_name_sql = "SELECT nazwa FROM klasa WHERE id_klasy = $class_id";
                $class_name_result = $conn->query($class_name_sql);
                if ($class_name_result->num_rows > 0) {
                    $class_name = $class_name_result->fetch_assoc()['nazwa'];
                    echo "<h3>Oceny dla klasy: $class_name</h3>";
                }

                // Fetch students for the selected class
                $students_sql = "SELECT users.id AS id, users.firstName, users.lastName, users.email 
                                 FROM `users`
                                 INNER JOIN `przydział_klasy` ON `przydział_klasy`.`id_uzytkownika` = `users`.`id`
                                 WHERE `przydział_klasy`.`id_klasy` = $class_id AND `users`.`role_id` = 1";
                $students_result = $conn->query($students_sql);

                if ($students_result->num_rows > 0) {
                    echo "<table style='width: 100%; min-width: 960px'>
                            <tr>
                                <th>Imię i Nazwisko</th>
                                <th>Oceny</th>
                                <th>Dodaj ocenę</th>
                            </tr>";

                    while ($student = $students_result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $student["firstName"] . " " . $student["lastName"] . "</td>";
                        
                        // Fetch grades for each student in the selected subject
                        $student_id = $student['id'];
                        $grades_sql = "SELECT przedmioty.nazwa_przedmiotu, wpisy.wartosc 
                                       FROM oceny
                                       LEFT JOIN wpisy ON oceny.id_oceny = wpisy.id_oceny
                                       INNER JOIN przedmioty ON oceny.id_przedmiotu = przedmioty.id_przedmiotu
                                       WHERE oceny.id_ucznia = $student_id AND oceny.id_przedmiotu = $subject_id";
                        $grades_result = $conn->query($grades_sql);

                        echo "<td class='oceny'>";
                        if ($grades_result && $grades_result->num_rows > 0) {
                            while ($grade = $grades_result->fetch_assoc()) {
                                echo "<span class='ocena kolor" . min(intval($grade['wartosc']), 6) . "'>" . htmlspecialchars($grade['nazwa_przedmiotu']) . ": " . htmlspecialchars($grade['wartosc']) . "</span> ";
                            }
                        } else {
                            echo "Brak ocen";
                        }
                        echo "</td>";

                        // Form to add a grade
                        $current_url = "logged.php?subjectId=$subject_id&classId=$class_id";
                        echo "<td>"
                            . "<form action='../scripts/add_grade.php' method='post'>"
                            . "<input type='hidden' name='id_nauczyciela' value='$teacher_id'>"
                            . "<input type='hidden' name='id_przedmiotu' value='$subject_id'>"
							. "<input type='hidden' name='id_klasy' value='$class_id'>"
                            . "<input type='hidden' name='id_ucznia' value='$student_id'>"
                            . "<input type='number' name='wartosc' min='1' max='6' required>"
                            . "<button type='submit'>Dodaj ocenę</button>"
                            . "</form>"
                            . "</td>";

                        echo "</tr>";
                    }

                    echo "</table>";
                } else {
                    echo "Brak uczniów w tej klasie.";
                }
            }
            ?>
            </div>
        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
