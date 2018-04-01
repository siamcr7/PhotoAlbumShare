<?php
//include_once("../non-pages/php-include/top.php"); /// please check here again!
include_once('conn.php');
?>

<?php
function getFullTable($tableName) /// returns full table
{
//    createCon();
//    global $conn;
//    $sql = "SELECT * FROM " . $tableName;
//    $result = mysqli_query($conn, $sql);
//    $ret = array();
//    $rowCount = 0;
//    while (($row = mysqli_fetch_assoc($result)) != null) {
//        $ret[$rowCount++] = $row;
//    }
//    closeCon();
//    return ($ret);

//    var_dump($ret);

    global $upFolderPlaceholder;
    $lines = file($upFolderPlaceholder . '/db/' . $tableName . '.txt');

    $iCnt = 0;
    $ret = array();
    $colName = array();
    foreach ($lines as $line) {
        $line = trim($line);
        if ($iCnt == 0) {
            $colNames = explode(',', $line);
            $colName['id'] = '';
            foreach ($colNames as $value) {
                $colName[$value] = '';
            }
        } else {
            $colName['id'] = $iCnt;
            $colValues = explode(',', $line);
            $tempCnt = 0;
            foreach ($colName as $key => $value) {
                if ($key == 'id') continue;
                $colName[$key] = $colValues[$tempCnt++];
            }
            $ret[$iCnt - 1] = $colName;
        }
        $iCnt++;
    }
//    var_dump($ret);
//    exit;
    return $ret;
}

/// returns the value of the colName against that id in that table
function getInfoByID($id, $tableName, $colName)
{
    $ret = getFullTable($tableName);
    foreach ($ret as $item) {
        $idMatch = false;
        foreach ($item as $key => $value) {
            if ($key == "id" && $value == $id) $idMatch = true;
            if ($idMatch && $key == $colName) return $value;
        }
    }
    return "";
}


function getRowByID($id, $tableName)
{
    $ret = getFullTable($tableName);
    foreach ($ret as $item) {
        $idMatch = false;
        foreach ($item as $key => $value) {
            if ($key == "id" && $value == $id) $idMatch = true;
        }
        if ($idMatch) return $item;
    }
    return "";
}

function getIdByInfo($colName, $colVal, $tableName)
{
    $ret = getFullTable($tableName);
    foreach ($ret as $item) {
        $idMatch = 0;
        foreach ($item as $key => $value) {
            if ($key == "id") $idMatch = $value;
            if ($key == $colName && $value == $colVal) return $idMatch;
        }
    }
    return 0;
}

function getArrayOfInfo($colName, $colVal, $tableName)
{
    $ret = getFullTable($tableName);
    $retArr = array();
    $iCnt = 0;
    foreach ($ret as $item) {
        $idMatch = false;
        foreach ($item as $key => $value) {
            if ($key == $colName && $value == $colVal) $idMatch = true;
        }

        if ($idMatch) {
            $newItem = array();
            foreach ($item as $key => $value) {
                if ($key == $colName) continue;
                $newItem[$key] = $value;
            }
            $retArr[$iCnt++] = $newItem;
        }
    }
    return ($retArr);
}


// DML
function insert($insData, $tableName)
{
    /*
    Give this array to this function
    $insArr = array();
    $insArr["name"] = "'Beverage'";
    $res = insert($insArr,"catagory");
    var_dump($res);
    */

//    $columns = implode(", ", array_keys($insData));
//    $values = implode(", ", array_values($insData));


//    $sql = "INSERT INTO $tableName ($columns) VALUES ($values)";

//    createCon();
//    global $conn;
//    $result = mysqli_query($conn, $sql);
//    closeCon();
//    return $result;


    global $upFolderPlaceholder;
    foreach ($insData as $key => $value) {
        $insData[$key] = str_replace("'", "", $value);
    }
    $values = implode(",", array_values($insData));
    $myFile = file_put_contents($upFolderPlaceholder . '/db/' . $tableName . '.txt', $values . PHP_EOL, FILE_APPEND | LOCK_EX);
    return $myFile;
}
