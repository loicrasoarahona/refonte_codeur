<?php
$serveur = 'localhost';
$login = 'u832841964_hunter';
$passe = 'Timo12300@';
$base_de_donnee = 'u832841964_hunter';
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

// define("nom_site", "127.0.0.1");
// define("url_site", "http://127.0.0.1/");
// define("url_panel", "http://127.0.0.1/administration");
define("nom_site", "Maxi-Coupons.fr");
define("url_site", "https://maxi-coupons.com/");
define("url_panel", "https://maxi-coupons.com/administration");


define("ip", $_SERVER["REMOTE_ADDR"]);