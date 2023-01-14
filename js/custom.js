/*
Template Name: Osahan Deel
Author: gurdeep
Author URI: https://themeforest.net/user/askbootstrap
Version: 1.0
*/
$(document).ready(function() {
    "use strict";

    $(function() {
        $("body").on("input propertychange", ".floating-label-form-group", function(e) {
            $(this).toggleClass("floating-label-form-group-with-value", !!$(e.target).val());
        }).on("focus", ".floating-label-form-group", function() {
            $(this).addClass("floating-label-form-group-with-focus");
        }).on("blur", ".floating-label-form-group", function() {
            $(this).removeClass("floating-label-form-group-with-focus");
        });
    });

    var oneobjowlcarousel = $(".owl-carousel-one");
    if (oneobjowlcarousel.length > 0) {
        oneobjowlcarousel.owlCarousel({
            items: 1,
            lazyLoad: true,
            pagination: false,
            loop: true,
            dots: false,
            autoPlay: 2000,
            nav: true,
            stopOnHover: true,
            navText: ["<i class='icofont-thin-left'></i>", "<i class='icofont-thin-right'></i>"]
        });
    }

    var objowlcarousel = $(".owl-carousel-two");
    if (objowlcarousel.length > 0) {
        objowlcarousel.owlCarousel({
            items: 2,
            lazyLoad: true,
            pagination: false,
            loop: true,
            dots: false,
            autoPlay: 2000,
            nav: true,
            stopOnHover: true,
            navText: ["<i class='icofont-thin-left'></i>", "<i class='icofont-thin-right'></i>"],
            responsive: {
                0: {
                    items: 1
                },
                479: {
                    items: 1
                },
                768: {
                    items: 1
                },
                979: {
                    items: 2
                },
                1199: {
                    items: 2
                }
            }
        });
    }

    var threeobjowlcarousel = $(".owl-carousel-three");
    if (threeobjowlcarousel.length > 0) {
        threeobjowlcarousel.owlCarousel({
            items: 3,
            lazyLoad: true,
            pagination: false,
            loop: true,
            dots: false,
            autoPlay: 2000,
            nav: true,
            stopOnHover: true,
            navText: ["<i class='icofont-thin-left'></i>", "<i class='icofont-thin-right'></i>"],

            responsive: {
                0: {
                    items: 1
                },
                479: {
                    items: 1
                },
                768: {
                    items: 2
                },
                979: {
                    items: 3
                },
                1199: {
                    items: 3
                }
            }
        });
    }

    var fiveobjowlcarousel = $(".owl-carousel-five");
    if (fiveobjowlcarousel.length > 0) {
        fiveobjowlcarousel.owlCarousel({
            items: 5,
            lazyLoad: true,
            pagination: false,
            loop: true,
            dots: false,
            autoPlay: 2000,
            nav: true,
            stopOnHover: true,
            navText: ["<i class='icofont-thin-left'></i>", "<i class='icofont-thin-right'></i>"],
            responsive: {
                0: {
                    items: 1
                },
                479: {
                    items: 1
                },
                768: {
                    items: 2
                },
                979: {
                    items: 4
                },
                1199: {
                    items: 4
                }
            }

        });
    }

    var restaurantslider = $(".restaurant-slider");
    if (restaurantslider.length > 0) {
        restaurantslider.owlCarousel({
            items: 1,
            lazyLoad: true,
            pagination: false,
            loop: true,
            dots: false,
            autoPlay: 2000,
            nav: true,
            stopOnHover: true,
            navText: ["<i class='icofont-thin-left'></i>", "<i class='icofont-thin-right'></i>"]
        });
		

        $("#contact").submit(function(event){
            var nom        = $("#prenom").val();
            var sujet      = $("#object").val();
            var email      = $("#email").val();
            var message    = $("#message").val();
            var dataString = nom + object + email + message;
            var msg_all    = "Merci de remplir tous les champs";
            var msg_alert  = "Merci de remplir ce champs";

            if (dataString  == "") {
                $("#msg_all").html(msg_all);
            } else if (prenom == "") {
                $("#msg_prenom").html(msg_alert);
            } else if (object == "") {
                $("#msg_object").html(msg_alert);
            } else if (email == "") {
                $("#msg_email").html(msg_alert);
            } else if (message == "") {
                $("#msg_message").html(msg_alert);
            } else {
                $.ajax({
                    type : "POST",
                    url: $(this).attr("action"),
                    data: $(this).serialize(),
                    success : function() {
                        $("#contact").html("<p>Formulaire bien envoyé</p>");
                    },
                    error: function() {
                        $("#contact").html("<p>Erreur d'appel, le formulaire ne peut pas fonctionner</p>");
                    }
                });
            }

            return false;
        });

		
		
    }

    // Select all links with hashes
    $('a[href*="#"]')
        // Remove links that don't actually link to anything
        .not('[href="#"]')
        .not('[href="#0"]')
        .click(function(event) {
            // On-page links
            if (
                location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') &&
                location.hostname == this.hostname
            ) {
                // Figure out element to scroll to
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                // Does a scroll target exist?
                if (target.length) {
                    // Only prevent default if animation is actually gonna happen
                    event.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top
                    }, 1000, function() {
                        // Callback after animation
                        // Must change focus!
                        var $target = $(target);
                        $target.focus();
                        if ($target.is(":focus")) { // Checking if the target was focused
                            return false;
                        } else {
                            $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
                            $target.focus(); // Set focus again
                        };
                    });
                }
            }
        });

    // ===========Select2============
    $('select').select2();

    // ===========Tooltip============
    $('[data-toggle="tooltip"]').tooltip()

});
