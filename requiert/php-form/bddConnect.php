<?php


$serveur = 'db5000911488.hosting-data.io';
$login = 'dbu1016942';
$passe = 'Timo12300@';
$base_de_donnee = 'dbs797187';

//  $serveur = 'localhost';

//  $login = 'root';

//  $passe = '';

//  $base_de_donnee = 'facilideal';

	try {
	//	$pdo = new PDO('mysql:dbname='.$base_de_donnee.';host='.$serveur, $login, );
		$pdo =new PDO('mysql:host='.$serveur.'; dbname='.$base_de_donnee.'; charset=utf8',   $login,  $passe);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		echo 'Connexion échouée : ' . $e->getMessage();
	}

	// define("nom_site", "cashbackreduction.fr", true);
    // define("url_site", "http://cashbackreduction.com", true);
	// define("url_panel", "http://cashbackreduction.com/administration", true);
	
	 define("nom_site", "cashbackreduction.fr", true);
	 define("url_site",  'http://localhost/cashbackreduction/', true);
	 define("url_panel","http://localhost/cashbackreduction/administration", true);
	 define("ip", $_SERVER["REMOTE_ADDR"], true);

?>