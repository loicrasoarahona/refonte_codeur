<?php
session_start();

if (!empty($_GET["page"]) && $_GET["page"] == "reset-user")
{
    if (!empty($_GET["token"]))
    {
        echo "<pre>"; print_r($_POST); echo "</pre>";
    }
    else
    {
        redirect($base_url);
    }
    exit;
}

if (isset($_SESSION['id'])) {
    echo "https://" . $_SERVER["HTTP_HOST"] . "/dashboard";
    exit;
}

include('../requiert/header-content-only.php');
//include('../requiert/new-form/header.php');
include('../requiert/php-form/login-register.php');