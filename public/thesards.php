<?php include_once("includes/checklogin.inc.php") ?>
<?php include_once("includes/components/head.html") ?>

<title>ThèseBM - Thésards</title>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar Navigation -->
        <?php include_once("includes/components/navbar.php") ?>

        <div class="flex-grow-1 main-content-wrapper">
            <!-- Header -->
            <?php
                include_once("includes/components/header.php");
            ?>

            <!-- Start Main Content -->
            <main>
                <div class="container">
                    <div>
                        <h3>Thésards</h3>
                        <p>Liste de tous les thésards sur la plateforme</p>
                        <div class="table-responsive">
                            <table class="table table-striped text-nowrap">
                                <thead>
                                    <tr>
                                        <th class="bg-primary text-light">Prénom</th>
                                        <th class="bg-primary text-light">Nom</th>
                                        <th class="bg-primary text-light">E-mail</th>
                                        <th class="bg-primary text-light">Nombre des publication</th>
                                        <th class="bg-primary text-light">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="align-middle">
                                    <tr>
                                        <td>Oussama</td>
                                        <td>Elmehdi</td>
                                        <td>email.01@gmail.com</td>
                                        <td>5</td>
                                        <td>
                                            <a class="btn btn-primary" href="#"><i class="fa-solid fa-eye fa-fw"></i> Voir les publication</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ahmed</td>
                                        <td>Atif</td>
                                        <td>email.02@gmail.com</td>
                                        <td>2</td>
                                        <td>
                                            <a class="btn btn-primary" href="#"><i class="fa-solid fa-eye fa-fw"></i> Voir les publication</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ali</td>
                                        <td>Rabii</td>
                                        <td>email.03@gmail.com</td>
                                        <td>8</td>
                                        <td>
                                            <a class="btn btn-primary" href="#"><i class="fa-solid fa-eye fa-fw"></i> Voir les publication</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ahmed</td>
                                        <td>Mohammed</td>
                                        <td>email.04@gmail.com</td>
                                        <td>8</td>
                                        <td>
                                            <a class="btn btn-primary" href="#"><i class="fa-solid fa-eye fa-fw"></i> Voir les publication</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <!-- End Main Content -->
        </div>
    </div>
</body>
</html>