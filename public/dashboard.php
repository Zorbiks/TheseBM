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
                                            <div class="fw-bold fs-5 mb-5">Publications</div>
                                            <div class="row">
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

                        <!-- <div class="card">
                            <div class="card-body py-0">
                                <div class="event py-2">
                                    <span class="fw-bold">Ahmad Mohammed</span>,
                                    <span class="fw-bold text-primary">a ajouté</span>
                                    <span>Lorem Ipsum Dolor Sit Amet Consectetur Adipiscing Elit Integer Nec Odio. Praesent Libero</span>
                                    <span class="fw-bold text-primary">2025-4-15 17:40:22</span>
                                </div>
                                <div class="event py-2">
                                    <span class="fw-bold">Mahmoud Ali</span>,
                                    <span class="text-warning fw-bold">a modifié</span>
                                    <span>Sed Cursus Ante Dapibus Diam. Sed Nisi Nulla Quis Sem At Nibh Elementum Imperdiet Duis Sagittis Ipsum</span>
                                    <span class="fw-bold text-body-tertiary">2025-4-17 9:12:01</span>
                                </div>
                                <div class="event py-2">
                                    <span class="fw-bold">Oussama Sayed</span>,
                                    <span class="text-danger fw-bold">a supprimé</span>
                                    <span>Fusce Nec Tellus Sed Augue Semper Porta Mauris Massa Vestibulum Lacinia Arcu Eget Nulla</span>
                                    <span class="fw-bold text-body-tertiary">2025-4-24 10:10:00</span>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </main>
            <!-- End Main Content -->
        </div>
    </div>
</body>
</html>