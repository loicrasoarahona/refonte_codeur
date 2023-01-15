<?php
$_ROOT = $_SERVER['DOCUMENT_ROOT'];

include($_ROOT . '/requiert/php-global.php');

if (isset($pdo) && isset($mbreHashId)){
    $pSql = "SELECT * FROM histo_offers WHERE idUser = '".$mbreHashId."' AND etat='Valid&eacute;' AND vu_header=0 ORDER BY STR_TO_DATE(date,'%d/%m/%Y à %H:%i:%s') DESC LIMIT 0,10";


    $p = $pdo->query($pSql);
    $h = $p->fetchAll(PDO::FETCH_ASSOC);
    if(count($h) > 0){
        $nbr_io='<b class="cloche" >'.count($h).'</b>';
    }

    $fetch_data= $pdo->query("SELECT COUNT(*) AS 'remuneration' FROM messagerie_all WHERE id_recive='".$_SESSION['id']."' AND id_response = 0 AND message_lu = 0 ORDER BY id DESC");
    $totalMissionsAttente = $fetch_data->fetch(PDO::FETCH_ASSOC);
    $totalMissionsAttente = $totalMissionsAttente['remuneration'];

    }

?>