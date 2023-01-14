<?php
$user_role = $_SESSION['userprofile']['type'];
if(!$isMobile)
{
?>
    <div class="col-xl-3 col-sm-4">
        <div class="user-panel-body-left">
            <div class="bg-white rounded p-4 mb-4 text-center shadow-sm">
                <i class="icofont-user-suited" style="font-size: 50px;"></i>
                <h6 class="text-black mb-3"><?php echo strtoupper($_SESSION["name"]); ?></h6>
                <p class="m-0"><?php echo $mbreEmail; ?></p>
                <p class="mb-3"></p>
                <a href="logout" class="btn btn-primary btn-block"><i class="icofont-logout"></i> Se déconnecter</a>
                <p class="mb-0 mt-3"><a href="<?php echo $base_url; ?>profile">Modifier mon profil</a></p>
            </div>
            <div class="user-panel-sidebar-link mb-4 bg-white rounded shadow-sm overflow-hidden">
                <a href="<?php echo $base_url;?>dashboard"><i class="icofont-home"></i> Dashboard</a>
                <a href="<?php echo $base_url;?>profile"><i class="icofont-user-alt-2"></i> Modifier profil</a>
                <a href="<?php echo $base_url;?>missions"><i class="icofont-money-bag"></i> Gagner de l'argent</a>
                <a href="<?php echo $base_url;?>offrewalls"><i class="icofont-slidshare"></i> Offre mur nouveau</a>
                <a href="<?php echo $base_url; ?>coupons"><i class="icofont-ticket"></i> Coupons</a>
                <a href="<?php echo $base_url;?>add-commande"><i class="icofont-bank"></i> Paiement</a>
                <!-- <div class="dropdown-divider"></div> -->
                <a href="<?php echo $base_url; ?>commandes"><i class="icofont-sub-listing"></i> Mes commandes</a>
                <a href="<?php echo $base_url; ?>traces"><i class="icofont-bear-tracks"></i> Mes participations</a>
            </div>
        </div>
    </div>
<?php
}
?>
