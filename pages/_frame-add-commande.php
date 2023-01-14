<?php

include_once($_ROOT . '/requiert/php-form/boutique.php');

?>

<section class="user-panel-body py-5">
    <div class="container">
        <div class="row">
            <?php include "include/leftmenu.php"; ?>

            <div id="admin-section" class="col-xl-9 col-sm-8">
                <div id="mc_commande" class="bg-white shadow-sm mb-4">
                    <div class="row">
                        <div class="col-md-12 mb-4">

                            <div class="p-0">
                                <span class="btn btn-success float-right m-3 mr-4"> <i class="icofont-money-bag"></i> <?php echo displayMontant($mbreEuros, 2, ' €'); ?></span>
                                <h5 class="mb-0 p-4">
                                    Le paiement
                                </h5>
                            </div>
                            <hr class="m-0">

                            <form action="" method="POST" class="js-validate" multiple="" enctype="multipart/form-data" >
                                <div class="p-4">
                              
                                        <?php
								
                                        if($mbreEuros < "10")
										{
                                            ?>
                                            <div class="alert alert-warning alert-dismissible" role="alert">
                                                <h3> Solde insuffisant. </h3>
                                                <strong>Vous devez avoir minimun 10 € Pour effectuez un virement</strong>
                                            </div>
                                            <?php
                                        }
                                        elseif (!empty($_POST["commander"]))
                                        {
                                            if (!empty($reponsConfirm))
                                            {
                                                ?>
                                                <div class="alert alert-success alert-dismissible text-center rounded-pill" role="alert">
                                                    <strong><?php echo $reponsConfirm; ?></strong>
                                                </div>
                                                <?php
                                            }
                                            elseif ($reponsError)
                                            {
                                                ?>
                                                <div class="alert alert-danger alert-dismissible text-center rounded-pill" role="alert">
                                                    <strong><?php echo $reponsError; ?></strong>
                                                </div>
                                                <?php
                                            }
                                        }
                                   
                                    ?>
                                    <div class="row">

                                        <div class="col-sm-6">
                                            <div class="js-form-message">
                                                <label id="emailLabel" class="form-label">
                                                    Type versement
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="form-group">
                                                    <select class="form-control select-store-id" required="required" name="idBoutique">
                                                        <option value="" selected>--- Type du versement ---</option>
                                                        <?php
                                                        $boutique = $pdo->query("SELECT * FROM boutique WHERE actif = 1 ORDER BY id");
                                                        $all_boutique = $boutique->fetchAll(PDO::FETCH_ASSOC);

                                                        foreach ($all_boutique as $dones_boutique): ?>
                                                            <option value="<?= $dones_boutique["id"]; ?>"><?php echo $dones_boutique["nom"]; ?></option>
                                                            <?php
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="js-form-message">
                                                <label id="emailLabel" class="form-label">
                                                    Votre montant
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="has-validation form-control" name="idBoutiqueMontant" value="" placeholder="Montant">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <p class="">
                                                Vous devez avoir minimun 10 € Pour effectuez un virement
                                            </p>
                                        </div>
                                    </div>

                                    <div class="mb-0 pt-4 text-right">
                                        <a href="<?php echo $base_url;?>commandes" class="btn btn-outline-secondary mr-2"> Voir les commandes </a>
                                        <?php
                                        if($mbreEuros >= "10")
                                        {
                                            ?>
                                            <input type="hidden" name="commander" value="1">
                                            <button type="submit" class="btn btn-primary"> Commander </button>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>