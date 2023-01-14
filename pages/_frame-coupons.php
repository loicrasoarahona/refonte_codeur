<?php
$messagesParPage = 50;
if (isset($_POST['submit_recherche'])){
    $retour_total = $pdo->query("SELECT COUNT(*) AS total FROM coupons WHERE actif = 1 AND nom LIKE ('%".$_POST['search']."%')");
}else{
  $retour_total = $pdo->query("SELECT COUNT(*) AS total FROM coupons WHERE actif = 1");  
}
$donnees_total = $retour_total->fetch();
$total = $donnees_total['total'];
$nombreDePages = ceil($total / $messagesParPage);

if (isset($_GET['p'])) {
    $pageActuelle = intval($_GET['p']);
    if ($pageActuelle > $nombreDePages) {
        $pageActuelle = $nombreDePages;
    }
} else {
    $pageActuelle = 1;
}

$premiereEntree = ($pageActuelle - 1) * $messagesParPage;

$_POST["grp"] = trim($_POST["grp"]);
$grp_filtre = (!empty($_POST["grp"]) && $_POST["grp"] != "all") ? " category_id = '" . addslashes($_POST["grp"]) . "' AND " : "";

if (isset($_POST['submit_recherche'])){
    $sql_coupons = "
        SELECT C.*, GOF.nom AS nom_g FROM coupons C
        LEFT JOIN group_offers GOF ON GOF.id = C.category_id
        WHERE " . $grp_filtre . " actif = 1 AND C.nom LIKE ('%".$_POST['search']."%') ORDER BY STR_TO_DATE(dateDebut,'%d/%m/%Y à %H:%i') DESC LIMIT " . $premiereEntree . ", " . $messagesParPage . "";
}else{
    $sql_coupons = "
        SELECT C.*, GOF.nom AS nom_g FROM coupons C
        LEFT JOIN group_offers GOF ON GOF.id = C.category_id
        WHERE actif = 1 ORDER BY STR_TO_DATE(dateDebut,'%d/%m/%Y à %H:%i') DESC LIMIT " . $premiereEntree . ", " . $messagesParPage . "";
}
?>

