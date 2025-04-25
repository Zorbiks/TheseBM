<?php

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["action"])) {
    $action = $_GET["action"];

    include_once("../classes/models/dbh.class.php");
    include_once("../classes/models/thesards_mgr_model.class.php");
    include_once("../classes/controllers/thesards_mgr_contr.class.php");

    
    echo $action;
    
    if ($action === "delete") {
        $manager = new ThesardsMgrContr($_GET["id"]);
        $manager->delete();
        header("location: ../gestion-des-thesards.php?action=delete&error=none");
        exit();
    } elseif ($action === "add") {
        $manager = new ThesardsMgrContr($_GET["firstname"], $_GET["lastname"], $_GET["email"], $_GET["password"]);
        $manager->add();
        header("location: ../gestion-des-thesards.php?action=add&error=none");
        exit();
    }
}

// else {
//     header("location: ../dashboard.php");
//     exit();
// }