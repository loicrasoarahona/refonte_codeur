<?php
$_ROOT = $_SERVER['DOCUMENT_ROOT'];

include($_ROOT . '/requiert/bddConnect.php');
require_once($_ROOT . '/requiert/utils.php');

if (date_default_timezone_set('Europe/Stockholm') == 0) {
	print "<!-- Error uknown timezone using UTC as default -->\n";
	date_default_timezone_set('UTC');
}

if (isset($_GET['parrain'])) {
	$_SESSION['idParrain'] = $_GET['parrain'];
}

if (!function_exists("code")) {
	function code($longueur)
	{
		$chaine_code = '';
		$chaine = "123456789AZERTYUIOPQSDFGHJKLMWXCVBNazertyuiopqsdfghjklmwxcvbn";
		for ($i = 0; $i < $longueur; $i++) {
			$chaine_code .= substr($chaine, (rand() % (strlen($chaine))), 1);
		}
		return $chaine_code;
	}
}

if (!function_exists("displayMontant")) {
	function displayMontant($montant, $chiffres_apres_virgule = 2, $symbole = "?")
	{
		return number_format($montant, $chiffres_apres_virgule, ',', ' ') . "" . $symbole;
	}
}

if (!function_exists("Color")) {
	function Color($e)
	{
		if ($e === 'Validé') {
			echo '<i class="icofont-star text-success">Validée</i>
	            </div>';
		} else if ($e === 'En attente') {
			echo '<i class="icofont-star text-warning"></i>En attente</i>
	            </div>';
		} else if ($e === 'Refusé') {
			echo '<i class="icofont-star text-danger"></i>Refusée
	              </div>';
		} else if ($e === 'En cours') {
			echo '<i class="icofont-star text-time"></i>En cours
	              </div>';
		}
	}
}

if (isset($_GET['parrain']) or isset($_GET['PARRAIN'])) {
	$_SESSION['idParrain'] = $_GET['parrain'];
}

include $_ROOT . "/geoloc/geoipcity.inc";
include $_ROOT . "/geoloc/geoipregionvars.php";
$gi = geoip_open(realpath($_ROOT . "/geoloc/GeoLiteCity.dat"), GEOIP_STANDARD);
$record = geoip_record_by_addr($gi, ip);
$country_name = $record->country_name;
$country_code = $record->country_code;
geoip_close($gi);

$totalUsers = $pdo->query("SELECT COUNT(*) AS 'exist' FROM users");
$totalUsers = $totalUsers->fetch(PDO::FETCH_ASSOC);
$totalUsers = $totalUsers['exist'];

