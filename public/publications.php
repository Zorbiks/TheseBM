<?php include_once "../app/includes/checklogin.inc.php" ?>
<?php include_once "../app/includes/components/head.html" ?>

<title>ThèseBM - Publications</title>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar Navigation -->
        <?php include_once "../app/includes/components/navbar.php" ?>

        <div class="flex-grow-1 main-content-wrapper">
            <!-- Header -->
            <?php
            include_once "../app/includes/components/header.php";
            ?>

            <!-- Start Main Content -->
            <main>
                <div class="container">
                    <div>
                        <h3>Publications</h3>
                        <div class="d-flex gap-5 justify-content-end">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addPublicationModal">
                                <i class="fa-solid fa-plus fa-fw"></i>
                                Ajouter publication
                            </button>
                            <?php if ($_SESSION["role"] === "professeur"): ?>
                            <button type="button" class="btn btn-primary mb-2">
                                <i class="fa-solid fa-file-export fa-fw"></i>
                                Exporter
                            </button>
                            <?php endif; ?>
                            <form>
                                <div class="d-flex gap-2">
                                    <input type="text" class="form-control" name="search" placeholder="Rechercher">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa-solid fa-magnifying-glass fa-fw"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped text-nowrap">
                                <thead>
                                    <tr>
                                        <th class="bg-primary text-light">Référence</th>
                                        <th class="bg-primary text-light">Titre</th>
                                        <th class="bg-primary text-light">Auteurs</th>
                                        <th class="bg-primary text-light">Numéro</th>
                                        <th class="bg-primary text-light">Volume</th>
                                        <th class="bg-primary text-light">Date</th>
                                        <th class="bg-primary text-light">Lieu</th>
                                        <th class="bg-primary text-light">DOI</th>
                                        <th class="bg-primary text-light">Type</th>
                                        <th class="bg-primary text-light">Soumis Par</th>
                                        <th class="bg-primary text-light">Attestation</th>
                                        <th class="bg-primary text-light">Rapport</th>
                                        <th class="bg-primary text-light">Publication</th>
                                        <?php if ($_SESSION["role"] === "thesard"): ?>
                                            <th class="bg-primary text-light">Actions</th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody class="align-middle">
                                    <tr>
                                        <td>001</td>
                                        <td>Analyse des tendances du marché numérique</td>
                                        <td>Dupont, Martin, Leblanc</td>
                                        <td>4</td>
                                        <td>-</td>
                                        <td>15/04/2023</td>
                                        <td>Paris, France</td>
                                        <td>10.1234/abcd.efg.hijk</td>
                                        <td>Communication</td>
                                        <td>Oussama Elmehdi</td>
                                        <td>
                                            <a class="btn btn-success" href="#">
                                                <i class="fa-solid fa-download fa-fw"></i>
                                                Télécharger
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-success" href="#">
                                                <i class="fa-solid fa-download fa-fw"></i>
                                                Télécharger
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-success" href="#">
                                                <i class="fa-solid fa-download fa-fw"></i>
                                                Télécharger
                                            </a>
                                            <a class="btn btn-primary" href="#">
                                                <i class="fa-solid fa-eye fa-fw"></i>
                                                Consulter
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-secondary" href="#">
                                                <i class="fa-solid fa-pen fa-fw"></i>
                                                Modifier
                                            </a>
                                            <a class="btn btn-danger" href="#">
                                                <i class="fa-solid fa-trash-can fa-fw"></i>
                                                Supprimer
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>021</td>
                                        <td>Analyse des tendances du marché numérique</td>
                                        <td>Martin, Leblanc</td>
                                        <td>2</td>
                                        <td>1</td>
                                        <td>15/04/2023</td>
                                        <td>London, United Kingdom</td>
                                        <td>10.1234/abcd.efg.hijk</td>
                                        <td>Journal</td>
                                        <td>Oussama Elmehdi</td>
                                        <td>
                                            <a class="btn btn-success" href="#">
                                                <i class="fa-solid fa-download fa-fw"></i>
                                                Télécharger
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-success" href="#">
                                                <i class="fa-solid fa-download fa-fw"></i>
                                                Télécharger
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-success" href="#">
                                                <i class="fa-solid fa-download fa-fw"></i>
                                                Télécharger
                                            </a>
                                            <a class="btn btn-primary" href="#">
                                                <i class="fa-solid fa-eye fa-fw"></i>
                                                Consulter
                                            </a>
                                        </td>
                                        <?php if ($_SESSION["role"] === "thesard"): ?>
                                        <td>
                                            <a class="btn btn-secondary" href="#">
                                                <i class="fa-solid fa-pen fa-fw"></i>
                                                Modifier
                                            </a>
                                            <a class="btn btn-danger" href="#">
                                                <i class="fa-solid fa-trash-can fa-fw"></i>
                                                Supprimer
                                            </a>
                                        </td>
                                        <?php endif; ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- Start Modal -->
                        <div class="modal fade" id="addPublicationModal" tabindex="-1" aria-labelledby="addPublicationModal" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="addPublicationModalLabel">Ajouter Publication</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="reference" class="form-label">Référence</label>
                                                <input type="text" class="form-control" id="reference" name="reference">
                                            </div>
                                            <div class="mb-3">
                                                <label for="title" class="form-label">Titre</label>
                                                <input type="text" class="form-control" id="title" name="title">
                                            </div>
                                            <div class="mb-3">
                                                <label for="authors" class="form-label">Auteurs</label>
                                                <input type="text" class="form-control" id="authors" name="authors">
                                            </div>
                                            <div class="mb-3">
                                            </div>
                                            <div class="mb-3">
                                                <label for="location" class="form-label">Lieu</label>
                                                <input type="text" class="form-control" id="location" name="location">
                                            </div>
                                            <div class="mb-3">
                                                <label for="doi" class="form-label">DOI</label>
                                                <input type="text" class="form-control" id="doi" name="doi">
                                            </div>
                                            <div class="flex-grow-1">
                                                <label for="date" class="form-label">Date</label>
                                                <input type="date" class="form-control" id="date" name="date">
                                            </div>
                                            <div class="mb-3">
                                                <label for="type" class="form-label">Type</label>
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
                                                    <label for="number" class="form-label">Numéro</label>
                                                    <input type="number" class="form-control" id="number" name="number" min="1" max="999999">
                                                </div>
                                                <div class="flex-grow-1" id="volume-wrapper">
                                                    <label for="volume" class="form-label">Volume</label>
                                                    <input type="number" class="form-control" id="volume" name="volume" min="1" max="999999">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="attestation" class="form-label">Attestation</label>
                                                <input type="file" class="form-control" id="attestation" name="attestation">
                                            </div>
                                            <div class="mb-3">
                                                <label for="publication" class="form-label">Publication</label>
                                                <input type="file" class="form-control" id="publication" name="publication">
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
                    </div>
                </div>
            </main>
            <!-- End Main Content -->
        </div>
    </div>
</body>

</html>