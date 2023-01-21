<?php
ini_set('display_errors', '1');

include('./requiert/php-global.php');
if (isset($pdo) && isset($mbreHashId)) {
    $pSql = "SELECT * FROM histo_offers WHERE idUser = '" . $mbreHashId . "' AND etat='Valid&eacute;' AND vu_header=0 ORDER BY STR_TO_DATE(date,'%d/%m/%Y à %H:%i:%s') DESC LIMIT 0,10";


    $p = $pdo->query($pSql);
    $h = $p->fetchAll(PDO::FETCH_ASSOC);
    if (count($h) > 0) {
        $nbr_io = '<b class="cloche" >' . count($h) . '</b>';
    }

    $fetch_data = $pdo->query("SELECT COUNT(*) AS 'remuneration' FROM messagerie_all WHERE id_recive='" . $_SESSION['id'] . "' AND id_response = 0 AND message_lu = 0 ORDER BY id DESC");
    $totalMissionsAttente = $fetch_data->fetch(PDO::FETCH_ASSOC);
    $totalMissionsAttente = $totalMissionsAttente['remuneration'];
}
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <title>Revenucash</title>

    <meta name="description" content="simple description for your site">
    <meta name="keywords" content="keyword1, keyword2">
    <meta name="author" content="CouponZ">

    <!-- twitter card starts from here, if you don't need remove this section -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@yourtwitterusername">
    <meta name="twitter:creator" content="@yourtwitterusername">
    <meta name="twitter:url" content="http://yourdomain.com">
    <meta name="twitter:title" content="Your home page title, max 140 char"> <!-- maximum 140 char -->
    <meta name="twitter:description" content="Your site description, maximum 140 char "> <!-- maximum 140 char -->
    <meta name="twitter:image" content="coupon/img/twittercardimg/twittercard-144-144.png"> <!-- when you post this page url in twitter , this image will be shown -->
    <!-- twitter card ends here -->

    <!-- facebook open graph starts from here, if you don't need then delete open graph related  -->
    <meta property="og:title" content="Your home page title">
    <meta property="og:url" content="http://your domain here.com">
    <meta property="og:locale" content="en_US">
    <meta property="og:site_name" content="Your site name here">
    <!--meta property="fb:admins" content="" /--> <!-- use this if you have  -->
    <meta property="og:type" content="website"> <!-- 'article' for single page  -->
    <meta property="og:image" content="coupon/img/opengraph/fbphoto-476-476.png"> <!-- when you post this page url in facebook , this image will be shown -->
    <!-- facebook open graph ends here -->

    <!-- desktop bookmark -->
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="coupon/img/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- icons & favicons -->
    <link rel="shortcut icon" type="image/x-icon" href="coupon/img/favicon/favicon.ico"> <!-- this icon shows in browser toolbar -->
    <link rel="icon" type="image/x-icon" href="coupon/img/favicon/favicon.ico"> <!-- this icon shows in browser toolbar -->
    <link rel="apple-touch-icon" sizes="57x57" href="coupon/img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="coupon/img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="coupon/img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="coupon/img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="coupon/img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="coupon/img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="coupon/img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="coupon/img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="coupon/img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="coupon/img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="coupon/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="coupon/img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="coupon/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="coupon/img/favicon/manifest.json">

    <!-- GOOGLE FONT -->
    <link href="//fonts.googleapis.com/css?family=Cabin:400,700%7CUbuntu:300,400,700" rel="stylesheet">

    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" media="all">

    <!--owl-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css" media="all">

    <!-- FONT AWESOME CSS -->
    <link rel="stylesheet" href="coupon/vendor/font-awesome/css/font-awesome.min.css" media="all">

    <!-- linearicons -->
    <link rel="stylesheet" href="coupon/vendor/linearicons/webfont/style.css" media="all">

    <!-- animate.css -->
    <link rel="stylesheet" href="coupon/vendor/animate/animate.min.css" media="all">

    <!-- flatpickr -->
    <link rel="stylesheet" href="coupon/vendor/flatpickr/flatpickr.min.css" media="all">

    <!-- lity -->
    <link rel="stylesheet" href="coupon/vendor/lity/lity.min.css" media="all">

    <!-- Bootstrap Slider -->
    <link rel="stylesheet" href="coupon/vendor/bootstrap-slider/css/bootstrap-slider.min.css" media="all">

    <!-- CUSTOM  CSS  -->
    <link id="cbx-style" rel="stylesheet" href="coupon/css/style-default.css" media="all">
    <link id="cbx-style" rel="stylesheet" href="coupon/css/custom.css" media="all">
    <link id="cbx-style" rel="stylesheet" href="coupon/css/emailing.css" media="all">
    <link id="cbx-style" rel="stylesheet" href="cash_theme/css/joweb.css" media="all">

    <!-- MODERNIZER  -->
    <script type="text/javascript" src="js/sweetalert.min.js"></script>
    <script src="coupon/vendor/modernizr/modernizr.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=News+Cycle&display=swap" rel="stylesheet">
    <script src="https://apis.google.com/js/platform.js" async defer></script>

    <!--old-->
    <link href="vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId: '3321703071194475',
                cookie: true, // Enable cookies to allow the server to access the session.
                xfbml: true, // Parse social plugins on this webpage.
                version: 'v3.2' // Use this Graph API version for this call.
            });

        };

        function testAPI() {
            FB.api('/me?fields=name,email', function(response) {
                insert(response);
            });
        }

        function insert(response) {
            var name = response.name;
            var apt = name.split(' ');
            var data = {
                nom: apt[0],
                prenom: apt[1],
                email: response.email,
                idParrain: document.getElementById('idParrain').value
            }

            $.ajax({
                url: '<?= url_site; ?>/loginSocial.php',
                type: 'POST',
                data: data,
                success: function(data) {
                    window.location.replace('<?= url_site; ?>/redirectLogin.php?id=' + data + '');
                }
            });
        }


        function onSignIn(googleUser) {

            var profile = googleUser.getBasicProfile();

            var apt = profile.getName().split(' ');

            var data = {
                nom: apt[0],
                prenom: apt[1],
                email: profile.getEmail(),
                idParrain: document.getElementById('idParrain').value
            }

            $.ajax({
                url: '<?= url_site; ?>/loginSocial.php',
                type: 'POST',
                data: data,
                success: function(data) {
                    window.location.replace('<?= url_site; ?>/redirectLogin.php?id=' + data + '');
                }
            });

        }

        function Off() {
            var cookies = document.cookie.split(";");

            for (var i = 0; i < cookies.length; i++) {
                var cookie = cookies[i];
                var eqPos = cookie.indexOf("=");
                var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
                document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
            }

            window.location.replace('deconnexion.php');
        };
    </script>




