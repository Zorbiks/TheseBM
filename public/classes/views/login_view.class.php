<?php

class LoginView {
    public function renderErrorPopup() {
        if (isset($_GET["error"])):
            $message = "";
            switch ($_GET["error"]) {
                case "emptyInput":
                    $message = "Tous les champs de saisie doivent être remplis";
                    break;
                case "emailInvalid":
                    $message = "L'email soumis est invalide";
                    break;
                case "incorrectCredentials":
                    $message = "Identifiants incorrects";
                    break;
                case "notActive":
                    $message = "Votre compte n'est pas activé. Veuillez contacter le professeur pour l'activer!";
                    break;        
            }
?>
            <div class="toast show position-absolute mt-5 top-0 start-50 translate-middle-x align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body"><?= $message ?></div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
<?php
        endif;
    }
}
