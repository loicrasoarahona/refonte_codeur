<?php
	include('./requiert/php-global.php');
	
	$meta_title = 'Panel d\'administration : Boutique | Quizzdeal.fr';
	$nomPage = 'boutique';

	include('./requiert/inc-head.php');
	include('./requiert/inc-header-navigation.php');
	include('./requiert/php-form/boutique.php');
?>

    <!-- DASHBOARD BODY -->
<?php if (!isset($_GET['action']))://Control de l'action?>
        <!-- DASHBOARD CONTENT -->
        <div class="dashboard-content">
            <!-- HEADLINE -->
            
            <nav class="navbar navbar-expand navbar-light bg-light mb-4">
                        <h4 class="text-primary" >
                        Administration boutique
                        </h4>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a href="<?= url_panel; ?>/boutique.php?action=addCategorie"  class="button btn-primary btn-icon-split">Ajouter un catégorie</a>
                            </li>
                        </ul>
            </nav>

            <!-- /HEADLINE -->

            <!-- FORM BOX ITEMS -->
            <div class="form-box-items">
            <?php // Bloc req SQL pour la prochaine boucle
                $boutiqueCategorie = $pdo->query("SELECT * FROM boutiquecategorie ORDER BY nom");
                $all_boutiqueCategorie = $boutiqueCategorie->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <?php foreach ($all_boutiqueCategorie as $dones_boutiqueCategorie)://Boucle des données catégories?>
                <?php //Bloc SQL
                $TotalCadeauxCategorie = $pdo->query("SELECT COUNT(id) as count FROM boutique WHERE categorieId = '".intval($dones_boutiqueCategorie['id'])."'");
                $TotalCadeauxCategorie = $TotalCadeauxCategorie->fetch();
                $TotalCadeauxCategorie = $TotalCadeauxCategorie['count'];
                ?>
                <!-- FORM BOX ITEM -->
                <div class="form-box-item withdraw-history admin-boutique">
                    <h4>
                        <span><?= $dones_boutiqueCategorie['nom']; ?></span>
                        <span>
                            <a href="<?= url_panel; ?>/boutique.php?action=addBoutique&idCat=<?= $dones_boutiqueCategorie['id']; ?>" class="btn btn-primary">Ajouter</a>
                            <?php $TotalCadeauxCategorie=0 ?>
                            <?php if ($TotalCadeauxCategorie == 0): ?>
                            <form method="post"><button type="submit" name="deleteCategorie" value="<?= $dones_boutiqueCategorie['id']; ?>" class="btn btn-danger" onclick="if (confirm('Êtes-vous sur de vouloir supprimer cette catégorie ?')){return true;}else{event.stopPropagation(); event.preventDefault();};">Supprimer</button></form>
                            <?php endif;//Condition TotalCadeauxCategorie ?>
                        </span>
                    </h4>
                    <hr class="line-separator">
                    <!-- TRANSACTION HISTORY -->
                    <div class="transaction-history">
                        <?php // Bloc req SQL pour la boucle boutique lots
                        $boutiqueLots = $pdo->query("SELECT * FROM boutique WHERE categorieId = '".intval($dones_boutiqueCategorie['id'])."' ORDER BY nom");
                        $all_boutiqueLots = $boutiqueLots->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        <?php foreach ($all_boutiqueLots as $dones_boutiqueLots)://Boucle des boutiques Lots?>
                        <!-- TRANSACTION HISTORY ITEM -->
                        <div class="transaction-history-item">

                            <div class="transaction-history-item-date">
                                <?= $dones_boutiqueLots['nom']; ?>
                            </div>
                            <?php // Bloc req SQL pour la boucle montant
                            $boutiqueLotsMontant = $pdo->query("SELECT * FROM boutiquemontant WHERE boutiqueId = '".intval($dones_boutiqueLots['id'])."' ORDER BY montant");
                            $all_boutiqueLotsMontant = $boutiqueLotsMontant->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                            <div class="transaction-history-item-mail">
                                <?php foreach ($all_boutiqueLotsMontant as $dones_boutiqueLotsMontant)://Boucle des boutiques LotsMontants?>
                                <form method="post">

                                    <button 
                                        type="submit" 
                                        name="deleteMontant" 
                                        value="<?= $dones_boutiqueLotsMontant['id']; ?>" 
                                        class="btn btn-danger "   
                                        onclick="if (confirm('Êtes-vous sur de vouloir supprimer ce montant ?')){return true;}else{event.stopPropagation(); 
                                        event.preventDefault();};"
                                        style='font-size:1.5vh;margin:1vh 0'
                                    >

                                        <?= displayMontant($dones_boutiqueLotsMontant['montant'], 2, ' €'); ?>
                                        <i class="fa fa-trash m-l-5"></i>

                                    </button>

                                </form>
                                <?php endforeach;//FIN Boucle des boutiques LotsMontants ?>
                            </div>
                            <div class="transaction-history-item-amount buttony">
                           
                                <a    href="<?= url_panel; ?>/boutique.php?action=addMontant&idBoutique=<?= $dones_boutiqueLots['id']; ?>">
                                    <div style='font-size:1.5vh;margin:1vh 0'  class="btn btn-primary">Ajouter</div>
                                </a>
                            </div>
                            <div class="transaction-history-item-amount buttony">
                                <a    href="<?= url_panel; ?>/boutique.php?action=updBoutique&idBoutique=<?= $dones_boutiqueLots['id']; ?>">
                                    <div style='font-size:1.5vh;margin:1vh 0'  class="btn btn-info">Modifier</div>
                                </a>
                            </div>
                            <div class="transaction-history-item-amount buttony">
                                <form method="post"><button type="submit"   style='font-size:1.5vh;margin:1vh 0'  name="deleteCadeau" value="<?= $dones_boutiqueLots['id']; ?>" class="btn btn-danger" onclick="if (confirm('Êtes-vous sur de vouloir supprimer ce cadeau ?')){return true;}else{event.stopPropagation(); event.preventDefault();};">Supprimer</button></form>
                            </div>
                        </div>
                        <?php endforeach;//FIN Boucle des boutiques Lots?>
                        <!-- /TRANSACTION HISTORY ITEM -->
                    </div>
                    <!-- /TRANSACTION HISTORY -->
                </div>
                <!-- /FORM BOX ITEM -->
            <?php endforeach;//FIN Boucle des données catégories ?>
            </div>
            <!-- /FORM BOX ITEMS -->
        </div>
        <!-- DASHBOARD CONTENT -->
