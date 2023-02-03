<?php
$meta_title = 'Maxiconcour.com : Les missions';
$meta_description = '';

$boutiqueByPage = 10;
$boutiquetotalReq = $e = $pdo->query("SELECT * FROM offers");
$boutiquetotal =  $boutiquetotalReq->rowCount();

if (!empty($_GET['p'])) {
    $_GET['p'] = intval($_GET['p']);
    $pageCourante = $_GET['p'];
} else {
    $pageCourante = 1;
}

$depart = ($pageCourante - 1) * $boutiqueByPage;

$a = $pdo->query("SELECT * FROM 
histo_offers 
WHERE 
idUser='" . $mbreHashId . "' AND
offerwall = 'Mission' AND
etat='Valid&eacute;'
");


$b = $pdo->query("SELECT * FROM 
histo_offers 
WHERE 
idUser='" . $mbreHashId . "' AND
offerwall = 'Mission' AND
etat='Refus&eacute;'
");

$p = $a->fetchAll();
$c = $b->fetchAll();

$Limit = ceil(count($p) / 4) - ceil(count($c) / 4) + 4;

if ($Limit <= 0) {
    $Limit = 1;
}
$details = json_decode(file_get_contents("http://ipinfo.io/" . ip . ""));
$country = $details->country;

if (isset($_GET['s'])) {

    $q = " O.nom LIKE '%" . $_GET['s'] . "%' AND";
} else {
    $q = "";
}

$_GET["grp"] = trim($_GET["grp"]);
$grp_filtre = (!empty($_GET["grp"]) && $_GET["grp"] != "all") ? " id_group = '" . addslashes($_GET["grp"]) . "' AND " : "";

$k = " pays LIKE '%" . $country . "%'";
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
                                <h5 class="mb-0">Missions</h5>
                            </div>
                            <hr class="m-0">
                            <div class="page-title-h5 align-items-center">
                                <form action="" method="get" name="filtre">
                                    <div class="row m-3">
                                        <div class="col-sm-6">
                                            <div class="js-form-message">
                                                <div class="form-group">
                                                    <input type="text" class="has-validation form-control" name="s"
                                                        value="<?php if (isset($_GET['s'])) {
                                                                                                                                echo $_GET['s'];
                                                                                                                            } ?>"
                                                        placeholder="Chercher une offre">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="js-form-message">
                                                <div class="form-group">
                                                    <select class="form-control grp-add" name="grp">
                                                        <option value="all" <?php if ($_GET["grp"] == "all") {
                                                                                echo "selected";
                                                                            } ?>>Catégorie</option>
                                                        <?php
                                                        $grp = $pdo->query("SELECT id, nom FROM group_offers");

                                                        foreach ($grp->fetchAll(PDO::FETCH_ASSOC) as $group) {
                                                            $cheked = "";
                                                            if ($group["id"] == $_GET["grp"]) {
                                                                $cheked = "selected";
                                                            }
                                                            echo '<option ' . $cheked . ' value="' . $group["id"] . '">' . $group["nom"] . '</option>';
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
                            <?php

                            $maxOffersPerAnnonceurPerDay = 5;

                            if ($mbrePremium == 1) {

                                $sql_offers = "
                                    SELECT O.*, GOF.nom AS nom_g
                                    FROM offers O
                                    LEFT JOIN group_offers GOF ON GOF.id = O.id_group
                                    WHERE $q $grp_filtre $k  AND actif= 1 AND  NOT EXISTS(
                                    SELECT * FROM favoris_mission WHERE idoffre=id_mission AND  id_user='" . $_SESSION['id'] . "'
                                  ) LIMIT $depart,$boutiqueByPage";
                            } else {

                                $sql_offers = "
                                    SELECT O.*, GOF.nom AS nom_g
                                    FROM offers O
                                    LEFT JOIN group_offers GOF ON GOF.id = O.id_group
                                    WHERE $q $grp_filtre $k  AND actif=1 AND premium= 0 AND  NOT EXISTS(
                                    SELECT * FROM favoris_mission WHERE idoffre=id_mission AND  id_user='" . $_SESSION['id'] . "'
                                  ) LIMIT $depart,$boutiqueByPage";
                            }

                            $offers = $pdo->prepare($sql_offers);
                            $offers->execute();

                            $all_offers = $offers->fetchAll(PDO::FETCH_ASSOC);

                            if ($offers->rowCount() > 0) {
                            ?>
                            <div class="col-md-12">
                                <div class="row">
                                    <?php
                                        $selected_offers = [];
                                        foreach ($all_offers as $dones_offers) {
                                            $id_line = $dones_offers['id'];
                                            $nom = $dones_offers['nom'];
                                            $image = $dones_offers['image'];
                                            $idoffre = $dones_offers['idoffre'];
                                            $description = $dones_offers['description'];
                                            $short_description = substr($description, 0, 30) . "...";
                                            $remuneration = $dones_offers['remuneration'];
                                            $quota = $dones_offers['quota'];
                                            $grpName = $dones_offers["nom_g"];

                                            $a = $pdo->query("SELECT * FROM 
                                    histo_offers 
                                    WHERE idUser='" . $mbreHashId . "' AND 
                                    data='" . $idoffre . "' AND
                                    ip='" . ip . "'");
                                            $p = $a->fetchAll(PDO::FETCH_ASSOC);

                                            if ($quota * 1 > count($p) || $quota * 1 == 0) {
                                        ?>
                                    <div class="col-xl-4 col-sm-6 mb-4">
                                        <div class="stor-card custom-card shadow-sm h-100">
                                            <div class="custom-card-image" data-toggle="modal"
                                                data-target="#offre_<?php echo $id_line; ?>">
                                                <a href="#">
                                                    <img class="img-fluid item-img" src="<?php echo $image; ?>">
                                                    <div class="member-plan">
                                                        <?php if ($dones_offers['premium'] == 1) { ?>
                                                        <span class="badge badge-gold">Membre Premium</span>
                                                        <?php } ?>
                                                        <span style="font-size: 1rem;" class="badge badge-gold"><i
                                                                class="icofont-money-bag"></i><?php echo displayMontant($remuneration, 2, '€'); ?></span>
                                                    </div>
                                                </a>

                                            </div>
                                            <div class="p-3 pt-2">
                                                <div class="custom-card-body">
                                                    <h3 style="font-size: 1rem;" class="text-gray">
                                                        <?php echo $nom; ?>
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade mission-modal"
                                        data-url="<?php echo $base_url . "redirect/" . $id_line . "/" . $quota; ?>"
                                        id="offre_<?php echo $id_line; ?>" data-backdrop="static" data-keyboard="false"
                                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div
                                            class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">

                                                    <h4 class="modal-title fs-5" id="staticBackdropLabel">
                                                        <?php echo $nom; ?></h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-xl-3 col-md-4 col-sm-12">
                                                            <img class="mb-3 user-cou-img w-100"
                                                                src="<?php echo $image; ?>" alt="<?php echo $nom; ?>">
                                                        </div>
                                                        <div class="col-xl-9 col-md-8 col-sm-12">
                                                            <div class="row">
                                                                <div class="col-xl-12 col-md-12 col-sm-12">
                                                                    <h6 class="d-block"><?php echo $nom; ?></h6>
                                                                    <?php echo $description; ?>
                                                                </div>

                                                                <div class="col-xl-12 col-md-12 col-sm-12 text-success text-blod mt-4"
                                                                    role="alert">
                                                                    <span
                                                                        class="badge badge-success"><?php echo displayMontant($remuneration, 2, ' €'); ?></span>
                                                                    Par Clic "CPC"
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <a class="btn btn-secondary" data-dismiss="modal">Fermer</a>
                                                    <div data-url="<?php echo $base_url . "redirect/" . $id_line . "/" . $quota; ?>"
                                                        target="_blank"
                                                        class="btn btn-primary text-white offer-participate"
                                                        data-id="<?php echo $id_line; ?>"
                                                        data-link="<?php echo $quota; ?>">Participer</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                            }
                                        }
                                        ?>
                                </div>
                            </div>
                            <?php
                            } else {
                            ?>
                            <div>
                                <div class="alert alert-danger rounded-pill text-center" role="alert">Aucune mission
                                    n'est disponible pour le moment !</div>
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
</section>