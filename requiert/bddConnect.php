<?php
$serveur = 'localhost';
$login = 'loic';
$passe = 'anjomakely';
$base_de_donnee = 'timtim';
// $serveur = 'localhost';
// $login = 'gifthunter';
// $passe = '0uq_1iQ44';
// $base_de_donnee = 'admin11_';

try {
	$pdo = new PDO('mysql:dbname=' . $base_de_donnee . ';host=' . $serveur, $login, $passe);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo 'Connexion échouée : ' . $e->getMessage();
}

define("nom_site", "127.0.0.1");
define("url_site", "http://127.0.0.1/");
define("url_panel", "http://127.0.0.1/administration");
// define("nom_site", "Gifthunter.fr");
// define("url_site", "https://gifthunter.fr/");
// define("url_panel", "https://gifthunter.fr/administration");


define("ip", $_SERVER["REMOTE_ADDR"]);