<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {


    if (isset($_POST['target']) && !empty($_POST['target'])) {
        include_once '../include/config.php';

        $target = stripslashes($_POST['target']);
        $target = mysqli_real_escape_string($conn, $target);

        $user_type = $_SESSION['userprofile']['type'];


            ?>
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Membre</th>
                <th scope="col">Boutique</th>
                <th scope="col">Montant</th>
                <th scope="col">Code</th>
                <th scope="col">État/Date</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <?php


            $query = "SELECT c.*,u.name_account,s.name as store_name FROM  commandes c, users u , stores s where idUser = u.id and idStore = s.id  ";

            $query = "SELECT c.*,u.name_account,s.name as store_name FROM  commandes c, users u , stores s where idUser = u.id and idStore = s.id  limit 50";
            if($target == 5){
                $query = "SELECT c.*,u.name_account,s.name as store_name FROM  commandes c, users u , stores s where idUser = u.id and idStore = s.id order by c.id desc limit 100";
            }
            if($target == 1){
                $query = "SELECT c.*,u.name_account,s.name as store_name FROM  commandes c, users u , stores s where idUser = u.id and idStore = s.id order by c.id desc limit 50";
            }
            if($target == 2){
                $query = "SELECT c.*,u.name_account,s.name as store_name FROM  commandes c, users u , stores s where idUser = u.id and idStore = s.id and c.status =0 order by c.id desc limit 50";
            }
            if($target == 3){
                $query = "SELECT c.*,u.name_account,s.name as store_name FROM  commandes c, users u , stores s where idUser = u.id and idStore = s.id and c.status =1 order by c.id desc limit 50";
            }
            if($target == 4){
                $query = "SELECT c.*,u.name_account,s.name as store_name FROM  commandes c, users u , stores s where idUser = u.id and idStore = s.id and c.status =2 order by c.id desc limit 50";
            }

            $res = mysqli_query($conn, $query);
            if(mysqli_num_rows($res)>0){
                while($data = mysqli_fetch_array($res)){
                    ?>
                    <tr>
                        <th scope="row"><?php echo $data['id']; ?></th>
                        <td class="text-capitalize"><?php echo ucwords($data['name_account']); ?></td>
                        <td class="text-capitalize"><?php echo ucwords($data['store_name']); ?></td>
                        <td class="text-capitalize"><?php echo displayMontant($data['value'],2,"€"); ?></td>
                        <td><?php echo $data['code']; ?></td>
                        <td>
                            <?php if($data['status'] == "0"){echo '<i class="icofont-star text-warning"></i>En attente';} ?>
                            <?php if($data['status'] == "1"){echo '<i class="icofont-star text-success"></i>Validée';} ?>
                            <?php if($data['status'] == "2"){echo '<i class="icofont-star text-danger"></i>Refusée';} ?>
                            <?php echo dateToFrench( $data['datetime'],"d/m/Y");?>
                        </td>
                        <td>
                            <?php $clo_v = "hide"; if($data['status'] == "1" ){$clo_v = "";} ?>
                            <?php $clo_r = "hide"; if($data['status'] == "0" ){$clo_r = "";} ?>

                            <a  href="<?php echo $base_url;?>admin/edit-commande/<?php echo $data['id']; ?>" class="badge badge-success" >Modifier</a>
                            <span data-id-commande="<?php echo $data['id']; ?>" data-action="Refuser" class="<?php echo $clo_v; ?> commande-status badge badge-dark" >Refuser</span>
                            <span data-header="<?php echo displayMontant($data['value'],2,"€"); ?> : <?php echo ucwords($data['store_name']); ?> - <?php echo ucwords($data['name_account']); ?> " data-id-commande="<?php echo $data['id']; ?>" data-action="Valider" class="<?php echo $clo_r; ?> badge badge-info valide-commande" >Valider</span>

                        </td>
                    </tr>
                <?php }
            }else{
                ?>
                <tr>
                    <td colspan="7">PAS DE RÉSULTATS!</td>
                </tr>
            <?php } ?>
            </tbody>
            <?php



    }

}