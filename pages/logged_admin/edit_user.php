<?php
require_once '../scripts/connect.php';

if (!isset($_GET['user_id'])) {
    header("Location: ../pages/logged.php?view=users");
    exit();
}

$userId = intval($_GET['user_id']);

// Pobierz dane użytkownika
$sql = "SELECT users.id, users.firstName, users.lastName, users.email, users.role_id, users.birthday, COALESCE(przydział_klasy.id_klasy, '') AS assigned_class
        FROM users
        LEFT JOIN przydział_klasy ON users.id = przydział_klasy.id_uzytkownika
        WHERE users.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['message'] = "Nie znaleziono użytkownika.";
    $_SESSION['error'] = "failure";
    header("Location: ../pages/logged.php?view=users");
    exit();
}

$user = $result->fetch_assoc();
?>

<div class="container mt-4">
    <h2>Edytuj Dane Użytkownika</h2>
    <form action="../scripts/update_user.php" method="post" class="mt-3">
        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">

        <div class="form-group">
            <label for="firstName">Imię</label>
            <input type="text" class="form-control" id="firstName" name="firstName"
                value="<?php echo htmlspecialchars($user['firstName']); ?>" required>
        </div>

        <div class="form-group">
            <label for="lastName">Nazwisko</label>
            <input type="text" class="form-control" id="lastName" name="lastName"
                value="<?php echo htmlspecialchars($user['lastName']); ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email"
                value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>

        <div class="form-group">
    <label for="role_id">Rola</label>
    <select class="form-control" id="role_id" name="role_id" disabled style="background-color:rgb(41, 41, 41); cursor: not-allowed;">
        <?php
                $rolesSql = "SELECT id, role FROM roles";
                $rolesResult = $conn->query($rolesSql);
                while ($role = $rolesResult->fetch_assoc()) {
                    $selected = ($role['id'] == $user['role_id']) ? 'selected' : '';
                    echo "<option value='{$role['id']}' $selected>{$role['role']}</option>";
                }
                ?>
            </select>
        </div>



        <!-- Pole wyboru klasy dla studenta -->
        <?php if ($user['role_id'] == 1): // Rola studenta ?>
            <div class="form-group">
                <label for="class_id">Przypisana klasa</label>
                <select class="form-control" id="class_id" name="class_id">
                    <option value="">Wybierz klasę</option>
                    <?php
                    $classesSql = "SELECT id_klasy, nazwa FROM klasa";
                    $classesResult = $conn->query($classesSql);
                    while ($class = $classesResult->fetch_assoc()) {
                        $selected = ($class['id_klasy'] == $user['assigned_class']) ? 'selected' : '';
                        echo "<option value='{$class['id_klasy']}' $selected>{$class['nazwa']}</option>";
                    }
                    ?>
                </select>
            </div>
        <?php endif; ?>

        <div class="form-group">
            <label for="birthday">Data urodzenia</label>
            <input type="date" class="form-control" id="birthday" name="birthday"
                value="<?php echo $user['birthday']; ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
        <a href="?view=users" class="btn btn-secondary">Anuluj</a>
    </form>
</div>

<?php
$conn->close();
?>