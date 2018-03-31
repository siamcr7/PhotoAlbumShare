<?php
include_once("../non-pages/php-include/top.php");

if(isset($_SESSION['publisher'])){
    header("location:" . $upFolderPlaceholder . "app/publisher/index.php");
    return;
}
?>
<h1>Login For Publisher</h1>

<form method="post" action="<?=$upFolderPlaceholder?>helper/login.php" >
    <label for="username">User Name: </label>
    <input name="username" type="text">
    <br>
    <br>

    <label for="password">Password: </label>
    <input name="password" type="password">
    <br>

    <input value="Login!" type="submit">
</form>