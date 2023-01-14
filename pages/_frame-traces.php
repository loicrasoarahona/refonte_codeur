<?php
function trait_url($txt)
{
    return preg_replace(["`\s`", "`(\&eacute\;|\&eagrave\;)`"], ["-", "e"], $txt);
}

$totalMissions = $pdo->query("SELECT COUNT(id) AS 'id' FROM offers WHERE actif = 1");
$totalMissions = $totalMissions->fetch(PDO::FETCH_ASSOC);
$totalMissions = $totalMissions['id'];

$totalMissionsAttente = $pdo->query("SELECT COUNT(id) AS 'id' FROM histo_offers WHERE idUser = $mbreId AND etat = 'En cours'");
$totalMissionsAttente = $totalMissionsAttente->fetch(PDO::FETCH_ASSOC);
$totalMissionsAttente = $totalMissionsAttente['id'];

$totalFilleuls = $pdo->query("SELECT COUNT(id) AS 'id' FROM users WHERE idParrain = $mbreId AND actif = 1");
$totalFilleuls = $totalFilleuls->fetch(PDO::FETCH_ASSOC);
$totalFilleuls = $totalFilleuls['id'];

$totalCommandes = $pdo->query("SELECT COUNT(id) AS 'id' FROM gagnants WHERE idUser = $mbreId AND etat != 'Annulé'");
$totalCommandes = $totalCommandes->fetch(PDO::FETCH_ASSOC);
$totalCommandes = $totalCommandes['id'];

$messagesParPage = 10;
$retour_total = $pdo->query("SELECT COUNT(*) AS total FROM histo_offers WHERE idUser = '" . $mbreHashId . "' AND etat != 'Refus&eacute;' AND etat != 'En cours'");
$donnees_total = $retour_total->fetch();
$total = $donnees_total['total'];
$nombreDePages = ceil($total / $messagesParPage);

if (isset($_GET['p'])) { $pageActuelle = intval($_GET['p']); if ($pageActuelle > $nombreDePages) { $pageActuelle = $nombreDePages; } } else { $pageActuelle = 1; }

$premiereEntree = ($pageActuelle - 1) * $messagesParPage;

$sql_participation = "SELECT offerwall, idt, remuneration, date, etat FROM histo_offers WHERE idUser = '".$mbreHashId."' AND etat != 'En cours' ORDER BY STR_TO_DATE(date,'%d/%m/%Y à %H:%i') DESC LIMIT ".$premiereEntree.", ".$messagesParPage."";
?>

<section class="user-panel-body py-5">
    <div class="container">
        <div class="row">
            <?php include "include/leftmenu.php"; ?>

            <div id="user-section" class="col-xl-9 col-sm-8">
                <div class="user-panel-body-right">
                    <div class="user-panel-tab-view mb-4">
                        <div class="shadow-sm rounded texte-left overflow-hidden mb-3">
                            <div class="p-4 bg-white">
                                <h5 class="mb-0">Mes participations</h5>
                            </div>
                        </div>
                        <div>
                            <div class="row">
                                <div class="mb-4 col-xl-12 col-md-12 mb-12">
                                    <div class="bg-white p-0 shadow-sm text-center h-100 border-radius">
                                        <div class="table-responsive border-radius">
                                            <table class="table m-0 table-hover table-striped table-bordered bt-0 border-radius list-filtrable-table">
                                                <thead>
                                                <tr>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Description</th>
                                                    <th scope="col">Montant</th>
                                                    <th scope="col">Etat</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                    <?php

                                    $histoParticipations = $pdo->prepare($sql_participation);
                                    $histoParticipations->execute();

                                    $all_histoParticipations = $histoParticipations->fetchAll(PDO::FETCH_ASSOC);

                                    if (count($all_histoParticipations) > 0)
                                    {
                                        foreach ($all_histoParticipations as $data)
                                        {
                                            ?>
                                            <tr class="ln-filtrable">
                                                <td><?php echo $data["date"]; ?></td>
                                                <td><?php echo $data["idt"]; ?></td>
                                                <td><?php echo displayMontant($data["remuneration"],2,"€"); ?></td>
                                                <td>
                                                    <?= Color(html_entity_decode($data['etat'])) ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                            <tr>
                                                <td colspan="4">PAS DE RÉSULTATS!</td>
                                            </tr>
                                        <?php
                                    }
                                    ?>
                                                </tbody>
                                            </table>
                                            <div class="modal fade" id="traces" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title fs-5" id="staticBackdropLabel"></h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-left">

                                                        </div>
                                                        <div class="modal-footer">
                                                            <a class="btn btn-secondary" data-dismiss="modal">Fermer</a>
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
        </div>
    </div>
</section>