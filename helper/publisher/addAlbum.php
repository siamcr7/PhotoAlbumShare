<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/PhotoAlbumShare/' . 'app/headerInit.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/PhotoAlbumShare/' . 'db/allDBFunction.php');
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $_SESSION['msg'] = '';
    if (strlen($_POST['albumName']) == 0) {
        $_SESSION['msg'] .= 'Album Name Can not be Empty!';
        $_SESSION['msg'] .= '<br>';
    }

    if ($_SESSION['msg'] == '') {
        /// insert
        $insArr = array();
        $insArr['userId'] = $_SESSION['publisher']['id'];
        $insArr['albumName'] = "'".$_POST['albumName']."'";
        $insArr['shareLink'] = "'".$_POST['albumName']."'";
        if (insert($insArr, 'albums')) {
            $_SESSION['msg'] .= 'Successfully Added an Album!';
            $_SESSION['msg'] .= '<br>';
        } else {
            $_SESSION['msg'] .= 'Something went wrong! Please try again!';
            $_SESSION['msg'] .= '<br>';
        }
    }
}
header("location:" . $_SESSION['websiteName'] . "app/publisher/index.php");
