<?php

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"])) {
    $action = $_POST["action"];

    // Include required class files
    include_once __DIR__ . "/../classes/models/dbh.class.php";
    include_once __DIR__ . "/../classes/models/publications_model.class.php";
    include_once __DIR__ . "/../classes/controllers/publications_contr.class.php";
    include_once __DIR__ . "/../classes/models/dashboard_model.class.php";
    include_once __DIR__ . "/../classes/controllers/journal_contr.class.php";
    
    // Collect form inputs
    $titre       = $_POST["titre"];
    $auteurs     = $_POST["auteurs"];
    $lieu        = $_POST["lieu"];
    $doi         = $_POST["doi"];
    $date        = $_POST["date"];
    $type        = $_POST["type"];
    $numero      = $_POST["numero"];
    $volume      = $_POST["volume"];
    $publication = $_FILES["publication"];
    $attestation = $_FILES["attestation"];
    $rapport     = $_FILES["rapport"];
    $thesard_id  = $_SESSION["id"];


    // Default optional fields to "-"
    if (empty($numero)) {
        $numero = "-";
    }
    if (empty($volume)) {
        $volume = "-";
    }

    // Add new publication
    if ($action === "add") {
        $pubMgr = new PublicationContr(
            $titre,
            $auteurs,
            $_SESSION["firstName"] . " " . $_SESSION["lastName"],
            $lieu,
            $doi,
            $date,
            $type,
            $numero,
            $volume,
            $publication,
            $attestation,
            $rapport,
            $_SESSION["id"]
        );

        $pubMgr->add();

        // Log the action in the journal
        $journal = new JournalContr($_SESSION["firstName"] . " " . $_SESSION["lastName"], "a ajouté", $titre);
        $journal->addJournal();
        
        // Redirect to confirmation
        header("location: publications.php?action=add&error=none");
        exit();
    }
    // Edit existing publication
    elseif ($action === "edit") {
        $pubMgr = new PublicationContr(
            $_POST["pubid"], // ID of the publication to edit
            $titre,
            $auteurs,
            $lieu,
            $doi,
            $date,
            $type,
            $numero,
            $volume,
            $publication,
            $attestation,
            $rapport,
        );

        // Update the publication
        $pubMgr->modify();

        // Log the action
        $journal = new JournalContr($_SESSION["firstName"] . " " . $_SESSION["lastName"], "a modifié", $titre);
        $journal->addJournal();
        
        // Redirect to confirmation
        header("location: publications.php?action=edit&error=none");
        exit();
    }
}
 // Handle GET requests: delete or search publications
elseif ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["action"])) {
    // Include class dependencies
    include_once __DIR__ . "/../classes/models/dbh.class.php";
    include_once __DIR__ . "/../classes/models/publications_model.class.php";
    include_once __DIR__ . "/../classes/controllers/publications_contr.class.php";
    include_once __DIR__ . "/../classes/models/dashboard_model.class.php";
    include_once __DIR__ . "/../classes/controllers/journal_contr.class.php";

    $action = $_GET["action"];

    // Delete a publication
    if ($action === "delete" && empty($_GET["error"])) {
        $pubMgr = new PublicationContr($_GET["id"]);

        // Delete the publication
        $pubMgr->delete();
        // Log the deletion
        $journal = new JournalContr(
            $_SESSION["firstName"] . " " . $_SESSION["lastName"],
            "a supprimé",
            $pubMgr->getPublicationTitle($_GET["id"])
        );
        $journal->addJournal();

        // Redirect to confirmation
        header("location: publications.php?action=delete&error=none");
        exit();
    }
    // Search publications
    elseif ($action === "search") {
        // Role-based search logic
        if ($_SESSION["role"] === "professeur") {
            $pubMgr = new PublicationContr($_GET["search"], $_GET["filter"]);
            $pubMgr->search();
        } elseif ($_SESSION["role"] === "thesard") {
            $pubMgr = new PublicationContr($_GET["search"], $_GET["filter"], $_SESSION["id"]);
            $pubMgr->search();
        }
        exit();
    }
}