<?php elseif ($_GET['action'] == 'addBoutique'): ?>
    <!-- DASHBOARD CONTENT -->
    <div class="dashboard-content">
        <!-- HEADLINE -->
        <nav class="navbar navbar-expand navbar-light bg-light mb-4">
                        <h4 class="text-primary" >Ajouter une Boutique</h4>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a href="<?= url_panel; ?>/boutique.php" class="button btn-primary">Retour</a>
                            </li>
                        </ul>
        </nav>
        <!-- /HEADLINE -->
        <!-- FORM BOX ITEMS -->
        <div class="form-box-items">
            <!-- FORM BOX ITEM -->
            <div class="form-box-item">
                <hr class="line-separator">
                <form id="profile-info-form" method="post">
                    <!-- INPUT CONTAINER -->
                    <div class="input-container">
                        <label for="nomCadeau"  class="text-primary">Nom du cadeau</label>
                        <input type="text" id="nomCadeau" name="nomCadeau" placeholder="Entrez le nom du cadeau..." value="<?= $post_nomCadeau; ?>">
                    </div>
                    <!-- /INPUT CONTAINER -->
                    <!-- INPUT CONTAINER -->
                    <div class="input-container">
                        <label for="imageCadeau" class="text-primary">Lien du cadeau</label>
                        <input type="text" id="imageCadeau" name="imageCadeau" placeholder="http://..." value="<?= $post_imageCadeau; ?>">
                    </div>
                    <!-- /INPUT CONTAINER -->
                    <input type="submit" name="submit_addCadeau" class="button btn-primary" value="Créé la cadeau">
                </form>
            </div>
            <!-- /FORM BOX ITEM -->
        </div>
        <!-- /FORM BOX -->
    </div>
    <!-- DASHBOARD CONTENT -->
<?php elseif ($_GET['action'] == 'addCategorie'):?>
    <!-- DASHBOARD CONTENT -->
    <div class="dashboard-content">
        <!-- HEADLINE -->
        <nav class="navbar navbar-expand navbar-light bg-light mb-4">
                        <h4 class="text-primary" >Ajouter une catégorie</h4>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a href="<?= url_panel; ?>/boutique.php" class="button btn-primary btn-icon-split">Retour</a>
                            </li>
                        </ul>
        </nav>
        <!-- /HEADLINE -->

        <!-- FORM BOX ITEMS -->
        <div class="form-box-items">
            <!-- FORM BOX ITEM -->
            <div class="form-box-item">
                <hr class="line-separator">

                <form id="profile-info-form" method="post">
                    <!-- INPUT CONTAINER -->
                    <div class="input-container">
                        <label for="nomCategorie" class="text-primary">Nom de la catégorie</label>
                        <input type="text" id="nomCategorie" name="nomCategorie" placeholder="Entrez une catégorie...">
                    </div>
                    <!-- /INPUT CONTAINER -->
                    <input type="submit" name="submit_addCategorie" class="button   btn-primary" value="Créé la catégorie">
                </form>
            </div>
            <!-- /FORM BOX ITEM -->
        </div>
        <!-- /FORM BOX -->
    </div>
    <!-- DASHBOARD CONTENT -->
