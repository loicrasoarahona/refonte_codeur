<?php
	if (!empty($_POST['nom'])) { $post_nom = htmlspecialchars(addslashes($_POST['nom'])); } else { $post_nom = null; }
	
	function WatsUrl($e){
		$text = "";

		for ($i = 0; $i < count(explode(" ",$e)); $i++) {
		  if ($i == count(explode(" ",$e)) - 1) {
			$text .= utf8_decode(explode(" ",$e)[$i]);

		  } else {
			$text .= utf8_decode(explode(" ",$e)[$i])."+";
		  }
		}

		return $text;
	 };

	if (!empty($_POST['submit_add'])) {

		if (!empty($_FILES["imageMission"]["name"]) ) {

			$target_dir = "../images/categorie/";
			$target_file = $target_dir . basename($_FILES["imageMission"]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			$target_file =$target_dir.WatsUrl(urldecode($_POST['nom'])).'.jpg';
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
					$post_image= "images/categorie/".urlencode($post_nom).'.jpg';
				} else {
					$reponsError = "Désolé, une erreur c'est produite. Veuillez réessayer.";
					$post_image=null;
				}
			}
		}
		

		$pdo->exec("INSERT INTO `categorie` 
        (
                `id`,
                `nomCategorie`,
                `imgCategorie`
        )
        VALUES 
        (
                '',
                '".$post_nom."', 
                '".$post_image."'
        )
            
        ");
		
		$post_nom = null;
		$post_image = null;
		
		$reponsConfirm = 'Le categorie a bien été ajoutée.';
	}

	if (!empty($_POST['submit_upd'])) {
	 
		if (!empty($_FILES["imageMission"]["name"]) ) {

		$post_image=null;
		$target_dir = "../images/categorie/";
			$target_file = $target_dir . basename($_FILES["imageMission"]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			$target_file =$target_dir.WatsUrl(urldecode($_POST['nom'])).'.jpg';
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
					$post_image= "images/categorie/".urlencode($post_nom).'.jpg';
				} else {
					$reponsError = "Désolé, une erreur c'est produite. Veuillez réessayer.";
					$post_image=null;
				}
            }
        }else{
			$post_image= htmlentities($_POST['img']);
        }
            
		$sql = "UPDATE categorie SET nomCategorie = '".$post_nom."' , imgCategorie = '".$post_image."' WHERE id = '".intval($_GET['id'])."'";

		$pdo->exec($sql);
		
		$reponsConfirm = 'Le categorie a bien été modifiée.';
    }
    
    if (!empty($_POST['submit_add_sous_categorie'])) {

        $pdo->exec("INSERT INTO `souscategorie` 
        (
                `id`,
                `id_categorie`,
                `sousCategorieName`
        )
        VALUES 
        (
                '',
                '".$_GET['id']."',
                '".$post_nom."'
        )
            
        ");
		$pdo->exec("UPDATE categorie SET nbr_sous_categorie = nbr_sous_categorie + 1 WHERE id =  '".$_GET['id']."'");

		$reponsConfirm = 'Le sous categorie a bien été ajouter.';
		
	}
 
    
    if (!empty($_POST['deleteSouscategorie'])){

        if(!empty($_POST['foo'])){
            for($i= 0 ;$i < count($_POST['foo']);$i++){
                $id= $pdo->query("SELECT * FROM souscategorie WHERE id=".$_POST['foo'][$i]."")->fetch(PDO::FETCH_OBJ)->id_categorie;
                $pdo->exec("UPDATE categorie SET nbr_sous_categorie = nbr_sous_categorie - 1 WHERE id =".$id."");
                $pdo->exec("DELETE FROM souscategorie WHERE id =".$_POST['foo'][$i]."");
            }
        }

        unset($_POST);

        $reponsConfirm = 'Le sous-categorie a bien été supprimer.';
        
    }
    
        
    if (!empty($_POST['deletecategorie'])){

        if(!empty($_POST['foo'])){
            for($i= 0 ;$i < count($_POST['foo']);$i++){
                $pdo->exec("DELETE FROM categorie WHERE id =".$_POST['foo'][$i]."");
                $pdo->exec("DELETE FROM souscategorie WHERE id_categorie =".$_POST['foo'][$i]."");
            }
        }

        unset($_POST);

        $reponsConfirm = 'Le categorie a bien été supprimer.';
        
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