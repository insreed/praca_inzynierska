<div class="container mt-5 pt-5">
    <!-- Content Header -->
    <div class="text-center mb-5">
        <h1 class="display-4">Panel Nauczyciela</h1>
    </div>

    <div class="row">
        <!-- Twoje Przedmioty -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Twoje Przedmioty</h5>
                    <i class="fas fa-book fa-lg"></i>
                </div>
                <div class="card-body">
                    <?php
                    require_once "../scripts/connect.php";
                    $user_id = $_SESSION["logged"]["user_id"];

                    // Pobranie przedmiotów
                    $querySubjects = "
                        SELECT DISTINCT przedmioty.nazwa_przedmiotu, przedmioty.id_przedmiotu
                        FROM przedmioty
                        INNER JOIN przydział_nauczyciel ON przedmioty.id_przedmiotu = przydział_nauczyciel.id_przedmiotu
                        WHERE przydział_nauczyciel.id_nauczyciela = ?";
                    $stmtSubjects = $conn->prepare($querySubjects);
                    $stmtSubjects->bind_param("i", $user_id);
                    $stmtSubjects->execute();
                    $resultSubjects = $stmtSubjects->get_result();

                    if ($resultSubjects->num_rows > 0) {
                        echo "<ul class='list-group'>";
                        while ($subject = $resultSubjects->fetch_assoc()) {
                            $subjectId = $subject['id_przedmiotu'];
                            echo "
                                <li class='list-group-item'>
                                    <div class='d-flex justify-content-between align-items-center'>
                                        <span class='font-weight-bold text-dark'>{$subject['nazwa_przedmiotu']}</span>
                                        <button class='btn btn-sm btn-outline-primary' data-bs-toggle='collapse' data-bs-target='#classesForSubject{$subjectId}' aria-expanded='false' aria-controls='classesForSubject{$subjectId}'>
                                            <i class='fas fa-chevron-down'></i>
                                        </button>
                                    </div>
                                    <div class='collapse mt-2' id='classesForSubject{$subjectId}'>
                                        <ul class='list-group'>";

                            // Pobranie klas dla przedmiotu
                            $queryClasses = "
                                SELECT klasa.nazwa AS klasa_nazwa, klasa.id_klasy
                                FROM przydział_nauczyciel
                                INNER JOIN klasa ON przydział_nauczyciel.id_klasy = klasa.id_klasy
                                WHERE przydział_nauczyciel.id_przedmiotu = ? AND przydział_nauczyciel.id_nauczyciela = ?";
                            $stmtClasses = $conn->prepare($queryClasses);
                            $stmtClasses->bind_param("ii", $subjectId, $user_id);
                            $stmtClasses->execute();
                            $resultClasses = $stmtClasses->get_result();

                            if ($resultClasses->num_rows > 0) {
                                while ($class = $resultClasses->fetch_assoc()) {
                                    echo "
                                        <li class='list-group-item d-flex justify-content-between align-items-center'>
                                            <span class='font-weight-bold text-dark'>{$class['klasa_nazwa']}</span>
                                            <a href='?subjectId={$subjectId}&classId={$class['id_klasy']}' class='btn btn-sm btn-outline-secondary'>
                                                <i class='fas fa-arrow-right'></i>
                                            </a>
                                        </li>";
                                }
                            } else {
                                echo "<li class='list-group-item text-muted'>Brak klas dla tego przedmiotu.</li>";
                            }

                            echo "</ul>
                                    </div>
                                </li>";
                        }
                        echo "</ul>";
                    } else {
                        echo "<p class='text-muted text-center'>Brak przydzielonych przedmiotów.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>

        <!-- Twoje Klasy -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Twoje Klasy</h5>
                    <i class="fas fa-users fa-lg"></i>
                </div>
                <div class="card-body">
                    <?php
                    // Pobranie klas
                    $queryClasses = "
                        SELECT DISTINCT klasa.nazwa AS klasa_nazwa, klasa.id_klasy
                        FROM klasa
                        INNER JOIN przydział_nauczyciel ON klasa.id_klasy = przydział_nauczyciel.id_klasy
                        WHERE przydział_nauczyciel.id_nauczyciela = ?";
                    $stmtClasses = $conn->prepare($queryClasses);
                    $stmtClasses->bind_param("i", $user_id);
                    $stmtClasses->execute();
                    $resultClasses = $stmtClasses->get_result();

                    if ($resultClasses->num_rows > 0) {
                        echo "<ul class='list-group'>";
                        while ($class = $resultClasses->fetch_assoc()) {
                            $classId = $class['id_klasy'];
                            echo "
                                <li class='list-group-item'>
                                    <div class='d-flex justify-content-between align-items-center'>
                                        <span class='font-weight-bold text-dark'>{$class['klasa_nazwa']}</span>
                                        <button class='btn btn-sm btn-outline-primary' data-bs-toggle='collapse' data-bs-target='#subjectsForClass{$classId}' aria-expanded='false' aria-controls='subjectsForClass{$classId}'>
                                            <i class='fas fa-chevron-down'></i>
                                        </button>
                                    </div>
                                    <div class='collapse mt-2' id='subjectsForClass{$classId}'>
                                        <ul class='list-group'>";

                            // Pobranie przedmiotów dla klasy
                            $querySubjectsForClass = "
                                SELECT przedmioty.nazwa_przedmiotu, przedmioty.id_przedmiotu
                                FROM przydział_nauczyciel
                                INNER JOIN przedmioty ON przydział_nauczyciel.id_przedmiotu = przedmioty.id_przedmiotu
                                WHERE przydział_nauczyciel.id_klasy = ? AND przydział_nauczyciel.id_nauczyciela = ?";
                            $stmtSubjectsForClass = $conn->prepare($querySubjectsForClass);
                            $stmtSubjectsForClass->bind_param("ii", $classId, $user_id);
                            $stmtSubjectsForClass->execute();
                            $resultSubjectsForClass = $stmtSubjectsForClass->get_result();

                            if ($resultSubjectsForClass->num_rows > 0) {
                                while ($subject = $resultSubjectsForClass->fetch_assoc()) {
                                    echo "
                                        <li class='list-group-item d-flex justify-content-between align-items-center'>
                                            <span class='font-weight-bold text-dark'>{$subject['nazwa_przedmiotu']}</span>
                                            <a href='?classId={$classId}&subjectId={$subject['id_przedmiotu']}' class='btn btn-sm btn-outline-secondary'>
                                                <i class='fas fa-arrow-right'></i>
                                            </a>
                                        </li>";
                                }
                            } else {
                                echo "<li class='list-group-item text-muted'>Brak przedmiotów dla tej klasy.</li>";
                            }

                            echo "</ul>
                                    </div>
                                </li>";
                        }
                        echo "</ul>";
                    } else {
                        echo "<p class='text-muted text-center'>Brak przydzielonych klas.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var collapsibles = document.querySelectorAll('[data-bs-toggle="collapse"]');
        collapsibles.forEach(function (collapsible) {
            collapsible.addEventListener('click', function (event) {
                event.preventDefault();
                var target = document.querySelector(collapsible.getAttribute('data-bs-target'));
                if (target) {
                    target.classList.toggle('show');
                }
            });
        });
    });
</script>