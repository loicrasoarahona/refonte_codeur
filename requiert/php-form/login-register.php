<?php
require 'vendor/autoload.php';
require_once $_ROOT . '/requiert/service-mail/mail.php';

$mailService = new ServiceMail\MailAction();

// Début : Inscription
if (!empty($_POST['nom'])): $post_reg_nom = ucfirst(addslashes(htmlentities($_POST['nom'])));
else: $post_reg_nom = null;
endif;
if (!empty($_POST['prenom'])): $post_reg_prenom = ucfirst(addslashes(htmlentities($_POST['prenom'])));
else: $post_reg_prenom = null;
endif;
if (!empty($_POST['email'])): $post_reg_email = strtolower(addslashes(htmlentities($_POST['email'])));
else: $post_reg_email = null;
endif;
if (!empty($_POST['password'])): $post_reg_mdp = addslashes(htmlentities($_POST['password']));
else: $post_reg_mdp = null;
endif;

$post_reg_news = 0 ;
if (!empty($_POST['news'])){
    $post_reg_news = addslashes(htmlentities($_POST['news']));
    $post_reg_news = $post_reg_news == 1 ? 1 : 0 ; 
} 

if (!empty($_POST['idParrain'])): $post_idParrain = addslashes(htmlentities($_POST['idParrain']));
else: $post_idParrain = null; 
endif;

