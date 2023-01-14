<?php
session_start();
include('./requiert/php-global.php');

$pdo->exec("DELETE FROM bannier WHERE id='".$_GET['id']."'")

?>

<script>
    window.location="bannier.php?msg=deleted";
</script>