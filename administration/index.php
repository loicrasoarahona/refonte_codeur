<?php

ob_start();
 if ($_GET['action'] == 'logout') {
        session_destroy();

        unset($_SESSION['adminid']);

        unset($_SESSION['id']);

        unset($_SESSION['email']);

        unset($_SESSION['passe']);
        
        ?>

        <script type="text/javascript">

            swal({

                text: "Déconnexion en cours, veuillez patienter...",

                button: false,

                icon: "success",

                closeOnClickOutside: false,

                closeOnEsc: false,

            });

            setTimeout("window.location='<?= url_site; ?>'", 3000);

        </script>

        <?php

    }
include('./requiert/inc-head.php');

include('./requiert/php-global.php');
//var_dump('ok'); die();
include('./requiert/php-form/home.php');


$meta_title = 'Panel d\'administration : Accueil | cashbackreduction.com';

$nomPage = 'accueil';

include('./requiert/inc-header-navigation.php');



?>
    <script type="text/javascript" src="cashback/js/jquery.min.js"></script>
    <?php
        if(isset($reponsError) && !empty($reponsError)){
    ?>
        <div class='alert alert-danger'>
            <?= $reponsError; ?>
        </div>
    <?php
        }else if(isset($reponsConfirm ) && !empty($reponsConfirm)){
    ?>
        <div class='alert alert-success'>
            <?= $reponsConfirm; ?>
        </div>
    <?php
        }
    ?>
           <nav class="navbar navbar-expand navbar-light bg-light mb-1">
                <h4 class="text-primary" > Administration Dashboard</h4>
          </nav>
 
    <br/>
    
<nav class="navbar navbar-expand navbar-light bg-light mb-1">
    <h4 class="text-primary" >  Vérification des profils</h4>
</nav>
 
<div class="transaction-list">

	<form method="post">

	<!-- TRANSACTION LIST HEADER -->

	<div class="transaction-list-header">

		<div class="transaction-list-header-date admin-s1">

			<p class="text-header small">Utilisateur</p>

		</div>

		<div class="transaction-list-header-author">

			<p class="text-header small">Adresse e-mail</p>

		</div>

		<div class="transaction-list-header-code">

			<p class="text-header small">Code</p>

		</div>

		<div class="transaction-list-header-date">

			<p class="text-header small"></p>

		</div>

	</div>

	<!-- /TRANSACTION LIST HEADER -->

	<?php foreach ($all_users_profil as $dones_user):?>

	<!-- TRANSACTION LIST ITEM -->

	<div class="transaction-list-item">

		<div class="transaction-list-item-date admin-s1">

			<p><?= $dones_user['prenom']; ?> <?= $dones_user['nom']; ?></p>

		</div>

		<div class="transaction-list-item-author">

			<p class="text-header"><?= $dones_user['email']; ?></p>

		</div>

		<div class="transaction-list-item-item">

			<p class="category primary">

				<?php if ($dones_user['code_verif'] == 0) echo '-'; else echo $dones_user['code_verif']; ?>

			</p>

		</div>

		<div class="transaction-list-item-code">

			<?php if ($dones_user['code_verif'] == 0): ?>

				<button name="generer" value="<?= $dones_user['id']; ?>" class="button primary admin-s2">Générer un code</button>

			<?php  else: ?>

				<button name="send" value="<?= $dones_user['id']; ?>" class="button tertiary admin-s2">Document envoyé</button>

			<?php endif; ?>

		</div>

		<div class="transaction-list-item-code">

			<a href="<?= url_panel; ?>/membres.php?action=<?= $dones_user['id']; ?>">

				<div class="button secondary admin-s2">Voir le profil</div>

			</a>

		</div>

	</div>

	<!-- /TRANSACTION LIST ITEM -->

	<?php endforeach; ?>

	</form>

</div>

<br/>
<br/>


<!-- HEADLINE -->
<nav class="navbar navbar-expand navbar-light bg-light mb-1">
    <h4 class="text-primary" > Vérification des pièces d'identités</h4>
</nav>

<!-- TRANSACTION LIST -->