</head>

<body>
    <style>
        span.text-center.text-sm.font-medium.truncate.mt-2 {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            text-align: center;
            line-height: 1.25rem;
        }

        .text-center {
            text-align: center;
        }

        .mt-2 {
            margin-top: 0.5rem;
        }

        .text-sm {
            line-height: 1.25rem;
        }

        .font-medium {
            font-weight: 500;
        }

        .card {
            padding: 0px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            border-radius: 25px;
        }

        .my-card {
            padding: 30px 15px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            border-radius: 25px;
        }

        .card-img-top {
            width: 100%;
            height: 15vw;
            object-fit: contain;
        }

        .deal-coupon-slider-wrapper {
            position: inherit !important;
        }

        h3.titre-menu {
            color: #669bcc;
            margin-top: -18px;
            font-size: 27px;
        }

        h3.titre-menu span {
            margin-left: 22px;
        }

        li.head a {
            padding: 1px 4px 0px 24px !important;
        }

        .specified th {
            background: #669bcc !important;
            color: white;
            border-right: 1px solid;
        }

        .specified th:last-child {
            border-right: none;
        }

        div#cookie_acceuil {
            position: fixed;
            bottom: 7px;
            z-index: 5;
            background: white;
            right: 8px;
            padding: 15px;
            box-shadow: 1px 11px 26px #4a4a42;
            border-radius: 6px;
        }

        .dashboard-nav ion-icon,
        .dashboard-nav i {
            color: #525050 !important;
        }

        .dashboard-wrapper .dashboard-nav ul li a {
            color: gray;
        }

        .dashboard-wrapper h4 {
            font-size: 21px;
            color: #669bcc;
            padding-left: 14px;
        }

        .specified th {
            background: #669bcc !important;
            color: white;
            border-right: 1px solid;
        }

        .specified th:last-child {
            border-right: none;
        }

        .nparain {
            background: #efefef;
            padding: 14px 14px 14px 21px;
            border: 1px solid #dddddd;
        }

        .nparain input {
            margin-left: 15px !important;
        }

        div#copy-paraignage {
            margin-left: 7px;
        }

        div#copy-paraignage span {
            font-size: 30px;
            color: gray;
        }

        .nparain p {
            color: #6b6a6a;
        }

        h3.titre-menu {
            color: #669bcc;
            margin-top: -18px;
            font-size: 27px;
        }

        h3.titre-menu span {
            margin-left: 22px;
        }

        span.nav-tag.messages {
            border-radius: 100% !important;
            height: 18px;
            width: 18px;
            font-size: 12px !important;
        }

        span.nav-tag.messages span {
            position: absolute;
            top: -5px;
            left: 6px;
        }

        span.nav-tag.messages.notif {
            margin-right: -1px !important;
        }

        div#res_notification {
            margin: 0 auto;
            position: absolute;
            z-index: 55;
            right: 26px;
            background: black;
            border-radius: 5px;
            top: 68px;
            box-shadow: 0px 0px 12px 2px #0000002b;
            width: 600%;
        }

        div#res_notification:before {
            display: inline-block;
            width: 0;
            height: 0;
            margin-left: .255em;
            vertical-align: .255em;
            content: "";
            border-top: 0;
            border-right: .3em solid transparent;
            border-bottom: .3em solid;
            border-left: .3em solid transparent;
            position: absolute;
            right: 12px;
            font-size: 25px;
            color: white;
            top: -7px;
        }

        #res_notification .notification-dropdown-item {
            display: flex;
            align-items: center;
            padding: 15px 10px;
            border-bottom: solid 1px #e6e6e6;
        }

        #res_notification .custom-notification-type {
            display: flex;
            align-items: center;
            background: #3c763d;
            color: white;
            padding: 0 5px;
            border-radius: 2px;
            font-size: 10px;
            font-weight: 500;
        }

        #res_notification p.title {
            font-size: 12px;
        }

        #res_notification .notification-center {
            flex: 2;
            padding-left: 8px;
        }

        #res_notification .notification-center p {
            margin: 0 !important;
            line-height: 1.5;
        }

        #res_notification p.timestamp {
            font-size: 10px;
            font-weight: 100;
            color: gray;
        }

        #res_notification .notification-meta {
            font-size: 14px;
        }

        .cbx-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .dashboard-wrap {
            margin-top: 16px;
        }

        .container {
            margin: 0 !important;
            padding: 0 !important;
            width: 100%;
        }

        .col-xl-9.col-sm-9.no-padding-left-right {
            padding-left: 37px;
        }

        .dashboard-nav ul {
            box-shadow: 0px 0px 28px -22px black;
        }

        header.cbx-header {
            background: #69bd44;
        }

        .navbar-btn.pull-left a img {
            width: 145px;
        }

        .cbx-header .cbx-header-bottom .navbar .navbar-collapse .navbar-nav li a {
            padding: 20px 24px 7px 0px !important;
        }

        .cbx-header .cbx-header-bottom .navbar .navbar-collapse .navbar-nav.navbar-right li a {
            background: transparent;
            border: none;
            margin-right: 0;
            padding-right: 24px !important;
            padding-top: 12px !important;
            text-transform: uppercase;
            font-weight: bold;
            font-size: 15px;
        }

        a#showSearchBar {
            padding-right: 0px !important;
        }

        .cbx-header .cbx-header-bottom .navbar .navbar-collapse .navbar-nav.navbar-right li a:nth-child(1):after {
            content: "";
            width: 2px;
            height: 25px;
            position: absolute;
            z-index: 2;
            background: white;
            margin-left: 10px;
        }

        .navbar-btn {
            margin-top: -9px;
        }

        a#acceuil img {
            margin-top: 16px;
        }

        .cbx-header .cbx-header-bottom .navbar .navbar-collapse .navbar-nav.navbar-right li {
            display: flex !important;
            margin-top: 9px;
            margin-bottom: 7px;
            background: transparent !important;
            margin-right: 27px;
        }

        .cbx-header .cbx-header-bottom .navbar .navbar-collapse .navbar-nav.navbar-right li a:hover {
            background: transparent !important;
        }

        .btn-brand i {
            padding-right: 9px !important;
            font-size: 16px;
        }

        .dashboard-wrapper .dashboard-nav ul li a {
            font-size: 14px;
        }

        div#bs-example-navbar-collapse-1 ul li .dropdown-menu {
            padding-left: 21px;
            padding-right: 21px;
            width: 250px;
        }

        #showSearchBar span.nav-tag.messages {
            left: 14px;
        }
    </style>

    <input type="hidden" name="idParrain" id='idParrain' value="<?= isset($_SESSION['idParrain']) ? $_SESSION['idParrain'] : ''; ?>" />


    <div class="cbx-container">

        <!-- SITE CONTENT -->

        <!-- Header Part Start -->
        <header class="cbx-header">
            <!-- Header Top Part Start -->
            <div class="cbx-header-bottom">
                <div class="row">
                    <nav class="navbar navbar-default">
                        <div class="navbar-btn pull-left">

                            <a id="acceuil" href="<?php if (isset($_SESSION["email"])) {
                                                        echo "MonCompte.php";
                                                    } else {
                                                        echo "index.php";
                                                    } ?>" style="line-height: 63px;margin-left:56px; margin-bottom:56px;">
                                <!--  <img src="./theme/images/logo_final.png"> -->
                            </a>
                        </div>



                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed pull-left" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                Menu
                                <!--<span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>-->
                            </button>
                            <div class="hidden-lg hidden-md hidden-sm pull-right mobile-signin-btn">

                            </div>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                            <ul class="nav navbar-nav" style="float: right;">

                                <?php
                                if (isset($_SESSION['id'])) {
                                ?>
                                    <li style="margin-top: -1px;list-style: none">
                                        <a href="messagerie.php" id="showSearchBar" class="btn" role="button"><i style='margin:0 1vh 0 0' class="glyphicon glyphicon-envelope"></i><span class="nav-tag messages" style='background-color:orange;padding:0.5vh;color:white;border-radius:1vh'><span><?= $totalMissionsAttente; ?></span></span></a>
                                    </li>
                                    <li style="margin-left: 20px;">
                                        <a href="#" onClick='OpenNotification()'>
                                            <span class="" style=''></span><i class=""></i>

                                            <span class="" style=''><span></span>
                                                <div id='menuUsers_notification' class='bg-white shadow border-radius'>
                                                    <div id='res_notification'>


                                                    </div>
                                        </a>
                                    </li>

                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                            <span class="glyphicon glyphicon-user color-white" aria-hidden="true"></span>
                                        </a>

                                        <ul class="dropdown-menu account-dropdown-menu">
                                            <span class="text-center text-sm font-medium truncate mt-2">
                                                <?= $mbreNom ?> <?= $mbrePrenom ?>
                                            </span>
                                            <hr>


                                            <li><a class="dropdown-item" href="chatroom.php">Chatroom <i style='margin:0 1vh 0 0; float: right' class="glyphicon glyphicon-comment"></i></a></li>
                                            <li><a class="dropdown-item" href="mission.php">Gagner de l'argent <i style='margin:0 1vh 0 0; float: right' class="glyphicon glyphicon-usd"></i></a></li>
                                            <li><a class="dropdown-item" href="parrainage.php">Parrainage <i style='margin:0 1vh 0 0; float: right' class="glyphicon glyphicon-fullscreen"></i></a></li>
                                            <li><a class="dropdown-item" href="payement.php">Payement <i style='margin:0 1vh 0 0; float: right' class="glyphicon glyphicon-piggy-bank"></i></a></li>
                                            <li><a class="dropdown-item" href="mes-commandes.php">Mes Commandes <i style='margin:0 1vh 0 0; float: right' class="glyphicon glyphicon-folder-open"></i></a></li>
                                            <li><a class="dropdown-item" href="offre_mur.php">Offre mur <i style='margin:0 1vh 0 0; float: right' class="glyphicon glyphicon-piggy-bank"></i></a></li>
                                            <li><a class="dropdown-item" href="emailing.php">Emailing <i style='margin:0 1vh 0 0; float: right' class="glyphicon glyphicon-piggy-bank"></i></a></li>
                                            <li><a class="dropdown-item" href="mes-participations.php">Mes Participations<i style='margin:0 1vh 0 0; float: right' class="glyphicon glyphicon-list-alt"></i></a></li>


                                            <li>
                                                <div class="dropdown-divider"></div>
                                            </li>
                                        </ul>
                                    </li>

                                    <li>
                                        <a onclick="Off()" class="dropdown-item" style="cursor: pointer;"><ion-icon name="power"></ion-icon></a>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>

                            <ul class="nav navbar-nav navbar-right hidden-xs">


                            </ul>
                        </div><!-- /.navbar-collapse -->

                    </nav>
                </div>
            </div>

            <div id="searchBar" class="collapse" style="background: #fff;">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="searchbar-wrapper">
                                <form class="navbar-form" role="search">
                                    <div class="input-group">
                                        <input autocomplete="off" type="text" class="form-control" placeholder="Search" name="q">
                                        <div class="input-group-btn">
                                            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Header Top Part End -->

            <!-- Header Bottom Part Start -->
        </header>