<?php elseif ($_GET['action'] == 'updBoutique'):?>
    <?php
    $sqlCadeau = $pdo->query("SELECT * FROM boutique WHERE id = '".intval($_GET['idBoutique'])."'");
    $resultatCadeau = $sqlCadeau->fetch();
    $nomBoutique = $resultatCadeau['nom'];
    $imageBoutique = $resultatCadeau['image'];
    ?>
    <!-- DASHBOARD CONTENT -->
    <div class="dashboard-content">
        <!-- HEADLINE -->
        <div class="headline buttons primary">
            <h4>Modifier un cadeau</h4>
            <a href="<?= url_panel; ?>/boutique.php" class="button mid-short primary">Retour</a>
        </div>
        <!-- /HEADLINE -->

        <!-- FORM BOX ITEMS -->
        <div class="form-box-items">
            <!-- FORM BOX ITEM -->
            <div class="form-box-item">
                <h4>Modifier un cadeau</h4>
                <hr class="line-separator">

                <form id="profile-info-form" method="post">
                    <!-- INPUT CONTAINER -->
                    <div class="input-container">
                        <label for="nomCadeau" class="rl-label required">Nom du cadeau</label>
                        <input type="text" id="nomCadeau" name="nomCadeau" placeholder="Entrez le nom du cadeau..." value="<?= $nomBoutique; ?>">
                    </div>
                    <!-- /INPUT CONTAINER -->
                    <!-- INPUT CONTAINER -->
                    <div class="input-container">
                        <label for="imageCadeau" class="rl-label required">Lien du cadeau</label>
                        <input type="text" id="imageCadeau" name="imageCadeau" placeholder="http://..." value="<?= $imageBoutique; ?>">
                    </div>
                    <!-- /INPUT CONTAINER -->
                    <input type="submit" name="submit_updBoutique" class="button big dark" value="Créé la cadeau">
                </form>
            </div>
            <!-- /FORM BOX ITEM -->
        </div>
        <!-- /FORM BOX -->
    </div>
    <!-- DASHBOARD CONTENT -->
<?php elseif ($_GET['action'] == 'addMontant'):?>
    <!-- DASHBOARD CONTENT -->
    <div class="dashboard-content">
        <!-- HEADLINE -->
        <div class="headline buttons primary">
            <h4>Ajouter un montant</h4>
            <a href="<?= url_panel; ?>/boutique.php" class="button mid-short primary">Retour</a>
        </div>
        <!-- /HEADLINE -->

        <!-- FORM BOX ITEMS -->
        <div class="form-box-items">
            <!-- FORM BOX ITEM -->
            <div class="form-box-item">
                <h4>Ajouter un montant</h4>
                <hr class="line-separator">

                <form id="profile-info-form" method="post">
                    <!-- INPUT CONTAINER -->
                    <div class="input-container">
                        <label for="montantCadeau" class="rl-label required">Ajouter un montant</label>
                        <input type="text" id="montantCadeau" name="montantCadeau" placeholder="Entrez le montant..." value="<?= $post_nomCategorie; ?>">
                    </div>
                    <!-- /INPUT CONTAINER -->
                    <input type="submit" name="submit_addMontant" class="button big dark" value="Ajouter le montant">
                </form>
            </div>
            <!-- /FORM BOX ITEM -->
        </div>
        <!-- /FORM BOX -->
    </div>
    <!-- DASHBOARD CONTENT -->
