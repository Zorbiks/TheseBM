<?php
include_once __DIR__ . "/../app/includes/checklogin.inc.php";
include_once __DIR__ . "/../app/includes/components/head.html";

include_once __DIR__ . "/../app/classes/models/dbh.class.php";
include_once __DIR__ . "/../app/classes/models/thesards_mgr_model.class.php";
include_once __DIR__ . "/../app/classes/views/thesards_mgr_view.class.php";

// Include managing thesards login
include_once __DIR__ . "/../app/includes/thesards-mgr.inc.php";
?>

<title>ThèseBM - Gestion des Thésards</title>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar Navigation -->
        <?php include_once  __DIR__ . "/../app/includes/components/navbar.php" ?>

        <div class="flex-grow-1 main-content-wrapper">
            <!-- Header -->
            <?php
                include_once __DIR__ . "/../app/includes/components/header.php";
            ?>

            <!-- Start Main Content -->
            <main>
                <div class="container">
                    <div>
                        <h3>Gestion des Thésards</h3>
                        <p>Les thésards dans la Platforme</p>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary mb-2" id="addThesardButton" data-bs-toggle="modal" data-bs-target="#addThesardModal">
                            <i class="fa-solid fa-user-plus fa-fw"></i>
                            Ajouter thésard
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="addThesardModal" tabindex="-1" aria-labelledby="addThesardModal" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="addThesardModalLabel">Ajouter Thésard</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="">
                                        <div class="modal-body">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Prénom">
                                                <label for="firstname" class="form-label" id="firstnameLabel">Prénom</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Nom">
                                                <label for="lastname" class="form-label" id="lastnameLabel">Nom</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail">
                                                <label for="email" class="form-label" id="emailLabel">E-mail</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
                                                <label for="password" class="form-label" id="passwordLabel">Mot de passe</label>
                                            </div>
                                        </div>

                                        <!-- Used to send the id of the thesard to modify -->
                                        <input type="text" id="thesardid" name="thesardid" hidden disabled>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                <i class="fa-solid fa-xmark"></i>
                                                Fermer
                                            </button>
                                            <button class="btn btn-primary" id="submit" type="submit" name="action" value="add">
                                                <i class="fa-solid fa-floppy-disk"></i>
                                                Ajouter
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <?php
                            $view = new ThesardsMgrView();
                            $view->renderErrorPopup();
                            $view->renderThesardsTable();
                        ?>
                        
                        <?php include_once __DIR__ . "/../app/includes/components/confirm-delete.html" ?>

                        <script>
                            // Action Buttons
                            // Add Button
                            const addThesardBtn = document.getElementById("addThesardButton");

                            // Modify Buttons
                            const modifyThesardButtons = document.querySelectorAll('.modify-btn');

                            // Modal Elements
                            // Title
                            const modalTitle = document.getElementById("addThesardModalLabel");
                            
                            // Labels
                            const firstnameLabel = document.getElementById("firstnameLabel");
                            const lastnameLabel = document.getElementById("lastnameLabel");
                            const emailLabel = document.getElementById("emailLabel");
                            const passwordLabel = document.getElementById("passwordLabel");

                            // Input Fields
                            const firstnameInput = document.getElementById("firstname");
                            const lastnameInput = document.getElementById("lastname");
                            const emailInput = document.getElementById("email");
                            const passwordInput = document.getElementById("password");
                            
                            // Hidden Input Used When Modifing The Thesard Info
                            const thesardidInput = document.getElementById("thesardid");

                            // Submit Button
                            const submitBtn = document.getElementById("submit");

                            // Logic When Adding A New Thesard
                            addThesardBtn.addEventListener("click", function() {
                                clearAllInputs();
                                modalTitle.textContent = "Ajouter Thésard";

                                firstnameLabel.textContent = "Prénom *";
                                lastnameLabel.textContent = "Nom *";
                                emailLabel.textContent = "Email *";
                                passwordLabel.textContent = "Mot de passe *";
                                
                                thesardidInput.setAttribute("disabled", true);
                                
                                submitBtn.setAttribute("value", "add");
                                submitBtn.innerHTML = "<i class='fa-solid fa-floppy-disk'></i> Ajouter";
                            });

                            modifyThesardButtons.forEach(function(btn) {
                                btn.addEventListener("click", function() {
                                    modalTitle.textContent = "Modifier Thésard";
                                
                                    thesardidInput.removeAttribute("disabled");
                                    thesardidInput.value = btn.dataset.tbmId;
                                    
                                    submitBtn.setAttribute("value", "modify");
                                    submitBtn.innerHTML = "<i class='fa-solid fa-floppy-disk'></i> Modifier";

                                    passwordLabel.textContent = "Mot de passe";

                                    // Get the row containg all the info about the thesard
                                    // And fill the form with the data
                                    const row = btn.closest("tr");

                                    firstnameInput.value = row.querySelector('td.prenom').textContent;
                                    lastnameInput.value = row.querySelector('td.nom').textContent;
                                    emailInput.value = row.querySelector('td.email').textContent;

                                })
                            });



                           





                            // Clear All Input Fields
                            function clearAllInputs() {
                                firstnameInput.value = "";
                                lastnameInput.value = "";
                                emailInput.value = "";
                                passwordInput.value = "";
                            }
                        </script>
                    </div>
                </div>
            </main>
            <!-- End Main Content -->
        </div>
    </div>
</body>
</html>