<?php
session_start();

include($_SERVER["DOCUMENT_ROOT"] . '/include/config.php');
include_once($_SERVER["DOCUMENT_ROOT"] . '/requiert/php-global.php');

$userConnect = $_SESSION['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['msg-id']) && !empty($_POST['msg-id']) && !empty($userConnect) && $mbreLevel > 1) {
        $pdo->exec("DELETE FROM tchat WHERE id = '" . $_POST['msg-id'] . "' LIMIT 1");
    }
}
