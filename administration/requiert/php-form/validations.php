<?php

function newNotifcations($idUser, $notif, $pdo)
{
    if (!empty($idUser) && !empty($notif))
    {
        $sqlNotif = "
            INSERT INTO `notifications` (`id`, `libelle`, `id_user`)
            VALUES (NULL, '" . $notif . "', '" . $idUser . "')
        ";
        $notif = $pdo->prepare($sqlNotif);
        $notif->execute();
    }
}

	if (!empty($_POST['submit_prevalidation_valider']))
	{
		$sonids = $_POST['id'];
		foreach ($sonids as $sonid)
		{
			$did = $pdo->query("SELECT * FROM histo_offers WHERE id = '".$sonid."'");
			$dones_idi = $did->fetch(PDO::FETCH_ASSOC);
			$sonidm = $dones_idi['idUser'];
			$saremuneration = $dones_idi['remuneration'];

			$pdo->exec("UPDATE histo_offers SET etat = 'En attente' WHERE id = '".$sonid."' AND idUser = '".$sonidm."'") or die ('Erreur : '.mysql_error());
		}
		unset($_POST);
					
		$reponsConfirm = 'Offres bien pré-validées.';	
	}

	if (!empty($_POST['submit_prevalidationCashback_valider']))
	{
		$sonids = $_POST['id'];
		foreach ($sonids as $sonid)
		{

			$did = $pdo->query("SELECT * FROM cashbackengine_cashabck WHERE id = '".$sonid."'");
			$dones_idi = $did->fetch(PDO::FETCH_ASSOC);
			$sonidm = $dones_idi['histo_retailler_id_user'];
			$saremuneration = $dones_idi['gains'];

			$pdo->exec("UPDATE users SET 
			euros = euros + '".$saremuneration."', 
			euros_histo = euros_histo + '".$saremuneration."'
			WHERE 
			id = '".$sonidm."'") or die ('Erreur : '.mysql_error());

			$pdo->exec("UPDATE cashbackengine_cashabck SET etat = 'Valid&eacute;' WHERE id = '".$sonid."' AND histo_retailler_id_user = '".$sonidm."'") or die ('Erreur : '.mysql_error());
		
		}

		unset($_POST);
					
		$reponsConfirm = 'Cashback bien pré-validées.';	
	}

	if (!empty($_POST['submit_prevalidation_refuser']))
	{
		$sonids = $_POST['id'];
		foreach ($sonids as $sonid)
		{
			$did = $pdo->query("SELECT * FROM histo_offers WHERE id = '".$sonid."'");
			$dones_idi = $did->fetch(PDO::FETCH_ASSOC);
			$sonidm = $dones_idi['idUser'];
						
			$pdo->exec("UPDATE histo_offers SET etat = 'Refus&eacute;' WHERE id = '".$sonid."' AND idUser = '".$sonidm."'") or die ('Erreur : '.mysql_error());
		}
		unset($_POST);
					
		$reponsConfirm = 'Offres bien refusées.';
	}

if (!empty($_POST['submit_prevalidationCashback_refuser']))
	{
		$sonids = $_POST['id'];
		foreach ($sonids as $sonid)
		{
			$did = $pdo->query("SELECT * FROM cashbackengine_cashabck WHERE id = '".$sonid."'");
			$dones_idi = $did->fetch(PDO::FETCH_ASSOC);
			$sonidm = $dones_idi['histo_retailler_id_user'];
						
			$pdo->exec("UPDATE cashbackengine_cashabck SET
			 etat = 'Refus&eacute;' 
			 WHERE id = '".$sonid."' 
			 AND histo_retailler_id_user = '".$sonidm."'") or die ('Erreur : '.mysql_error());

		}
		unset($_POST);
					
		$reponsConfirm = 'Cashback bien refusées.';
	}
	
	if (!empty($_POST['submit_validation_valider']))
	{
		$sonids = $_POST['id'];
		foreach ($sonids as $sonid)
		{
			$did = $pdo->query("SELECT HO.*, U.id as id_membre FROM histo_offers HO INNER JOIN users U ON U.hashId = HO.idUser WHERE HO.id = '".$sonid."'");
			$dones_idi = $did->fetch(PDO::FETCH_ASSOC);
			$sonidm = $dones_idi['idUser'];
			$saremuneration = $dones_idi['remuneration'];
			$id_membre = $dones_idi['id_membre'];
			$idt = $dones_idi['idt'];


			$pdo->exec("UPDATE users SET euros = euros + '".$saremuneration."', euros_histo = euros_histo + '".$saremuneration."', barrePrcnt = barrePrcnt + '0.05', ticketTombola = ticketTombola + 1 WHERE hashId = '".$sonidm."'") or die ('Erreur : ');
			
			$pdo->exec("UPDATE histo_offers SET etat = 'Valid&eacute;' WHERE id = '".$sonid."' AND idUser = '".$sonidm."'") or die ('Erreur : '.mysql_error());
	
			newNotifcations($id_membre, "Offres validée : " . $idt . " - " . round($saremuneration, 2) . " €", $pdo);
		}
					
		$reponsConfirm = 'Offres bien validées.';

		unset($_POST);

	}
	
	if (!empty($_POST['submit_validation_refuser']))
	{
		$sonids = $_POST['id'];
		foreach ($sonids as $sonid)
		{
			$did = $pdo->query("SELECT HO.*, U.id as id_membre FROM histo_offers HO INNER JOIN users U ON U.hashId = HO.idUser WHERE HO.id = '".$sonid."'");
			$dones_idi = $did->fetch(PDO::FETCH_ASSOC);
			$sonidm = $dones_idi['idUser'];
			$id_user = $dones_idi['id_membre'];
			$idt = $dones_idi['idt'];
			$saremuneration = $dones_idi['remuneration'];
						
			$pdo->exec("UPDATE histo_offers SET etat = 'Refus&eacute;' WHERE id = '".$sonid."' AND idUser = '".$sonidm."'") or die ('Erreur : '.mysqli_error());
			
			$style = "style='display: inline-block; border-botton: 2px solid green'";
			
			newNotifcations($id_membre, "<b $style>Offres Validé : " . $idt . " - " . round($saremuneration, 2) . " €</b>", $pdo);
		}

		$reponsConfirm = 'Offres bien refusées.';
		unset($_POST);
					
	}
	
	if (isset($reponsConfirm)) {
?>
		<script type="text/javascript">
			swal({
				text: "<?= $reponsConfirm; ?>",
				button: "Fermer",
				icon: "success",
				closeOnClickOutside: false,
				closeOnEsc: false,
			});
		</script>
<?php
	}
	
	if (isset($reponsError)) {
?>
		<script type="text/javascript">
			swal({
				text: "<?= $reponsError; ?>",
				button: "Fermer",
				icon: "error",
				closeOnClickOutside: false,
				closeOnEsc: false,
			});
		</script>
<?php
	}
?>