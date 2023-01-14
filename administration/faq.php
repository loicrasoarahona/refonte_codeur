<?php

    include('./requiert/inc-head.php');

	include('./requiert/php-global.php');
	
	$meta_title = 'Panel d\'administration : Foire aux questions | cashbackreduction.com';
    
    $nomPage = 'faq';
	
	include('./requiert/inc-header-navigation.php');

    include('./requiert/php-form/faq.php');

?>
    <!-- DASHBOARD BODY -->
<?php if (!isset($_GET['action'])) :?>
        <!-- DASHBOARD CONTENT -->

            <!-- HEADLINE -->
            <nav class="navbar navbar-expand navbar-light bg-light mb-4">
                        <h4 class="text-primary" >
                        Administration Questions/Réponses
                        </h4>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a href="<?= url_panel; ?>/faq.php?action=add" class="button  btn-primary btn-icon-split">Ajouter une Q/R</a>
                            </li>
                        </ul>
            </nav>
            <!-- /HEADLINE -->

            <?php //Bloc requete SQL pour la prochaine boucle
            $messagesParPage = 50;
            $retour_total = $pdo->query("SELECT COUNT(*) AS total FROM faq");
            $donnees_total = $retour_total->fetch();
            $total = $donnees_total['total'];
            $nombreDePages = ceil($total / $messagesParPage);

            if (isset($_GET['page'])) { $pageActuelle = intval($_GET['page']); if ($pageActuelle > $nombreDePages) { $pageActuelle = $nombreDePages; } } else { $pageActuelle = 1; }

            $premiereEntree = ($pageActuelle - 1) * $messagesParPage;

            $offer = $pdo->query("SELECT * FROM faq ORDER BY question LIMIT ".$premiereEntree.", ".$messagesParPage."");
            $all_offers = $offer->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <!-- /PROFILE NOTIFICATION -->
            <div class="profile-notifications faq">
                <?php foreach ($all_offers as $dones_offers):?>
                <div class="profile-notification">
                    <div class="profile-notification-body">
                        <p class="text-header">
                            <?= $dones_offers['question']; ?>
                        </p>

                    </div>
                    <div class="profile-notification-type">
                        <a href="<?= url_panel; ?>/faq.php?action=update&id=<?= $dones_offers['id']; ?>" class="button secondary">Modifier</a>
                    </div>
                </div>
                 <?php endforeach; ?>
            </div>
            <!-- /PROFILE NOTIFICATION -->
<?php elseif ($_GET['action'] == 'add'): ?>
        <!-- DASHBOARD CONTENT -->
            <!-- HEADLINE -->
            <nav class="navbar navbar-expand navbar-light bg-light mb-4">
                        <h4 class="text-primary" >
                        Administration Questions/Réponses
                        </h4>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                 <a href="<?= url_panel; ?>/faq.php" class="button  btn-primary btn-icon-split">Retour</a>
                            </li>
            </nav>
            <!-- /HEADLINE -->
            <!-- FORM BOX ITEMS -->
            <div class="form-box-items">
                <!-- FORM BOX ITEM -->
                <div class="form-box-item full">
                    <hr class="line-separator">
                    <form id="upload_form" method="post">

                        <!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <label for="question"  class="text-primary">Question</label>
                            <textarea id="question" name="question" placeholder="Entrer votre question..."><?= $post_question; ?></textarea>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <label for="reponse"  class="text-primary">Réponse</label>
                            <textarea id="reponse" name="reponse" placeholder="Entrer votre réponse..."><?= $post_reponse; ?></textarea>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <hr class="line-separator">
                        <input type="submit" name="submit_add" value="Ajouter la Q/R" class="button btn-primary btn-icon-split"/>
                    </form>
                </div>
        
    <!-- /DASHBOARD BODY -->
<?php elseif ($_GET['action'] == 'update'):?>
    <?php //Bloc req SQL pour le formulaire de modification
    $sqlFaq = $pdo->query("SELECT * FROM faq WHERE id = '".intval($_GET['id'])."'");
    $resultatFaq = $sqlFaq->fetch();
    $questionFAQ = $resultatFaq['question'];
    $reponseFAQ = $resultatFaq['reponse'];
    ?>
    <!-- DASHBOARD CONTENT -->
        <!-- HEADLINE -->
        <nav class="navbar navbar-expand navbar-light bg-light mb-4">
                        <h4 class="text-primary" >
                        Administration Questions/Réponses
                        </h4>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                 <a href="<?= url_panel; ?>/faq.php" class="button  btn-primary btn-icon-split">Retour</a>
                            </li>
        </nav>
        <!-- /HEADLINE -->
        <!-- FORM BOX ITEMS -->
        <div class="form-box-items">
            <!-- FORM BOX ITEM -->
            <div class="form-box-item full">
                <hr class="line-separator">
                <form id="upload_form" method="post">

                    <!-- INPUT CONTAINER -->
                    <div class="input-container half">
                        <label for="question"  class="text-primary">Question</label>
                        <textarea id="question" name="question" placeholder="Entrer votre question..."><?= $questionFAQ; ?></textarea>
                    </div>
                    <!-- /INPUT CONTAINER -->

                    <!-- INPUT CONTAINER -->
                    <div class="input-container half">
                        <label for="reponse"  class="text-primary">Réponse</label>
                        <textarea id="reponse" name="reponse" placeholder="Entrer votre réponse..."><?= $reponseFAQ; ?></textarea>
                    </div>
                    <!-- /INPUT CONTAINER -->

                    <hr class="line-separator">
                    <input type="submit" name="submit_upd" value="Modifier la Q/R" class="button btn-primary btn-icon-split"/>
                </form>
<?php endif; ?>
    <!-- /DASHBOARD BODY -->

<?php include('./requiert/inc-footer.php');?>