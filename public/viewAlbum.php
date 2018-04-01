<?php
include_once("../non-pages/php-include/top.php");

if (!isset($_REQUEST['shareLink'])) {
    $_SESSION['msg'] = "Invalid Link!";
    header("location:" . $upFolderPlaceholder . "index.php");
    return;
}

?>


<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($albumId = getIdByInfo('shareLink', $_POST['shareLink'], 'albums')) {

        if (getInfoByID($albumId, 'albums', 'password') == $_POST['password']) {
            $arrayOfPhotos = getArrayOfInfo('albumId', $albumId, 'photos');
            buildDynamicTable($arrayOfPhotos);
            viewDynamicTableInHTML(false, false);
        } else {
            $_SESSION['msg'] = "Invalid Password! Please Copy Paste The Link Again!";
            header("location:" . $upFolderPlaceholder . "index.php");
        }

    } else {
        $_SESSION['msg'] = "Invalid Share Link! Please Copy Paste The Link Again!";
        header("location:" . $upFolderPlaceholder . "index.php");
    }


} else {
    /// password chao
    ?>

    <form method="post" action="viewAlbum.php">
        <input type="text" hidden name="shareLink" value= <?= $_REQUEST['shareLink'] ?>>
        <input type="password" name="password">
        <input type="submit" value="Submit Password!">
    </form>
    <?php
}


