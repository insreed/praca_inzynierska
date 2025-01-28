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

// Domyślne sortowanie
$sortColumn = 'id';
$sortOrder = 'asc';

// Pobierz parametry sortowania z URL
if (isset($_GET['sort']) && in_array($_GET['sort'], ['id', 'firstName', 'lastName', 'role', 'email', 'klasa'])) {
    $sortColumn = $_GET['sort'];
}
if (isset($_GET['order']) && in_array($_GET['order'], ['asc', 'desc'])) {
    $sortOrder = $_GET['order'];
}

// Zapytanie SQL z sortowaniem
$sql = "SELECT 
            users.id, 
            users.firstName, 
            users.lastName, 
            roles.role, 
            users.email,
            COALESCE(klasa.nazwa, 'Brak klasy') AS klasa
        FROM users
        INNER JOIN roles ON users.role_id = roles.id
        LEFT JOIN przydzial_klasy ON users.id = przydzial_klasy.id_uzytkownika
        LEFT JOIN klasa ON przydzial_klasy.id_klasy = klasa.id_klasy
        ORDER BY $sortColumn $sortOrder";
$result = $conn->query($sql);
?>

<div class="container mt-5 pt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-center mb-0">Zarządzanie Użytkownikami</h2>
        <a href="#addUserForm" class="btn btn-primary btn-lg shadow-sm">
            <i class="fas fa-user-plus"></i> Dodaj Użytkownika
        </a>
    </div>


    <!-- Lista użytkowników -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Lista Użytkowników</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th><a href="?view=users&sort=id&order=<?php echo ($sortColumn === 'id' && $sortOrder === 'asc') ? 'desc' : 'asc'; ?>"
                                    class="text-white">ID</a></th>
                            <th><a href="?view=users&sort=firstName&order=<?php echo ($sortColumn === 'firstName' && $sortOrder === 'asc') ? 'desc' : 'asc'; ?>"
                                    class="text-white">Imię</a></th>
                            <th><a href="?view=users&sort=lastName&order=<?php echo ($sortColumn === 'lastName' && $sortOrder === 'asc') ? 'desc' : 'asc'; ?>"
                                    class="text-white">Nazwisko</a></th>
                            <th><a href="?view=users&sort=role&order=<?php echo ($sortColumn === 'role' && $sortOrder === 'asc') ? 'desc' : 'asc'; ?>"
                                    class="text-white">Rola</a></th>
                            <th><a href="?view=users&sort=email&order=<?php echo ($sortColumn === 'email' && $sortOrder === 'asc') ? 'desc' : 'asc'; ?>"
                                    class="text-white">Email</a></th>
                            <th><a href="?view=users&sort=klasa&order=<?php echo ($sortColumn === 'klasa' && $sortOrder === 'asc') ? 'desc' : 'asc'; ?>"
                                    class="text-white">Klasa</a></th>
                            <th>Akcje</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result && $result->num_rows > 0) {
                            while ($user = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>{$user['id']}</td>";
                                echo "<td>{$user['firstName']}</td>";
                                echo "<td>{$user['lastName']}</td>";
                                echo "<td>{$user['role']}</td>";
                                echo "<td>{$user['email']}</td>";
                                echo "<td>{$user['klasa']}</td>";
                                echo "<td class='text-center'>";
                                echo "<a href='?view=edit_user&user_id={$user['id']}' class='btn btn-warning btn-sm mr-1'><i class='fas fa-edit'></i> Edytuj</a>";
                                echo "<a href='../scripts/delete_user.php?deleteUserId={$user['id']}' class='btn btn-danger btn-sm mr-1'><i class='fas fa-trash'></i> Usuń</a>";
                                if ($user['role'] === 'nauczyciel') {
                                    echo "<a href='?view=assign_teacher&teacher_id={$user['id']}' class='btn btn-success btn-sm'><i class='fas fa-chalkboard-teacher'></i> Przydział</a>";
                                }
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7' class='text-center text-muted'>Brak użytkowników w bazie danych.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Formularz dodawania użytkownika -->
    <div id="addUserForm" class="card shadow-sm mt-5">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Dodaj Użytkownika</h5>
        </div>
        <div class="card-body">
            <form action="../scripts/add_user.php" method="post">
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
</div>

<?php
$conn->close();
?>