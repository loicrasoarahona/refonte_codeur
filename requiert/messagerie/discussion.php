<?php
$idmessage = isset($_GET['idmessage'])?addslashes(htmlentities($_GET['idmessage'])): null;
$discussion = $idmessage?$serviceMessage->discussion($userConnect, $idmessage):null;

$base = $serviceMessage->findDiscussion($idmessage);
if (!$discussion || !$base) {
	return;
}

$serviceMessage->markSee($userConnect, $idmessage);

if (!empty($_POST['contact_valider'])) {
	$message = nl2br(addslashes($_POST['message']));
	$sendBox = $serviceMessage->send($userConnect, ($base['senderId']==$userConnect?$base['recevorId']:$base['senderId']), $message, $base['sujet_message'], $idmessage);
	
	echo $base_url . "/messages?a=voir&idmessage=" . $idmessage;
	exit;
}
?>
<div class="modal-header pb-0">
	<h5 class="modal-title" id="staticBackdropLabel">
		<div class="w-100">
			<h4 class="mb-0"><?php echo $base["sujet_message"]; ?></h4>
			<span style="font-family: monospace; display: block; margin-left: 5px; font-size: 14px;">
				<b><?php echo $base["prenom"] . " " . $base["nom"]; ?></b>
				du
				<i><?php echo dateToFrench($base["lastBoxDate"], "l, h:i"); ?></i>
			</span>
		</div>
	</h5>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
<div class="modal-body">
	<div class="app">
	    <div class="wrapper">
	        <div class="chat-area" style="overflow: hidden;">
	            <div class="chat-area-main pt-4">
					<?php
					foreach ($discussion as $row):

		            if($row['senderId'] == $userConnect)
		            {
		                ?>
		                <div class="chat-msg owner">
		                    <div class="chat-msg-profile">
		                    	<i class="icofont-ui-user"></i>
		                        <div class="chat-msg-date">
		                            <?php echo dateToFrench($row['date'],"l, h:i");?>
		                            <!-- &bull; <a href="#" data-msg-id="<?php echo $row["id"];  ?>" class="delete-msg">Supprimer</a> -->
		                        </div>
		                    </div>
		                    <div class="chat-msg-content">
		                        <div class="chat-msg-text">
		                        	<?php echo nl2br($row["message"]); ?>
		                        </div>
		                    </div>
		                </div>
		                <?php
		            }
		            else
		            {
		                ?>
		                <div class="chat-msg">
		                    <div class="chat-msg-profile">
		                        <i class="icofont-user-suited"></i>
		                        <div class="chat-msg-date">
		                            <?php echo dateToFrench($row["date"],"l, h:i");?>
		                        </div>
		                    </div>
		                    <div class="chat-msg-content">
		                        <div class="chat-msg-text"><?php echo nl2br($row["message"]); ?></div>
		                    </div>
		                </div>
		                <?php
		            }
					endforeach;
					?>
	            </div>
	        </div>
	    </div>
	</div>
</div>
<div class="modal-footer">
	<form method="POST" class="chat-area-footer send-msg-box p-0" style="border-top: none;">
		<input type="hidden" name="contact_valider" value="1"/>
		<input type="hidden" name="idmessage" value="<?= $idmessage; ?>"/>
	    <textarea id="message-to-send" class="form-control" name="message" placeholder="Tapez votre message…" /></textarea>
	    <a class="p-0 m-2" id="send-msg"><i class="icofont-3x icofont-square-right"></i></a>
	</form>
</div>

<?php
	
if ($Cdones_offer['titre'] != '') {
	$pdo->exec("UPDATE messagerie SET lu = '1' WHERE id2 = '" . $idmessage . "' AND user2 = '" . $mbre_pseudo . "'");

	if (!empty($_POST['contact_valider'])) {
		$message = nl2br(addslashes($_POST['message']));

		if ($message == NULL) { 
			?>

			<div class="erreur" style="margin-top:10px;margin-bottom:5px;display:block;">Veuillez entrer un message valide...</div>
			<?php
		} else { //Si tout est bon on entre les données dans la BDD et on envoye le mail
			$date = date('d/m/Y à H:i');
			$pdo->exec("INSERT INTO `messagerie` (`id2`, `titre`, `message`, `user`, `user2`, `date`, minute) VALUES ('" . $idmessage . "', 'Re: " . $Cdones_offer['titre'] . "', '" . $message . "', '" . $mbre_pseudo . "', '" . $sonuser . "', '" . date('d/m/Y à H:i:s') . "', 0)");
			?>
			<script>window.document.location='messagerie.php?a=voir&idmessage=<?=$idmessage?>'</script>
			<!--div class="erreur" style="margin-top:10px;margin-bottom:5px;display:block;">Votre message a bien été envoyé.</div-->
			<?php
		}
	}
	?>

	<table class="table-actions">
		<thead>
			<tr>
				<th width="95%" align="left" valign="middle"><?php echo $Cdones_offer['titre']; ?></th>
				<th width="5%" align="left" valign="middle"></th>
			</tr>
		</thead>
		<tbody>
			<?php
				$wall = $pdo->query("SELECT user, message, date FROM messagerie WHERE id2 = '" . $idmessage . "' ORDER BY id DESC");
				$i = 0;
				$all_wall = $wall->fetchAll(PDO::FETCH_ASSOC);
				foreach ($all_wall as $dones_offer) {
					?>
					<tr class="table-actions-item">
						<td height="25" align="left"
							valign="middle" style="border-bottom : 1px solid #444;">
							<div style="margin-bottom:5px;">
								<i><strong><?php if ($dones_offer['user'] == $mbre_pseudo) { ?>Vous<?php
										} else {
											echo '<a href="./p-' . $dones_offer['user'] . '.php" target="_blank">' . $dones_offer['user'] . '</a>';
										}
										?></strong>, le <?php echo $dones_offer['date']; ?></i></div>
							<?php echo $dones_offer['message']; ?>
						</td>
						<td align="left" valign="middle" style="border-bottom : 1px solid #444;"></td>
					</tr>
					<?php
					$i++;
				}
			?>

		</tbody>
	</table>

	

	<?php
}
?>