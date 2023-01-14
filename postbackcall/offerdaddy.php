<?php

	 include('../requiert/bddConnect.php');
	 include('../requiert/genereData.php');
	
$your_app_key = "a4142db04bb1f902a0c43c59379160e3";
	
$transaction_id = urldecode($_GET["transaction_id"]);
$offer_id = urldecode($_GET["offer_id"]);
$offer_name = urldecode($_GET["offer_name"]);
$amount = urldecode($_GET["amount"]); //This is what your user is paid in your virtual currency, for example 300 coins
$virtual_currency = urldecode($_GET["virtual_currency"]); // This is simply the name of the currency of your app
$user_id = urldecode($_GET["userid"]); //
$signature = urldecode($_GET["signature"]);
$payout = urldecode($_GET["payout"]);
$subid1 = urldecode($_GET["subid1"]);
$subid2 = urldecode($_GET["subid2"]);
$subid3 = urldecode($_GET["subid3"]);
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
$ip =  getUserIpAddr();
//Check the signature
$my_signature = md5($transaction_id."/".$offer_id."/".$your_app_key);

if($my_signature != $signature){
  //Signatures don't match
  echo "Ouuu";
  exit(0);
}
	//Possible make some other checks like if userid is actually a user in your system...
	
	$offer_name = "";
	$data = data(30);
    $montantRev = (0.30 * $amount) / 1000;
   $pdo->exec("INSERT INTO `histo_offers` (`id`, `idUser`, `offerwall`, `idt`, `remuneration`, `date`, `dateUsTime`, `data`, `etat`, `ip`) VALUES
        ('', '".$user_id."', 'Offer daddy', '".$offer_name."', '".$montantRev."', '".date('d/m/Y à H:i:s')."', '".date('Y-m-d H:i:s')."', '".$data."', 'En attente', '".$ip_address."')");

		
	if($result){
  echo "1";
}else{
  echo "0";
}

exit(0);

?>	