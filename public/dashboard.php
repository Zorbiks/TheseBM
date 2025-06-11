<?php
include_once __DIR__ . "/../app/includes/checklogin.inc.php";
include_once __DIR__ . "/../app/includes/components/head.html";

include_once __DIR__ . "/../app/classes/models/dbh.class.php";
include_once __DIR__ . "/../app/classes/models/dashboard_model.class.php";
include_once __DIR__ . "/../app/classes/views/dashboard_view.class.php";

$view = new DashboardView();
?>

<title>ThèseBM - Dashboard</title>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar Navigation -->
        <?php include_once __DIR__ .  "/../app/includes/components/navbar.php"; ?>

        <div class="flex-grow-1 main-content-wrapper">
            <!-- Header -->
            <?php include_once __DIR__ . "/../app/includes/components/header.php"; ?>

            <!-- Start Main Content -->
            <main>
                <div class="container">
                    <div class="mb-5">
                        <h3>Statistiques</h3>
                        <div>
                            <div class="row g-4">
                                <div class="col-12">
                                    <div class="card text-center h-100">
                                        <div class="card-body d-flex flex-column justify-content-center">
                                            <div class="fw-bold fs-5 mb-4">Statistiques Sur Les Publications</div>
                                            <div class="row gap-2">
                                                <?php $view->renderPublicationStats(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $view->renderThesardStats(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="journal">
                        <h3>Journalisation</h3>
                        <?php $view->renderJournal(); ?>
                    </div>
                </div>
            </main>
            <!-- End Main Content -->
        </div>
    </div>
</body>
</html>