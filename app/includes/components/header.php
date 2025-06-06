<?php
    // Define the home URL based on the user's role
    if ($_SESSION["role"] === "professeur") {
        $appHomeUrl = "dashboard.php";
    } elseif ($_SESSION["role"] === "thesard") {
        $appHomeUrl = "publications.php";
    }
?>

<header class="navbar bg-body-tertiary shadow">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= $appHomeUrl ?>">
            <img src="assets/images/logo.png" alt="Bootstrap" height="26">
        </a>
        <div class="welcome-message">
            Bonjour
            <span class="fw-bold">
                <?= htmlspecialchars($_SESSION["firstName"]) . " " . htmlspecialchars($_SESSION["lastName"]) ?>
            </span>!
        </div>
    </div>
</header>