<?php
session_start();

if (isset($_SESSION['id'])) {
    echo "https://" . $_SERVER["HTTP_HOST"] . "/dashboard";
    exit;
}

include('../requiert/header-content-only.php');
//include('../requiert/new-form/header.php');
include('../requiert/php-form/login-register.php');
