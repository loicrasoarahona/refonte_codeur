<?php
	include('./requiert/inc-head.php');

	include('./requiert/php-global.php');
	
	$meta_title = 'Panel d\'administration : Newsletter | Maxiconcour.com';

    $nomPage = 'newsletter';
	
	include('./requiert/inc-header-navigation.php');

    include('./requiert/php-form/newsletter.php');
?>

    <!-- DASHBOARD BODY -->
            <!-- HEADLINE -->
            <nav class="navbar navbar-expand navbar-light bg-light mb-4">
                        <h4 class="text-primary" >Administration newsletter</h4>
            </nav>
            <!-- /HEADLINE -->
            <!-- FORM BOX ITEMS -->
                    <form id="upload_form" method="post">
                                <textarea id="description" name="message" style='width:100%' placeholder="Entrez une longue description (optionel)"></textarea>
                       
                        <br >
                        <input type="submit" name="submit_newsletter" value="Envoyer la newletter" class="button btn-primary btn-icon-split"/>
                    </form>
            <!-- /FORM BOX ITEMS -->

<?php
	include('./requiert/inc-footer.php');
?>