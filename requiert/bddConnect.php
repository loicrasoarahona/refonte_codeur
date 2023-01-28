<?php

$serveur = 'localhost';
$login = 'gifthunter';
$passe = '0uq_1iQ44';
$base_de_donnee = 'admin11_';

try {
	$pdo = new PDO('mysql:dbname=' . $base_de_donnee . ';host=' . $serveur, $login, $passe);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo 'Connexion échouée : ' . $e->getMessage();
}

define("nom_site", "Gifthunter.fr");
define("url_site", "https://gifthunter.fr/");
define("url_panel", "https://gifthunter.fr/administration");


define("ip", $_SERVER["REMOTE_ADDR"]);