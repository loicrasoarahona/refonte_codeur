$(document).ready(function(){
 
$('#menuUsers_notification').slideUp(1);
$('.coupons-condition').slideUp(1);
$('#Nav_side').slideUp(1);
$('#condition_view').slideUp(1);

    localStorage.setItem('stop',1);
    if(window.screen.width <= 768){
        $('#navigation').slideUp(1);
    } 
    for(var i =0;i < document.getElementsByClassName('allStart').length ;i++){

        document.getElementsByClassName('allStart')[i].addEventListener("mouseover",function(){
            for(var i =0;i < this.getAttribute("id") ;i++){
                document.getElementsByClassName('allStart')[i].style["color"] = 'rgba(255, 255, 0, 0.383)';
            }
        }, false);

        document.getElementsByClassName('allStart')[i].addEventListener("mouseout",function(){

            for(var i =0;i < document.getElementsByClassName('allStart').length ;i++){

                if(document.getElementsByClassName('allStart')[i].style["color"] != 'yellow'){
                    document.getElementsByClassName('allStart')[i].style["color"] = '#aaa';
                }

            }

        }, false);
        
        document.getElementsByClassName('allStart')[i].addEventListener("click",function(){
            document.getElementById('start').value =this.getAttribute("id")
              for(var i =0;i < document.getElementsByClassName('allStart').length ;i++){
                document.getElementsByClassName('allStart')[i].style["color"] = '#aaa';
            }
            for(var i =0;i < this.getAttribute("id") ;i++){
                document.getElementsByClassName('allStart')[i].style["color"] = 'yellow';
            }
        }, false)

    }
  
    slideCarousel();
    slideCarouselAvis();
   
    setInterval(function(){
        next()
        nextAvis()
     }, 6000);

   
     setTimeout(() => {

        if(!getCookie('addNewLetter')){
            $('#backGround_newletter').fadeIn();
            $('#newLetter').fadeIn();
        }
      
     }, 2000);
    
    $("#refreshchat_container").animate({ 
        scrollTop: 500 }, 
    1)
   

});

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
}

function moins() {
  setInterval(function(){

        if(document.getElementById('id_notification').value*1 !=  0){
            document.getElementById('id_notification').value=document.getElementById('id_notification').value - 1;
            document.getElementById('Notification').append(document.getElementById('no-'+document.getElementById('id_notification').value));
        }else{
            localStorage.setItem('stop',1);
            $('#Notification').fadeOut();
        }
       
  }, 600);
}


function offerwall_open(){
    $('#offerwall_open').slideToggle();
    $('#offerwall_open_glif').toggleClass('rotate_of')

}

function offerwall_open_menu(){
    $('#offerwall_open_menu').slideToggle();
    $('#offerwall_open_glif_menu').toggleClass('rotate_of')

}


function openReponsiveHeader(){
    $('#navigation').slideToggle();
}

function closeBGconnect(){
    $('#background_no_connect').fadeOut();
    $('#res_ponse_connect').fadeOut();
}
function openCondition(){
    $('#condition_view').slideToggle()
    $('#condition_gliph').toggleClass('rotate')
}

function openPropo(){
    $('#apropos_view').slideToggle()
    $('#condition_apropo').toggleClass('rotate')
}

function toggleConditionCoupon(e){
    $('#coupons-condition-'+e).slideToggle();
    $('#condition-coupons-'+e).toggleClass('rotate')
}


function copy(e){
    document.getElementById('input-code-'+e).select();
    document.getElementById('copy-'+e).innerHTML='<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>'
    document.execCommand('copy')

}


function OpenCode(e){
    document.getElementById('coupons-'+e).style.display='block'; 
    $('#background').fadeIn();
}

function closeCode(){
    var id= document.getElementsByClassName('coupons-code-view')[0].id

    $('#'+id).fadeOut();
    $('#background').fadeOut();
}

function OpenLinkRedireact(e){
    window.open(e);
}

function findSouscategorie(){

    $.ajax({
        url:'https://revenucash.com/administration/getSouscategorie.php',
        type: 'POST',
        data:{id:document.getElementById('category').value},
        beforeSend:function(){
            $('#loader').html('<center><img src="../images/loader.gif" style="width:10vh;height:7vh"/><center>');
        },
        success: function(data) {
            $('#loader').html(data);
        },
        catch:function(){
            console.log('error');
        }
    });

}


