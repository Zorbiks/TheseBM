<?php

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"])) {
    $action = $_POST["action"];

    // Include required class files for database connection, model, and controller
    include_once __DIR__ . "/../classes/models/dbh.class.php";
    include_once __DIR__ . "/../classes/models/thesards_mgr_model.class.php";
    include_once __DIR__ . "/../classes/controllers/thesards_mgr_contr.class.php";

    include_once __DIR__ . "/../classes/services/MailService.php";

    // Create a new thesard account 
    if ($action === "add") {
        $manager = new ThesardsMgrContr($_POST["firstname"], $_POST["lastname"], $_POST["email"], $_POST["password"]);
        $manager->add();

        // Redirect back to the thesard management page with success message
        header("location: gestion-des-thesards.php?action=add&error=none");
        exit();
    }
    // Modify a new thesard account 
    elseif ($action === "modify") {
        $manager = new ThesardsMgrContr($_POST["thesardid"], $_POST["firstname"], $_POST["lastname"], $_POST["email"], $_POST["password"]);
        $manager->modify();

        // Redirect back to the thesard management page with success message
        header("location: gestion-des-thesards.php?action=modify&error=none");
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["action"]) && !isset($_GET["error"])) {
    $action = $_GET["action"];

    // Include required class files for database connection, model, and controller
    include_once __DIR__ . "/../classes/models/dbh.class.php";
    include_once __DIR__ . "/../classes/models/thesards_mgr_model.class.php";
    include_once __DIR__ . "/../classes/controllers/thesards_mgr_contr.class.php";

    // Delete a thesard account
    if ($action === "delete") {
        $manager = new ThesardsMgrContr($_GET["id"]);
        $manager->delete();

        // Redirect back to the thesard management page with success message
        header("location: gestion-des-thesards.php?action=delete&error=none");
        exit();
    }
}