<?php
	ini_set('display_errors', '0');
	if (!empty($_POST['idoffre'])) { $post_idoffre = code(30); } else { $post_idoffre = null; }
	if (!empty($_POST['nom'])) { $post_nom = htmlspecialchars(addslashes($_POST['nom'])); } else { $post_nom = null; }
	if (!empty($_POST['url'])) { $post_url = addslashes($_POST['url']); } else { $post_url = null; }
	if (!empty($_POST['description'])) { $post_description = htmlspecialchars(addslashes($_POST['description'])); } else { $post_description = null; }
	if (!empty($_POST['remuneration'])) { $post_remuneration = htmlspecialchars(addslashes($_POST['remuneration'])); } else { $post_remuneration = null; }
	if (!empty($_POST['pays'])) { $post_pays = htmlspecialchars(addslashes($_POST['pays'])); } else { $post_pays = null; }
	$post_valid = 0;
	if (!empty($_POST['valid'])) { $post_valid = htmlspecialchars(addslashes($_POST['valid'])); }

	if (!empty($_POST['premium'])) { $post_premium = htmlspecialchars(addslashes($_POST['premium'])); } else { $post_premium = null; }
		
	if (!empty($_POST['submit_add'])) {
		if (!empty($_FILES["imageMission"]["name"]) ) {

			$target_dir = "../images/missions/";
			$target_file = $target_dir . basename($_FILES["imageMission"]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

			$target_file = $target_dir . code(35) .'.'. $imageFileType;

			// Check if image file is a actual image or fake image
			
			$check = getimagesize($_FILES["imageMission"]["tmp_name"]);
			if($check !== false ) {
				$uploadOk = 1;
			} else {
				$reponsError = "File is not an image.";
				$uploadOk = 0;
			}
		
			// Check file size
			if ($_FILES["imageMission"]["size"] > 500000000 ) {
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
				$reponsError = "Désolé, les documents n'ont pas été envoyés.";
			// if everything is ok, try to upload file
			} else {
				if (move_uploaded_file($_FILES["imageMission"]["tmp_name"], $target_file) ) {
					$reponsConfirm = "Les documents ont bien été envoyés.";

					// $post_image=$url_site.$nbri.'.jpg';
					$post_image=$target_file;

				} else {
					$reponsError = "Désolé, une erreur c'est produite. Veuillez réessayer.";
					$post_image=null;
				}
			}
		}

		$verifi = [];

		 foreach($_POST['Link'] AS $a):
			if(!empty($a) || !trim($a) === "" ){
				$verifi[]=$a;
			} 
		 endforeach;

		$post_quota = count($verifi);

		$q=0;
		$v='';

		foreach($verifi AS $a):
		   if($q == 0){
			  $v.= $a;
		   }else{
			  $v.= ','.$a;
		   }
		   $q++;
		endforeach;
		
	 
		$pdo->exec("INSERT INTO `offers` 
		( 
		`idoffre`, 
		`nom`, 
		`url`,
		`description`, 
		`pays`, 
		`remuneration`, 
		`valid`,
		`actif`, 
		`date`,
		`quota`,
		`premium`, 
		`image`
		) 
		VALUES 
		(
		'".$post_idoffre."', 
		'".$post_nom."', 
		'".$v."', 
		'".$post_description."', 
		'".$post_pays."', 
		'".$post_remuneration."', 
		'".$post_valid."', 
		'0',
		'".date('d/m/Y à H:i:s')."', 
		'".$post_quota."', 
		'".$post_premium."', 
		'".$post_image."'
		)");
		
		$post_idoffre = null;
		$post_nom = null;
		$post_url = null;
		$post_description = null;
		$post_description2 = null;
		$post_pays = null;
		$post_remuneration = null;
		$post_montant = null;
		$post_valid = null;
		$post_regie = null;
		$post_annonceur = null;
		$post_quota = null;
		$post_premium = null;
		$post_image = null;
		
		$reponsConfirm = 'L\'offre a bien été ajoutée.';
	}

	if (!empty($_POST['submit_upd'])) {
		$post_image=null;
		if (!empty($_FILES["imageMission"]["name"]) ) {
			$target_dir = "../images/missions/";
			$target_file = $target_dir . basename($_FILES["imageMission"]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

			$target_file = $target_dir . code(35) .'.'. $imageFileType;

			// Check if image file is a actual image or fake image
			
			$check = getimagesize($_FILES["imageMission"]["tmp_name"]);
			if($check !== false ) {

				$uploadOk = 1;
			} else {
				$reponsError = "File is not an image.";
				$uploadOk = 0;
			}
		
			// Check file size
			if ($_FILES["imageMission"]["size"] > 500000000 ) {
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
				$reponsError = "Désolé, les documents n'ont pas été envoyés.";
			// if everything is ok, try to upload file
			} else {
				if (move_uploaded_file($_FILES["imageMission"]["tmp_name"], $target_file) ) {
					$reponsConfirm = "Les documents ont bien été envoyés.";
					$post_image=$target_file;
					
				} else {
					$reponsError = "Désolé, une erreur c'est produite. Veuillez réessayer.";
					$post_image=null;
				}
			}
		}

		$verifi = [];

		foreach($_POST['Link'] AS $a):
		   if(!empty($a) || !trim($a) === "" ){
			   $verifi[]=$a;
		   } 
		endforeach;
	

	   $post_quota = count($verifi);

	   $q=0;
	   $v='';

	   
	   

	   foreach($verifi AS $a):
		  if($q == 0){
			 $v.= $a;
		  }else{
			 $v.= ','.$a;
		  }
		  $q++;
	   endforeach;


		$sql = "UPDATE 
		offers SET 
		nom = '".$post_nom."', 
		url = '".$v."', 
		description = '".$post_description."', 
		pays = '".$post_pays."', 
		remuneration = '".$post_remuneration."', 
		valid = '".$post_valid."', 
		date = '".date('d/m/Y à H:i:s')."', 
		quota = '".$post_quota."', 
		premium = '".$post_premium."'".($post_image != null ? ",
		image='".$post_image."'":"")."
		
		WHERE id = '".intval($_GET['id'])."'";

		$pdo->exec($sql) or die ('Erreur : '.mysql_error());
		
		$reponsConfirm = 'L\'offre a bien été modifiée.';
	}
	
	if (!empty($_POST['active'])) {
		$pdo->exec("UPDATE offers SET actif = 1 WHERE id = '".intval($_POST['active'])."'") or die ('Erreur : '.mysql_error());

		$reponsConfirm = 'L\'offre a bien été activée.';
	}
	
	if (!empty($_POST['desactive'])) {
		$pdo->exec("UPDATE offers SET actif = 0 WHERE id = '".intval($_POST['desactive'])."'") or die ('Erreur : '.mysql_error());

		$reponsConfirm = 'L\'offre a bien été mise en pause.';
	}
	
 
?>