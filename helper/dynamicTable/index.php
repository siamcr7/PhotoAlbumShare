<?php
//session_start();

/*
How it works:
<?php if(condition){ ?>
 <!-- HTML here -->
<?php } ?>
*/

/*
/// some temp data
$iCnt = 0;
$user["name"] = "abc";
$user["email"] = "abc@abc";
$userList[$iCnt++] = $user;

$user["name"] = "anda";
$user["email"] = "anda@abc";
$userList[$iCnt++] = $user;

$user["name"] = "andapanda";
$user["email"] = "andddasda@abc";
$userList[$iCnt++] = $user;
*/

$_SESSION["dynamicTable"] = array();
function buildDynamicTable($givenArr)
{
    $_SESSION["dynamicTable"] = $givenArr;
}

function viewDynamicTableInPHP()
{
    foreach ($_SESSION["dynamicTable"] as $curItem) {
        foreach ($curItem as $key => $value) {
            echo "{$key} : {$value} <br>";
        }
        echo "<br>";
    }
}

$_SESSION["setNextEditPage"] = "editProfilePage.php";
$_SESSION["setNextViewPage"] = "viewAlbum.php";
function setNextEditPage($str)
{
    $_SESSION["setNextEditPage"] = $str;
}

function setNextViewPage($str)
{
    $_SESSION["setNextViewPage"] = $str;
}

function viewDynamicTableInHTML($withEditOption = false, $withViewOption = false)
{
    if (true) {
        ?>
        <table style=width:100% , border=1>

            <?php
            $firstRow = true;
            foreach ($_SESSION["dynamicTable"] as $curItem) {
                ?>

                <?php
                if ($firstRow) {
                    ?>
                    <tr>
                        <?php
                        foreach ($curItem as $key => $value) {
                            if ($key == 'id') continue;
                            ?>
                            <th><?= $key; ?></th>
                            <?php
                        }
                        ?>
                    </tr>
                    <?php
                }
                $firstRow = false;
                ?>
                <tr>
                    <?php
                    $saveId = 0;
                    foreach ($curItem as $key => $value) {
                        if ($key == 'id') {
                            $saveId = $value;
                            continue;
                        }
                        if ($key == 'url') {
                            global $upFolderPlaceholder;
                            ?>
                            <td><img src= <?= $upFolderPlaceholder . $value; ?> height = 150 width = 300 />
                            </td>
                            <?php
                            continue;
                        }
                        ?>
                        <td><?= $value; ?></td>
                        <?php
                    }
                    if (!$firstRow) {
                        if ($withEditOption) {
                            ?>

                            <td><a href=<?= $_SESSION["setNextEditPage"]; ?>>Edit</a></td>
                            <?php
                        }
                        if ($withViewOption) {
                            ?>
                            <td><a href=<?= $_SESSION["setNextViewPage"] . '?albumId=' . $saveId; ?>>Album Details</a>
                            </td>
                            <?php
                        }
                    }
                    ?>
                </tr>
                <?php
            }
            ?>

        </table>

        <?php
    }
}

/*
buildDynamicTable($userList);
viewDynamicTableInHTML();
*/
?>




