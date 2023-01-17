<?php
$reqRoom = $pdo->query("SELECT DISTINCT pays FROM users");
$rooms = $reqRoom->fetchAll(PDO::FETCH_ASSOC);
?>
<?php if ($mbreId == '') : ?>
    <style>
        #chat-circle {
            display: none !important;
        }
    </style>

<?php else : ?>

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
                    <?php foreach ($rooms as $room) : ?>
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
                <input type="text" id="chat-input" name="message" placeholder="Tapez votre message…" />
                <div class="chat-submit" id="chat-submit">
                    <i class="icofont-2x icofont-paper-plane"></i>
                </div>
            </form>
        </div>
    </div>

<?php endif; ?>

<section class="bg-dark py-4 xs-display-none">

    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="	d-flex align-items-center justify-content-between small">
                    <p class="m-0 text-white">copyright © <?= date('Y') ?><span class="text-muted">&nbsp; · &nbsp;</span> Gifthunter </p>
                    <p class="m-0">
                        <a href="/aide.html" title="Foire aux questions" class="text-white"><i class="icofont-question-circle mr-1"></i>Aide</a>&nbsp; · &nbsp;
                        <a href="/a-propos.html" title="Foire aux questions" class="text-white"><i class="icofont-info-circle"></i>A propos</a>&nbsp; · &nbsp;
                        <a href="/contact.html" title="Foire aux questions" class="text-white"><i class="icofont-contacts"></i>Contact</a>&nbsp; · &nbsp;
                        <a href="/a-propos.html" title="Foire aux questions" class="text-white"><i class="icofont-law-document"></i>Mention légal</a>
                    </p>

                </div>
            </div>


        </div>
    </div>

</section>

<?php
if (!isset($_COOKIE['_cashbackREduction'])) {
?>
    <div id='cookie_acceuil' style="background: #dee1e5; box-shadow: none !important; padding: 30px 30px 30px 30px; position: fixed; bottom: 7px; z-index: 5; background: white; right: 8px; padding: 15px; box-shadow: 1px 11px 26px #4a4a42; border-radius: 6px;">
        <p style="color:#000000">
            Notre site Web utilise des cookies pour vous garantir <br>
            la meilleure expérience. En continuant à utiliser notre <br>
            site Web, vous consentez à notre utilisation des cookies.
            <a href=''></a>
        <p style="font-weight: bold;"><u><a style="color:#c4c8ce">En savoir plus</a></u></p>

        <button class='btn btn-primary ' onclick='activeCookie()' style="background: #fccd12; color: #222222; font-weight: bold; width: 100%; border: none !important; font-family: 'source sans pro', 'helvetica neue', Helvetica, arial, sans-serif, sans;">
            D'accord !
        </button>
    </div>
<?php
}
?>