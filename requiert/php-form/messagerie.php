<?php

    if (!empty($_POST['destinataire'])): $destinataire = addslashes(htmlentities($_POST['destinataire'])); else: $destinataire = null; endif;
	if (!empty($_POST['Objet'])): $Objet = addslashes(htmlentities($_POST['Objet'])); else: $Objet = null; endif;
    if (!empty($_POST['message'])): $message = addslashes(htmlentities($_POST['message'])); else: $message = null; endif;
    if (!empty($_POST['message_reponse'])): $message_reponse = addslashes(htmlentities($_POST['message_reponse'])); else: $message_reponse = null; endif;

    if(!empty($_POST['submit_message'])){

        $req = $pdo->prepare('SELECT  *  FROM users WHERE email=?');
     
        $req->execute(array($destinataire));

        $result_req = $req->fetch(PDO::FETCH_OBJ);

         if (empty($result_req)) {
            $reponsError = 'l\'email du destinataire l\'existe pas.';
            $button = '"Fermer"';
        } else{

            $pdo->exec("INSERT INTO `messagerie_all`
             (`id`, 
             `id_send`, 
             `id_recive`, 
             `titre_text`, 
             `message_text`, 
             `id_response`, 
             `date_time_publish` 
             ) 
             VALUES 
             (
                 '', 
                 '" . $_SESSION['id'] . "', 
                 '" . $result_req->id . "', 
                 '" . $Objet  . "', 
                 '" . $message . "', 
                 '0' , 
                 NOW()
            )");

            $reponsConfirm = 'Message à bien été envoyer';
            $button = '"Fermer"';

        }

		// $pdo->exec("INSERT INTO `offers` (`id`, `idoffre`, `nom`, `url`, `description`, `description2`, `pays`, `remuneration`, `montant`, `valid`, `actif`, `date`, `regie`, `annonceur`, `quota`, `premium`, `image`) VALUES ('', '".$post_idoffre."', '".$post_nom."', '".$post_url."', '".$post_description."', '".$post_description2."', '".$post_pays."', '".$post_remuneration."', '".$post_montant."', '".$post_valid."', '0', '".date('d/m/Y à H:i:s')."', '".$post_regie."', '".$post_annonceur."', '".$post_quota."', '".$post_premium."', '".$post_image."')");
		
		// $reponsConfirm = 'L\'offre a bien été ajoutée.';
        unset($_POST);

    }

    if(!empty($_POST['submit_reponse'])){
 
        $x=$_GET['m'];
        var_dump($pdo->exec("UPDATE messagerie_all SET message_lu = '0' WHERE id = $x "));
        
        $a = $pdo->query("SELECT  * FROM messagerie_all WHERE id ='".$_GET['m']."'");
        $b = $a->fetch(PDO::FETCH_OBJ);
            $pdo->exec("INSERT INTO `messagerie_all`
             (`id`, 
             `id_send`, 
             `id_recive`, 
             `titre_text`, 
             `message_text`, 
             `id_response`, 
             `date_time_publish` 
             ) 
             VALUES 
             (
                 '', 
                 '" . $_SESSION['id'] . "', 
                 '" . $b->id_send . "', 
                 '" . $b->titre_text  . "', 
                 '" . $message_reponse . "', 
                 '". $_GET['m'] ."',
                 NOW()
            )");
            
            $reponsConfirm_repose = 'Reponse à bien été envoyer';
            
            $button = '"Fermer"';
            unset($_POST);

    }

?>

<?php

if (isset($reponsError)) {
?>
    <script type="text/javascript">
        swal({
            text: "<?= $reponsError; ?>",
            button: <?= $button; ?>,
            icon: "success",
            closeOnClickOutside: false,
            closeOnEsc: false,
        });
    </script>
    <?php
}
?>

<?php
if (isset($reponsConfirm)) {
    ?>
    <script type="text/javascript">
        swal({
            text: "<?= $reponsError; ?>",
            button: <?= $button; ?>,
            icon: "error",
            closeOnClickOutside: false,
            closeOnEsc: false,
        });
    </script>
    <?php
}
?>
 <?php
if (isset($reponsConfirm_repose)) {
    ?>
    <script type="text/javascript">
        swal({
            text: "<?= $reponsConfirm_repose; ?>",
            button: <?= $button; ?>,
            icon: "success",
            closeOnClickOutside: false,
            closeOnEsc: false,
        });
    </script>
    <?php
}
?>
 