<?php

class PublicationsView extends PublicationModel {
    // Show a popup message based on error or success passed via GET parameters
    public function renderErrorPopup() {
        if (isset($_GET["error"])) {
            $message = "";
            $popupType = "";

            // If no error, set success messages based on action type
            if ($_GET["error"] === "none") {
                $popupType = "success";
                switch ($_GET["action"]) {
                    case "delete":
                        $message = "La publication a été supprimée avec succès";
                        break;
                    case "add":
                        $message = "La publication a été ajoutée avec succès";
                        break;
                    case "edit":
                        $message = "La publication a été modifiée avec succès";
                        break;
                }
            } else {
                // If there is an error, display appropriate error message
                $popupType = "danger";
                switch ($_GET["error"]) {
                    case "notPDF":
                        $message = "Veuillez soumettre uniquement des fichiers PDF";
                        break;
                    case "emptyInput":
                        $message = "Tous les champs de saisie requis doivent être remplis";
                        break;
                }
            }
            ?>
            <div class="toast show position-absolute mt-5 top-0 start-50 translate-middle-x align-items-center text-bg-<?= $popupType ?> border-0"
                role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body"><?= $message ?></div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto"
                            data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
            <?php
        }
    }

    // Render the publications table
    public function renderPublicationsTable() {
        $publications = null;

        // Load publications based on user role and optional search results from GET param
        if ($_SESSION["role"] === "thesard") {
            if (isset($_GET["results"])) {
                $publications = unserialize(urldecode($_GET['results']));
            } else {
                $publications = $this->getPublicationsByThesardId($_SESSION["id"]);
            }
        } elseif ($_SESSION["role"] === "professeur") {
            if (isset($_GET["results"])) {
                $publications = unserialize(urldecode($_GET['results']));
            } else {
                $publications = $this->getAllPublications();
            }
        }

        // If no publications, show message and add button for thesards
        if (!$publications || count($publications) === 0): ?>
            <p>Il n'y a aucune publication pour le moment.</p>
            <div class="d-flex gap-5 justify-content-end">
                <!-- Button trigger modal -->
                <?php if ($_SESSION["role"] === "thesard"): ?>
                    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#publicationModal">
                        <i class="fa-solid fa-plus fa-fw"></i>
                        Ajouter publication
                    </button>
                    <form>
                        <div class="d-flex gap-2">
                            <select class="form-select" name="filter">
                                <option value="titre" selected>Titre</option>
                                <option value="thesard">Thésard</option>
                                <option value="auteurs">Auteurs</option>
                                <option value="doi">DOI</option>
                                <option value="reference">Référence</option>
                            </select>
                            <input type="text" class="form-control" name="search" placeholder="Rechercher">
                            <button type="submit" class="btn btn-primary" name="action" value="search">
                                <i class="fa-solid fa-magnifying-glass fa-fw"></i>
                            </button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="d-flex gap-5 justify-content-end">
                <!-- Button trigger modal -->
                <?php if ($_SESSION["role"] === "thesard"): ?>
                    <button type="button" class="btn btn-primary mb-2" id="add-btn" data-bs-toggle="modal" data-bs-target="#publicationModal">
                        <i class="fa-solid fa-plus fa-fw"></i>
                        Ajouter publication
                    </button>
                <?php endif; ?>

                <?php if ($_SESSION["role"] === "professeur"): ?>
                    <button type="button" class="btn btn-primary mb-2">
                        <i class="fa-solid fa-file-export fa-fw"></i>
                        Exporter
                    </button>
                <?php endif; ?>

                <form>
                    <div class="d-flex gap-2">
                        <select class="form-select" name="filter">
                            <option value="titre" selected>Titre</option>
                            <option value="thesard">Thésard</option>
                            <option value="auteurs">Auteurs</option>
                            <option value="doi">DOI</option>
                            <option value="reference">Référence</option>
                        </select>
                        <input type="text" class="form-control" name="search" placeholder="Rechercher">
                        <button type="submit" class="btn btn-primary" name="action" value="search">
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
                        <?php foreach ($publications as $publication): ?>
                            <tr>
                                <td class="reference"><?= $publication["reference"] ?></td>
                                <td class="titre"><?= $publication["titre"] ?></td>
                                <td class="auteurs"><?= $publication["auteurs"] ?></td>
                                <td class="numero"><?= $publication["numero"] ?></td>
                                <td class="volume"><?= $publication["volume"] ?></td>
                                <td class="date"><?= $publication["date"] ?></td>
                                <td class="lieu"><?= $publication["lieu"] ?></td>
                                <td class="doi"><?= $publication["doi"] ?></td>
                                <td class="type"><?= $publication["type"] ?></td>
                                <td><?= $publication["soumis_par"] ?></td>
                                <td>
                                    <a class="btn btn-success attestation" href="../<?= $publication["attestation"] ?>" download>
                                        <i class="fa-solid fa-download fa-fw"></i>
                                        Télécharger
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-success rapport" href="../<?= $publication["rapport"] ?>" download>
                                        <i class="fa-solid fa-download fa-fw"></i>
                                        Télécharger
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-success publication" href="../<?= $publication["publication"] ?>" download>
                                        <i class="fa-solid fa-download fa-fw"></i>
                                        Télécharger
                                    </a>
                                    <a class="btn btn-primary" href="../<?= $publication["publication"] ?>" target="_blank">
                                        <i class="fa-solid fa-eye fa-fw"></i>
                                        Consulter
                                    </a>
                                </td>
                                <?php if ($_SESSION["role"] === "thesard"): ?>
                                    <td>
                                        <button type="button" class="btn btn-secondary modify-btn" data-bs-toggle="modal" data-bs-target="#publicationModal" data-tbm-id="<?= $publication["id"] ?>">
                                            <i class="fa-solid fa-pen fa-fw"></i>
                                            Modifier
                                        </button>
                                        <button type="button" class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#confirmDeletionModal" data-tbm-id="<?= $publication["id"] ?>">
                                            <i class="fa-solid fa-trash-can fw-fa"></i>
                                            Supprimer
                                        </button>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif;
    }
}
