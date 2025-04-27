<?php
    if ($_SESSION["role"] === "professeur") {
        $appHomeUrl = "dashboard.php";
    } elseif ($_SESSION["role"] === "thesard") {
        $appHomeUrl = "publicaions.php";
    }
?>

<header class="navbar bg-body-tertiary shadow">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= $appHomeUrl ?>">
            <img src="assets/images/logo.png" alt="Bootstrap" height="26">
        </a>
        <div class="welcome-message">
            Bonjour <span class="fw-bold"><?= $_SESSION["firstName"] . " " . $_SESSION["lastName"] ?></span>!
        </div>
    </div>
</header>