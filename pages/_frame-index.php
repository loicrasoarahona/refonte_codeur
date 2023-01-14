<?php

?>
<div class="container py-5">
    <div class="row py-3">
        <div class="col-lg-4 col-md-6 col-sm-12">
            <img src="<?= $Innerurllink ?>/images/home-hand-smartphone.jpg" alt="img" class="img-fluid img-side-1">
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
                        <span class="icofont-users-social text-warning mr-2"></span>
                        <span class="text-warning font-weight-bold"><?php echo displayMontant($nbMbreActifs, 0, ''); ?></span>
                    </p>

                    <p class="text-center py-2">Membres en ligne</p>
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
                        <span class="text-warning font-weight-bold"><?php echo displayMontant($totalUsers, 0, ''); ?></span>
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
                        <span class="icofont-gift text-warning mr-2"></span>
                        <span class="text-warning font-weight-bold"><?php echo displayMontant($totalAmountRevers, 2, ''); ?>€ </span>
                    </p>

                    <p class="mb-0"> Cadeaux reversées </p>
                </div>
            </div>
        </div>
    </div>

    <!-- logoPartner -->

    <div class="row smallogo">
        <div class="col-lg-1 col-sm-3">
            <img src="<?= $Innerurllink ?>/images/sponsors/wannads.png" alt="wannads" class="img-thumbnails border rounded">
        </div>
        <div class="col-lg-1 col-sm-3">
            <img src="<?= $Innerurllink ?>/images/sponsors/adgatemedia.jpg" alt="adgatemedia" class="img-thumbnails border rounded">
        </div>
        <div class="col-lg-1 col-sm-3">
            <img src="<?= $Innerurllink ?>/images/sponsors/offertoro.png" alt="offertoro" class="img-thumbnails border rounded">
        </div>
        <div class="col-lg-1 col-sm-3">
            <img src="<?= $Innerurllink ?>/images/sponsors/MONLIX.png" alt="monlix" class="img-thumbnails border rounded">
        </div>
        <div class="col-lg-1 col-sm-3">
            <!--  <img src="<?= $Innerurllink ?>/images/sponsors/awork.jpeg" alt="awork" class="img-thumbnails border rounded">  -->
        </div>
        <div class="col-lg-1 col-sm-3">
            <!--  <img src="image/sponsors/adgatemedia.jpg" alt="adgatemedia" class="img-thumbnails border rounded"> -->
        </div>
        <div class="col-lg-1 col-sm-3">
            <!-- <img src="image/sponsors/offertoro.jpg" alt="offertoro" class="img-thumbnails border rounded"> -->
        </div>
        <div class="col-lg-1 col-sm-3">
            <!--  <img src="image/sponsors/adgatemedia.jpg" alt="adgatemedia" class="img-thumbnails border rounded"> -->
        </div>
        <div class="col-lg-1 col-sm-3">
            <!--   <img src="image/sponsors/adgatemedia.jpg" alt="adgatemedia" class="img-thumbnails border rounded"> -->
        </div>
        <div class="col-lg-1 col-sm-3">
            <!--   <img src="image/sponsors/offerwall-adgatemedia.jpg" alt="adgatemedia" class="img-thumbnails border rounded"> -->
        </div>
        <div class="col-lg-1 col-sm-3">
            <!--   <img src="image/sponsors/offerwall-adgatemedia.jpg" alt="adgatemedia" class="img-thumbnails border rounded"> -->
        </div>
        <div class="col-lg-1 col-sm-3">
            <!--   <img src="image/sponsors/offerwall-adgatemedia.jpg" alt="adgatemedia" class="img-thumbnails border rounded"> -->
        </div>
    </div>

</div>



<!--code déjà sur le serveur-->

