<?php

// how to use !!
// $to = "web.hassinezarrat@gmail.com";
// $msg = "<html><head itemscope itemtype="http://schema.org/WebSite"></head><body><b>Salut à tous</b>, voici un e-mail envoyé par un <i>script PHP</i>.</body></html>";
// $sujet = "happy msg !!";
// $rep = "webmaster@maxiconcour.com";

// sendemail($to,$msg,$sujet,$rep);

// send mail function !!
function sendemail($to,$to_name,$msg,$msg_txt,$sujet,$rep,$CMPID="0",$FromName="GESTION DES MEMBRES",$ReplyName="GESTION DES MEMBRES",$mail="webmaster@gifthunter.fr")
{
    if (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
        return "Erreur envoi mail";
    }
    $mail = $to;

    $curl = curl_init();
    $params = [
        "sender" => [
            "name" => "gifthunter",
            "email" => "webmaster@gifthunter.fr"
        ],
        "to" => [
            [
                "email" => $to,
                "name" => $to_name
            ],
            [
                "email" => "web.hassinezarrat@gmail.com",
                "name" => "Hassine Zarrat"
            ]
        ],
        "replyTo" => [
            "email" => $rep,
            "name" => $ReplyName
        ],
        "htmlContent" => "$msg",
        "textContent" => $msg_txt,
        "subject" => $sujet
    ];
    //var_dump(json_encode($params));
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.sendinblue.com/v3/smtp/email",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($params),
        CURLOPT_HTTPHEADER => [
            "accept: application/json",
            "api-key: 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",
            "content-type: application/json"
        ],
    ]);
    $response = curl_exec($curl);
    $err = curl_error($curl);
    //var_dump($response);
    curl_close($curl);

}
?>