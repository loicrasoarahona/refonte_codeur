<?php
$reqRoom = $pdo->query("SELECT DISTINCT pays FROM users");
$rooms = $reqRoom->fetchAll(PDO::FETCH_ASSOC);

$nbMbreActifRoom = getMembresActifsParRoom($mbrePaysChat, $pdo);
?>
<?php if ($mbreId == '') : ?>
<style>
#chat-circle {
    display: none !important;
}
</style>

<?php else : ?>

<!-- <div id="chat-circle" class="btn btn-raised">
        <div id="chat-overlay"></div>
        <i class="icofont-1x icofont-chat"></i>
    </div> -->

<style>
#chat-bar {

    position: fixed;
    right: 0;
    bottom: 0;
    z-index: 33;
}

#chat-bar .chat-box-header {
    background-color: #FFC708;
    color: white;
    font-size: 20px;
}

#chat-bar .chat-contenu {
    content: "";
    background-color: rgba(127, 128, 128, 0.001);
    position: relative;
}

#chat-bar .chat-corps {
    display: none;
}

.chat-bar-toggle {
    float: right;
    margin-right: 15px;
    cursor: pointer;
}
</style>
<?php if (isset($_SESSION['id'])) { ?>
<div id="chat-bar" class="d-none d-lg-block col-xl-3 col-md-4 col-12 chat-area">
    <div class="chat-box-header">
        <a data-toggle="dropdown" href="#" class="flag-button"><img style="margin-top: -5px; margin-right : 5px"
                width="25" src="<?php echo $base_url . "images/flags/" . strtolower($mbrePaysChat) . ".svg" ?>" /></a>
        <div class="dropdown-menu">
            <?php foreach ($rooms as $room) { ?>
            <a class="dropdown-item"
                href="<?php echo $base_url . "traitements/changerPaysChat.php?pays=" . $room['pays'] ?>"><?php echo $room['pays']; ?>
                <img style="margin-top: -4px; margin-right : 5px; margin-left : 5px" width="17"
                    src="<?php echo $base_url . "images/flags/" . strtolower($room['pays']) . ".svg" ?>" /></a>
            <?php } ?>
        </div>
        <i class="icofont-1x icofont-chat"></i>
        Chat (<?php echo $nbMbreActifRoom ?>)
        <span class=" chat-bar-toggle"><i class="icofont-caret-up"></i></span>
    </div>
    <div class="chat-corps">
        <div style="background-color: white;">
            <div class="chat-contenu">
                <div class="chat-box-overlay">
                </div>
                <div class="chat-logs chat-area-main">

                </div>
                <!--chat-log -->
            </div>
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
</div>

<style>
#chat-bar-mobile {
    color: white;
    background-color: #FFC708;
    font-size: 27px;
    padding: 10px;
    position: fixed;
    width: 18%;
    right: 0;
    bottom: 150px;
    border-top-left-radius: 60px;
    border-bottom-left-radius: 60px;
    z-index: 99;
    white-space: nowrap;
    cursor: pointer;
}
</style>


<div id="chat-bar-mobile" class="d-block d-lg-none">
    <i class="icofont-1x icofont-chat"></i>
    &nbsp;<span style="font-size : 20px; position : absolute; padding-top: -5px;"><?php echo $nbMbreActifRoom ?></span>
</div>
<?php } ?>

<div class="chat-box chat-area">
    <div class="chat-box-header">
        <div class="btn-group btn-group-dropdown user-connected">
            <button type="button" class="btn-default dropdown-toggle room-dropdown-btn" data-toggle="dropdown"
                aria-expanded="false">
                Room <?php echo strtoupper($mbrePays); ?>
            </button>
            <input type="hidden" id="room-user" value="<?= strtoupper($mbrePays) ?>">
            <div class="dropdown-menu" style="">
                <?php foreach ($rooms as $room) : ?>
                <a class="dropdown-item" data-room="<?= strtoupper($room["pays"]) ?>" href="#">Room
                    <?= strtoupper($room["pays"]) ?></a>
                <?php endforeach ?>
            </div>
            <div style="margin-left: 38px;">
            </div>
        </div>
        <span class="chat-box-toggle"><i class="icofont-close"></i></span>
    </div>
    <!--<div class="chat-box-header">
            <i class="icofont-1x icofont-chat"></i>
            Chat (<?php echo $nbMbreActifs ?>)
            <span class=" chat-box-toggle"><i class="icofont-close"></i></span>
        </div>-->
    <div class="chat-box-body">
        <div class="chat-box-overlay">
        </div>
        <div class="chat-logs chat-area-main">

        </div>
        <!--chat-log -->
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

<style>
.modal-chat-header {
    background-color: #FFC708;
    height: 50px;
    padding: 15px;
    font-size: 20px;
    color: white;
}
</style>

