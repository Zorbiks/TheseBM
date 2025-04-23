<div class="flex-shrink-0">
    <nav
        class="position-fixed d-flex flex-column justify-content-between vh-100 z-1 position-relative text-light shadow px-3 pt-5">
        <ul class="list-unstyled pt-5">
            <?php
            if ($_SESSION["role"] === "professeur"):
            ?>
                <li class="navlink mb-2">
                    <a class="d-block py-2 text-decoration-none fw-bold" href="dashboard.php">
                        <i class="fa-solid fa-gauge-high fa-fw"></i>
                        <span class="d-none d-md-inline">Dashboard</span>
                    </a>
                </li>
                <li class="navlink mb-2">
                    <a class="d-block py-2 text-decoration-none fw-bold" href="thesards.php">
                        <i class="fa-solid fa-users fa-fw"></i>
                        <span class="d-none d-md-inline">Thésards</span>
                    </a>
                </li>
                <li class="navlink mb-2">
                    <a class="d-block py-2 text-decoration-none fw-bold" href="publications.php">
                        <i class="fa-solid fa-book fa-fw"></i>
                        <span class="d-none d-md-inline">Publications</span>
                    </a>
                </li>
                <li class="navlink mb-2">
                    <a class="d-block py-2 text-decoration-none fw-bold" href="demandes-inscription.php">
                        <i class="fa-solid fa-envelope fa-fw"></i>
                        <span class="d-none d-md-inline">Demandes d'Inscription</span>
                    </a>
                </li>
                <li class="navlink mb-2">
                    <a class="d-block py-2 text-decoration-none fw-bold" href="gestion-des-thesards.php">
                        <i class="fa-solid fa-database fa-fw"></i>
                        <span class="d-none d-md-inline">Gestion des Thésards</span>
                    </a>
                </li>
            <?php
            elseif ($_SESSION["role"] === "thesard"):
            ?>
                <li class="navlink mb-2">
                    <a class="d-block py-2 text-decoration-none fw-bold" href="publications.php">
                        <i class="fa-solid fa-book fa-fw"></i>
                        <span class="d-none d-md-inline">Publications</span>
                    </a>
                </li>
            <?php
            endif;
            ?>
        </ul>
        <a class="px-3 py-2 text-decoration-none fw-bold" href="includes/logout.inc.php">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            <span class="d-none d-md-inline">Déconnexion</span>
        </a>
    </nav>
</div>