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
            /* background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDIwMCAyMDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMTAgOCkiIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCI+PGNpcmNsZSBzdHJva2U9IiMwMDAiIHN0cm9rZS13aWR0aD0iMS4yNSIgY3g9IjE3NiIgY3k9IjEyIiByPSI0Ii8+PHBhdGggZD0iTTIwLjUuNWwyMyAxMW0tMjkgODRsLTMuNzkgMTAuMzc3TTI3LjAzNyAxMzEuNGw1Ljg5OCAyLjIwMy0zLjQ2IDUuOTQ3IDYuMDcyIDIuMzkyLTMuOTMzIDUuNzU4bTEyOC43MzMgMzUuMzdsLjY5My05LjMxNiAxMC4yOTIuMDUyLjQxNi05LjIyMiA5LjI3NC4zMzJNLjUgNDguNXM2LjEzMSA2LjQxMyA2Ljg0NyAxNC44MDVjLjcxNSA4LjM5My0yLjUyIDE0LjgwNi0yLjUyIDE0LjgwNk0xMjQuNTU1IDkwcy03LjQ0NCAwLTEzLjY3IDYuMTkyYy02LjIyNyA2LjE5Mi00LjgzOCAxMi4wMTItNC44MzggMTIuMDEybTIuMjQgNjguNjI2cy00LjAyNi05LjAyNS0xOC4xNDUtOS4wMjUtMTguMTQ1IDUuNy0xOC4xNDUgNS43IiBzdHJva2U9IiMwMDAiIHN0cm9rZS13aWR0aD0iMS4yNSIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIi8+PHBhdGggZD0iTTg1LjcxNiAzNi4xNDZsNS4yNDMtOS41MjFoMTEuMDkzbDUuNDE2IDkuNTIxLTUuNDEgOS4xODVIOTAuOTUzbC01LjIzNy05LjE4NXptNjMuOTA5IDE1LjQ3OWgxMC43NXYxMC43NWgtMTAuNzV6IiBzdHJva2U9IiMwMDAiIHN0cm9rZS13aWR0aD0iMS4yNSIvPjxjaXJjbGUgZmlsbD0iIzAwMCIgY3g9IjcxLjUiIGN5PSI3LjUiIHI9IjEuNSIvPjxjaXJjbGUgZmlsbD0iIzAwMCIgY3g9IjE3MC41IiBjeT0iOTUuNSIgcj0iMS41Ii8+PGNpcmNsZSBmaWxsPSIjMDAwIiBjeD0iODEuNSIgY3k9IjEzNC41IiByPSIxLjUiLz48Y2lyY2xlIGZpbGw9IiMwMDAiIGN4PSIxMy41IiBjeT0iMjMuNSIgcj0iMS41Ii8+PHBhdGggZmlsbD0iIzAwMCIgZD0iTTkzIDcxaDN2M2gtM3ptMzMgODRoM3YzaC0zem0tODUgMThoM3YzaC0zeiIvPjxwYXRoIGQ9Ik0zOS4zODQgNTEuMTIybDUuNzU4LTQuNDU0IDYuNDUzIDQuMjA1LTIuMjk0IDcuMzYzaC03Ljc5bC0yLjEyNy03LjExNHpNMTMwLjE5NSA0LjAzbDEzLjgzIDUuMDYyLTEwLjA5IDcuMDQ4LTMuNzQtMTIuMTF6bS04MyA5NWwxNC44MyA1LjQyOS0xMC44MiA3LjU1Ny00LjAxLTEyLjk4N3pNNS4yMTMgMTYxLjQ5NWwxMS4zMjggMjAuODk3TDIuMjY1IDE4MGwyLjk0OC0xOC41MDV6IiBzdHJva2U9IiMwMDAiIHN0cm9rZS13aWR0aD0iMS4yNSIvPjxwYXRoIGQ9Ik0xNDkuMDUgMTI3LjQ2OHMtLjUxIDIuMTgzLjk5NSAzLjM2NmMxLjU2IDEuMjI2IDguNjQyLTEuODk1IDMuOTY3LTcuNzg1LTIuMzY3LTIuNDc3LTYuNS0zLjIyNi05LjMzIDAtNS4yMDggNS45MzYgMCAxNy41MSAxMS42MSAxMy43MyAxMi40NTgtNi4yNTcgNS42MzMtMjEuNjU2LTUuMDczLTIyLjY1NC02LjYwMi0uNjA2LTE0LjA0MyAxLjc1Ni0xNi4xNTcgMTAuMjY4LTEuNzE4IDYuOTIgMS41ODQgMTcuMzg3IDEyLjQ1IDIwLjQ3NiAxMC44NjYgMy4wOSAxOS4zMzEtNC4zMSAxOS4zMzEtNC4zMSIgc3Ryb2tlPSIjMDAwIiBzdHJva2Utd2lkdGg9IjEuMjUiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIvPjwvZz48L3N2Zz4='); */
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
        <div id="chat-bar" class="col-xl-3 col-md-4 col-12">
            <div class="chat-box-header">
                <a data-toggle="dropdown" href="#" class="flag-button"><img style="margin-top: -5px; margin-right : 5px" width="25" src="<?php echo $base_url . "images/flags/" . strtolower($mbrePaysChat) . ".svg" ?>" /></a>
                <div class="dropdown-menu">
                    <?php foreach ($rooms as $room) { ?>
                        <a class="dropdown-item" href="<?php echo $base_url . "traitements/changerPaysChat.php?pays=" . $room['pays'] ?>"><?php echo $room['pays']; ?> <img style="margin-top: -4px; margin-right : 5px; margin-left : 5px" width="17" src="<?php echo $base_url . "images/flags/" . strtolower($room['pays']) . ".svg" ?>" /></a>
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

                        </div><!--chat-log -->
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
    <?php } ?>

    <div class="chat-box chat-area">
        <div class="chat-box-header">
            <div class="btn-group btn-group-dropdown user-connected">
                <button type="button" class="btn-default dropdown-toggle room-dropdown-btn" data-toggle="dropdown" aria-expanded="false">
                    Room <?php echo strtoupper($mbrePays); ?>
                </button>
                <input type="hidden" id="room-user" value="<?= strtoupper($mbrePays) ?>">
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
        <!--<div class="chat-box-header">
            <i class="icofont-1x icofont-chat"></i>
            Chat (<?php echo $nbMbreActifs ?>)
            <span class=" chat-box-toggle"><i class="icofont-close"></i></span>
        </div>-->
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
    <div id='cookie_acceuil' style="background: #dee1e5; box-shadow: none !important; padding: 30px 30px 30px 30px; position: fixed; bottom: 47px; z-index: 5; background: white; right: 8px; padding: 15px; box-shadow: 1px 11px 26px #4a4a42; border-radius: 6px;">
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