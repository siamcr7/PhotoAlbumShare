<?php
include_once("../non-pages/php-include/top.php");
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $_SESSION['msg'] = '';
    if (strlen($_POST['username']) == 0) {
        $_SESSION['msg'] .= 'User Name Can not be Empty!';
        $_SESSION['msg'] .= '<br>';
    }
    if (strlen($_POST['password']) == 0) {
        $_SESSION['msg'] .= 'Password Can not be Empty!';
        $_SESSION['msg'] .= '<br>';
    }

    if (getIdByInfo('username', $_POST['username'], 'users')) {
        $_SESSION['msg'] .= 'User Name Already Exists!';
        $_SESSION['msg'] .= '<br>';
    }

    if ($_SESSION['msg'] == '') {
        /// insert
        $insArr = array();
        $insArr['username'] = "'".$_POST['username']."'";
        $insArr['password'] = "'".$_POST['password']."'";
        if (insert($insArr, 'users')) {
            $_SESSION['msg'] .= 'Successfully Registered!';
            $_SESSION['msg'] .= '<br>';
        } else {
            $_SESSION['msg'] .= 'Something went wrong! Please try again!';
            $_SESSION['msg'] .= '<br>';
        }
    }
}
header("location:" . $upFolderPlaceholder . "public/register.php");
