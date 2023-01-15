<?php
if(!isset($_SESSION['id']))
{
    header('Location: ' . $base_url);
    exit;
}

$sql = "SELECT * FROM parrainage WHERE id = 1";
$req = $pdo->query($sql);
$par = $req->fetch(PDO::FETCH_ASSOC);

/*******************/
/* Submitting data */
/*******************/


$ident_verif = 0;
$req = $pdo->prepare('SELECT id, nom, prenom, email, mdp, actif, banni, datelastco, level,ident_verif FROM users WHERE email=:email');
$req->bindValue(":email",$_SESSION['email']);
$req->execute();
$result_req = $req->fetch(PDO::FETCH_OBJ);

$_SESSION['ident_verif'] = intval($result_req->ident_verif);
$ident_verif = intval($_SESSION['ident_verif']);
if($ident_verif){
    $mbreCodeVerif = 1;
}else{
	$mbreCodeVerif = 0;
}


$reponsError = $reponsConfirm = "";

if (!empty($_POST['nom'])) { $post_nom = htmlspecialchars(addslashes($_POST['nom'])); } else { $post_nom = null; }

if (!empty($_POST['prenom'])) { $post_prenom = htmlspecialchars(addslashes($_POST['prenom'])); } else { $post_prenom = null; }

if (!empty($_POST['email'])) { $post_email = htmlspecialchars(addslashes($_POST['email'])); } else { $post_email = null; }

if (!empty($_POST['adresse'])) { $post_adresse = htmlspecialchars(addslashes($_POST['adresse'])); } else { $post_adresse = null; }

if (!empty($_POST['ville'])) { $post_ville = htmlspecialchars(addslashes($_POST['ville'])); } else { $post_ville = null; }

if (!empty($_POST['codePostal'])) { $post_codePostal = htmlspecialchars(addslashes($_POST['codePostal'])); } else { $post_codePostal = null; }

if (!empty($_POST['news'])) { $post_newsletter = htmlspecialchars(addslashes($_POST['news'])); } else { $post_newsletter = null; }

if (!empty($_POST['parrain'])) { $post_parrain = (int) filter_var($_POST['parrain'], FILTER_SANITIZE_NUMBER_INT); } else { $post_parrain = null; }

if (!empty($_POST['iban'])) { $post_iban = htmlspecialchars(addslashes($_POST['iban'])); } else { $post_iban = null; }

if (!empty($_POST['swift'])) { $post_swift = htmlspecialchars(addslashes($_POST['swift'])); } else { $post_swift = null; }

if (!empty($_POST['paypal'])) { $post_paypal = htmlspecialchars(addslashes($_POST['paypal'])); } else { $post_paypal = null; }

if (!empty($_POST['skrill'])) { $post_skrill = htmlspecialchars(addslashes($_POST['skrill'])); } else { $post_skrill = null; }


if (!empty($_POST['code_verif'])) { $post_code_verif = htmlspecialchars(addslashes($_POST['code_verif'])); } else { $post_code_verif = null; }
//if(!empty($_POST['profil_photo'])) {$post_profil_photo = htmlspecialchars(addslashes($_POST['profil_photo']));}else


if (!empty($_POST['valid_ident']) && !empty($_FILES["fileToUpload"]["name"]) && !empty($_FILES["fileToUpload2"]["name"])) {

    $target_dir = "images/identites/";

    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

    $target_file2 = $target_dir . basename($_FILES["fileToUpload2"]["name"]);

    $uploadOk = 1;

    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    $imageFileType2 = strtolower(pathinfo($target_file2,PATHINFO_EXTENSION));

    $target_file = $target_dir . code(35) .'.'. $imageFileType;

    $target_file2 = $target_dir . code(35) .'.'. $imageFileType2;

    // Check if image file is a actual image or fake image

    if (isset($_POST["valid_ident"])) {

        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

        $check2 = getimagesize($_FILES["fileToUpload2"]["tmp_name"]);

        if($check !== false && $check2 !== false) {

            $uploadOk = 1;

        } else {

            $reponsError = "File is not an image.";

            $uploadOk = 0;

        }

    }

    // Check file size

    if ($_FILES["fileToUpload"]["size"] > 500000000 && $_FILES["fileToUpload2"]["size"] > 500000000) {

        $reponsError = "Sorry, your file is too large.";

        $uploadOk = 0;

    }

    // Allow certain file formats

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType2 != "jpg" && $imageFileType2 != "png" && $imageFileType2 != "jpeg" && $imageFileType2 != "gif") {

        $reponsError = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";

        $uploadOk = 0;

    }

    // Check if $uploadOk is set to 0 by an error

    if ($uploadOk == 0) {

        $reponsError = "Désolé, les documents n'ont pas été envoyés.";

        // if everything is ok, try to upload file

    } else {

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file) && move_uploaded_file($_FILES["fileToUpload2"]["tmp_name"], $target_file2)) {

            $reponsConfirm = "Les documents ont bien été envoyés.";

            $pdo->exec("UPDATE users SET ident_recto = '".$target_file."', ident_verso = '".$target_file2."' WHERE id = '".$mbreId."'");



            $mbreIdentRecto = $target_file;

            $mbreIdentVerso = $target_file2;

        } else {

            $reponsError = "Désolé, une erreur c'est produite. Veuillez réessayer.";

        }

    }

}


