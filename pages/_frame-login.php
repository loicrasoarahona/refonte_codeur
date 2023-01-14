<section class="login-main-wrapper">
    <div class="container-fluid pl-0 pr-0">
        <div class="row no-gutters">
            <div class="col-md-12 p-5 bg-white full-height vertical-center">
                <div class="login-main-left">
                    <a class="login-back" href="<?php echo $base_url; ?>"><span class="mdi mdi-chevron-left"></span></a>
                    <div class="text-center mr-0 mb-5 login-main-left-header pt-2">
                        <img src="assets/v2/images/logo.svg" class="img-fluid w-40" alt="LOGO">
                        <h5 class="mt-3 mb-3">Bienvenue</h5>
                        <p>Connectez-vous pour commencer avec nous</p>
                    </div>
                    <form action="" id="form-login-user">
                        <input type="hidden" name="csrf_token" value="<?php echo csrf_token('form-login-user'); ?>">
                        <div class="form-group floating-label-form-group">
                            <label>Entez Nom d'utilisateur</label>
                            <input type="text" class="form-control" name="username" placeholder="Entez Nom d'utilisateur">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group floating-label-form-group">
                            <label>Mot de passe</label>
                            <input type="password" name="password" class="form-control" placeholder="Mot de passe">
                            <div class="invalid-feedback"></div>
                        </div>
                        <button type="submit" id="send_login" class="btn btn-primary btn-block btn-lg mt-4">Connexion</button>
                        <div class="errorform invalid-feedback"></div>
                    </form>
                    <div class="text-center mt-5">
                        <p class="light-gray">Vous êtes nouveau ici? <a href="/register.html">S'inscrire</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>

</script>