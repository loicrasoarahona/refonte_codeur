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
