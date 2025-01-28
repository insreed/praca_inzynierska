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
        <h2 class="text-center mb-0">Zarządzanie Klasami</h2>
        <a href="#addClassForm" class="btn btn-primary btn-lg shadow-sm">
            <i class="fas fa-user-plus"></i> Dodaj Klasę
        </a>
    </div>
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Lista Klas</h4>
        </div>
        <div class="card-body">
            <!-- Lista klas -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nazwa klasy</th>
                            <th>Akcje</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!$conn) {
                            echo "<tr><td colspan='3' class='text-center text-danger'>Błąd połączenia z bazą danych: " . $conn->connect_error . "</td></tr>";
                        } else {
                            $sql = "SELECT * FROM klasa ORDER BY id_klasy";
                            $result = $conn->query($sql);

                            if ($result && $result->num_rows > 0) {
                                while ($class = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>{$class['id_klasy']}</td>";
                                    echo "<td>{$class['nazwa']}</td>";
                                    echo "<td>
                                            <a href='?view=classes&updateClassId={$class['id_klasy']}' class='btn btn-warning btn-sm'>
                                                <i class='fas fa-edit'></i> Edytuj
                                            </a>
                                            <a href='../scripts/delete_class.php?deleteClassId={$class['id_klasy']}' class='btn btn-danger btn-sm'>
                                                <i class='fas fa-trash'></i> Usuń
                                            </a>
                                          </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='3' class='text-center'>Brak klas w bazie danych.</td></tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Edytowanie klasy -->
    <?php
    if (isset($_GET['updateClassId'])) {
        $updateClassId = intval($_GET['updateClassId']);
        $sql = "SELECT * FROM klasa WHERE id_klasy = ?";
        $updateClass = $conn->execute_query($sql, [$updateClassId])->fetch_assoc();

        if (!empty($updateClass)) {
            echo <<<EDITCLASSMODAL
            <div class="modal show fade" id="editClassModal" tabindex="-1" role="dialog" style="display: block; background-color: rgba(0, 0, 0, 0.5);">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">Edytuj Klasę</h5>
                            <button type="button" class="close" onclick="window.location.href='?view=classes'" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="../scripts/update_class.php" method="post">
                                <input type="hidden" name="class_id" value="{$updateClass['id_klasy']}">
                                <div class="form-group">
                                    <label for="className">Nazwa klasy</label>
                                    <input type="text" class="form-control" id="className" name="className" value="{$updateClass['nazwa']}" required>
                                </div>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Zaktualizuj klasę
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var modal = document.getElementById('editClassModal');
                    if (modal) {
                        modal.scrollIntoView();
                    }
                });
            </script>
EDITCLASSMODAL;
        } else {
            echo "<div class='alert alert-danger mt-4'>Nie znaleziono klasy o podanym ID.</div>";
        }
    }
    ?>

    <!-- Dodawanie klasy -->
    <div id="addClassForm" class="card shadow-sm mt-4">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Dodaj Klasę</h5>
        </div>
        <div class="card-body">
            <form action="../scripts/add_class.php" method="post" class="mt-3">
                <div class="form-group">
                    <label for="className">Nazwa klasy</label>
                    <input type="text" class="form-control" id="className" name="className"
                        placeholder="Podaj nazwę klasy" required>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Dodaj Klasę
                </button>
            </form>
        </div>
    </div>
</div>

<?php
$conn->close();
?>