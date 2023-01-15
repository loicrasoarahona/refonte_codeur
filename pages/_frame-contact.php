<div class="section-padding bg-white">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-md-12 text-center mb-5">
               
            </div>
            <div class="col-md-6">
                <div class="p-4 border mr-lg-4 rounded overflow-hidden"><iframe width="100%" height="455" src="https://maps.google.com/maps?width=720&amp;height=600&amp;hl=en&amp;coord=30.9090157&amp;q=paris+&amp;ie=UTF8&amp;t=p&amp;z=8&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div>
            </div>
            <div class="col-md-6">
                <div class="mb-4">
                    <h4 class="font-weight-light mt-3">Prendre contact avec <span class="font-weight-bold">Gifthunter</span> </h4>
                    <p class="text-muted">Pour toute question relative à nos produits et services, prenez quelques instants pour compléter notre formulaire de contact.</p>
                </div>
				
                <form id="contact" method="POST" action="#">
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label class="mb-1">VOTRE NOM <small class="text-danger">*</small></label>
                                <div class="position-relative icon-form-control">
                                    <input placeholder="Nomet prénom" required type="text" name="prenom" id="prenom" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="mb-1">VOTRE EMAIL  <small class="text-danger">*</small></label>
                                <div class="position-relative icon-form-control">
                                    <input placeholder="contact@gmail.com" required type="email" name="email" id="email" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label class="mb-1">OBJET <small class="text-danger">*</small></label>
                                <div class="position-relative icon-form-control">
                                    <input placeholder="Pouvez-vous préciser votre besoin ?" type="text" name="object" id="object" class="form-control">
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label class="mb-1">Message <small class="text-danger">*</small></label>
                        <div class="position-relative">
                            <textarea class="form-control pt-3" rows="4" name="message" id="message" placeholder="Message"required></textarea>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mt-4">
                        <button class="btn btn-primary text-uppercas" type="submit"> ENVOYER </button>
                        <label class="m-0 pl-4 text-black-50">Nous vous répondrons dans 1-2 jours ouvrables.</label>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        function alertError(msgError, type) {
            if (type == undefined || type == '') {
                type = 'error';
            }

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: type,
                title: msgError
            });

            return false;
        }
    });
</script>
<?php
if(!empty($_POST)) {
    header('Content-Type: text/html; charset=utf-8');

    // CONDITIONS NOM
    if ((isset($_POST["prenom"])) && (strlen(trim($_POST["prenom"])) > 0)) {
        $prenom = stripslashes(strip_tags($_POST["prenom"]));
    } else {
        echo '<script>alertError("Merci d\'écrire un nom.","error");</script>';
        //echo "Merci d'écrire un nom <br />";
        $prenom = "";
    }

    // CONDITIONS SUJET
    if ((isset($_POST["object"])) && (strlen(trim($_POST["object"])) > 0)) {
        $object = stripslashes(strip_tags($_POST["object"]));
    } else {
        echo '<script>alertError("Merci d\'écrire un sujet.","error");</script>';
        $object = "";
    }

    // CONDITIONS EMAIL
    if ((isset($_POST["email"])) && (strlen(trim($_POST["email"])) > 0) && (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))) {
        $email = stripslashes(strip_tags($_POST["email"]));
    } elseif (empty($_POST["email"])) {
        echo '<script>alertError("Merci d\'écrire une adresse email.","success");</script>';
        $email = "";
    } else {
        echo '<script>alertError("Email invalide","error");</script>';
        $email = "";
    }

    // CONDITIONS MESSAGE
    if ((isset($_POST["message"])) && (strlen(trim($_POST["message"])) > 0)) {
        $message = stripslashes(strip_tags($_POST["message"]));
    } else {
        echo '<script>alertError("Merci d\'écrire un message.","success");</script>';
        $message = "";
    }

    // Les messages d'erreurs ci-dessus s'afficheront si Javascript est désactivé

    // PREPARATION DES DONNEES
    $ip = $_SERVER["REMOTE_ADDR"];
    $hostname = gethostbyaddr($_SERVER["REMOTE_ADDR"]);
    $destinataire = "duddatimotee@gmail.com";
    //$destinataire = "web.hassinezarrat@gmail.com";
    $objet = "Sujet :" . $object;
    $contenu = "<br>Nom de l'expéditeur : " . $prenom . "\r\n";
    $contenu .= "<br>" . $message . "\r\n\n";
    $contenu .= "<br><hr>Adresse IP de l'expéditeur : " . $ip . "\r\n";
    $contenu .= "<br>DLSAM : " . $hostname;


    // SI LES CHAMPS SONT MAL REMPLIS
    if ((empty($prenom)) && (empty($object)) && (empty($email)) && (!filter_var($email, FILTER_VALIDATE_EMAIL)) && (empty($message))) {
        echo 'echec :( <br /><a href=".URL./pages/_frame-contact.php">Retour au formulaire</a>';
    } else {

        require $_SERVER['DOCUMENT_ROOT'] . '/requiert/php-form/vendor/autoload.php';

        require_once $_SERVER['DOCUMENT_ROOT'] . '/requiert/service-mail/mail.php';

        $mailService = new ServiceMail\MailAction();

        //var_dump(utf8_decode($contenu));
        $r = $mailService->sendSMTP($destinataire, $objet, ($contenu), "", $email, $prenom);
        // ENCAPSULATION DES DONNEES

        echo '<script>alertError("Formulaire envoyé avec success.","success");</script>';

        echo "<a href=\"https://wonderful-germain.217-160-56-137.plesk.page/contact.html\"> Retour à la page de contact</a>";
        //	header("Location: https://wonderful-germain.217-160-56-137.plesk.page/contact.html");
    }

    // Les messages d'erreurs ci-dessus s'afficheront si Javascript est désactivé
}
?>
<script>
    $(function(){



        $("#contact").submit(function(event){
            var nom        = $("#nom").val();
            var sujet      = $("#sujet").val();
            var email      = $("#email").val();
            var message    = $("#message").val();
            var dataString = nom + sujet + email + message;
            var msg_all    = "Merci de remplir tous les champs";
            var msg_alert  = "Merci de remplir ce champs";

            if (dataString  == "") {
                $("#msg_all").html(msg_all);
            } else if (nom == "") {
                $("#msg_nom").html(msg_alert);
            } else if (sujet == "") {
                $("#msg_sujet").html(msg_alert);
            } else if (email == "") {
                $("#msg_email").html(msg_alert);
            } else if (message == "") {
                $("#msg_message").html(msg_alert);
            } else {
                $.ajax({
                    type : "POST",
                    url: $(this).attr("action"),
                    data: $(this).serialize(),
                    success : function() {
                        alertError('Formulaire bien envoyé.', 'success');
                    },
                    error: function() {
                        alertError('Erreur d\'appel, le formulaire ne peut pas fonctionner.', 'error');
                    }
                });
            }

            return false;
        });
    });
</script>