function findMarque(){
    $.ajax({
        url:'https://revenucash.com/administration/getMarque.php',
        type: 'POST',
        data:{id:document.getElementById('retailer_id').value},
        beforeSend:function(){
            $('#loader').html('<center><img src="../images/loader.gif" style="width:10vh;height:7vh"/><center>');
        },
        success: function(data) {
            $('#loader').html(data);
        },
        catch:function(){
            console.log('error');
        }
    });
}
function findCachback(){
    $.ajax({
        url:'https://revenucash.com/administration/getCashback.php',
        type: 'POST',
        data:{id:document.getElementById('cashback_io').value},
        beforeSend:function(){
            $('#Response_categorie').html('<center><img src="../images/loader.gif" style="width:10vh;height:7vh"/><center>');
        },
        success: function(data) {
            $('#Response_categorie').html(data);
        },
        catch:function(){
            console.log('error');
        }
    });
}

function redirect(){
    if(document.getElementById('categoriRedirect').value === "0"){
        window.location.replace('https://revenucash.com/administration/cashback.php');
    }else{
        window.location.replace('https://revenucash.com/administration/cashback.php?categorie='+document.getElementById('categoriRedirect').value)
    }
}

function redirectCoupons(){
    if(document.getElementById('categoriRedirect').value === "0"){
        window.location.replace('https://revenucash.com/administration/coupons.php');
    }else{
        window.location.replace('https://revenucash.com/administration/coupons.php?cashback='+document.getElementById('categoriRedirect').value)
    }
}

function OpenLink(e){
    if(e != ''){
        window.location.replace('https://revenucash.com/cashbackView.php?id='+e);
    }
}

function locationCategorie(e){
    window.location.replace('https://revenucash.com/coupons.php?c='+e);
}
 

function OpenLinkFiltre(e=null,b,d){

    if(b != 0){

        $.ajax({
            url:'https://revenucash.com/getcashbackCategorieAndSousCAtegorie.php',
            type: 'POST',
            data:{
                idCategorie:e,
                idSouscategorie:b,
                filtre:document.getElementById('filtre').value,
                page:d
            },
            beforeSend:function(){
                $('#ViewRes').html('<center><img src="./images/loader.gif" style="width:10vh;height:7vh"/><center>');
            },
            success: function(data) {
                $('#ViewRes').html(data);
            },
            catch:function(){
             $('#ViewRes').html("error fetch data");
            }
        }); 

    }else{

         $.ajax({
           url:'https://revenucash.com/getcashbackCategorie.php',
           type: 'POST',
           data:{
               idCategorie:e,
               filtre:document.getElementById('filtre').value,
               page:d
            },
           beforeSend:function(){
               $('#ViewRes').html('<center><img src="./images/loader.gif" style="width:10vh;height:7vh"/><center>');
           },
           success: function(data) {
               $('#ViewRes').html(data);
           },
           catch:function(){
            $('#ViewRes').html("error fetch data");
           }
       }); 

    }
  
}

function Share(e){
 window.open('https://web.facebook.com/sharer/sharer.php?u=https://revenucash.com/'+e,
 'sharer','toolbar=0,status=0,width=580,height=325');
}

function share_twiter(e){
    window.open('https://twitter.com/share?url=https://revenucash.com/'+e,
    'sharer','toolbar=0,status=0,width=580,height=325');
}

function share_Linkdin(e){
    window.open('https://www.linkedin.com/sharing/share-offsite/?url=https://revenucash.com/'+e,
    'sharer','toolbar=0,status=0,width=580,height=325');
}

function CloseNavbar(){

    $('#background_black').fadeOut();
    $('#Nav_side').slideUp();
    $('#menuUsers').slideUp();
    $('#menuUsers_notification').slideUp();

    if($('#menuUsers_open_glif_menu').hasClass('rotate_of')){
        $('#menuUsers_open_glif_menu').toggleClass('rotate_of')
        $('#menuUsers_open_glif_menu_io').toggleClass('rotate_of')
    }

}
   
