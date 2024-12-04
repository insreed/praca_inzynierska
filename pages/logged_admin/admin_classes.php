<?php
require_once '../scripts/connect.php';

// Wyświetlanie komunikatów o sukcesie lub błędzie (przekazane przez parametr GET)
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

    unset($_SESSION["message"]); // Usunięcie komunikatu z sesji po jego wyświetleniu
    unset($_SESSION["error"]);
}
?>

<div class="container mt-4">
    <h2>Zarządzanie Klasami</h2>

    <!-- Lista klas -->
    <div class="table-responsive mt-4">
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
                    die("<div class='alert alert-danger'>Błąd połączenia z bazą danych: " . $conn->connect_error . "</div>");
                }

                $sql = "SELECT * FROM klasa ORDER BY id_klasy";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    while ($class = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$class['id_klasy']}</td>";
                        echo "<td>{$class['nazwa']}</td>";
                        echo "<td>
                                <a href='?view=classes&updateClassId={$class['id_klasy']}' class='btn btn-warning btn-sm'>Edytuj</a>
                                <a href='../scripts/delete_class.php?deleteClassId={$class['id_klasy']}' class='btn btn-danger btn-sm'>Usuń</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' class='text-center'>Brak klas w bazie danych.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Edytowanie klasy -->
    <?php
    if (isset($_GET['updateClassId'])) {
        $updateClassId = intval($_GET['updateClassId']);
        $sql = "SELECT * FROM klasa WHERE id_klasy = $updateClassId";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $updateClass = $result->fetch_assoc();

            echo <<<EDITCLASSMODAL
            <div class="modal show fade" id="editClassModal" tabindex="-1" role="dialog" style="display: block; background-color: rgba(0, 0, 0, 0.5);">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edytuj klasę</h5>
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
                                <button type="submit" class="btn btn-primary">Zaktualizuj klasę</button>
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
            echo "<div class='alert alert-danger'>Nie znaleziono klasy o podanym ID.</div>";
        }
    }
    ?>

    <!-- Dodawanie klasy -->
    <hr>
    <h4>Dodaj Klasę</h4>
    <form action="../scripts/add_class.php" method="post" class="mt-3">
        <div class="form-group">
            <label for="className">Nazwa klasy</label>
            <input type="text" class="form-control" id="className" name="className" placeholder="Podaj nazwę klasy"
                required>
        </div>
        <button type="submit" class="btn btn-primary">Dodaj klasę</button>
    </form>
</div>

<?php
$conn->close();
?>