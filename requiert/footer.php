 <!-- Début modif footer -->
    <div class="u-cf"></div>
<footer>
        <div class="container">
        <div class="row">
        <div class="six columns">
        <a href="index.php" class="none" style="margin-top:5px"><div class="logo"></div></a>
        <p class="copy">© 2022 Revenucash</p>
        <p class="disc">Tous les noms de produits et de sociétés sont des marques de commerce™ ou des marques déposées® de leurs détenteurs respectifs. Leur utilisation n'implique aucune affiliation ou approbation de leur part.</p>
        </div>
        <div class="two columns">
        <h3>Support</h3>
        <a href="https://help.earnably.com/" class="get_help">Faq</a><br>
        <a href="https://revenucash.com/contact.php" target="_blank" rel="noopener noreferrer">Contact</a><br>
       
        </div>
        <div class="two columns">
        <h3>Stratégies</h3>
        <a href="terms.php">Conditions d'utilisation</a><br>
        <a href="privacy.php">Politique de confidentialité</a><br>
        <a href="cookies.php">Politique de cookies</a><br>
        </div>
        <div class="two columns socials">
        <h3>Communauté</h3>
        <a href="https://www.facebook.com/" "="" target="_blank" rel="noopener noreferrer"><span class="social facebook"><i class="fa fa-facebook-square"></i></span><span class="underline">Facebook</span></a><br>
        <a href="https://twitter.com/" "="" target="_blank" rel="noopener noreferrer"><span class="social twitter"><i class="fa fa-twitter"></i></span><span class="underline">Twitter</span></a><br>
        <a href="https://www.instagram.com/" "="" target="_blank" rel="noopener noreferrer"><span class="social instagram"><i class="fa fa-instagram"></i></span><span class="underline">Instagram</span></a><br>
        </div>
        </div>
        </div>
  </footer>
 <!-- Footer Part End -->

 <!-- Scroll to Top Start -->
 <a href="#" class="scrollToTop">
     <i class="fa fa-arrow-up"></i>
 </a>
 <!-- Scroll to Top End -->



 
<div id='background' onClick="closeCode()"></div>
<div class="fb-customerchat"
 page_id="101168218368541">
</div>
<?php
	if(!isset($_COOKIE['_cashbackREduction'])){
?>
<div id='cookie_acceuil' style="background: #dee1e5; box-shadow: none !important; padding: 30px 30px 30px 30px">
 	<p style="color:#000000">
	 Notre site Web utilise des cookies pour vous garantir <br>
   la meilleure expérience. En continuant à utiliser notre <br>
   site Web, vous consentez à notre utilisation des cookies.
	 <a href=''></a>
   <p style="font-weight: bold;"><u><a style="color:#c4c8ce">En savoir plus</a></u></p>
	</p>
	<button class='btn btn-primary ' onclick='activeCookie()' style="background: #fccd12; color: #222222; font-weight: bold; width: 100%; border: none !important; font-family: 'source sans pro', 'helvetica neue', Helvetica, arial, sans-serif, sans;">
	D'accord !
	</button>
</div>
<?php
	}
?>
<div id='background_black' onClick='CloseNavbar()'>
</div>
<div id='Nav_side' class='border-radius bg-white shadow '>

</div>
<!-- SITE SCRIPT  -->

 <!-- jquery -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css" media="all">
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

 <!-- BOOTSTRAP JS -->
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

 <!-- if load google maps then load this api -->
 <script src="//maps.googleapis.com/maps/api/js?key=AIzaSyChihC--Jb_QURoXd2MugyC53cDQjrV2MY"></script>

 <!-- load if our contact form or email subscribe options is used -->
 <script src="coupon/vendor/validation/jquery.validate.js"></script>

 <!-- clipboard.js -->
 <script src="coupon/vendor/clipboard.js/clipboard.min.js"></script>

 <!-- flatpickr -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.9/flatpickr.min.js"></script>

 <!-- lity -->
 <script src="coupon/vendor/lity/lity.min.js"></script>

 <!-- Bootstrap Slider -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/bootstrap-slider.min.js"></script>

 <!-- switcher -->

<!--owl-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
 <!-- THEME SCRIPT  -->
 <script src="coupon/js/theme.js"></script>

<!--------------------------SCRIPT---------------------------->

<script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
<!-- <script type="text/javascript" src="js/Chart.min.js"></script> -->
<script type="text/javascript" src="js/utils.js"></script>

 <?php
 $a = explode('/',$_SERVER['REQUEST_URI'][1]);
 $b= str_replace('.php','',$a);

 ?>
 <!-- <script>
     document.getElementById("<?= $b; ?>").classList.add('active_dashbord_user');
     document.getElementById("h-<?= $b; ?>").classList.add('active_dashbord_user');
 </script> -->

<script type="text/javascript" src="js/app.js"></script>

<script type="text/javascript" src="js/slick.js"></script>
<script type="text/javascript">
    
    var foot=$(".cbx-header")[0].outerHTML
    $(".cbx-header").remove()
    $(".cbx-container").before(foot)

    var foot=$(".cbx-footer")[0].outerHTML
    $(".cbx-footer").remove()
    $(".cbx-container").after(foot)

        function activeCookie(){
            $("#cookie_acceuil").fadeOut("slow");
        }

    $(document).on('ready', function() {
      if(window.screen.width <= 414){

         $(".regular").slick({
            dots: true,
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3,
            autoplay: true,
            autoplaySpeed: 6000
         });

      }else{

         $(".regular").slick({
            dots: true,
            infinite: true,
            slidesToShow: 6,
            slidesToScroll: 6,
            autoplay: true,
            autoplaySpeed: 2000
         });
      }
    });
</script>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script src="https://www.google.com/recaptcha/api.js"></script>
<script type="text/javascript" src="https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js "></script>

<script>
   $(document).ready(function(){
      window.addEventListener('scroll', function(e){
            if(window.pageYOffset > 200){
               $('#backtop').fadeIn();
               $('#backbouttom').fadeOut();

            }else{
               $('#backtop').fadeOut();
               $('#backbouttom').fadeIn();

            }
      });
   <?php
      if(explode('/',$_SERVER['PHP_SELF'])[1] == 'index.php'){
   ?>
      window.addEventListener('scroll', function(e){
            if(window.pageYOffset > 50){
               $('#search').show();
               $('#header').addClass('class_haeder');
            }else{
               $('#header').removeClass('class_haeder');
               $('#search').hide();
            }
      });

      
   

    <?php
      }else{
    ?>
               $('#header').addClass('class_haeder');
    <?php
      }
    ?>
       AOS.init({
           duration:1500
       });

   

   });

   </script>
<!-- Google Autocomplete -->
<script>
  function initAutocomplete() {
    var input = document.getElementById('autocomplete-input');
    var autocomplete = new google.maps.places.Autocomplete(input);

    autocomplete.addListener('place_changed', function() {
      var place = autocomplete.getPlace();
      if (!place.geometry) {
        window.alert("No details available for input: '" + place.name + "'");
        return;
      }
    });

	if ($('.main-search-input-item')[0]) {
	    setTimeout(function(){ 
	        $(".pac-container").prependTo("#autocomplete-container");
	    }, 300);
	}
}
</script>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
	<style type="text/css">
     .cbx-footer .cbx-footer-top {
    background-color: #6bbc45;
    padding: 25px 0px 22px 14px;
}   
    </style>
</body>
</html>