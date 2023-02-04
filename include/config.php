<?php

ini_set("error_reporting", 0); //temporaire

$http_origin = $_SERVER['HTTP_ORIGIN'];
if (strpos(strtolower($http_origin), "https://maxi-coupons.com/") !== false) {
    header("Access-Control-Allow-Origin: $http_origin");
    $http_origin = $_SERVER['HTTP_ORIGIN'];
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Headers : "X-Accept-Charset,X-Accept,Content-Type, X-CSRF-Token, X-Cookie,xmlhttprequest,HTTP_X_REQUESTED_WITH"');
    }
} else {
    header('Access-Control-Allow-Origin: *');
}


session_start();

// Informations d'identification

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'u832841964_hunter');
define('DB_PASSWORD', 'Timo12300@');
define('DB_NAME', 'u832841964_hunter');

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);


if ($conn === false) {
    die("ERREUR : Impossible de se connecter. " . mysqli_connect_error());
}

mysqli_query($conn, "set character_set_results='utf8mb4'");
mysqli_query($conn, "set character_set_server='utf8mb4'");
mysqli_query($conn, "SET NAMES utf8mb4;");
mb_internal_encoding("UTF-8");
setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']);
date_default_timezone_set('Europe/Paris');


$base_url = "https://maxi-coupons.com/";
$url_instagram = "";
$url_youtube = ""; // sans@
$url_facebook = "";

$user_id = $_SESSION['id'];
$user_img = $_SESSION['userprofile']['img'];
$user_type = $_SESSION['userprofile']['type'];
$user_location = $_SESSION['userprofile']['location'];
$user_premium = intval($_SESSION['userprofile']['premium']);
$user_identity = intval($_SESSION['userprofile']['etat']);

$totalMissionsValide = 0;
$totalCommandeValide = 0;
$totalMissionsAttente = 0;


function notifications($target, $target_id, $user_id, $user_id_send)
{
    $conn = $GLOBALS['conn'];
    $time = time();
    $sql = "INSERT INTO `notifications`(`user_id`, `user_id_send`, `target`, `id_target`, `date`, `seen`) VALUES ('{$user_id}','{$user_id_send}','{$target}','{$target_id}',{$time},'0')";
    if (mysqli_query($conn, $sql) === false) {
        $sql = "UPDATE `notifications` SET `date` = $time, `seen` = 0 , user_id_send = $user_id_send  where target = '$target' and user_id = $user_id  and ( user_id_send = $user_id_send or user_id_send = 0) and id_target = $target_id";
        mysqli_query($conn, $sql);
    }
}


if (!function_exists('csrf_token')) {
    function csrf_token($ch)
    {
        session_start();
        $_SESSION[$ch]  = md5(uniqid(rand(), TRUE));
        return $_SESSION[$ch];
    }
}
function slugify($text)
{
    // replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, '-');

    // remove duplicate -
    $text = preg_replace('~-+~', '-', $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text)) {
        return 'n-a';
    }

    return $text;
}
function redirect($url)
{
    if (!headers_sent()) {
        header('Location: ' . $url);
        exit();
    } else {
        echo '<script type="text/javascript">';
        echo 'window.location.href="' . $url . '";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=' . $url . '" />';
        echo '</noscript>';
        exit();
    }
}

function RandomString($max = 8)
{
    $i = 0; //Reset the counter.
    $possible_keys = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $keys_length = strlen($possible_keys);
    $str = ""; //Let's declare the string, to add later.
    while ($i < $max) {
        $rand = mt_rand(1, $keys_length - 1);
        $str .= $possible_keys[$rand];
        $i++;
    }
    return $str;
}

function acronym($ch)
{
    $words = explode(" ", $ch);
    $acronym = "";
    foreach ($words as $w) {
        $acronym .= mb_substr($w, 0, 1);
    }
    return mb_substr(strtoupper($acronym), 0, 2);
}

function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE)
{
    $output = NULL;
    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    }
    $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
    $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
    $continents = array(
        "AF" => "Africa",
        "AN" => "Antarctica",
        "AS" => "Asia",
        "EU" => "Europe",
        "OC" => "Australia (Oceania)",
        "NA" => "North America",
        "SA" => "South America"
    );
    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
            switch ($purpose) {
                case "location":
                    $output = array(
                        "city"           => @$ipdat->geoplugin_city,
                        "state"          => @$ipdat->geoplugin_regionName,
                        "country"        => @$ipdat->geoplugin_countryName,
                        "country_code"   => @$ipdat->geoplugin_countryCode,
                        "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                        "continent_code" => @$ipdat->geoplugin_continentCode
                    );
                    break;
                case "address":
                    $address = array($ipdat->geoplugin_countryName);
                    if (@strlen($ipdat->geoplugin_regionName) >= 1)
                        $address[] = $ipdat->geoplugin_regionName;
                    if (@strlen($ipdat->geoplugin_city) >= 1)
                        $address[] = $ipdat->geoplugin_city;
                    $output = implode(", ", array_reverse($address));
                    break;
                case "city":
                    $output = @$ipdat->geoplugin_city;
                    break;
                case "state":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "region":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "country":
                    $output = @$ipdat->geoplugin_countryName;
                    break;
                case "countrycode":
                    $output = @$ipdat->geoplugin_countryCode;
                    break;
            }
        }
    }
    return $output;
}
function dateToFrench($date, $format)
{
    $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
    $french_days = array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');
    $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $french_months = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
    return ucfirst(str_replace($english_months, $french_months, str_replace($english_days, $french_days, date($format, ($date)))));
}
function prev_filename($ch)
{
    return str_replace(array(" ", "_", "/", ":", "!", "?", "*", "<", ">", "|", "\\", "'", "�"), '-', $ch);
}
function plainText($text)
{
    $text = strip_tags($text, '<br><p><li>');
    $text = preg_replace('/<[^>]*>/', PHP_EOL, $text);
    return $text;
}

function displayMontant($montant, $chiffres_apres_virgule = 2, $symbole = "?")
{
    return number_format($montant, $chiffres_apres_virgule, ',', ' ') . "" . $symbole;
}

function getUnreadMessage($idUser, $pdo)
{
    $sqlMsg = "
        SELECT M.boit_message_id AS id, U.nom, U.prenom, BM.lastBoxDate AS date, BM.sujet_message AS sujet
        FROM messagerie M
        INNER JOIN boitMessagerie BM ON BM.id = M.boit_message_id
        INNER JOIN users U ON U.id = M.senderId
        WHERE M.lu = 0 AND M.recevorId = :idUser
        GROUP BY M.boit_message_id
    ";
    $msg = $pdo->prepare($sqlMsg);
    $msg->execute(["idUser" => $idUser]);

    return $msg->fetchAll(PDO::FETCH_ASSOC);
}

function getNotifcations($idUser, $pdo)
{
    $sqlNotif = "
        SELECT id, libelle
        FROM notifications
        WHERE id_user = :idUser
    ";
    $notif = $pdo->prepare($sqlNotif);
    $notif->execute(["idUser" => $idUser]);

    return $notif->fetchAll(PDO::FETCH_ASSOC);
}

function newNotifcations($idUser, $notif, $pdo)
{
    if (!empty($idUser) && !empty($notif)) {
        $sqlNotif = "
            INSERT INTO `notifications` (`id`, `libelle`, `id_user`)
            VALUES (NULL, '" . $notif . "', '" . $idUser . "')
        ";
        $notif = $pdo->prepare($sqlNotif);
        $notif->execute();
    }
}