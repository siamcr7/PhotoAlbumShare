<?php
if (session_id() == "") session_start();
$_SESSION['websiteName'] = '/PhotoAlbumShare/';
include_once($_SERVER['DOCUMENT_ROOT'] . '/PhotoAlbumShare/' . 'helper/index.php');
?>

    <p align="Left">
        <a href="<?= $_SESSION['websiteName'] . "index.php" ?>">Home</a>
    </p>

<?php
if (isset($_SESSION['publisher'])):?>
    <p align="right">
        <a href="<?= $_SESSION['websiteName'] . "app/publisher/logout.php" ?>">Logout!</a>
    </p>
    <?php
endif;


?>