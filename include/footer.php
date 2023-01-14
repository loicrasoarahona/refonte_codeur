<?php
$reqRoom = $pdo->query("SELECT DISTINCT pays FROM users");
$rooms = $reqRoom->fetchAll(PDO::FETCH_ASSOC);
?>

<div id="chat-circle" class="btn btn-raised">
    <div id="chat-overlay"></div>
    <i class="icofont-1x icofont-chat"></i>
</div>

<div class="chat-box chat-area">
    <div class="chat-box-header">
        <div class="btn-group btn-group-dropdown user-connected">
            <button type="button" class="btn-default dropdown-toggle room-dropdown-btn" data-toggle="dropdown" aria-expanded="false">
                Room <?php echo strtoupper($rooms[0]["pays"]); ?>
            </button>
            <input type="hidden" id="room-user" value="<?= strtoupper($rooms[0]["pays"]) ?>">
            <div class="dropdown-menu" style="">
                <?php foreach ($rooms as $room): ?>
                    <a class="dropdown-item" data-room="<?= strtoupper($room["pays"]) ?>" href="#">Room <?= strtoupper($room["pays"]) ?></a>
                <?php endforeach ?>
            </div>
            <div style="margin-left: 38px;">
            </div>
        </div>
        <span class="chat-box-toggle"><i class="icofont-close"></i></span>
    </div>
    <div class="chat-box-body">
        <div class="chat-box-overlay">
        </div>
        <div class="chat-logs chat-area-main">

        </div><!--chat-log -->
    </div>
    <div class="chat-input">
        <form id="form-chat">
            <input type="hidden" name="submit" value="1">
            <input type="text" id="chat-input" name="message" placeholder="Tapez votre message…"/>
            <div class="chat-submit" id="chat-submit">
                <i class="icofont-2x icofont-paper-plane"></i>
            </div>
        </form>
    </div>
</div>


<!-- Begin Footer -->
 <section class="footer border-top section-padding">
     <div class="container">
         <div class="row">
             <div class="col-xl-2 col-sm-6">
                 <div class="navbar-brand pt-0">
                     <img class="img-fluid" src="<?php echo $base_url.'assets/v2/images/logo167x89.png'; ?>">
                 </div>
             </div>
             <div class="col-xl-2 col-sm-6">
                 <h6>Support</h6>
                 <ul>
                     <li><a href="https://help.earnably.com/">Faq</a></li>
                     <li><a href="<?php echo $base_url.'/contact.html' ?>" target="_blank" rel="noopener noreferrer">Contact</a></li>
                 </ul>
             </div>
             <div class="col-xl-2 col-sm-6">
                 <h6>Stratégies</h6>
                 <ul>
                     <li><a href="terms.php#terms-conditions.html">Conditions d'utilisation</a></li>
                     <li><a href="privacy.php#politique-de-confidentialités.html">Politique de confidentialité</a></li>
                     <li><a href="cookies.php">Politique de cookies</a></li>
                 </ul>
             </div>
             <div class="col-xl-2 col-sm-6">
                 <h6>Communauté</h6>
                 <ul>
                     <li><a href="https://www.facebook.com/" target="_blank">Facebook</a></li>
                     <li><a href="https://www.twitter.com/" target="_blank">Twitter</a></li>
                     <li><a href="https://www.instagram.com/" target="_blank">Instagram</a></li>
                 </ul>
             </div>
             <div class="col-xl-4 col-sm-6">
                 <h6>ABONNEZ-VOUS À NOTRE NEWSLETTER</h6>
                 <form class="form-inline newsletter-form mb-1">
                     <input type="text" class="form-control mr-sm-2" placeholder="veuillez entrer votre Email">
                     <button type="submit" class="btn btn-primary">s'abonner</button>
                 </form>
                 <small><a href="#">Inscrivez-vous maintenant pour obtenir des mises à jour sur nos <span class="text-info">Offres et coupons</span></a></small>

             </div>
         </div>
     </div>
 </section>
 <section class="py-4">
     <div class="container">
         <div class="row">
             <div class="col-xl-12">
                 <div class="d-flex align-items-center justify-content-between small">
                     <p class="m-0"><i class="fa-regular fa-copyright me-1"></i>© 2022 Revenucash - Tous les noms de produits et de sociétés sont des marques de commerce™ ou des marques déposées® de leurs détenteurs respectifs. Leur utilisation n'implique aucune affiliation ou approbation de leur part.</p>
                 </div>
             </div>
         </div>
     </div>
 </section>

<?php
if(!isset($_COOKIE['_cashbackREduction']))
{
    ?>
    <div id='cookie_acceuil' style="background: #dee1e5; box-shadow: none !important; padding: 30px 30px 30px 30px; position: fixed; bottom: 7px; z-index: 5; background: white; right: 8px; padding: 15px; box-shadow: 1px 11px 26px #4a4a42; border-radius: 6px;">
        <p style="color:#000000">
        Notre site Web utilise des cookies pour vous garantir <br>
       la meilleure expérience. En continuant à utiliser notre <br>
       site Web, vous consentez à notre utilisation des cookies.
         <a href=''></a>
       <p style="font-weight: bold;"><u><a style="color:#c4c8ce">En savoir plus</a></u></p>
        </p>
        <button class='btn btn-primary ' onclick='activeCookie()' style="background: #fccd12; color: #222222; font-weight: bold; width: 100%; border: none !important; font-family: 'source sans pro', 'helvetica neue', Helvetica, arial, sans-serif, sans;">
        D'accord !
        </button>
    </div>
    <?php
}
?>
