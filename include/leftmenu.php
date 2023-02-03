<?php
$user_role = $_SESSION['userprofile']['type'];


?>
<div class="col-12 col-lg-3">
    <div style="border-radius: 40px;" class="user-panel-body-left mb-4">

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

        <div style="background-color: #f8f9fa;" class="rounded p-4 shadow">
            <?php if ($profil_image === '') { ?>
            <i class="icofont-user-suited" style="font-size: 50px;"></i>
            <?php } else; ?>

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
            <div class="d-flex justify-content-end">
                <!-- Bouton Desktop -->
                <div class="d-none d-lg-block">
                    <i id="bt-dropdown-left-menu" style="font-size: 2rem; font-weight: bold; cursor: pointer;"
                        class="bi bi-list"></i>
                </div>
            </div>

            <div style="" class="d-flex flex-no-wrap justify-content-between">
                <div class="" style="margin : 0">
                    <h6 style="text-align: left;" class="text-black"></h6>
                    <p style="text-align: left; line-height: 8px;" class="">
                        <?php echo strtoupper($_SESSION['name']); ?>&nbsp;&nbsp;&nbsp;
                        <a style="color: #de3545; font-size: 1.3rem;" href="logout"><i class="icofont-logout"></i></a>
                    </p>
                    <p class="mb-3"></p>
                </div>

                <!-- Bouton Mobile -->
                <div class="d-block d-lg-none">
                    <i id="bt-dropdown-left-menu-mobile" style="font-size: 2rem; font-weight: bold; cursor: pointer;"
                        class="bi bi-list"></i>
                </div>

            </div>


        </div>
        <!-- Desktop -->
        <div id="left-menu" class="d-none d-lg-block">
            <?php leftMenu($base_url); ?>
        </div>

        <!-- Mobile -->
        <div style="display: none;" id="left-menu-mobile" class="d-none d-lg-none">
            <?php leftMenu($base_url); ?>
        </div>
    </div>
</div>

<script>
$bt_dropdown_left = $('#bt-dropdown-left-menu');
$leftMenu = $('#left-menu');
let menuDesktop = true;

$bt_dropdown_left.on('click', () => {
    menuDesktop = !menuDesktop;

    if (!menuDesktop) {
        $leftMenu.removeClass('d-lg-block');
        $leftMenu.removeClass('d-none');
    }
    $leftMenu.slideToggle(200, () => {
        if (menuDesktop) {
            $leftMenu.addClass('d-lg-block');
            $leftMenu.addClass('d-none');
        }
    });
});

$bt_dropdown_left_mobile = $('#bt-dropdown-left-menu-mobile');
$leftMenu_mobile = $('#left-menu-mobile');
$bt_dropdown_left_mobile.on('click', () => {
    $leftMenu_mobile.removeClass('d-lg-block');
    $leftMenu_mobile.removeClass('d-none');
    $leftMenu_mobile.slideToggle(200, () => {});
});
</script>

<?php
function leftMenu($base_url)
{
?>
<div id="left-menu" class="user-panel-sidebar-link bg-white rounded shadow-sm">
    <a href="<?php echo $base_url; ?>dashboard"><i class="icofont-home"></i> Dashboard</a>
    <a href="<?php echo $base_url; ?>profile"><i class="icofont-user-alt-2"></i> Modifier profil</a>
    <a href="<?php echo $base_url; ?>missions"><i class="icofont-money-bag"></i> Gagner de l'argent</a>
    <a href="<?php echo $base_url; ?>offrewalls"><i class="icofont-slidshare"></i> Offre mur nouveau</a>
    <a href="<?php echo $base_url; ?>coupons"><i class="icofont-ticket"></i> Coupons</a>
    <a href="<?php echo $base_url; ?>add-commande"><i class="icofont-bank"></i> Paiement</a>
    <!-- <div class="dropdown-divider"></div> -->
    <a href="<?php echo $base_url; ?>commandes"><i class="icofont-sub-listing"></i> Mes commandes</a>
    <a href="<?php echo $base_url; ?>traces"><i class="icofont-bear-tracks"></i> Mes participations</a>
</div>
<?php
}
?>