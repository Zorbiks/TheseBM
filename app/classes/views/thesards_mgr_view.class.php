<?php

class ThesardsMgrView extends ThesardsMgrModel {
    // Render table listing all active thésards
    public function renderThesardsTable() {
        $thesards = $this->getActiveAccounts();

        // If no active thésards, show message
        if (count($thesards) === 0):
        ?>
            <p>Il n'y a pas de thésards sur la plateforme.</p>
        <?php
        else:
        ?>
            <div class="table-responsive">
                <table class="table table-striped text-nowrap">
                    <thead>
                        <tr>
                            <th class="bg-primary text-light">Prénom</th>
                            <th class="bg-primary text-light">Nom</th>
                            <th class="bg-primary text-light">E-mail</th>
                            <th class="bg-primary text-light">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php
                        // Loop through each thésard and output a row
                        foreach($thesards as $thesard):
                        ?>
                            <tr>
                                <td class="prenom"><?= htmlspecialchars($thesard["prenom"]) ?></td>
                                <td class="nom"><?= htmlspecialchars($thesard["nom"]) ?></td>
                                <td class="email"><?= htmlspecialchars($thesard["email"]) ?></td>
                                <td>
                                <button type="button" class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#confirmDeletionModal" data-tbm-id="<?= $thesard["id"] ?>">
                                    <i class="fa-solid fa-trash-can fw-fa"></i>
                                    Supprimer
                                </button>
                                <button type="button" class="btn btn-primary modify-btn" data-bs-toggle="modal" data-bs-target="#addThesardModal" data-tbm-id="<?= $thesard["id"] ?>">
                                    <i class="fa-solid fa-pen fw-fa"></i>
                                    Modifer
                                </button>
                                </td>
                            </tr>
                        <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        <?php
        endif;
    }

    // Show a toast popup for errors or successful actions based on URL parameters
    public function renderErrorPopup() {
        if (isset($_GET["error"]) && isset($_GET["action"])) {
            $message = "";
            $popupType = "";

            // Success case
            if ($_GET["error"] === "none") {
                $popupType = "success";
                switch ($_GET["action"]) {
                    case "delete":
                        $message = "Le compte a été supprimé avec succès";
                        break;
                    case "add":
                        $message = "La compte a été ajoutée avec succès";
                        break;
                    case "modify":
                        $message = "Le compte a été modifié avec succès";
                        break;
                }
            } else {
                // Error cases
                $popupType = "danger";
                switch ($_GET["error"]) {
                    case "emailTaken":
                        $message = "L'adresse e-mail est déjà prise";
                        break;
                    case "emptyInput":
                        $message = "Tous les champs de saisie doivent être remplis";
                        break;
                    case "passwordLength":
                        $message = "Le mot de passe doit avoir une longueur comprise entre 8 et 24 caractères";
                        break;
                    case "emailInvalid":
                        $message = "L'email soumis est invalide";
                        break;
                }
            }
        ?>
            <div class="toast show position-absolute mt-5 top-0 start-50 translate-middle-x align-items-center text-bg-<?= $popupType ?> border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body"><?= $message ?></div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        <?php
        }
    }
}
