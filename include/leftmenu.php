<?php
$user_role = $_SESSION['userprofile']['type'];


if(!$isMobile)
{
?>
    <div class="col-xl-3 col-sm-4">
        <div class="user-panel-body-left">
	
	<?php
	$profil_image = $_GET['profil_photo'];
			// Prepare the SELECT statement
			$sql = "SELECT profil_photo FROM users WHERE id = ?";
			$stmt = mysqli_prepare($conn, $sql);

			// Bind the values to the placeholders
			mysqli_stmt_bind_param($stmt, "i", $mbreId);

			// Execute the statement and fetch the results
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $profil);
			mysqli_stmt_fetch($stmt);

			// Display the profile photo using an HTML img tag
			//echo '<img src="' . $photo . '" alt="Profile photo">';
	?>
		
            <div class="bg-white rounded p-4 mb-4 text-center shadow-sm">
			<?php if($profil_image === '') { ?>	
                <i class="icofont-user-suited" style="font-size: 50px;"></i>
		<?php } else; ?>
				
				<img src="<?=$Innerurllink?>/images/identites/<?=$profil;?>" alt="<?=strtoupper($_SESSION["name"]); ?>" class="img-thumbnail border rounded" style="height: 100px!important; width: 100px!important; border-radius: 50%!important;">
				
		<?php
		// Close the statement and connection
		mysqli_stmt_close($stmt);
		mysqli_close($conn);

		?>

		<?php
		//suppression de profil
	// Vérifiez si l'utilisateur a soumis le formulaire de suppression
			if (isset($_POST['delete'])) {
			  // Récupérez l'ID de l'utilisateur à partir de la session de l'utilisateur
			  $id = $mbreId;

			  // Créez une requête DELETE pour supprimer l'utilisateur
			  $query = "DELETE FROM users WHERE id = :id";

			  // Préparez et exécutez la requête
			  $stmt = $db->prepare($query);
			  $stmt->execute(array(':id' => $id));

			  // Détruisez la session de l'utilisateur et redirigez-le vers la page de connexion
			  session_destroy();
			  header('Location: https://wonderful-germain.217-160-56-137.plesk.page/');
			  exit;
			}

			
		
		?>
                <h6 class="text-black mb-3"><?php echo strtoupper($_SESSION["name"]); ?></h6>
                <p class="m-0"><?php echo $mbreEmail; ?></p>
                <p class="mb-3"></p>
                <a href="logout" class="btn btn-primary btn-block"><i class="icofont-logout"></i> Se déconnecter</a>
                <p class="mb-0 mt-3"><a href="<?php echo $base_url; ?>profile" class="btn btn-success w-100">Modifier mon profil</a></p>
				
				
            </div>
            <div class="user-panel-sidebar-link mb-4 bg-white rounded shadow-sm overflow-hidden">
                <a href="<?php echo $base_url;?>dashboard"><i class="icofont-home"></i> Dashboard</a>
                <a href="<?php echo $base_url;?>profile"><i class="icofont-user-alt-2"></i> Modifier profil</a>
                <a href="<?php echo $base_url;?>missions"><i class="icofont-money-bag"></i> Gagner de l'argent</a>
                <a href="<?php echo $base_url;?>offrewalls"><i class="icofont-slidshare"></i> Offre mur nouveau</a>
                <a href="<?php echo $base_url; ?>coupons"><i class="icofont-ticket"></i> Coupons</a>
                <a href="<?php echo $base_url;?>add-commande"><i class="icofont-bank"></i> Paiement</a>
                <!-- <div class="dropdown-divider"></div> -->
                <a href="<?php echo $base_url; ?>commandes"><i class="icofont-sub-listing"></i> Mes commandes</a>
                <a href="<?php echo $base_url; ?>traces"><i class="icofont-bear-tracks"></i> Mes participations</a>
            </div>
        </div>
    </div>
<?php
}
?>
