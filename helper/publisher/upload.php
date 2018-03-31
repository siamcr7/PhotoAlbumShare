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
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $target_dir = $_SERVER['DOCUMENT_ROOT'] . $_SESSION['websiteName'] . 'resources/images/';

    $photoName = explode('.', basename($_FILES["fileToUpload"]["name"]))[0];

    $uniqueName = generateRandomString(123);
    $urlStr = $target_dir . $uniqueName;

    while (getIdByInfo('url', $urlStr, 'photos') != 0) {
        $uniqueName = generateRandomString(123);
        $urlStr = $target_dir . $uniqueName;
    }

    $imageFileType = strtolower(pathinfo($target_dir . basename($_FILES["fileToUpload"]["name"])
        , PATHINFO_EXTENSION));

    $urlStr .= '.';
    $urlStr .= $imageFileType;

    $target_file = $urlStr;
    $urlStr = $_SESSION['websiteName'] . 'resources/images/' . $uniqueName . '.' .$imageFileType;

    $uploadOk = 1;


// Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $_SESSION['msg'] = '';
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
//        $_SESSION['msg'] .= "File is an image - " . $check["mime"] . ".";
//        $_SESSION['msg'] .= '<br>';
            $uploadOk = 1;
        } else {
            $_SESSION['msg'] .= "File is not an image.";
            $_SESSION['msg'] .= '<br>';
            $uploadOk = 0;
        }
    }
// Check if file already exists
    if (file_exists($target_file)) {
        $_SESSION['msg'] .= "Sorry, file already exists.";
        $_SESSION['msg'] .= '<br>';
        $uploadOk = 0;
    }
// Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        $_SESSION['msg'] .= "Sorry, your file is too large.";
        $_SESSION['msg'] .= '<br>';
        $uploadOk = 0;
    }
// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        $_SESSION['msg'] .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $_SESSION['msg'] .= '<br>';
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $_SESSION['msg'] .= "Sorry, your file was not uploaded. Please try again!";
        $_SESSION['msg'] .= '<br>';

// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

            $insData = array();
            $insData['albumId'] = $_REQUEST['albumId'];
            $insData['photoName'] = "'" . $photoName . "'";
            $insData['url'] = "'" . $urlStr . "'";

            if (insert($insData, 'photos')) {
                $_SESSION['msg'] .= "The file " . $photoName . " has been uploaded.";
                $_SESSION['msg'] .= '<br>';
            } else {
                $_SESSION['msg'] .= "Something went wrong! Please try again!";
                $_SESSION['msg'] .= '<br>';
            }


        } else {
            $_SESSION['msg'] .= "Something went wrong! Please try again!";
            $_SESSION['msg'] .= '<br>';
        }
    }
    header("location:" . $_SESSION['websiteName'] . "app/publisher/viewAlbum.php?albumId="
        . $_REQUEST['albumId']);
    return;
}
header("location:" . $_SESSION['websiteName'] . "app/publisher/index.php");

