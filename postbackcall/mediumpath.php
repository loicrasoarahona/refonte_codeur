<?php
	include('../requiert/bddConnect.php');
	include('../requiert/genereData.php');
	
//	$secret = "http://cashbackreduction.com/9755f6200cf4f98a1600258255"; // check your app info at www.mediumpath.com
	$secret = "9755f6200cf4f98a1600258255";
$transaction_id = $_POST["transId"];
$reward = $_POST["reward"];
$user_id = $_POST["user_id"]; //
$signature = $_POST["signature"];
$status = $_POST['status'];
$ip = $_POST['userIp'];
$campaign_id = $_POST['campaign_id'];
$offer_name = "";


		
		
  // validate signature
	if (md5($user_id.$transaction_id.$reward.$secret) != $signature)
	{
	    echo "Erreur";
	    return;
	}
	else
	{
		if ($status == "SUCCESS")
		{
		

			$montantRev = (0.35 * $reward) / 1000;

			$pdo->exec("INSERT INTO `histo_offers` (`id`, `idUser`, `offerwall`, `idt`, `remuneration`, `date`, `dateUsTime`, `data`, `etat`, `ip`) VALUES
			('', '".$user_id."', 'Mediumpath', '".$offer_name."', '".$montantRev."', '".date('d/m/Y à H:i:s')."', '".date('Y-m-d H:i:s')."', '".$transaction_id."', 'En attente', '".$ip."')");

			//$pdo->exec("UPDATE users SET cmonthly = cmonthly + '".$payout."' WHERE idm = '".$sonidm."'") or die ('Erreur : '.mysql_error());

			echo "1";
		}
        else if ($status == 2)
		{
			echo '';
		}

		die();
	}
?>