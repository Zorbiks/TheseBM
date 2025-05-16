<?php
include_once __DIR__ . "/../app/includes/checklogin.inc.php";
include_once __DIR__ . "/../app/includes/components/head.html";

include_once __DIR__ . "/../app/classes/models/dbh.class.php";
include_once __DIR__ . "/../app/classes/models/thesards_mgr_model.class.php";
include_once __DIR__ . "/../app/classes/views/thesards_mgr_view.class.php";

// Include managing thesards login
include_once __DIR__ . "/../app/includes/thesards-mgr.inc.php";
?>

<title>ThèseBM - Gestion des Thésards</title>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar Navigation -->
        <?php include_once  __DIR__ . "/../app/includes/components/navbar.php" ?>

        <div class="flex-grow-1 main-content-wrapper">
            <!-- Header -->
            <?php
                include_once __DIR__ . "/../app/includes/components/header.php";
            ?>

            <!-- Start Main Content -->
            <main>
                <div class="container">
                    <div>
                        <h3>Gestion des Thésards</h3>
                        <p>Les thésards dans la Platforme</p>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addThesardModal">
                            <i class="fa-solid fa-user-plus fa-fw"></i>
                            Ajouter thésard
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="addThesardModal" tabindex="-1" aria-labelledby="addThesardModal" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="addThesardModalLabel">Ajouter Thésard</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="GET" action="">
                                        <div class="modal-body">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Prénom">
                                                <label for="firstname" class="form-label">Prénom</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Nom">
                                                <label for="lastname" class="form-label">Nom</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail">
                                                <label for="email" class="form-label">E-mail</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" minlength="8" maxlength="24">
                                                <label for="password" class="form-label">Mot de passe</label>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                <i class="fa-solid fa-xmark"></i>
                                                Fermer
                                            </button>
                                            <button class="btn btn-primary" type="submit" name="action" value="add">
                                                <i class="fa-solid fa-floppy-disk"></i>
                                                Ajouter
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <?php
                            $view = new ThesardsMgrView();
                            $view->renderErrorPopup();
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