// update photo de profil

//insertion et upload photo de profil
//envoyer

if(isset($_POST['envoyer'])){

    //$numapp = $_POST['numap'];

    if(isset($_FILES['photo_de_profil']) and $_FILES['photo_de_profil']['error'] == 0){

        $profil_image = $_POST['photo_de_profil'];

        $dossier = 'images/identites/';
        $temp_name = $_FILES['photo_de_profil']['tmp_name'];
        if(!is_uploaded_file($temp_name)){
            exit("Fichier introuvable");
        }
        if($_FILES['fichier']['size'] >=1000000){
            exit("Erreur, fichiers volumineux");
        }

        $infofichier =pathinfo( $_FILES['photo_de_profil']['name']);
        $extension_upload = $infofichier['extension'];
        $extension_upload = strtolower($extension_upload);

        $extension_autorisee = array('png', 'jpeg', 'jpg', 'svg');
        if(!in_array($extension_upload, $extension_autorisee)){
            exit("Veuillez inserer une image avec extension autorisée (jpeg, jpg, png)");
        }
        $nom_photo = date('Y-m-d-s').'-'.$post_email.".".$extension_upload;
        if(!move_uploaded_file($temp_name,$dossier.$nom_photo)){
            // header("location:http://localhost/maxiconcour/doc");
            exit("Problème dans le telechargement d'image, rééssayer");
        }
        $ph_name= $nom_photo;
        $pdo->exec("UPDATE users SET profil_photo = '".$ph_name."' WHERE id = '".$mbreId."'");
    }else{
        $ph_name="inconnu.jpg";
    }
}
//$req = $pdo->prepare('INSERT INTO users (profil_photo) VALUES (:profil_photo)');
//$pdo->exec("UPDATE users SET profil_photo WHERE id = '".$mbreId."'");
//$req->execute(array(
//'profil_photo' => $ph_name
//));






