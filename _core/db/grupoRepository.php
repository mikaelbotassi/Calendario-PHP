<?php

function getGroups($connection){
    $query = "SELECT * FROM GRUPO";
    $array = [];

    $rs = mysqli_query($connection, $query);

    if($rs->num_rows > 0){
        while($row = mysqli_fetch_assoc($rs)){
            $array[] = $row;
        }
    }
    return $array;
}

function getGroup($connection, $id){

    $id=(int)$id+0;

    $query = "SELECT * FROM GRUPO WHERE ID = {$id}";

    $row = [];

    $rs = mysqli_query($connection, $query);

    if($rs->num_rows > 0) $row = mysqli_fetch_assoc($rs);

    return $row;

}

function insertGroup($connection, $group){

    $query = "INSERT INTO GRUPO(NOME) VALUES ('{$group['nome']}')";

    mysqli_query($connection, $query);

}

function updateGroup($connection, $group){

    $query = "UPDATE GRUPO
    SET NOME = '{$group['nome']}'
    WHERE id = {$group['id']}";

    mysqli_query($connection, $query);

}

function deleteGroup($connection, $id){

    $query = "DELETE FROM GRUPO WHERE ID = {$id}";

    mysqli_query($connection, $query);

}