<div class="transaction-list">

	<form method="post">

	<!-- TRANSACTION LIST HEADER -->

	<div class="transaction-list-header">

		<div class="transaction-list-header-date admin-s1">

			<p class="text-header small">Utilisateur</p>

		</div>

		<div class="transaction-list-header-author">

			<p class="text-header small">Adresse e-mail</p>

		</div>

		<div class="transaction-list-header-item">

			<p class="text-header small">Documents</p>

		</div>



		<div class="transaction-list-header-icon"></div>

		<div class="transaction-list-header-icon"></div>

	</div>

	<!-- /TRANSACTION LIST HEADER -->

	<?php foreach ($all_users_idt as $dones_user):?>

	<!-- TRANSACTION LIST ITEM -->

	<div class="transaction-list-item">

		<div class="transaction-list-item-date admin-s1">

			<p><?= $dones_user['prenom']; ?> <?= $dones_user['nom']; ?></p>

		</div>

		<div class="transaction-list-item-author">

			<p class="text-header"><?= $dones_user['email']; ?></p>

		</div>

		<div class="transaction-list-item-item">

			<p class="category primary">

				<?php if ($dones_user['ident_recto'] == '') echo '-'; else echo '[ <a href="../'.$dones_user['ident_recto'].'" target="_blank">Recto</a> ]'; ?>

				<span class="m-l-10 m-r-10">-</span>

				<?php if ($dones_user['ident_verso'] == '') echo '-'; else echo '[ <a href="../'.$dones_user['ident_verso'].'" target="_blank">Verso</a> ]'; ?>

			</p>

		</div>

		<?php if ($dones_user['ident_verif'] == 0): ?>

		<div class="transaction-list-item-code">

			<button name="ident_valider" value="<?= $dones_user['id']; ?>" class="button primary admin-s2">Valider</button>

		</div>

		<div class="transaction-list-item-code">

			<button name="ident_refuser" value="<?= $dones_user['id']; ?>" class="button tertiary admin-s2">Refuser</button>

		</div>

		<?php endif; ?>

		<div class="transaction-list-item-code">

			<a href="<?= url_panel; ?>/membres.php?action=<?= $dones_user['id']; ?>">

				<div class="button secondary admin-s2">Voir le profil</div>

			</a>

		</div>

	</div>

	<!-- /TRANSACTION LIST ITEM -->

	<?php endforeach; ?>

	</form>

</div>

<br/>
<br/>

<!-- HEADLINE -->
<nav class="navbar navbar-expand navbar-light bg-light mb-1">
    <h4 class="text-primary" > Tentative de doublure de compte</h4>
</nav>
<!-- /HEADLINE -->

<!-- TRANSACTION LIST -->

<div class="transaction-list">

	<form method="post">

	<!-- TRANSACTION LIST HEADER -->

	<div class="transaction-list-header">

		<div class="transaction-list-header-date admin-s1">
			<p class="text-header small">Nom </p>
		</div>

        <div class="transaction-list-header-date admin-s1">
            <p class="text-header small">Prenom</p>
        </div>

		<div class="transaction-list-header-author">
			<p class="text-header small">Adresse e-mail</p>
		</div>

		<div class="transaction-list-header-icon">
			<p class="text-header small">Pays</p>
        </div>

		<div class="transaction-list-header-icon"></div>

		<div class="transaction-list-header-icon"></div>

	</div>

	<!-- /TRANSACTION LIST HEADER -->

	<?php foreach ($double as $dones_user):?>

	<!-- TRANSACTION LIST ITEM -->

	<div class="transaction-list-item">

		<div class="transaction-list-item-date admin-s1">
			<p><?= $dones_user['nom']; ?></p>
		</div>

        <div class="transaction-list-item-date admin-s1">
			<p><?= $dones_user['prenom']; ?></p>
		</div>

		<div class="transaction-list-item-author">
			<p class="text-header"><?= $dones_user['email']; ?></p>
		</div>
        
		<div class="transaction-list-item-code">
            <p><?php
                $details = json_decode(file_get_contents("http://ipinfo.io/".$dones_user['ip'].""));
                echo $details->country;
             ?></p>
		</div>
        
		<div class="transaction-list-item-code">
			<button 
             name="ident_delete"
             style='margin:1.5vh 0' 
             value="<?= $dones_user['id']; ?>" 
             class="button tertiary admin-s2"
             >Refuser</button>
		</div>

		<div class="transaction-list-item-code">
			<a style='margin:1.5vh 0' class="button secondary admin-s2" href="<?= url_panel; ?>/membres.php?action=<?= $dones_user['id']; ?>">
                Voir le profil
			</a>
		</div>

        </div>
        </div>
	<!-- /TRANSACTION LIST ITEM -->

	<?php endforeach; ?>

	</form>


    <?php

   



	include('./requiert/inc-footer.php');

?>