if (!empty($_POST["submit_register"])) {
    if (!empty($_POST["nom"]) && 
        !empty($_POST["prenom"]) && 
        !empty($_POST["email"]) && 
        !empty($_POST["password"])){            
            $country_block=array(
                'ZA',
                'DZ',
                'AO',
                'BJ',
                'BW',
                'BF',
                'BI',
                'CV',
                'CM',
                'KM',
                'CD',
                'CG',
                'CI',
                'DJ',
                'EG',
                'ER',
                'ET',
                'GA',
                'GM',
                'GH',
                'GN',
                'GQ',
                'KE',
                'LS',
                'LR',
                'LY',
                'MG',
                'MW',
                'ML',
                'MA',
                'MU',
                'MR',
				'NO',
                'YT',
                'MZ',
                'NA',
                'NE',
                'NG',
                'UG',
                'CF',
                'RE',
                'RW',
                'SN',
                'SC',
                'SL',
                'SO',
                'SD',
                'SS',
                'SZ',
                'TZ',
                'TD',
                'TG',
                'TN',
                'ZM'
            );
            


            $details = json_decode(file_get_contents("http://ipinfo.io/".ip.""));
            
            $isLocalhost = (ip == '127.0.0.1');
            if($isLocalhost || (isset($details->country) && !in_array($details->country,$country_block))){
                $country = $isLocalhost?'FR':$details->country;
                if (preg_match("!^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-zA-Z]{2,4}$!", $post_reg_email)) {
                        $sql_RegCount = $pdo->query("SELECT COUNT(id) as 'total' FROM users WHERE email = '" . $post_reg_email . "'");
                        $dns_RegCount = $sql_RegCount->fetch(PDO::FETCH_ASSOC);
                        $nb_RegCount = addslashes(htmlentities($dns_RegCount['total']));

                        $ip_verifi = $pdo->query("SELECT COUNT(id) as 'total' FROM users WHERE ip = '".ip."'");
                        $fetch_if = $ip_verifi->fetch(PDO::FETCH_ASSOC);
                        $verifi = addslashes(htmlentities($fetch_if['total']));

                        if($verifi == 0){

                            // modif
                        if ($nb_RegCount == 0) {

                                $reponsConfirm = 'Bravo, vous êtes maintenant inscrit ! Un e-mail de confirmation vous a été envoyé.';
                                $button = '"Fermer"';
                                
                                if (!$post_idParrain || !is_numeric($post_idParrain) || empty($post_idParrain)) {
                                    $post_idParrain = 0;
                                }
                                $post_idParrain = intval($post_idParrain.'');

                                $sqlRec = "INSERT INTO `users` (`hashId`, `email`, `mdp`, `nom`, `prenom`, `pays`, `ip`, `idParrain`, `news` ,`date_Inscription`) VALUES ('" . code(25) . "', '" . $post_reg_email . "', '" . sha1(md5($post_reg_mdp)) . "', '" . $post_reg_nom . "', '" . $post_reg_prenom . "', '" . $country_code . "', '" . ip . "', ".$post_idParrain.", '" . $post_reg_news . "' , NOW())";
                                //echo $sqlRec."<br>";
                                $pdo->exec($sqlRec);

                                

                                if($post_reg_news == 1){
                                    $pdo->exec("INSERT INTO `newletter`
                                    (`newLetter_email`) VALUES ('" .$post_reg_email. "')
                                ");
                                }    
                            
                                $messageM=' 
                                    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
                                    <html xmlns="http://www.w3.org/1999/xhtml">
                                    <head>
                                        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
                                        <meta name="format-detection" content="telephone=no" /> <!-- disable auto telephone linking in iOS -->
                                        <title>Respmail is a response HTML email designed to work on all major email platforms and smartphones</title>
                                        <style type="text/css">
                                            /* RESET STYLES */
                                            html { background-color:#E1E1E1; margin:0; padding:0; }
                                            body, #bodyTable, #bodyCell, #bodyCell{height:100% !important; margin:0; padding:0; width:100% !important;font-family:Helvetica, Arial, "Lucida Grande", sans-serif;}
                                            table{border-collapse:collapse;}
                                            table[id=bodyTable] {width:100%!important;margin:auto;max-width:500px!important;color:#7A7A7A;font-weight:normal;}
                                            img, a img{border:0; outline:none; text-decoration:none;height:auto; line-height:100%;}
                                            a {text-decoration:none !important;border-bottom: 1px solid;}
                                            h1, h2, h3, h4, h5, h6{color:#5F5F5F; font-weight:normal; font-family:Helvetica; font-size:20px; line-height:125%; text-align:Left; letter-spacing:normal;margin-top:0;margin-right:0;margin-bottom:10px;margin-left:0;padding-top:0;padding-bottom:0;padding-left:0;padding-right:0;}

                                            /* CLIENT-SPECIFIC STYLES */
                                            .ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotmail/Outlook.com to display emails at full width. */
                                            .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div{line-height:100%;} /* Force Hotmail/Outlook.com to display line heights normally. */
                                            table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;} /* Remove spacing between tables in Outlook 2007 and up. */
                                            #outlook a{padding:0;} /* Force Outlook 2007 and up to provide a "view in browser" message. */
                                            img{-ms-interpolation-mode: bicubic;display:block;outline:none; text-decoration:none;} /* Force IE to smoothly render resized images. */
                                            body, table, td, p, a, li, blockquote{-ms-text-size-adjust:100%; -webkit-text-size-adjust:100%; font-weight:normal!important;} /* Prevent Windows- and Webkit-based mobile platforms from changing declared text sizes. */
                                            .ExternalClass td[class="ecxflexibleContainerBox"] h3 {padding-top: 10px !important;} /* Force hotmail to push 2-grid sub headers down */

                                            /* /\/\/\/\/\/\/\/\/ TEMPLATE STYLES /\/\/\/\/\/\/\/\/ */

                                            /* ========== Page Styles ========== */
                                            h1{display:block;font-size:26px;font-style:normal;font-weight:normal;line-height:100%;}
                                            h2{display:block;font-size:20px;font-style:normal;font-weight:normal;line-height:120%;}
                                            h3{display:block;font-size:17px;font-style:normal;font-weight:normal;line-height:110%;}
                                            h4{display:block;font-size:18px;font-style:italic;font-weight:normal;line-height:100%;}
                                            .flexibleImage{height:auto;}
                                            .linkRemoveBorder{border-bottom:0 !important;}
                                            table[class=flexibleContainerCellDivider] {padding-bottom:0 !important;padding-top:0 !important;}

                                            body, #bodyTable{background-color:#fff;}
                                            #emailHeader{background-color:#fff;}
                                            #emailBody{background-color:#fff;}
                                            #emailFooter{background-color:#fff;}
                                            .nestedContainer{background-color:#F8F8F8; border:1px solid #CCCCCC;}
                                            .emailButton{background-color:#205478; border-collapse:separate;}
                                            .buttonContent{color:#FFFFFF; font-family:Helvetica; font-size:18px; font-weight:bold; line-height:100%; padding:15px; text-align:center;}
                                            .buttonContent a{color:#FFFFFF; display:block; text-decoration:none!important; border:0!important;}
                                            .emailCalendar{background-color:#FFFFFF; border:1px solid #CCCCCC;}
                                            .emailCalendarMonth{background-color:#205478; color:#FFFFFF; font-family:Helvetica, Arial, sans-serif; font-size:16px; font-weight:bold; padding-top:10px; padding-bottom:10px; text-align:center;}
                                            .emailCalendarDay{color:#205478; font-family:Helvetica, Arial, sans-serif; font-size:60px; font-weight:bold; line-height:100%; padding-top:20px; padding-bottom:20px; text-align:center;}
                                            .imageContentText {margin-top: 10px;line-height:0;}
                                            .imageContentText a {line-height:0;}
                                            #invisibleIntroduction {display:none !important;} /* Removing the introduction text from the view */

                                            /*FRAMEWORK HACKS & OVERRIDES */
                                            span[class=ios-color-hack] a {color:#275100!important;text-decoration:none!important;} /* Remove all link colors in IOS (below are duplicates based on the color preference) */
                                            span[class=ios-color-hack2] a {color:#205478!important;text-decoration:none!important;}
                                            span[class=ios-color-hack3] a {color:#8B8B8B!important;text-decoration:none!important;}
                                            /* A nice and clean way to target phone numbers you want clickable and avoid a mobile phone from linking other numbers that look like, but are not phone numbers.  Use these two blocks of code to "unstyle" any numbers that may be linked.  The second block gives you a class to apply with a span tag to the numbers you would like linked and styled.
                                            Inspired by Campaign Monitor\'s article on using phone numbers in email: http://www.campaignmonitor.com/blog/post/3571/using-phone-numbers-in-html-email/.
                                            */
                                            .a[href^="tel"], a[href^="sms"] {text-decoration:none!important;color:#606060!important;pointer-events:none!important;cursor:default!important;}
                                            .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {text-decoration:none!important;color:#606060!important;pointer-events:auto!important;cursor:default!important;}


                                            /* MOBILE STYLES */
                                            @media only screen and (max-width: 480px){
                                                /*////// CLIENT-SPECIFIC STYLES //////*/
                                                body{width:100% !important; min-width:100% !important;} /* Force iOS Mail to render the email at full width. */

                                                /* FRAMEWORK STYLES */
                                                /*
                                                CSS selectors are written in attribute
                                                selector format to prevent Yahoo Mail
                                                from rendering media query styles on
                                                desktop.
                                                */
                                                /*td[class="textContent"], td[class="flexibleContainerCell"] { width: 100%; padding-left: 10px !important; padding-right: 10px !important; }*/
                                                table[id="emailHeader"],
                                                table[id="emailBody"],
                                                table[id="emailFooter"],
                                                table[class="flexibleContainer"],
                                                td[class="flexibleContainerCell"] {width:100% !important;}
                                                td[class="flexibleContainerBox"], td[class="flexibleContainerBox"] table {display: block;width: 100%;text-align: left;}
                                                /*
                                                The following style rule makes any
                                                image classed with \'flexibleImage\'
                                                fluid when the query activates.
                                                Make sure you add an inline max-width
                                                to those images to prevent them
                                                from blowing out.
                                                */
                                                td[class="imageContent"] img {height:auto !important; width:100% !important; max-width:100% !important; }
                                                img[class="flexibleImage"]{height:auto !important; width:100% !important;max-width:100% !important;}
                                                img[class="flexibleImageSmall"]{height:auto !important; width:auto !important;}


                                                /*
                                                Create top space for every second element in a block
                                                */
                                                table[class="flexibleContainerBoxNext"]{padding-top: 10px !important;}

                                                /*
                                                Make buttons in the email span the
                                                full width of their container, allowing
                                                for left- or right-handed ease of use.
                                                */
                                                table[class="emailButton"]{width:100% !important;}
                                                td[class="buttonContent"]{padding:0 !important;}
                                                td[class="buttonContent"] a{padding:15px !important;}

                                            }

                                            /*  CONDITIONS FOR ANDROID DEVICES ONLY
                                            *   http://developer.android.com/guide/webapps/targeting.html
                                            *   http://pugetworks.com/2011/04/css-media-queries-for-targeting-different-mobile-devices/ ;
                                            =====================================================*/

                                            @media only screen and (-webkit-device-pixel-ratio:.75){
                                                /* Put CSS for low density (ldpi) Android layouts in here */
                                            }

                                            @media only screen and (-webkit-device-pixel-ratio:1){
                                                /* Put CSS for medium density (mdpi) Android layouts in here */
                                            }

                                            @media only screen and (-webkit-device-pixel-ratio:1.5){
                                                /* Put CSS for high density (hdpi) Android layouts in here */
                                            }
                                            /* end Android targeting */

                                            /* CONDITIONS FOR IOS DEVICES ONLY
                                            =====================================================*/
                                            @media only screen and (min-device-width : 320px) and (max-device-width:568px) {

                                            }
                                            /* end IOS targeting */
                                        </style>
                                        <!--
                                            Outlook Conditional CSS
                                            These two style blocks target Outlook 2007 & 2010 specifically, forcing
                                            columns into a single vertical stack as on mobile clients. This is
                                            primarily done to avoid the \'page break bug\' and is optional.
                                            More information here:
                                            http://templates.mailchimp.com/development/css/outlook-conditional-css
                                        -->
                                        <!--[if mso 12]>
                                            <style type="text/css">
                                                .flexibleContainer{display:block !important; width:100% !important;}
                                            </style>
                                        <![endif]-->
                                        <!--[if mso 14]>
                                            <style type="text/css">
                                                .flexibleContainer{display:block !important; width:100% !important;}
                                            </style>
                                        <![endif]-->
                                    </head>
                                    <body bgcolor="#1111" leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">

                                        <!-- CENTER THE EMAIL // -->
                                        <!--
                                        1.  The center tag should normally put all the
                                            content in the middle of the email page.
                                            I added "table-layout: fixed;" style to force
                                            yahoomail which by default put the content left.
                                        2.  For hotmail and yahoomail, the contents of
                                            the email starts from this center, so we try to
                                            apply necessary styling e.g. background-color.
                                        -->
                                        <center style="background-color:#fff;">
                                            <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable" style="table-layout: fixed;max-width:100% !important;width: 100% !important;min-width: 100% !important;">
                                                <tr>
                                                    <td align="center" valign="top" id="bodyCell">

                                                        <!-- EMAIL HEADER // -->
                                                        <!--
                                                            The table "emailBody" is the email\'s container.
                                                            Its width can be set to 100% for a color band
                                                            that spans the width of the page.
                                                        -->
                                            
                                                        <!-- // END -->

                                                        <!-- EMAIL BODY // -->
                                                        <!--
                                                            The table "emailBody" is the email\'s container.
                                                            Its width can be set to 100% for a color band
                                                            that spans the width of the page.
                                                        -->
                                                        <table bgcolor="#F1F4F8"  border="0" cellpadding="0" cellspacing="0" width="500" id="emailBody">
                                                        <tr>
                                                        <td align="center" valign="top">
                                                            <!-- CENTERING TABLE // -->
                                                            <!--
                                                                The centering table keeps the content
                                                                tables centered in the emailBody table,
                                                                in case its width is set to 100%.
                                                            -->
                                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="color:#FFFFFF;">
                                                            
                                                            <tr>
                                                                <td align="center" valign="top">
                                                                    <!-- FLEXIBLE CONTAINER // -->
                                                                    <!--
                                                                        The flexible container has a set width
                                                                                    that gets overridden by the media query.
                                                                                    Most content tables within can then be
                                                                                    given 100% widths.
                                                                                -->
                                                                                <table border="0" cellpadding="0" cellspacing="0" width="500" class="flexibleContainer">
                                                                                    <tr>
                                                                                        <td align="center" valign="top" width="500" class="flexibleContainerCell">

                                                                                            <!-- CONTENT TABLE // -->
                                                                                            <!--
                                                                                            The content table is the first element
                                                                                                that\'s entirely separate from the structural
                                                                                                framework of the email.
                                                                                            -->
                                                                                            <table border="0" cellpadding="30" cellspacing="0" width="100%">
                                                                                                <tr>
                                                                                                    <td valign="top" class="textContent">
                                                                                                        <img class="img-responsive" style="width:120px" src="cid:logo"/>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </table>
                                                                                            <!-- // CONTENT TABLE -->

                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                                <!-- // FLEXIBLE CONTAINER -->
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                    <!-- // CENTERING TABLE -->
                                                                </td>
                                                            </tr>


                                                            <!-- MODULE ROW // -->
                                                            <!--  The "mc:hideable" is a feature for MailChimp which allows
                                                                you to disable certain row. It works perfectly for our row structure.
                                                                http://kb.mailchimp.com/article/template-language-creating-editable-content-areas/
                                                            -->
                                                            <tr mc:hideable>
                                                                <td align="center" valign="top">
                                                                    <!-- CENTERING TABLE // -->
                                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                                        <tr>
                                                                            <td align="center" valign="top">
                                                                                <!-- FLEXIBLE CONTAINER // -->
                                                                                <table border="0" cellpadding="30" cellspacing="0" width="500" class="flexibleContainer">
                                                                                    <tr>
                                                                                        <td valign="top" width="500" class="flexibleContainerCell">

                                                                                            <!-- CONTENT TABLE // -->
                                                                                            <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                                                                <tr>
                                                                                                    <td align="right" valign="middle" class="flexibleContainerBox">
                                                                                                            <tr>
                                                                                                                <td align="left" class="textContent">
                                                                                                                    <h3 style="style="color:#333333 !important;line-height:125%;font-family:Century Gothic;font-size:20px;font-weight:bold;margin-top:0;margin-bottom:8px;text-align:left;">Bienvenu(e) à bord !</h3>
                                                                                                                    <div style="text-align:left;font-family:Century Gothic;font-size:15px;margin-bottom:0;color:#929292;line-height:135%;">
                                                                                                                         Bonjour  ' . $post_reg_prenom . ',
                                                                                                                        Merci de votre inscription sur <b>' . nom_site . ' </b> !<br/><br/>
                                                                                                                        Afin de pouvoir vous connecter, nous vous invitons à cliquer ou de copier/coller le lien de confirmation suivant dans votre barre de navigation.<br/><br/>
                                                                                                                    </div>
                                                                                                                    <div class="row" style="font-family: Arial;">
                                                                                                                        <div class="col-8" style="font-family: Arial; padding-top: 2%; color: #333333; ">
                                                                                                                            <strong><u>Vos données de connexion sont les suivantes :</u></strong><br/><br/>
                                                                                                                            <strong>Adresse e-mail :</strong> ' . $post_reg_email . '<br/>
                                                                                                                            <strong>Mot de passe :</strong> ' . $post_reg_mdp . '<br/><br/>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </table>
                                                                                            <!-- // CONTENT TABLE -->

                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                                <!-- // FLEXIBLE CONTAINER -->
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                    <!-- // CENTERING TABLE -->
                                                                </td>
                                                            </tr>
                                                            <!-- // MODULE ROW -->


                                                            <!-- MODULE ROW // -->
                                                            <tr>
                                                                <td align="center" valign="top">
                                                                    <!-- CENTERING TABLE // -->
                                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                                        <tr style="padding-top:0;">
                                                                            <td align="center" valign="top">
                                                                                <!-- FLEXIBLE CONTAINER // -->
                                                                                <table border="0" cellpadding="30" cellspacing="0" width="500" class="flexibleContainer">
                                                                                    <tr>
                                                                                        <td style="padding-top:0;" align="center" valign="top" width="500" class="flexibleContainerCell">

                                                                                            <!-- CONTENT TABLE // -->
                                                                                            <table border="0" cellpadding="0" cellspacing="0" width="50%" class="emailButton" style="background-color: #3498DB;">
                                                                                                <tr>
                                                                                                    <td align="center" valign="middle" class="buttonContent" style="padding-top:15px;padding-bottom:15px;padding-right:15px;padding-left:15px;">
                                                                                                    <a href="' . url_site . '/register?confirm=1&userEmail=' . $post_reg_email . '&token=' . sha1(md5($post_reg_mdp)) . '" style="color:#FFFFFF;text-decoration:none;font-family:Helvetica,Arial,sans-serif;font-size:20px;line-height:135%;" target="_blank">Confirmation</a>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </table>
                                                                                            <!-- // CONTENT TABLE -->

                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                                <!-- // FLEXIBLE CONTAINER -->
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                    <!-- // CENTERING TABLE -->
                                                                </td>
                                                            </tr>
                                                            <!-- // MODULE ROW -->


                                                            <!-- MODULE ROW // -->
                                                            <tr>
                                                                <td align="center" valign="top">
                                                                    <!-- CENTERING TABLE // -->
                                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#F8F8F8">
                                                                        <tr>
                                                                            <td align="center" valign="top">
                                                                                <!-- FLEXIBLE CONTAINER // -->
                                                                                <table border="0" cellpadding="0" cellspacing="0" width="500" class="flexibleContainer">
                                                                                    <tr>
                                                                                        <td align="center" valign="top" width="500" class="flexibleContainerCell">
                                                                                            <table border="0" cellpadding="30" cellspacing="0" width="100%">
                                                                                                <tr>
                                                                                                    <td align="center" valign="top">

                                                                                                        <!-- CONTENT TABLE // -->
                                                                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                                                                            <tr>
                                                                                                                <td valign="top" class="textContent">
                                                                                                                    <!--
                                                                                                                        The "mc:edit" is a feature for MailChimp which allows
                                                                                                                        you to edit certain row. It makes it easy for you to quickly edit row sections.
                                                                                                                        http://kb.mailchimp.com/templates/code/create-editable-content-areas-with-mailchimps-template-language
                                                                                                                    -->
                                                                                                                    <h3 mc:edit="header"
                                                                                                                    style="color:#5F5F5F;line-height:125%;font-family:Helvetica,Arial,sans-serif;font-size:15px;font-weight:normal;margin-top:0;margin-bottom:3px;text-align:left;">Copyright © 2022, revenucash.com - Tous droits réservés </h3>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </table>
                                                                                                        <!-- // CONTENT TABLE -->

                                                                                                    </td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                                <!-- // FLEXIBLE CONTAINER -->
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                    <!-- // CENTERING TABLE -->
                                                                </td>
                                                            </tr>
                                                            <!-- // MODULE ROW -->
                                                
                                                    </td>
                                                </tr>
                                            </table>
                                        </center>
                                    </body>
                                    </html>

                                ';

                                $mailService->sendSMTP($post_reg_email, 'Confirmation d\'inscription', $messageM, [
                                    ['images/logo_final_bleu.png', 'logo']
                                ]);
                                
                        
                            } else {
                                $reponsError = 'Cette adresse e-mail est déjà inscrite.';
                                $button = '"Fermer"';
                            }
                            
                            } else {
                                $reponsError = 'Vous ne pouvez pas avoir plusieurs comptes.';
                                $button = '"Fermer"';
                            }
                                
                        
                } else {
                    $reponsError = 'L\'adresse e-mail entrée est incorrecte.';
                    $button = '"Fermer"';
                }

            } else {
                        $reponsError = 'Vous ne pouvez pas vous inscrire dans votre pays ';
                        $button = '"Fermer"';
                    }
                
    } else {
        $reponsError = 'Tous les champs sont requis pour votre inscription.';
        $button = '"Fermer"';
    }

}
// Fin : Inscription

// Début : Connexion
if (!empty($_POST['email'])): 
    $post_log_email = addslashes(htmlentities($_POST['email']));
else: 
    $post_log_email = null;
endif;

if (!empty($_POST['mdp'])): 
    $post_log_mdp = addslashes(htmlentities($_POST['mdp']));
else: 
    $post_log_mdp = null;
endif;


if (!empty($_POST["submit_login"])) {
    if (empty($_POST['email']) OR (empty($_POST['mdp']) && empty($_POST["token"]))) {
        $reponsError = 'Vous devez remplir tous les champs.';
        $button = '"Fermer"';
    } else {
//        session_destroy();
        
        if (isset($_SESSION['id'])) {
//            var_dump('ok3'); die();
            $reponsError = 'Désolé mais vous êtes déjà connecté.';
            $button = '"Fermer"';
        } else {
//            var_dump('ok4'); die();
            $req = $pdo->prepare('SELECT id, nom, prenom, email, mdp, actif, banni, datelastco, level FROM users WHERE email=:email');
            $req->bindValue(":email", $_POST['email']);
            $req->execute();

            $result_req = $req->fetch(PDO::FETCH_OBJ);
//            echo '<pre>';
//            print_r($result_req);
//            echo '</pre>';
//            die();
            if (empty($result_req)) {
                $reponsError = "L'adresse email entrée n'existe pas dans la base.";
                $button = '"Fermer"';
            } else {
                
                if ($result_req->actif == 1) {

                    if ($result_req->banni == 0) {
                        
                        if ($result_req->mdp == sha1(md5($_POST['mdp'])) || ($result_req->mdp == $_POST["token"] && $validationCompte)) {
                            

                                /* setcookie('id_user', $result_req->id); */

                                $_SESSION['id'] = $result_req->id;
                                $_SESSION['email'] = $result_req->email;
                                $_SESSION['level'] = $result_req->level;

                                $name = $result_req->nom . " " . $result_req->prenom;
                                $_SESSION['name'] = trim($name);
                                   
                                $sql = $pdo->prepare('SELECT idUser,email,ip FROM users_infos WHERE idUser = :idUser');
//                                $sql = $pdo->prepare('SELECT * FROM users INNER JOIN users_infos ON users.id = users_infos.idUser WHERE users_infos.idUser = users.id AND users.level = 1');
                                $sql->bindValue(":idUser", $result_req->id);
                                $sql->execute();
                                $res = $sql->fetch(PDO::FETCH_OBJ);
                                //  $sql = $pdo->prepare('SELECT id,email,ip FROM users WHERE idUser = :idUser');
                                // $sql->bindValue(":idUser", $result_req->id);
                                // $sql->execute();
                                // $res = $sql->fetch(PDO::FETCH_OBJ);
                                if(!empty($res)){
                                    $_SESSION['email_offre'] = $res->email;
                                    $_SESSION['ip'] = $res->ip;
                                }

                                $reponsSucess = "https://" . $_SERVER["HTTP_HOST"] . "/dashboard";
                                $button = 'false';
                                
                                $post_log_email = null;

                                if ($validationCompte)
                                {
                                    redirect($reponsSucess);
                                }
                        } else {
                            $reponsError = 'Mot de passe incorrect.';
                            $button = '"Fermer"';
                        }
                    } else {
                        $reponsBanni = 'Oups, il semble que vous avez été banni ! Redirection en cours...';
                        $button = 'false';
                        $redirectionLogin = url_site;
                        $post_log_email = null;
                    }
                } else {
                    $reponsError = 'Votre compte est inactif. Veuillez vérifier vos e-mails et confirmer votre inscription. (Contactez-nous si vous ne trouvez pas cet e-mail)';
                    $button = '"Fermer"';
                }
            }
        }
    }
}

if (!empty($_POST["submit_reset_mdp"])) {
    if (empty($_POST['email'])) {
        $reponsError = 'Vous devez remplir tous les champs.';
        $button = '"Fermer"';
    } else {
        if (isset($_SESSION['id'])) {
            $reponsError = 'Désolé mais vous êtes déjà connecté.';
            $button = '"Fermer"';
        } else {
            $req = $pdo->prepare('SELECT *  FROM users WHERE email=?');
            $req->execute(array($_POST['email']));


            if ($req->rowCount() === 0) {
                $reponsError = 'Les identifiants entrés ne sont pas correct.';
                $button = '"Fermer"';
            } else {

                $result_req = $req->fetch(PDO::FETCH_OBJ);
                // $headers = 'MIME-Version: 1.0' . "\r\n";
                // $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
                // $headers .= "From: renitialiser les mot de passe cashbackreduction.com <webmaster@cashbackreduction.com>\n";
                // $headers .= "Reply-To: No Reply <webmaster@cashbackreduction.com>\n";


                $messageM=' 
  

                    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
                    <html xmlns="http://www.w3.org/1999/xhtml">
                    <head>
                        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
                        <meta name="format-detection" content="telephone=no" /> <!-- disable auto telephone linking in iOS -->
                        <title>Respmail is a response HTML email designed to work on all major email platforms and smartphones</title>
                        <style type="text/css">
                            /* RESET STYLES */
                            html { background-color:#E1E1E1; margin:0; padding:0; }
                            body, #bodyTable, #bodyCell, #bodyCell{height:100% !important; margin:0; padding:0; width:100% !important;font-family:Helvetica, Arial, "Lucida Grande", sans-serif;}
                            table{border-collapse:collapse;}
                            table[id=bodyTable] {width:100%!important;margin:auto;max-width:500px!important;color:#7A7A7A;font-weight:normal;}
                            img, a img{border:0; outline:none; text-decoration:none;height:auto; line-height:100%;}
                            a {text-decoration:none !important;border-bottom: 1px solid;}
                            h1, h2, h3, h4, h5, h6{color:#5F5F5F; font-weight:normal; font-family:Helvetica; font-size:20px; line-height:125%; text-align:Left; letter-spacing:normal;margin-top:0;margin-right:0;margin-bottom:10px;margin-left:0;padding-top:0;padding-bottom:0;padding-left:0;padding-right:0;}

                            /* CLIENT-SPECIFIC STYLES */
                            .ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotmail/Outlook.com to display emails at full width. */
                            .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div{line-height:100%;} /* Force Hotmail/Outlook.com to display line heights normally. */
                            table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;} /* Remove spacing between tables in Outlook 2007 and up. */
                            #outlook a{padding:0;} /* Force Outlook 2007 and up to provide a "view in browser" message. */
                            img{-ms-interpolation-mode: bicubic;display:block;outline:none; text-decoration:none;} /* Force IE to smoothly render resized images. */
                            body, table, td, p, a, li, blockquote{-ms-text-size-adjust:100%; -webkit-text-size-adjust:100%; font-weight:normal!important;} /* Prevent Windows- and Webkit-based mobile platforms from changing declared text sizes. */
                            .ExternalClass td[class="ecxflexibleContainerBox"] h3 {padding-top: 10px !important;} /* Force hotmail to push 2-grid sub headers down */

                            /* /\/\/\/\/\/\/\/\/ TEMPLATE STYLES /\/\/\/\/\/\/\/\/ */

                            /* ========== Page Styles ========== */
                            h1{display:block;font-size:26px;font-style:normal;font-weight:normal;line-height:100%;}
                            h2{display:block;font-size:20px;font-style:normal;font-weight:normal;line-height:120%;}
                            h3{display:block;font-size:17px;font-style:normal;font-weight:normal;line-height:110%;}
                            h4{display:block;font-size:18px;font-style:italic;font-weight:normal;line-height:100%;}
                            .flexibleImage{height:auto;}
                            .linkRemoveBorder{border-bottom:0 !important;}
                            table[class=flexibleContainerCellDivider] {padding-bottom:0 !important;padding-top:0 !important;}

                            body, #bodyTable{background-color:#E1E1E1;}
                            #emailHeader{background-color:#E1E1E1;}
                            #emailBody{background-color:#FFFFFF;}
                            #emailFooter{background-color:#E1E1E1;}
                            .nestedContainer{background-color:#F8F8F8; border:1px solid #CCCCCC;}
                            .emailButton{background-color:#205478; border-collapse:separate;}
                            .buttonContent{color:#FFFFFF; font-family:Helvetica; font-size:18px; font-weight:bold; line-height:100%; padding:15px; text-align:center;}
                            .buttonContent a{color:#FFFFFF; display:block; text-decoration:none!important; border:0!important;}
                            .emailCalendar{background-color:#FFFFFF; border:1px solid #CCCCCC;}
                            .emailCalendarMonth{background-color:#205478; color:#FFFFFF; font-family:Helvetica, Arial, sans-serif; font-size:16px; font-weight:bold; padding-top:10px; padding-bottom:10px; text-align:center;}
                            .emailCalendarDay{color:#205478; font-family:Helvetica, Arial, sans-serif; font-size:60px; font-weight:bold; line-height:100%; padding-top:20px; padding-bottom:20px; text-align:center;}
                            .imageContentText {margin-top: 10px;line-height:0;}
                            .imageContentText a {line-height:0;}
                            #invisibleIntroduction {display:none !important;} /* Removing the introduction text from the view */

                            /*FRAMEWORK HACKS & OVERRIDES */
                            span[class=ios-color-hack] a {color:#275100!important;text-decoration:none!important;} /* Remove all link colors in IOS (below are duplicates based on the color preference) */
                            span[class=ios-color-hack2] a {color:#205478!important;text-decoration:none!important;}
                            span[class=ios-color-hack3] a {color:#8B8B8B!important;text-decoration:none!important;}
                            /* A nice and clean way to target phone numbers you want clickable and avoid a mobile phone from linking other numbers that look like, but are not phone numbers.  Use these two blocks of code to "unstyle" any numbers that may be linked.  The second block gives you a class to apply with a span tag to the numbers you would like linked and styled.
                            Inspired by Campaign Monitor\'s article on using phone numbers in email: http://www.campaignmonitor.com/blog/post/3571/using-phone-numbers-in-html-email/.
                            */
                            .a[href^="tel"], a[href^="sms"] {text-decoration:none!important;color:#606060!important;pointer-events:none!important;cursor:default!important;}
                            .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {text-decoration:none!important;color:#606060!important;pointer-events:auto!important;cursor:default!important;}


                            /* MOBILE STYLES */
                            @media only screen and (max-width: 480px){
                                /*////// CLIENT-SPECIFIC STYLES //////*/
                                body{width:100% !important; min-width:100% !important;} /* Force iOS Mail to render the email at full width. */

                                /* FRAMEWORK STYLES */
                                /*
                                CSS selectors are written in attribute
                                selector format to prevent Yahoo Mail
                                from rendering media query styles on
                                desktop.
                                */
                                /*td[class="textContent"], td[class="flexibleContainerCell"] { width: 100%; padding-left: 10px !important; padding-right: 10px !important; }*/
                                table[id="emailHeader"],
                                table[id="emailBody"],
                                table[id="emailFooter"],
                                table[class="flexibleContainer"],
                                td[class="flexibleContainerCell"] {width:100% !important;}
                                td[class="flexibleContainerBox"], td[class="flexibleContainerBox"] table {display: block;width: 100%;text-align: left;}
                                /*
                                The following style rule makes any
                                image classed with \'flexibleImage\'
                                fluid when the query activates.
                                Make sure you add an inline max-width
                                to those images to prevent them
                                from blowing out.
                                */
                                td[class="imageContent"] img {height:auto !important; width:100% !important; max-width:100% !important; }
                                img[class="flexibleImage"]{height:auto !important; width:100% !important;max-width:100% !important;}
                                img[class="flexibleImageSmall"]{height:auto !important; width:auto !important;}


                                /*
                                Create top space for every second element in a block
                                */
                                table[class="flexibleContainerBoxNext"]{padding-top: 10px !important;}

                                /*
                                Make buttons in the email span the
                                full width of their container, allowing
                                for left- or right-handed ease of use.
                                */
                                table[class="emailButton"]{width:100% !important;}
                                td[class="buttonContent"]{padding:0 !important;}
                                td[class="buttonContent"] a{padding:15px !important;}

                            }

                            /*  CONDITIONS FOR ANDROID DEVICES ONLY
                            *   http://developer.android.com/guide/webapps/targeting.html
                            *   http://pugetworks.com/2011/04/css-media-queries-for-targeting-different-mobile-devices/ ;
                            =====================================================*/

                            @media only screen and (-webkit-device-pixel-ratio:.75){
                                /* Put CSS for low density (ldpi) Android layouts in here */
                            }

                            @media only screen and (-webkit-device-pixel-ratio:1){
                                /* Put CSS for medium density (mdpi) Android layouts in here */
                            }

                            @media only screen and (-webkit-device-pixel-ratio:1.5){
                                /* Put CSS for high density (hdpi) Android layouts in here */
                            }
                            /* end Android targeting */

                            /* CONDITIONS FOR IOS DEVICES ONLY
                            =====================================================*/
                            @media only screen and (min-device-width : 320px) and (max-device-width:568px) {

                            }
                            /* end IOS targeting */
                        </style>
                        <!--
                            Outlook Conditional CSS
                            These two style blocks target Outlook 2007 & 2010 specifically, forcing
                            columns into a single vertical stack as on mobile clients. This is
                            primarily done to avoid the \'page break bug\' and is optional.
                            More information here:
                            http://templates.mailchimp.com/development/css/outlook-conditional-css
                        -->
                        <!--[if mso 12]>
                            <style type="text/css">
                                .flexibleContainer{display:block !important; width:100% !important;}
                            </style>
                        <![endif]-->
                        <!--[if mso 14]>
                            <style type="text/css">
                                .flexibleContainer{display:block !important; width:100% !important;}
                            </style>
                        <![endif]-->
                    </head>
                    <body bgcolor="#E1E1E1" leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">

                        <!-- CENTER THE EMAIL // -->
                        <!--
                        1.  The center tag should normally put all the
                            content in the middle of the email page.
                            I added "table-layout: fixed;" style to force
                            yahoomail which by default put the content left.
                        2.  For hotmail and yahoomail, the contents of
                            the email starts from this center, so we try to
                            apply necessary styling e.g. background-color.
                        -->
                        <center style="background-color:#E1E1E1;">
                            <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable" style="table-layout: fixed;max-width:100% !important;width: 100% !important;min-width: 100% !important;">
                                <tr>
                                    <td align="center" valign="top" id="bodyCell">

                                        <!-- EMAIL HEADER // -->
                                        <!--
                                            The table "emailBody" is the email\'s container.
                                            Its width can be set to 100% for a color band
                                            that spans the width of the page.
                                        -->
                            
                                        <!-- // END -->

                                        <!-- EMAIL BODY // -->
                                        <!--
                                            The table "emailBody" is the email\'s container.
                                            Its width can be set to 100% for a color band
                                            that spans the width of the page.
                                        -->
                                        <table bgcolor="#FFFFFF"  border="0" cellpadding="0" cellspacing="0" width="500" id="emailBody">

                                        <tr>
                                        <td align="center" valign="top">
                                            <!-- CENTERING TABLE // -->
                                            <!--
                                                The centering table keeps the content
                                                tables centered in the emailBody table,
                                                in case its width is set to 100%.
                                            -->
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="color:#FFFFFF;">
                                            
                                            <tr>
                                                <td align="center" valign="top">
                                                    <!-- FLEXIBLE CONTAINER // -->
                                                    <!--
                                                        The flexible container has a set width
                                                                    that gets overridden by the media query.
                                                                    Most content tables within can then be
                                                                    given 100% widths.
                                                                -->
                                                                <table border="0" cellpadding="0" cellspacing="0" width="500" class="flexibleContainer">
                                                                    <tr>
                                                                        <td align="center" valign="top" width="500" class="flexibleContainerCell">

                                                                            <!-- CONTENT TABLE // -->
                                                                            <!--
                                                                            The content table is the first element
                                                                                that\'s entirely separate from the structural
                                                                                framework of the email.
                                                                            -->
                                                                            <table border="0" cellpadding="30" cellspacing="0" width="100%">
                                                                                <tr>
                                                                                    <td align="center" valign="top" class="textContent">
                                                                                        <h1 
                                                                                        style="
                                                                                        width:70%;
                                                                                        background-color: orange;
                                                                                        padding: 1vh;
                                                                                        border-radius: 4vh;
                                                                                        color:#FFFFFF;
                                                                                        line-height:100%;
                                                                                        font-family:Arial;
                                                                                        font-size:20px;
                                                                                        font-weight:900;
                                                                                        margin-bottom:5px;
                                                                                        text-align:center;
                                                                                        padding:2vh
                                                                                        ">
                                                                                            CASHBACK REDUCTION
                                                                                        </h1>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                            <!-- // CONTENT TABLE -->

                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                <!-- // FLEXIBLE CONTAINER -->
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <!-- // CENTERING TABLE -->
                                                </td>
                                            </tr>


                                            <!-- MODULE ROW // -->
                                            <!--  The "mc:hideable" is a feature for MailChimp which allows
                                                you to disable certain row. It works perfectly for our row structure.
                                                http://kb.mailchimp.com/article/template-language-creating-editable-content-areas/
                                            -->
                                            <tr mc:hideable>
                                                <td align="center" valign="top">
                                                    <!-- CENTERING TABLE // -->
                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                        <tr>
                                                            <td align="center" valign="top">
                                                                <!-- FLEXIBLE CONTAINER // -->
                                                                <table border="0" cellpadding="30" cellspacing="0" width="500" class="flexibleContainer">
                                                                    <tr>
                                                                        <td valign="top" width="500" class="flexibleContainerCell">

                                                                            <!-- CONTENT TABLE // -->
                                                                            <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                                                <tr>
                                                                                    <td align="right" valign="middle" class="flexibleContainerBox">
                                                                                            <tr>
                                                                                                <td align="left" class="textContent">
                                                                                                    <h3 style="color:#5F5F5F;line-height:125%;font-family:Helvetica,Arial,sans-serif;font-size:20px;font-weight:normal;margin-top:0;margin-bottom:3px;text-align:left;">
                                                                                                        Bonjour <b>' . $result_req->prenom . '</b> ,<br/><br/>
                                                                                                    </h3>
                                                                                                    <div style="text-align:left;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#5F5F5F;line-height:135%;">
                                                                                                        Renitialiser votre mot de passe <br/><br/>
                                                                                                        &Agrave; bientôt sur <b>  ' . nom_site . ' </b> !
                                                                                                    </div>
                                                                                                </td>
                                                                                            </tr>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                            <!-- // CONTENT TABLE -->

                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                <!-- // FLEXIBLE CONTAINER -->
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <!-- // CENTERING TABLE -->
                                                </td>
                                            </tr>
                                            <!-- // MODULE ROW -->
                                            
                                            <!-- MODULE ROW // -->
                                            <tr>
                                                <td align="center" valign="top">
                                                    <!-- CENTERING TABLE // -->
                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                        <tr style="padding-top:0;">
                                                            <td align="center" valign="top">
                                                                <!-- FLEXIBLE CONTAINER // -->
                                                                <table border="0" cellpadding="30" cellspacing="0" width="500" class="flexibleContainer">
                                                                    <tr>
                                                                        <td style="padding-top:0;" align="center" valign="top" width="500" class="flexibleContainerCell">

                                                                            <!-- CONTENT TABLE // -->
                                                                            <table border="0" cellpadding="0" cellspacing="0" width="50%" class="emailButton" style="background-color: #3498DB;">
                                                                                <tr>
                                                                                    <td align="center" valign="middle" class="buttonContent" style="padding-top:15px;padding-bottom:15px;padding-right:15px;padding-left:15px;">
                                                                                        <a
                                                                                        href="' . url_site . '/reset-user?token='.  $result_req->hashId .'" 
                                                                                        style="color:#FFFFFF;text-decoration:none;font-family:Helvetica,Arial,sans-serif;font-size:20px;line-height:135%;" href="#" target="_blank">Renitialiser</a>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                            <!-- // CONTENT TABLE -->

                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                <!-- // FLEXIBLE CONTAINER -->
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <!-- // CENTERING TABLE -->
                                                </td>
                                            </tr>
                                            <!-- // MODULE ROW -->


                                            <!-- MODULE ROW // -->
                                            <tr>
                                                <td align="center" valign="top">
                                                    <!-- CENTERING TABLE // -->
                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#F8F8F8">
                                                        <tr>
                                                            <td align="center" valign="top">
                                                                <!-- FLEXIBLE CONTAINER // -->
                                                                <table border="0" cellpadding="0" cellspacing="0" width="500" class="flexibleContainer">
                                                                    <tr>
                                                                        <td align="center" valign="top" width="500" class="flexibleContainerCell">
                                                                            <table border="0" cellpadding="30" cellspacing="0" width="100%">
                                                                                <tr>
                                                                                    <td align="center" valign="top">

                                                                                        <!-- CONTENT TABLE // -->
                                                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                                                            <tr>
                                                                                                <td valign="top" class="textContent">
                                                                                                    <!--
                                                                                                        The "mc:edit" is a feature for MailChimp which allows
                                                                                                        you to edit certain row. It makes it easy for you to quickly edit row sections.
                                                                                                        http://kb.mailchimp.com/templates/code/create-editable-content-areas-with-mailchimps-template-language
                                                                                                    -->
                                                                                                    <h3 mc:edit="header"
                                                                                                    style="color:#5F5F5F;line-height:125%;font-family:Helvetica,Arial,sans-serif;font-size:15px;font-weight:normal;margin-top:0;margin-bottom:3px;text-align:left;">Copyright © 2022, Cashbackreduction.com - Tous droits réservés </h3>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </table>
                                                                                        <!-- // CONTENT TABLE -->

                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                <!-- // FLEXIBLE CONTAINER -->
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <!-- // CENTERING TABLE -->
                                                </td>
                                            </tr>
                                            <!-- // MODULE ROW -->

                                
                                    </td>
                                </tr>
                            </table>
                        </center>
                    </body>
                    </html>


                ';
                
                $mailService->sendSMTP($post_reg_email, 'Réinitialiser les mots de passe', $messageM, [
                    ['images/logo_final_bleu.png', 'logo']
                ]);

                $reponsConfirm = 'Un e-mail de réinitialisation vous a été envoyé.';
                $button = '"Fermer"';

            }
        }
    }
}

if (!empty($_POST["submit_reset_pass"])) {
    
    if (empty($_POST['mdp1']) OR empty($_POST['mdp2']) OR empty($_GET['token']))
    {
        $reponsError = 'Vous devez remplir tous les champs.';
        $button = '"Fermer"';
    }
    else
    {
        if($_POST['mdp2'] === $_POST['mdp1']){

            $id=$_GET['token'];
            $mdp=sha1(md5($_POST['mdp2']));

            $pdo->exec("UPDATE users SET mdp = '".$mdp."' WHERE hashId = '".$id."'");
            $reponsSucess = "https://" . $_SERVER["HTTP_HOST"] . "/login";
            

        }else{

            $reponsError = 'Les mots de passe ne sont pas identiques.';
            $button = '"Fermer"';

        }

    }



}

if (!empty($_POST["add_new_letter"])) {
    $sql_RegCount = $pdo->query("SELECT * FROM newletter WHERE newLetter_email = '" . $post_reg_email . "'");
    $dns_RegCount = $sql_RegCount->fetch(PDO::FETCH_ASSOC);
    
    if ($sql_RegCount->rowCount() == 0) {
        $reponsConfirm = 'Bravo, vous êtes maintenant inscrit au newLetter!.';
        $button = '"Fermer"';
        $recSql = "INSERT INTO `newletter` (`newLetter_email`, `newLetter_prenom`) VALUES('" .$post_reg_email. "',  '" .explode("@",$post_reg_email)[0]. "')";
        $pdo->exec($recSql);
        

    }else{
        $reponsError = 'Vous ete deja inscrite.';
        $button = '"Fermer"';
    }

}
// Fin : Connexion

// Début : Confirmation d'inscription
if (isset($_GET['confirm']) && $_GET['confirm'] == 1) {
    
    if (!empty($_GET['userEmail'])): $get_conf_email = addslashes(htmlentities($_GET['userEmail']));
    else: $get_conf_email = null;
    endif;
    if (!empty($_GET['token'])): $get_conf_token = addslashes(htmlentities($_GET['token']));
    else: $get_conf_token = null;
    endif;

    $sql_ValidAccount = $pdo->query("SELECT COUNT(id) as 'total' FROM users WHERE email = '" . $get_conf_email . "' AND mdp = '" . $get_conf_token . "' AND actif = 0");
    $dns_ValidAccount = $sql_ValidAccount->fetch(PDO::FETCH_ASSOC);
    $nb_RegCount = addslashes(htmlentities($dns_ValidAccount['total']));

    // get montant bonus inscription
    $bi = $pdo->query("SELECT inscription,ami FROM parrainage WHERE id=1");
    $mtt = $bi->fetch(PDO::FETCH_ASSOC);
    $bonusInscription = (float)$mtt['inscription'];
    $bonusParrainage = (float)$mtt['ami'];

    if ($nb_RegCount == 1) {
        $user = $pdo->query("SELECT * FROM users WHERE email = '" . $get_conf_email . "' AND mdp = '" . $get_conf_token . "' AND actif = 0");
        $user = $user->fetch(PDO::FETCH_ASSOC);
        // add bonus inscription
        $montant = (float)$user['euros'];
        $montant += $bonusInscription;
        $idParrain = (int)$user['idParrain'];

        //add bonus parrain
        if( $idParrain != 0){
            $parrain = $pdo->query("SELECT * FROM users WHERE id = {$idParrain}");
            $parrain = $parrain->fetch(PDO::FETCH_ASSOC);
            $montantParrain = (float)$parrain['euros'];
            $montantParrain += $bonusParrainage;
            $pdo->exec("UPDATE users SET euros = {$montantParrain} WHERE id = {$idParrain}");
        }

        $pdo->exec("UPDATE users SET actif = 1,euros = {$montant} WHERE email = '" . $get_conf_email . "' AND mdp = '" . $get_conf_token . "' AND actif = 0");

        // $reponsConfirm = 'Votre compte a bien été validé, vous pouvez maintenant vous connecter.';
        // $button = '"Fermer"';
        $validationCompte = true;
        $mdpUser = $user["mdp"];
    } else {
        // $reponsError = 'Oups, une erreur est survenue !';
        // $button = '"Fermer"';
        redirect($base_url);
    }
}


// Fin : Confirmation d'inscription
if (isset($reponsConfirm) && $reponsConfirm !=  null) {
    if (isset($_SESSION['id'])) {
        newNotifcations($_SESSION['id'], $reponsConfirm, $pdo);
    }
    echo $reponsConfirm;
    /*
    <script type="text/javascript">
        swal({
        text: "<?= $reponsConfirm; ?>",
                button: <?= $button; ?>,
                icon: "success",
                closeOnClickOutside: false,
                closeOnEsc: false,
        });
        <?php if (isset($redirectionLogin) && $redirectionLogin != null ) {
            ?>
                    setTimeout(function(){
                        window.location='<?= $redirectionLogin; ?>';
                    }, 3000);
            <?php
                    unset($redirectionLogin);
                }
            ?>
    </script>
    */
}


if (isset($reponsSucess) && $reponsSucess !=  null)
{
    if (isset($_SESSION['id'])) {
        newNotifcations($_SESSION['id'], $reponsConfirm, $pdo);
    }

    echo $reponsSucess;
}

if (isset($reponsBanni) && $reponsBanni !=  null) {
    echo $reponsBanni;
    /*
    ?>
    <script type="text/javascript">
        swal({
        text: "<?= $reponsBanni; ?>",
                button: <?= $button; ?>,
                icon: "warning",
                closeOnClickOutside: false,
                closeOnEsc: false,
        })<?php if (isset($redirectionLogin)) { ?>,
            setTimeout(function() {
                window.location = '<?= $redirectionLogin; ?>';
            }, 3000);<?php } ?>
    </script>
    <?php
    */
}


if (isset($reponsError) && $reponsError !=  null) {
    echo $reponsError;
    /*?>
    <script type="text/javascript">
        swal({
            text: "<?= $reponsError; ?>",
            button: <?= $button; ?>,
            icon: "error",
            closeOnClickOutside: false,
            closeOnEsc: false,
        });
    </script>
    <?php
    */
}
// if (isset($_SESSION["email"])) {
//    echo "<script>window.location.href='MonCompte.php'</script>";
//     // echo "test";
// }
?>

 