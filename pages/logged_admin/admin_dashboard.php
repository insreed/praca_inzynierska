<?php
require_once '../scripts/connect.php';

// Pobranie statystyk z bazy danych
$totalUsers = $conn->query("SELECT COUNT(*) as count FROM users")->fetch_assoc()['count'];
$totalClasses = $conn->query("SELECT COUNT(*) as count FROM klasa")->fetch_assoc()['count'];
$totalSubjects = $conn->query("SELECT COUNT(*) as count FROM przedmioty")->fetch_assoc()['count'];
?>

<div class="container mt-5 pt-5">
    <div class="text-center mb-5">
        <h1 class="display-4">Panel Administratora</h1>
        <p class="text-muted">Zarządzaj użytkownikami, klasami, przedmiotami oraz ocenami w jednym miejscu.</p>
    </div>
    <div class="row">
        <!-- Kafelek: Użytkownicy -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Użytkownicy</h5>
                    <p class="card-text">Liczba użytkowników: <strong>36</strong></p>
                    <a href="?view=users" class="btn btn-primary">Zarządzaj użytkownikami</a>
                </div>
            </div>
        </div>
        <!-- Kafelek: Klasy -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Klasy</h5>
                    <p class="card-text">Liczba klas: <strong>5</strong></p>
                    <a href="?view=classes" class="btn btn-success">Zarządzaj klasami</a>
                </div>
            </div>
        </div>
        <!-- Kafelek: Przedmioty -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Przedmioty</h5>
                    <p class="card-text">Liczba przedmiotów: <strong>11</strong></p>
                    <a href="?view=subjects" class="btn btn-info">Zarządzaj przedmiotami</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
    <div class="d-flex justify-content-center">
        <!-- Szybkie Akcje -->
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
</div>


<?php
$conn->close();
?>
