
<?php

require 'vendor/autoload.php';
require_once $_ROOT . '/requiert/service-mail/mail.php';

$mailService = new ServiceMail\MailAction();

session_start();//on démarre la session
// $errors = [];
  $errors = array(); // on crée une vérif de champs
if(!array_key_exists('email', $_POST) || $_POST['sujet'] == '') {// on verifie l'existence du champ et d'un contenu
  $errors ['email'] = "vous n'avez pas renseigné votre email";
  }
if(!array_key_exists('sujet', $_POST) || $_POST['sujet'] == '' || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {// on verifie existence de la clé
  $errors ['sujet'] = "vous n'avez pas renseigné votre sujet";
  }
if(!array_key_exists('message', $_POST) || $_POST['message'] == '') {
  $errors ['message'] = "vous n'avez pas renseigné votre message";
  }
//On check les infos transmises lors de la validation
  if(!empty($errors)){ // si erreur on renvoie vers la page précédente
  $_SESSION['errors'] = $errors;//on stocke les erreurs
  $_SESSION['inputs'] = $_POST;
    header('Location: index.html');
  }else{
      $_SESSION['success'] = 1;
      /*
      $headers  = 'MIME-Version: 1.0' . "\r\n";
      $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
      $headers .= 'FROM:' . htmlspecialchars($_POST['email']);
      $to = 'duddatimotee@gmail.com'; // Insérer votre adresse email ICI
      */
      $emeteur =  htmlspecialchars($_POST['email']);
      $message = htmlspecialchars($_POST['message']);
      $subject = 'Message envoyé par ' .$emeteur .' - <i>' . htmlspecialchars($_POST['sujet']) .'</i>';
      $message_content = '
        <html>
          <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
              <style type="text/css" media="screen">
                body { margin: 0; margin: 10px; color : #444; padding: 0; font-size: 13px; font-family: helvetica, arial, sans-serif; background-color: #f5f5f5; }
                a { color : #444; text-decoration : none; }
                a:hover { text-decoration : underline; }
              </style>
          </head>
          
          <body>
            <div>
                <b>Emetteur du message: '.$emeteur.'</b>
            </div>
            <div style="font-size : 12px;">
              '.$messageM.'
            </div>
          </body>
        </html>'
      ;
 $mailService->sendSMTP($post_reg_email, 'Confirmation d\'inscription', $messageM, [
                                    ['images/logo_final_bleu.png', 'logo']
                                ]);
     
       
echo "<div style='text-align:center; margin-top:2rem'>Le mail a bien été envoyé.</div>";
        
        header('Location: index.html');
    }
?>