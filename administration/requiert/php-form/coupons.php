<?php
	if (!empty($_POST['categorycoupon'])) { $post_category = htmlspecialchars(addslashes($_POST['categorycoupon'])); } else { $post_category = null; }
	if (!empty($_POST['typecoupon'])) { $post_typecoupon = htmlspecialchars(addslashes($_POST['typecoupon'])); } else { $post_typecoupon = null; }
	if (!empty($_POST['dateDebut'])) { $post_dateDebutCoupon = htmlspecialchars(addslashes($_POST['dateDebut'])); } else { $post_dateDebutCoupon = null; }
	if (!empty($_POST['dateFin'])) { $post_dateFinCoupon = htmlspecialchars(addslashes($_POST['dateFin'])); } else { $post_dateFinCoupon = null; }
	if (!empty($_POST['code'])) { $post_code = htmlspecialchars(addslashes($_POST['code'])); } else { $post_code = null; }
	if (!empty($_POST['nom'])) { $post_nom = htmlspecialchars(addslashes($_POST['nom'])); } else { $post_nom = null; }
	if (!empty($_POST['url'])) { $post_url = htmlspecialchars(addslashes($_POST['url'])); } else { $post_url = null; }
	if (!empty($_POST['description'])) { $post_description = htmlspecialchars(addslashes($_POST['description'])); } else { $post_description = null; }
	if (!empty($_POST['pays'])) { $post_pays = htmlspecialchars(addslashes($_POST['pays'])); } else { $post_pays = null; }

	$post_valid = 0;

	if (!empty($_POST['submit_add'])) {
		
		if (!empty($_FILES["image"]["name"]) ) {
			$target_dir = "../images/coupon/";
			$target_file = $target_dir . basename($_FILES["image"]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

			$target_file = $target_dir . code(35) .'.'. $imageFileType;

			// Check if image file is a actual image or fake image
			
			$check = getimagesize($_FILES["image"]["tmp_name"]);
			if($check !== false ) {
				$uploadOk = 1;
			} else {
				$reponsError = "File is not an image.";
				$uploadOk = 0;
			}
		
			// Check file size
			if ($_FILES["image"]["size"] > 500000000 ) {
				$reponsError = "Sorry, your file is too large.";
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				$reponsError = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				$reponsError = "D??sol??, les documents n'ont pas ??t?? envoy??s.";
			// if everything is ok, try to upload file
			} else {
				if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file) ) {
					$reponsConfirm = "Les documents ont bien ??t?? envoy??s.";
					$post_image=$target_file;
					
				} else {
					$reponsError = "D??sol??, une erreur c'est produite. Veuillez r??essayer.";
					$post_image=null;
				}
			}
		}
		
		$sql="INSERT INTO `coupons` (`typecoupon`, `dateDebut`, `dateFin`, `code`, `nom`, `url`, `description`, `pays`, `valid`, `actif`, `image`, `category_id`) VALUES (";
		$sql.="'".$post_typecoupon."', '".$post_dateDebutCoupon."', '".$post_dateFinCoupon."', '".$post_code."', '".$post_nom."', '".$post_url."', '".$post_description."', '".$post_pays."',".$post_valid.", '0','".$post_image."',".$post_category.")";
		
		$pdo->exec($sql);
		
		$post_typecoupon = null;
		$post_dateDebutCoupon = null;
		$post_dateFinCoupon = null;
		$post_code = null;
		$post_nom = null;
		$post_url = null;
		$post_description = null;
		$post_pays = null;
		$post_valid = null;
		
		$reponsConfirm = 'Le coupon a bien ??t?? ajout??.';
	}
	
	if (!empty($_POST['submit_upd'])) {
		$post_image=null;
		if (!empty($_FILES["image"]["name"]) ) {
			$target_dir = "../images/coupon/";
			$target_file = $target_dir . basename($_FILES["image"]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

			$target_file = $target_dir . code(35) .'.'. $imageFileType;

			// Check if image file is a actual image or fake image
			
			$check = getimagesize($_FILES["image"]["tmp_name"]);
			if($check !== false ) {
				$uploadOk = 1;
			} else {
				$reponsError = "File is not an image.";
				$uploadOk = 0;
			}
		
			// Check file size
			if ($_FILES["image"]["size"] > 500000000 ) {
				$reponsError = "Sorry, your file is too large.";
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				$reponsError = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				$reponsError = "D??sol??, les documents n'ont pas ??t?? envoy??s.";
			// if everything is ok, try to upload file
			} else {
				if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file) ) {
					$reponsConfirm = "Les documents ont bien ??t?? envoy??s.";
					$post_image=$target_file;
					
				} else {
					$reponsError = "D??sol??, une erreur c'est produite. Veuillez r??essayer.";
					$post_image=null;
				}
			}
		}
		
		$pdo->exec("UPDATE coupons SET category_id= '".$post_category."', description = '".$post_description."', dateDebut = '".$post_dateDebutCoupon."', dateFin = '".$post_dateFinCoupon."', typecoupon = '".$post_typecoupon."', code = '".$post_code."', nom = '".$post_nom."', url = '".$post_url."', description = '".$post_description."', pays = '".$post_pays."' ".($post_image!=null?",image='".$post_image."'":"")." WHERE id = '".intval($_GET['id'])."'");

		$reponsConfirm = 'Les informations du coupons ont bien ??t?? modifi??es.';
	}
	
	if (!empty($_POST['active'])) {
		$pdo->exec("UPDATE coupons SET actif = 1 WHERE id = '".intval($_POST['active'])."'") or die ('Erreur : '.mysql_error());

		$reponsConfirm = 'Le coupons a bien ??t?? activ??.';
	}
	
	if (!empty($_POST['desactive'])) {
		$pdo->exec("UPDATE coupons SET actif = 0 WHERE id = '".intval($_POST['desactive'])."'") or die ('Erreur : '.mysql_error());

		$reponsConfirm = 'Le coupons a bien ??t?? mis en pause.';
	}
	
	if (isset($reponsConfirm)) {
?>
		<script type="text/javascript">
			swal({
				text: "<?= $reponsConfirm; ?>",
				button: "Fermer",
				icon: "success",
				closeOnClickOutside: false,
				closeOnEsc: false,
			});
		</script>
<?php
	}
	
	if (isset($reponsError)) {
?>
		<script type="text/javascript">
			swal({
				text: "<?= $reponsError; ?>",
				button: "Fermer",
				icon: "error",
				closeOnClickOutside: false,
				closeOnEsc: false,
			});
		</script>
<?php
	}
?>