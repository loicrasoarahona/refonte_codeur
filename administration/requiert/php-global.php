<?php
ini_set('display_errors', '0');

if (date_default_timezone_set('Europe/Stockholm') == 0) {
	print "<!-- Error uknown timezone using UTC as default -->\n";
	date_default_timezone_set('UTC');
}

include $_SERVER["DOCUMENT_ROOT"] . "/requiert/bddConnect.php";
  
function code($longueur) {
	$chaine_code = '';
	$chaine = "123456789AZERTYUIOPQSDFGHJKLMWXCVBNazertyuiopqsdfghjklmwxcvbn";
	for ($i = 0; $i < $longueur; $i++) {
		$chaine_code .= substr($chaine, (rand() % (strlen($chaine))), 1);
	}
	return $chaine_code;
}

function number($longueur) {
	$chaine_codeNumber = '';
	$chaine_Number = "0123456789";
	for ($i = 0; $i < $longueur; $i++) {
		$chaine_codeNumber .= substr($chaine_Number, (rand() % (strlen($chaine_Number))), 1);
	}
	return $chaine_codeNumber;
}

function displayMontant($montant, $chiffres_apres_virgule = 2, $symbole = "?") {
	return number_format($montant, $chiffres_apres_virgule, ',', ' ') . "" . $symbole;
}

function addLogEvent($event) {
	$event = $event . "\n";

	file_put_contents("session.log", $event, FILE_APPEND);
}

if (!function_exists("dateToFrench")) {
	function dateToFrench($date, $format){
	    $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
	    $french_days = array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');
	    $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
	    $french_months = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
	    return ucfirst(str_replace($english_months, $french_months, str_replace($english_days, $french_days, date($format, ($date) ) ) ));
	}
}

if (isset($_SESSION['adminid'])) {
	addLogEvent($_SESSION['adminid']);
	$sql = $pdo->query("SELECT * FROM users WHERE id = '" . $_SESSION['adminid'] . "'");
	$resultat = $sql->fetch(PDO::FETCH_ASSOC);
	$mbreId = addslashes(htmlentities($resultat['id']));
	$mbreEmail = addslashes(htmlentities($resultat['email']));
	$mbreMdp = addslashes(htmlentities($resultat['mdp']));
	$mbreNom = addslashes(html_entity_decode($resultat['nom']));
	$mbrePrenom = addslashes(html_entity_decode($resultat['prenom']));
	$mbreAdresse = addslashes(html_entity_decode($resultat['adresse']));
	$mbreVille = addslashes(html_entity_decode($resultat['ville']));
	$mbreCodePostal = addslashes(htmlentities($resultat['codePostal']));
	$mbrePays = addslashes(html_entity_decode($resultat['pays']));
	$mbreLevel = htmlentities($resultat['level']);
} 

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
	session_destroy();
	unset($_SESSION['id']);
	unset($_SESSION['email']);
	unset($_SESSION['passe']);
?>
	<script>
		window.location='/admin.php';
	</script>
<?php
	exit;
}
?>