<!-- Modal Chat Mobile -->
<div class="modal fade" id="chatModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-chat-header">
                <a data-toggle="dropdown" href="#" class="flag-button"><img style="margin-top: -5px; margin-right : 5px"
                        width="35"
                        src="<?php echo $base_url . "images/flags/" . strtolower($mbrePaysChat) . ".svg" ?>" />
                </a>
                <div class="dropdown-menu">
                    <?php foreach ($rooms as $room) { ?>
                    <a class="dropdown-item"
                        href="<?php echo $base_url . "traitements/changerPaysChat.php?pays=" . $room['pays'] ?>"><?php echo $room['pays']; ?>
                        <img style="margin-top: -4px; margin-right : 5px; margin-left : 5px" width="17"
                            src="<?php echo $base_url . "images/flags/" . strtolower($room['pays']) . ".svg" ?>" /></a>
                    <?php } ?>
                </div>
                <i class="icofont-1x icofont-chat"></i>
                Chat (<?php echo $nbMbreActifRoom ?>)
                <button type="button" class="close bt_close_chat" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div style="background-color: white;">
                <div class="chat-contenu">
                    <div class="chat-box-overlay">
                    </div>
                    <div class="chat-logs chat-area-main">

                    </div>
                    <!--chat-log -->
                </div>
            </div>
            <div class="chat-input">
                <form id="form-chat-mobile">
                    <input type="hidden" name="submit" value="1">
                    <input type="text" class="chat-input" id="chat-input" name="message"
                        placeholder="Tapez votre message…" />
                    <div style="" class="chat-submit" id="chat-submit">
                        <i style="margin-left : -20px;" class="icofont-2x icofont-paper-plane"></i>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$chat_bar_mobile = $("#chat-bar-mobile");
let chat_opened = false;


$chat_bar_mobile.on('click', function(event) {

    $(this).animate({
        right: "-=100"
    }, "slow", function() {
        $(this).hide();
        $('#chatModal').modal({
            show: true
        });
    });

    if (!chat_opened) {
        $('.bt_close_chat').on('click', function(event) {
            console.log('mihidy');

            $chat_bar_mobile.show();
            $chat_bar_mobile.animate({
                right: "+=100"
            }, "slow", function() {});
        });

        $('body').on('click', '#form-chat-mobile #chat-submit', function() {
            console.log("mandefa message");
            $.ajax({
                type: 'POST',
                url: '/ajax/checking-chat.php?a=refreshchat',
                data: $('#form-chat-mobile').serialize(),
                success: function(retour) {
                    $('#form-chat-mobile #chat-input').val('');
                    $('.chat-area-main').html(retour);
                    console.log(retour);
                }
            });
        });
    }

    chat_opened = true;
});
</script>

<?php endif; ?>

<section class="bg-dark py-4 xs-display-none">

    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="	d-flex align-items-center justify-content-between small">
                    <p class="m-0 text-white">copyright © <?= date('Y') ?><span class="text-muted">&nbsp; ·
                            &nbsp;</span> Gifthunter </p>
                    <p class="m-0">
                        <a href="/aide.html" title="Foire aux questions" class="text-white"><i
                                class="icofont-question-circle mr-1"></i>Aide</a>&nbsp; · &nbsp;
                        <a href="/a-propos.html" title="Foire aux questions" class="text-white"><i
                                class="icofont-info-circle"></i>A propos</a>&nbsp; · &nbsp;
                        <a href="/contact.html" title="Foire aux questions" class="text-white"><i
                                class="icofont-contacts"></i>Contact</a>&nbsp; · &nbsp;
                        <a href="/a-propos.html" title="Foire aux questions" class="text-white"><i
                                class="icofont-law-document"></i>Mention légal</a>
                    </p>

                </div>
            </div>


        </div>
    </div>

</section>

<?php
if (!isset($_COOKIE['_cashbackREduction'])) {
?>
<div id='cookie_acceuil'
    style="background: #dee1e5; box-shadow: none !important; padding: 30px 30px 30px 30px; position: fixed; bottom: 47px; z-index: 5; background: white; right: 8px; padding: 15px; box-shadow: 1px 11px 26px #4a4a42; border-radius: 6px;">
    <p style="color:#000000">
        Notre site Web utilise des cookies pour vous garantir <br>
        la meilleure expérience. En continuant à utiliser notre <br>
        site Web, vous consentez à notre utilisation des cookies.
        <a href=''></a>
    <p style="font-weight: bold;"><u><a style="color:#c4c8ce">En savoir plus</a></u></p>

    <button class='btn btn-primary ' onclick='activeCookie()'
        style="background: #fccd12; color: #222222; font-weight: bold; width: 100%; border: none !important; font-family: 'source sans pro', 'helvetica neue', Helvetica, arial, sans-serif, sans;">
        D'accord !
    </button>
</div>
<?php
}
?>

<script>
let chatOpen = false;
$('chat-corps').hide();

const toggleChat = () => {
    $('.chat-corps').slideToggle(400, () => {
        chatOpen = !chatOpen;
        if (chatOpen)
            $('.chat-bar-toggle').html('<i class="icofont-caret-down"></i>');
        else
            $('.chat-bar-toggle').html('<i class="icofont-caret-up"></i>');
    });

}

$('.chat-bar-toggle').on('click', toggleChat);

$('.flag-button').on('click', (event) => {
    event.preventDefault();
});
</script>