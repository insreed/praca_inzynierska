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

        <section class="content mt-4">
        <div class="container-fluid mt-4">
            <?php
                if (!isset($_GET["subjectId"])) {
                    include "teacher-dashboard.php";
                } else {
            ?>
            <form action="../scripts/add_grade.php" method="post">
                <div style='margin: 0 auto; margin-top:75px;'>
                    <?php
                    require_once "../scripts/connect.php";

                    // Sekcja wyświetlania komunikatów
                    if (isset($_SESSION["message"])) {
                        $message = $_SESSION["message"];
                        $alertClass = ($_SESSION["error"] === "success") ? "alert-success" : "alert-danger";

                        echo <<<ALERT
    <div class="alert $alertClass alert-dismissible fade show" role="alert">
        $message
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    ALERT;

                        unset($_SESSION["message"]);
                        unset($_SESSION["error"]);
                    }

                    // wyswietlenie klas po wybraniu przedmiotu
                    $teacher_id = $_SESSION["logged"]["user_id"];

                    if (!isset($_GET["subjectId"])) {
                        echo "<h3>Wybierz przedmiot z panelu bocznego, aby kontynuować.</h3>";
                    }

                    if (isset($_GET["subjectId"])) {
                        $subject_id = intval($_GET["subjectId"]);

                        if (!isset($_GET["classId"])) {
                            // pobranie klas przypisanych do nauczyciela
                            // $class_sql = "SELECT DISTINCT klasa.id_klasy, klasa.nazwa 
                            //               FROM przydzial_nauczyciel
                            //               INNER JOIN klasa ON przydzial_nauczyciel.id_klasy = klasa.id_klasy
                            //               WHERE przydzial_nauczyciel.id_nauczyciela = $teacher_id AND przydzial_nauczyciel.id_przedmiotu = $subject_id";

                             $class_sql = "SELECT DISTINCT klasa.id_klasy, klasa.nazwa 
                                FROM przydzial_nauczyciel
                                INNER JOIN klasa ON przydzial_nauczyciel.id_klasy = klasa.id_klasy
                                WHERE przydzial_nauczyciel.id_nauczyciela = ? AND przydzial_nauczyciel.id_przedmiotu = ?";
                            $class_result = $conn->execute_query($class_sql, [$teacher_id, $subject_id])->fetch_assoc();

                            // if ($class_result->num_rows > 0) {
                            if (count($class_result) > 0) {
                                echo "<h3>Wybierz klasę:</h3>";
                                echo "<ul>";
                                // while ($class = $class_result->fetch_assoc()) {
                                foreach ($class_result as $class) {
                                    printf("<li><a href='logged.php?subjectId=%d&classId=%d>%s</a></li>", $subject_id, $class['id_klasy'], $class['nazwa']);
                                    // echo "<li><a href='logged.php?subjectId=$subject_id&classId=" . $class['id_klasy'] . "'>" . $class['nazwa'] . "</a></li>";
                                }
                                echo "</ul>";
                            } else {
                                echo "Brak klas przypisanych do tego nauczyciela dla wybranego przedmiotu.";
                            }
                        }
                    }

                    // wyswietlanie studentow i ich ocen
                    if (isset($_GET["classId"]) && isset($_GET["subjectId"])) {
                        $class_id = intval($_GET["classId"]);
                        $subject_id = intval($_GET["subjectId"]);

                        // // wyswietlanie klas
                        // $class_name_sql = "SELECT nazwa FROM klasa WHERE id_klasy = $class_id";
                        // $class_name_result = $conn->query($class_name_sql);
                        // if ($class_name_result->num_rows > 0) {
                        //     $class_name = $class_name_result->fetch_assoc()['nazwa'];
                        //     echo "<h3>Oceny dla klasy: $class_name</h3>";
                        // }
                        $class_name_sql = "SELECT nazwa FROM klasa WHERE id_klasy = ?";
                        $class_name_result = $conn->execute_query($class_name_sql, [$class_id])->fetch_assoc();
                        if (!empty($class_name_result)) {
                            $class_name = $class_name_result['nazwa'];
                            echo "<h3>Oceny dla klasy: $class_name</h3>";
                        }

                        // pobranie studenow
                        // $students_sql = "SELECT users.id AS id, users.firstName, users.lastName, users.email 
                        //                  FROM users
                        //                  INNER JOIN przydzial_klasy ON przydzial_klasy.id_uzytkownika = users.id
                        //                  WHERE przydzial_klasy.id_klasy = $class_id AND users.role_id = 1";
                        // $students_result = $conn->query($students_sql);
                        $students_sql = "SELECT users.id AS id, users.firstName, users.lastName, users.email 
                                         FROM users
                                         INNER JOIN przydzial_klasy ON przydzial_klasy.id_uzytkownika = users.id
                                         WHERE przydzial_klasy.id_klasy = ? AND users.role_id = 1";
                        $students_result = $conn->execute_query($students_sql, [$class_id])->fetch_all(MYSQLI_ASSOC);
                        if (count($students_result) > 0) {
                            echo "<table style='width: 100%; min-width: 960px;'>
                                    <tr>
                                        <th style='width:20%; min-width: 250px;'>Imię i Nazwisko</th>
                                        <th>Oceny</th>
                                        <th style='width:20%; min-width: 250px;'>Dodaj ocenę</th>
                                    </tr>";

                            // while ($student = $students_result->fetch_assoc()) {
                            foreach ($students_result as $student) {
                                echo "<tr>";
                                echo "<td>" . $student["firstName"] . " " . $student["lastName"] . "</td>";

                                // pobranie ocen

                                // $student_id = $student['id'];
                                // $grades_sql = "SELECT przedmioty.nazwa_przedmiotu, wpisy.wartosc, wpisy.opis_oceny, wpisy.data_wpisu, wpisy.id_oceny
                                //     FROM oceny
                                //     LEFT JOIN wpisy ON oceny.id_oceny = wpisy.id_oceny
                                //     INNER JOIN przedmioty ON oceny.id_przedmiotu = przedmioty.id_przedmiotu
                                //     WHERE oceny.id_ucznia = $student_id AND oceny.id_przedmiotu = $subject_id";

                                // $grades_result = $conn->query($grades_sql);

                                $student_id = $student['id'];
                                $grades_sql = "SELECT przedmioty.nazwa_przedmiotu, wpisy.wartosc, wpisy.opis_oceny, wpisy.data_wpisu, wpisy.id_oceny
                                    FROM oceny
                                    LEFT JOIN wpisy ON oceny.id_oceny = wpisy.id_oceny
                                    INNER JOIN przedmioty ON oceny.id_przedmiotu = przedmioty.id_przedmiotu
                                    WHERE oceny.id_ucznia = ? AND oceny.id_przedmiotu = ?";

                                $grades_result = $conn->execute_query($grades_sql, [$student_id, $subject_id])->fetch_all(MYSQLI_ASSOC);

                                echo "<td class='oceny'>";
                                // if ($grades_result && $grades_result->num_rows > 0) {
                                if (!empty($grades_result)) {
                                    // while ($grade = $grades_result->fetch_assoc()) {
                                    foreach ($grades_result as $grade) {
                                        $grade_id = intval($grade['id_oceny']);
                                        $grade_value = intval($grade['wartosc']);
                                        $grade_description = !empty($grade['opis_oceny']) ? htmlspecialchars($grade['opis_oceny']) : "Brak opisu";
                                        $grade_date = !empty($grade['data_wpisu']) ? htmlspecialchars($grade['data_wpisu']) : "Brak daty";

                                        echo "<span class='ocena kolor$grade_value' title='Data: $grade_date | Opis: $grade_description' data-id='$grade_id' onclick='editGrade($grade_id, $grade_value, \"$grade_description\")'>"
                                            . $grade_value
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
                        <button type="submit" class="btn-submit" id="save-all-grades" disabled>Zapisz wszystkie oceny</button>
                    </div>

                <?php
                }
                ?>
            </form>
        </div>
    </section>
</div>

<div id="edit-grade-modal" style="display: none;">
    <div class="modal-content">
        <button type="button" onclick="closeEditModal()" class="close-x">&times;</button>
        <h3>Edytuj lub usuń ocenę</h3>
        <form id="edit-grade-form">
            <input type="hidden" name="id_oceny" id="edit-grade-id">
            <label>Wybierz ocenę:</label>
            <div style="display: flex; gap: 5px; margin-bottom: 10px;">
                <?php
                for ($i = 1; $i <= 6; $i++) {
                    echo "<button type='button' class='grade-btn kolor$i' data-value='$i' onclick='selectEditGrade($i)'>$i</button>";
                }
                ?>
            </div>
            <input type="hidden" name="wartosc" id="edit-grade-value" required>
            <label for="edit-grade-description">Opis:</label>
            <br>
            <textarea name="opis_oceny" id="edit-grade-description" class="edit-grade-description" rows="1"></textarea>
            <br>
            <button type="submit" class="btn-submit">Zapisz zmiany</button>
            <button type="button" id="delete-grade-btn" class="btn-no" onclick="openDeleteConfirmModal()">Usuń ocenę</button>
        </form>
    </div>
</div>

<div id="delete-confirm-modal" style="display: none;">
    <div class="modal-content">
        <h3>Potwierdzenie usunięcia</h3>
        <p>Czy na pewno chcesz usunąć tę ocenę?</p>
        <div style="display: flex; gap: 10px;">
            <button type="button" class="btn-submit" onclick="confirmDeleteGrade()">Tak</button>
            <button type="button" class="btn-no" onclick="closeDeleteConfirmModal()">Nie</button>
        </div>
    </div>
</div>


<script>
    function selectGrade(studentId, gradeValue) {
    const studentRow = document.querySelector(`#grade-value-${studentId}`).closest('tr');
    const gradeInput = document.querySelector(`#grade-value-${studentId}`);
    const selectedButton = studentRow.querySelector(`.grade-btn[data-value='${gradeValue}']`);

    // Sprawdź, czy przycisk jest już zaznaczony
    if (selectedButton.classList.contains('selected')) {
        // Usuń zaznaczenie
        selectedButton.classList.remove('selected');
        gradeInput.value = ''; // Resetuj wartość oceny
    } else {
        // Usuń zaznaczenie z innych przycisków
        studentRow.querySelectorAll('.grade-btn').forEach(btn => btn.classList.remove('selected'));
        
        // Zaznacz nowy przycisk
        selectedButton.classList.add('selected');
        gradeInput.value = gradeValue; // Ustaw wartość oceny
    }

    // Zaktualizuj stan przycisku "Zapisz wszystkie oceny"
    updateSaveButtonState();
}


    function selectEditGrade(gradeValue) {
        // Usuwa zaznaczenie z innych przycisków w modal
        const gradeButtons = document.querySelectorAll('#edit-grade-modal .grade-btn');
        gradeButtons.forEach(btn => btn.classList.remove('selected'));

        // Ustawia wybrany przycisk jako aktywny
        document.querySelector(`#edit-grade-modal .grade-btn[data-value='${gradeValue}']`).classList.add('selected');

        // Ustawia wartość oceny w ukrytym polu
        document.getElementById('edit-grade-value').value = gradeValue;
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

    function editGrade(id, value, description) {
        console.log(`Edit grade clicked: ID=${id}, Value=${value}, Description=${description}`);
        document.getElementById('edit-grade-id').value = id;
        document.getElementById('edit-grade-value').value = value;
        document.getElementById('edit-grade-description').value = description;

        // Usuwa wcześniejsze zaznaczenia
        const gradeButtons = document.querySelectorAll('#edit-grade-modal .grade-btn');
        gradeButtons.forEach(btn => btn.classList.remove('selected'));

        // Zaznacza aktualną ocenę
        const currentGradeButton = document.querySelector(`#edit-grade-modal .grade-btn[data-value='${value}']`);
        if (currentGradeButton) {
            currentGradeButton.classList.add('selected');
        }

        document.getElementById('edit-grade-modal').style.display = 'block';
    }

    function deleteGrade() {
        const gradeId = document.getElementById('edit-grade-id').value;

        if (confirm('Czy na pewno chcesz usunąć tę ocenę?')) {
            fetch('../scripts/delete_grade.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id_oceny: gradeId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload(); // Odświeżenie strony po usunięciu oceny
                    } else {}
                })
                .catch(error => console.error('Error:', error));

            closeEditModal();
        }
    }

    function openDeleteConfirmModal() {
        document.getElementById('delete-confirm-modal').style.display = 'block';
    }

    function closeDeleteConfirmModal() {
        document.getElementById('delete-confirm-modal').style.display = 'none';
    }

    function confirmDeleteGrade() {
        const gradeId = document.getElementById('edit-grade-id').value;

        fetch('../scripts/delete_grade.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id_oceny: gradeId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload(); // Odświeżenie strony po usunięciu oceny
                } else {
                    alert('Wystąpił błąd podczas usuwania oceny.');
                }
            })
            .catch(error => console.error('Error:', error));

        closeDeleteConfirmModal();
        closeEditModal();
    }

    function closeEditModal() {
        document.getElementById('edit-grade-modal').style.display = 'none';
    }

    document.getElementById('edit-grade-form').addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);

        fetch('../scripts/edit_grade.php', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json()) // Parsowanie odpowiedzi jako JSON
            .then(data => {
                if (data.success) {
                    location.reload(); // Odśwież stronę w przypadku sukcesu
                }
            })
            .catch(error => console.error('Error:', error)); // Logowanie błędów

        closeEditModal(); // Zamknięcie modalu
    });

    document.addEventListener('DOMContentLoaded', () => {
        const gradeButtons = document.querySelectorAll('.grade-btn');
        const saveAllButton = document.getElementById('save-all-grades');

        function updateSaveButtonState() {
            // Sprawdź, czy jakakolwiek ocena została zaznaczona
            const hasSelectedGrade = Array.from(document.querySelectorAll('.grade-input')).some(input => input.value);
            saveAllButton.disabled = !hasSelectedGrade; // Włącz lub wyłącz przycisk
        }

        // Nasłuchuj kliknięć na przyciskach ocen
        gradeButtons.forEach(button => {
            button.addEventListener('click', () => {
                updateSaveButtonState();
            });
        });

        // Wywołaj raz, aby upewnić się, że stan przycisku jest poprawny na starcie
        updateSaveButtonState();
    });
</script>
<?php }?>