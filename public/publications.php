<?php
    include_once __DIR__ . "/../app/includes/checklogin.inc.php";
    include_once __DIR__ . "/../app/includes/components/head.html";

    include_once __DIR__ . "/../app/classes/models/dbh.class.php";
    include_once __DIR__ . "/../app/classes/models/publications_model.class.php";
    include_once __DIR__ . "/../app/classes/views/publications_view.class.php";

    // Include managing publications logic
    include_once __DIR__ . "/../app/includes/publications.inc.php";

?>

<title>ThèseBM - Publications</title>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar Navigation -->
        <?php include_once __DIR__ . "/../app/includes/components/navbar.php" ?>

        <div class="flex-grow-1 main-content-wrapper">
            <!-- Header -->
            <?php
            include_once __DIR__ . "/../app/includes/components/header.php";
            ?>

            <!-- Start Main Content -->
            <main>
                <div class="container">
                    <div>
                        <h3>Publications</h3>
                        
                        <?php
                            $view = new PublicationsView();
                            $view->renderErrorPopup();
                            $view->renderPublicationsTable();
                        ?>

                        <?php include_once __DIR__ . "/../app/includes/components/confirm-delete.html" ?>

                        <?php if ($_SESSION["role"] === "thesard"): ?>
                            <!-- Start Modal -->
                            <div class="modal fade" id="addPublicationModal" tabindex="-1" aria-labelledby="addPublicationModal" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="addPublicationModalLabel">Ajouter Publication</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="reference" class="form-label">Référence *</label>
                                                    <input type="text" class="form-control" id="reference" name="reference">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="titre" class="form-label">Titre *</label>
                                                    <input type="text" class="form-control" id="titre" name="titre">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="auteurs" class="form-label">Auteurs *</label>
                                                    <input type="text" class="form-control" id="auteurs" name="auteurs">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="lieu" class="form-label">Lieu *</label>
                                                    <input type="text" class="form-control" id="lieu" name="lieu">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="doi" class="form-label">DOI *</label>
                                                    <input type="text" class="form-control" id="doi" name="doi">
                                                </div>
                                                <div class="flex-grow-1">
                                                    <label for="date" class="form-label">Date *</label>
                                                    <input type="date" class="form-control" id="date" name="date">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="type" class="form-label">Type *</label>
                                                    <select class="form-select" id="type" name="type">
                                                        <option selected disabled>Sélectionnez un type</option>
                                                        <option value="Publication">Publication</option>
                                                        <option value="Communication">Communication</option>
                                                        <option value="Conférence">Conférence</option>
                                                        <option value="Chapitre">Chapitre</option>
                                                        <option value="Journal">Journal</option>
                                                    </select>
                                                </div>
                                                <div class="d-flex gap-3 mb-3">
                                                    <div class="flex-grow-1">
                                                        <label for="numero" class="form-label">Numéro</label>
                                                        <input type="number" class="form-control" id="numero" name="numero" min="1" max="999999">
                                                    </div>
                                                    <div class="flex-grow-1" id="volume-wrapper">
                                                        <label for="volume" class="form-label">Volume</label>
                                                        <input type="number" class="form-control" id="volume" name="volume" min="1" max="999999">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="attestation" class="form-label">Attestation *</label>
                                                    <input type="file" class="form-control" id="attestation" name="attestation">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="publication" class="form-label">Publication *</label>
                                                    <input type="file" class="form-control" id="publication" name="publication">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="rapport" class="form-label">Rapport *</label>
                                                    <input type="file" class="form-control" id="rapport" name="rapport">
                                                </div>
                                                <div class="text-secondary"><small>* Champ obligatoire</small></div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    <i class="fa-solid fa-xmark"></i>
                                                    Fermer
                                                </button>
                                                <button type="submit" class="btn btn-primary" name="action" value="add">
                                                    <i class="fa-solid fa-floppy-disk"></i>
                                                    Ajouter
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <script>
                                    const volumeInput = document.getElementById('volume');
                                    const volumeWrapper = document.getElementById('volume-wrapper');
                                    const selectType = document.getElementById('type');

                                    volumeWrapper.style.display = 'none';

                                    selectType.addEventListener('change', function() {
                                        if (selectType.value === 'Journal') {
                                            volumeInput.removeAttribute('disabled');
                                            volumeWrapper.style.display = 'block';
                                        } else {
                                            volumeInput.setAttribute('disabled', '');
                                            volumeWrapper.style.display = 'none';
                                        }
                                    })
                                </script>
                            </div>
                            <!-- End Modal -->
                        <?php endif; ?>
                    </div>
                </div>
            </main>
            <!-- End Main Content -->
        </div>
    </div>
</body>

</html>