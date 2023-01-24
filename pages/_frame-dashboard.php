<?php
$user_id = $_SESSION['id'];

if (!isset($_SESSION['id'])) {
    header('Location: ' . $base_url);
    exit;
}

$post_reg_mdp = addslashes(htmlentities("123"));

$totalMissions = $pdo->query("SELECT COUNT(id) AS 'id' FROM offers WHERE actif = 1");
$totalMissions = $totalMissions->fetch(PDO::FETCH_ASSOC);
$totalMissions = $totalMissions['id'];

$idUSer = $pdo->query("SELECT * FROM  users WHERE id='" . $_SESSION['id'] . "'");
$idUSer = $idUSer->fetch(PDO::FETCH_ASSOC);
$idUSer = $idUSer['hashId'];

$totalMissionsValide = $pdo->query("SELECT SUM(remuneration) AS 'remuneration' FROM histo_offers WHERE idUser = '" . $mbreHashId . "' AND etat = 'Valid&eacute;'");
$totalMissionsValide = $totalMissionsValide->fetch(PDO::FETCH_ASSOC);
$totalMissionsValide = $totalMissionsValide['remuneration'];

$totalMissionsAttente = $pdo->query("SELECT SUM(remuneration) AS 'remuneration' FROM histo_offers WHERE idUser = '" . $mbreHashId . "' AND etat = 'En attente'");
$totalMissionsAttente = $totalMissionsAttente->fetch(PDO::FETCH_ASSOC);
$totalMissionsAttente = $totalMissionsAttente['remuneration'];

$totalFilleuls = $pdo->query("SELECT COUNT(id) AS 'id' FROM users WHERE idParrain = $mbreId AND actif = 1");
$totalFilleuls = $totalFilleuls->fetch(PDO::FETCH_ASSOC);
$totalFilleuls = $totalFilleuls['id'];


$sql = "SELECT * FROM parrainage WHERE id = 1";
$req = $pdo->query($sql);
$par = $req->fetch(PDO::FETCH_ASSOC);

?>

