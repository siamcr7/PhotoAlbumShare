<?php
include_once("../non-pages/php-include/top.php");
?>
<h1>Registration For Publisher</h1>

<form method="post" action="<?=$upFolderPlaceholder?>helper/register.php">
    <label for="username">User Name: </label>
    <input name="username" type="text">
    <br>
    <br>

    <label for="password">Password: </label>
    <input name="password" type="password">
    <br>

    <input value="Register!" type="submit">
</form>