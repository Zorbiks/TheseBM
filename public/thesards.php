<?php
include_once __DIR__ . "/../app/includes/checklogin.inc.php";
include_once __DIR__ . "/../app/includes/components/head.html";

include_once __DIR__ . "/../app/classes/models/dbh.class.php";
include_once __DIR__ . "/../app/classes/models/thesards_model.class.php";
include_once __DIR__ . "/../app/classes/views/thesards_view.class.php";
?>

<title>ThèseBM - Thésards</title>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar Navigation -->
        <?php include_once __DIR__ . "/../app/includes/components/navbar.php" ?>

        <div class="flex-grow-1 main-content-wrapper">
            <!-- Header -->
            <?php include_once __DIR__ . "/../app/includes/components/header.php"; ?>

            <!-- Start Main Content -->
            <main>
                <div class="container">
                    <div>
                        <h3>Thésards</h3>
                        <p>Liste de tous les thésards sur la plateforme</p>
                        <?php
                            $view = new ThesardView();
                            $view->renderThesardsTable();
                        ?>
                    </div>
                </div>
            </main>
            <!-- End Main Content -->
        </div>
    </div>
</body>
</html>