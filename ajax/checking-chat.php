<?php
error_reporting(E_ERROR|E_PARSE);
ini_set("display_errors", 1);
session_start();

include($_SERVER["DOCUMENT_ROOT"] . '/include/config.php');
include_once($_SERVER["DOCUMENT_ROOT"] . '/requiert/php-global.php');

$userConnect = $_SESSION['id'];

if (!empty($_POST['submit']))
{
	if ($banniT == 0)
	{
		$message = htmlspecialchars(addslashes($_POST['message']));

		if (!empty($message))
		{			
			$pdo->exec("INSERT INTO tchat (time,idUser,message,date) VALUES (NOW(),'".$mbreHashId."','".$message."','".date('d/m/Y à H:i')."')");
		}
	}
}

if ($_GET['a'] == 'refreshco')
{
	if ($mbreNom != '' && $mbrePrenom != '')
	{
		$retour = $pdo->query('SELECT COUNT(*) AS \'nbre_entrees\' FROM connectes WHERE ip=\'' . $_SERVER['REMOTE_ADDR'] . '\'');
		$donnees = $retour->fetch(PDO::FETCH_ASSOC);

		if ($donnees['nbre_entrees'] == 0) // L'ip ne se trouve pas dans la table, on va l'ajouter
		{
			$pdo->exec("INSERT INTO `connectes`(`ip`, `timestamp`, `idUser`) VALUES('".$_SERVER['REMOTE_ADDR']."', '".time()."', '".$mbreHashId."')");
		}
		else // L'ip se trouve d�j� dans la table, on met juste � jour le timestamp
		{
			$pdo->exec('UPDATE connectes SET timestamp=' . time() . ', idUser=\''.$mbreHashId.'\' WHERE ip=\'' . $_SERVER['REMOTE_ADDR'] . '\'');
		}
	}

	$top_connectes = $pdo->query("SELECT COUNT(*), idUser FROM connectes C INNER JOIN users U ON U.hashId = C.idUser WHERE idUser != '' AND U.banni_chat = 0 AND U.pays = '" . $_POST["room"] . "' GROUP BY idUser ORDER BY timestamp");
	$i = $j = 0;
	$all_top_connectes = $top_connectes->fetchAll(PDO::FETCH_ASSOC);

	foreach ($all_top_connectes as $dones_connectes)
	{
		$j++;
	}

	$reqRoom = $pdo->query("SELECT DISTINCT pays FROM users WHERE pays <> ''");
	$rooms = $reqRoom->fetchAll(PDO::FETCH_ASSOC);

	$roomUser = (!empty($_POST["room"])) ? $_POST['room'] : $rooms[0]["pays"];
	?>
	<button type="button" class="btn-default dropdown-toggle room-dropdown-btn" data-toggle="dropdown" aria-expanded="false">
            Room <?php echo $roomUser; ?>
        </button>
        <input type="hidden" id="room-user" value="<?= strtoupper($roomUser) ?>">
        <div class="dropdown-menu" style="">
            <?php foreach ($rooms as $room): ?>
                <a class="dropdown-item" data-room="<?= strtoupper($room["pays"]) ?>" href="#">Room <?= strtoupper($room["pays"]) ?></a>
            <?php endforeach ?>
        </div>
        <div style="margin-left: 38px;">
			<?php

			if ($j > 0) {
				?>
				<i class="icofont-user" style="font-size: 12px;position: absolute;top: 7px;right: 15px;
				                "></i>
			    <span style="font-size: 18px;"><?php echo $j; ?></span>
				<?php
			}
			?>
        </div>
	<?php

	/*foreach ($all_top_connectes as $dones_connectes)
	{
		$us = $pdo->query("SELECT nom, prenom, level FROM users WHERE hashId = '".$dones_connectes['idUser']."'");
		$dones_us = $us->fetch(PDO::FETCH_ASSOC);
		$nom = substr($dones_us['nom'], 0, 2).'.';
		$prenom = $dones_us['prenom'];

		$i++;
	}*/

	$timestamp_1min = time() - (60 * 1); // 60 * 1 = nombre de secondes �coul�es en 1min
	$pdo->exec("DELETE FROM connectes WHERE timestamp < '".$timestamp_1min."'");
}

