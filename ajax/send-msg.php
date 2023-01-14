<?php
error_reporting(E_ERROR);
ini_set("display_errors", 1);
session_start();

include($_SERVER["DOCUMENT_ROOT"] . '/include/config.php');
include_once($_SERVER["DOCUMENT_ROOT"] . '/requiert/php-global.php');

$userConnect = $_SESSION['id'];

$mbre_pseudo = $mbrePrenom . " " . $mbreNom; 

$_GET["idmessage"] = $_POST["idmessage"];
unset($_POST["idmessage"]);

include($_SERVER["DOCUMENT_ROOT"] . "/requiert/messagerie/serviceMessagerie.php");
$serviceMessage = new \ServiceMessagerie\Messagerie($pdo);

if (!empty($_POST["contact_valider"]) || !empty($_POST["show-msg"]))
{
    include $_SERVER["DOCUMENT_ROOT"] . "/requiert/messagerie/discussion.php";
}
elseif (!empty($_POST["submit_message"]) || !empty($_POST["new-msg"]))
{
    include $_SERVER["DOCUMENT_ROOT"] . "/requiert/messagerie/send.php";
}