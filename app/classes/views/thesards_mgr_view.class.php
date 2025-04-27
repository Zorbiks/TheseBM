<?php

class ThesardsMgrView extends ThesardsMgrModel {
    public function renderThesardsTable() {
        $thesards = $this->getActiveAccounts();
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
                        foreach($thesards as $thesard):
                        ?>
                            <tr>
                                <td><?= $thesard["prenom"] ?></td>
                                <td><?= $thesard["nom"] ?></td>
                                <td><?= $thesard["email"] ?></td>
                                <td>
                                    <a class="btn btn-danger" href="/TheseBM/app/includes/thesards-mgr.inc.php?id=<?= $thesard["id"] ?>&action=delete">
                                    <i class="fa-solid fa-trash-can fw-fa"></i>
                                        Supprimer
                                    </a>
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

    public function renderErrorPopup() {
        if (isset($_GET["error"]) && isset($_GET["action"])) {
            $message = "";
            $popupType = "";

            if ($_GET["error"] === "none") {
                $popupType = "success";
                switch ($_GET["action"]) {
                    case "delete":
                        $message = "Le compte a été supprimé avec succès";
                        break;
                    case "add":
                        $message = "La thèse a été ajoutée avec succès";
                        break;
                }
            } else {
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
