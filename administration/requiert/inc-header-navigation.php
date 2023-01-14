<?php //Requete pour compter le nombre de membre
if(!isset($_SESSION['admin']) || !isset($_SESSION['admin']['id'])){
    ?>
  <script type="text/javascript">
    window.location='../admin.php';
  </script>
  <?php
  }

$sql = $pdo->query('SELECT COUNT(id) AS membreTotal FROM users');
$donnees = $sql->fetchAll();
$membreTotal = $donnees[0]['membreTotal'];
?>
<?php //Requete pour compter le nombre de profil a vérifier
  $user = $pdo->query("SELECT * FROM users WHERE nom != '' && prenom != '' && adresse != '' && ville != '' && codePostal != '' && code_verif != 1 && code_verif_date = '' ORDER BY id DESC");
  $all_users_profil = $user->fetchAll(PDO::FETCH_ASSOC);

?>

<?php //Requete pour compter le nombre d'identité a vérifier
  $user = $pdo->query("SELECT * FROM users WHERE ident_verso != '' && ident_recto != '' && ident_verif = 0 ORDER BY id DESC");
  $all_users_idt = $user->fetchAll(PDO::FETCH_ASSOC);
?>

<?php //Requete pour compter le nombre d'identité a vérifier
  $user = $pdo->query("SELECT * FROM users WHERE banni = 2 ORDER BY id DESC");
  $double = $user->fetchAll(PDO::FETCH_ASSOC);
?>

<?php //Requete pour compter le nombre de membre
  //$io = $pdo->query("SELECT COUNT(id) AS membreTotal FROM livredor WHERE statut=0");
  //$ioo = $io->fetchAll();
  //$avis = $ioo[0]['membreTotal'];
//echo "<hr>avis : <pre>"; print_r($avis); echo"</pre>";
?>

  <!-- Page Wrapper -->
  <div id="wrapper" style='margin:-1.95% 0 0 0;padding:0' >

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="index.php" class="collapse-item"> Accueil</a>
		<a class="nav-link collapsed" href="membres.php" class="collapse-item"> Membres</a>
		<a class="nav-link collapsed" href="gagnants.php" class="collapse-item"> Gagnants</a>
    <a class="nav-link collapsed" href="coupons.php" class="collapse-item"> coupons</a>
		<a class="nav-link collapsed" href="messagerie.php" class="collapse-item"> Messagerie</a>
		<a class="nav-link collapsed" href="users.php" class="collapse-item"> Users</a>
		<a class="nav-link collapsed" href="boutique.php" class="collapse-item"> Boutique</a>

        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
          </div>
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="validations.php" class="collapse-item"><span class="sl-icon icon-check"></span>Validations</a>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
             
          </div>
        </div>
      </li>

      

      <!-- Divider -->
      <hr class="sidebar-divider">
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="emailing.php"class="collapse-item"><span class="sl-icon icon-layers"></span>e-mailing</a>
		<a class="nav-link collapsed" href="missions.php"class="collapse-item"><span class="sl-icon icon-layers"></span>Missions</a>
		<a class="nav-link collapsed" href="categories.php"class="collapse-item"><span class="sl-icon icon-layers"></span>Categories</a>
		<a class="nav-link collapsed" href="avis.php"class="collapse-item"><span class="sl-icon icon-layers"></span>Avis</a>
		<a class="nav-link collapsed" href="newsletter.php"class="collapse-item"><span class="sl-icon icon-layers"></span>Newsletter</a>
          
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
               
          </div>
        </div>
      </li>
        <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="bannier.php" class="nav-link">Banniere</a></li>
		 <li class="nav-item">
		<a class="nav-link collapsed" href="faq.php" class="nav-link">Faq</a></li>
		 <li class="nav-item">
		<a class="nav-link collapsed" href="parrainage.php" class="nav-link">Parrainage</a></li>
       
        </a>
      
      <hr class="sidebar-divider">

      <li class="nav-item"><a href="index.php?action=logout"  class="nav-link">Logout</a></li>

      <hr class="sidebar-divider d-none d-md-block">

      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

     
        </nav>
        <!-- End of Topbar -->

	<div class="container">
