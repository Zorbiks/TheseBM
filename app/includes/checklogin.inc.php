<?php

session_start();

if (!isset($_SESSION["id"], $_SESSION["firstName"], $_SESSION["lastName"], $_SESSION["role"])) {
    header("location: index.html");
    exit();
}
