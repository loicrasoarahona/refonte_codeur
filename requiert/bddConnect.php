<?php

$serveur = 'localhost';
$login = 'u832841964_hunter';
$passe = 'Timo12300@';
$base_de_donnee = 'u832841964_hunter';

try {
	$pdo = new PDO('mysql:dbname=' . $base_de_donnee . ';host=' . $serveur, $login, $passe);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo 'Connexion échouée : ' . $e->getMessage();
}

define("nom_site", "Maxi-Coupons.fr");
define("url_site", "https://maxi-coupons.fr/");
define("url_panel", "https://maxi-coupons.fr/administration");


define("ip", $_SERVER["REMOTE_ADDR"]);