<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="./logged.php" class="brand-link">
        <img src="../dist/img/LOGO.png" alt="LOGO" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Dziennik Elektroniczny</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../img/<?php echo $_SESSION["logged"]["avatar"]; ?>" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="http://localhost/praca_inzynierska/pages/logged.php"
                    class="d-block"><?php echo $_SESSION["logged"]["firstName"] . " " . $_SESSION["logged"]["lastName"]; ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a class="nav-link <?php echo (!isset($_GET['subjectId']) && !isset($_GET['view']) || (isset($_GET['view']) && $_GET['view'] == 'dashboard')) ? 'active' : ''; ?>"
                        href="?view=dashboard">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        Pulpit
                    </a>
                </li>

                <!-- Subject Header -->
                <li class="nav-header">PRZEDMIOTY</li>
                <?php
                require_once "../scripts/connect.php";
                $user_id = $_SESSION["logged"]["user_id"];

                // Pobierz przedmioty nauczyciela
                $subjectQuery = "SELECT DISTINCT przedmioty.nazwa_przedmiotu, przedmioty.id_przedmiotu 
                                 FROM przedmioty 
                                 INNER JOIN przydział_nauczyciel ON przedmioty.id_przedmiotu = przydział_nauczyciel.id_przedmiotu 
                                 WHERE przydział_nauczyciel.id_nauczyciela = $user_id";
                $subjectResult = $conn->query($subjectQuery);

                if ($subjectResult->num_rows > 0) {
                    while ($subject = $subjectResult->fetch_assoc()) {
                        $isSubjectActive = (isset($_GET['subjectId']) && $_GET['subjectId'] == $subject['id_przedmiotu']) ? 'menu-open' : '';
                        $isActive = (isset($_GET['subjectId']) && $_GET['subjectId'] == $subject['id_przedmiotu']) ? 'active' : '';

                        echo "<li class='nav-item $isSubjectActive'>
                                <a href='#' class='nav-link $isActive'>
                                    <i class='nav-icon fas fa-book'></i>
                                    <p>
                                        {$subject['nazwa_przedmiotu']}
                                        <i class='right fas fa-angle-left'></i>
                                    </p>
                                </a>
                                <ul class='nav nav-treeview'>";

                        // Pobierz klasy dla przedmiotu
                        $classQuery = "SELECT klasa.nazwa AS klasa_nazwa, klasa.id_klasy 
                                       FROM przydział_nauczyciel 
                                       INNER JOIN klasa ON przydział_nauczyciel.id_klasy = klasa.id_klasy 
                                       WHERE przydział_nauczyciel.id_nauczyciela = $user_id 
                                       AND przydział_nauczyciel.id_przedmiotu = {$subject['id_przedmiotu']}";
                        $classResult = $conn->query($classQuery);

                        if ($classResult->num_rows > 0) {
                            while ($class = $classResult->fetch_assoc()) {
                                $isActiveClass = (isset($_GET['classId']) && $_GET['classId'] == $class['id_klasy']) ? 'active' : '';
                                echo "<li class='nav-item'>
                                        <a href='./logged.php?subjectId={$subject['id_przedmiotu']}&classId={$class['id_klasy']}' class='nav-link $isActiveClass'>
                                            <i class='fas fa-users nav-icon'></i>
                                            <p>{$class['klasa_nazwa']}</p>
                                        </a>
                                      </li>";
                            }
                        } else {
                            echo "<li class='nav-item'><p class='text-muted ml-3'>Brak klas</p></li>";
                        }

                        echo "</ul>
                              </li>";
                    }
                } else {
                    echo "<li class='nav-item'><p class='text-muted ml-3'>Brak przedmiotów</p></li>";
                }
                ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>