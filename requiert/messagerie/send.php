<?php	 
if (!empty($_POST["new-msg"])) {
	?>
	<div class="modal-header pb-0">
		<h5 class="modal-title w-100" id="staticBackdropLabel">
			<div class="w-100">
				<div class="form-group">
                    <select class="form-control grp-add" name="user-dest">
                        <option>Choisir le destinataire</option>
                        <?php
    					$userList = $pdo->query("SELECT id, email, nom, prenom, level FROM users WHERE actif = 1 AND id <> '" . $_SESSION['id'] . "'");
                        
                        foreach($userList->fetchAll(PDO::FETCH_ASSOC) as $user){
                        	$mode = "";
                        	if ($user["level"] > 1) {
                        		$mode = " - [Modérateur]";
                        	}
                            echo '<option value="'.$user["id"].'">'.$user["prenom"] . " " .$user["nom"]. $mode . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group w-100">
				    <input type="text" class="form-control" name="sujet" placeholder="Sujet du message">
				</div>
			</div>
		</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
		<div class="app">
		    <div class="wrapper">
		        <div class="chat-area">
		            <div class="chat-area-main pt-4">
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
		    <a class="p-0 m-2 btn" id="send-new-msg"><i class="icofont-3x icofont-square-right"></i></a>
		</form>
	</div>
	<?php
	exit;
}
	 $userC = $pdo->query("SELECT COUNT(*) as nbr_entrees FROM users WHERE id = '" . $idm . "'");
	 $userCs = $userC->fetch(PDO::FETCH_ASSOC);
	 
	 if (!empty($_POST['submit_message'])) {
		
		if ($idm == NULL) {
			if (!empty($_POST['idmembre'])) {
				$idmembre = addslashes($_POST['idmembre']);
			} else {
				$idmembre = NULL;
			}
		} else {
			$idmembre = $idm;
		}
		

		$sujet = addslashes($_POST['sujet']);
		$message = nl2br(addslashes($_POST['message']));

		$sendBox = $serviceMessage->send($userConnect, $idmembre, $message, $sujet);
		if ($sendBox['code'] == 200) {
			$repons = $sendBox['data']['discussion'];
		}
		else {
			if (isset($sendBox['errors']['recevorId'])) {$repons = 'Ce membre n\'existe pas.';}
			if (isset($sendBox['errors']['senderId'])) {
				$repons = $base_url . "messages";
			}
			elseif (isset($sendBox['errors']['message']) || isset($sendBox['errors']['sujet'])) {
				$repons = 'Un ou plusieurs champs ne sont pas remplis.';
			}
			else{
				
				$repons = 'Nous avons rencontré un problème.';	
			}
		}

		echo $repons;
		
		// if(isset($_GET['done'])){$repons = 'Votre message a bien été envoyé.';}
		
		// if ($sujet == NULL or $message == NULL or $idmembre == NULL) { //On verifie que les variables précédentes ne soient pas vide
		// 	$repons = 'Un ou plusieurs champs ne sont pas remplis.';
		// } else { //Si tout est bon on entre les données dans la BDD et on envoye le mail
			
			
			
		// 	//$idmsg = code(15);
		// 	// $user = $pdo->query("SELECT COUNT(*) as t, nom, prenom, email FROM users WHERE id = '" . $idmembre . "'");
		// 	// $users = $user->fetch(PDO::FETCH_ASSOC);
		// 	// $email = $users['email'];
		// 	// $user = $users['prenom'] . " " . $users['nom'];
		// 	//$users['t'] == 1
			
		// 	if ($sendBox['code'] == 200) {
		// 		echo "<script>window.document.location='messagerie.php?a=voir&idmessage=".$sendBox['data']['discussion']."'</script>";
		// 		// $date = date('d/m/Y à H:i');
		// 		// try {
		// 		// 	$pdo->exec("INSERT INTO `messagerie` (`id2`, `titre`, `message`, `user`, `user2`, `date`, minute) VALUES ('" . $idmsg . "', '" . $sujet . "', '" . $message . "', '" . $mbre_pseudo . "', '" . $user . "', '" . date('d/m/Y à H:i:s') . "',0)");
		// 		// 	echo "<script>window.document.location='messagerie.php?a=voir&idmessage=".$idmsg."'</script>";
		// 		// } catch (\Exception $th) {
				
		// 		// }
		// 	} else {
		// 		if (isset($sendBox['errors']['recevorId'])) {
		// 			$repons = 'Ce membre n\'existe pas.';
		// 		}
		// 		else{
		// 			$repons = 'Nous avons rencontré un problème.';	
		// 		}
		// 	}
		// }
	}/*
?>
<a href='messagerie.php' type="button" class="btn btn-primary">
	<span class=" glyphicon glyphicon-pencil " style='margin: 0 1vh' aria-hidden="true"></span>
	Retour messagerie
</a>

<?php if (isset($repons) && !empty($repons)) : ?>
	<div class="erreur" style="margin-bottom : 10px; display : block;"><?php echo $repons; ?></div>
<?php endif; ?>

<div class="dashboard-wrap" style="padding: 0px 20px;"> 
    <div class="p-2 mb-1" style='width:100%;'>
    	<div class="row">
			<form action="messagerie.php?a=send" method="POST" class="bg-white rounded p-4 mb-4 shadow-sm">
				<div class="class='form-control">
					<select class='form-control' name="idmembre">
					<?php
						foreach ($users_list as $id => $infos) {
							echo "<option value='" . $id . "'>" . $infos . "</option>";
						}
					?>
					</select>
				</div>
				<hr class="bg-white rounded p-4 mb-4 shadow-sm">
				<input type="text" name="sujet" class="form-control" value="" placeholder="Sujet de votre message" style="margin:1.5vh 0"; />
				<hr style="margin: 10px 0;">
				<textarea name="message" class="form-control" style="margin:1.5vh 0;" placeholder="Entrez ici votre message" id="" cols="30" rows="10" ></textarea>
				<input type="submit" class='btn btn-primary'  name="submit_message" value='Envoyer' style='style="margin-bottom : 10px; text-align : left;' />
			</form>
		</div>
	</div>
</div>*/