$totalAmountRevers = $pdo->query("SELECT SUM(montant) AS 'amount' FROM gagnants");
$totalAmountRevers = $totalAmountRevers->fetch(PDO::FETCH_ASSOC);
$totalAmountRevers = $totalAmountRevers['amount'];
if (isset($_SESSION['id'])) {

	//enregistrer l'activité et récupérer les membres actifs
	saveUserActivity($_SESSION['id'], $pdo);
	$nbMbreActifs = getMembresActifs($pdo);

	$sql = $pdo->query("SELECT * FROM users WHERE id = '" . addslashes($_SESSION['id']) . "'");
	$resultat = $sql->fetch(PDO::FETCH_ASSOC);
	$mbreId = addslashes(htmlentities($resultat['id']));
	$mbreHashId = addslashes(htmlentities($resultat['hashId']));
	$mbreEmail = addslashes(htmlentities($resultat['email']));
	$mbreImg = addslashes(htmlentities($resultat['img']));
	$mbreMdp = addslashes(htmlentities($resultat['mdp']));
	$mbreNom = addslashes(html_entity_decode($resultat['nom']));
	$mbrePrenom = addslashes(html_entity_decode($resultat['prenom']));
	$mbreAdresse = addslashes(html_entity_decode($resultat['adresse']));
	$mbreVille = addslashes(html_entity_decode($resultat['ville']));
	$mbreCodePostal = addslashes(htmlentities($resultat['codePostal']));
	$mbrePays = addslashes(html_entity_decode($resultat['pays']));
	$country_code = addslashes(html_entity_decode($resultat['pays']));
	$mbreEuros = addslashes(html_entity_decode($resultat['euros']));
	$mbreEurosHisto = addslashes(html_entity_decode($resultat['euros_histo']));
	$mbreIdParrain = addslashes(htmlentities($resultat['idParrain']));
	$mbreLevel = addslashes(htmlentities($resultat['level']));
	$mbreBarrePrcnt = addslashes(htmlentities($resultat['barrePrcnt']));
	$mbreBanni = addslashes(htmlentities($resultat['banni']));
	$mbreBanniChat = addslashes(htmlentities($resultat['banni_chat']));
	$mbreIban = addslashes(htmlentities($resultat['iban']));
	$mbreSwift = addslashes(htmlentities($resultat['swift']));
	$mbrePaypal = addslashes(htmlentities($resultat['paypal']));
	$mbreSkrill = addslashes(htmlentities($resultat['skrill']));
	$mbreCodeVerif = addslashes(htmlentities($resultat['code_verif']));
	$mbrePremium = addslashes(htmlentities($resultat['premium']));
	$mbreDateLastCo = addslashes(htmlentities($resultat['datelastco']));
	$mbreTicketTombola = addslashes(htmlentities($resultat['ticketTombola']));
	$mbreIdentRecto = addslashes(htmlentities($resultat['ident_recto']));
	$mbreIdentVerso = addslashes(htmlentities($resultat['ident_verso']));
	$mbreIdentVerif = addslashes(htmlentities($resultat['ident_verif']));
	$mbreNewsletter = addslashes(htmlentities($resultat['news']));
	$date_Inscription = addslashes(htmlentities($resultat['date_Inscription']));

	if ($mbreIdParrain == 0) {
		$mbreParrain = 'Aucun';
	} else {
		$sqlParrain = $pdo->query("SELECT * FROM users WHERE id = '" . $mbreIdParrain . "'");
		$resultatParrain = $sqlParrain->fetch(PDO::FETCH_ASSOC);
		$parrainNom = addslashes(htmlentities($resultatParrain['nom']));
		$parrainPrenom = addslashes(htmlentities($resultatParrain['prenom']));
		$mbreParrain = $parrainPrenom . ' ' . substr($parrainNom, 0, 1) . '.';
	}

	if ($mbreBarrePrcnt >= '100.00') {
		$pdo->exec("UPDATE users SET euros = euros + 2, barrePrcnt = barrePrcnt - 100, barrePrcntNb = barrePrcntNb + 1 WHERE id = '" . $mbreId . "'");
	}

	$totalAmoundAttente = $pdo->query("SELECT SUM(remuneration) AS 'montant' FROM histo_offers WHERE idUser = '" . $mbreHashId . "' AND etat = 'En attente'");
	$totalAmoundAttente = $totalAmoundAttente->fetch(PDO::FETCH_ASSOC);
	$totalAmoundAttente = $totalAmoundAttente['montant'];
}

if (isset($_GET['seenpmessage'])) {
	unset($_SESSION['pmessage']);
	$pdo->Query("UPDATE `users` SET `pmessage`= '' , view_message_notif = 0 WHERE `id` = " . $mbreId . "");
}

if (isset($_SESSION['pmessage']) && explode("/", $_SERVER['REQUEST_URI'])[(sizeof(explode("/", $_SERVER['REQUEST_URI'])) - 1)] != "avertissement.php") {
	header('Location: avertissement.php');
	exit;
}

if (isset($_COOKIE['id_user']) && $_COOKIE['id_user'] != 0 && !isset($_SESSION['id'])) {
}


$concoursOffresOn = 0;
$concoursParrainagesOn = 0;

$sql_InfosConcours = $pdo->query("SELECT * FROM concours WHERE actif = 1");
$all_InfosConcours = $sql_InfosConcours->fetchAll(PDO::FETCH_ASSOC);

foreach ($all_InfosConcours as $dones_InfosConcours) {
	$idConcours = $dones_InfosConcours['id'];

	if ($idConcours == 3) {
		$concoursParrainagesOn = 1;
	}
	if ($idConcours == 4) {
		$concoursOffresOn = 1;
	}
}
