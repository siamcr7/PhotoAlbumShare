<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/PhotoAlbumShare/' . 'app/publisher/auth.php');
?>

<?php
unset($_SESSION['publisher']);
header("location:" . $_SESSION['websiteName'] . "public/login.php");