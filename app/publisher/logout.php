<?php
include_once("../../non-pages/php-include/top.php");
include_once($upFolderPlaceholder . 'app/publisher/auth.php');
?>

<?php
unset($_SESSION['publisher']);
header("location:" . $upFolderPlaceholder . "public/login.php");