<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Średnie ocen</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
 
        
            <!-- Sekcja ze średnimi ocenami -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title">Średnie ocen z poszczególnych przedmiotów</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Przedmiot</th>
                                        <th>Średnia ocen</th>
                                        <th>Liczba ocen</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require_once "../scripts/connect.php";
                                    $user_id = $_SESSION["logged"]["user_id"];
                                    $query = "
                                        SELECT 
                                            przedmioty.nazwa_przedmiotu, 
                                            ROUND(AVG(wpisy.wartosc), 2) AS avg_grade, 
                                            COUNT(wpisy.wartosc) AS grade_count
                                        FROM 
                                            wpisy
                                        INNER JOIN oceny ON wpisy.id_oceny = oceny.id_oceny
                                        INNER JOIN przedmioty ON oceny.id_przedmiotu = przedmioty.id_przedmiotu
                                        WHERE oceny.id_ucznia = ?
                                        GROUP BY przedmioty.id_przedmiotu
                                        ORDER BY przedmioty.nazwa_przedmiotu";
                                    $stmt = $conn->prepare($query);
                                    $stmt->bind_param("i", $user_id);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . htmlspecialchars($row['nazwa_przedmiotu']) . "</td>";
                                            echo "<td>" . ($row['avg_grade'] ?: 'Brak') . "</td>";
                                            echo "<td>" . $row['grade_count'] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='3' class='text-center'>Brak ocen do wyświetlenia.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                
           

            <!-- Możesz dodać dodatkowe sekcje -->
        </div>
   
    <!-- /.content -->
</div>