<section class="section-padding homepage-view-offers">
    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto text-center">
                <h3 class="mb-3">BOUTIQUE</h3>
                <p class="text-dark-50 mb-5">Tous les noms de produits et de sociétés sont des marques de commerce™ ou des marques déposées® de leurs détenteurs respectifs. Leur utilisation n'implique aucune affiliation ou approbation de leur part</p>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-4">
                <div class="custom-card shadow-sm h-100">
                    <div class="custom-card-image">
                        <a href="#">
                            <img class="img-fluid item-img" src="assets/v2/images/custom-card/1.png">
                        </a>
                        <div class="button-g-btn button-g-btn-up">
                            <img class="img-fluid" src="assets/v2/images/brand/1.png">
                            <span>MakeMyTrip</span>
                        </div>
                    </div>
                    <div class="p-3 pt-4">
                        <div class="custom-card-body">
                            <h6 class="mb-3"><a class="text-black" href="#">Get Flat 30% OFF on Payment Via RBL Bank</a></h6>
                            <p class="text-gray"><i class="icofont-clock-time"></i> Ends in 18 days</p>
                        </div>
                        <div class="custom-card-footer mb-2">
                            <a class="btn btn-orange float-right" href="#">Get Offer</a>
                            <span class="text-primary"><i class="icofont-sale-discount"></i> 50 % OFF</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-4">
                <div class="custom-card shadow-sm h-100">
                    <div class="custom-card-image">
                        <a href="#">
                            <img class="img-fluid item-img" src="assets/v2/images/custom-card/2.png">
                        </a>
                        <div class="button-g-btn button-g-btn-up">
                            <img class="img-fluid" src="assets/v2/images/brand/2.png">
                            <span>Dominos</span>
                        </div>
                    </div>
                    <div class="p-3 pt-4">
                        <div class="custom-card-body">
                            <h6 class="mb-3"><a class="text-black" href="#">Special Offer: Get Up to 50% Off On Web Hosting
                                </a>
                            </h6>
                            <p class="text-gray"><i class="icofont-clock-time"></i> Ends in 18 days</p>
                        </div>
                        <div class="custom-card-footer d-flex align-items-center">
                            <span class="text-primary"><i class="icofont-sale-discount"></i> 50 % OFF</span><a class="btn btn-orange ml-auto" href="#">Get Offer</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-4">
                <div class="custom-card shadow-sm bg-white h-100">
                    <div class="custom-card-image">
                        <a href="#">
                            <img class="img-fluid item-img" src="assets/v2/images/custom-card/3.png">
                        </a>
                        <div class="button-g-btn button-g-btn-up">
                            <img class="img-fluid" src="assets/v2/images/brand/3.png">
                            <span>Amazon</span>
                        </div>
                    </div>
                    <div class="p-3 pt-4">
                        <div class="custom-card-body">
                            <h6 class="mb-3"><a class="text-black" href="#">Get Flat 30% OFF on Payment Via RBL Bank</a></h6>
                            <p class="text-gray"><i class="icofont-clock-time"></i> Ends in 18 days</p>
                        </div>
                        <div class="custom-card-footer d-flex align-items-center">
                            <span class="text-primary"><i class="icofont-sale-discount"></i> 50 % OFF</span><a class="btn btn-orange ml-auto" href="#">Get Offer</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-4">
                <div class="custom-card shadow-sm h-100">
                    <div class="custom-card-image">
                        <a href="#">
                            <img class="img-fluid item-img" src="assets/v2/images/custom-card/4.png">
                        </a>
                        <div class="button-g-btn button-g-btn-up">
                            <img class="img-fluid" src="assets/v2/images/brand/4.png">
                            <span>Myntra</span>
                        </div>
                    </div>
                    <div class="p-3 pt-4">
                        <div class="custom-card-body">
                            <h6 class="mb-3"><a class="text-black" href="#">Special Offer: Get Up to 50% Off On Web Hosting
                                </a>
                            </h6>
                            <p class="text-gray"><i class="icofont-clock-time"></i> Ends in 18 days</p>
                        </div>
                        <div class="custom-card-footer d-flex align-items-center">
                            <span class="text-primary"><i class="icofont-sale-discount"></i> 50 % OFF</span><a class="btn btn-orange ml-auto" href="#">Get Offer</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-padding homepage-coupon">
    <div class="container">
        <div class="row  align-items-center">
            <div class="col-lg-4 col-md-4">
                <div class="homepage-left-block">
                    <img class="round-co-icon" src="assets/v2/images/active-power.png" alt="Get Badges Icons">
                    <h3 class="text-white">Top Coupans</h3>
                    <p class="text-white">Make sure you are getting the best deals and offers on all of your online shopping</p>
                    <a class="btn btn-light-white text-white btn-sm rounded-pill" href="#">View more</a>
                </div>
            </div>
            <div class="col-lg-8 col-md-8">
                <div class="owl-carousel owl-theme owl-carousel-three homepage-coupon-carousel">
                    <div class="item">
                        <div class="bg-white p-4 shadow-sm text-center h-100 border-radius">
                            <div class="all-coupon">
                                <img class="mb-3 user-cou-img" src="assets/v2/images/user-coupans/1.png" alt="Generic placeholder image">
                                <h4 class="mt-1">50% OFF</h4>
                                <h6 class="mb-4 mt-3 pb-2 text-secondary">Get Flat 50% OFF On First Order</h6>
                            </div>
                            <div class="mb-0">
                                <p class="mb-0 text-info"><i class="icofont-clock-time"></i> Ends 09.15.2020</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="bg-white p-4 shadow-sm text-center h-100 border-radius">
                            <div class="all-coupon">
                                <img class="mb-3 user-cou-img" src="assets/v2/images/user-coupans/2.png" alt="Generic placeholder image">
                                <h4 class="mt-1">Buy 1 Get 1 Free</h4>
                                <h6 class="mb-4 mt-3 pb-2 text-secondary">Get Flat 50% OFF On First Order</h6>
                            </div>
                            <div class="mb-0">
                                <p class="mb-0 text-info"><i class="icofont-clock-time"></i> Ends 09.15.2020</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="bg-white p-4 shadow-sm text-center h-100 border-radius">
                            <div class="all-coupon">
                                <img class="mb-3 user-cou-img" src="assets/v2/images/user-coupans/3.png" alt="Generic placeholder image">
                                <h4 class="mt-1">Free Burger</h4>
                                <h6 class="mb-4 mt-3 pb-2 text-secondary">Get Flat 50% OFF On First Order</h6>
                            </div>
                            <div class="mb-0">
                                <p class="mb-0 text-info"><i class="icofont-clock-time"></i> Ends 09.15.2020</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="bg-white p-4 shadow-sm text-center h-100 border-radius">
                            <div class="all-coupon">
                                <img class="mb-3 user-cou-img" src="assets/v2/images/user-coupans/4.png" alt="Generic placeholder image">
                                <h4 class="mt-1">80% OFF</h4>
                                <h6 class="mb-4 mt-3 pb-2 text-secondary">Get Flat 50% OFF On First Order</h6>
                            </div>
                            <div class="mb-0">
                                <p class="mb-0 text-info"><i class="icofont-clock-time"></i> Ends 09.15.2020</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-padding homepage-great-deals bg-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="owl-carousel owl-theme owl-carousel-one homepage-great-deals-carousel">
                    <div class="item">
                        <div class="great-deals-sstore-banners">
                            <a href="#"><img alt="placeholder image" src="assets/v2/images/dotd.png" class="img-fluid rounded"></a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="great-deals-sstore-banners">
                            <a href="#"><img alt="placeholder image" src="assets/v2/images/dotd.png" class="img-fluid rounded"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-padding homepage-store-block">
    <div class="container">
        <div class="row  align-items-center">
            <div class="col-lg-9 col-md-8">
                <div class="owl-carousel owl-theme owl-carousel-three homepage-coupon-carousel">
                    <div class="item">
                        <div class="custom-card bg-white shadow-sm h-100 stor-card">
                            <div class="custom-card-image">
                                <div class="member-plan"><span class="badge badge-gold">Gold Member</span></div>
                                <a href="#">
                                    <img class="img-fluid item-img" src="assets/v2/images/custom-card/5.png">
                                </a>
                                <div class="shape shape-bottom shape-fluid-x svg-shim text-white">
                                    <svg viewBox="0 0 2880 480" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2160 0C1440 240 720 240 720 240H0V480H2880V0H2160Z" fill="currentColor"></path>
                                    </svg>
                                </div>
                                <div class="store-star"><span class="badge badge-success"><i class="icofont-star"></i> 3.1</span></div>
                            </div>
                            <div class="p-3">
                                <div class="custom-card-body">
                                    <h6 class="mb-0"><a class="text-black" href="#">The Home Depot, Inc.</a></h6>
                                    <p class="text-gray mb-2">Andheri East Office, Mumbai</p>
                                    <p class="text-gray mb-0"><span class="text-black">Variety store</span></p>
                                </div>
                            </div>
                            <div class="p-3 border-top">
                                <div class="custom-card-badge">
                                    <span class="badge badge-danger"><i class="icofont-sale-discount"></i> OFFER</span> Flat 50% on all Stores
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="custom-card bg-white shadow-sm h-100 stor-card">
                            <div class="custom-card-image">
                                <a href="#">
                                    <img class="img-fluid item-img" src="assets/v2/images/custom-card/6.png">
                                </a>
                                <div class="shape shape-bottom shape-fluid-x svg-shim text-white">
                                    <svg viewBox="0 0 2880 480" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2160 0C1440 240 720 240 720 240H0V480H2880V0H2160Z" fill="currentColor"></path>
                                    </svg>
                                </div>
                                <div class="store-star"><span class="badge badge-success"><i class="icofont-star"></i> 3.1</span></div>
                            </div>
                            <div class="p-3">
                                <div class="custom-card-body">
                                    <h6 class="mb-0"><a class="text-black" href="#">Target Corporation</a></h6>
                                    <p class="text-gray mb-2">Andheri East Office, Mumbai</p>
                                    <p class="text-gray mb-0"><span class="text-gold"><i class="icofont-clock-time"></i> Time Left : 2 days: 3 Hrs</span></p>
                                </div>
                            </div>
                            <div class="p-3 border-top">
                                <div class="custom-card-badge">
                                    <span class="badge badge-danger"><i class="icofont-sale-discount"></i> OFFER</span> Flat 50% on all Stores
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="custom-card bg-white shadow-sm h-100 stor-card">
                            <div class="custom-card-image">
                                <div class="member-plan"><span class="badge badge-silver">Silver Member</span></div>
                                <a href="#">
                                    <img class="img-fluid item-img" src="assets/v2/images/custom-card/7.png">
                                </a>
                                <div class="shape shape-bottom shape-fluid-x svg-shim text-white">
                                    <svg viewBox="0 0 2880 480" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2160 0C1440 240 720 240 720 240H0V480H2880V0H2160Z" fill="currentColor"></path>
                                    </svg>
                                </div>
                                <div class="store-star"><span class="badge badge-success"><i class="icofont-star"></i> 3.1</span></div>
                            </div>
                            <div class="p-3">
                                <div class="custom-card-body">
                                    <h6 class="mb-0"><a class="text-black" href="#">Phoenix Market City</a></h6>
                                    <p class="text-gray mb-2">Andheri East Office, Mumbai</p>
                                    <p class="text-gray mb-0"><span class="text-black">Variety store</span></p>
                                </div>
                            </div>
                            <div class="p-3 border-top">
                                <div class="custom-card-badge">
                                    <span class="badge badge-danger"><i class="icofont-sale-discount"></i> OFFER</span> Flat 50% on all Stores
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="custom-card bg-white shadow-sm h-100 stor-card">
                            <div class="custom-card-image">
                                <a href="#">
                                    <img class="img-fluid item-img" src="assets/v2/images/custom-card/8.png">
                                </a>
                                <div class="shape shape-bottom shape-fluid-x svg-shim text-white">
                                    <svg viewBox="0 0 2880 480" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2160 0C1440 240 720 240 720 240H0V480H2880V0H2160Z" fill="currentColor"></path>
                                    </svg>
                                </div>
                                <div class="store-star"><span class="badge badge-success"><i class="icofont-star"></i> 3.1</span></div>
                            </div>
                            <div class="p-3">
                                <div class="custom-card-body">
                                    <h6 class="mb-0"><a class="text-black" href="#">Amazon.com, Inc.</a></h6>
                                    <p class="text-gray mb-2">Andheri East Office, Mumbai</p>
                                    <p class="text-gray mb-0"><span class="text-gold"><i class="icofont-clock-time"></i> Time Left : 2 days: 3 Hrs</span></p>
                                </div>
                            </div>
                            <div class="p-3 border-top">
                                <div class="custom-card-badge">
                                    <span class="badge badge-info"><i class="icofont-sale-discount"></i> OFFER</span> Flat 50% on all Stores
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4">
                <div class="homepage-left-block text-right">
                    <img class="round-co-icon" src="assets/v2/images/active-power.png" alt="Get Badges Icons">
                    <h3 class="text-white">Top Stores</h3>
                    <p class="text-white pl-0 pr-0">Make sure you are getting the best deals and offers on all of your online shopping
                    </p>
                    <a class="btn btn-light-white text-white btn-sm rounded-pill" href="#">View more</a>
                </div>
            </div>
        </div>
    </div>
</section>