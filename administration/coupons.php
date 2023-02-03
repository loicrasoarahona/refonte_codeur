<?php
	include('./requiert/php-global.php');
	
	$meta_title = 'Panel d\'administration : Coupons | Quizzdeal.fr';
	$nomPage = 'coupons';

	include('./requiert/inc-head.php');
	include('./requiert/inc-header-navigation.php');
	include('./requiert/php-form/coupons.php');
    require_once("./requiert/utils.php");
    ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
?>
<!-- DASHBOARD BODY -->
<style>
.button {
    padding-left: 5px;
    margin-right: 10px;
    padding-right: 5px;
    margin-top: 10px;
}

select {
    -webkit-appearance: menulist;
}

select,
input,
textarea {
    color: #000;
    background-color: whitesmoke;
}
</style>
<div class="dashboard-body">
    <?php if (!isset($_GET['action'])):?>
    <!-- DASHBOARD CONTENT -->
    <div class="dashboard-content">
        <!-- HEADLINE -->
        <div class="headline statement primary">
            <h4>Administration des coupons</h4>
            <a href="coupons.php?action=add" class="button primary">Ajouter un coupon</a>
        </div>
        <!-- /HEADLINE -->

        <!-- TRANSACTION LIST -->
        <div class="transaction-list">
            <form method="post">
                <!-- TRANSACTION LIST HEADER -->
                <div class="transaction-list-header">
                    <div class="transaction-list-header-date admin-s1">
                        <p class="text-header small">Type</p>
                    </div>
                    <div class="transaction-list-header-author admin-s1">
                        <p class="text-header small">Nom</p>
                    </div>
                    <div class="transaction-list-header-item admin-s1">
                        <p class="text-header small">Date</p>
                    </div>
                    <div class="transaction-list-header-detail admin-s1">
                        <p class="text-header small">Etat</p>
                    </div>
                    <div class="transaction-list-header-code">
                        <p class="text-header small">Action</p>
                    </div>
                </div>
                <!-- /TRANSACTION LIST HEADER -->
                <?php
                $messagesParPage = 50;
                $retour_total = $pdo->query("SELECT COUNT(*) AS total FROM coupons");
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

                $offer = $pdo->query("SELECT * FROM coupons ORDER BY nom LIMIT ".$premiereEntree.", ".$messagesParPage."");
                $all_coupons = $offer->fetchAll(PDO::FETCH_ASSOC);?>
                <?php foreach ($all_coupons as $dones_couponss):?>
                <?php
                    //if ($dones_couponss['status'] == 1) { $dones_couponss['status'] = 'status'; $boutonstatus = '<a href="" class="m-r-5"><div class="display-inline-block button bg-red bg-red-hover color-white p-5-10 b-r-50 uppercase">Mettre en pause</div></a>'; } else if ($dones_couponss['status'] == 0) { $dones_couponss['status'] = 'Instatus'; $boutonstatus = '<a href="" class="m-r-5"><div class="display-inline-block button bg-green bg-green-hover color-white p-5-10 b-r-50 uppercase">Activer</div></a>'; }
                    if ($dones_couponss['actif'] == 1) {
                        $dones_couponss['actif'] = 'actif';
                        $boutonstatus = '<button name="desactive" value="'.$dones_couponss['id'].'" class="button secondary ">Pause</button>';
                    } else if ($dones_couponss['actif'] == 0) {
                        $dones_couponss['actif'] = 'Inactif';
                        $boutonstatus = '<button name="active" value="'.$dones_couponss['id'].'" class="button primary">Activer</button>';
                    }
                    ?>
                <!-- TRANSACTION LIST ITEM -->
                <div class="transaction-list-item" style="overflow: hidden;">
                    <div class="transaction-list-item-date admin-s1">
                        <p><?= $dones_couponss['typecoupon']; ?></p>
                    </div>
                    <div class="transaction-list-item-author admin-s1">
                        <p class="category primary">
                            <?= $dones_couponss['nom']; ?>
                        </p>
                    </div>

                    <div class="transaction-list-item-detail admin-s1">
                        <p><?= $dones_couponss['dateDebut']; ?> - <?= $dones_couponss['dateFin']; ?></p>
                    </div>
                    <div class="transaction-list-item-code">
                        <p><?= $dones_couponss['actif']; ?></p>
                    </div>
                    <div class="transaction-list-item-price flexy">
                        <?= $boutonstatus; ?>
                        <a href="coupons.php?action=update&id=<?= $dones_couponss['id']; ?>"
                            class="button secondary-dark">Modifier</a>
                    </div>
                </div>
                <!-- /TRANSACTION LIST ITEM -->
                <?php endforeach; ?>
            </form>
            <?php if ($pageActuelle != 1) { $page_p = ($pageActuelle - 1); ?><a
                href="<?= url_panel; ?>/coupons.php?page=<?php echo $page_p; ?>">
                <div class="button secondary cursor-pointer display-inline-block">Page précédente</div>
            </a><?php } else { ?><div class="button secondary-dark cursor-not-allowed display-inline-block">Page
                précédente</div><?php } ?>
            <?php if (($pageActuelle == 1 AND $nombreDePages > $pageActuelle) OR $nombreDePages > $pageActuelle) { $page_s = ($pageActuelle + 1); ?><a
                href="<?= url_panel; ?>/coupons.php?page=<?php echo $page_s; ?>">
                <div class="button secondary cursor-pointer display-inline-block" style="float : right;">Page suivante
                </div>
            </a><?php } else { ?><div class="button secondary-dark cursor-not-allowed display-inline-block"
                style="float : right;">Page suivante</div><?php } ?><div class="clear"></div>
        </div>
        <!-- /TRANSACTION LIST -->
    </div>
    <!-- DASHBOARD CONTENT -->
    <?php elseif ($_GET['action'] == 'add'):?>
    <!-- DASHBOARD CONTENT -->
    <div class="dashboard-content">
        <!-- HEADLINE -->
        <div class="headline buttons primary">
            <h4>Ajouter un coupon</h4>
            <a href="<?= url_panel; ?>/coupons.php" class="button mid-short primary">Retour</a>
        </div>
        <!-- /HEADLINE -->

        <!-- FORM BOX ITEMS -->
        <div class="form-box-items">
            <!-- FORM BOX ITEM -->
            <div class="form-box-item" style="width: 100%;">
                <h4>Ajouter un coupon</h4>
                <hr class="line-separator">

                <form id="profile-info-form" method="post" enctype="multipart/form-data">

                    <!-- INPUT CONTAINER -->
                    <div class="input-container">
                        <label for="typecoupon" class="rl-label required">Type de coupon</label>
                        <select name="typecoupon" id="typecoupon" placeholder="Entrez le type du coupon..." required>
                            <option value="coupon" selected="selected">Coupon Code</option>
                            <option value="printable">Printable Coupon</option>
                            <option value="discount">Online Discount/Sale</option>
                        </select>
                    </div>
                    <!-- /INPUT CONTAINER -->

                    <!-- INPUT CONTAINER -->
                    <div class="input-container">
                        <label for="nom" class="rl-label required">Nom du coupon</label>
                        <input type="text" id="nom" name="nom" value="<?= $post_nom; ?>"
                            placeholder="Entrez le nom du coupon..." required>
                    </div>
                    <!-- /INPUT CONTAINER -->

                    <!-- INPUT CONTAINER CATEGORIE-->
                    <?php $groupOffers = getGroupOffers($pdo) ?>
                    <div class="input-container">
                        <label for="" class="text-primary">Catégorie du coupon</label>
                        <select name="categorie" id="categorie">
                            <option value="0">Sélectionner une catégorie</option>
                            <?php foreach($groupOffers as $categorie) {
                        if($categorie['id'] == $categorie_id) continue; ?>
                            <option value="<?php echo $categorie['id'] ?>"><?php echo $categorie['nom'] ?></option>
                            <?php } ?>
                        </select>
                        <input type="text" id="nom_categorie" name="nom_categorie"
                            placeholder="Ou en créer une nouvelle">
                    </div>
                    <script>
                    $('#categorie').on('change', function() {
                        // console.log($(this).val());
                        if ($(this).val() > 0) {
                            $('#nom_categorie').attr('disabled', 'disabled');
                        } else {
                            $('#nom_categorie').removeAttr('disabled', 'disabled');
                        }
                    });
                    </script>
                    <!-- /INPUT CONTAINER -->

                    <!-- INPUT CONTAINER -->
                    <div class="input-container">
                        <label for="url" class="rl-label required">Url du coupon</label>
                        <input type="text" id="url" name="url" value="<?= $post_url; ?>"
                            placeholder="Entrez l'url du coupon..." required>
                    </div>
                    <!-- /INPUT CONTAINER -->

                    <!-- INPUT CONTAINER -->
                    <div class="input-container half">
                        <label for="code" class="rl-label required">Code du coupon</label>
                        <input type="text" id="code" name="code" placeholder="Le code du coupon"
                            value="<?= $post_code; ?>" required>
                    </div>
                    <!-- /INPUT CONTAINER -->

                    <!-- INPUT CONTAINER -->
                    <div class="input-container half">
                        <label for="pays" class="rl-label required">Pays acceptés</label>
                        <input type="text" id="pays" name="pays" placeholder="Exemple : FR BE"
                            value="<?= $post_pays; ?>" required>
                    </div>
                    <!-- /INPUT CONTAINER -->


                    <!-- INPUT CONTAINER -->
                    <div class="input-container">
                        <label for="description" class="rl-label">Description du coupon (Longue)</label>
                        <textarea id="description" name="description"
                            placeholder="Entrez une longue description (optionel)"><?= $post_description; ?></textarea>
                    </div>
                    <!-- /INPUT CONTAINER -->

                    <!-- INPUT CONTAINER -->
                    <div class="input-container half">
                        <label for="dateDebut" class="rl-label required">Début (Ex: 2018-04-01 18:00:00)</label>
                        <input type="text" id="dateDebut" name="dateDebut" value="<?= $post_dateDebutCoupon ?>"
                            required>
                    </div>
                    <!-- /INPUT CONTAINER -->

                    <!-- INPUT CONTAINER -->
                    <div class="input-container half">
                        <label for="dateFin" class="rl-label required">Fin (Ex: 2018-04-01 18:00:00)</label>
                        <input type="text" id="dateFin" name="dateFin" value="<?= $post_dateFinCoupon ?>" required>
                    </div>
                    <!-- /INPUT CONTAINER -->

                    <!-- INPUT CONTAINER -->
                    <div class="input-container">
                        <label for="description" class="rl-label">Image du coupon</label>
                        <input id="image" name="image" type="file" placeholder="Uploader une image" required
                            style="width: 100%;padding: 10px;border: 1px solid #ebebeb;">
                    </div>
                    <!-- /INPUT CONTAINER -->

                    <!-- /INPUT CONTAINER -->
                    <input type="hidden" name="id" value="new" />
                    <input type="submit" name="submit_add" class="button big dark" value="Ajouter le coupon">
                </form>
            </div>
            <!-- /FORM BOX ITEM -->
        </div>
        <!-- /FORM BOX -->
    </div>
    <!-- DASHBOARD CONTENT -->
    <?php elseif ($_GET['action'] == 'update'):?>
    <?php //Bloc req SQL pour le formulaire de modification
        $sqlMissions = $pdo->query("SELECT coupons.*, group_offers.nom as nom_categorie FROM coupons join group_offers on category_id=group_offers.id WHERE coupons.id = '".intval($_GET['id'])."'");
        $resultatMissions = $sqlMissions->fetch();
        $nomOffre = $resultatMissions['nom'];
        $categorie_id = $resultatMissions['category_id'];
        $nom_categorie = $resultatMissions['nom_categorie'];
        $urlOffre = $resultatMissions['url'];
        $descriptionOffre = $resultatMissions['description'];
        $paysOffre = $resultatMissions['pays'];
        $dateDebutCoupon = $resultatMissions['dateDebut'];
        $dateFinCoupon = $resultatMissions['dateFin'];
        $codecoupon = $resultatMissions['code'];
		$typecoupon = $resultatMissions['typecoupon'];
		$imagecoupon = $resultatMissions['image'];
       
        ?>
    <!-- DASHBOARD CONTENT -->
    <div class="dashboard-content">
        <!-- HEADLINE -->
        <div class="headline buttons primary">
            <h4>Modifier un coupon</h4>
            <a href="<?= url_panel; ?>/coupons.php" class="button mid-short primary">Retour</a>
        </div>
        <!-- /HEADLINE -->

        <!-- FORM BOX ITEMS -->
        <div class="form-box-items">
            <!-- FORM BOX ITEM -->
            <div class="form-box-item" style="width:100%;">
                <h4>Modifier un coupon</h4>
                <hr class="line-separator">

                <form id="profile-info-form" method="post" enctype="multipart/form-data">

                    <!-- INPUT CONTAINER -->
                    <div class="input-container">
                        <label for="typecoupon" class="rl-label required">Type de coupon</label>
                        <select name="typecoupon" id="typecoupon" placeholder="Entrez le type du coupon..." required>
                            <option value="coupon" <?= ($typecoupon=='coupon'?'selected="selected"':'') ?>>Coupon Code
                            </option>
                            <option value="printable" <?= ($typecoupon=='printable'?'selected="selected"':'') ?>>
                                Printable Coupon</option>
                            <option value="discount" <?= ($typecoupon=='discount'?'selected="selected"':'') ?>>Online
                                Discount/Sale</option>
                        </select>
                    </div>
                    <!-- /INPUT CONTAINER -->

                    <!-- INPUT CONTAINER -->
                    <div class="input-container">
                        <label for="nom" class="rl-label required">Nom du coupon</label>
                        <input type="text" id="nom" name="nom" value="<?= $nomOffre; ?>"
                            placeholder="Entrez le nom du coupon..." required>
                    </div>
                    <!-- /INPUT CONTAINER -->

                    <!-- INPUT CONTAINER CATEGORIE-->
                    <?php $groupOffers = getGroupOffers($pdo) ?>
                    <div class="input-container">
                        <label for="" class="text-primary">Catégorie du coupon</label>
                        <select name="categorie" id="categorie">
                            <option value="<?php echo $categorie_id ?>"><?php echo $nom_categorie ?></option>
                            <?php foreach($groupOffers as $categorie) {
                        if($categorie['id'] == $categorie_id) continue; ?>
                            <option value="<?php echo $categorie['id'] ?>"><?php echo $categorie['nom'] ?></option>
                            <?php } ?>
                        </select>
                        <input type="text" id="nom_categorie" name="nom_categorie"
                            placeholder="Ou en créer une nouvelle">
                    </div>
                    <script>
                    $('#categorie').on('change', function() {
                        // console.log($(this).val());
                        if ($(this).val() > 0) {
                            $('#nom_categorie').attr('disabled', 'disabled');
                        } else {
                            $('#nom_categorie').removeAttr('disabled', 'disabled');
                        }
                    });
                    </script>
                    <!-- /INPUT CONTAINER -->

                    <!-- INPUT CONTAINER -->
                    <div class="input-container">
                        <label for="code" class="rl-label required">Code du coupon</label>
                        <input type="text" id="code" name="code" value="<?= $codecoupon; ?>"
                            placeholder="Entrez le code du coupon..." required>
                    </div>
                    <!-- /INPUT CONTAINER -->

                    <!-- INPUT CONTAINER -->
                    <div class="input-container">
                        <label for="url" class="rl-label required">Url du coupon</label>
                        <input type="text" id="url" name="url" value="<?= $urlOffre; ?>"
                            placeholder="Entrez l'url du coupon..." required>
                    </div>
                    <!-- /INPUT CONTAINER -->

                    <!-- INPUT CONTAINER -->
                    <div class="input-container half">
                        <label for="dateDebut" class="rl-label required">Début (Ex: 2018-04-01 18:00:00)</label>
                        <input type="text" id="dateDebut" name="dateDebut" value="<?= $dateDebutCoupon ?>" required>
                    </div>
                    <!-- /INPUT CONTAINER -->

                    <!-- INPUT CONTAINER -->
                    <div class="input-container half">
                        <label for="dateFin" class="rl-label required">Fin (Ex: 2018-04-01 18:00:00)</label>
                        <input type="text" id="dateFin" name="dateFin" value="<?= $dateFinCoupon ?>" required>
                    </div>
                    <!-- /INPUT CONTAINER -->

                    <!-- INPUT CONTAINER -->
                    <div class="input-container">
                        <label for="description" class="rl-label">Description du coupon (Longue)</label>
                        <textarea id="description" name="description"
                            placeholder="Entrez une longue description (optionel)"><?= $descriptionOffre; ?></textarea>
                    </div>
                    <!-- /INPUT CONTAINER -->

                    <!-- INPUT CONTAINER -->
                    <div class="input-container half">
                        <label for="pays" class="rl-label required">Pays acceptés</label>
                        <input type="text" id="pays" name="pays" placeholder="Exemple : FR BE"
                            value="<?= $paysOffre; ?>" required>
                    </div>
                    <!-- /INPUT CONTAINER -->

                    <!-- INPUT CONTAINER -->
                    <div class="input-container">
                        <label for="description" class="rl-label">Image du coupon</label>
                        <input name="image" type="file" placeholder="Uploader une image"
                            style="width: 100%;padding: 10px;border: 1px solid #ebebeb;">
                    </div>
                    <!-- /INPUT CONTAINER -->
                    <div class="input-container">
                        <img class="img_coupon" src="<?= $imagecoupon; ?>">
                    </div>

                    <input type="submit" name="submit_upd" class="button big dark" value="Modifier le coupon">
                </form>
            </div>
            <!-- /FORM BOX ITEM -->
        </div>
        <!-- /FORM BOX -->
    </div>
    <!-- DASHBOARD CONTENT -->
    <?php endif; ?>
</div>
<!-- /DASHBOARD BODY -->

<?php
	include('./requiert/inc-footer.php');
?>