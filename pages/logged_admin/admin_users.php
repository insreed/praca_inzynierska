<?php
require_once '../scripts/connect.php';

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
?>

<div class="container mt-4">
    <h2 class="w-100">Zarządzanie Użytkownikami</h2>
<div class="w-100 mb-3">
    <a href="#addUserForm" class="btn btn-primary">Dodawanie użytkownika</a>
</div>

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
                $sql = "SELECT 
                            users.id, 
                            users.firstName, 
                            users.lastName, 
                            roles.role, 
                            users.email,
                            COALESCE(klasa.nazwa, 'Brak klasy') AS klasa
                        FROM users
                        INNER JOIN roles ON users.role_id = roles.id
                        LEFT JOIN przydział_klasy ON users.id = przydział_klasy.id_uzytkownika
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
                        echo "<td>";
                        echo "<a href='?view=edit_user&user_id={$user['id']}' class='btn btn-warning btn-sm mr-1'>Edytuj</a>";
                        echo "<a href='../scripts/delete_user.php?deleteUserId={$user['id']}' class='btn btn-danger btn-sm'>Usuń</a> ";
                        if ($user['role'] === 'nauczyciel') {
                            echo "<a href='?view=assign_teacher&teacher_id={$user['id']}' class='btn btn-success btn-sm'>Przydział przedmiotów</a>";
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

    <!-- Formularz dodawania użytkownika -->
    <div id="addUserForm" class="mt-5 p-4 mb-5" style="background-color: rgba(0,0,0,0.20); border-radius: 8px;">
        <h4 class="mb-4">Dodaj Użytkownika</h4>
        <form action="../scripts/add_user.php" method="post" class="mt-3">
            <div class="form-group">
                <label for="firstName">Imię</label>
                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Podaj imię"
                    required>
            </div>
            <div class="form-group">
                <label for="lastName">Nazwisko</label>
                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Podaj nazwisko"
                    required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Podaj email" required>
            </div>
            <div class="form-group">
                <label for="password">Hasło</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Podaj hasło"
                    required>
            </div>
            <div class="form-group">
                <label for="role_id">Rola</label>
                <select name="role_id" id="role_id" class="form-control" required>
                    <?php
                    $rolesSql = "SELECT id, role FROM roles";
                    $rolesResult = $conn->query($rolesSql);
                    while ($role = $rolesResult->fetch_assoc()) {
                        echo "<option value='{$role['id']}'>{$role['role']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="birthday">Data urodzenia</label>
                <input type="date" class="form-control" id="birthday" name="birthday" required>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="term" name="term" required>
                <label class="form-check-label" for="term">Akceptuję regulamin</label>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Dodaj użytkownika</button>
        </form>
    </div>
</div>

<?php
$conn->close();
?>