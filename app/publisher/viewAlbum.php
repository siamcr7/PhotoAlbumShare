<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/PhotoAlbumShare/' . 'app/publisher/auth.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/PhotoAlbumShare/' . 'helper/dynamicTable/index.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/PhotoAlbumShare/' . 'db/allDBFunction.php');
if (isset($_SESSION['msg']) && $_SESSION['msg'] != '') {
    echo $_SESSION['msg'];
    $_SESSION['msg'] = '';
}
?>

<?php
if (!isset($_REQUEST['albumId'])) {
    $_SESSION['msg'] = 'Unauthorized Access!';
    header("location:" . $_SESSION['websiteName'] . "app/publisher/index.php");
    return;
}
if (getInfoByID($_REQUEST['albumId'], 'albums', 'userId') != $_SESSION['publisher']['id']) {
    $_SESSION['msg'] = 'Unauthorized Access!';
    header("location:" . $_SESSION['websiteName'] . "app/publisher/index.php");
    return;
}
?>

<br>
<br>
<form action="<?=$_SESSION['websiteName']?>helper/publisher/upload.php"
      method="post" enctype="multipart/form-data">
    Select image to upload:
    <input name="albumId" type="text" hidden value = "<?= $_REQUEST['albumId']?>">
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

<?php
$arrayOfPhotos = getArrayOfInfo('albumId',$_REQUEST['albumId'],'photos');
buildDynamicTable($arrayOfPhotos);

viewDynamicTableInHTML(false,false);
//echo $arrayOfPhotos[0]['url'];
?>
