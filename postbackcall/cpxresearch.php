<?php
	include('../requiert/bddConnect.php');
	include('../requiert/genereData.php');

	// Your secret key can be found in your apps section by clicking on the "Secret Key" button
	$secret_key = 'Y4q2gCtdjPh8Mt5dXfSDmD64YKjLjH3M';

	// Get parameters
	$status = $_REQUEST['status'];
	$trans_id = $_REQUEST['trans_id'];
	$idmembre =$_REQUEST['user_id'];
	$sub_id = $_REQUEST['sub_id'];
	$sub_id_2 = $_REQUEST['sub_id_2'];
	$gross = $_REQUEST['gross'];
	$coins = $_REQUEST['amount_usd'];
    $offer_name = addslashes($_REQUEST['offer_name']);
	$ip_address = $_REQUEST['ip_address'];
	$signature = $_REQUEST['secure_hash'];
    
	// Create validation signature
	$validation_signature = md5 ($trans_id."-bIBWGOgOBCn0aLk995OjmLEFfIip4aem");

	if ($signature != $validation_signature)
	{
	    // Signatures not equal - send error code
		echo 0;
		die();
	}
	
	// Validation was successful. Credit user process.
	echo 1;

		if ($status == 1)
		{
			
			$data = data(30);

			$montantRev = (0.30 * $coins) / 1000;
			
		
			$pdo->exec("INSERT INTO `histo_offers` (`id`, `idUser`, `offerwall`, `idt`, `remuneration`, `date`, `dateUsTime`, `data`, `etat`, `ip`) VALUES
			('', '".$idMembre."', 'Cpx research.', '".$offer_name."', '".$montantRev."', '".date('d/m/Y à H:i:s')."', '".date('Y-m-d H:i:s')."', '".$data."', 'En attente', '".$ip_address."')");

			//$pdo->exec("UPDATE users SET cmonthly = cmonthly + '".$payout."' WHERE idm = '".$sonidm."'") or die ('Erreur : '.mysql_error());
		}
else	if ($status == 2)
		{
			echo '';
		}

		die();
?>
            