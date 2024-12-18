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

<div class="container mt-4">
    <h2>Przydział klas dla nauczyciela: <?php echo htmlspecialchars($teacher['firstName'] . ' ' . $teacher['lastName']); ?></h2>

    <!-- Tabela z aktualnymi przydziałami -->
    <div class="table-responsive mt-3">
    <table class="table table-bordered">
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
                                class="btn btn-danger btn-sm">Usuń</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>


    <!-- Formularz do dodawania przydziału -->
    <h4>Dodaj Przydział</h4>
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
                    echo "<option value='{$subject['id']}'>{$subject['nazwa_przedmiotu']}</option>";
                }
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Dodaj przydział</button>
        <a href="?view=users" class="btn btn-secondary">Powrót do użytkowników</a>
    </form>
</div>

<?php
$conn->close();
?>
