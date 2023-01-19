<?php
$_ROOT = $_SERVER['DOCUMENT_ROOT'];

require_once($_ROOT . '/requiert/bddConnect.php');

function saveUserActivity($userId, $pdo)
{
    try {
        $query = $pdo->query("UPDATE users SET last_activity='" . date("Y-m-d H:i:s") . "' WHERE id=" . $userId);
    } catch (Exception $e) {
    }
}

function getMembresActifs($pdo)
{
    try {
        $query = $pdo->query("SELECT count(*) as compte from users where -timestampdiff(second, '" . date("Y-m-d H:i:s") . "', last_activity) < 60");
        $resultat = $query->fetch(PDO::FETCH_ASSOC);
        return $resultat['compte'];
    } catch (Exception $e) {
    }
    return 0;
}

function getMembresActifsParRoom($room, $pdo)
{
    try {
        $query = $pdo->query("SELECT count(*) as compte from users where -timestampdiff(second, '" . date("Y-m-d H:i:s") . "', last_activity) < 60 and pays_chat='" . $room . "'");
        $resultat = $query->fetch(PDO::FETCH_ASSOC);
        return $resultat['compte'];
    } catch (Exception $e) {
    }
    return 0;
}

function getUserPays($userId, $pdo)
{
    $query = $pdo->query("SELECT pays from users where id=" . $userId);
    $resultat = $query->fetch(PDO::FETCH_ASSOC);
    return $resultat['pays'];
}

function changetPaysChat($userId, $paysCode, $pdo)
{
    $tousLesPays = ["hn", "dm", "fr", "dz", "ga", "ph", "ss", "rw", "sd", "se", "sr", "eh", "gw", "es-pv", "jp", "hm", "je", "gu", "gb", "pk", "sg", "ru", "do", "gt", "kw", "il", "gg", "gp", "dk", "sb", "py", "pn", "st", "sc", "dj", "gq", "gf", "kr", "im", "ke", "kg", "gb-nir", "hk", "kp", "io", "gd", "gs", "sa", "re", "pm", "sv", "rs", "pl", "gr", "ge", "in", "mv", "lr", "ma", "nz", "au", "bn", "by", "tt", "ug", "tc", "es-ct", "ye", "ac", "ck", "bo", "at", "ls", "mw", "nl", "mu", "ci", "bm", "bz", "tw", "us", "ta", "vi", "tv", "bl", "aw", "ch", "mc", "mt", "no", "lc", "mg", "lt", "mp", "ad", "cl", "as", "bh", "ua", "tr", "yt", "td", "bi", "ar", "cm", "ae", "cz", "mq", "lu", "mf", "lb", "md", "ms", "ag", "cx", "co", "tf", "vn", "zm", "gb-sct", "tg", "cn", "bj", "aq", "cy", "af", "lv", "om", "mr", "ni", "la", "me", "mh", "gb-wls", "cc", "bg", "tj", "un", "vu", "wf", "uy", "za", "zw", "vc", "tk", "bf", "bq", "cu", "ne", "nr", "mk", "np", "ng", "bs", "cw", "bd", "um", "va", "uz", "xk", "ws", "th", "ca", "be", "cv", "ai", "br", "ly", "nf", "my", "mn", "nu", "az", "ba", "bv", "am", "cr", "tl", "xx", "tm", "tz", "ve", "al", "bw", "cd", "lk", "mo", "mx", "nc", "na", "mz", "li", "mm", "cf", "cefta", "bb", "vg", "to", "tn", "ao", "bt", "cp", "ax", "cg", "ml", "jo", "it", "ic", "gh", "sm", "pa", "sz", "gb-eng", "es-ga", "pw", "sl", "de", "ea", "gi", "fm", "kh", "et", "fo", "dg", "ec", "sn", "sy", "sx", "pt", "so", "eu", "jm", "hr", "ki", "kz", "ie", "km", "ir", "gy", "gn", "fj", "pg", "sk", "ro", "sj", "pf", "fk", "eg", "is", "id", "ky", "iq", "kn", "hu", "ee", "er", "fi", "gm", "sh", "ps", "pr", "si", "pe", "qa", "gl", "es", "ht"];

    $index = array_search($paysCode, $tousLesPays);
    if ($index >= 0) {
        $requete = "update users set pays_chat='" . strtoupper($paysCode) . "' where id=" . $userId;
        return $pdo->exec($requete);
    }

    return false;
}
