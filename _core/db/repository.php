<?php
include_once __DIR__."/conexao.php";

function getList($table, $search="1=1"){

    $array = [];

    $connection = connectDB();

    $sql = "SELECT * FROM {$table} WHERE {$search}";

    $rs = mysqli_query($connection, $sql);

    if($rs->num_rows == 0) return $array;

    while($row = mysqli_fetch_assoc($rs)) $array[] = $row;

    return $array;

}

function deleteElement($table, $id){
    
    $connection = connectDB();

    $sql = "DELETE FROM {$table} WHERE id = {$id}";

    mysqli_query($connection, $sql);

}

function insertElement($table, $fields){
    
    $connection = connectDB();

    $keys = implode(",", array_keys($fields));

    $values = implode("','", $fields);

    $sql = "INSERT INTO {$table} ({$keys}) VALUES ('{$values}')";

    mysqli_query($connection, $sql);

}

function getFieldSet($fields){

    $fieldSets = "";
    
    foreach($fields as $key => $value) $fieldSets .= "{$key} = '{$value}',";

    $fieldSets = substr($fieldSets, 0, -1);

    return $fieldSets;
}

function updateElement($table, $fields, $id){
    
    $connection = connectDB();

    $sql = "UPDATE {$table} SET ".getFieldSet($fields)."
    WHERE id = {$id}";

    mysqli_query($connection, $sql);

}

function getElementById($table, $id){
    $array = getList($table, "id = {$id}");
    if(isset($array[0])) return $array[0];
    return [];
}