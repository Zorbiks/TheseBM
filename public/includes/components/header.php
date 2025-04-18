<header class="navbar bg-body-tertiary shadow">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="assets/images/logo.png" alt="Bootstrap" height="26">
        </a>
        <div class="welcome-message">
            Bonjour <span class="fw-bold"><?= $_SESSION["firstName"] . " " . $_SESSION["lastName"] ?></span>!
        </div>
    </div>
</header>