<section class="user-panel-body py-5">
    <div class="container">
        <div class="row">
            <?php include "include/leftmenu.php"; ?>
            <div class="col-xl-9 col-sm-8">
                <div class="user-panel-body-right">
                    <div id="mc" class="user-panel-tab-view mb-4">
                        <div class="shadow-sm rounded overflow-hidden mb-3">
                            <div class="p-4 bg-white">
                                <h5 class="mb-0">Coupons</h5>
                            </div>
                            <hr class="m-0">
                            <div class="page-title-h5 align-items-center">
                                <form action="" method="post" name="filtre">
                                    <input type="hidden" name="submit_recherche" value="1">
                                    <div class="row m-3">
                                        <div class="col-sm-6">
                                            <div class="js-form-message">
                                                <div class="form-group">
                                                    <input type="text" class="has-validation form-control" name="search" value="<?php echo $_POST['search']; ?>" placeholder="Rechercher...">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="js-form-message">
                                                <div class="form-group">
                                                    <select class="form-control grp-add" name="grp">
                                                        <option value="all" <?php if ($_POST["grp"] == "all"){ echo "selected"; } ?>>Catégorie</option>
                                                        <?php
                                                        $grp = $pdo->query("SELECT id, nom FROM group_offers");
                                                        
                                                        foreach($grp->fetchAll(PDO::FETCH_ASSOC) as $group){
                                                            $cheked = "";
                                                            if($group["id"] == $_POST["grp"]){
                                                                $cheked = "selected";
                                                            }
                                                            echo '<option '.$cheked.' value="'.$group["id"].'">'.$group["nom"].'</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="submit" class="btn btn-sm btn-primary " value="Rechercher">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div>

                            <div class="row">
                                <?php
                                $debits = $pdo->prepare($sql_coupons);
                                $debits->execute();
                                $all_debits = $debits->fetchAll(PDO::FETCH_ASSOC);

                                if (count($all_debits) > 0)
                                {
                                    foreach ($all_debits as $dones_debits)
                                    {
                                        $boutique_image="images/".$dones_debits["image"];

                                        $idCoupon = $dones_debits["id"];
                                        $image = $dones_debits["image"];
                                        $nom = $dones_debits["nom"];
                                        $description = $dones_debits["description"];
                                        $shortDescription = substr($description, 0, 20) . "...";
                                        $dateFin = strtotime($dones_debits["dateFin"]);
                                        $code = $dones_debits["code"];
                                        $grp = $dones_debits["nom_g"];
                                        $link = $dones_debits["url"];
                                        ?>
                                        <div class="col-xl-4 col-sm-6 mb-4">
                                            <div class="custom-card shadow-sm h-100" data-toggle="modal" data-target="#coupon_<?php echo $idCoupon; ?>">
                                                <div class="custom-card-image">
                                                    <a href="#">
                                                        <img class="img-fluid item-img" src="<?php echo $base_url . $image; ?>">
                                                    </a>
                                                    <div class="button-g-btn button-g-btn-up">
                                                        <img class="img-fluid" src="<?php echo $base_url . $image; ?>">
                                                        <span><?php echo $nom; ?></span>
                                                    </div>
                                                </div>
                                                <div class="p-3 pt-4">
                                                    <div class="custom-card-body">
                                                        <h6 class="mb-3"><a class="text-black" href="#"><?php echo $shortDescription; ?></a></h6>
                                                        <p class="text-gray"><i class="icofont-clock-time"></i> <?php echo dateToFrench($dateFin,"l, d F à h:i");?></p>
                                                        <p class="text-gray mb-1"><i class="icofont-tag"></i> <?php echo $grp; ?></p>
                                                    </div>
                                                    <div class="custom-card-footer mb-2">
                                                        <a class="btn btn-orange float-right mb-2" href="#" data-toggle="modal" data-target="#coupon_<?php echo $idCoupon; ?>">Obtenir le Code</a>
                                                        <!-- <span class="text-primary"><i class="icofont-sale-discount"></i><?php echo $lc_data['val']; ?><?php echo $lc_data['currency']; ?></span> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal -->
                                        <div class="modal fade" id="coupon_<?php echo $idCoupon; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">

                                                        <h4 class="modal-title fs-5" id="staticBackdropLabel"><?php echo $nom; ?></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-xl-3 col-md-4 col-sm-12">
                                                                <img class="mb-3 user-cou-img w-100" src="<?php echo $base_url . $image; ?>" alt="<?php echo $nom; ?>">
                                                            </div>
                                                            <div class="col-xl-9 col-md-8 col-sm-12">
                                                                <div class="row">
                                                                    <div class="col-xl-12 col-md-12 col-sm-12">
                                                                        <h6 class="d-block"><?php echo $nom; ?></h6>

                                                                        <?php echo $description; ?>
                                                                    </div>
                                                                    <div class="input-group border-primary col-xl-6 col-md-5 col-sm-12 my-3">
                                                                        <abrd>COPIER CE CODE ET L’UTILISER À LA PAIEMENT</abrd>
                                                                        <input type="text" class="form-control" value="<?php echo $code; ?>" readonly>
                                                                        <div class="input-group-append copy">
                                                                            <span class="btn btn-outline-secondary"><i class="icofont-ui-copy"></i> Copier</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="text-success text-blod col-xl-12 col-md-12 col-sm-12" role="alert">
                                                                        En passant via MAXICONCOUR vous retoucher <span class="badge badge-success"><?php echo "0.00€"; ?></span> sur vos achats effectués sur &laquo; <?php echo $nom; ?> &raquo;
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <a class="btn btn-secondary" data-dismiss="modal">Fermer</a>
                                                        <a href="<?php echo $link; ?>" class="btn btn-primary">J'en profite</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                    <div class="col-xl-12 col-md-12 col-sm-12">
                                        <div class="alert alert-danger text-center rounded-pill" role="alert">PAS DE RÉSULTATS!</div>
                                    </div>
                                    <?php 
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>