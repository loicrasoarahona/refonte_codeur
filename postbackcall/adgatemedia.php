<?php
	include('../requiert/bddConnect.php');
	include('../requiert/genereData.php');

	$subidS = $_GET['user_id']; // 
	$coins= $_GET['amount'];
	$tx_id = $_GET['tx_id'];
	$usd_value = $_GET['usd_value'];
	$vc_title = $_GET['vc_title'];
	$ip = $_GET['session_ip'];

    
        $tab = explode("-", $sub_id); 
		$uid = $tab[0];

		$montantRev = (0.30 * $coins) / 1000;
        $data = data(30);
	   
	   
			$user = $pdo->query("SELECT hashId FROM users WHERE hashId = '".$subid."'");
			$dones_user = $user->fetch(PDO::FETCH_ASSOC);
			$idMembre = $dones_user['hashId'];

	
      $pdo->exec("INSERT INTO `histo_offers` (`id`, `idUser`, `offerwall`, `idt`, `remuneration`, `date`, `dateUsTime`, `data`, `etat`, `ip`) VALUES ('', '".$idMembre."', 'AdGate Media', '".$vc_title."', '".$montantRev."', '".date('d/m/Y à H:i:s')."', '".date('Y-m-d H:i:s')."', '".$data."', 'En attente', '".$ip."')");
		

		echo 1;
		
		
?>