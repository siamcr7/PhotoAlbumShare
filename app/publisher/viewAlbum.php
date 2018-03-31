<?php
include_once("../../non-pages/php-include/top.php");
include_once($upFolderPlaceholder . 'app/publisher/auth.php');
?>

<?php
if (!isset($_REQUEST['albumId'])) {
    $_SESSION['msg'] = 'Unauthorized Access!';
    header("location:" . $upFolderPlaceholder . "app/publisher/index.php");
    return;
}
if (getInfoByID($_REQUEST['albumId'], 'albums', 'userId') != $_SESSION['publisher']['id']) {
    $_SESSION['msg'] = 'Unauthorized Access!';
    header("location:" . $upFolderPlaceholder . "app/publisher/index.php");
    return;
}
?>

<br>
<br>
<form action="<?=$upFolderPlaceholder?>helper/publisher/upload.php"
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
