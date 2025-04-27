<?php include_once "../app/includes/checklogin.inc.php" ?>
<?php include_once "../app/includes/components/head.html" ?>

<title>ThèseBM - Dashboard</title>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar Navigation -->
        <?php include_once "../app/includes/components/navbar.php"; ?>

        <div class="flex-grow-1 main-content-wrapper">
            <!-- Header -->
            <?php include_once "../app/includes/components/header.php"; ?>

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
                                                <div class="col-md-6 col-lg-3 border-end border-3">
                                                    <div class="fw-bold fs-5">Publications</div>
                                                    <div class="fw-bold fs-5">16</div>
                                                </div>
                                                <div class="col-md-6 col-lg-3 border-end border-3">
                                                    <div class="fw-bold fs-5">Communications</div>
                                                    <div class="fw-bold fs-5">4</div>
                                                </div>
                                                <div class="col-md-6 col-lg-3 border-end border-3">
                                                    <div class="fw-bold fs-5">Conférences</div>
                                                    <div class="fw-bold fs-5">2</div>
                                                </div>
                                                <div class="col-md-6 col-lg-3">
                                                    <div class="fw-bold fs-5">Chapitres</div>
                                                    <div class="fw-bold fs-5">5</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card text-center h-100">
                                        <div class="card-body d-flex flex-column justify-content-center">
                                            <div class="fw-bold fs-5">Thésards</div>
                                            <div class="fw-bold fs-5">16</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card text-center h-100">
                                        <div class="card-body d-flex flex-column justify-content-center">
                                            <div class="fw-bold fs-5">Demandes d'inscription</div>
                                            <div class="fw-bold fs-5">16</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="journal">
                        <h3>Journalisation</h3>
                        <div class="card">
                            <div class="card-body py-0">
                                <div class="event py-2">
                                    <span class="fw-bold">Ahmad Mohammed</span>,
                                    <span class="text-success fw-bold">a ajouté</span>
                                    <span>Lorem Ipsum Dolor Sit Amet Consectetur Adipiscing Elit Integer Nec Odio. Praesent Libero</span>
                                    <span class="fw-bold text-body-tertiary">2025-4-15 17:40:22</span>
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
                        </div>
                    </div>
                </div>
            </main>
            <!-- End Main Content -->
        </div>
    </div>
</body>
</html>