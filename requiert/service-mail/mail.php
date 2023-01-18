<?php

namespace ServiceMail;

use  PHPMailer\PHPMailer\PHPMailer;

require_once  'MAIL/Exception.php';
require_once $_ROOT . '/requiert/service-mail/MAIL/PHPMailer.php';
require_once $_ROOT . '/requiert/service-mail/MAIL/SMTP.php';

define("_MAIL_HOST_", "smtp.zoho.eu");
define("_MAIL_PORT_", 587);
define("_MAIL_USER_", "webmaster@gifthunter.fr");
define("_MAIL_FROM_", "Gifthunter");
define("_MAIL_PASSWORD_", "Timo12300@");


class MailAction
{
    public function send($to, $object, $body, $pieces = false)
    {
        $passage_ligne = !preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $to) ? "\r\n" : "\n";
        $boundary = "-----=" . md5(rand());

        $header = "From: \"" . _MAIL_FROM_ . "\"<" . _MAIL_FROM_ . ">" . $passage_ligne;
        $header .= "MIME-Version: 1.0" . $passage_ligne;
        $header .= 'Content-Type: multipart/related;boundary=' . $boundary . $passage_ligne;

        $message = $passage_ligne . "--" . $boundary . $passage_ligne;

        $message .= "Content-Type: text/html; charset=\"UTF-8\"" . $passage_ligne;
        $message .= "Content-Transfer-Encoding: 8bit" . $passage_ligne;
        $message .= $passage_ligne . $body . $passage_ligne;


        if ($pieces != '' && file_exists($pieces)) {
            $conAttached = self::prepareAttachment($pieces);
            if ($conAttached !== false) {
                $message .= $passage_ligne . '--' . $boundary . $passage_ligne;
                $message .= $conAttached;
            }
        }
        if (!preg_match("#^[a-z0-9._-]+@(gmail).[a-z]{2,4}$#", $to)) {
            $message = utf8_encode($message);
        }
        $message = utf8_decode($message);
        @mail($to, $object, $message, $header);
    }
    public static function prepareAttachment($path)
    {
        $rn = "\r\n";

        if (file_exists($path)) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $ftype = finfo_file($finfo, $path);
            $file = fopen($path, "r");
            $attachment = fread($file, filesize($path));
            $attachment = chunk_split(base64_encode($attachment));
            fclose($file);

            $msg = 'Content-Type: \'' . $ftype . '\'; name="' . basename($path) . '"' . $rn;
            $msg .= "Content-Transfer-Encoding: base64" . $rn;
            $msg .= 'Content-ID: <' . basename($path) . '>' . $rn;
            $msg .= $rn . $attachment . $rn . $rn;
            return $msg;
        } else {
            return false;
        }
    }
    function sendSMTP($email, $subjet, $message, $attachment = false, $rep_email = null, $rep = "")
    {
        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = _MAIL_HOST_;
        $mail->Port = _MAIL_PORT_;
        $mail->SMTPAuth = true;
        $mail->Username = _MAIL_USER_;
        $mail->Password = _MAIL_PASSWORD_;
        $mail->SMTPSecure = 'TLS';
        $mail->From = _MAIL_USER_;
        $mail->FromName = _MAIL_FROM_;
        $mail->CharSet = "UTF-8";
        $mail->ClearReplyTos();
        if ($rep_email != null)
            $mail->addReplyTo($rep_email, $rep);
        $email = gettype($email) == "array" ? $email : [$email];
        $only_gmail = true;
        for ($i = 0; $i < count($email); $i++) {
            $mail->AddAddress($email[$i]);
            $only_gmail && $only_gmail = in_array(trim(substr($email[$i], strpos($email[$i], "@") + 1)), ["gmail.com", "outlook.fr"]);
        }
        if ($attachment) {
            for ($i = 0; $i < count($attachment); $i++) {
                $current = $attachment[$i];
                $path = isset($current[0]) ? $current[0] : null;
                $cid = isset($current[1]) ? $current[1] : null;
                $name = isset($current[2]) ? $current[2] : 'base64';
                if ($path && $cid) {
                    $mail->AddEmbeddedImage($path, $cid, $name);
                }
            }
        }

        //if (!$only_gmail) {$message = utf8_encode($message);}

        $mail->IsHTML(true);
        $mail->Subject = utf8_decode(utf8_encode($subjet));
        $mail->Body    = $message;
        $end = ($mail->Send()) ? true : false;
        return $end;
    }
}
