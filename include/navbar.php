<?php

if($page_name == "index"){
?>
    <div class="page-header section-rotate position-relative">
        <div class="section-inner bg-gradient-primary"></div>

        <section class="middle-nav">
            <nav class="navbar navbar-expand-lg navbar-dark bg-none p-0">
                <div class="container">
                    <a class="navbar-brand" href="<?php echo $base_url;?>index.html"><img class="img-fluid" src="<?php echo $base_url.'assets/v2/images/logo167x89.png'; ?>"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarText">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="https://help.earnably.com/">Help <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">A propos</a>
                            </li>

                        </ul>

                        <?php if(!empty($_SESSION["id"])) {
                            ?>
                            <nav class="navbar navbar-expand-lg  navbar-dark bg-none p-0">
                                <ul class="navbar-nav ml-auto nav-user ml-md-0">
                                    <li class="nav-item dropdown no-arrow badge-top">
                                        <?php
                                        $allNotif = getNotifcations($mbreId, $pdo);
                                        $class = $nbNot = "";
                                        if (count($allNotif) > 0):
                                            $nbNot = count($allNotif);
                                            $class = "badge badge-pill badge-danger";
                                        endif;
                                        ?>
                                        <div class="nav-link" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="icofont-alarm"></i>
                                            <span class="nb-notif-ex <?php echo $class; ?>">
                                                <?php echo $nbNot ?>
                                            </span>
                                        </div>
                                        <?php if (count($allNotif) > 0): ?>
                                        <div class="dropdown-menu">
                                            <?php
                                            foreach ($allNotif as $notif)
                                            {
                                                ?>
                                                <a class="dropdown-item notif-alarm" data-id="<?php echo $notif["id"]; ?>" href="#">
                                                    <div class="msg-lib">
                                                        <?php echo $notif["libelle"]; ?>
                                                    </div>
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <?php endif; ?>
                                    </li>
                                    <li class="nav-item dropdown no-arrow badge-top message-notif">
                                        <?php
                                        $allMsg = getUnreadMessage($mbreId, $pdo);
                                        $class = $nbNot = "";
                                        if (count($allMsg) > 0):
                                            $nbNot = count($allMsg);
                                            $class = "badge badge-pill badge-danger";
                                        endif;
                                        ?>
                                        <div class="btn dropdown dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true">
                                            <i class="icofont-ui-messaging"></i>
                                            <span class="nb-notif <?php echo $class; ?>">
                                                <?php echo $nbNot ?>
                                            </span>
                                        </div>
                                        <div class="dropdown-menu">
                                            <a class="ln-msg new-msg dropdown-item" data-super-toogle="modal" data-target="#msgbox-modal" data-id="" href="#">
                                                <div class="msg-lib">
                                                    <i class="icofont-plus"></i> Nouveau message
                                                </div>
                                            </a>
                                        <?php if (count($allMsg) > 0): ?>
                                            <?php
                                            foreach ($allMsg as $msg)
                                            {
                                                ?>
                                                <a class="ln-msg dropdown-item" data-super-toogle="modal" data-target="#msgbox-modal" data-id="<?php echo $msg["id"]; ?>" href="#">
                                                    <div class="msg-lib">
                                                        <?php echo $msg["sujet"]; ?>
                                                    </div>
                                                    <div class="msg-exp">
                                                        <b><?php echo $msg["prenom"] . " " . $msg["nom"]; ?></b> du <?php echo dateToFrench($msg["date"],"l, h:i"); ?>
                                                    </div>
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        <?php endif; ?>
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown no-arrow dropdown-user">
                                        <a class="nav-link dropdown-toggle" href="<?php echo $base_url;?>#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="icofont-user-suited"></i> <?php echo strtoupper($_SESSION["name"]); ?>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                            <a class="dropdown-item" href="<?php echo $base_url;?>dashboard"><i class="icofont-home"></i> Dashboard</a>
                                            <a class="dropdown-item" href="<?php echo $base_url;?>profile"><i class="icofont-user-alt-2"></i> Modifier profil</a>
                                            <a class="dropdown-item" href="<?php echo $base_url;?>missions"><i class="icofont-money-bag"></i> Gagner de l'argent</a>
                                            <a class="dropdown-item" href="<?php echo $base_url;?>offrewalls"><i class="icofont-slidshare"></i> Offre mur nouveau</a>
                                            <a class="dropdown-item" href="<?php echo $base_url; ?>coupons"><i class="icofont-ticket"></i> Coupons</a>
                                            <a class="dropdown-item" href="<?php echo $base_url;?>add-commande"><i class="icofont-bank"></i> Paiement</a>
                                            <a class="dropdown-item" href="<?php echo $base_url; ?>commandes"><i class="icofont-sub-listing"></i> Mes commandes</a>
                                            <a class="dropdown-item" href="<?php echo $base_url; ?>traces"><i class="icofont-bear-tracks"></i> Mes participations</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="<?php echo $base_url;?>logout"><i class="icofont-logout"></i> Se d??connecter</a>
                                        </div>
                                    </li>
                                </ul>
                            </nav>
                        <?php }else{ ?>
                            <span class="navbar-text">
                                <a href="#" class="btn btn-light-white btn-sm rounded-pill generator-bg" data-super-toggle="modal" data-target="#registerModal"><i class="icofont-cart"></i> Inscription</a>
                                <a href="#" class="btn btn-light-white btn-sm rounded-pill" data-super-toggle="modal" data-target="#loginModal"><i class="icofont-cart"></i> Se connecter</a>
                            </span>
                        <?php } ?>

                    </div>
                </div>
            </nav>
        </section>
        <section class="pt-5 pb-5 homepage-search-block position-relative">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="homepage-search-title">
                            <h1 class="mb-3 text-white text-shadow font-weight-bold">R??compenses num??riques et cartes-cadeaux simplifi??es</h1>
                            <h5 class="mb-5 text-white text-shadow font-weight-normal">Gagnez des r??compenses instantan??es en accomplissant des t??ches, en regardant des vid??os et en r??pondant ?? des sondages. <b>C'est si facile!</b></h5>
                        </div>
                        <!-- <h6 class="mb-0 mt-1 text-white text-shadow font-weight-normal">Texte ici</h6> -->
                    </div>
                    <div class="col-md-4">
                        <img src="<?php echo $Innerurllink; ?>assets/v2/images/banner.svg" class="img-fluid">
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php
}else{
    include"topmenu.php";
}
?>


<!-- messaging box modal -->
<div class="modal fade" id="msgbox-modal" role="dialog" aria-labelledby="msgbox-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content" id="show-message-box">
        </div>
    </div>
</div>

<!-- login modal -->
<div class="modal fade" id="loginModal" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container-fluid pl-0 pr-0">
                    <div class="row no-gutters">
                        <div class="col-md-12 bg-white">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="text-center mr-0 mb-2 login-main-left-header pt-2">
                                <img src="<?php echo $base_url.'assets/v2/images/logo167x89.png'; ?>" class="img-fluid w-40" alt="LOGO">
                                <h5 class="modal-title mt-3 mb-3">Content de vous revoir !</h5>
                                <p>Vous n'avez pas encore de compte ?</p>
                            </div>
                            <form action="" id="send-login-form">
                                <input type="hidden" name="csrf_token" value="<?php echo csrf_token('form-login-user'); ?>">
                                <div class="form-group floating-label-form-group">
                                    <label>Entez Nom d'utilisateur</label>
                                    <input type="text" class="form-control" name="username" placeholder="Entez Nom d'utilisateur">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="form-group floating-label-form-group">
                                    <label>Mot de passe</label>
                                    <input type="password" name="password" class="form-control" placeholder="Mot de passe">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <button type="submit" id="send_login" class="btn btn-primary btn-block btn-lg mt-2">Connexion</button>
                                <div class="errorform invalid-feedback d-block"></div>
                            </form>
                            <div class="text-center mt-2">
                                <p class="light-gray"><a href="#" data-super-toggle="modal" data-target="#registerModal">S'inscrire</a> &bull; <a href="#" data-super-toggle="modal" data-target="#resetModal">Mot de passe oubli???</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- register modal -->
<style type="text/css">
    .form-group.floating-label-form-group .select2.select2-container {
        width: 100% !important;
    }
</style>
<div class="modal fade" id="registerModal" role="dialog" aria-labelledby="registerModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container-fluid pl-0 pr-0">
                    <div class="row no-gutters">
                        <div class="col-md-12 bg-white">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="text-center mr-0 mb-0 login-main-left-header">
                                <img src="<?php echo $base_url.'assets/v2/images/logo167x89.png'; ?>" class="img-fluid w-40" alt="LOGO">
                                <h5 class="mt-3 ">Inscrivez-vous gratuitement</h5>
                            </div>
                            <form action="" id="send-register-form">
                                <input type="hidden" name="idParrain">
                                <input type="hidden" name="submit_register" value="S'inscrire">
                                <div class="form-group floating-label-form-group">
                                    <label>Nom</label>
                                    <input type="text" class="form-control" name="nom" required placeholder="Votre Nom">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="form-group floating-label-form-group">
                                    <label>Pr??nom</label>
                                    <input type="text" class="form-control" name="prenom" required placeholder="Votre Pr??nom">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="form-group floating-label-form-group">
                                    <label>E-mail</label>
                                    <input type="email" name="email" class="form-control" required placeholder="Votre E-mail">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="form-group floating-label-form-group">
                                    <label>Mot de passe</label>
                                    <input type="password" name="password" class="form-control" required placeholder="Mot de passe (minimum 8 caract??res)">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="form-group floating-label-form-group mt-4 mb-3">
                                    <select name="news" class="form-control w-100">
                                        <option value="0" selected="">Non, je ne veux pas recevoir la newsletter</option>
                                        <option value="1">Oui, je veux recevoir la newsletter</option>
                                    </select>
                                </div>
                                <button type="submit" id="send_register" class="btn btn-primary btn-block btn-lg mt-2">Cr??er un compte</button>
                                <div class="errorform invalid-feedback d-block"></div>
                                <div class="text-center mt-2">
                                    <p class="light-gray">D??j?? inscrit ? <a href="#" data-super-toggle="modal" data-target="#loginModal">Je me connecte</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- reset modal -->
<div class="modal fade" id="resetModal" role="dialog" aria-labelledby="resetModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container-fluid pl-0 pr-0">
                    <div class="row no-gutters">
                        <div class="col-md-12 bg-white">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="text-center mr-0 mb-2 reset-main-left-header pt-2">
                                <img src="<?php echo $base_url.'assets/v2/images/logo167x89.png'; ?>" class="img-fluid w-40" alt="LOGO">
                                <h5 class="modal-title mt-3">R??initialiser le mot de passe</h5>
                            </div>
                            <form action="" id="send-reset-form">
                                <input type="hidden" name="csrf_token" value="<?php echo csrf_token('form-reset-user'); ?>">
                                <div class="form-group floating-label-form-group">
                                    <label>Entez votre E-mail</label>
                                    <input type="text" class="form-control" name="email" placeholder="Entez votre E-mail">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <button type="submit" id="send_reset" class="btn btn-primary btn-block btn-lg mt-2">Envoyer</button>
                                <div class="errorform invalid-feedback d-block"></div>
                            </form>
                            <div class="text-center mt-2">
                                <p class="light-gray"><a href="#" data-super-toggle="modal" data-target="#registerModal">S'inscrire</a> &bull; <a href="#" data-super-toggle="modal" data-target="#loginModal">Retour ?? la page de connexion</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- register modal -->
<div class="modal fade" id="completeModal" role="dialog" aria-labelledby="completeModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container-fluid pl-0 pr-0">
                    <div class="row no-gutters">
                        <div class="col-md-12 bg-white">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="text-center mr-0 mb-0 login-main-left-header">
                                <img src="<?php echo $base_url.'assets/v2/images/logo167x89.png'; ?>" class="img-fluid w-40" alt="LOGO">
                                <h5 class="mt-3 ">R??intialiser votre mot de passe</h5>
                            </div>
                            <form action="" id="send-complete-form">
                                <input type="hidden" name="hash_reset" value="<?php if(!empty($_GET['h'])){ echo $_GET['h']; }?>" />
                                <input type="hidden" name="csrf_token" value="<?php echo csrf_token('form-complete-user'); ?>">

                                <div class="form-group floating-label-form-group">
                                    <label>Mot de passe</label>
                                    <input type="password" name="password" class="form-control" required placeholder="Mot de passe (minimum 8 caract??res)">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="form-group floating-label-form-group">
                                    <label>Confirmer le mot de passe</label>
                                    <input type="password" name="re-password" class="form-control" required placeholder="Confirmer le mot de passe">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <button type="submit" id="send_complete" class="btn btn-primary btn-block btn-lg mt-2">Confirmer</button>
                                <div class="errorform invalid-feedback d-block"></div>
                                <div class="text-center mt-2">
                                    <p class="light-gray"><a href="#" data-super-toggle="modal" data-target="#registerModal">S'inscrire</a> &bull; <a href="#" data-super-toggle="modal" data-target="#loginModal">Retour ?? la page de connexion</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


