<?php
//include_once("../non-pages/php-include/top.php"); /// please check here again!
include_once('conn.php');
?>

<?php
/// $_SESSION['db'] is my database for now;
function getFullTable($tableName) /// returns full table
{
    createCon();
    global $conn;
    $sql = "SELECT * FROM " . $tableName;
    $result = mysqli_query($conn, $sql);
    $ret = array();
    $rowCount = 0;
    while (($row = mysqli_fetch_assoc($result)) != null) {
        $ret[$rowCount++] = $row;
    }
    closeCon();
    return ($ret);
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

function getArrayOfInfo($colName,$colVal,$tableName)
{
    $ret = getFullTable($tableName);
    $retArr = array();
    $iCnt = 0;
    foreach($ret as $item)
    {
        $idMatch = false;
        foreach($item as $key => $value)
        {
            if($key == $colName && $value == $colVal)$idMatch = true;
        }

        if($idMatch)
        {
            $newItem = array();
            foreach($item as $key => $value)
            {
                if($key == $colName)continue;
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

    $columns = implode(", ", array_keys($insData));
    $values = implode(", ", array_values($insData));



    $sql = "INSERT INTO $tableName ($columns) VALUES ($values)";

    createCon();
    global $conn;
    $result = mysqli_query($conn, $sql);
    closeCon();
    return $result;
}
