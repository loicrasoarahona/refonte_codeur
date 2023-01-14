<?php
session_start();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Pannel administration</title>
		<?php
		if(headers_sent()){
		?>
			<script>
				window.location=<?= explode('/',$_SERVER['PHP_SELF'])[2]   ?>;
		</script>
		
		<?php
		}else{
			if(!isset($_SESSION['admin']['id'])){
		?>
			<script>
			</script>
		<?php
			}
		}
		?>
		<meta name="author" content="MOREAU&CO SPRL" />
		<link rel="icon" type="image/png" href="../images/icon.png">
		<!-- Propriété iPhone -->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		<!-- CSS -->
        <link type="text/css" rel="stylesheet" href="../css/styleAdmin.css" /><!-- emerald dragon -->
		<script src="https://cdn.ckeditor.com/ckeditor5/22.0.0/classic/ckeditor.js"></script>
	    <!-- Ancient CSS -->
        <!-- Javascript -->
  <!-- Custom fonts for this template-->
		<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

		<!-- Custom styles for this template-->
		<link href="css/sb-admin-2.min.css" rel="stylesheet">
		<link href="vendor/fontawesome-free/css/all.css" rel="stylesheet">
		<link href="css/cashbackengine.css" rel="stylesheet">
		<script src="../js/sweetalert.min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<style>

					body{
						overflow-x:hidden;
					}
					
					.ck.ck-content ul,
					.ck.ck-content ul li {
						list-style-type: inherit;
					}

					.ck.ck-content ul {
						padding-left: 40px;
					}

					.ck.ck-content ol {
						list-style-type: block;
					}

					.ck.ck-content h1 {
						color:black;
						text-align: start;
					}
					.ck.ck-content h2 {
						color:black;
						text-align: start;
					}
					.ck.ck-content h3{
						color:black;
						text-align: start;
					}

					.Ancien_io{
						display:none;
					}

					.code_io{
						display: none;
					}
}
			</style>
	</head>
	<body  >