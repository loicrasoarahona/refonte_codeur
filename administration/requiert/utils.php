<?php
    function getGroupOffers($pdo) {
        $sql = "select * from group_offers";
        $resultat = $pdo->query($sql);

        return $resultat->fetchAll();
    }
?>