<?php
    session_start();
    
    if (isset($_SESSION["id"], $_SESSION["firstName"], $_SESSION["lastName"], $_SESSION["role"])) {
        if ($_SESSION["role"] === "professeur") {
            header("location: dashboard.php");
        } elseif ($_SESSION["role"] === "thesard") {
            header("location: publications.php");
        }
        exit();
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/libs/fontawesome-6.7.2/css/all.min.css">
    <!-- Fonts -->
    <link rel="stylesheet" href="assets/fonts/Ubuntu/stylesheet.css">
    <!-- Loading Bootstrap -->
    <link rel="stylesheet" href="assets/libs/bootstrap-custom/css/bootstrap.css">
    <script src="assets/libs/bootstrap-custom/node_modules/bootstrap/dist/js/bootstrap.min.js" defer></script>
    <title>ThèseBM - S'inscrire</title>
</head>
<body>
    <header class="navbar bg-body-tertiary shadow">
        <div class="container">
            <a class="navbar-brand" href="index.html">
                <img src="assets/images/logo.png" alt="Bootstrap" height="26">
            </a>
        </div>
    </header>
    <main>
        <!-- Start Popup Render -->
        <?php
            include_once "../app/classes/views/signup_view.class.php";
            $view = new SignupView();
            $view->renderErrorPopup();
        ?>
        <!-- End Popup Render -->
        <div class="container d-flex justify-content-center align-items-center" style="min-height: calc(100vh - 56px);">
            <form class="p-4 border rounded shadow" style="width: 350px;" method="POST" action="/TheseBM/app/includes/signup.inc.php">
                <h4 class="text-center mb-3">S'inscrire</h4>
                <div class="form-floating mb-3">
                    <input class="form-control" id="firstname" type="text" name="firstname" placeholder="Prénom" required>
                    <label class="form-label" for="firstname">Prénom</label>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" id="lastname" type="text" name="lastname" placeholder="Nom" required>
                    <label class="form-label" for="lastname">Nom</label>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" id="email" type="email" name="email" placeholder="E-mail" required>
                    <label class="form-label" for="email">E-mail</label>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" id="password" type="password" name="password" placeholder="Mot de passe" minlength="8" maxlength="24" required>
                    <label class="form-label" for="password">Mot de passe</label>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" id="passwordrepeat" type="password" name="passwordrepeat" placeholder="Repeter mot de passe" minlength="8" maxlength="24" required>
                    <label class="form-label" for="passwordrepeat">Repeter mot de passe</label>
                </div>
                <a class="small" href="connexion.php">Vous avez déjà un compte?</a>
                <button class="w-100 mt-1 btn btn-primary" type="submit" name="submit" value="signup">
                    <i class="fa-solid fa-arrow-right-to-bracket fa-fw"></i>
                    S'inscrire
                </button>
            </form>
        </div>
    </main>
</body>
</html>