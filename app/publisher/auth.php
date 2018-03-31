<?php
include_once("../../non-pages/php-include/top.php");
?>
<?php
if (!isset($_SESSION['publisher'])) {
    $_SESSION['msg'] = "Please Login!";
    header("location:" . $upFolderPlaceholder . "public/login.php");
}