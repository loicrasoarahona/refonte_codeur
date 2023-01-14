<?php
	include('../requiert/bddConnect.php');
	include('../requiert/genereData.php');
	
function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

$key= "b0a3f86364b61f436f";
$post_ip = (isset($_SERVER['HTTP_CF_CONNECTING_IP']) ? $_SERVER['HTTP_CF_CONNECTING_IP'] : $_SERVER['REMOTE_ADDR']);
$idMembre = $_SESSION['id'];
$status = $_GET["statut"];
$coins = $_GET["coins"];
$user_id = $_GET["uid"];
$tx_id =  $_GET["txnid"];
$hash = $_GET["hash"];
$campid = $_GET['campid'];
$campaign_name = $_GET["campname"];
$ip = getUserIpAddr();
$validation_signature	= $_GET['hash'];



	
		if ($status == 1)
		{
			$tab = explode("-", $uid); 
			$uid = $tab[0];
			$data = data(30);
			

			$montantRev = (0.30 * $coins) / 1000;
			
        $user = $pdo->query("SELECT hashId FROM users WHERE hashId = '".$uid."'");
		$dones_user = $user->fetch(PDO::FETCH_ASSOC);
		$idMembre = $dones_user['hashId'];
	
    $pdo->exec("INSERT INTO `histo_offers` (`id`, `idUser`, `offerwall`, `idt`, `remuneration`, `date`, `dateUsTime`, `data`, `etat`, `ip`)
			VALUES ('', '".$user_id."', 'Enligne survey', '".$campaign_name."', '".$montantRev."', '".date('d/m/Y à H:i:s')."', '".date('Y-m-d H:i:s')."', 
			'".$data."', 'En attente', '".$ip_address."')");
			
    //$pdo->exec("UPDATE users SET cmonthly = cmonthly + '".$payout."' WHERE idm = '".$sonidm."'") or die ('Erreur : '.mysql_error());	
	
}
else	if ($status == 2)
		{
			echo '';
		}

		die();





?>

		

	
		
	




