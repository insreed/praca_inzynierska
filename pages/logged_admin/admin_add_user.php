<?php
require_once '../scripts/connect.php';

// Wyświetlanie komunikatów o sukcesie lub błędzie (przekazane przez parametr GET)
if (isset($_SESSION["message"])) {
    $message = $_SESSION["message"];
    $alertClass = ($_SESSION["error"] === "success") ? "alert-success" : "alert-danger"; // alert-danger dla błędów
    echo <<<ALERT
    <div class="alert $alertClass alert-dismissible fade show" role="alert">
        $message
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    ALERT;
    unset($_SESSION["message"]); // Usunięcie komunikatu z sesji po jego wyświetleniu
}
?>

<div class="container mt-4">
    <h2>Dodaj Użytkownika</h2>

    <form action="../scripts/add_user.php" method="post" class="mt-3">
        <div class="form-group">
            <label for="firstName">Imię</label>
            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Podaj imię" required>
        </div>
        <div class="form-group">
            <label for="lastName">Nazwisko</label>
            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Podaj nazwisko" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Podaj email" required>
        </div>
        <div class="form-group">
            <label for="additionalEmail">Pomocniczy email</label>
            <input type="email" class="form-control" id="additionalEmail" name="additional_email"
                placeholder="Podaj pomocniczy email">
        </div>
        <div class="form-group">
            <label for="role_id">Rola</label>
            <select class="form-control" id="role_id" name="role_id" required>
                <?php
                $sql = "SELECT * FROM roles";
                $result = $conn->query($sql);
                while ($role = $result->fetch_assoc()) {
                    echo "<option value='{$role['id']}'>{$role['role']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="birthday">Data urodzenia</label>
            <input type="date" class="form-control" id="birthday" name="birthday">
        </div>
        <div class="form-group">
            <label for="password">Hasło</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Podaj hasło"
                required>
        </div>
        <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" id="term" name="term" checked required>
            <label class="form-check-label" for="term">Akceptuję regulamin</label>
        </div>
        <button type="submit" class="btn btn-primary">Dodaj użytkownika</button>
    </form>
</div>

<?php
$conn->close();
?>