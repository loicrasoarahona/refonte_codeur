<?php
	include('./requiert/inc-head.php');

	include('./requiert/php-global.php');
	
	$meta_title = 'Panel d\'administration : Gagnants | cashbackreduction.com';

    $nomPage = 'gagnants';

	include('./requiert/inc-header-navigation.php');

    include('./requiert/php-form/gagnants.php');
?>

            <nav class="navbar navbar-expand navbar-light bg-light mb-4">
                <h4 class="text-primary" >Administration des gagnants</h4>
            </nav>
            <!-- /HEADLINE -->
            <!-- PURCHASES LIST -->
            <div class="purchases-list">
                <!-- PURCHASES LIST HEADER -->
                <div class="purchases-list-header">
                    <div style='width:20vh' >
                        <p class="text-header small">Date</p>
                    </div>
                    <div  style='width:20vh' >
                        <p class="text-header small">Utilisateur</p>
                    </div>
                    <div  style='width:20vh'>
                        <p class="text-header small">Libéllé</p>
                    </div>
                    <div  style='width:20vh' >
                        <p class="text-header small">Montant</p>
                    </div>
                    <div  style='width:20vh' >
                        <p class="text-header small">Code</p>
                    </div>
                </div>
                <!-- /PURCHASES LIST HEADER -->
                <?php //Bloc requete SQL pour la prochaine boucle
                $boutiqueGagnants = $pdo->query("SELECT * FROM gagnants WHERE etat = 'En attente' ORDER BY STR_TO_DATE(date,'%d/%m/%Y à %H:%i:%s') DESC");
                $all_boutiqueGagnants = $boutiqueGagnants->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <?php foreach ($all_boutiqueGagnants as $dones_boutiqueGagnants):?>
                    <?php //Bloc req SQL pour fetch
                    $sql_infoUser = $pdo->query("SELECT * FROM users WHERE id = '".intval($dones_boutiqueGagnants['idUser'])."'");
                    $donnees_infoUser = $sql_infoUser->fetch();
                    $infoUser_nom = $donnees_infoUser['nom'];
                    $infoUser_prenom = $donnees_infoUser['prenom'];
                    $infoUser_iban = $donnees_infoUser['iban'];
                    $infoUser_bic = $donnees_infoUser['swift'];
                    $infoUser_skrill = $donnees_infoUser['skrill'];
                    $infoUser_paypal = $donnees_infoUser['paypal'];
                    ?>
                <!-- PURCHASE ITEM -->
                <div class="purchase-item">
                    <div style='width:20vh'>
                        <p><?= $dones_boutiqueGagnants['date']; ?></p>
                    </div>
                    <div  style='width:20vh'>
                        <!-- ITEM PREVIEW -->
                            <p  ><?= $infoUser_prenom.' '.substr($infoUser_nom, 0, 1).'.'; ?></p>
                        <!-- /ITEM PREVIEW -->
                    </div>
                    <div  style='width:20vh'>
                        <p class="category primary"><?= ucfirst($dones_boutiqueGagnants['type']); ?></p>
                        <?php if ($dones_boutiqueGagnants['type'] == 'Virement Bancaire'): ?>
                        <p><span class="light">IBAN:</span> <?= $infoUser_iban ?></p>
                        <p><span class="light">BIC/SWIFT:</span> <?= $infoUser_bic ?></p>
                        <?php elseif ($dones_boutiqueGagnants['type'] == 'Skrill'): ?>
                        <p><span class="light">Email:</span> <?= $infoUser_skrill ?></p>
                        <?php elseif ($dones_boutiqueGagnants['type'] == 'Paypal'): ?>
                        <p><span class="light">Email:</span> <?= $infoUser_paypal ?></p>
                        <?php endif; ?>
                    </div>
                    <div  style='width:20vh'>
                        <p class="price"><?= displayMontant($dones_boutiqueGagnants['montant'], 2, ' €'); ?></p>
                    </div>
                    <div style='width:20vh'>
                        <form method="post">
                            <?php if ($dones_boutiqueGagnants['categorie'] != 'Paiement'):?>
                            <input type="text" name="code" placeholder="Entrez le code ici">
                            <?php endif; ?>
                            <button name="submit_valider" value="<?= $dones_boutiqueGagnants['id'] ?>" class="button primary display-inline-block">Valider</button>
                            <button name="submit_refuser" value="<?= $dones_boutiqueGagnants['id'] ?>" class="button tertiary display-inline-block">Refuser</button>
                      
                        </form>
                    </div>
                </div>
                <!-- /PURCHASE ITEM -->
                <?php endforeach; ?>
            </div>
            <!-- /PURCHASES LIST -->

<?php
	include('./requiert/inc-footer.php');
?>