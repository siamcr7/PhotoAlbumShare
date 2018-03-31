<?php
include_once($_SERVER['DOCUMENT_ROOT']. '/PhotoAlbumShare/' . 'app/headerInit.php');
if (isset($_SESSION['msg']) && $_SESSION['msg'] != '') {
    echo $_SESSION['msg'];
    $_SESSION['msg'] = '';
}
if(isset($_SESSION['publisher'])){
    header("location:" . $_SESSION['websiteName'] . "app/publisher/index.php");
    return;
}
?>
<h1>Login For Publisher</h1>

<form method="post" action="<?=$_SESSION['websiteName']?>helper/login.php" >
    <label for="username">User Name: </label>
    <input name="username" type="text">
    <br>
    <br>

    <label for="password">Password: </label>
    <input name="password" type="password">
    <br>

    <input value="Login!" type="submit">
</form>