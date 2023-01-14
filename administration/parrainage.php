<?php
	include('./requiert/inc-head.php');

	include('./requiert/php-global.php');
	
	$meta_title = 'Panel d\'administration : Coupons | cashbackreduction.com';

    $nomPage = 'coupons';

	include('./requiert/inc-header-navigation.php');

    include('./requiert/php-form/parrainage.php');
?>

		            <div class="form-box-items">
                <!-- FORM BOX ITEM -->
                <div class="form-box-item" style="width: 100%;">
                    <h4  class="text-primary" >Parrainage</h4>
                    <hr class="line-separator">

                    <form id="profile-info-form" method="post">
						<?php
							$sql = "SELECT * FROM parrainage WHERE id=1";
							$req = $pdo->query($sql);
							$par = $req->fetch(PDO::FETCH_ASSOC);
						?>
                        <!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <label for="bonusInscription" class="text-primary">Bonus d'inscription (0 = désactivé)</label>
                            <input type="number" id="bonusInscription" class='form-control' name="bonusInscription" value="<?= $par['inscription']; ?>" placeholder="en euro" required>
                            <small>Bonus d'inscription pour les nouveaux membres (en Euro)</small>
                        </div>

                        <!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <label for="bonusAmi" class="text-primary" >Parrainer un bonus ami (0 = désactivé)</label>
                            <input type="number" id="bonusAmi" name="bonusAmi" value="<?= $par['ami']; ?>" placeholder="en euro" required>
                            <small>Montant que les utilisateurs gagnent lorsqu'ils recommandent un ami (en Euro)</small>
                        </div>
                        <!-- /INPUT CONTAINER -->
                        <div class="clear" ></div>
						<!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <label for="commission" class="text-primary" >Commission de renvoi</label>
                            <input type="number" id="commission" name="commission" placeholder=" en %" value="<?= $par['commission']; ?>" required>
                            <small>Pourcentage que les utilisateurs gagnent de leurs amis référés (en %)</small>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- /INPUT CONTAINER -->
                        <input type="submit" name="submit_update" class="button btn-primary btn-icon-split" value="Valider">
                    </form>
                </div>
                <!-- /FORM BOX ITEM -->
<?php
	include('./requiert/inc-footer.php');
?>