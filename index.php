<?php
// error_reporting(E_ERROR | E_PARSE);
// ini_set("display_errors", 1);
ini_set("error_reporting", 0); //temporaire

if (in_array($_GET["page"], ["administration", "admin.php"])) {
    include($_SERVER["DOCUMENT_ROOT"] . "/" . $_GET["page"]);
    exit;
}

$Innerurllink = "./";
$Innerurllink = "http://127.0.0.1/";
// $Innerurllink = "https://gifthunter.fr/";
include('./include/Mobile_Detect.php');

$detect = new Mobile_Detect();
$isMobile = false;
if ($detect->isMobile()) {
    $detect_user =  "IS_MOBILE";
    $isMobile = true;
} else {
    $detect_user =  "IS_DESKTOP";
    $isMobile = false;
}

include('./include/header.php');
include('./include/config.php');
include_once('./requiert/php-global.php');

$page_name = "index";

if (isset($_GET['params'])) {
    $params = $_GET['params'];
}

if (isset($_GET['page'])) {

    $pretySlug = strtolower(str_replace(array(".html/", ".html"), "", $_GET['page']));

    $frame = "./pages/_frame-" . $pretySlug;
    $page_name = $pretySlug;
    if ($pretySlug == "logout") {
        $_SESSION["id"] = '';
        $_SESSION = array();
        unset($_SESSION);
        redirect($base_url);
        exit();
    }
} else {
    $frame = "./pages/_frame-index";
}

//var_dump($_SESSION);

if ($pretySlug == NULL) {
    $pretySlug = "";
}
if (!in_array($pretySlug, array("", "aide", "a-propos", "politique-de-confidentialités", "terms-conditions", "contact", "login", "register", "reset-user"))) {
    if (empty($_SESSION['id'])) {
        redirect($base_url);
    }
}

if (file_exists($frame . ".php")) {
    if (!in_array($pretySlug, array("login", "register", "reset-user", "group", "complete"))) {
        include('./include/navbar.php');
    }
    include($frame . ".php");
} else {
    $frame = "./pages/_frame-index";
    $page_name = "index";
    include('./include/navbar.php');
    include($frame . ".php");
}
if (!in_array($pretySlug, array("login", "register", "reset-user", "group", "complete"))) {
    include('./include/footer.php');
}

?>
<?php include('./include/endpage.php'); ?>