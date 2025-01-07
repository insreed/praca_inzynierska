<?php
require_once '../scripts/connect.php';

if (!isset($_GET['teacher_id'])) {
    header("Location: logged.php?view=users");
    exit();
}

$teacherId = intval($_GET['teacher_id']);

// Pobierz informacje o nauczycielu
$sqlTeacher = "SELECT firstName, lastName FROM users WHERE id = ?";
$stmtTeacher = $conn->prepare($sqlTeacher);
$stmtTeacher->bind_param("i", $teacherId);
$stmtTeacher->execute();
$resultTeacher = $stmtTeacher->get_result();
$teacher = $resultTeacher->fetch_assoc();

if (!$teacher) {
    $_SESSION["message"] = "Nie znaleziono nauczyciela.";
    $_SESSION["error"] = "failure";
    header("Location: logged.php?view=users");
    exit();
}

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

// Pobierz listę przydzielonych klas i przedmiotów
$sqlAssignments = "SELECT 
                        przydział_nauczyciel.id_przydzialu, 
                        klasa.nazwa AS klasa, 
                        przedmioty.nazwa_przedmiotu AS przedmiot
                   FROM 
                        przydział_nauczyciel
                   INNER JOIN 
                        klasa ON przydział_nauczyciel.id_klasy = klasa.id_klasy
                   INNER JOIN 
                        przedmioty ON przydział_nauczyciel.id_przedmiotu = przedmioty.id_przedmiotu
                   WHERE 
                        przydział_nauczyciel.id_nauczyciela = ?";

$stmtAssignments = $conn->prepare($sqlAssignments);
$stmtAssignments->bind_param("i", $teacherId);
$stmtAssignments->execute();
$resultAssignments = $stmtAssignments->get_result();
?>

<div class="container mt-5 pt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Przydział Klas dla Nauczyciela<span class="text-center text-primary mb-4">
        <?php echo htmlspecialchars($teacher['firstName'] . ' ' . $teacher['lastName']); ?>
        </span></h2>
        
        <a href="?view=users" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left"></i> Powrót do Użytkowników
        </a>
    </div>
    

    <!-- Tabela z aktualnymi przydziałami -->
    <div class="card shadow-sm mb-5">
        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Aktualne Przydziały</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Klasa</th>
                        <th>Przedmiot</th>
                        <th>Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $resultAssignments->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['klasa']); ?></td>
                            <td><?php echo htmlspecialchars($row['przedmiot']); ?></td>
                            <td>
                                <a href="../scripts/delete_assignment.php?assignment_id=<?php echo $row['id_przydzialu']; ?>&teacher_id=<?php echo $teacherId; ?>"
                                    class="btn btn-danger btn-sm shadow-sm">
                                    Usuń
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Formularz do dodawania przydziału -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Dodaj Przydział</h5>
        </div>
        <div class="card-body">
            <form action="../scripts/add_assignment.php" method="post">
                <input type="hidden" name="teacher_id" value="<?php echo $teacherId; ?>">

                <div class="form-group">
                    <label for="class_id">Klasa</label>
                    <select class="form-control" id="class_id" name="class_id" required>
                        <option value="">Wybierz klasę</option>
                        <?php
                        $sqlClasses = "SELECT id_klasy, nazwa FROM klasa";
                        $resultClasses = $conn->query($sqlClasses);
                        while ($class = $resultClasses->fetch_assoc()) {
                            echo "<option value='{$class['id_klasy']}'>{$class['nazwa']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="subject_id">Przedmiot</label>
                    <select class="form-control" id="subject_id" name="subject_id" required>
                        <option value="">Wybierz przedmiot</option>
                        <?php
                        $sqlSubjects = "SELECT id_przedmiotu, nazwa_przedmiotu FROM przedmioty";
                        $resultSubjects = $conn->query($sqlSubjects);
                        while ($subject = $resultSubjects->fetch_assoc()) {
                            echo "<option value='{$subject['id_przedmiotu']}'>{$subject['nazwa_przedmiotu']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary shadow-sm">
                        <i class="fas fa-plus"></i> Dodaj Przydział
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
$conn->close();
?>