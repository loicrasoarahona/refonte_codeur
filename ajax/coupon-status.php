<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {


    if (isset($_POST['action']) && !empty($_POST['action'])) {
        include_once '../include/config.php';
        $user_type = $_SESSION['userprofile']['type'];
        if($user_type != "ADMIN"){
            exit("Error");
        }
        $action = stripslashes($_POST['action']);
        $action = mysqli_real_escape_string($conn, $action);

        $coupon = stripslashes($_POST['coupon']);
        $coupon = mysqli_real_escape_string($conn, $coupon);

        if($action == "Masquer"){
            $s = 1;
            if(mysqli_query($conn,"UPDATE coupons SET status=$s WHERE id='{$coupon}' limit 1")){
                exit("Correct");
            }
        }elseif($action == "Supprimer"){
            if(mysqli_query($conn,"DELETE FROM coupons WHERE id='{$coupon}' limit 1")){
                exit("Correct");
            }
        }

    }

}