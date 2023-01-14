<?php
if (!empty($_GET["page"]) && $_GET["page"] == "register")
{
    if (!empty($_GET["confirm"]) && !empty($_GET["userEmail"]) && !empty($_GET["token"]))
    {
        $validationCompte = false;
        include($_ROOT . '/requiert/php-form/login-register.php');

        if ($validationCompte)
        {
            $_POST["submit_login"] = 1;
            $_POST["email"] = $_GET["userEmail"];
            $_POST["token"] = $mdpUser;

            unset($_GET["confirm"]);
            unset($_GET["userEmail"]);
            unset($_GET["token"]);

            include($_ROOT . '/requiert/php-form/login-register.php');
        }
    }
    else
    {
        redirect($base_url);
    }
    exit;
}
?>
<section class="login-main-wrapper">
    <div class="container-fluid pl-0 pr-0">
        <div class="row no-gutters">
            <div class="col-md-12 p-5 bg-white full-height vertical-center">
                <div class="login-main-left">
                    <a class="login-back" href="<?php echo $base_url; ?>"><span class="mdi mdi-chevron-left"></span></a>
                    <div class="text-center mr-0 mb-5 login-main-left-header pt-2">
                        <img src="assets/v2/images/logo.svg" class="img-fluid w-40" alt="LOGO">
                        <h5 class="mt-3 mb-3">Inscrivez-vous gratuitement</h5>
                        <p></p>
                    </div>
                    <form action="" id="send_register">
                        <div class="form-group floating-label-form-group">
                            <label>Nom et prénom</label>
                            <input type="text" class="form-control" name="name" required placeholder="Votre Nom et prénom">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group floating-label-form-group">
                            <label>Nom d'utilisateur</label>
                            <input type="text" class="form-control" name="username" required placeholder="Votre Nom d'utilisateur">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group floating-label-form-group">
                            <label>E-mail</label>
                            <input type="email" name="email" class="form-control" required placeholder="Votre E-mail">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group floating-label-form-group">
                            <label>Mot de passe</label>
                            <input type="password" name="password" class="form-control" required placeholder="Mot de passe (minimum 8 caractères)">
                            <div class="invalid-feedback"></div>
                        </div>

                        <button type="submit" id="send_register" class="btn btn-primary btn-block btn-lg mt-4">Créer un compte</button>
                        <div class="errorform invalid-feedback"></div>

                    </form>
                    <div class="text-center mt-5">
                        <p class="light-gray">Déjà inscrit ? <a href="/login.html">Je me connecte</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>