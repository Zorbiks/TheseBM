<?php

session_start();

// Redirect the user to index page if the user isn't logged in
if (!isset($_SESSION["id"], $_SESSION["firstName"], $_SESSION["lastName"], $_SESSION["role"])) {
    header("location: index.html");
    exit();
}
