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
                            <div class="modal fade" id="publicationModal" tabindex="-1" aria-labelledby="publicationModal" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="publicationModalLabel">Ajouter Publication</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            <div class="modal-body">
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
                                                    <input type="number" min="1970" class="form-control" id="date" name="date">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="type" class="form-label">Type *</label>
                                                    <select class="form-select" id="type" name="type">
                                                        <option selected disabled>Sélectionnez un type</option>
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
                                                    <input type="file" accept="application/pdf" class="form-control" id="attestation" name="attestation">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="publication" class="form-label">Publication *</label>
                                                    <input type="file" accept="application/pdf" class="form-control" id="publication" name="publication">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="rapport" class="form-label">Rapport *</label>
                                                    <input type="file" accept="application/pdf" class="form-control" id="rapport" name="rapport">
                                                </div>
                                                <div class="text-secondary"><small>* Champ obligatoire</small></div>
                                            </div>

                                            <!-- Used to send the id of the publication to modify -->
                                            <input type="text" id="pubid" name="pubid" hidden disabled>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    <i class="fa-solid fa-xmark"></i>
                                                    Fermer
                                                </button>
                                                <button type="submit" class="btn btn-primary submit" name="action" value="add">
                                                    <i class="fa-solid fa-floppy-disk"></i>
                                                    Ajouter
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <script>
                                    // Select each input field using getElementById
                                    const titreInput = document.getElementById('titre');
                                    const auteursInput = document.getElementById('auteurs');
                                    const lieuInput = document.getElementById('lieu');
                                    const doiInput = document.getElementById('doi');
                                    const dateInput = document.getElementById('date');
                                    const typeInput = document.getElementById('type'); // This is a select element
                                    const numeroInput = document.getElementById('numero');
                                    const volumeInput = document.getElementById('volume');
                                    const attestationInput = document.getElementById('attestation');
                                    const publicationInput = document.getElementById('publication');
                                    const rapportInput = document.getElementById('rapport');
                                    const pubidInput = document.getElementById('pubid');
                                    const submitBtn = document.querySelector('.submit');

                                    // Set max date to the current year
                                    const currentYear = new Date().getFullYear();
                                    dateInput.setAttribute('max', currentYear);

                                    // Activate volume only on journal type publication
                                    const volumeWrapper = document.getElementById('volume-wrapper');
                                    volumeWrapper.style.display = 'none';
                                    typeInput.addEventListener('change', function() {
                                        if (typeInput.value === 'Journal') {
                                            volumeInput.removeAttribute('disabled');
                                            volumeWrapper.style.display = 'block';
                                        } else {
                                            volumeInput.setAttribute('disabled', '');
                                            volumeWrapper.style.display = 'none';
                                        }
                                    })

                                    // Modify modal behavior when adding a publication
                                    const addBtn = document.getElementById('add-btn');
                                    addBtn.addEventListener('click', () => {
                                        clearInputFields();

                                        // Change title of modal
                                        const modalTitle = document.getElementById('publicationModalLabel');
                                        modalTitle.textContent = 'Ajouter Publication';

                                        // Change submit button label
                                        submitBtn.innerHTML = '<i class="fa-solid fa-floppy-disk"></i> Ajouter';
                                        submitBtn.setAttribute('value', 'add');

                                        // Update upload input labels to indicate required fields
                                        const attestaionLabel = document.querySelector('label[for="attestation"]');
                                        const publicationLabel = document.querySelector('label[for="publication"]');
                                        const rapportLabel = document.querySelector('label[for="rapport"]');

                                        // disable pubid input (only used for when modifying publication)
                                        pubidInput.setAttribute('disabled', true);

                                        attestaionLabel.innerHTML = "Attestation *";
                                        publicationLabel.innerHTML = "Publication *";
                                        rapportLabel.innerHTML = "Rapport *";
                                    });

                                    // Modify modal behavior when editing a publication
                                    const modifyBtns = document.querySelectorAll('.modify-btn');

                                    modifyBtns.forEach(function(btn) {
                                        btn.addEventListener('click', () => {
                                            clearInputFields();

                                            // Change title of modal
                                            const modalTitle = document.getElementById('publicationModalLabel');
                                            modalTitle.textContent = 'Modifier La Publication';

                                            // Change submit button behaviour
                                            submitBtn.innerHTML = '<i class="fa-solid fa-floppy-disk"></i> Modifer';
                                            submitBtn.setAttribute('value', 'edit');

                                            // Update upload input labels to show fields as optional
                                            // If no files are uploaded, the database remains unchanged
                                            const attestaionLabel = document.querySelector('label[for="attestation"]');
                                            const publicationLabel = document.querySelector('label[for="publication"]');
                                            const rapportLabel = document.querySelector('label[for="rapport"]');

                                            attestaionLabel.innerHTML = "Attestation <small>(Laissez le fichier vide pour conserver l’actuel)</small>";
                                            publicationLabel.innerHTML = "Publication <small>(Laissez le fichier vide pour conserver l’actuel)</small>";
                                            rapportLabel.innerHTML = "Rapport <small>(Laissez le fichier vide pour conserver l’actuel)</small>";

                                            // disable pubid input (only used for when modifying publication)
                                            pubidInput.removeAttribute('disabled');
                                            pubidInput.value = btn.dataset.tbmId;

                                            attestationInput.removeAttribute('required');
                                            publicationInput.removeAttribute('required');
                                            rapportInput.removeAttribute('required');

                                            // Get the row containg all the info about the publication
                                            // And fill the form with the data
                                            const row = btn.closest("tr");

                                            titreInput.value = row.querySelector('td.titre').textContent;
                                            auteursInput.value = row.querySelector('td.auteurs').textContent;
                                            lieuInput.value = row.querySelector('td.lieu').textContent;
                                            doiInput.value = row.querySelector('td.doi').textContent;
                                            dateInput.value = row.querySelector('td.date').textContent;
                                            typeInput.value = row.querySelector('td.type').textContent;
                                            numeroInput.value = row.querySelector('td.numero').textContent;
                                            volumeInput.value = row.querySelector('td.volume').textContent;
                                        });
                                    });

                                    // Clear all input fields
                                    function clearInputFields() {
                                        titreInput.value = '';
                                        auteursInput.value = '';
                                        lieuInput.value = '';
                                        doiInput.value = '';;
                                        dateInput.value = '';
                                        typeInput.value = '';
                                        numeroInput.value = '';
                                        volumeInput.value = '';
                                        attestationInput.value = '';
                                        publicationInput.value = '';
                                        rapportInput.value = '';
                                    }
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