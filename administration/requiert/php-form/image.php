<?php



if(!empty($_POST['add_image'])){

    
    $retour_total = $pdo->query("SELECT COUNT(*) AS total FROM bannier");

    $donnees_total = $retour_total->fetch();

    if($donnees_total['total'] <= 20){


    if(
        !empty($_FILES['image'])  
    ){

       
        if (!empty($_FILES["image"]["name"]) ) {
            
                $retour_total = $pdo->query("SELECT COUNT(*) AS total FROM bannier");

                $donnees_total = $retour_total->fetch();

                $nbri = $donnees_total['total'] +1;

                $target_dir = "../images/bannier/";

                $target_filei = $target_dir.$nbri.'.jpg' ;

    			$imageFileType = strtolower(pathinfo($target_filei,PATHINFO_EXTENSION));

                // Check if image file is a actual image or fake image
                $check = getimagesize($_FILES["image"]["tmp_name"]);

                if($check !== false ){
                    $uploadimg = 1;
                } else {
                    $reponsError = "File is not an image.";
                    $uploadimg = 0;
                }
            
                // Check file size
                if ($_FILES["image"]["size"] > 500000000 ) {
                    $reponsError = "Sorry, your file is too large.";
                    $uploadimg = 0;
                }
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                    $reponsError = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadimg = 0;
                }
                // Check if $uploadimg is set to 0 by an error

                if ($uploadimg == 0) {

                    $reponsError = $reponsError;
                    // if everything is ok, try to upload file
                    
                } else {
    
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_filei) ) {
    
                        $post_image = "./images/bannier/".$nbri.'.jpg';
                        $reponsConfirm="image bien inserer";

                    } else {
                        $reponsError = "Désolé, une erreur c'est produite. Veuillez réessayer.";
                        $post_image=null;
                    }
     
                }

                if(!isset($reponsError)){

                    $sql = "INSERT INTO bannier SET img_src='".$post_image."'  ";
                    $pdo->exec($sql);
            
                }

            }

}

    }else{

        $reponsError = "Vous pouvez ajouter que 20 photo maximun.";
        
    }
}
?>