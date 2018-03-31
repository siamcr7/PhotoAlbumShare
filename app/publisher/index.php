<?php
include_once("../../non-pages/php-include/top.php");
include_once($upFolderPlaceholder . 'app/publisher/auth.php');
?>
    <br>
    <form method="post" action="<?=$upFolderPlaceholder?>helper/publisher/addAlbum.php" >
        <label for="ablumName">New Album Name: </label>
        <input name="albumName"type="text">
        <input value="Add New Album!"type="submit">
    </form>
    <br>
    <br>


<?php

$arrayOfAlbums = getArrayOfInfo('userId',$_SESSION['publisher']['id'],'albums');
buildDynamicTable($arrayOfAlbums);

viewDynamicTableInHTML(false,true);



