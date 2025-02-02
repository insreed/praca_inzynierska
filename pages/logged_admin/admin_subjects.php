<?php
require_once '../scripts/connect.php';

// Wyświetlanie komunikatów o sukcesie lub błędzie
if (isset($_SESSION["message"])) {
    $message = $_SESSION["message"];
    $alertClass = ($_SESSION["error"] === "success") ? "alert-success" : "alert-danger";

    echo <<<ALERT
    <div class="alert $alertClass alert-dismissible fade show mt-3" role="alert">
        $message
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    ALERT;

    unset($_SESSION["message"]);
    unset($_SESSION["error"]);
}
?>

<div class="container mt-5 pt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-center mb-0">Zarządzanie Przemiotami</h2>
        <a href="#addSubjectForm" class="btn btn-primary btn-lg shadow-sm">
            <i class="fas fa-user-plus"></i> Dodaj Przedmiot
        </a>
    </div>
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Lista Przedmiotów</h4>
        </div>
        <div class="card-body">
            <!-- Lista przedmiotów -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nazwa Przedmiotu</th>
                            <th>Akcje</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM przedmioty ORDER BY id_przedmiotu";
                        $result = $conn->query($sql);

                        if ($result && $result->num_rows > 0) {
                            while ($subject = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>{$subject['id_przedmiotu']}</td>";
                                echo "<td>{$subject['nazwa_przedmiotu']}</td>";
                                echo "<td>
                                        <a href='?view=subjects&updateSubjectId={$subject['id_przedmiotu']}' class='btn btn-warning btn-sm'>
                                            <i class='fas fa-edit'></i> Edytuj
                                        </a>
                                        <a href='../scripts/delete_subject.php?deleteSubjectId={$subject['id_przedmiotu']}' class='btn btn-danger btn-sm'>
                                            <i class='fas fa-trash'></i> Usuń
                                        </a>
                                      </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3' class='text-center'>Brak przedmiotów w bazie danych.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Edytowanie przedmiotu -->
    <?php
    if (isset($_GET['updateSubjectId'])) {
        $updateSubjectId = intval($_GET['updateSubjectId']);
        $sql = "SELECT * FROM przedmioty WHERE id_przedmiotu = $updateSubjectId";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $subject = $result->fetch_assoc();

            echo <<<EDITMODAL
            <div class="modal show fade" id="editSubjectModal" tabindex="-1" role="dialog" style="display: block; background-color: rgba(0, 0, 0, 0.5);">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">Edytuj Przedmiot</h5>
                            <button type="button" class="close" onclick="window.location.href='?view=subjects'" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="../scripts/update_subject.php" method="post">
                                <input type="hidden" name="subject_id" value="{$subject['id_przedmiotu']}">
                                <div class="form-group">
                                    <label for="subjectName">Nazwa Przedmiotu</label>
                                    <input type="text" class="form-control" id="subjectName" name="subjectName" value="{$subject['nazwa_przedmiotu']}" required>
                                </div>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Zaktualizuj Przedmiot
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var modal = document.getElementById('editSubjectModal');
                    if (modal) {
                        modal.scrollIntoView();
                    }
                });
            </script>
EDITMODAL;
        }
    }
    ?>

    <!-- Dodawanie przedmiotu -->
    <div id="addSubjectForm" class="card shadow-sm mt-4">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Dodaj Przedmiot</h5>
        </div>
        <div class="card-body">
            <form action="../scripts/add_subject.php" method="post" class="mt-3">
                <div class="form-group">
                    <label for="subjectName">Nazwa Przedmiotu</label>
                    <input type="text" class="form-control" id="subjectName" name="subjectName"
                        placeholder="Podaj nazwę przedmiotu" required>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Dodaj Przedmiot
                </button>
            </form>
        </div>
    </div>
</div>

<?php
$conn->close();
?>