<?php

class SignupView {
    // Display a popup with an error or success message based on the GET parameter "error"
    public function renderErrorPopup() {
        if (isset($_GET["error"])):
            $message = "";
            $popupType = "";
            switch ($_GET["error"]) {
                case "emptyInput":
                    $message = "Tous les champs de saisie doivent être remplis";
                    break;
                case "emailInvalid":
                    $message = "L'email soumis est invalide";
                    break;
                case "passwordDontMatch":
                    $message = "Les mots de passe ne correspondent pas";
                    break;
                case "emailTaken":
                    $message = "L'adresse e-mail est déjà prise";
                    break;
                case "passwordLength":
                    $message = "Le mot de passe doit avoir une longueur comprise entre 8 et 24 caractères";
                    break;
                case "none":
                    $message = "L'inscription a réussi, votre compte sera bientôt activé";
                    break;
            }

            // Set popup color depending on error or success
            if ($_GET["error"] === "none") {
                $popupType = "success";
            } else {
                $popupType = "danger";
            }
?>
            <div class="toast show position-absolute mt-5 top-0 start-50 translate-middle-x align-items-center text-bg-<?= $popupType ?> border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body"><?= $message ?></div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
<?php
        endif;
    }
}
