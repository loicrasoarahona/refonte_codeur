<?php
include('./requiert/inc-head.php');

include('./requiert/php-global.php');

$meta_title = 'Panel d\'administration : Utilisateurs | cashbackreduction.com';

$nomPage = 'Utilisateurs';

include('./requiert/inc-header-navigation.php');

$users = array();

$sql = "SELECT id,nom,prenom FROM users WHERE id != '".$mbreId."'";

foreach  ($pdo->query($sql) as $row) {
    $users[$row['id']] = $row['prenom']." ".$row['nom'];
}

if(isset($_POST['submit'])){
	try {
		$message = $pdo->Quote($_POST["message"]);
		$id_to_message = $pdo->Quote($_POST["id"]);
		$pdo->Query("UPDATE `users` SET `pmessage`=".$message." WHERE `id` = ".$id_to_message."");
		$successful_message = true;
	} catch (Exception $ex) {
		$successful_message = false;
	}
}

?>
    <nav class="navbar navbar-expand navbar-light bg-light mb-4">
                        <h4 class="text-primary" >Message</h4>
                        <ul class="navbar-nav ml-auto">
                        
                        </ul>
                    </nav>
        
    <section class="bg-light-grey absolute-section-1 margin-base">
        <div class="m-auto content p-40-20 container"><div class="row">
			<form action="#" method="post">
				<div class="m-b-10"><select name="id">
					<?php 
					foreach ($users as $id => $infos) {
						echo "<option value='".$id."'>".$infos."</option>";
					}
					?>
				</select></div>
				<div class="m-b-10">
					<textarea 
					 name="message" 
					 cols="50" 
					 rows="5"
					 placeholder="Tapez votre message ici"
					 ></textarea>
				</div>
				<div class="m-b-10">

					<button type="submit" name="submit" class="btn btn-primary btn-icon-split">
						<span class="text">Envoyer le message</span>	
					</button>
			
				</div>
			</form>		
	</div>
    </section>
	<?php
	include('./requiert/inc-footer.php');
?>
		<?php if (isset($_POST['submit'])) { ?>
		<script>
			 var success = "<?php echo $successful_message; ?>";
				if (success) {
						swal({
							text: "Message bien envoyé !",
							button: "Fermer",
							icon: "success",
							closeOnClickOutside: false,
							closeOnEsc: false,
						});
				} else {
						swal({
							text: "Erreur d\'envoi du message !",
							button: "Fermer",
							icon: "error",
							closeOnClickOutside: false,
							closeOnEsc: false,
						});
				}
		</script>
		<?php
		}
		?>
 