if ($_GET['a'] == 'refreshchat')
{
	if ($mbreBanniChat) {
		exit("<div class='alert alert-danger text-center w-100'>Vous avez été banni du chat.</div>");
	}

	$sc = $pdo->query("SELECT T.id, T.time, T.date, T.idUser, T.message, U.id as userId FROM tchat T INNER JOIN users U ON U.hashId = T.idUser WHERE U.banni_chat = 0 AND U.pays = '" . $_POST["room"] . "' ORDER BY T.id ASC");
	$i = 0;
	$all_sc = $sc->fetchAll(PDO::FETCH_ASSOC);


	/*$sc = $pdo->query("SELECT T.id, T.time, T.idUser, T.message, U.id as userId FROM tchat T INNER JOIN users U ON U.hashId = T.idUser ORDER BY T.id DESC LIMIT 7");
	$i = 0;
	$all_sc = $sc->fetchAll(PDO::FETCH_ASSOC);*/

	foreach ($all_sc as $dones_chat)
	{
		$id = $dones_chat['id'];
		$us = $pdo->query("SELECT nom, prenom, level FROM users WHERE hashId = '".$dones_chat['idUser']."'");
		$dones_us = $us->fetch(PDO::FETCH_ASSOC);
		
		if ($dones_us['level'] == '1') { $color = '#444444'; }
		elseif ($dones_us['level'] == '99') { $color = '#dc6666'; }
		elseif ($dones_us['level'] == '9') { $color = 'green'; }

		$message = $dones_chat['message'];
		$nom = substr($dones_us['nom'], 0, 2).'.';
		$prenom = $dones_us['prenom'];

		$timer = explode(" à ",$dones_chat['date']);
		$when = "aujourd'hui à " . substr($timer[1], 0, 5);

		if (date('d/m/Y', strtotime('-1 day')) == $timer[0])
		{
			$when = "Hier à " . substr($timer[1], 0, 5);
		}
		elseif (date('d/m/Y', strtotime('-2 day')) == $timer[0])
		{
			$when = "Avant-hier à " . substr($timer[1], 0, 5);
		}
		elseif (date("d/m/Y", strtotime("-3 day")) >= $timer[0])
		{
			$when = $dones_chat['date'];
		}

        if($dones_chat['userId'] == $userConnect)
        {
            ?>
            <div class="chat-msg mb-3 pb-3 owner">
                <div class="chat-msg-profile">
                    <div class="chat-msg-date" style="bottom: -5px;">
                        <?php
                        echo "<b>Vous</b> [" . $when . "]";
                        if ($mbreLevel > 1)
                        {
                        	?>
                        	&bull; <a href="#" data-msg-id="<?php echo $dones_chat["id"];  ?>" class="delete-msg text-danger">x</a>
                        	<?php
                        }
                        ?>
                    </div>
                </div>
                <div class="chat-msg-content">
                    <div class="chat-msg-text">
                    	<?php echo nl2br($dones_chat["message"]); ?>
                    </div>
                </div>
            </div>
            <?php
        }
        else
        {
            ?>
            <div class="chat-msg mb-3 pb-3">
                <div class="chat-msg-profile">
                    <div class="chat-msg-date" style="bottom: -5px;">
                        <?php
                        echo "<b>" . $prenom . "</b> [" . $when . "]";
                        if ($mbreLevel > 1)
                        {
                        	?>
                        	&bull; <a href="#" data-msg-id="<?php echo $dones_chat["id"];  ?>" class="delete-msg text-danger">x</a>
                        	<?php
                        }
                        ?>
                    </div>
                </div>
                <div class="chat-msg-content">
                    <div class="chat-msg-text"><?php echo nl2br($dones_chat["message"]); ?></div>
                </div>
            </div>
            <?php
        }/*
?>
<div class="allmsg" style="<?php if ($i%2==1) { ?>background-color:#efefef;<?php } ?>width:100%;padding:1vh">
	        <div class="head-message">
	        		<div class="f-s-13">
					 <strong>[ <?= $when.substr($timer[1],0, strlen($timer[1]) - 3); ?>]</strong>
				</div>	
				<div style="color:<?= $color; ?>; font-weight: bold;font-size: 14px;">
				
				<?= $prenom; ?> 
				
				</div> 
				
		</div>
		
		<?php if ($mbreLevel > 1) { ?>
			<a 
				href="<?= url_site; ?>/chatroom.php?del=1&id=<?= $id; ?>&idUser=<?= $dones_chat['idUser']; ?>&time=<?= $dones_chat['time']; ?>" 
				onclick="return confirm('Voulez-vous vraiment supprimer ce message ?');">
				<div style="float:right;
				-moz-border-radius:5px;
				 -webkit-border-radius:5px; 
				 border-radius:5px;
				 padding:0px 5px;
				 color:#fd6f6f;
				 margin-left:5px;
				     font-size: 15px;

				 ">
					<i class="fa fa-times" aria-hidden="true"></i>
				</div>
			</a>
			<?php } ?>
		
		<div class="msg">
		<?= nl2br($message); ?>
		</div>
		
	</div>
<?php*/
	$i++;
	}
}
?>