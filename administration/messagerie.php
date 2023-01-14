<?php
session_start();
	include('./requiert/inc-head.php');

	include('./requiert/php-global.php');
	
	$meta_title = 'Panel d\'administration : Messagerie | cashbackreduction.com';

    $nomPage = 'messagerie';

	include('./requiert/inc-header-navigation.php');

    $userConnect = $_SESSION["admin"]["id"];

    include($_SERVER["DOCUMENT_ROOT"] . "/requiert/messagerie/serviceMessagerie.php");
    $serviceMessage = new \ServiceMessagerie\Messagerie($pdo);

    $idbm = isset($_GET['idbm'])?addslashes(htmlentities($_GET['idbm'])): null;
    
    $discussion = $idbm?$serviceMessage->discussion($userConnect, $idbm):null;

    $base = $serviceMessage->findDiscussion($idbm);

    $serviceMessage->markSee($userConnect, $idbm);

    if (!empty($_POST['contact_valider'])) {
        $message = nl2br(addslashes($_POST['message']));
        $sendBox = $serviceMessage->send($userConnect, ($base['senderId'] == $userConnect ? $base['recevorId'] : $base['senderId']), $message, $base['sujet_message'], $idbm);
        
    }

    function getNameUser($idUser) {
        $userInf = $GLOBALS["pdo"]->query("SELECT nom, prenom FROM users WHERE id = '" . $idUser . "'");
        $dataUser = $userInf->fetchAll(PDO::FETCH_ASSOC)[0];
        return $dataUser["prenom"] . " " . $dataUser["nom"];
    }
?>

            <div class="m-auto content p-40-20 container">
                <div class="row" style="width:  500px;">
                    <div class="bg-blue color-white b-r-5 uppercase p-10 m-b-15">Messagerie</div>

                    <?php
                    if (isset($_GET['a'])) { $a = addslashes(htmlentities($_GET['a'])); }
                    if (isset($_GET['idmessage'])) { $idmessage = addslashes(htmlentities($_GET['idmessage'])); }
                    if (isset($_GET['idm'])) { $idm = addslashes(htmlentities($_GET['idm'])); } else { $idm = NULL; }

                    if (empty($a)) {
                        ?>

                        <table width="100%" style="border:1px solid black;" cellpadding="0" cellspacing="0" class="table_1">
                            <tr style="background-color:#000;color:#FFF;font-weight:bold;">
                                <td align="middle">Date</td>
                                <td align="middle">Emetteur</td>
                                <td align="middle">Destinataire</td>
                                <td align="middle">Objet</td>
                            </tr>
                            <?php

                            $sql = "SELECT M.*, BM.id AS idM, BM.sujet_message FROM messagerie M INNER JOIN boitMessagerie BM ON BM.id = M.boit_message_id WHERE BM.sujet_message != '' AND (M.senderId = '" . $userConnect . "' OR M.recevorId = '" . $userConnect . "') ORDER BY M.id DESC";

                            foreach  ($pdo->query($sql) as $row)
                            {
                                ?>
                                <tr style="background-color:#FFF;">
                                    <td height="30" align="middle"><?php echo date("d/m/Y H:i:s", $row['date']); ?></td>
                                    <td align="middle"><?php echo getNameUser($row['senderId']); ?></td>
                                    <td align="middle"><?php echo getNameUser($row['recevorId']); ?></td>
                                    <td align="middle"><a href="./messagerie.php?a=voir&idmessage=<?php echo $row['id']; ?>&idbm=<?php echo $row['idM']; ?>"><?php echo $row['sujet_message']; ?></a></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>

                        <?php
                    } else if ($a == 'voir') {
                        $sql = $pdo->query("SELECT BM.sujet_message AS titre, M.date, M.message, BM.lastBoxDate, M.senderId FROM messagerie M INNER JOIN boitMessagerie BM ON BM.id = M.boit_message_id WHERE BM.sujet_message != '' AND (M.senderId != '' AND M.recevorId != '') AND BM.id = '" . $idbm . "'");
                        $Cdones_offers = $sql->fetchAll(PDO::FETCH_ASSOC);

                        ?>
                        <div class="w-100 mb-3 mt-4">
                            <h4 class="mb-0">Sujet : <?php echo $Cdones_offers[0]["titre"]; ?></h4>
                            <span style="font-family: monospace; display: block; margin-left: 5px; font-size: 14px;">
                                <b><?php echo getNameUser($Cdones_offers[0]["senderId"]); ?></b>
                                du
                                <i><?php echo dateToFrench($Cdones_offers[0]["lastBoxDate"], "l, h:i"); ?></i>
                            </span>
                        </div>
                        <?php
                        foreach ($Cdones_offers as $Cdones_offer)
                        {
                            if($Cdones_offer['senderId'] == $userConnect)
                            {
                                ?>
                                <div class="row w-100 offset-6 mr-0 pr-0">
                                    <div class="chat-msg mr-0 mb-3 p-3 w-auto text-left w-100" style="border: 1px solid #ddd;background: #4c72de;border-radius: 5px 5px 0px 5px;color: #ffffff;">
                                        <div class="chat-msg-content" style="font-size:  20px;">
                                            <div class="chat-msg-text">
                                                <?php echo nl2br($Cdones_offer["message"]); ?>
                                            </div>
                                        </div>
                                        <div class="chat-msg-profile" style="font-size: 12px;">
                                            <div class="chat-msg-date">
                                                <?php
                                                    echo "<b>Vous</b> [" . dateToFrench($Cdones_offer["lastBoxDate"], "l, h:i") . "]";
                                                ?>
                                                <!-- &bull; <a href="#" data-msg-id="<?php echo $Cdones_offer["id"];  ?>" class="delete-msg text-danger" style="font-size: 24px; font-weight: bold;">x</a> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            else
                            {
                                ?>
                                <div class="row w-100 pl-3">
                                    <div class="chat-msg mb-3 p-3 w-auto text-left" style="border: 1px solid #ddd;background: #ddd;border-radius: 5px 5px 5px 0px;color: #464646;">
                                        <div class="chat-msg-content" style="font-size: 20px;">
                                            <div class="chat-msg-text"><?php echo nl2br($Cdones_offer["message"]); ?></div>
                                        </div>
                                        <div class="chat-msg-profile" style="font-size: 12px;">
                                            <div class="chat-msg-date" style="bottom: -5px;">
                                                <?php
                                                echo "<b>" . getNameUser($Cdones_offer["senderId"]) . "</b> [" . dateToFrench($Cdones_offer["lastBoxDate"], "l, h:i") . "]";
                                                ?>
                                                <!-- &bull; <a href="#" data-msg-id="<?php echo $Cdones_offer["id"];  ?>" class="delete-msg text-danger" style="font-size: 24px; font-weight: bold;">x</a> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>

                        <form action="" method="POST" class="chat-area-footer send-msg-box p-0 w-100 row" style="border-top: none;">
                            <input type="hidden" name="contact_valider" value="1"/>
                            <input type="hidden" name="idmessage" value="<?= $idmessage; ?>"/>
                            <div class="row mt-5 mb-5 w-100 pl-4 pr-4">
                                <textarea id="message-to-send" class="form-control" name="message" placeholder="Tapez votre message…" style="width: 65%;"></textarea>
                                <button type="submit" class="p-0 m-2 btn btn-primary" id="send-msg" style="height: 40px;width: 120px;color: #fff;font-weight: bold;padding-top: 5px !important; cursor: pointer;">Répondre</button>
                            </div>
                        </form>
                        <?php
                    }
                    ?>

                </div></div>
        </section>

<?php
	include('./requiert/inc-footer.php');
?>