<?php
session_start();
include_once($_SERVER["DOCUMENT_ROOT"] . '/include/config.php');
include_once($_SERVER["DOCUMENT_ROOT"] . '/requiert/php-global.php');

if (isset($_SESSION['id'])) {

    $getOffre = $pdo->query("SELECT idoffre FROM offers WHERE id = '" . intval($_GET['offre']) . "'");
    $offreId = $getOffre->fetch(PDO::FETCH_ASSOC)["idoffre"];

    if (empty($offreId))
    {
        exit("Aucune correspondance");
    }

    
    $sql = $pdo->query("SELECT * FROM users WHERE id = '" . addslashes($_SESSION['id']) . "'");
    $resultat = $sql->fetch(PDO::FETCH_ASSOC);
    $mbreId = addslashes(htmlentities($resultat['id']));
    $mbreHashId = addslashes(htmlentities($resultat['hashId']));
    $mbreEmail = addslashes(htmlentities($resultat['email']));
    $mbreMdp = addslashes(htmlentities($resultat['mdp']));
    $mbreNom = addslashes(html_entity_decode($resultat['nom']));
    $mbrePrenom = addslashes(html_entity_decode($resultat['prenom']));
    $mbreAdresse = addslashes(html_entity_decode($resultat['adresse']));
    $mbreVille = addslashes(html_entity_decode($resultat['ville']));
    $mbreCodePostal = addslashes(htmlentities($resultat['codePostal']));
    $mbrePays = addslashes(html_entity_decode($resultat['pays']));
    $country_code = addslashes(html_entity_decode($resultat['pays']));
    $mbreEuros = addslashes(html_entity_decode($resultat['euros']));
    $mbreEurosHisto = addslashes(html_entity_decode($resultat['euros_histo']));
    $mbreIdParrain = addslashes(htmlentities($resultat['idParrain']));
    $mbreLevel = addslashes(htmlentities($resultat['level']));
    $mbreBarrePrcnt = addslashes(htmlentities($resultat['barrePrcnt']));
    $mbreBanni = addslashes(htmlentities($resultat['banni']));
    $mbreBanniChat = addslashes(htmlentities($resultat['banni_chat']));
    $mbreIban = addslashes(htmlentities($resultat['iban']));
    $mbreSwift = addslashes(htmlentities($resultat['swift']));
    $mbrePaypal = addslashes(htmlentities($resultat['paypal']));
    $mbreSkrill = addslashes(htmlentities($resultat['skrill']));
    $mbreCodeVerif = addslashes(htmlentities($resultat['code_verif']));
    $mbrePremium = addslashes(htmlentities($resultat['premium']));
    $mbreDateLastCo = addslashes(htmlentities($resultat['datelastco']));
    $mbreTicketTombola = addslashes(htmlentities($resultat['ticketTombola']));
    $mbreIdentRecto = addslashes(htmlentities($resultat['ident_recto']));
    $mbreIdentVerso = addslashes(htmlentities($resultat['ident_verso']));
    $mbreIdentVerif = addslashes(htmlentities($resultat['ident_verif']));
    $mbreNewsletter = addslashes(htmlentities($resultat['news']));
    
    $off_id = htmlspecialchars(addslashes($offreId));

    $sql = $pdo->query("SELECT * FROM offers WHERE idoffre = '".$off_id."'");
    $resultat = $sql->fetch(PDO::FETCH_ASSOC);

        $ip = $_SERVER['REMOTE_ADDR'];
    
        // verification  ip
        $a = $pdo->prepare("SELECT * FROM 
                histo_offers 
                WHERE 
                data = '".$off_id."' AND 
                ip= '".$ip."'
        ");

        $a->execute();

        if($a->rowCount() === 0){

            $b = $pdo->query("SELECT * FROM 
                histo_offers 
                WHERE 
                idUser='".$mbreHashId."' AND
                offerwall = 'Mission' AND
                date =  '".date('Y-m-d')."' AND 
                data = '".$off_id."'   
            ");
    
            $p = $b->fetchAll();

            $f=count($p);

            if($f <= $resultat['quota']){

            $url= explode(',',$resultat['url'])[$f];
            $remuneration= $resultat['remuneration'];
            $nom= $resultat['nom'];
            $remuneration= $resultat['remuneration'];
            $nom= $resultat['nom'];

                    //  $url = str_replace('#IDM', $data, $url);
                    $date = date('d/m/Y à H:i:s');
                                
                    $pdo->exec("INSERT INTO `histo_offers` 
                    (
                        `id`, 
                        `idUser`, 
                        `offerwall`, 
                        `idt`, 
                        `remuneration`, 
                        `date`, 
                        `dateUsTime`, 
                        `data`, 
                        `etat`, 
                        `ip`
                    ) 
                    VALUES 
                        (
                            '', 
                            '".$mbreHashId."', 
                            'Mission', 
                            '".$nom."',
                            '".$remuneration."', 
                            '".date('Y-m-d')."', 
                            '".date('Y-m-d H:i:s')."', 
                            '".$off_id."', 
                            'En cours', 
                            '".$ip."'
                        )
                    ");
                    
                    if (!empty($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest") {
                        echo "##_##" . $url;
                    }
                    else {
                        echo 'redirection en cours ...';
                        echo '<br/>';
                        redirect($url);
                    }

            }else{
                echo 'Vous avez utiliser tout les offre pour aujourd\'hui ! ';
            }
        
        }else{
            echo 'Utiliser un autre ip.';
        }
}else{
    echo 'ds';
}
?>