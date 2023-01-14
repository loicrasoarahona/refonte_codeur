<?php
	$serveur = 'localhost';
	$login = 'timtim';
	$passe = 'Timo12300@';
	$base_de_donnee = 'timtim';

	try {
		$pdo = new PDO('mysql:dbname='.$base_de_donnee.';host='.$serveur, $login, $passe);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		echo 'Connexion échouée : ' . $e->getMessage();
	}
	
	define("nom_site", "revenucash.com");
    define("url_site", "https://utilooservices.com");
    define("url_panel", "https://utilooservices.com/administration");

	define("ip", $_SERVER["REMOTE_ADDR"]);
?>