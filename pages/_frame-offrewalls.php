<?php
include './requiert/bddConnect.php';
$hashId = $mbreHashId . '-' . date('YmdH');

$dataOffers = new SimpleXMLElement($_ROOT . "/files/offrewalls.xml", NULL, TRUE);
$offers = $dataOffers->offer;
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
                                <h5 class="mb-0">Offrir des murs</h5>
                            </div>
                            <hr class="m-0">
                        </div>
                        <div>
                            <div class="row">
                                <?php
                                if (count($offers) > 0) {
                                    foreach ($offers as $key => $offer) {
                                        $link = $offer->link;
                                        if (strpos($link, "@HASHID") > -1) {
                                            $link = str_replace("@HASHID", $hashId, $link);
                                        } else {
                                            $link .= $hashId;
                                        }
                                        $offer->link = $link;
                                ?>
                                        <div class="col-xl-4 col-sm-6 mb-4">
                                            <div style="border-radius: 50px;" class="stor-card custom-card shadow-sm h-100" data-toggle="modal" data-target="#offrewall_<?php echo $offer->id; ?>">
                                                <div class="custom-card-image">
                                                    <a href="#">
                                                        <img style="border-radius: 15px;" class="img-fluid item-img" src="<?php echo $base_url . $offer->image; ?>">
                                                        <?php if ($offer->premimum) { ?>
                                                            <div class="member-plan"><span class="badge badge-gold">Primum Member</span></div>
                                                        <?php } ?>
                                                    </a>

                                                    <div class="button-g-btn button-g-btn-up">


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal -->
                                        <div class="modal fade" id="offrewall_<?php echo $offer->id; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title fs-4 " id="staticBackdropLabel"><?php echo $offer->name; ?></h6>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body p-0">
                                                        <iframe src="<?php echo $offer->link; ?>" name="<?php echo $offer->name; ?>" width="100%" class="border-0 d-block" style="height: 80vh"></iframe>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <div class="alert alert-danger text-center" role="alert">PAS DE RÉSULTATS!</div>
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