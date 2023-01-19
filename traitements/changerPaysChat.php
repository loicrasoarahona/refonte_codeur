<?php
include('../include/config.php');
include "../requiert/php-global.php";

echo changetPaysChat($mbreId, $_GET['pays'], $pdo);


header("Location: " . $base_url);
