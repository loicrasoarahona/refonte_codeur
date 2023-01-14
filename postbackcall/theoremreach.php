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
$reward = $_GET["reward"];
$status = $_GET["status"];
$currency = $_GET["currency"];
$screenout = $_GET["screenout"];
$profiler =  $_GET["profiler"];
$user_id = $_GET["user_id"];
$tx_id =  $_GET["tx_id"];
$hash = $_GET["hash"];
 $key= "74898404cdcc6604e6dca83fc9c03f7ade8a91fb";
 $campaign_name = "theoremreach";
$ip = getUserIpAddr();
$encoded_key = utf8_encode($key);
$encoded_URL = utf8_encode("https://facilodeal.com/postbackcall/theoremreach.php?user_id=".$user_id."&app_id=17494&reward=25&status=1&currency=0.31&screenout=2&profiler=2&tx_id=4e5b24f225dca72ffad16fb0ccf5&debug=true");
$hashed = hash_hmac('sha1', $encoded_URL, $encoded_key);
$digested_hash = pack('H*',$hashed);
$base64_encoded_result = base64_encode($digested_hash);
$final_result = str_replace(["+","/","="],["-","_",""],utf8_decode($base64_encoded_result));
$offer_name = "";



if($final_result = $hash ){
    
		if ($status == 1)
		{
		
			$tab = explode("-", $user_id); 
			$uid = $tab[0];
			$data = data(30);


			$montantRev = (0.30 * $reward) / 1000;
			
			/*$user = $pdo->query("SELECT hashId FROM users WHERE hashId = '".$uid."'");
			$dones_user = $user->fetch(PDO::FETCH_ASSOC);
			$idMembre = $dones_user['hashId'];*/

			$pdo->exec("INSERT INTO `histo_offers` (`id`, `idUser`, `offerwall`, `idt`, `remuneration`, `date`, `dateUsTime`, `data`, `etat`, `ip`)
			VALUES ('', '".$user_id."', 'Theoremreach', '".$offer_name."', '".$montantRev."', '".date('d/m/Y à H:i:s')."', '".date('Y-m-d H:i:s')."', 
			'".$data."', 'En attente', '".$ip_address."')");

			//$pdo->exec("UPDATE users SET cmonthly = cmonthly + '".$payout."' WHERE idm = '".$sonidm."'") or die ('Erreur : '.mysql_error());
		}
else	if ($status == 2)
		{
			echo '';
		}

		die();
		
		



}else {
    header('Location: https://cashbackreduction.com/');
}


?>

