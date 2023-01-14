<?php
if (!empty($_GET["page"]) && $_GET["page"] == "reset-user" && !empty($_GET["token"]))
{
    ?>
    <section class="login-main-wrapper">
        <div class="container-fluid pl-0 pr-0">
            <div class="row no-gutters">
                <div class="col-md-12 p-5 bg-white full-height vertical-center">
                    <div class="login-main-left">
                        <a class="login-back" href="<?php echo $base_url; ?>"><span class="mdi mdi-chevron-left"></span></a>
                        <div class="text-center mr-0 mb-5 login-main-left-header pt-2">
                            <img src="assets/v2/images/logo.svg" class="img-fluid w-40" alt="LOGO">
                            <h5 class="mt-3 mb-3">Réintialiser votre mot de passe</h5>
                        </div>
                        <form action="" id="reset-user-form">

                                <div class="form-group floating-label-form-group">
                                    <label>Entrez le nouveau mot de passe</label>
                                    <input type="password" name="mdp1" class="form-control" required placeholder="Mot de passe (minimum 8 caractères)">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="form-group floating-label-form-group">
                                    <label>Confirmez le nouveau mot de passe</label>
                                    <input type="password" name="mdp2" class="form-control" required placeholder="Mot de passe (minimum 8 caractères)">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <input type="hidden" name="submit_reset_pass" value="1">

                                <div id="send_complete" data-token="<?php echo $_GET["token"]; ?>" class="btn btn-primary btn-block btn-lg mt-4">Changez votre mot de passe</div>
                                <div class="errorform invalid-feedback"></div>

                            </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
}
else
{
    redirect($base_url);
}
?>