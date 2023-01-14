<?php
    header('Content-Type: text/html; charset=utf-8');

    // CONDITIONS NOM
    if ( (isset($_POST["prenom"])) && (strlen(trim($_POST["prenom"])) > 0) ) {
        $prenom = stripslashes(strip_tags($_POST["prenom"]));
    } else {
        echo "Merci d'écrire un nom <br />";
        $prenom = "";
    }

    // CONDITIONS SUJET
    if ( (isset($_POST["object"])) && (strlen(trim($_POST["object"])) > 0) ) {
        $object = stripslashes(strip_tags($_POST["object"]));
    } else {
        echo "Merci d'écrire un sujet <br />";
        $object = "";
    }

    // CONDITIONS EMAIL
    if ( (isset($_POST["email"])) && (strlen(trim($_POST["email"])) > 0) && (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) ) {
        $email = stripslashes(strip_tags($_POST["email"]));
    } elseif (empty($_POST["email"])) {
        echo "Merci d'écrire une adresse email <br />";
        $email = "";
    } else {
        echo "Email invalide :(<br />";
        $email = "";
    }

    // CONDITIONS MESSAGE
    if ( (isset($_POST["message"])) && (strlen(trim($_POST["message"])) > 0) ) {
        $message = stripslashes(strip_tags($_POST["message"]));
    } else {
        echo "Merci d'écrire un message<br />";
        $message = "";
    }

    // Les messages d'erreurs ci-dessus s'afficheront si Javascript est désactivé

    // PREPARATION DES DONNEES
    $ip           = $_SERVER["REMOTE_ADDR"];
    $hostname     = gethostbyaddr($_SERVER["REMOTE_ADDR"]);
    $destinataire = "olivier@digitaltrad.com";
    $objet        = "[Site Web] " . $object;
    $contenu      = "Nom de l'expéditeur : " . $prenom . "\r\n";
    $contenu     .= $message . "\r\n\n";
    $contenu     .= "Adresse IP de l'expéditeur : " . $ip . "\r\n";
    $contenu     .= "DLSAM : " . $hostname;

    $headers  = "CC: " . $email . " \r\n"; // ici l'expediteur du mail
    $headers .= "Content-Type: text/plain; charset=\"ISO-8859-1\"; DelSp=\"Yes\"; format=flowed /r/n";
    $headers .= "Content-Disposition: inline \r\n";
    $headers .= "Content-Transfer-Encoding: 7bit \r\n";
    $headers .= "MIME-Version: 1.0";


    // SI LES CHAMPS SONT MAL REMPLIS
    if ( (empty($prenom)) && (empty($object)) && (empty($email)) && (!filter_var($email, FILTER_VALIDATE_EMAIL)) && (empty($message)) ) {
        echo 'echec :( <br /><a href=".URL./pages/_frame-contact.php">Retour au formulaire</a>';
    } else {
        // ENCAPSULATION DES DONNEES
        mail($destinataire, $objet, utf8_decode($contenu), $headers);
        echo 'Formulaire envoyé avec success';
		echo "<a href=\"https://wonderful-germain.217-160-56-137.plesk.page/contact.html\"> Retour à la page de contact</a>";
	//	header("Location: https://wonderful-germain.217-160-56-137.plesk.page/contact.html");
    }

    // Les messages d'erreurs ci-dessus s'afficheront si Javascript est désactivé
?>