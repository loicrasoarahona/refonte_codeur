<?php
	include('./requiert/inc-head.php');

	include('./requiert/php-global.php');
	
	$meta_title = 'Panel d\'administration : Boutique | cashbackreduction.com';

    $nomPage = 'boutique';

	include('./requiert/inc-header-navigation.php');

    include('./requiert/php-form/image.php');

    $boutiqueByPage=12;
    $boutiquetotalReq=$e = $pdo->query("SELECT * FROM bannier");
    $boutiquetotal =  $boutiquetotalReq->rowCount();

    if(isset($_GET['page']) && !empty($_GET['page'])){
        $_GET['page'] = intval($_GET['page']);
        $pageCourante = $_GET['page'];
    }else{
        $pageCourante =1;
    }

    $depart = ($pageCourante-1)*$boutiqueByPage;

  ?>
 <div class='container'>
 <br/>
 <form action="" method="post" enctype="multipart/form-data">
    <nav class="navbar navbar-expand navbar-light bg-light mb-4">
                <h4 class="text-primary" >Ajouter une image</h4>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <input type='file' style='margin:1vh 0' name='image' class='form-control'/>
                    </li>
                    <li class="nav-item">
                    <input type='submit'  class='btn btn-success' style='margin:1vh 0'  name='add_image' value='Ajouter'/>
                    </li>
                </ul>
    </nav>
 </form>

                    </div>
                
                    <div class="content">
                    <?php if (isset($_GET['msg']) && $_GET['msg'] != "") { ?>
                                                <?php
                                                switch ($_GET['msg'])
                                                {
                                                    case "added": echo "<div class='alert alert-success'> Le categorie a bien  été ajouté avec succès</div>"; break;
                                                    case "updated": echo "<div class='alert alert-success'> Le categorie a bien  été mis à jour</div>"; break;
                                                    case "deleted": echo "<div class='alert alert-success'> Le categorie a bien  été supprimé</div>"; break;
                                                }
                                                
                                                ?>
                                            <?php } ?>
                        <?php
                            if(isset($reponsError) && !empty($reponsError)){
                        ?>
                            <div class='alert alert-danger'>
                                <?= $reponsError; ?>
                            </div>
                        <?php
                            }else if(isset($reponsConfirm ) && !empty($reponsConfirm)){
                        ?>
                            <div class='alert alert-success'>
                                <?= $reponsConfirm; ?>
                            </div>
                        <?php
                            }
                        ?>  
                            <div class='row'>
    
                            <?php
                                $req = $pdo->query("SELECT * FROM bannier ORDER BY id DESC  LIMIT $depart,$boutiqueByPage ");
                                $categories = $req->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                            <?php foreach ($categories as $categories) : ?>

                            <div class='col-md-3' style='margin: 2vh 0'>
                            <a style='float:right;position:absolute;right:1vh;top:-1vh;background-color:red;color:white;padding:0.5vh;border-radius:1.5vh' href='image_delete.php?id=<?=  $categories['id']; ?>' class="fa fa-times"></a>
                                <img src='<?= str_replace('./','https://my-qassa.com/',$categories['img_src']); ?>'
                                 style='width:100%;height:10vh'/>
                            </div>
    
                            <?php endforeach; ?>
                            </div>

                            <center>
<nav  >
  <ul class="pagination">
    <li class="page-item disabled">
      <span class="page-link">Previous</span>
    </li>
    <?php
        for($i=1;$i <=  ceil($boutiquetotal/$boutiqueByPage) ;$i++){
    ?>
      <li class="page-item
      <?php
            if(isset($_GET['page']) && $_GET['page'] == $i){
                echo 'active';
            }else if(!isset($_GET['page']) &&  $i == 1){
                echo 'active';
            }
      ?>
      
      ">
        <a class="page-link" href="<?php
            if(isset($_GET['find'])){
                echo 'bannier.php?find='.$_GET['find'].'&page='.$i;
            }else if(isset($_GET['categorie'])){
                echo 'bannier.php?categorie='.$_GET['categorie'].'&page='.$i;
            }else{
                echo 'bannier.php?page='.$i;
            }
        ?>"><?= $i; ?></a>
     </li>
    <?php
    
        }
    
    ?>
    <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li>
  </ul>
</nav>
    </center>
                    </div>

<br/>
<br/>
 
<?php
	include('./requiert/inc-footer.php');
?>