<div class="table-responsive border-radius">
    <table class="table m-0 table-hover table-striped table-bordered bt-0 border-radius list-filtrable-table">
        <thead>
        <tr>
            <th scope="col">Date</th>
            <th scope="col">De</th>
            <th scope="col">Titre</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $list = $serviceMessage->list($userConnect);
        if (count($list) > 0)
        {
            foreach ($list as $row)
            {
                ?>
                <tr class="<?php echo (($row["lu"] != 1 && $row["senderId"] != $userConnect) ? 'not-see' : ''); ?>">
                    <td><?php echo dateToFrench($row['lastBoxDate'], "l, h:i"); ?></td>
                    <td><?php echo ($row["senderId"] == $userConnect ? $row["recevorName"] : $row["senderName"]); ?></td>
                    <td>
                        <a href="./messages?a=voir&idmessage=<?php echo $row["id"]; ?>" style="text-decoration : none;">
                            <?= $row["sujet_message"]; ?>
                        <a>
                    </td>
                </tr>
                <?php
            }
        }
        else
        {
            ?>
            <tr>
                <td colspan="3">Vous n'avez aucun message actuellement...</td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>
<br><br>
<div class="alert alert-warning rounded-pill text-center">
	Les messageries sont contrôlés relativement souvent, la publicité est interdite !
</div>