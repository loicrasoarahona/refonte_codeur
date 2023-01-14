<!-- Bootstrap core JavaScript -->
<script src="<?php echo $Innerurllink; ?>assets/v2/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo $Innerurllink; ?>assets/v2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- select2 Js -->
<script src="<?php echo $Innerurllink; ?>assets/v2/vendor/select2/js/select2.min.js"></script>
<!-- Owl Carousel -->
<script src="<?php echo $Innerurllink; ?>assets/v2/vendor/owl-carousel/owl.carousel.js"></script>
<!-- Custom -->
<script src="<?php echo $Innerurllink; ?>assets/v2/js/custom.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<?php if (!isset($_SESSION["id"])) { ?>
    <script type="text/javascript">
        function activeCookie() {
            $('#cookie_acceuil').fadeOut();
            document.cookie = '_cashbackREduction=1';
        }

        function alertError(msgError, type) {
            if (type == undefined || type == '') {
                type = 'error';
            }

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: type,
                title: msgError
            });

            return false;
        }

        $(document).ready(function() {

            $('[data-super-toggle="modal"]').click(function(e) {
                var id = $(e.target).attr('data-target')
                $('.modal').filter(item => item.id !== id).modal('hide');
                $(id).modal('show');
            })

            $('#send-login-form').on('click', '#send_login', function(e) {
                e.preventDefault();
                e.stopPropagation();

                loginuser = $("#send-login-form input[name='username']");
                loginpass = $("#send-login-form input[name='password']");
                $('#loginModal .errorform').html('');
                loginuser.parent().find('.invalid-feedback').html('');
                loginpass.parent().find('.invalid-feedback').html('');

                let msgError = '';

                textLengthuser = loginuser.val().length;
                if (textLengthuser < 7) {
                    loginuser.addClass('is-invalid');
                    msgError = 'L\'adresse email n\'est pas valide.';
                } else {
                    loginuser.removeClass('is-invalid');
                }

                textLengthpass = loginpass.val().length;
                if (textLengthpass < 8) {
                    loginpass.addClass('is-invalid');
                    if (msgError != '') {
                        msgError = 'Les informations saisies sont invalides.';
                    } else {
                        msgError = 'Le mot de passe est trop court.';
                    }
                } else {
                    loginpass.removeClass('is-invalid');
                }

                if (msgError == '') {
                    //alert("sending...");
                    $.ajax({
                        type: "POST",
                        url: '<?php echo $base_url; ?>ajax/login.php',
                        data: {
                            email: loginuser.val(),
                            mdp: loginpass.val(),
                            submit_login: 'Se connecter'
                        },
                        success: function(data) {
                            if (data.indexOf('<?php echo $base_url; ?>') > -1) {
                                window.location.replace(data + "?utm-conn=1");
                            } else {
                                alertError(data);
                            }
                        }
                    });

                } else {
                    alertError(msgError);
                }

                return false;
            });

            $('#send-register-form').on('click', '#send_register', function(e) {
                e.preventDefault();
                e.stopPropagation();

                let msgError = '';

                nomUser = $("#send-register-form input[name='nom']");
                prenomUser = $("#send-register-form input[name='prenom']");
                emailUser = $("#send-register-form input[name='email']");
                passUser = $("#send-register-form input[name='password']");
                newsLetter = $("#send-register-form select[name='news']");

                $('#send-register-form .errorform').html('');
                nomUser.parent().find('.invalid-feedback').html('');
                prenomUser.parent().find('.invalid-feedback').html('');
                emailUser.parent().find('.invalid-feedback').html('');
                passUser.parent().find('.invalid-feedback').html('');


                if (nomUser.val().length < 4) {
                    nomUser.addClass('is-invalid');
                    if (msgError != '') {
                        msgError = 'Les informations saisies sont invalides.';
                    } else {
                        msgError = 'Le nom n\'est pas valide.';
                    }
                } else {
                    nomUser.removeClass('is-invalid');
                }

                if (prenomUser.val().length < 4) {
                    prenomUser.addClass('is-invalid');
                    if (msgError != '') {
                        msgError = 'Les informations saisies sont invalides.';
                    } else {
                        msgError = 'Le prenom n\'est pas valide.';
                    }
                } else {
                    prenomUser.removeClass('is-invalid');
                }

                if (passUser.val().length < 8) {
                    passUser.addClass('is-invalid');
                    if (msgError != '') {
                        msgError = 'Les informations saisies sont invalides.';
                    } else {
                        msgError = 'Le mot de passe n\'est pas valide.';
                    }
                } else {
                    passUser.removeClass('is-invalid');
                }

                if (emailUser.val().length < 8) {
                    emailUser.addClass('is-invalid');
                    if (msgError != '') {
                        msgError = 'Les informations saisies sont invalides.';
                    } else {
                        msgError = 'L\'adresse email n\'est pas valide.';
                    }
                } else {
                    emailUser.removeClass('is-invalid');
                }



                if (msgError == '') {
                    //alert("sending...");
                    $.ajax({
                        type: "POST",
                        url: '<?php echo $base_url; ?>ajax/register.php',
                        data: $('#send-register-form').serialize(),
                        success: function(data) {

                            if (data.indexOf('<?php echo $base_url; ?>') > -1) {
                                window.location.replace(data + '?utm-reg=1');
                            } else if (data.indexOf('Bravo') > -1) {
                                $('#send-register-form').parents('.modal').modal('hide');
                                alertError(data, 'success');
                            } else {
                                alertError(data);
                            }

                        }
                    });

                } else {
                    alertError(msgError);
                }

                return false;
            });

            $('#send-reset-form').on('click', '#send_reset', function(e) {
                e.preventDefault();
                e.stopPropagation();

                let msgError = '';

                resetuser = $("#send-reset-form input[name='email']");
                $('#send-reset-form .errorform').html('');
                resetuser.parent().find('.invalid-feedback').html('');

                textLengthuser = resetuser.val().length;
                if (textLengthuser < 7) {
                    resetuser.addClass('is-invalid');
                    msgError = 'L\'adresse email n\'est pas valide.';
                } else {
                    resetuser.removeClass('is-invalid');
                }


                if (msgError == '') {
                    //alert("sending...");
                    $.ajax({
                        type: "POST",
                        url: '<?php echo $base_url; ?>ajax/reset.php',
                        data: {
                            email: resetuser.val(),
                            submit_reset_mdp: 1
                        },
                        success: function(data) {
                            if (data.indexOf('Un e-mail de') > -1) {
                                $('#send-reset-form').html(data);
                                $('#send-reset-form').next('.text-center').remove();
                            } else {
                                alertError(data);
                            }
                        }
                    });

                } else {
                    alertError(data);
                }

                return false;
            });

            $('#reset-user-form').on('click', '#send_complete', function(e) {
                e.preventDefault();
                e.stopPropagation();

                let token = $(this).data('token');
                let msgError = '';
                completepassword = $("#reset-user-form input[name='mdp1']");
                completerepassword = $("#reset-user-form input[name='mdp2']");

                completepassword.removeClass('is-invalid');
                completerepassword.removeClass('is-invalid');

                if (completepassword.val().length < 7) {
                    completepassword.addClass('is-invalid');
                    msgError = 'Le mot de passe est trop court.';
                    // completepassword.parent().find('.invalid-feedback').html("<i class='icon-warning-sign'></i> Nouveau mot de passe invalide");
                }

                if (completerepassword.val().length < 7) {
                    completerepassword.addClass('is-invalid');
                    msgError = 'Le mot de passe est trop court.';
                }

                if (msgError == '' && completepassword.val() != completerepassword.val()) {
                    completerepassword.addClass('is-invalid');
                    completepassword.addClass('is-invalid');
                    msgError = 'Les mots de passe ne sont pas identiques.'
                }

                if (msgError == '') {
                    //alert("sending...");
                    $.ajax({
                        type: "POST",
                        url: '<?php echo $base_url; ?>ajax/reset.php?token=' + token,
                        data: $('#reset-user-form').serialize(),
                        success: function(data) {
                            if (data.indexOf('<?php echo $base_url ?>') > -1) {
                                alertError('Votre mot de passe a été modifié. Connecter-vous.', 'success');
                                setTimeout(function() {
                                    window.location.href = data;
                                }, 3000);
                            } else {
                                alertError(data);
                            }
                        }
                    });

                } else {
                    alertError(msgError);
                }

                return false;
            });

            <?php
            if (!empty($_GET['c'])) {
                $c = stripslashes($_GET['c']);
                $c = mysqli_real_escape_string($conn, $c);
                $sql = "UPDATE `users` SET confirmed_email ='1'  WHERE hash_confirme='$c' limit 1";
                if (mysqli_query($conn, $sql)) { ?>
                    Swal.fire({
                        title: 'Votre email est confirmé !',
                        text: 'Merci, votre email a bien été vérifié',
                        icon: 'success',
                        confirmButtonText: 'Fermer'
                    });
                <?php } ?>
            <?php } ?>
        });
    </script>
