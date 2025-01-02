<link rel="stylesheet" href="../styles/teacher.css">
<div class="content-wrapper">
    <!-- <div class="content-header">
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
    </div> -->

    <section class="content">
        <div class="container-fluid">
            <?php
                if (!isset($_GET["subjectId"])) {
                    include "teacher-dashboard.php";
                } else {
            ?>
            <form action="../scripts/add_grade.php" method="post">
                <div style='margin: 0 auto;'>
                    <?php
                    require_once "../scripts/connect.php";

                    // wyswietlenie klas po wybraniu przedmiotu
                    $teacher_id = $_SESSION["logged"]["user_id"];

                    

                   
                    // wyswietlanie studentow i ich ocen
                    if (isset($_GET["classId"]) && isset($_GET["subjectId"])) {
                        $class_id = intval($_GET["classId"]);
                        $subject_id = intval($_GET["subjectId"]);

                        // Pobranie nazwy klasy
                        $class_name_sql = "SELECT nazwa FROM klasa WHERE id_klasy = $class_id";
                        $class_name_result = $conn->query($class_name_sql);
                        $class_name = "Nieznana klasa"; // Domyślna wartość

                        if ($class_name_result->num_rows > 0) {
                            $class_name = $class_name_result->fetch_assoc()['nazwa'];
                        }

                        // Pobranie nazwy przedmiotu
                        $subject_name_sql = "SELECT nazwa_przedmiotu FROM przedmioty WHERE id_przedmiotu = $subject_id";
                        $subject_name_result = $conn->query($subject_name_sql);
                        $subject_name = "Nieznany przedmiot"; // Domyślna wartość

                        if ($subject_name_result->num_rows > 0) {
                            $subject_name = $subject_name_result->fetch_assoc()['nazwa_przedmiotu'];
                        }

                        // Wyświetlenie nagłówka
                        echo "<div class='m-2'>";
                            echo "<h1 class='p-4'>Oceny dla klasy $class_name | Przedmiot: $subject_name</h1>";
                        echo "</div>";


                        // pobranie studenow
                        $students_sql = "SELECT users.id AS id, users.firstName, users.lastName, users.email 
                                         FROM users
                                         INNER JOIN przydział_klasy ON przydział_klasy.id_uzytkownika = users.id
                                         WHERE przydział_klasy.id_klasy = $class_id AND users.role_id = 1";
                        $students_result = $conn->query($students_sql);

                        if ($students_result->num_rows > 0) {
                            echo "<table style='width: 100%; min-width: 960px;'>
                                    <tr>
                                        <th style='width:20%; min-width: 250px;'>Imię i Nazwisko</th>
                                        <th>Oceny</th>
                                        <th style='width:20%; min-width: 250px;'>Dodaj ocenę</th>
                                    </tr>";

                            while ($student = $students_result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $student["firstName"] . " " . $student["lastName"] . "</td>";

                                // pobranie ocen
                                $student_id = $student['id'];
                                $grades_sql = "SELECT przedmioty.nazwa_przedmiotu, wpisy.wartosc, wpisy.opis_oceny, wpisy.data_wpisu
                                    FROM oceny
                                    LEFT JOIN wpisy ON oceny.id_oceny = wpisy.id_oceny
                                    INNER JOIN przedmioty ON oceny.id_przedmiotu = przedmioty.id_przedmiotu
                                    WHERE oceny.id_ucznia = $student_id AND oceny.id_przedmiotu = $subject_id";

                                $grades_result = $conn->query($grades_sql);

                                echo "<td class='oceny'>";
                                if ($grades_result && $grades_result->num_rows > 0) {
                                    while ($grade = $grades_result->fetch_assoc()) {
                                        $grade_value = intval($grade['wartosc']);
                                        $grade_description = !empty($grade['opis_oceny']) ? htmlspecialchars($grade['opis_oceny']) : "Brak opisu";
                                        $grade_date = !empty($grade['data_wpisu']) ? htmlspecialchars($grade['data_wpisu']) : "Brak daty";

                                        echo "<span class='ocena kolor$grade_value' title='Data: $grade_date | Opis: $grade_description'>"
                                            . $grade['wartosc']
                                            . "</span> ";
                                    }
                                } else {
                                    echo "Brak ocen";
                                }
                                echo "</td>";

                                // Dodawanie oceny
                                echo "<td>"
                                    . "<div style='display: flex; align-items: center;'>";

                                for ($i = 1; $i <= 6; $i++) {
                                    echo "<button type='button' class='grade-btn kolor$i' data-value='$i' onclick='selectGrade($student_id, $i)'>$i</button>";
                                }

                                echo "<input type='hidden' name='grades[$student_id][id_ucznia]' value='$student_id'>"
                                    . "<input type='hidden' name='grades[$student_id][wartosc]' id='grade-value-$student_id' class='grade-input'>"
                                    . "</div>"
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
                <input type='hidden' name='id_nauczyciela' value='<?php echo $teacher_id; ?>'>
                <input type='hidden' name='id_przedmiotu' value='<?php echo $subject_id; ?>'>
                <input type='hidden' name='id_klasy' value='<?php echo $class_id; ?>'>
                <?php
                if (isset($_GET["classId"]) && isset($_GET["subjectId"])) {
                ?>
                    <div class="description-container">
                        <label for="grade-description" class="description-label">Opis oceny (opcjonalny):</label>
                        <textarea name="grade_description" id="grade-description" rows="1" maxlength="64"></textarea>
                        <span id="char-counter">0/64</span>
                        <button type="submit" class="btn-submit">Zapisz wszystkie oceny</button>
                    </div>

                <?php
                }
                ?>
            </form>
        </div>
    </section>
</div>

<script>
    function selectGrade(studentId, gradeValue) {
        // Usuwa zaznaczenie z innych przycisków w tym formularzu dla tego samego ucznia
        const studentRow = document.querySelector(`#grade-value-${studentId}`).closest('tr');
        studentRow.querySelectorAll('.grade-btn').forEach(btn => btn.classList.remove('selected'));

        // Ustawia wybrany przycisk jako aktywny
        studentRow.querySelector(`.grade-btn[data-value='${gradeValue}']`).classList.add('selected');

        // Ustawia wartość oceny w ukrytym polu
        document.querySelector(`#grade-value-${studentId}`).value = gradeValue;
    }

    document.addEventListener('DOMContentLoaded', () => {
        // Usuwanie pustych ocen z formularza przed wysłaniem
        document.querySelector('.btn-submit').addEventListener('click', (event) => {
            document.querySelectorAll('.grade-input').forEach(input => {
                if (!input.value) {
                    input.closest('div').remove();
                }
            });
        });
    });

        // licznik znaków opisu
    const textarea = document.getElementById('grade-description');
    const counter = document.getElementById('char-counter');
    textarea.addEventListener('input', () => {
        const currentLength = textarea.value.length;
        const maxLength = textarea.getAttribute('maxlength');
        counter.textContent = `${currentLength}/${maxLength}`;
    });
    
</script>
<?php } ?>