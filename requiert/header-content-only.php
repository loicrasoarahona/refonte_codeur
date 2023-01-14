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

    /*
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=(isset($title)?$title.' - ':'')?>Revenu Cash</title>
    <link rel="stylesheet" href="theme/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="theme/fonts/css/font-awesome.min.css">
    <link rel="stylesheet" href="theme/fonts/css/custom.css">
    <link id="cbx-style" rel="stylesheet" href="coupon/css/style-default.css" media="all">


    <!-- style venant de earnably -->
    <link rel="stylesheet" href="cash_theme/css/theme.css">
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>
</script>



</head>
<body class="flex flex-col flex-auto flex-shrink-0 min-h-screen antialiased">

*/
?>