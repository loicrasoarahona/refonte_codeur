<div class="page-header section-rotate position-relative inner-header">
    <section class="middle-nav">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <a class="navbar-brand" href="<?php echo $base_url; ?>index.html"><img class="img-fluid" src="<?php echo $base_url . 'assets/v2/images/Logo-blanc.png'; ?>" class="img-fluid" style="height: 5rem;"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <?php if (!empty($_SESSION["id"])) { ?>
                        <div style="width: 100%" class="d-none d-lg-flex justify-content-end">
                            <div style="">
                                <ul class="navbar-nav mr-auto">
                                    <?php navbarInterior($mbreId, $pdo, $base_url); ?>
                                </ul>
                            </div>
                        </div>
                        <ul class="navbar-nav mr-auto d-lg-none">
                            <?php navbarInterior($mbreId, $pdo, $base_url) ?>
                        </ul>
                    <?php } else { ?>
                        <span class="navbar-text ml-auto">
                            <a href="#" class="btn btn-light-white btn-sm rounded-pill generator-bg" data-super-toggle="modal" data-target="#registerModal"><i class="icofont-cart"></i> Inscription</a>
                            <a href="#" class="btn btn-light-white btn-sm rounded-pill" data-super-toggle="modal" data-target="#loginModal"><i class="icofont-cart"></i> Se connecter</a>
                        </span>
                    <?php } ?>
                </div>

            </nav>
        </div>
    </section>
</div>