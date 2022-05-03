<?php
include_once __DIR__."/conexao.php";

function getList($table, $search="1=1"){

    $array = [];

    $connection = connectDB();

    $sql = "SELECT * FROM {$table} WHERE {$search}";

    $rs = mysqli_query($connection, $sql);

    if($rs->num_rows == 0){
        echo "Nenhum registor encontrado";
        return false;
    }

    while($row = mysqli_fetch_assoc($rs)) $array[] = $row;

    return $array;

}