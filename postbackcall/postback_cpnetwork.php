<?php
 	include('../requiert/bddConnect.php');
    include('../requiert/genereData.php');
 
    $ip=$_SERVER['REMOTE_ADDR'];

    if (!empty($_POST['campaign_name']) AND 
    !empty($_POST['sid']) AND 
    !empty($_POST['status']) AND
    !empty($_POST['vc_value']))
	{
		$campaign_name = $_POST['campaign_name'];
        $subid = $_POST['sid'];
		$status = $_POST['status'];
        $ip=$_SERVER['REMOTE_ADDR'];
		$vc_value = $_POST['vc_value'];
		if ($status == 1)
		{
			$data = data(30);
			$montantRev =  $vc_value;
			$pdo->exec("INSERT INTO 
            `histo_offers` 
            (`id`, 
            `idUser`, 
            `offerwall`, 
            `idt`, 
            `remuneration`, 
            `date`, 
            `dateUsTime`, 
            `data`, 
            `etat`, 
            `ip`
            ) VALUES (
                '', 
                '".$subid."', 
                'cpnetwork',
                '".$campaign_name."',
                '".$montantRev."', 
                NOW(), 
                NOW(), 
                '".$data."', 
                'En attente', 
                '".$ip."')");

			echo 1;
		}
	} 
?>