<?php
ob_start();
	include('./requiert/inc-head.php');
	include('./requiert/php-global.php');
    include('./requiert/php-form/missions.php');
	$meta_title = 'Panel d\'administration : Missions | cashbackreduction.com';
    $nomPage = 'missions';
	include('./requiert/inc-header-navigation.php');
 
?>
    <!-- DASHBOARD BODY -->
    <?php if (!isset($_GET['action'])):?>
        <!-- DASHBOARD CONTENT -->
            <nav class="navbar navbar-expand navbar-light bg-light mb-4">
                        <h4 class="text-primary" >Administration des missions</h4>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a href="<?= url_panel; ?>/missions.php?action=add" class="button btn-primary btn-icon-split">Ajouter un offre</a>
                            </li>
                        </ul>
            </nav>

                       <?php
                        if(isset($reponsError) && !empty($reponsError)){
                        ?>
                                <div class='alert alert-danger'>
                                        <?= $reponsError; ?>
                                </div>
                            <?php
                        }else if(isset($reponsConfirm ) && !empty($reponsConfirm)){
                            ?>
                            <div class='alert alert-success'>
                                    <?= $reponsConfirm; ?>
                            </div>
                        <?php
                        }
                        ?>

            <!-- TRANSACTION LIST -->
            <div class="transaction-list">
                <form method="post">
                    <!-- TRANSACTION LIST HEADER -->
                    <div class="transaction-list-header">
               
                    <div class="transaction-list-header-author admin-s1" style='width:40vh'>
                        <p class="text-header small">Nom de l'offre</p>
                    </div>
                    <div class="transaction-list-header-item admin-s1" style='width:25vh'>
                        <p class="text-header small">Utilisateur|Pays</p>
                    </div>
                    <div class="transaction-list-header-item admin-s1" style='width:15vh'>
                        <p class="text-header small">Rémunération</p>
                    </div>
                    <div class="transaction-list-header-detail admin-s1" style='width:10vh'>
                        <p class="text-header small">Etat</p>
                    </div>
                    <div class="transaction-list-header-code">
                        <p class="text-header small">Action</p>
                    </div>
                </div>
                    <!-- /TRANSACTION LIST HEADER -->
                    <?php
                $messagesParPage = 50;
                $retour_total = $pdo->query("SELECT COUNT(*) AS total FROM offers");
                $donnees_total = $retour_total->fetch();
                $total = $donnees_total['total'];
                $nombreDePages = ceil($total / $messagesParPage);

                if (isset($_GET['page'])) {
                    $pageActuelle = intval($_GET['page']);
                    if ($pageActuelle > $nombreDePages) {
                        $pageActuelle = $nombreDePages;
                    } } else {
                    $pageActuelle = 1;
                }

                $premiereEntree = ($pageActuelle - 1) * $messagesParPage;

                $offer = $pdo->query("SELECT * FROM offers ORDER BY nom LIMIT ".$premiereEntree.", ".$messagesParPage."");
                $all_offers = $offer->fetchAll(PDO::FETCH_ASSOC);?>
                    <?php foreach ($all_offers as $dones_offers):?>
                    <?php
                  
                  // var_dump($dones_offers);
                    if ($dones_offers['actif'] == 1) { 
                        $dones_offers['actif'] = 'Actif'; 
                        $boutonActif = '<a href="" class="m-r-5"><div class="display-inline-block button bg-red bg-red-hover color-white p-5-10 b-r-50 uppercase">Mettre en pause</div></a>'; 
                    } else if ($dones_offers['actif'] == 0) {
                        $dones_offers['actif'] = 'Inactif'; 
                        $boutonActif = '<a href="" class="m-r-5"><div class="display-inline-block button bg-green bg-green-hover color-white p-5-10 b-r-50 uppercase">Activer</div></a>'; }

                    if ($dones_offers['actif'] == "Actif") {
                        $dones_offers['actif'] = 'Actif';
                        $boutonActif = '<button name="desactive" value="'.$dones_offers['id'].'" style="margin:0.75vh 0.5vh" class="btn btn-warning ">Pause</button>';
                    } else if ($dones_offers['actif'] == "Inactif") {
                        $dones_offers['actif'] = 'Inactif';
                        $boutonActif = '<button name="active" value="'.$dones_offers['id'].'" style="margin:0.75vh 0.5vh" class="btn btn-warning ">Activer</button>';
                    }
                    ?>
                <!-- TRANSACTION LIST ITEM -->
                <div class="transaction-list-item" style="overflow: hidden;">
              
                    <div class="transaction-list-item-author admin-s1" style='width:40vh'>
                        <p class="category primary" style='padding: 0 1vh'>
                            <?= $dones_offers['nom']; ?>
                            <?php
                                if($dones_offers['premium'] == 1){
                                    echo '<span class="tertiary">PREMIUM</span>';
                                }
                            ?>
                            
                        </p>
                    </div>
                    <div class="transaction-list-item-item admin-s1" style='width:30vh'>
                        <p>
                            <?= $dones_offers['pays']; ?> 
                        </p>
                    </div>
                    <div class="transaction-list-item-detail admin-s1" style='width:10vh'>
                        <p><?= displayMontant($dones_offers['remuneration'], 2, ' €'); ?></p>
                    </div>
                    <div class="transaction-list-item-code" style='width:10vh'>
                        <p><?= $dones_offers['actif']; ?></p>
                    </div>
                    <div class="transaction-list-item-price flexy">
                        <?= $boutonActif; ?>
                        <a href="<?= url_panel; ?>/missions.php?action=update&id=<?= $dones_offers['id']; ?>" style="margin:0.75vh 0.5vh"  class="btn btn-primary">Modifier</a>
                    </div>
                </div>
                <!-- /TRANSACTION LIST ITEM -->
                <?php endforeach; ?>
                </form>
                <?php if ($pageActuelle != 1) { $page_p = ($pageActuelle - 1); ?>
                <a href="<?= url_panel; ?>/missions.php?page=<?php echo $page_p; ?>">
                <div class="btn btn-primary float-left">Page précédente</div></a>
                <?php 
                 } 
                ?>
                    <?php if (($pageActuelle == 1 AND $nombreDePages > $pageActuelle) OR $nombreDePages > $pageActuelle) 
                    { 
                        $page_s = ($pageActuelle + 1); 
                    ?>
                    <a href="<?= url_panel; ?>/missions.php?page=<?php echo $page_s; ?>">
                        <div class="btn btn-primary " style="float : right;">Page suivante</div>
                    </a>
                    <?php
                    } 
                    ?>
        </div>
        <!-- DASHBOARD CONTENT -->
    <?php elseif ($_GET['action'] == 'add'):?>
        <!-- DASHBOARD CONTENT -->
            <!-- HEADLINE -->

                        <?php
                        if(isset($reponsError) && !empty($reponsError)){
                        ?>
                                <div class='alert alert-danger'>
                                        <?= $reponsError; ?>
                                </div>
                            <?php
                        }else if(isset($reponsConfirm ) && !empty($reponsConfirm)){
                            ?>
                            <div class='alert alert-success'>
                                    <?= $reponsConfirm; ?>
                            </div>
                        <?php
                        }
                        ?>

            <nav class="navbar navbar-expand navbar-light bg-light mb-4">
                        <h4 class="text-primary" > Ajouter une mission</h4>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a href="<?= url_panel; ?>/missions.php" class="button btn-primary btn-icon-split">Retour</a>
                            </li>
                        </ul>
            </nav>
            <!-- /HEADLINE -->
            <!-- FORM BOX ITEMS -->
            <div class="form-box-items">
                <!-- FORM BOX ITEM -->
                <div class="form-box-item">
                    <hr class="line-separator">

                    <form id="profile-info-form" method="post" enctype="multipart/form-data">
                        <!-- INPUT CONTAINER -->
                        <div class="input-container ">
                            <label for="nom" class="text-primary">Nom de l'offre</label>
                            <input type="text" id="nom" name="nom" value="<?= $post_nom; ?>" placeholder="Entrez le nom de l'offre..." required>
                        </div>
                        <!-- /INPUT CONTAINER -->


                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <label for="description1" class="text-primary">Description de l'offre</label>
                            <input type="text" id="description1" name="description" placeholder="Entrez une courte description (optionel)" value="<?= $post_description; ?>">
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container ">
                            <label for="remuneration" class="text-primary">Rémunération aux membres</label>
                            <input type="number" step="0.01" min="0.01" id="remuneration" name="remuneration" placeholder="0,01" value="<?= $post_remuneration; ?>" required>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container ">
                            <label for="pays" class="text-primary">Pays acceptés</label>
                            <input type="text" id="pays" name="pays" placeholder="Exemple : FR BE" value="<?= $post_pays; ?>" required>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container ">
                            <label for="premium" class="text-primary">Premium</label>
                            <label for="premium" class="select-block">
                                <select name="premium" id="premium">
                                    <option value="0">Non</option>
                                    <option value="1">Oui</option>
                                </select>
                                <!-- SVG ARROW -->
                                <svg class="svg-arrow">
                                    <use xlink:href="#svg-arrow"></use>
                                </svg>
                                <!-- /SVG ARROW -->
                            </label>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container ">
                            <label for="valid" class="text-primary">Validation directe (0 = non | 1 = oui)</label>
                            <input type="number" min="0" max="1" id="valid" name="valid" placeholder="0" value="<?= $post_valid; ?>" required>
                        </div>
                        <!-- /INPUT CONTAINER -->
                        <div class="input-container ">

                        <div id='form'></div>
                        <div class='btn btn-primary'  onclick='add()' >
                            Ajouter un Lien</button>
                        </div>
                        
                        <script>
                        
                            function add(){
                                var input = document.createElement("input");
                           
                                input.type = "text";
                                input.className = "form-control";
                                input.placeholder = "Lien ";
                                input.name="Link[ ]"
                                document.getElementById("form").append(input);
                            }
                        
                        </script>

                        <!-- INPUT CONTAINER -->
                        <div class="input-container ">
                            <label for="montant" class="text-primary">Rémunération sur régie</label>
                            <input type="number" step="0.01" min="0.01" id="montant" name="montant" placeholder="0,01" value="" required>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <label for="imageMission" class="text-primary">Image de la mission</label>
                            <input id="image" name="imageMission" type="file" placeholder="Uploader une image" required style="width: 100%;padding: 10px;border: 1px solid #ebebeb;">
                        </div>
                        <!-- /INPUT CONTAINER -->
                        <input type="hidden" name="idoffre" value="new"/>
                        <input type="submit" name="submit_add" class="button  btn-primary btn-icon-split" value="Ajouter la mission">
                    </form>
        <!-- DASHBOARD CONTENT -->
    <?php elseif ($_GET['action'] == 'update'):?>
        <?php //Bloc req SQL pour le formulaire de modification
            $sqlMissions = $pdo->query("SELECT * FROM offers WHERE id = '".intval($_GET['id'])."'");
            $resultatMissions = $sqlMissions->fetch();
            $nomOffre = $resultatMissions['nom'];
            $urlOffre = $resultatMissions['url'];
            $descriptionOffre = $resultatMissions['description'];
            $paysOffre = $resultatMissions['pays'];
            $remunerationOffre = $resultatMissions['remuneration'];
            $validOffre = $resultatMissions['valid'];
            $quotaOffre = $resultatMissions['quota'];
            $premiumOffre = $resultatMissions['premium'];
            $imageMission = $resultatMissions['image'];
        ?>
        <!-- DASHBOARD CONTENT -->
            <!-- HEADLINE -->
            <nav class="navbar navbar-expand navbar-light bg-light mb-4">
                        <h4 class="text-primary" > Modifier une mission</h4>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a href="<?= url_panel; ?>/missions.php" class="button btn-primary btn-icon-split">Retour</a>
                            </li>
                        </ul>
            </nav>
            <!-- /HEADLINE -->
           
            <!-- FORM BOX ITEMS -->
       
                <!-- FORM BOX ITEM -->
                        <?php
                        if(isset($reponsError) && !empty($reponsError)){
                        ?>
                                <div class='alert alert-danger'>
                                        <?= $reponsError; ?>
                                </div>
                            <?php
                        }else if(isset($reponsConfirm ) && !empty($reponsConfirm)){
                            ?>
                            <div class='alert alert-success'>
                                    <?= $reponsConfirm; ?>
                            </div>
                        <?php
                        }
                        ?>

                        <div class="input-container">
                            <center>
                                <img class="img_cashback" style='width:30vh' src="<?= $imageMission; ?>">
                            </center>
                        </div>

                    <form id="profile-info-form" method="post" enctype="multipart/form-data">
                        <!-- INPUT CONTAINER -->
                            <label for="nom" class="text-primary">Nom de l'offre</label>
                            <input type="text" id="nom" name="nom" value="<?= $nomOffre; ?>" placeholder="Entrez le nom de l'offre..." required>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                            <label for="descriptio1" class="text-primary">Description de l'offre</label>
                            <input type="text" id="description1" name="description"
                             placeholder="Entrez une courte description (optionel)" value="<?= $descriptionOffre; ?>">

                        <!-- INPUT CONTAINER -->
                            <label for="remuneration" class="text-primary">Rémunération aux membres</label>
                            <input type="number" step="0.01" min="0.01" id="remuneration" name="remuneration" placeholder="0,01" value="<?= $remunerationOffre; ?>" required>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                            <label for="pays" class="text-primary">Pays acceptés</label>
                            <input type="text" id="pays" name="pays" placeholder="Exemple : FR BE" value="<?= $paysOffre; ?>" required>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                            <label for="premium" class="text-primary">Premium</label>
                            <label for="premium" class="select-block">
                                <select name="premium" id="premium">
                                    <option value="0"<?php if ($premiumOffre == 0) echo ' selected'; ?>>Non</option>
                                    <option value="1"<?php if ($premiumOffre == 1) echo ' selected'; ?>>Oui</option>
                                </select>
                                <!-- SVG ARROW -->
                                <svg class="svg-arrow">
                                    <use xlink:href="#svg-arrow"></use>
                                </svg>
                                <!-- /SVG ARROW -->
                            </label>
                        <!-- /INPUT CONTAINER -->
                        <div id='form'>
                            <?php

                                $a= explode(',',$resultatMissions['url']);

                                for($i=0;$i < count($a);$i++){
                                    echo '<input type="text" name="Link[ ]" value="'.$a[$i].'" />';
                                }
                            
                            ?>
                        </div>
                        <div class='btn btn-primary'  onclick='add()' >
                        Ajouter un Lien</button>
                        </div>
                        <br/>
                        <script>
                        
                            function add(){
                                var input = document.createElement("input");
                           
                                input.type = "text";
                                input.className = "form-control";
                                input.placeholder = "Lien ";
                                input.name="Link[ ]"
                                document.getElementById("form").append(input);
                            }
                        
                        </script>

                        <!-- INPUT CONTAINER -->
                            <label for="valid" class="text-primary">Validation directe (0 = non | 1 = oui)</label>
                            <input type="number" min="0" max="1" id="valid" name="valid" placeholder="0" value="<?= $validOffre; ?>" required>
                        <!-- /INPUT CONTAINER -->


                        <!-- INPUT CONTAINER -->
                            <label for="imageMission" class="text-primary">Image de la mission</label>
                            <input id="image" name="imageMission" type="file" placeholder="Uploader une image" style="width: 100%;padding: 10px;border: 1px solid #ebebeb;">
                        <!-- /INPUT CONTAINER -->
                      
                        <!-- /INPUT CONTAINER -->
                        <input type="submit" name="submit_upd" class="button btn-primary btn-icon-split" value="Modifier la mission">
                    </form>
                <!-- /FORM BOX ITEM -->
        <!-- DASHBOARD CONTENT -->
    <?php endif; ?>
    <!-- /DASHBOARD BODY -->

<?php
	include('./requiert/inc-footer.php');
?>