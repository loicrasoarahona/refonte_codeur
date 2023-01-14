<?php
$time = time();
if($user_premium == 0 and $user_type != "ADMIN"){
    $sql_allow_countries = " and ( allow like '%,$user_location,%' or allow like '$user_location,%' or allow like '%,$user_location') and `starttime` <= $time and $time <= `endtime` and premium = 0 ";
}else{
    $sql_allow_countries = " and ( allow like '%,$user_location,%' or allow like '$user_location,%' or allow like '%,$user_location') and `starttime` <= $time and $time <= `endtime` ";
}
?>

<section class="user-panel-body py-5">
    <div class="container">
        <div class="row">
            <?php include "include/leftmenu.php"; ?>
            <div class="col-xl-9 col-sm-8">
                <div class="user-panel-body-right">
                    <div id="mc" class="user-panel-tab-view mb-4">
                        <div class="shadow-sm rounded overflow-hidden mb-3">
                            <div class="p-4 bg-white">
                                <h5 class="mb-0">Offres</h5>
                            </div>
                            <hr class="m-0">
                            <div class="page-title-h5 align-items-center">
                                <form action="" method="post" name="filtre">
                                    <div class="row m-3">
                                        <div class="col-sm-4">
                                            <div class="js-form-message">
                                                <div class="form-group">
                                                    <input type="text" class="has-validation form-control" name="name" value="<?php echo $data['name']; ?>" placeholder="Nom">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="js-form-message">
                                                <div class="form-group">
                                                    <select class="form-control grp-add" name="grp">
                                                        <option value="NOPE" selected >Catégorie</option>
                                                        <?php
                                                        $query = "SELECT distinct grp FROM  offres";
    
                                                        $res = mysqli_query($conn, $query);
                                                        while($sel_data = mysqli_fetch_array($res)){
                                                            $cheked = "";
                                                            if($sel_data == $data['grp']){
                                                                $cheked = "selected";
                                                            }
                                                            echo '<option '.$cheked.' value="'.$sel_data['grp'].'">'.$sel_data['grp'].'</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="js-form-message">
                                                <div class="form-group">
                                                    <select class="form-control brand-add" name="brand">
                                                        <option value="NOPE" selected>Brand</option>
                                                        <?php
                                                        $query = "SELECT distinct brand FROM  offres";
    
                                                        $res = mysqli_query($conn, $query);
                                                        while($sel_data = mysqli_fetch_array($res)){
                                                            $cheked = "";
                                                            if($sel_data == $data['brand']){
                                                                $cheked = "selected";
                                                            }
                                                            echo '<option '.$cheked.' value="'.$sel_data['brand'].'">'.$sel_data['brand'].'</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
    
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="submit" class="btn btn-sm btn-primary " value="Rechercher">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div>
                            <?php if(!empty($_SESSION['userprofile']['error'])){ ?>
                                <div class="alert alert-danger"><?php echo $_SESSION['userprofile']['error']; $_SESSION['userprofile']['error'] = ""; ?></div>
                            <?php } ?>
                            <div class="row">
                                <?php
                                if(isset($_POST)){
                                    $name_filtre_in = mysqli_real_escape_string($conn, stripslashes($_POST['name']));
                                    $brand_filtre_in = mysqli_real_escape_string($conn, stripslashes($_POST['brand']));
                                    $grp_filtre_in = mysqli_real_escape_string($conn, stripslashes($_POST['grp']));

                                    $sql_filtre_ap = ""; $raise_filtre = false;
                                    if(!empty($name_filtre_in) and $name_filtre_in = ""){
                                        $sql_filtre_ap .= "name like '%{$name_filtre_in}%' and ";
                                        $raise_filtre = true;
                                    }
                                    if(!empty($brand_filtre_in) and $brand_filtre_in != "NOPE"){
                                        $sql_filtre_ap .= "brand = '{$brand_filtre_in}' and ";
                                        $raise_filtre = true;
                                    }
                                    if(!empty($grp_filtre_in) and $grp_filtre_in != "NOPE"){
                                        $sql_filtre_ap .= "grp = '{$grp_filtre_in}' and ";
                                        $raise_filtre = true;
                                    }
                                    if($raise_filtre){
                                        $sql_filtre_ap = substr($sql_filtre_ap,0,-5);
                                        $query_lc = "SELECT * FROM  offres WHERE $sql_filtre_ap $sql_allow_countries limit 30";
                                    }else{
                                        $lc_grp = "%";
                                        $query_lc = "SELECT * FROM  offres WHERE LOWER(grp) like '{$lc_grp}' $sql_allow_countries limit 30";
                                    }
                                }else{
                                    $lc_grp = "%";
                                    if(!empty($params)){
                                        $lc_grp = $params;
                                    }
                                    $lc_grp = strtolower($lc_grp);
                                    $query_lc = "SELECT * FROM  offres WHERE LOWER(grp) like '{$lc_grp}' $sql_allow_countries limit 30";
                                }

                                $user_id = $_SESSION['userprofile']['id'];
                                $day = date('d/m/Y');
                                $query = "SELECT data FROM  traces_offers  where idUser = $user_id and `day` = '{$day}' and offerwall = 'MISSION'  ";
                                $res_ltraces = mysqli_query($conn, $query);
                                $link_traces = array();
                                while ($ltraces_data = mysqli_fetch_array($res_ltraces)){
                                    array_push($link_traces,$ltraces_data['data']) ;
                                }
                                $res_lc = mysqli_query($conn, $query_lc);
                                $tot_offre = mysqli_num_rows($res_lc);
                                $tot_allow = 0;
                                if($tot_offre>0){

                                while ($lc_data = mysqli_fetch_array($res_lc)){

                                    $quota = intval($lc_data['quota']);
                                    $idOffre = intval($lc_data['id']);

                                    $query_offrequota = "SELECT * FROM `traces_offers` where `day` = '{$day}' and idUser = '$user_id}' and idOffre = '$idOffre}' limit 1";
                                    $res_offrequota = mysqli_query($conn, $query_offrequota);

                                    if(mysqli_num_rows($res_offrequota) < $quota){


                                    $time = time();
                                    $today = strtotime("today");
                                    $links = explode("\n",$lc_data['links']) ;
                                    $c_link = -1;
                                    foreach ($links as $k => $l){
                                        $pl = explode("|",$l);
                                        if(!in_array($pl[1],$link_traces)){
                                            $star_time_link = $today + intval(substr($pl[0],0,2))*3600 + intval(substr($pl[0],3,2))*60;
                                            $end_time_link = $today + intval(substr($pl[0],6,2))*3600 + intval(substr($pl[0],9,2))*60;

                                            if($star_time_link <= $time and $end_time_link >= $time  ){
                                                $c_link = $k;
                                                break;
                                            }
                                        }
                                    }
                                    if($c_link >= 0){
                                        $tot_allow++;
                                    ?>
                                    <div class="col-xl-4 col-sm-6 mb-4">
                                        <div class="stor-card custom-card shadow-sm h-100" data-toggle="modal" data-target="#offre_<?php echo $lc_data['id']; ?>">
                                            <div class="custom-card-image">
                                                <a href="#">
                                                    <img class="img-fluid item-img" src="<?php echo $base_url; ?>images/<?php echo $lc_data['cover']; ?>">
                                                    <?php if($lc_data['type'] == 1){ ?>
                                                    <div class="member-plan"><span class="badge badge-gold">Primum Member</span></div>
                                                    <?php } ?>
                                                </a>

                                                <div class="button-g-btn button-g-btn-up">
                                                    <img class="img-fluid" src="<?php echo $base_url; ?>images/<?php echo $lc_data['logo']; ?>">
                                                    <span><?php echo $lc_data['brand']; ?></span>
                                                </div>
                                            </div>
                                            <div class="p-3 pt-4">
                                                <div class="custom-card-body">
                                                    <h6 class="mb-3"><a class="text-black" href="#"><?php echo $lc_data['short_description']; ?></a></h6>
                                                    <p class="text-gray"><i class="icofont-tag"></i> <?php echo $lc_data['grp']; ?></p>
                                                </div>
                                                <div class="custom-card-footer mb-2">
                                                    <span class="text-primary"><i class="icofont-sale-discount"></i><?php echo $lc_data['val']; ?><?php echo $lc_data['currency']; ?></span>
                                                </div>
                                                <div class="mb-0">
                                                    <button class="btn btn-outline-danger btn-block" type="button" data-toggle="modal" data-target="#offre_<?php echo $lc_data['id']; ?>">Obtenir cette offre</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="offre_<?php echo $lc_data['id']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">

                                                    <h4 class="modal-title fs-5" id="staticBackdropLabel"><?php echo $lc_data['name']; ?></h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-xl-3 col-md-4 col-sm-12">
                                                            <img class="mb-3 user-cou-img w-100" src="<?php echo $base_url; ?>images/<?php echo $lc_data['logo']; ?>" alt="<?php echo $lc_data['name']; ?>">
                                                        </div>
                                                        <div class="col-xl-9 col-md-8 col-sm-12">
                                                            <div class="row">
                                                                <div class="col-xl-12 col-md-12 col-sm-12">
                                                                    <h6 class="d-block"><?php echo $lc_data['short_description']; ?></h6>
                                                                    <?php echo $lc_data['description']; ?>
                                                                </div>

                                                                <div class="text-success text-blod" role="alert">
                                                                    <span class="badge badge-success"><?php echo $lc_data['val']; ?><?php echo $lc_data['currency']; ?></span> Par Clic "CPC"
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <a class="btn btn-secondary" data-dismiss="modal">Fermer</a>
                                                    <a href="<?php echo $base_url."redirect/".$lc_data['id']."/".$c_link; ?>" class="btn btn-primary text-white" data-id="<?php echo $lc_data['id']; ?>" data-link="<?php echo $c_link; ?>" >Participer</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    }//end empty
                                    }//end quota
                                    } // end while
                                }// end if
                                ?>

                            </div>
                            <?php if($tot_offre == 0 or $tot_allow == 0 ){ ?>
                            <div class="alert alert-danger" role="alert">Aucune mission n'est disponible pour le moment !</div>
                            <?php } ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>