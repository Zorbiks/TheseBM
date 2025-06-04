<?php

// Check if no error parameter is set or the error is not "none"
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["action"]) && (!isset($_GET["error"]) || $_GET["error"] !== "none")) {
    $action = $_GET["action"];

    // Include required class files for database connection, model, and controller
    include_once __DIR__ . "/../classes/models/dbh.class.php";
    include_once __DIR__ . "/../classes/models/thesards_mgr_model.class.php";
    include_once __DIR__ . "/../classes/controllers/thesards_mgr_contr.class.php";
    
    // If the action is to delete a thesard account
    if ($action === "delete") {
        $manager = new ThesardsMgrContr($_GET["id"]);
        $manager->delete();

        // Redirect back to the thesard management page with success message
        header("location: gestion-des-thesards.php?action=delete&error=none");
        exit();
    }
    // If the action is to add a new thesard account 
    elseif ($action === "add") {
        $manager = new ThesardsMgrContr($_GET["firstname"], $_GET["lastname"], $_GET["email"], $_GET["password"]);
        $manager->add();

        // Redirect back to the thesard management page with success message
        header("location: gestion-des-thesards.php?action=add&error=none");
        exit();
    }
}