if (!empty($_POST['submit_update']) and $ident_verif == 0) {

    $pdo->exec("UPDATE users SET 
    nom = '".$post_nom."', 
    prenom = '".$post_prenom."',
    email = '".$post_email."', 
    adresse = '".$post_adresse."', 
    ville = '".$post_ville."',
    codePostal = '".$post_codePostal."', 
    idParrain = '".$post_parrain."', 
    pays = '".$_POST['pays']."',
    news = '".$post_newsletter."' 

    WHERE id = '".$mbreId."'");

    $mbreCodeVerif = 1;
    $mbreNom = $post_nom;
    $mbrePrenom = $post_prenom;
    $mbreEmail = $post_email;
    $mbreAdresse = $post_adresse;
    $mbreVille = $post_ville;
    $mbreCodePostal = $post_codePostal;
    $mbreIban = $post_iban;
    $mbreSwift = $post_swift;
    $mbrePaypal = $post_paypal;
    $mbreSkrill = $post_skrill;
    $mbrePays = $_POST['pays'];
    $mbreParrain = $post_parrain;

    if ($post_parrain == 0 or $post_parrain == null){
        $mbreParrain = 'Aucun';
    } else {
        $sqlParrain = $pdo->query("SELECT * FROM users WHERE id = '".$post_parrain."'");
        $resultatParrain = $sqlParrain->fetch(PDO::FETCH_ASSOC);
        $parrainNom = addslashes(htmlentities($resultatParrain['nom']));
        $parrainPrenom = addslashes(htmlentities($resultatParrain['prenom']));
        $mbreParrain = $parrainPrenom.' '.substr($parrainNom, 0, 1).'.';
    }

    $mbreNewsletter = $post_newsletter;
    $reponsConfirm = 'Votre profil a bien été modifié.';

}

if (!empty($_POST['submit_update_bank'])) {



    $pdo->exec("UPDATE users SET  iban = '".$post_iban."', swift = '".$post_swift."', paypal = '".$post_paypal."', skrill = '".$post_skrill."' WHERE id = '".$mbreId."'");



    $mbreIban = $post_iban;

    $mbreSwift = $post_swift;

    $mbrePaypal = $post_paypal;

    $mbreSkrill = $post_skrill;



    $reponsConfirm = 'Vos infomartion a bien été modifié.';



}





if (!empty($_POST['valid_profil'])) {

    if ($mbreCodeVerif == $post_code_verif) {

        $pdo->exec("UPDATE users SET code_verif = 1 WHERE id = '".$mbreId."'");

        $reponsConfirm = 'Votre profil a bien été vérifié.';
        $mbreCodeVerif = 1;

    } else {

        $reponsError = 'Oups, le code est incorrect.';

    }

}

if (isset($_SESSION['id'])) {
    newNotifcations($_SESSION['id'], $reponsConfirm, $pdo);
}




//var_dump($ph_name);
// $requette="INSERT INTO profils VALUES(`$ph_name`)";
// $resultat=mysqli_query($link,$requette);
//header('Location: affichage.php');
//}

?>

<section class="user-panel-body py-5">
    <div class="container">
        <div class="row">
            <?php include "include/leftmenu.php"; ?>
            <div class="col-xl-9 col-sm-8">
                <div id="mc_profile" class="bg-white shadow-sm mb-4">
                    <div class="row">
                        <div class="col-md-12 mb-4">

                            <div class="p-4">
                                <h5 class="mb-0">Modifier mon profil</h5>
                            </div>
                            <hr class="m-0">

                            <form action="" method="POST" class="js-validate" multiple="" enctype="multipart/form-data">
                                <input type="hidden" name="submit_update" value="1">
                                <div class="p-4">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="js-form-message">
                                                <label id="nom" class="form-label">
                                                    Nom
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="form-group">
                                                    <input type="text" required="required" class="has-validation form-control" name="nom" value="<?=ucwords($mbreNom); ?>" placeholder="Entrez le nom de famille" aria-label="Entrez le nom de famille" aria-describedby="nom" data-msg="Veuillez entrer le nom de famille" data-error-class="u-has-error" data-success-class="u-has-success" <?=($mbreCodeVerif == 1) ? 'readonly="readonly"' : ''; ?>>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="js-form-message">
                                                <label id="prenom" class="form-label">
                                                    Prénom
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="form-group">
                                                    <input type="text" required="required" class="has-validation form-control" name="prenom" value="<?php echo ucfirst($mbrePrenom); ?>" placeholder="Entrez le prénom" aria-label="Entrez le prénom" aria-describedby="prenom" data-msg="Veuillez entrer le prénom" data-error-class="u-has-error" data-success-class="u-has-success" <?php echo ($mbreCodeVerif == 1) ? 'readonly="readonly"' : ''; ?>>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="js-form-message">
                                                <label id="email" class="form-label">
                                                    Email
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="form-group">
                                                    <input type="email" required="required" class="has-validation form-control" name="email" value="<?php echo $mbreEmail; ?>" placeholder="Entrez l'adresse e-mail" aria-label="Entrez l'adresse e-mail" aria-describedby="email" data-msg="Veuillez entrer un email valide" data-error-class="u-has-error" data-success-class="u-has-success" <?php echo ($mbreCodeVerif == 1) ? 'readonly="readonly"' : ''; ?>>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="js-form-message">
                                                <label id="adresse" class="form-label">
                                                    Adresse
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="form-group">
                                                    <input type="text" required="required" class="has-validation form-control" name="adresse" value="<?php echo $mbreAdresse; ?>" placeholder="Entrez l'adresse complète (Rue + nr.)" aria-label="Entrez l'adresse complète (Rue + nr.)" aria-describedby="adresse" data-msg="Veuiller entrer l'adresse complète (Rue + nr.)" data-error-class="u-has-error" data-success-class="u-has-success" <?php echo ($mbreCodeVerif == 1) ? 'readonly="readonly"' : ''; ?>>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="js-form-message">
                                                <label id="codePostal" class="form-label">
                                                    Code Postal
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="form-group">
                                                    <input type="text" required="required" class="has-validation form-control" name="codePostal" value="<?php echo $mbreCodePostal; ?>" placeholder="Entrez le code postal" aria-label="Entrez le code postal" aria-describedby="codePostal" data-msg="Veuillez entrer un code postal valide" data-error-class="u-has-error" data-success-class="u-has-success" <?php echo ($mbreCodeVerif == 1) ? 'readonly="readonly"' : ''; ?>>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="js-form-message">
                                                <label id="ville" class="form-label">
                                                    Ville
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="form-group">
                                                    <input type="text" required="required" class="has-validation form-control" name="ville" value="<?php echo $mbreVille; ?>" placeholder="Entrez la ville" aria-label="Entrez la ville" aria-describedby="ville" data-msg="Veuillez entrer la ville" data-error-class="u-has-error" data-success-class="u-has-success" <?php echo ($mbreCodeVerif == 1) ? 'readonly="readonly"' : ''; ?>>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="js-form-message">
                                                <label id="parrain" class="form-label">
                                                    Parrain
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="form-group">
                                                    <input type="text" required="required" class="has-validation form-control" name="parrain" value="<?php echo $mbreParrain; ?>" placeholder="ID du Parrain" aria-label="ID du Parrain" aria-describedby="parrain" data-msg="Veuillez entrer l'ID du Parrain" data-error-class="u-has-error" data-success-class="u-has-success" disabled="disabled">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="js-form-message">
                                                <label id="pays" class="form-label">
                                                    Pays
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="form-group">
                                                    <input type="text" required="required" class="has-validation form-control" name="pays" value="<?php echo $mbrePays; ?>" placeholder="Entrez le pays" aria-label="Entrez le pays" aria-describedby="pays" data-msg="Veuillez entrer le pays" data-error-class="u-has-error" data-success-class="u-has-success" <?php echo ($mbreCodeVerif == 1) ? 'readonly="readonly"' : ''; ?>>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="py-2">
                                        <label for="photo_de_profil">
                                            Photo de profil
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="form-group">
                                            <input type="file" required="required" class="has-validation form-control" name="photo_de_profil" placeholder="Choisir votre photo de profil" aria-label="Uploader une photo" aria-describedby="photo" data-msg="veuillez uploader une photo" data-error-class="u-has-error" data-success-class="u-has-sucess">
                                        </div>

                                    </div>


                                    <div class="row mt-1 b-2">
                                        <div class="col-sm-12">
                                            <div class="js-form-message">
                                                <select name="news" class="form-control">
                                                    <option value="0" <?php if ($mbreNewsletter == 0) echo "selected"; ?>>Je ne m'inscris pas à la newsletter</option>
                                                    <option value="1" <?php if ($mbreNewsletter == 1) echo "selected"; ?>>Je m'inscris à la newsletter</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3 mb-4">
                                        <div class="col-sm-8 offset-4 text-right">
                                            <?php
                                            if($mbreCodeVerif == 1)
                                            {
                                                ?>
                                                <div class="alert alert-danger rounded-pill text-center">Demander à Administrateur pour  faire des modifications</div>
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                <button type="submit" class="btn btn-primary" name="envoyer">Appliquer les modifications</button>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="p-4">
                                <h5 class="mb-0">Mes informations de paiement</h5>
                            </div>
                            <hr class="m-0">

                            <form action="" method="POST" class="js-validate" multiple="" enctype="multipart/form-data">
                                <input type="hidden" name="submit_update_bank" value="1">
                                <div class="p-4">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="js-form-message">
                                                <label id="paypal" class="form-label">
                                                    Paypal
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="form-group">
                                                    <input type="text" class="has-validation form-control" name="paypal" value="<?php echo $mbrePaypal; ?>" placeholder="Entrez votre adresse Paypal" aria-label="Entrez votre adresse Paypal" aria-describedby="paypal" data-msg="Veuillez entrer votre adresse Paypal" data-error-class="u-has-error" data-success-class="u-has-success">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="js-form-message">
                                                <label id="skrill" class="form-label">
                                                    Skrill
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="form-group">
                                                    <input type="text" class="has-validation form-control" name="skrill" value="<?php echo $mbreSkrill; ?>" placeholder="Entrez votre adresse Skrill" aria-label="Entrez votre adresse Skrill" aria-describedby="skrill" data-msg="Veuillez entrer votre adresse Skrill" data-error-class="u-has-error" data-success-class="u-has-success">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="js-form-message">
                                                <label id="iban" class="form-label">
                                                    IBAN
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="form-group">
                                                    <input type="text" class="has-validation form-control" name="iban" value="<?php echo $mbreIban; ?>" placeholder="Entrez votre IBAN" aria-label="IBAN" aria-describedby="iban" data-msg="IBAN" data-error-class="u-has-error" data-success-class="u-has-success">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="js-form-message">
                                                <label id="swift" class="form-label">
                                                    SWIFT
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="form-group">
                                                    <input type="text" class="has-validation form-control" name="swift" value="<?php echo $mbreSwift; ?>" placeholder="Entrez votre code Swift/BIC" aria-label="Entrez votre code Swift/BIC" aria-describedby="swift" data-msg="Veuillez entrer votre code Swift/BIC" data-error-class="u-has-error" data-success-class="u-has-success">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3 mb-4">
                                        <div class="col-sm-12 text-right">
                                            <button type="submit" class="btn btn-primary">Appliquer les modifications</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <?php
                            if ($mbreNom != '' && $mbrePrenom != '' && $mbreAdresse != '' && $mbreVille != '' && $mbreCodePostal != '')
                            {
                                if ($mbreCodeVerif != 0 && $mbreCodeVerif != 1)
                                {
                                    ?>
                                    <div class="p-4">
                                        <h5 class="mb-0">Vérification du profil |  En attente</h5>
                                    </div>
                                    <hr class="m-0">
                                    <form action="" method="POST" class="js-validate" multiple="" enctype="multipart/form-data">
                                        <input type="hidden" name="valid_profil" value="1">
                                        <div class="p-4">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="js-form-message">
                                                        <label id="code_verif" class="form-label">
                                                            Entrez votre code ci-dessous :
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="form-group">
                                                            <input type="text" class="has-validation form-control" name="code_verif" value="" placeholder="Entrez votre code reçu ici" aria-label="Entrez votre code reçu ici" aria-describedby="code_verif" data-msg="Veuillez entrer votre code reçu ici" data-error-class="u-has-error" data-success-class="u-has-success">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3 mb-4">
                                                <div class="col-sm-12 text-right">
                                                    <button type="submit" class="btn btn-primary">Valider mon profil</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <?php
                                }
                                elseif ($mbreCodeVerif == 1)
                                {
                                    ?>
                                    <div class="p-4 text-center">
                                        <div class="alert alert-success rounded-pill">Vérification du profil | Validé</div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>

                            <div class="p-4">
                                <h5 class="mb-0">Vérification d'identité à faire</h5>
                            </div>
                            <hr class="m-0">
                            <?php
                            if ($mbreIdentRecto == '' && $mbreIdentVerso == '' && $mbreIdentVerif == 0)
                            {
                                ?>
                                <form action="" method="POST" class="js-validate" multiple="" enctype="multipart/form-data">
                                    <input type="hidden" name="valid_ident" value="1">
                                    <div class="p-4">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="js-form-message">
                                                    <label id="labelFileToUpload" class="form-label">
                                                        Copie Recto de votre Carte d'identité :
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="custom-file">
                                                        <input type="file" id="fileToUpload" name="fileToUpload"  class="custom-file-input" aria-describedby="Copie Recto de votre Carte d'identité">
                                                        <label class="custom-file-label" for="fileToUpload">Copie Recto de votre Carte d'identité</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="js-form-message">
                                                    <label id="labelFileToUpload" class="form-label">
                                                        Copie Verso de votre Carte d'identité :
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="custom-file">
                                                        <input type="file" id="fileToUpload2" name="fileToUpload2"  class="custom-file-input" aria-describedby="Copie Verso de votre Carte d'identité">
                                                        <label class="custom-file-label" for="fileToUpload2">Copie Verso de votre Carte d'identité</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-3 mb-4">
                                            <div class="col-sm-12 text-right">
                                                <button type="submit" name="envoyer" class="btn btn-primary">Envoyer mes documents</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <?php
                            }
                            elseif ($mbreIdentRecto != '' && $mbreIdentVerso != '' && $mbreIdentVerif == 0)
                            {
                                ?>
                                <div class="p-4 text-center">
                                    <div class="alert alert-warning rounded-pill">Vérification d'identité | En attente</div>
                                </div>
                                <?php
                            }
                            else
                            {
                            ?>
                            <div class="p-4 text-center">
                                <div class="alert alert-success rounded-pill">Vérification d'identité | Validé</label>
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>