<section class="user-panel-body py-5">
    <div class="container">
        <div class="row">
            <?php include "include/leftmenu.php"; ?>
            <div class="col-12 col-lg-9">
                <div class="user-panel-body-right">
                    <div id="mc" class="user-panel-tab-view mb-4">
                        <h5 class="mb-3"><i class="icofont-home"></i> Dashboard</h5>
                        <div class="row">
                            <div class="col-xl-4 col-sm-4">
                                <div class=" p-4 bg-white border-raduis shadow-sm mb-4  coin-pcard-block">
                                    <a href="<?php echo $base_url; ?>add-commande" class="btn btn-success float-right"> <i class="icofont-money-bag"></i> Retrait</a>
                                    <h5 class="">Gains valides</h5>
                                    <div>
                                        <h2 class=""><?php echo displayMontant($mbreEuros, 2, ' €'); ?></h2>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-sm-4 mr-0">
                                <div class=" p-4 bg-white border-raduis shadow-sm mb-4  coin-store-block">
                                    <a href="<?php echo $base_url; ?>traces" class="btn btn-danger float-right"> <i class="icofont-sub-listing"></i> Voir</a>
                                    <h5 class="">Gains en attentes</h5>
                                    <div>
                                        <h2 class=""><?php echo displayMontant($totalMissionsAttente, 2, ' €'); ?></h2>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-xl-4 col-sm-4 p-0 pr-3">
                            <div class=" p-4 bg-white border-raduis shadow-sm mb-4  coin-tiers-block">
                                <h5 class="">Gains reçu</h5>
                                <div>
                                    <h2 class=""><?php echo displayMontant($totalCommandeValide, 2, ' €'); ?></h2>
                                </div>
                            </div>
                        </div> -->
                            <div class="col-xl-4 col-sm-4">
                                <div class=" p-4 bg-white border-raduis shadow-sm mb-4  coin-badges-block">
                                    <h5 class="">Gains de filleuls</h5>
                                    <div>
                                        <h2 class=""><?php echo displayMontant($totalFilleuls, 2, ' €'); ?></h2><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="padding: 0px 20px">
                        <div class="col-md-12">
                            <div class="my-card row">
                                <div class="col-md-12">
                                    <h6 style="font-weight:550;display:flex;align-items:center;"><ion-icon name="people"></ion-icon>&nbsp;Systeme de parrainage</h6>
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1"><ion-icon name="link-outline"></ion-icon></span>
                                        <input type="text" value="<?= $base_url . '?parrain=' . $mbreId ?>" class="form-control" aria-describedby="basic-addon1">
                                        <span class="input-group-btn" id="basic-addon1"><a href="parrainage.php" class="btn btn-primary" type="button"><ion-icon name="share-social-outline"></ion-icon> Partager</a></span>
                                    </div>
                                    <h6 class="text-left pl-1 mt-2 mb-5" style="font-size: 15px; font-weight: normal;">Utilisez votre lien de reference pour inviter des amis et gagner des points.</h6>
                                </div>
                                <div class="col-md-12 rounded" style="border-left: 1px solid #f0f0f0; background:rgba(230,239,254,0.8);">
                                    <div class="row paid">
                                        <h6 class="text-center col-md-12 pt-3 mb-4" style="font-weight: 500;">Vous gagnez</h6>
                                        <br><br>
                                        <div class="col-md-4">
                                            <p class='text-center' style="font-size: 15px;">
                                                <b><?= $par['inscription']  ?> € </b> <span> <br>Bonus Inscription</span>
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <p class='text-center' style="font-size: 15px;"><b><?= $par['ami'] ?> € </b><span><br>Bonus Parrainage Ami</span> </p>
                                        </div>
                                        <div class="col-md-4">
                                            <p class='text-center' style="font-size: 15px;"><b><?= $par['commission'] ?> € </b> <span><br>Commission de renvoi</span> </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="container">
                        <div class="row">
                            <div id="user-section" class="col-xl-12 col-sm-12 p-0">
                                <div class="user-panel-body-right">
                                    <div class="user-panel-tab-view mb-4">
                                        <div class="shadow-sm rounded texte-left overflow-hidden mb-3 pl-3 pr-3">
                                            <div class="p-4 bg-white">
                                                <h5 class="mb-0">
                                                    <?php
                                                    if (!isset($_GET['p']) || $_GET['p'] == 'Mes participations') {
                                                        echo 'Mes participations';
                                                    } else {
                                                        echo 'Mes Activites shopping';
                                                    }
                                                    ?>
                                                </h5>
                                            </div>

                                            <?php
                                            if (!isset($_GET['p']) || $_GET['p'] == 'gains') {
                                                $sql = "SELECT * FROM histo_offers WHERE idUser='" . $idUSer . "' AND etat != 'En cours'  ORDER BY dateUsTime DESC  ";
                                                $req = $pdo->query($sql);
                                                $total = $req->fetchAll(PDO::FETCH_ASSOC);
                                            ?>
                                                <div class="row">
                                                    <div class="mb-4 col-xl-12 col-md-12 mb-12">
                                                        <div class="bg-white p-0 shadow-sm text-center h-100 border-radius">
                                                            <div class="table-responsive border-radius">
                                                                <table class="table m-0 table-hover table-striped table-bordered bt-0 border-radius">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col">DATE</th>
                                                                            <th scope="col">NOM</th>
                                                                            <th scope="col">GAIN</th>
                                                                            <th scope="col">ETAT</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php foreach ($total as  $categories) : ?>
                                                                            <tr>
                                                                                <th scope="row"><?= $categories['date']; ?></th>
                                                                                <td class="text-capitalize"><b style='color:green'><?= $categories['idt'] ?></b></th>
                                                                                <td class="text-capitalize"><?= displayMontant($categories['remuneration'], 2, ' €') ?></th>
                                                                                <th>
                                                                                    <center><?= Color(html_entity_decode($categories['etat'])) ?></center>
                                                                                </th>
                                                                            </tr>
                                                                        <?php endforeach; ?>
                                                                    </tbody>
                                                                </table>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</section>