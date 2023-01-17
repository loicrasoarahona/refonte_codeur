	<?php
    $logoPartner = array(
        $img1 = ["image" => "wannads.png", "alt" => "wannads"],
        $img2 = ["image" => "adgatemedia.jpg", "alt" => "adgatemedia"],
        $image3 = ["image" => "offertoro.png", "alt" => "offertoro"],
        $image4 = ["image" => "MONLIX.png", "alt" => "Monlix"],
        $image5 = ["image" => "ayetstudios.jpg", "alt" => "ayetstudios"],
        $image6 = ["image" => "bitlabs.jpg", "alt" => "bitlabs"],
        $image7 = ["image" => "cpagrip.jpg", "alt" => "cpagrip"],
        $image8 = ["image" => "kiwiwall.jpg", "alt" => "kiwiwall"],
        $image9 = ["image" => "lootably.jpg", "alt" => "lootably"],
        $image10 = ["image" => "optimiads.jpg", "alt" => "optimiads"],
        $image11 = ["image" => "timewall.jpg", "alt" => "timewall"],
    );

    $imgProduct = array(
        $prod1 = ["produit" => "carrefour.jpg", "altProduit" => "carrefour"],
        $prod3 = ["produit" => "itunes.jpg", "altProduit" => "itunes"],
        $prod4 = ["produit" => "google-play.jpg", "altProduit" => "google-play"],
        $prod5 = ["produit" => "netflix.jpg", "altProduit" => "netflix"],
        $prod6 = ["produit" => "nintendo.jpg", "altProduit" => "nintendo"],
        $prod7 = ["produit" => "playstation-store.jpg", "altProduit" => "playstation-store"],
        $prod8 = ["produit" => "twitch.jpg", "altProduit" => "twitch"],
        $prod9 = ["produit" => "xbox-live.jpg", "altProduit" => "xbox-live"],
    )
    ?>
	<div class="container py-5">
	    <div class="row py-3">
	        <div class="col-lg-4 col-md-6 col-sm-12">
	            <img src="<?= $Innerurllink ?>/images/home-hand-smartphone.jpg" alt="home hand smartphone" class="img-fluid img-side-1">
	        </div>
	        <div class="col-lg-8 col-md-6 col-sm-12 py-5">
	            <p>
	                <span class="font-weight-bold text-warning">Maxiconcour</span> vous permet de gagner des cartes cadeaux de différentes manières : achetez sur vos boutiques préférées et retouchez une partie de vos achats (cashback), participez à des enquêtes, sondages et jeux concours, téléchargez et testez des applications mobile,... et bien plus encore.
	            </p>
	        </div>
	    </div>

	    <!-- membre -->

	    <div class="row py-2">
	        <div class="col-lg-4 col-md-4 col-sm-12">
	            <div class="row">
	                <div class="col-lg-6 col-md-6 col-sm-6">
	                    <div class="text-center">
	                        <img src="" alt="" srcset="">
	                    </div>
	                </div>
	                <div class="col-lg-6 col-md-6 col-sm-6">

	                    <p class="mb-0" style="font-size: 18px;">
	                        <span class="icofont-gift text-warning mr-2"></span>
	                        <span class="text-warning font-weight-bold"><?= displayMontant($totalAmountRevers, 2, ' €'); ?></span>
	                    </p>

	                    <p class="mb-0"> Cadeaux reversées </p>
	                </div>
	            </div>
	        </div>

	        <div class="col-lg-4 col-md-4 col-sm-12">
	            <div class="row">
	                <div class="col-lg-6 col-md-6 col-sm-6">
	                    <div class="text-center">
	                        <img src="" alt="" srcset="">
	                    </div>
	                </div>
	                <div class="col-lg-6 col-md-6 col-sm-6">
	                    <p class="mb-0" style="font-size: 18px;">
	                        <span class="icofont-users text-warning mr-2"></span>
	                        <span class="text-warning font-weight-bold"><?= $totalUsers ?></span>
	                    </p>

	                    <p class="mb-0">Membres inscrits</p>
	                </div>
	            </div>
	        </div>

	        <div class="col-lg-4 col-md-4 col-sm-12">
	            <div class="row">
	                <div class="col-lg-6 col-md-6 col-sm-6">
	                    <div class="text-center">
	                        <img src="" alt="" srcset="">
	                    </div>
	                </div>
	                <div class="col-lg-6 col-md-6 col-sm-6">
	                    <p class="mb-0" style="font-size: 18px;">
	                        <span class="icofont-users-social text-warning mr-2"></span>
	                        <span class="text-warning font-weight-bold"><?php echo $nbMbreActifs; ?></span>
	                    </p>

	                    <p class="text-center py-2">Membres en ligne</p>
	                </div>
	            </div>

	        </div>
	    </div>

	    <!-- logoPartner -->
	    <div class="row smallogo">
	        <?php foreach ($logoPartner as $img) : ?>
	            <div class="col-lg-1 col-sm-3">
	                <img src="<?= $Innerurllink ?>/images/sponsors/<?= $img['image'] ?>" alt="<?= $img['alt'] ?>" class="img-thumbnails border rounded" style="border-radius: 16px!important; height: 50px!important;">
	            </div>
	        <?php endforeach; ?>
	    </div>

	    <section class="my-3">
	        <div class="container">
	            <div class="row">
	                <div class="col-md-5 my-4 mx-auto text-center mt-3">
	                    <h3 class="mb-3">BOUTIQUE</h3>
	                </div>
	            </div>

	            <div class="row py-2">
	                <?php foreach ($imgProduct as $product) : ?>
	                    <div class="col-lg-3 col-md-6 col-sm-12 mx-auto text-center">
	                        <div class="text-center my-3">

	                            <style>
	                                .element {
	                                    transition: transform 0.5s;
	                                }

	                                @keyframes zoom-in {
	                                    from {
	                                        transform: scale(1);
	                                    }

	                                    to {
	                                        transform: scale(1.2);
	                                    }
	                                }

	                                @keyframes zoom-out {
	                                    from {
	                                        transform: scale(1.2);
	                                    }

	                                    to {
	                                        transform: scale(1);
	                                    }
	                                }

	                                .element:hover {
	                                    animation: zoom-in 2s ease-in-out;
	                                }

	                                .element:active {
	                                    animation: zoom-out 2s ease-in-out;
	                                }
	                            </style>

	                            <img src="<?= $Innerurllink ?>/images/imageBtk/<?= $product['produit'] ?>" alt="<?= $product['altProduit'] ?>" class="img-fluid rounded element" style="border-radius: 20px!important; height: 160px!important; width: 100%!important;">
	                        </div>
	                    </div>
	                <?php endforeach; ?>
	            </div>
	        </div>
	</div>
	<div class="container-fluid text-center mt-3 py-5 rounded" style="background-color:#7878b9!important; border: none!important;">
	    <h2 class="text-center text-light">Maxiconcour sur les Stores</h2>
	    <p class="py-3 text-light" style="font-size: 13px;">
	        Profitez pleinement et à tout moment de <span class="text-warning fw-bold">Maxiconcour</span> en téléchargeant notre application sur Google Play ou sur l'App Store.
	    </p>
	    <div class="row mb-3">
	        <div class="col-sm-6 text-right">
	            <img src="<?= $Innerurllink ?>/images/app-store.png" alt="app store" class="img-fluid rounded" style="height:60px">
	        </div>
	        <div class="col-sm-6 text-left">
	            <img src="<?= $Innerurllink ?>/images/play-store.png" alt="playstore" class="img-fluid rounded" style="height:60px">
	        </div>
	    </div>
	</div>
	</section>