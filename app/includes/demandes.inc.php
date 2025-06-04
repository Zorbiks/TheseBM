<?php

// Check if the request method is GET and required parameters 'id' and 'action' are present
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"]) && isset($_GET["action"])) {
    $id = $_GET["id"];
    $action = $_GET["action"];

    // Include necessary classes for database connection, business logic, and email service
    include_once __DIR__ . "/../classes/services/MailService.php";
    include_once __DIR__ . "/../classes/models/dbh.class.php";
    include_once __DIR__ . "/../classes/models/demandes_model.class.php";
    include_once __DIR__ . "/../classes/controllers/demandes_contr.class.php";

    $demande = new DemandesContr($id);

    // Perform action based on the 'action' parameter
    if ($action === "accept") {
        // Accept registration request
        $demande->accept();
        
        // Redirect to the demandes page with success message
        header("location: demandes-inscription.php?action=accept&error=none");
        exit();
    } elseif($action === "reject") {
        // Reject registration request
        $demande->reject();
        
        // Redirect to the demandes page with success message
        header("location: demandes-inscription.php?action=reject&error=none");
        exit();
    }
}