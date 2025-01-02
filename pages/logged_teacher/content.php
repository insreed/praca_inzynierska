<style>
    .ocena {
        position: relative;
        cursor: pointer;
    }

    .oceny {
        padding-left: 20px;
    }

    .kolor1 {
        background-color: rgb(255, 0, 0)
    }

    .kolor2 {
        background-color: rgb(255, 145, 0)
    }

    .kolor3 {
        background-color: rgb(255, 208, 0)
    }

    .kolor4 {
        background-color: rgb(204, 255, 0)
    }

    .kolor5 {
        background-color: rgb(72, 255, 0)
    }

    .kolor6 {
        background-color: rgb(0, 255, 149)
    }

    .tooltip {
        z-index: 1112;
        position: absolute;
    }

    .grade-btn {
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
        width: 40px;
        height: 40px;
        transition: transform 0.2s, box-shadow 0.3s;
        margin-right: 5px;
    }

    .grade-btn.kolor1 {
        background-color: rgb(255, 0, 0);
        color: #fff;
    }

    .grade-btn.kolor2 {
        background-color: rgb(255, 145, 0);
        color: #fff;
    }

    .grade-btn.kolor3 {
        background-color: rgb(255, 208, 0);
        color: #000;
    }

    .grade-btn.kolor4 {
        background-color: rgb(204, 255, 0);
        color: #000;
    }

    .grade-btn.kolor5 {
        background-color: rgb(72, 255, 0);
        color: #000;
    }

    .grade-btn.kolor6 {
        background-color: rgb(0, 255, 149);
        color: #000;
    }

    .grade-btn:hover {
        transform: scale(1.1);
    }

    .grade-btn.selected {
        box-shadow: 0 0 0 3px #007bff;
        outline: none;
    }

    .btn-submit {
        padding: 12px 20px;
        border: none;
        border-radius: 8px;
        background-color: #28a745;
        color: #fff;
        cursor: pointer;
        font-weight: bold;
        font-size: 16px;
        width: auto;
        height: auto;
        margin: 10px;
        transition: background-color 0.3s, transform 0.2s, box-shadow 0.3s;
    }

    .btn-submit:hover {
        background-color: #218838;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }

    .btn-submit:active {
        transform: scale(0.98);
    }

    .description-container {
        margin-top: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .description-label {
        margin-right: 10px;
    }

    #grade-description {
        flex: 1;
        border-radius: 5px;
        border: 1px solid #696969;
        padding: 10px;
        background-color: #b4b4b4;
        resize: none;
        width: calc(100% - 50px);
    }

    #char-counter {
        font-family: Arial, sans-serif;
        color: #696969;
        font-weight: bold;
        font-size: 14px;
    }

    #edit-grade-modal {
        position: fixed;
        width: 30%;
        height: 30%;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        border: 1px solid #696969;
        z-index: 1000;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;

    }

    button {
        margin-top: 10px;
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
            <form action="../scripts/add_grade.php" method="post">
                <div style='margin: 0 auto; height: 650px; overflow-y: scroll;'>
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

                    // wyswietlanie studentow i ich ocen
                    if (isset($_GET["classId"]) && isset($_GET["subjectId"])) {
                        $class_id = intval($_GET["classId"]);
                        $subject_id = intval($_GET["subjectId"]);

                        // wyswietlanie klas
                        $class_name_sql = "SELECT nazwa FROM klasa WHERE id_klasy = $class_id";
                        $class_name_result = $conn->query($class_name_sql);
                        if ($class_name_result->num_rows > 0) {
                            $class_name = $class_name_result->fetch_assoc()['nazwa'];
                            echo "<h3>Oceny dla klasy: $class_name</h3>";
                        }

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
                                $grades_sql = "SELECT przedmioty.nazwa_przedmiotu, wpisy.wartosc, wpisy.opis_oceny, wpisy.data_wpisu, wpisy.id_oceny
                                    FROM oceny
                                    LEFT JOIN wpisy ON oceny.id_oceny = wpisy.id_oceny
                                    INNER JOIN przedmioty ON oceny.id_przedmiotu = przedmioty.id_przedmiotu
                                    WHERE oceny.id_ucznia = $student_id AND oceny.id_przedmiotu = $subject_id";

                                $grades_result = $conn->query($grades_sql);

                                echo "<td class='oceny'>";
                                if ($grades_result && $grades_result->num_rows > 0) {
                                    while ($grade = $grades_result->fetch_assoc()) {
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
                        <button type="submit" class="btn-submit">Zapisz wszystkie oceny</button>
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
        <h3>Edytuj ocenę</h3>
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
            <textarea name="opis_oceny" id="edit-grade-description" rows="1"></textarea>
            <button type="submit">Zapisz zmiany</button>
            <button type="button" onclick="closeEditModal()">Anuluj</button>
        </form>
    </div>
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
</script>