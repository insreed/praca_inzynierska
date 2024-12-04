<?php
require_once '../scripts/connect.php';

// Wyświetlanie komunikatów o sukcesie lub błędzie (przekazane przez parametr GET)
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $message = isset($_SESSION["message"]) ? $_SESSION["message"] : "";
    $alertClass = '';

    if ($action === "edit" && !empty($message)) {
        $alertClass = ($_GET['success'] === "true") ? "alert-success" : "alert-danger";
    } elseif ($action === "delete" && !empty($message)) {
        $alertClass = ($_GET['success'] === "true") ? "alert-success" : "alert-danger";
    }

    if (!empty($alertClass)) {
        echo <<<ALERT
        <div class="alert $alertClass alert-dismissible fade show" role="alert">
            $message
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        ALERT;
        unset($_SESSION["message"]); // Usunięcie komunikatu z sesji
    }
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
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT `users`.`id`, `users`.`firstName`, `users`.`lastName`, `roles`.`role`, `users`.`email` FROM users INNER JOIN roles ON `users`.`role_id` = `roles`.`role` ORDER BY `id`";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($user = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$user['id']}</td>";
                        echo "<td>{$user['firstName']}</td>";
                        echo "<td>{$user['lastName']}</td>";
                        echo "<td>{$user['role']}</td>";
                        echo "<td>{$user['email']}</td>";
                        echo "<td>
                                <a href='?view=users&updateUserId={$user['id']}' class='btn btn-warning btn-sm'>Edytuj</a>
                                <a href='../scripts/delete_user.php?deleteUserId={$user['id']}' class='btn btn-danger btn-sm'>Usuń</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>Brak użytkowników w bazie danych.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Edytowanie użytkownika -->
    <?php
    if (isset($_GET['updateUserId'])) {
        $updateUserId = $_GET['updateUserId'];
        $sql = "SELECT * FROM users WHERE id=$updateUserId";
        $result = $conn->query($sql);
        $updateUser = $result->fetch_assoc();

        if ($updateUser) {
            echo <<<EDITUSERMODAL
            <div class="modal show fade" id="editUserModal" tabindex="-1" role="dialog" style="display: block; background: rgba(0, 0, 0, 0.8);">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edytuj użytkownika</h5>
                            <button type="button" class="close" onclick="window.location.href='?view=users'" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="../scripts/update_user.php" method="post">
                                <input type="hidden" name="user_id" value="{$updateUser['id']}">
                                <div class="form-group">
                                    <label for="firstName">Imię</label>
                                    <input type="text" class="form-control" id="firstName" name="firstName" value="{$updateUser['firstName']}" required>
                                </div>
                                <div class="form-group">
                                    <label for="lastName">Nazwisko</label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" value="{$updateUser['lastName']}" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{$updateUser['email']}" required>
                                </div>
                                <div class="form-group">
                                    <label for="additionalEmail">Pomocniczy email</label>
                                    <input type="email" class="form-control" id="additionalEmail" name="additional_email" value="{$updateUser['additional_email']}">
                                </div>
                                <div class="form-group">
                                    <label for="role_id">Rola</label>
                                    <select class="form-control" id="role_id" name="role_id" required>
EDITUSERMODAL;
            $rolesSql = "SELECT * FROM roles";
            $rolesResult = $conn->query($rolesSql);
            while ($role = $rolesResult->fetch_assoc()) {
                $selected = $updateUser['role_id'] == $role['id'] ? 'selected' : '';
                echo "<option value='{$role['id']}' $selected>{$role['role']}</option>";
            }
            echo <<<EDITUSERMODAL
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="birthday">Data urodzenia</label>
                                    <input type="date" class="form-control" id="birthday" name="birthday" value="{$updateUser['birthday']}">
                                </div>
                                <button type="submit" class="btn btn-primary">Zaktualizuj użytkownika</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                // W momencie załadowania strony automatycznie przewijamy do modala
                window.onload = function() {
                    document.getElementById('editUserModal').scrollIntoView();
                };
            </script>
            EDITUSERMODAL;
        }
    }
    ?>

</div>

<?php
$conn->close();
?>