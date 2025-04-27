<?php include_once "../app/includes/checklogin.inc.php" ?>
<?php include_once "../app/includes/components/head.html" ?>

<title>ThèseBM - Demandes d'Inscription</title>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar Navigation -->
        <?php include_once "../app/includes/components/navbar.php"; ?>

        <div class="flex-grow-1 main-content-wrapper">
            <!-- Header -->
            <?php  include_once "../app/includes/components/header.php"; ?>

            <!-- Start Main Content -->
            <main>
                <?php
                include_once "../app/classes/models/dbh.class.php";
                include_once "../app/classes/models/demandes_model.class.php";
                include_once "../app/classes/views/demandes_view.class.php";

                $view = new DemandesView();
                $view->renderErrorPopup();
                ?>
                
                <div class="container">
                    <div class="mb-5">
                        <h3>Les Demandes d'Inscription</h3>
                        <?php $view->renderDemandesTable() ?>
                    </div>
                </div>
            </main>
            <!-- End Main Content -->
        </div>
    </div>
</body>
</html>