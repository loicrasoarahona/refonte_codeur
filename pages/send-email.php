<?php
if (isset($_POST['message'])) {
        $entete  = 'MIME-Version: 1.0' . "\r\n";
        $entete .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $entete .= 'From: jrakoto280@gmail.com' . "\r\n";
        $entete .= 'Reply-to: ' . $_POST['email'];

        $message = '<h1>Message envoyé depuis la page Contact</h1>
		<p><b>Prénom : </b>' . $_POST['prenom'] . '<br>
		<p><b>Object : </b>' . $_POST['object'] . '<br>
        <p><b>Email : </b>' . $_POST['email'] . '<br>
        <b>Message : </b>' . htmlspecialchars($_POST['message']) . '</p>';

        $retour = mail('jrakoto280@gmail.com', 'Envoi depuis page Contact', $message, $entete);
        if($retour)
            $message = "<div class=\"alert alert-success\" role=\"alert\">Votre message a bien été envoyé.</div>";
    }
?>
