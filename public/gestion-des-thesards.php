<?php include_once("includes/checklogin.inc.php") ?>
<?php include_once("includes/components/head.html") ?>

<title>ThèseBM - Gestion des Thésards</title>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar Navigation -->
        <?php include_once("includes/components/navbar.php") ?>

        <div class="flex-grow-1 main-content-wrapper">
            <!-- Header -->
            <?php
                include_once("includes/components/header.php");
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
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter Thésard</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Prénom</label>
                                                <input type="text" class="form-control" id="firstname" name="firstname">
                                            </div>
                                            <div class="mb-3">
                                                <label for="lastname" class="form-label">Nom</label>
                                                <input type="text" class="form-control" id="lastname" name="lastname">
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">E-mail</label>
                                                <input type="email" class="form-control" id="email" name="email">
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Mot de passe</label>
                                                <input type="password" class="form-control" id="password" name="password">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                <i class="fa-solid fa-xmark"></i>
                                                Close
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa-solid fa-floppy-disk"></i>
                                                Save changes
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <?php
                            include_once("classes/models/dbh.class.php");
                            include_once("classes/models/thesards_mgr_model.class.php");
                            include_once("classes/views/thesards_mgr_view.class.php");
                            $view = new ThesardsMgrView();
                            $view->renderThesardsTable();
                            $view->renderErrorPopup();
                        ?>
                        
                    </div>
                </div>
            </main>
            <!-- End Main Content -->
        </div>
    </div>
</body>
</html>