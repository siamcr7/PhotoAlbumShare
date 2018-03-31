<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/PhotoAlbumShare/' . 'app/headerInit.php');
?>
<?php
if (!isset($_SESSION['publisher'])) {
    $_SESSION['msg'] = "Please Login!";
    header("location:" . $_SESSION['websiteName'] . "public/login.php");
}