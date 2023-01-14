<?php
	include('../requiert/bddConnect.php');
	include('../requiert/genereData.php');
        
        function addLogEvent($event)
        {
            $event = $event."\n";

            file_put_contents("adgem.log", $event, FILE_APPEND);
        }

        foreach($_GET as $key => $value)
        {
            $event .= $key." : ".$value."<br>";
        }
        addLogEvent('0n9m5hk8508c51am42366i02');
        
	// Get parameters
	$uid = $_GET['uid'];
	$player_id = $_GET['player_id'];
	$trans_id = $_GET['trans_id'];
	$sub_id = $_GET['sub_id'];
	$amount = $_GET['amount'];
	$campaign_id = $_GET['campaign_id'];
	$campaign_name = addslashes($_GET['campaign_name']);
	$app_id = $_GET['app_id'];
	$ip_address = $_GET['ip'];

        $tab = explode("-", $sub_id); 
			$uid = $tab[0];

			$montantRev = (0.30 * $coins) / 1000;
			$data = data(30);

			$user = $pdo->query("SELECT hashId FROM users WHERE hashId = '".$uid."'");
			$dones_user = $user->fetch(PDO::FETCH_ASSOC);
			$idMembre = $dones_user['hashId'];

        $pdo->exec("INSERT INTO `histo_offers` (`id`, `idUser`, `offerwall`, `idt`, `remuneration`, `date`, `dateUsTime`, `data`, `etat`, `ip`) VALUES ('', '".$idMembre."', 'adgem', '".$campaign_name."', '".$montantRev."', '".date('d/m/Y à H:i:s')."', '".date('Y-m-d H:i:s')."', '".$data."', 'En attente', '".$ip_address."')");
		
		//$pdo->exec("UPDATE users SET cmonthly = cmonthly + '".$payout."' WHERE idm = '".$sonidm."'") or die ('Erreur : '.mysql_error());

?>
            