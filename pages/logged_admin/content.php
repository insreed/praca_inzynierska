<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Panel administratora</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Panel administratora</li>
                    </ol>
                </div>
            </div>
        </div>
    </div> -->
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <?php
            if (isset($_GET['view'])) {
                $view = $_GET['view'];

                switch ($view) {
                    case 'users':
                        include 'admin_users.php';
                        break;

                    case 'add_user':
                        include 'admin_add_user.php';
                        break;

                    case 'classes':
                        include 'admin_classes.php';
                        break;

                    case 'subjects':
                        include 'admin_subjects.php';
                        break;

                    case 'grades':
                        include 'admin_grades.php';
                        break;

                    case 'edit_user':
                        include 'edit_user.php';
                        break;

                    case 'assign_teacher':
                        include 'assign_teacher.php';
                        break;

                    case 'dashboard':
                        include 'admin_dashboard.php';
                        break;

                    default:
                        echo "<h2 class='text-center text-danger'>Nieznany widok!</h2>";
                        echo "<p class='text-center'>Widok, który próbujesz załadować, nie istnieje. Wróć do pulpitu.</p>";
                        echo "<div class='text-center mt-4'><a href='?view=dashboard' class='btn btn-primary'>Powrót do pulpitu</a></div>";
                        break;
                }
            } else {
                // Domyślny widok
                include 'admin_dashboard.php';
            }

            ?>
        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
