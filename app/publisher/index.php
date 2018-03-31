<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/PhotoAlbumShare/' . 'app/publisher/auth.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/PhotoAlbumShare/' . 'helper/dynamicTable/index.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/PhotoAlbumShare/' . 'db/allDBFunction.php');
if (isset($_SESSION['msg']) && $_SESSION['msg'] != '') {
    echo $_SESSION['msg'];
    $_SESSION['msg'] = '';
}
?>
    <p align="right">
    <a href="<?= $_SESSION['websiteName'] . "app/publisher/logout.php" ?>">Logout!</a>
    </p>
    <br>
    <form method="post" action="<?=$_SESSION['websiteName']?>helper/publisher/addAlbum.php" >
        <label for="ablumName">New Album Name: </label>
        <input name="albumName"type="text">
        <input value="Add New Album!"type="submit">
    </form>
    <br>
    <br>


<?php

buildDynamicTable(getArrayOfInfo('userId',$_SESSION['publisher']['id'],'albums'));
viewDynamicTableInHTML();



