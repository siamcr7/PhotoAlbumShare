<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/PhotoAlbumShare/' . 'app/headerInit.php');
?>
<h1>Welcome To The Photo Album Sharing Service</h1>

<h2><a href=<?= $_SESSION['websiteName'] . "public/register.php" ?>>Register As Publisher</a></h2>
<h2><a href=<?= $_SESSION['websiteName'] . "public/login.php" ?>>Login</a></h2>

