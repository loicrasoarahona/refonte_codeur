<?php
session_start();

include($_SERVER["DOCUMENT_ROOT"] . '/include/config.php');
include_once($_SERVER["DOCUMENT_ROOT"] . '/requiert/php-global.php');

$userConnect = $_SESSION['id'];

if (!empty($_POST["type_maj"]) && !empty($_POST["id_notif"]))
{
    $sqlNotif = "
        DELETE FROM notifications
        WHERE id = '" . intval($_POST["id_notif"]) . "'
        AND id_user = '" . intval($userConnect) . "'
        LIMIT 1
    ";
    $notif = $pdo->query($sqlNotif);

    $allNotif = getNotifcations($userConnect, $pdo);

    echo count($allNotif);
    exit;
}

$allMsg = getUnreadMessage($userConnect, $pdo);
$class = $nbNot = "";

if (count($allMsg) > 0)
{
    $nbNot = count($allMsg);
    $class = "badge badge-pill badge-danger";
}
?>

<div class="btn dropdown dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true">
    <i class="icofont-ui-messaging"></i>
    <span class="nb-notif <?php echo $class; ?>">
        <?php echo $nbNot ?>
    </span>
</div>
<div class="dropdown-menu">
	<a class="ln-msg new-msg dropdown-item" data-super-toogle="modal" data-target="#msgbox-modal" data-id="" href="#">
        <div class="msg-lib">
            <i class="icofont-plus"></i> Nouveau message
        </div>
    </a>
    <?php
    foreach ($allMsg as $msg)
    {
        ?>
        <a class="ln-msg dropdown-item" data-super-toogle="modal" data-target="#msgbox-modal" data-id="<?php echo $msg["id"]; ?>" href="#">
            <div class="msg-lib">
                <?php echo $msg["sujet"]; ?>
            </div>
            <div class="msg-exp">
                <b><?php echo $msg["prenom"] . " " . $msg["nom"]; ?></b> du <?php echo dateToFrench($msg["date"],"l, h:i"); ?>
            </div>
        </a>
        <?php
    }
    ?>
</div>