<?php elseif ($_GET['action'] == 'update'):?>
    <?php
    $sqlMissions = $pdo->query("SELECT * FROM offers WHERE id = '".intval($_GET['id'])."'");
    $resultatMissions = $sqlMissions->fetch();
    $nomOffre = $resultatMissions['nom'];
    $urlOffre = $resultatMissions['url'];
    $descriptionOffre = $resultatMissions['description'];
    $paysOffre = $resultatMissions['pays'];
    $remunerationOffre = $resultatMissions['remuneration'];
    $montantOffre = $resultatMissions['montant'];
    $validOffre = $resultatMissions['valid'];
    $regieOffre = $resultatMissions['regie'];
    $annonceurOffre = $resultatMissions['annonceur'];
    $quotaOffre = $resultatMissions['quota'];
    ?>
    <!-- DASHBOARD CONTENT -->
    <div class="dashboard-content">
        <!-- HEADLINE -->
        <div class="headline buttons primary">
            <h4>Modifier une offre</h4>
            <a href="<?= url_panel; ?>/boutique.php" class="button mid-short primary">Retour</a>
        </div>
        <!-- /HEADLINE -->

        <!-- FORM BOX ITEMS -->
        <div class="form-box-items">
            <!-- FORM BOX ITEM -->
            <div class="form-box-item">
                <h4>Modifier une offre</h4>
                <hr class="line-separator">

                <form id="profile-info-form" method="post">
                    <!-- INPUT CONTAINER -->
                    <div class="input-container">
                        <label for="nom" class="rl-label required">Nom de l'offre</label>
                        <input type="text" id="nom" name="nom" placeholder="Entrez le nom de l'offre..." value="<?= $nomOffre ?>">
                    </div>
                    <!-- /INPUT CONTAINER -->

                    <!-- INPUT CONTAINER -->
                    <div class="input-container">
                        <label for="url" class="rl-label required">URL de l'offre</label>
                        <input type="text" id="url" name="url" placeholder="Entrez l'URL (Tracking : #IDM)..." value="<?= $urlOffre; ?>" required>
                    </div>
                    <!-- /INPUT CONTAINER -->

                    <!-- INPUT CONTAINER -->
                    <div class="input-container">
                        <label for="description" class="rl-label">Description de l'offre</label>
                        <input type="text" id="description" name="description" placeholder="Entrez courte une description..." value="<?= $descriptionOffre; ?>">
                    </div>
                    <!-- /INPUT CONTAINER -->
                    <!-- INPUT CONTAINER -->
                    <div class="input-container half">
                        <label for="url" class="rl-label required">Rémunération aux membres</label>
                        <input type="number" step="0.01" min="0.01" id="remuneration" name="remuneration" placeholder="0,01" value="<?= $remunerationOffre; ?>" required>
                    </div>
                    <!-- /INPUT CONTAINER -->

                    <!-- INPUT CONTAINER -->
                    <div class="input-container half">
                        <label for="pays" class="rl-label required">Pays acceptés</label>
                        <input type="text" id="pays" name="pays" placeholder="Exemple : FR BE..." value="<?= $paysOffre; ?>">
                    </div>
                    <!-- /INPUT CONTAINER -->

                    <!-- INPUT CONTAINER -->
                    <div class="input-container half">
                        <label for="valid" class="rl-label required">Validation directe (0 = non | 1 = oui)</label>
                        <input type="number" min="0" max="1" id="valid" name="valid" placeholder="0" value="<?= $validOffre; ?>" required>
                    </div>
                    <!-- /INPUT CONTAINER -->

                    <!-- INPUT CONTAINER -->
                    <div class="input-container half">
                        <label for="quota" class="rl-label required">Quota quotidien (0 = illimité)</label>
                        <input type="number" min="0" id="quota" name="quota" placeholder="0" value="<?= $quotaOffre; ?>" required>
                    </div>
                    <!-- /INPUT CONTAINER -->

                    <!-- INPUT CONTAINER -->
                    <div class="input-container half">
                        <label for="montant" class="rl-label required">Rémunération sur régie</label>
                        <input type="number" step="0.01" min="0.01" id="montant" name="montant" placeholder="0,01" value="<?= $montantOffre; ?>" required>
                    </div>
                    <!-- /INPUT CONTAINER -->

                    <!-- INPUT CONTAINER -->
                    <div class="input-container half">
                        <label for="pays" class="rl-label required">Pays acceptés</label>
                        <input type="text" id="pays" name="pays" placeholder="Exemple : FR BE..." value="<?= $paysOffre; ?>" required>
                    </div>
                    <!-- /INPUT CONTAINER -->

                    <!-- INPUT CONTAINER -->
                    <div class="input-container">
                        <label for="annonceur" class="rl-label required">Annonceur</label>
                        <input type="text" id="annonceur" name="annonceur" placeholder="Annonceur" value="<?= $annonceurOffre; ?>" required>
                    </div>
                    <!-- /INPUT CONTAINER -->
                    <input type="submit" name="submit_upd" class="button big dark" value="Modifier une offre">
                </form>
            </div>
            <!-- /FORM BOX ITEM -->
        </div>
        <!-- /FORM BOX -->
    </div>
    <!-- DASHBOARD CONTENT -->
<?php endif;//FIN Control de l'action ?>

    <!-- /DASHBOARD BODY -->



<?php
	include('./requiert/inc-footer.php');
?>