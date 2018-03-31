<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/PhotoAlbumShare/' . 'app/headerInit.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/PhotoAlbumShare/' . 'db/allDBFunction.php');
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $_SESSION['msg'] = '';
    if ($publisherID = getIdByInfo('username', $_POST['username'], 'users')) {
        $_SESSION['publisher'] = getRowByID($publisherID,'users');
        $_SESSION['msg'] .= 'Successfully Logged In!';
        $_SESSION['msg'] .= '<br>';
        header("location:" . $_SESSION['websiteName'] . "app/publisher/index.php");
        return;
    }
    else{
        $_SESSION['msg'] .= 'Invalid User name and password!';
        $_SESSION['msg'] .= '<br>';
    }
}
header("location:" . $_SESSION['websiteName'] . "public/login.php");
