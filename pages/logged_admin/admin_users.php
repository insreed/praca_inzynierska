<?php
require_once '../scripts/connect.php';

if (isset($_SESSION["message"])) {
    $message = $_SESSION["message"];
    $alertClass = (isset($_SESSION["error"]) && $_SESSION["error"] === "success") ? "alert-success" : "alert-danger";

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
?>

<div class="container mt-4">
    <h2>Zarządzanie Użytkownikami</h2>

    <!-- Lista użytkowników -->
    <div class="table-responsive mt-4">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Imię</th>
                    <th>Nazwisko</th>
                    <th>Rola</th>
                    <th>Email</th>
                    <th>Klasa</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Zapytanie pobierające użytkowników i przypisaną klasę
                $sql = "SELECT 
                            users.id, 
                            users.firstName, 
                            users.lastName, 
                            roles.role, 
                            users.email,
                            COALESCE(klasa.nazwa, 'Brak klasy') AS klasa
                        FROM users
                        INNER JOIN roles ON users.role_id = roles.id
                        LEFT JOIN `przydział_klasy` ON users.id = przydział_klasy.id_uzytkownika
                        LEFT JOIN klasa ON przydział_klasy.id_klasy = klasa.id_klasy
                        ORDER BY users.id";

                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    while ($user = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$user['id']}</td>";
                        echo "<td>{$user['firstName']}</td>";
                        echo "<td>{$user['lastName']}</td>";
                        echo "<td>{$user['role']}</td>";
                        echo "<td>{$user['email']}</td>";
                        echo "<td>{$user['klasa']}</td>";

                        // Kolumna Akcje
                        echo "<td>";
                        // Opcje wspólne dla wszystkich użytkowników
                        echo "
                            <a href='?view=edit_user&user_id={$user['id']}' class='btn btn-warning btn-sm'>Edycja</a>
                            <a href='../scripts/delete_user.php?deleteUserId={$user['id']}' class='btn btn-danger btn-sm'>Usuń</a>
                        ";

                        // Opcja tylko dla nauczyciela
                        if ($user['role'] === 'nauczyciel') {
                            echo "<a href='?view=assign_teacher&teacher_id={$user['id']}' class='btn btn-success btn-sm'>Przydział klas</a>";
                        }
                        echo "</td>";

                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>Brak użytkowników w bazie danych.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
$conn->close();
?>