function openNavbar(){

    $('#background_black').fadeIn();
    $('#Nav_side').slideToggle();

    $.ajax({
        url:'https://revenucash.com/MenucashbackCategorie.php',
        type: 'POST',
        beforeSend:function(){
            $('#Nav_side').html('<center><img src="./images/loader.gif" style="width:10vh;height:7vh"/><center>');
        },
        success: function(data){
            $('#Nav_side').html(data);
        },
        catch:function(){
         $('#Nav_side').html("error fetch data");
        }
    });

    if(document.getElementsByClassName('io_nav')[0]){
        document.getElementsByClassName('io_nav')[0].style.color = 'red';
    }
    document.getElementsByClassName('none')[0].style['display:block'];

    
    for(var i =0;i < document.getElementsByClassName('menu_hover').length ;i++){
        document.getElementsByClassName('io_nav')[i].style['color']='#aaa';
    }

}

var checked = false;
function checkAll()
{
    var myform = document.getElementById("form2");
    
    if (checked == false) { checked = true }else{ checked = false }
    for (var i=0; i<myform.elements.length; i++) 
    {
        myform.elements[i].checked = checked;
    }
}

function OpenToggleLogin(){
    $('#background_black').fadeIn();
    $('#menuUsers').slideToggle();
    $('#menuUsers_open_glif_menu').toggleClass('rotate_of')
    $('#menuUsers_open_glif_menu_io').toggleClass('rotate_of')

}

function OpenNotification(){ 
    $('.cloche').fadeOut();
    $('#background_black').fadeIn();
    $('#menuUsers_notification').slideToggle();
    $.ajax({
        url:'https://revenucash.com/notificationOfferwallHeader.php',
        type: 'POST',
        beforeSend:function(){
            $('#res_notification').html('<center><img src="./images/loader.gif" style="width:10vh;height:7vh"/><center>');
        },
        success: function(data) {
                $('#res_notification').html(data);
        },
        catch:function(){
            console.log('error');
        }
    });
}



function mouseHover(e){
    if(!$('menu-ho-'+e).hasClass('menu_active_nav')){

        for(var i =0;i < document.getElementsByClassName('menu_hover').length ;i++){
            document.getElementsByClassName('menu_hover')[i].classList='menu_hover';
            document.getElementsByClassName('io_nav')[i].style['color']='#aaa';
        }


        $('.none').hide(1);
        document.getElementById('menu-ho-'+e).classList.add('menu_active_nav');
        document.querySelector('#menu-ho-'+e+' a').style.color='rgb(80,0,202)';
        $('#content_tendace_'+e).show(1);
    }
}

 

function redirectOfferwall(e){
    window.location.replace('https://revenucash.com/offre_mur.php?ow='+e);
}

function getcashback(e){
    $('#table_bord').slideToggle();
    $('#table_bord_gliph').toggleClass('rotate_of')
}

function getparticapations(e){

    for(var i =0;i < document.getElementsByClassName('act_ho').length ;i++){
        document.getElementsByClassName('act_ho')[i].classList='act_ho';
    }

        document.getElementById('particapations').classList.add('active_home_tableau');

            $.ajax({
                url:'https://revenucash.com/getActivite.php',
                type: 'POST',
                data:{idUser:e},
                beforeSend:function(){
                    $('#table_bord').html('<center><img src="./images/loader.gif" style="width:10vh;height:7vh"/><center>');
                },
                success: function(data){
                    $('#table_bord').html(data);
                },
                catch:function(){
                    $('#table_bord').html("error fetch data");
                }
            });
}

function openAide(e){
    $('#d'+e).slideToggle();
    $('#g'+e).toggleClass('rotate_of')
}

function OpenMessage(e){
    $('#message-'+e).slideToggle();
    $('#me_io-'+e).toggleClass('rotate_of');
}

function CloseNewletter(){
    $('#backGround_newletter').fadeOut();
    $('#newLetter').fadeOut();
    document.cookie='addNewLetter=1';
}

function activeCookie(){
    $('#cookie_acceuil').fadeOut();
    document.cookie='_cashbackREduction=1';
}