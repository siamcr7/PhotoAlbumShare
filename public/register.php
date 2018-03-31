<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/PhotoAlbumShare/' . 'app/headerInit.php');

if (isset($_SESSION['msg']) && $_SESSION['msg'] != '') {
    echo $_SESSION['msg'];
    $_SESSION['msg'] = '';
}

?>
<h1>Registration For Publisher</h1>

<form method="post" action="<?= $_SESSION['websiteName'] ?>helper/register.php">
    <label for="username">User Name: </label>
    <input name="username" type="text">
    <br>
    <br>

    <label for="password">Password: </label>
    <input name="password" type="password">
    <br>

    <input value="Register!" type="submit">
</form>