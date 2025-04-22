<?php

class DemandesView extends DemandesModel {
    public function renderDemandesTable() {
        $thesards = $this->getInactiveAccounts();
        if (count($thesards) === 0):
        ?>
            <p>Il n'y a pas de demandes d'inscriptions en ce moment.</p>
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
                        <a class="btn btn-success" href="includes/demandes.inc.php?id=<?= $thesard["id"] ?>&action=accept">
                            <i class="fa-solid fa-check fw-fa"></i>
                            Accepter
                        </a>
                        <a class="btn btn-danger" href="includes/demandes.inc.php?id=<?= $thesard["id"] ?>&action=reject">
                            <i class="fa-solid fa-xmark fw-fa"></i>
                            Rejeter
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
        if (isset($_GET["error"]) && isset($_GET["action"])):
            $message = "";
            if ($_GET["error"] === "none") {
                if ($_GET["action"] === "accept") {
                    $message = "L'activation du compte thésard a été réussie";
                } elseif ($_GET["action"] === "reject") {
                    $message = "La demande d'activation a été rejetée avec succès";
                }
            }
        ?>
            <div class="toast show position-absolute mt-5 top-0 start-50 translate-middle-x align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body"><?= $message ?></div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        <?php
        endif;
    }
}
