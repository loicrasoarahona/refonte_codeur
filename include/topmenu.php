<div class="page-header section-rotate position-relative inner-header">
    <section class="middle-nav">
        <nav class="navbar navbar-expand-lg navbar-dark bg-none p-0">
            <div class="container">
                <?php $url = (empty($_SESSION["id"])) ? $base_url.'index.html' : $base_url.'dashboard'; ?>
                <a class="navbar-brand" href="<?=$url;?>"><img class="img-fluid" src="<?=$base_url.'assets/v2/images/Logo-blanc.png'; ?>"></a>
                <div class="collapse navbar-collapse" id="navbarText">
                    
                </div>
                <?php
                // if(!$isMobile)
                {
                    if(!empty($_SESSION["id"]))
                    {
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
                                                    <i class="icofont-plus"></i>  Nouveau message
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
                                        <a class="dropdown-item" href="<?php echo $base_url;?>logout"><i class="icofont-logout"></i> Se déconnecter</a>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                        <?php
                    }
                    else
                    {
                        ?>
                        <span class="navbar-text">
                            <a href="#" class="btn btn-light-white btn-sm rounded-pill generator-bg" data-super-toggle="modal" data-target="#registerModal"><i class="icofont-cart"></i> Inscription</a>
                            <a href="#" class="btn btn-light-white btn-sm rounded-pill" data-super-toggle="modal" data-target="#loginModal"><i class="icofont-cart"></i> Se connecter</a>
                        </span>
                        <?php
                    }
                }
                ?>
            </div>
        </nav>
    </section>
</div>
