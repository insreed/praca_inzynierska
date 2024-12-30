<?php
require_once '../scripts/connect.php';

// Pobranie statystyk z bazy danych
$totalUsers = $conn->query("SELECT COUNT(*) as count FROM users")->fetch_assoc()['count'];
$totalClasses = $conn->query("SELECT COUNT(*) as count FROM klasa")->fetch_assoc()['count'];
$totalSubjects = $conn->query("SELECT COUNT(*) as count FROM przedmioty")->fetch_assoc()['count'];
?>

<div class="container mt-4">
    <!-- Statystyki -->
    <div class="row mb-4">
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card text-white bg-primary shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Użytkownicy</h5>
                    <p class="card-text">Liczba użytkowników: <strong><?php echo $totalUsers; ?></strong></p>
                    <a href="?view=users" class="btn btn-light btn-sm">Zarządzaj użytkownikami</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card text-white bg-success shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Klasy</h5>
                    <p class="card-text">Liczba klas: <strong><?php echo $totalClasses; ?></strong></p>
                    <a href="?view=classes" class="btn btn-light btn-sm">Zarządzaj klasami</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card text-white bg-info shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Przedmioty</h5>
                    <p class="card-text">Liczba przedmiotów: <strong><?php echo $totalSubjects; ?></strong></p>
                    <a href="?view=subjects" class="btn btn-light btn-sm">Zarządzaj przedmiotami</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Szybkie akcje i ostatnie działania -->
    <div class="row">
        <!-- Kafelek Szybkie Akcje -->
       <div class="col-lg-6 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
            <!-- Wyśrodkowanie napisu -->
            <div class="text-center mb-4 p-1">
                <h5 class="card-title">Szybkie akcje</h5>
            </div>
            <!-- Przyciskowy układ -->
            <div class="d-grid gap-3">
                <a href="?view=users#addUserForm" class="btn btn-primary btn-block">Dodaj nowego użytkownika</a>
                <a href="?view=classes" class="btn btn-success btn-block">Dodaj klasę</a>
                <a href="?view=subjects" class="btn btn-info btn-block">Dodaj przedmiot</a>
            </div>
        </div>
    </div>
</div>

     

    </div>
</div>

<?php
$conn->close();
?>