<?php } ?>

<?php if (isset($_SESSION["id"])) { ?>
    <script type="text/javascript">
        function activeCookie() {
            $('#cookie_acceuil').fadeOut();
            document.cookie = '_cashbackREduction=1';
        }

        function move(id_elem, callback) {
            var i = 100;
            if (i == 100) {
                i = 99;
                var elem = document.getElementById(id_elem);
                var width = 100;
                var id = setInterval(frame, 50);

                function frame() {
                    if (width == 0) {
                        clearInterval(id);
                        i = 100;
                        callback();
                    } else {
                        width--;
                        elem.style.width = width + "%";
                    }
                }
            }
        }

        function alertError(msgError, type) {
            if (type == undefined || type == '') {
                type = 'error';
            }

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: type,
                title: msgError
            });

            return false;
        }

        <?php

        if (!empty($_GET["utm-conn"])) {
        ?>
            alertError('Vous êtes connecté.', 'success');
            window.history.pushState('', '', '');
        <?php
        }

        if (!empty($_GET["utm-reg"])) {
        ?>
            alertError('Bienvenue. Vous êtes inscrit.', 'success');
            window.history.pushState('', '', '');
        <?php
        }

        if (!empty($reponsConfirm)) {
        ?>
            alertError('<?php echo strip_tags($reponsConfirm); ?>', 'success');
        <?php
        } elseif (!empty($reponsError)) {
        ?>
            alertError('<?php echo strip_tags($reponsError); ?>', 'error');
        <?php
        }
        ?>

        $(document).ready(function() {

            setInterval(function() {
                $.ajax({
                    type: 'GET',
                    url: '<?php echo $base_url; ?>/ajax/majNotification.php',
                    success: function(data) {
                        if (data != '') {
                            $('.message-notif').html(data);
                        } else {
                            $('.message-notif .nb-notif').removeClass('badge badge-pill badge-danger');
                            $('.message-notif .nb-notif').text('');
                            $('.message-notif .dropdown-menu').remove();
                        }
                    }
                })
            }, 10000);

            $.ajax({
                type: 'POST',
                url: '/ajax/checking-chat.php?a=refreshco',
                data: 'room=' + $('#room-user').val(),
                success: function(data) {
                    $('.user-connected').html(data);
                }
            });

            $.ajax({
                type: 'POST',
                url: '/ajax/checking-chat.php?a=refreshchat',
                data: 'room=' + $('#room-user').val(),
                success: function(data) {
                    $('.chat-area-main').html(data);
                }
            });

            setInterval(function() {
                $.ajax({
                    type: 'POST',
                    url: '/ajax/checking-chat.php?a=refreshco',
                    data: 'room=' + $('#room-user').val(),
                    success: function(data) {
                        $('.user-connected').html(data);
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '/ajax/checking-chat.php?a=refreshchat',
                    data: 'room=' + $('#room-user').val(),
                    success: function(data) {
                        $('.chat-box-body .chat-area-main').html(data);
                    }
                });
            }, 5000);

            $('body').on('change', '#fileToUpload, #fileToUpload2', function() {
                $('label[for="' + $(this).attr('id') + '"]').text($(this).val().split(/(\\|\/)/g).pop());
            });

            $('body').on('click', '#form-chat #chat-submit', function() {
                $.ajax({
                    type: 'POST',
                    url: '/ajax/checking-chat.php?a=refreshchat',
                    data: $('#form-chat').serialize(),
                    success: function(data) {
                        $('#form-chat #chat-input').val('');
                        $('.chat-area-main').html(data);
                    }
                });
            });

            $('body').on('click', '.dropdown-item.notif-alarm', function() {
                let id_not = $(this).data('id');
                $(this).fadeOut('slow', function() {
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo $base_url; ?>/ajax/majNotification.php',
                        data: 'type_maj=1&id_notif=' + id_not,
                        success: function(data) {
                            if (parseInt(data) > 0) {
                                $('.nb-notif-ex').text(data);
                            } else {
                                $('.nb-notif-ex').removeClass('badge badge-pill badge-danger');
                                $('.nb-notif-ex').text('');
                                $('.nb-notif-ex').remove();
                            }
                        }
                    });
                });
            });

            $('body').on('click', '.btn-group-dropdown .dropdown-item', function() {
                let roomName = $(this).text();
                $('#room-user').val($(this).data('room'));
                $(this).parents('.btn-group').children('.room-dropdown-btn').text(roomName);

                $.ajax({
                    type: 'POST',
                    url: '/ajax/checking-chat.php?a=refreshco',
                    data: 'room=' + $(this).data('room'),
                    success: function(data) {
                        $('.user-connected').html(data);
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '/ajax/checking-chat.php?a=refreshchat',
                    data: 'room=' + $(this).data('room'),
                    success: function(data) {
                        $('.chat-area-main').html(data);
                    }
                });
            });

            $('body').on('click', '.ln-msg', function() {
                $('#msgbox-modal').modal('show');
                $('#msgbox-modal #show-message-box').html('<div class="m-3">Chargement message ...</div>');

                if ($(this).hasClass('new-msg')) {
                    $.ajax({
                        type: "POST",
                        url: '<?php echo $base_url; ?>ajax/send-msg.php',
                        data: 'new-msg=1',
                        success: function(data) {
                            $('#msgbox-modal #show-message-box').html(data);
                        }
                    });
                } else {
                    $.ajax({
                        type: "POST",
                        url: '<?php echo $base_url; ?>ajax/send-msg.php',
                        data: 'show-msg=1&idmessage=' + $(this).data('id'),
                        success: function(data) {
                            $('#msgbox-modal #show-message-box').html(data);
                        }
                    });
                }
            });

            $('body').on('click', '.modal-content#show-message-box #send-new-msg', function(e) {
                e.preventDefault();
                e.stopPropagation();

                idMembre = $('.modal-content#show-message-box select[name="user-dest"]');
                sujet = $('.modal-content#show-message-box input[name="sujet"]');
                message = $('.modal-content#show-message-box textarea[name="message"]');

                idMembre.removeClass('is-invalid');
                sujet.removeClass('is-invalid');
                message.removeClass('is-invalid');

                let msgError = '';

                if (idMembre.val() == '' || idMembre.val() == undefined) {
                    idMembre.addClass('is-invalid');
                    msgError = 'Veuillez choisir un destinataire.';
                } else {
                    idMembre.removeClass('is-invalid');
                }

                if (sujet.val().length < 2) {
                    sujet.addClass('is-invalid');
                    if (msgError == '') {
                        msgError = 'Veuillez remplir le sujet.';
                    } else {
                        msgError = 'Veuillez remplir tous les champs.';
                    }
                } else {
                    sujet.removeClass('is-invalid');
                }

                if (message.val().length < 2) {
                    message.addClass('is-invalid');
                    if (msgError == '') {
                        msgError = 'Veuillez renseigner le message.';
                    } else {
                        msgError = 'Veuillez remplir tous les champs.';
                    }
                } else {
                    message.removeClass('is-invalid');
                }

                if (msgError == '') {
                    //alert("sending...");
                    $.ajax({
                        type: "POST",
                        url: '<?php echo $base_url; ?>ajax/send-msg.php',
                        data: {
                            submit_message: 1,
                            idmembre: idMembre.val(),
                            sujet: sujet.val(),
                            message: message.val()
                        },
                        success: function(data_1) {
                            $('#msgbox-modal #show-message-box').html('<div class="m-3">Chargement message ...</div>');

                            $.ajax({
                                type: "POST",
                                url: '<?php echo $base_url; ?>ajax/send-msg.php',
                                data: 'show-msg=1&idmessage=' + data_1,
                                success: function(data) {
                                    $('#msgbox-modal #show-message-box').html(data);
                                }
                            });
                        }
                    });

                } else {
                    alertError(msgError);
                }

                return false;
            });

            $('body').on('click', '.mission-modal .offer-participate', function(e) {
                console.log($(this).data('url'));
                let = thisDiv = $(this);
                thisDiv.addClass('disabled').removeClass('offer-participate');
                thisDiv.html('Participer <i class="icofont-spinner-alt-2"></i>');

                $.ajax({
                    type: "GET",
                    url: $(this).data('url'),
                    success: function(data) {
                        thisDiv.removeClass('disabled').addClass('offer-participate');
                        thisDiv.html('Participer</i>');

                        if (data.indexOf('##_##') > -1) {
                            window.open(data.substr(5), '_blank');
                        } else {
                            alertError(data);
                        }
                    }
                })
            });

            $('.filtrable-table').on('click', '.nav-link', function() {
                $('.filtrable-table .nav-link').removeClass('active');
                $(this).addClass('active');
                if ($(this).data('target') != "all") {
                    $('table.list-filtrable-table .ln-filtrable').filter(':not(.' + $(this).data('target') + ')').hide();
                    $('table.list-filtrable-table .ln-filtrable').filter('.' + $(this).data('target')).show();
                } else {
                    $('table.list-filtrable-table .ln-filtrable').show();
                }
            });

            $('.mission-modal').on('shown.bs.modal', function(e) {
                let toUrl = $(this).data('url');
                setTimeout(function() {
                    // window.location.href = toUrl;
                }, 5000);
            });

            <?php if (isset($_SESSION["userprofile"]['type']) and $_SESSION["userprofile"]['type'] == "ADMIN") { ?>

                $('#admin-section,#user-section').on('click', '.user-view', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var $this = $(this);
                    html_data = $this.data('html');
                    header_data = $this.data('header');
                    $('#users .modal-body').html(html_data);
                    $('#users .modal-title').html(header_data);
                    $('#users').modal('show');
                    return false;
                });


                $('#admin-section').on('click', '.user-status', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var $this = $(this);
                    var caction = $this.parent();
                    action = $this.data('action');
                    user = $this.data('id-user');

                    $.ajax({
                        type: "POST",
                        url: '<?php echo $base_url; ?>ajax/user-status.php',
                        data: {
                            action: action,
                            user: user
                        },
                        success: function(data) {
                            if (data == "Correct") {
                                if (action == "Valider" || action == "Valider-2") {
                                    caction.find('[data-action="Valider"]').addClass("hide");
                                    caction.find('[data-action="Banner"]').removeClass("hide");
                                    caction.find('[data-action="Supprimer"]').addClass("hide");
                                    caction.find('[data-action="Valider-2"]').addClass("hide");
                                    caction.find('[data-action="Supprimer-2"]').removeClass("hide");
                                    $msg = "L'utilisateur a été activé avec succés.";
                                }
                                if (action == "Banner") {
                                    caction.find('[data-action="Valider"]').addClass("hide");
                                    caction.find('[data-action="Banner"]').addClass("hide");
                                    caction.find('[data-action="Supprimer"]').removeClass("hide");
                                    caction.find('[data-action="Valider-2"]').removeClass("hide");
                                    caction.find('[data-action="Supprimer-2"]').addClass("hide");
                                    $msg = "L'utilisateur a été desactivé avec succés.";
                                }
                                if (action == "PREMIUM") {

                                    $msg = "L'accès premium est désormais activé.";
                                }

                                if (action == "ADMIN") {

                                    $msg = "L'accès administrateur est désormais activé.";
                                }
                                if (action == "USER") {

                                    $msg = "L'accès administrateur est désormais desactivé.";
                                }
                                if (action == "Supprimer" || action == "Supprimer-2") {
                                    caction.find('cross_delete').addClass("hide");
                                    caction.parent().remove();
                                    $msg = "L'utilisateur a été supprimée avec succés.";
                                }
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'bottom-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    }
                                })

                                Toast.fire({
                                    icon: 'success',
                                    title: $msg
                                })

                                var target = $('[data="membre-filtre"].nav-link.active').data('target');
                                $.ajax({
                                    type: "POST",
                                    url: '<?php echo $base_url; ?>ajax/user-list.php',
                                    data: {
                                        target: target
                                    },
                                    success: function(data) {

                                        $('#admin-section table').html(data);

                                        const Toast = Swal.mixin({
                                            toast: true,
                                            position: 'bottom-end',
                                            showConfirmButton: false,
                                            timer: 3000,
                                            timerProgressBar: true,
                                            didOpen: (toast) => {
                                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                                            }
                                        })

                                        Toast.fire({
                                            icon: 'success',
                                            title: "Mise à jour effectuée"
                                        })

                                        //caction.html(data);
                                    }
                                });

                            } else {
                                Swal.fire({
                                    title: 'Erreur!',
                                    text: 'Veuillez réessayer',
                                    icon: 'error',
                                    confirmButtonText: 'Annuler'
                                })
                            }
                            //caction.html(data);
                        }
                    });

                    return false;
                });

                $('#admin-section').on('click', '.membre-filtre li a[data="membre-filtre"]', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var $this = $(this);
                    $('.membre-filtre .nav-link').removeClass('active');
                    $this.addClass('active');

                    target = $this.data('target');

                    $.ajax({
                        type: "POST",
                        url: '<?php echo $base_url; ?>ajax/user-list.php',
                        data: {
                            target: target
                        },
                        success: function(data) {

                            $('#admin-section table').html(data);

                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'bottom-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'success',
                                title: "Mise à jour effectuée"
                            })

                            //caction.html(data);
                        }
                    });

                    return false;
                });

                $('#admin-section').on('click', '.add-user', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    $('#add-user-form').modal('show');
                    $('#add-user-form').on('shown.bs.modal', function() {
                        $('input[name="name"]').trigger('focus');
                    })

                    return false;
                });

                $('#add-user-form .submit-add').on('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    nameuser = $("#add-user-form input[name='name']");
                    loginuser = $("#add-user-form input[name='username']");
                    emailuser = $("#add-user-form input[name='email']");

                    $('#add-user-form .errorform').html('');
                    nameuser.parent().find('.invalid-feedback').html('');
                    loginuser.parent().find('.invalid-feedback').html('');
                    emailuser.parent().find('.invalid-feedback').html('');



                    if (nameuser.val().length < 4) {
                        nameuser.addClass('is-invalid');
                        nameuser.parent().find('.invalid-feedback').html("<i class='icon-warning-sign'></i> Veuillez saisir votre nom et prénom.");
                        rep_nameuser = false;
                    } else {
                        nameuser.removeClass('is-invalid');
                        rep_nameuser = true;
                    }

                    if (loginuser.val().length < 7) {
                        loginuser.addClass('is-invalid');
                        loginuser.parent().find('.invalid-feedback').html("<i class='icon-warning-sign'></i> Veuillez saisir un nom d'utilisateur valide.");
                        rep_loginuser = false;
                    } else {
                        loginuser.removeClass('is-invalid');
                        rep_loginuser = true;
                    }


                    if (emailuser.val().length < 8) {
                        emailuser.addClass('is-invalid');
                        emailuser.parent().find('.invalid-feedback').html("<i class='icon-warning-sign'></i> Veuillez saisir votre E-mail.");
                        rep_emailuser = false;
                    } else {
                        emailuser.removeClass('is-invalid');
                        rep_emailuser = true;
                    }



                    if (rep_nameuser && rep_loginuser && rep_emailuser) {
                        //alert("sending...");
                        $.ajax({
                            type: "POST",
                            url: '<?php echo $base_url; ?>ajax/register.php',
                            data: {
                                name_account: nameuser.val(),
                                login: loginuser.val(),
                                email: emailuser.val()
                            },
                            success: function(data) {

                                if (data === 'Correct') {

                                    $.ajax({
                                        type: "POST",
                                        url: '<?php echo $base_url; ?>ajax/user-list.php',
                                        data: {
                                            target: 1
                                        },
                                        success: function(data) {

                                            $('#admin-section table').html(data);

                                            const Toast = Swal.mixin({
                                                toast: true,
                                                position: 'bottom-end',
                                                showConfirmButton: false,
                                                timer: 3000,
                                                timerProgressBar: true,
                                                didOpen: (toast) => {
                                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                                }
                                            })

                                            Toast.fire({
                                                icon: 'success',
                                                title: "Mise à jour effectuée"
                                            })

                                            //caction.html(data);
                                        }
                                    });


                                    $('#add-user-form').modal('hide');



                                } else if (data === 'Cette adresse e-mail existe déjà!') {
                                    Swal.fire({
                                        title: 'Erreur!',
                                        text: data,
                                        icon: 'error',
                                        confirmButtonText: 'Annuler'
                                    })
                                } else if (data === 'Échec de la validation du jeton CSRF') {
                                    Swal.fire({
                                        title: 'Erreur!',
                                        text: 'Veuillez réessayer',
                                        icon: 'error',
                                        confirmButtonText: 'Annuler'
                                    })
                                } else {
                                    Swal.fire({
                                        title: 'Erreur!',
                                        text: data,
                                        icon: 'error',
                                        confirmButtonText: 'Annuler'
                                    })


                                }

                            }
                        });

                    }

                    return false;
                });

                // ---- Tickets ----
                $('#admin-section').on('click', '.ticket-filtre li a[data="ticket-filtre"]', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var $this = $(this);
                    $('.ticket-filtre .nav-link').removeClass('active');
                    $this.addClass('active');

                    target = $this.data('target');

                    $.ajax({
                        type: "POST",
                        url: '<?php echo $base_url; ?>ajax/ticket-list.php',
                        data: {
                            target: target
                        },
                        success: function(data) {

                            $('#admin-section table').html(data);

                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'bottom-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'success',
                                title: "Mise à jour effectuée"
                            })

                            //caction.html(data);
                        }
                    });

                    return false;
                });
                $('#admin-section').on('click', '.ticket-status', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var $this = $(this);
                    var caction = $this.parent();
                    action = $this.data('action');
                    ticket = $this.data('id-ticket');

                    $.ajax({
                        type: "POST",
                        url: '<?php echo $base_url; ?>ajax/ticket-status.php',
                        data: {
                            action: action,
                            ticket: ticket
                        },
                        success: function(data) {
                            if (data == "Correct") {


                                if (action == "Clôturer") {
                                    caction.find('[data-action="Clôturer"]').addClass("hide");
                                    caction.find('[data-action="Supprimer"]').removeClass("hide");
                                    $msg = "Le ticket a été clôturé avec succés.";
                                }
                                if (action == "Supprimer") {
                                    caction.parent().remove();
                                    $msg = "Le ticket a été supprimé avec succés.";
                                }

                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'bottom-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    }
                                })

                                Toast.fire({
                                    icon: 'success',
                                    title: $msg
                                })
                            } else {
                                Swal.fire({
                                    title: 'Erreur!',
                                    text: 'Veuillez réessayer',
                                    icon: 'error',
                                    confirmButtonText: 'Annuler'
                                })
                            }
                            //caction.html(data);
                        }
                    });

                    return false;
                });
                $('#admin-section').on('click', '.add-ticket', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    $('#add-ticket-form').modal('show');
                    $('#add-ticket-form').on('shown.bs.modal', function() {
                        $('input[name="name"]').trigger('focus');
                    })

                    return false;
                });

                $('#add-ticket-form .submit-add').on('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    user = $("#add-ticket-form select[name='user']");
                    sujet = $("#add-ticket-form input[name='sujet']");
                    message = $("#add-ticket-form textarea[name='message']");

                    $('.errorform').html('');
                    user.parent().find('.invalid-feedback').html('');
                    sujet.parent().find('.invalid-feedback').html('');
                    message.parent().find('.invalid-feedback').html('');



                    if (user.val() == "NOPE") {
                        user.addClass('is-invalid');
                        user.parent().find('.invalid-feedback').html("<i class='icon-warning-sign'></i> Veuillez saisir votre nom et prénom.");
                        rep_user = false;
                    } else {
                        user.removeClass('is-invalid');
                        rep_user = true;
                    }

                    if (sujet.val().length < 7) {
                        sujet.addClass('is-invalid');
                        sujet.parent().find('.invalid-feedback').html("<i class='icon-warning-sign'></i> Veuillez saisir un nom d'utilisateur valide.");
                        rep_sujet = false;
                    } else {
                        sujet.removeClass('is-invalid');
                        rep_sujet = true;
                    }


                    if (message.val().length < 8) {
                        message.addClass('is-invalid');
                        message.parent().find('.invalid-feedback').html("<i class='icon-warning-sign'></i> Veuillez saisir votre E-mail.");
                        rep_message = false;
                    } else {
                        message.removeClass('is-invalid');
                        rep_message = true;
                    }



                    if (rep_user && rep_sujet && rep_message) {
                        //alert("sending...");
                        $.ajax({
                            type: "POST",
                            url: '<?php echo $base_url; ?>ajax/ticket-add.php',
                            data: {
                                user: user.val(),
                                sujet: sujet.val(),
                                message: message.val()
                            },
                            success: function(data) {

                                if (data === 'Correct') {

                                    $.ajax({
                                        type: "POST",
                                        url: '<?php echo $base_url; ?>ajax/ticket-list.php',
                                        data: {
                                            target: 1
                                        },
                                        success: function(data) {

                                            $('#admin-section table').html(data);

                                            const Toast = Swal.mixin({
                                                toast: true,
                                                position: 'bottom-end',
                                                showConfirmButton: false,
                                                timer: 3000,
                                                timerProgressBar: true,
                                                didOpen: (toast) => {
                                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                                }
                                            })

                                            Toast.fire({
                                                icon: 'success',
                                                title: "Mise à jour effectuée"
                                            })

                                            //caction.html(data);
                                        }
                                    });


                                    $('#add-ticket-form').modal('hide');


                                } else if (data === 'Échec de la validation du jeton CSRF') {
                                    Swal.fire({
                                        title: 'Erreur!',
                                        text: 'Veuillez réessayer',
                                        icon: 'error',
                                        confirmButtonText: 'Annuler'
                                    })
                                } else {
                                    Swal.fire({
                                        title: 'Erreur!',
                                        text: data,
                                        icon: 'error',
                                        confirmButtonText: 'Annuler'
                                    })


                                }

                            }
                        });

                    }

                    return false;
                });

                // ---- Coupons ----
                $('#admin-section').on('click', '.coupon-filtre li a[data="coupon-filtre"]', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var $this = $(this);
                    $('.coupon-filtre .nav-link').removeClass('active');
                    $this.addClass('active');

                    target = $this.data('target');

                    $.ajax({
                        type: "POST",
                        url: '<?php echo $base_url; ?>ajax/coupon-list.php',
                        data: {
                            target: target
                        },
                        success: function(data) {

                            $('#admin-section table').html(data);

                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'bottom-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'success',
                                title: "Mise à jour effectuée"
                            })

                            //caction.html(data);
                        }
                    });

                    return false;
                });
                $('#admin-section').on('click', '.coupon-status', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var $this = $(this);
                    var caction = $this.parent();
                    action = $this.data('action');
                    coupon = $this.data('id-coupon');

                    $.ajax({
                        type: "POST",
                        url: '<?php echo $base_url; ?>ajax/coupon-status.php',
                        data: {
                            action: action,
                            coupon: coupon
                        },
                        success: function(data) {
                            if (data == "Correct") {


                                if (action == "Clôturer") {
                                    caction.find('[data-action="Clôturer"]').addClass("hide");
                                    caction.find('[data-action="Supprimer"]').removeClass("hide");
                                    $msg = "Le coupon a été masqué avec succés.";
                                }
                                if (action == "Supprimer") {
                                    caction.parent().remove();
                                    $msg = "Le coupon a été supprimé avec succés.";
                                }

                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'bottom-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    }
                                })

                                Toast.fire({
                                    icon: 'success',
                                    title: $msg
                                })
                            } else {
                                Swal.fire({
                                    title: 'Erreur!',
                                    text: 'Veuillez réessayer',
                                    icon: 'error',
                                    confirmButtonText: 'Annuler'
                                })
                            }
                            //caction.html(data);
                        }
                    });

                    return false;
                });

                $("select.grp-add, select.brand-add, select.type-add").select2({
                    tags: true
                });

                // ---- Offres ----
                $('#admin-section').on('click', '.offre-filtre li a[data="offre-filtre"]', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var $this = $(this);
                    $('.offre-filtre .nav-link').removeClass('active');
                    $this.addClass('active');

                    target = $this.data('target');

                    $.ajax({
                        type: "POST",
                        url: '<?php echo $base_url; ?>ajax/offre-list.php',
                        data: {
                            target: target
                        },
                        success: function(data) {

                            $('#admin-section table').html(data);

                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'bottom-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'success',
                                title: "Mise à jour effectuée"
                            })

                            //caction.html(data);
                        }
                    });

                    return false;
                });
                $('#admin-section').on('click', '.offre-status', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var $this = $(this);
                    var caction = $this.parent();
                    action = $this.data('action');
                    offre = $this.data('id-offre');

                    $.ajax({
                        type: "POST",
                        url: '<?php echo $base_url; ?>ajax/offre-status.php',
                        data: {
                            action: action,
                            offre: offre
                        },
                        success: function(data) {
                            if (data == "Correct") {


                                if (action == "Clôturer") {
                                    caction.find('[data-action="Clôturer"]').addClass("hide");
                                    caction.find('[data-action="Supprimer"]').removeClass("hide");
                                    $msg = "Le offre a été masqué avec succés.";
                                }

                                if (action == "Supprimer") {
                                    caction.parent().remove();
                                    $msg = "Le offre a été supprimé avec succés.";
                                }

                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'bottom-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    }
                                })

                                Toast.fire({
                                    icon: 'success',
                                    title: $msg
                                })
                            } else {
                                Swal.fire({
                                    title: 'Erreur!',
                                    text: 'Veuillez réessayer',
                                    icon: 'error',
                                    confirmButtonText: 'Annuler'
                                })
                            }
                            //caction.html(data);
                        }
                    });

                    return false;
                });

                // ---- Stores ----
                $('#admin-section').on('click', '.store-filtre li a[data="store-filtre"]', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var $this = $(this);
                    $('.store-filtre .nav-link').removeClass('active');
                    $this.addClass('active');

                    target = $this.data('target');

                    $.ajax({
                        type: "POST",
                        url: '<?php echo $base_url; ?>ajax/store-list.php',
                        data: {
                            target: target
                        },
                        success: function(data) {

                            $('#admin-section table').html(data);

                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'bottom-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'success',
                                title: "Mise à jour effectuée"
                            })

                            //caction.html(data);
                        }
                    });

                    return false;
                });
                $('#admin-section').on('click', '.store-status', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var $this = $(this);
                    var caction = $this.parent();
                    action = $this.data('action');
                    store = $this.data('id-store');

                    $.ajax({
                        type: "POST",
                        url: '<?php echo $base_url; ?>ajax/store-status.php',
                        data: {
                            action: action,
                            store: store
                        },
                        success: function(data) {
                            if (data == "Correct") {


                                if (action == "Bloquer") {
                                    caction.find('[data-action="Activer"]').removeClass("hide");
                                    caction.find('[data-action="Bloquer"]').addClass("hide");
                                    $msg = "La boutique a été Bloquée avec succés.";
                                }
                                if (action == "Activer") {
                                    caction.find('[data-action="Activer"]').addClass("hide");
                                    caction.find('[data-action="Bloquer"]').removeClass("hide");
                                    $msg = "La boutique a été activée avec succés.";
                                }

                                if (action == "Supprimer") {
                                    caction.parent().remove();
                                    $msg = "La boutique a été supprimée avec succés.";
                                }

                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'bottom-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    }
                                })

                                Toast.fire({
                                    icon: 'success',
                                    title: $msg
                                })
                            } else {
                                Swal.fire({
                                    title: 'Erreur!',
                                    text: 'Veuillez réessayer',
                                    icon: 'error',
                                    confirmButtonText: 'Annuler'
                                })
                            }
                            //caction.html(data);
                        }
                    });

                    return false;
                });

                // ---- Offrewall ----
                $('#admin-section').on('click', '.offrewall-filtre li a[data="offrewall-filtre"]', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var $this = $(this);
                    $('.offrewall-filtre .nav-link').removeClass('active');
                    $this.addClass('active');

                    target = $this.data('target');

                    $.ajax({
                        type: "POST",
                        url: '<?php echo $base_url; ?>ajax/offrewall-list.php',
                        data: {
                            target: target
                        },
                        success: function(data) {

                            $('#admin-section table').html(data);

                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'bottom-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'success',
                                title: "Mise à jour effectuée"
                            })

                            //caction.html(data);
                        }
                    });

                    return false;
                });
                $('#admin-section').on('click', '.offrewall-status', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var $this = $(this);
                    var caction = $this.parent();
                    action = $this.data('action');
                    offrewall = $this.data('id-offrewall');

                    $.ajax({
                        type: "POST",
                        url: '<?php echo $base_url; ?>ajax/offrewall-status.php',
                        data: {
                            action: action,
                            offrewall: offrewall
                        },
                        success: function(data) {
                            if (data == "Correct") {


                                if (action == "Masquer") {
                                    caction.find('[data-action="Afficher"]').removeClass("hide");
                                    caction.find('[data-action="Masquer"]').addClass("hide");
                                    $msg = "Offrewall a été Masqué avec succés.";
                                }
                                if (action == "Afficher") {
                                    caction.find('[data-action="Afficher"]').addClass("hide");
                                    caction.find('[data-action="Bloquer"]').removeClass("hide");
                                    $msg = "Offrewall a été validé avec succés.";
                                }

                                if (action == "Supprimer") {
                                    caction.parent().remove();
                                    $msg = "Offrewall a été supprimée avec succés.";
                                }

                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'bottom-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    }
                                })

                                Toast.fire({
                                    icon: 'success',
                                    title: $msg
                                })
                            } else {
                                Swal.fire({
                                    title: 'Erreur!',
                                    text: 'Veuillez réessayer',
                                    icon: 'error',
                                    confirmButtonText: 'Annuler'
                                })
                            }
                            //caction.html(data);
                        }
                    });

                    return false;
                });

                // ---- Commandes ADMIN----
                $('#admin-section').on('click', '.commande-filtre li a[data="commande-filtre"]', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var $this = $(this);
                    $('.commande-filtre .nav-link').removeClass('active');
                    $this.addClass('active');

                    target = $this.data('target');

                    $.ajax({
                        type: "POST",
                        url: '<?php echo $base_url; ?>ajax/commande-list.php',
                        data: {
                            target: target
                        },
                        success: function(data) {

                            $('#admin-section table').html(data);

                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'bottom-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'success',
                                title: "Mise à jour effectuée"
                            })

                            //caction.html(data);
                        }
                    });

                    return false;
                });
                $('#admin-section').on('click', '.commande-status', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var $this = $(this);
                    var caction = $this.parent();
                    action = $this.data('action');
                    commande = $this.data('id-commande');

                    $.ajax({
                        type: "POST",
                        url: '<?php echo $base_url; ?>ajax/commande-status.php',
                        data: {
                            action: action,
                            commande: commande
                        },
                        success: function(data) {
                            if (data == "Correct") {


                                if (action == "Refuser") {
                                    caction.find('[data-action="Refuser"]').addClass("hide");
                                    caction.find('[data-action="Valider"]').removeClass("hide");
                                    $msg = "La commande a été refusée avec succés.";
                                }
                                if (action == "Valider") {
                                    caction.find('[data-action="Valider"]').addClass("hide");
                                    caction.find('[data-action="Refuser"]').removeClass("hide");
                                    $msg = "La commande a été validée avec succés.";
                                }


                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'bottom-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    }
                                })

                                Toast.fire({
                                    icon: 'success',
                                    title: $msg
                                })
                            } else {
                                Swal.fire({
                                    title: 'Erreur!',
                                    text: 'Veuillez réessayer',
                                    icon: 'error',
                                    confirmButtonText: 'Annuler'
                                })
                            }
                            //caction.html(data);
                        }
                    });

                    return false;
                });
                $('#admin-section').on('click', '.valide-commande', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var $this = $(this);
                    commande = $this.data('id-commande');
                    header_data = $this.data('header');
                    $('#valide-commande .modal-body input[name="commande_id"]').val(commande);
                    $('#valide-commande .modal-title').html(header_data);
                    $('#valide-commande').modal('show');
                    return false;
                });
                $('#valide-commande').on('click', '.update-commande', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var $this = $(this);
                    commande = $('#valide-commande .modal-body input[name="commande_id"]').val();
                    code = $('#valide-commande .modal-body input[name="code"]').val();

                    var caction = $('span[data-id-commande="' + commande + '"]').parent();

                    $.ajax({
                        type: "POST",
                        url: '<?php echo $base_url; ?>ajax/commande-status.php',
                        data: {
                            action: "Valider",
                            commande: commande,
                            code: code
                        },
                        success: function(data) {
                            if (data == "Correct") {

                                $.ajax({
                                    type: "POST",
                                    url: '<?php echo $base_url; ?>ajax/commande-list.php',
                                    data: {
                                        target: 2
                                    },
                                    success: function(data) {

                                        $('#admin-section table').html(data);

                                        const Toast = Swal.mixin({
                                            toast: true,
                                            position: 'bottom-end',
                                            showConfirmButton: false,
                                            timer: 3000,
                                            timerProgressBar: true,
                                            didOpen: (toast) => {
                                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                                            }
                                        })

                                        Toast.fire({
                                            icon: 'success',
                                            title: "Mise à jour effectuée"
                                        })

                                        //caction.html(data);
                                    }
                                });

                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'bottom-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    }
                                })

                                Toast.fire({
                                    icon: 'success',
                                    title: $msg
                                })
                            } else {
                                Swal.fire({
                                    title: 'Erreur!',
                                    text: 'Veuillez réessayer',
                                    icon: 'error',
                                    confirmButtonText: 'Annuler'
                                })
                            }
                            //caction.html(data);
                        }
                    });


                    return false;
                });

                // ---- traces ----
                $('#admin-section,#user-section').on('click', '.trace-view', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var $this = $(this);
                    html_data = $this.data('html');
                    header_data = $this.data('header');
                    $('#traces .modal-body').html(html_data);
                    $('#traces .modal-title').html(header_data);
                    $('#traces').modal('show');
                    return false;
                });
                $('#admin-section').on('click', '.trace-status', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var $this = $(this);
                    var caction = $this.parent();
                    action = $this.data('action');
                    trace = $this.data('id-trace');

                    $.ajax({
                        type: "POST",
                        url: '<?php echo $base_url; ?>ajax/trace-status.php',
                        data: {
                            action: action,
                            trace: trace
                        },
                        success: function(data) {
                            if (data == "Correct") {


                                if (action == "Refuser") {
                                    caction.find('[data-action="Refuser"]').addClass("hide");
                                    caction.find('[data-action="Valider"]').removeClass("hide");
                                    $msg = "La participation a été refusée avec succés.";
                                }
                                if (action == "Valider") {
                                    caction.find('[data-action="Valider"]').addClass("hide");
                                    caction.find('[data-action="Refuser"]').removeClass("hide");
                                    $msg = "La participation a été validée avec succés.";
                                }


                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'bottom-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    }
                                })

                                Toast.fire({
                                    icon: 'success',
                                    title: $msg
                                })
                            } else {
                                Swal.fire({
                                    title: 'Erreur!',
                                    text: 'Veuillez réessayer',
                                    icon: 'error',
                                    confirmButtonText: 'Annuler'
                                })
                            }
                            //caction.html(data);
                        }
                    });

                    return false;
                });
                $('#admin-section').on('click', '.trace-filtre li a[data="trace-filtre"]', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var $this = $(this);
                    $('.trace-filtre .nav-link').removeClass('active');
                    $this.addClass('active');

                    target = $this.data('target');

                    $.ajax({
                        type: "POST",
                        url: '<?php echo $base_url; ?>ajax/trace-list.php',
                        data: {
                            target: target
                        },
                        success: function(data) {

                            $('#admin-section table').html(data);

                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'bottom-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'success',
                                title: "Mise à jour effectuée"
                            })

                            //caction.html(data);
                        }
                    });

                    return false;
                });

            <?php } ?>
            <?php if (isset($_SESSION["userprofile"]['type']) and $_SESSION["userprofile"]['type'] == "USER") { ?>

                $('#add-ticket-form .submit-add').on('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    user = $("#add-ticket-form select[name='user']");
                    sujet = $("#add-ticket-form input[name='sujet']");
                    message = $("#add-ticket-form textarea[name='message']");

                    $('.errorform').html('');
                    user.parent().find('.invalid-feedback').html('');
                    sujet.parent().find('.invalid-feedback').html('');
                    message.parent().find('.invalid-feedback').html('');



                    if (user.val() == "NOPE") {
                        user.addClass('is-invalid');
                        user.parent().find('.invalid-feedback').html("<i class='icon-warning-sign'></i> Veuillez saisir votre nom et prénom.");
                        rep_user = false;
                    } else {
                        user.removeClass('is-invalid');
                        rep_user = true;
                    }

                    if (sujet.val().length < 7) {
                        sujet.addClass('is-invalid');
                        sujet.parent().find('.invalid-feedback').html("<i class='icon-warning-sign'></i> Veuillez saisir un nom d'utilisateur valide.");
                        rep_sujet = false;
                    } else {
                        sujet.removeClass('is-invalid');
                        rep_sujet = true;
                    }


                    if (message.val().length < 8) {
                        message.addClass('is-invalid');
                        message.parent().find('.invalid-feedback').html("<i class='icon-warning-sign'></i> Veuillez saisir votre E-mail.");
                        rep_message = false;
                    } else {
                        message.removeClass('is-invalid');
                        rep_message = true;
                    }



                    if (rep_user && rep_sujet && rep_message) {
                        //alert("sending...");
                        $.ajax({
                            type: "POST",
                            url: '<?php echo $base_url; ?>ajax/ticket-add.php',
                            data: {
                                user: user.val(),
                                sujet: sujet.val(),
                                message: message.val()
                            },
                            success: function(data) {

                                if (data === 'Correct') {

                                    $.ajax({
                                        type: "POST",
                                        url: '<?php echo $base_url; ?>ajax/ticket-list.php',
                                        data: {
                                            target: 1
                                        },
                                        success: function(data) {

                                            $('#admin-section table').html(data);

                                            const Toast = Swal.mixin({
                                                toast: true,
                                                position: 'bottom-end',
                                                showConfirmButton: false,
                                                timer: 3000,
                                                timerProgressBar: true,
                                                didOpen: (toast) => {
                                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                                }
                                            })

                                            Toast.fire({
                                                icon: 'success',
                                                title: "Mise à jour effectuée"
                                            })

                                            //caction.html(data);
                                        }
                                    });


                                    $('#add-ticket-form').modal('hide');


                                } else if (data === 'Échec de la validation du jeton CSRF') {
                                    Swal.fire({
                                        title: 'Erreur!',
                                        text: 'Veuillez réessayer',
                                        icon: 'error',
                                        confirmButtonText: 'Annuler'
                                    })
                                } else {
                                    Swal.fire({
                                        title: 'Erreur!',
                                        text: data,
                                        icon: 'error',
                                        confirmButtonText: 'Annuler'
                                    })


                                }

                            }
                        });

                    }

                    return false;
                });
                $('#user-section').on('click', '.add-ticket-user', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    $('#add-ticket-user-form').modal('show');
                    $('#add-ticket-user-form').on('shown.bs.modal', function() {
                        $('input[name="name"]').trigger('focus');
                    })

                    return false;
                });
                $('#add-ticket-user-form .submit-add').on('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    user = $("#add-ticket-user-form input[name='user']");
                    sujet = $("#add-ticket-user-form input[name='sujet']");
                    message = $("#add-ticket-user-form textarea[name='message']");

                    $('.errorform').html('');
                    user.parent().find('.invalid-feedback').html('');
                    sujet.parent().find('.invalid-feedback').html('');
                    message.parent().find('.invalid-feedback').html('');



                    if (user.val() == "NOPE") {
                        user.addClass('is-invalid');
                        user.parent().find('.invalid-feedback').html("<i class='icon-warning-sign'></i> Veuillez saisir votre nom et prénom.");
                        rep_user = false;
                    } else {
                        user.removeClass('is-invalid');
                        rep_user = true;
                    }

                    if (sujet.val().length < 7) {
                        sujet.addClass('is-invalid');
                        sujet.parent().find('.invalid-feedback').html("<i class='icon-warning-sign'></i> Veuillez saisir un sujet valide.");
                        rep_sujet = false;
                    } else {
                        sujet.removeClass('is-invalid');
                        rep_sujet = true;
                    }


                    if (message.val().length < 8) {
                        message.addClass('is-invalid');
                        message.parent().find('.invalid-feedback').html("<i class='icon-warning-sign'></i> Veuillez saisir votre E-mail.");
                        rep_message = false;
                    } else {
                        message.removeClass('is-invalid');
                        rep_message = true;
                    }



                    if (rep_user && rep_sujet && rep_message) {
                        //alert("sending...");
                        $.ajax({
                            type: "POST",
                            url: '<?php echo $base_url; ?>ajax/ticket-add.php',
                            data: {
                                user: user.val(),
                                sujet: sujet.val(),
                                message: message.val()
                            },
                            success: function(data) {

                                if (data === 'Correct') {

                                    $.ajax({
                                        type: "POST",
                                        url: '<?php echo $base_url; ?>ajax/ticket-user-list.php',
                                        data: {
                                            target: 1
                                        },
                                        success: function(data) {

                                            $('#user-section table').html(data);

                                            const Toast = Swal.mixin({
                                                toast: true,
                                                position: 'bottom-end',
                                                showConfirmButton: false,
                                                timer: 3000,
                                                timerProgressBar: true,
                                                didOpen: (toast) => {
                                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                                }
                                            })

                                            Toast.fire({
                                                icon: 'success',
                                                title: "Mise à jour effectuée"
                                            })

                                            //caction.html(data);
                                        }
                                    });


                                    $('#add-ticket-user-form').modal('hide');


                                } else if (data === 'Échec de la validation du jeton CSRF') {
                                    Swal.fire({
                                        title: 'Erreur!',
                                        text: 'Veuillez réessayer',
                                        icon: 'error',
                                        confirmButtonText: 'Annuler'
                                    })
                                } else {
                                    Swal.fire({
                                        title: 'Erreur!',
                                        text: data,
                                        icon: 'error',
                                        confirmButtonText: 'Annuler'
                                    })


                                }

                            }
                        });

                    }

                    return false;
                });

                $('#user-section').on('click', '.commande-filtre li a[data="commande-filtre"]', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var $this = $(this);
                    $('.commande-filtre .nav-link').removeClass('active');
                    $this.addClass('active');

                    target = $this.data('target');

                    $.ajax({
                        type: "POST",
                        url: '<?php echo $base_url; ?>ajax/commande-list-user.php',
                        data: {
                            target: target
                        },
                        success: function(data) {

                            $('#user-section table').html(data);

                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'bottom-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'success',
                                title: "Mise à jour effectuée"
                            })

                            //caction.html(data);
                        }
                    });

                    return false;
                });
                $('#user-section').on('click', '.commande-status', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var $this = $(this);
                    var caction = $this.parent();
                    action = $this.data('action');
                    commande = $this.data('id-commande');

                    $.ajax({
                        type: "POST",
                        url: '<?php echo $base_url; ?>ajax/commande-status-user.php',
                        data: {
                            action: action,
                            commande: commande
                        },
                        success: function(data) {
                            if (data == "Correct") {


                                if (action == "Refuser") {
                                    caction.find('[data-action="Refuser"]').addClass("hide");
                                    caction.find('[data-action="Valider"]').removeClass("hide");
                                    $msg = "La commande a été refusée avec succés.";
                                }
                                if (action == "Valider") {
                                    caction.find('[data-action="Valider"]').addClass("hide");
                                    caction.find('[data-action="Supprimer"]').removeClass("hide");
                                    $msg = "La commande a été validée avec succés.";
                                }


                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'bottom-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    }
                                })

                                Toast.fire({
                                    icon: 'success',
                                    title: $msg
                                })
                            } else {
                                Swal.fire({
                                    title: 'Erreur!',
                                    text: 'Veuillez réessayer',
                                    icon: 'error',
                                    confirmButtonText: 'Annuler'
                                })
                            }
                            //caction.html(data);
                        }
                    });

                    return false;
                });
                $('#user-section').on('click', '.trace-view', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var $this = $(this);
                    html_data = $this.data('html');
                    header_data = $this.data('header');
                    $('#traces .modal-body').html(html_data);
                    $('#traces .modal-title').html(header_data);
                    $('#traces').modal('show');
                    return false;
                });
                $('#user-section').on('click', '.trace-filtre li a[data="trace-filtre"]', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var $this = $(this);
                    $('.trace-filtre .nav-link').removeClass('active');
                    $this.addClass('active');

                    target = $this.data('target');

                    $.ajax({
                        type: "POST",
                        url: '<?php echo $base_url; ?>ajax/trace-list-user.php',
                        data: {
                            target: target
                        },
                        success: function(data) {

                            $('#user-section table').html(data);

                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'bottom-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'success',
                                title: "Mise à jour effectuée"
                            })

                            //caction.html(data);
                        }
                    });

                    return false;
                });
            <?php } ?>
            $('body').on('click', '[data-noti-target="chat"]', function(e) {
                e.preventDefault();
                e.stopPropagation();
                var $this = $(this);
                var caction = $this.parent();
                var target = $this.data('noti-target');
                var target_id = $this.data('target-id');
                var noti_id = $this.data('noti-id');

                if (target == "chat") {
                    $("#chat-circle").toggle('scale');
                    $(".chat-box").toggle('scale');
                    $(".chat-box-header small").html("Chat privé");
                    $.ajax({
                        type: "POST",
                        url: '<?php echo $base_url; ?>ajax/send-msg.php',
                        data: {
                            msg: '[LOAD]',
                            target: target_id,
                            noti: noti_id
                        },
                        success: function(data) {
                            $("#chat-input").val("");
                            $('.chat-logs.chat-area-main').html(data);

                            $(".chat-input input.target").val(target_id);
                            $(".chat-area").animate({
                                scrollTop: $(".chat-area")[0].scrollHeight
                            }, 1000);

                        }
                    });
                }


                return false;
            });

            $('#show-message-box').on('click', "#send-msg", function(e) {
                e.preventDefault();
                e.stopPropagation();

                msg = $(".send-msg-box #message-to-send");
                target = $(".send-msg-box input.target");
                let idmessage = $(".send-msg-box input[name='idmessage']").val();


                if (msg.val().length > 1) {
                    //alert("sending...");
                    $.ajax({
                        type: "POST",
                        url: '<?php echo $base_url; ?>ajax/send-msg.php',
                        data: $('form.send-msg-box').serialize(),
                        success: function(data_1) {
                            $('#msgbox-modal #show-message-box').html('<div class="m-3">Chargement message ...</div>');

                            $.ajax({
                                type: "POST",
                                url: '<?php echo $base_url; ?>ajax/send-msg.php',
                                data: 'show-msg=1&idmessage=' + idmessage,
                                success: function(data) {
                                    $('#msgbox-modal #show-message-box').html(data);
                                }
                            });
                        }
                    });

                }

                return false;
            });

            $('.chat-area').on('keypress', ".send-msg-box input", function(e) {
                if (e.which == 13) {
                    var msg = $(".send-msg-box input.msg");
                    target = $(".send-msg-box input.target");


                    if (msg.val().length > 1) {
                        //alert("sending...");
                        $.ajax({
                            type: "POST",
                            url: '<?php echo $base_url; ?>ajax/send-msg.php',
                            data: {
                                msg: msg.val(),
                                target: target.val()
                            },
                            success: function(data) {
                                msg.val("");
                                $('.chat-area-main').html(data);
                                $(".chat-area").animate({
                                    scrollTop: $(".chat-area")[0].scrollHeight
                                }, 1000);

                            }
                        });

                    }

                    return false;
                }
            });
            $('.chat-area').on('click', '.delete-msg', function(e) {

                if (!confirm('Voulez-vous supprimer ce message ?')) {
                    return false;
                }
                e.preventDefault();
                e.stopPropagation();

                msg_id = $(this).data('msg-id');

                $.ajax({
                    type: "POST",
                    url: '<?php echo $base_url; ?>ajax/delete-msg.php',
                    data: {
                        'msg-id': msg_id
                    },
                    success: function(data) {
                        $.ajax({
                            type: 'POST',
                            url: '/ajax/checking-chat.php?a=refreshchat',
                            data: 'room=' + $('#room-user').val(),
                            success: function(data) {
                                $('.chat-area-main').html(data);
                            }
                        });

                    }
                });
                return false;
            });
            $(function() {
                var INDEX = 0;
                /*
                                 $("#chat-submit").click(function(e) {
                                     e.preventDefault();
                                     var msg = $("#chat-input").val();
                                     if(msg.trim() == ''){
                                         return false;
                                     }
                                     if(msg.length >1){
                                         //alert("sending...");

                                         target = $(".chat-input input.target").val();
                                         $.ajax({
                                             type: "POST",
                                             url: '<?php echo $base_url; ?>ajax/send-msg.php',
                                             data: {
                                                 msg : msg,
                                                 target : target
                                             },
                                             success: function(data)
                                             {
                                                 $("#chat-input").val("");
                                                 $('.chat-logs.chat-area-main').html(data);
                                                 $(".chat-area").animate({
                                                     scrollTop: $(".chat-area")[0].scrollHeight
                                                 }, 1000);

                                             }
                                         });

                                     }

                                 })*/



                $(document).delegate(".chat-btn", "click", function() {
                    var value = $(this).attr("chat-value");
                    var name = $(this).html();
                    $("#chat-input").attr("disabled", false);
                })

                $("#chat-circle").click(function() {
                    $("#chat-circle").toggle('scale');
                    $(".chat-box").toggle('scale');
                })

                $(".chat-box-toggle").click(function() {
                    $("#chat-circle").toggle('scale');
                    $(".chat-box").toggle('scale');
                })

            })
            $('.select-store-id').on("select2:closing", function(e) {
                e.preventDefault();
                e.stopPropagation();
                values = $('.select-store-id').select2().find(":selected").data("values");
                $('.select-values-id').html('').select2({
                    data: [{
                        id: '',
                        text: ''
                    }]
                });
                arr_values = values.split(",");
                console.log(arr_values)
                for (i = 0; i < arr_values.length; i++) {
                    data = {
                        id: arr_values[i],
                        text: arr_values[i] + '€'
                    };
                    console.log(data);
                    newOption = new Option(data.text, data.id, false, false);
                    $('.select-values-id').append(newOption);

                }
                $('.select-values-id').trigger('change');

                return false;
            });
            $('body').on('click', '.copy', function(e) {
                e.preventDefault();
                e.stopPropagation();
                var $this = $(this);
                $this.parent().find('input').select();
                document.execCommand("copy");
                return false;
            });
            $("select.grp-add, select.brand-add, select.type-add").select2({
                tags: true
            });
        });
    </script>
<?php } ?>
</body>


</html>