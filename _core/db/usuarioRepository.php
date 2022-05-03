<?php

include_once __DIR__."/conexao.php";

function getUsers(){
    $connection = connectDB();

    $rs = mysqli_query($connection,
    "SELECT * FROM USUARIO");

    $users = [];

    if($rs->num_rows > 0)
        while($row = mysqli_fetch_assoc($rs)) $users[] = $row;

    return $users;

}

function getUserById($id){
    
    $connection = connectDB();

    $id=(int)$id+0;

    $query = "SELECT * FROM USUARIO WHERE ID = {$id}";

    $row = [];

    $rs = mysqli_query($connection, $query);

    if($rs->num_rows > 0) $row = mysqli_fetch_assoc($rs);

    return $row;
}

function insertUser($user){
    
    $connection = connectDB();

    $query = "INSERT INTO USUARIO(LOGIN, NOME, EMAIL, SENHA, ATIVO) VALUES ('{$user['login']}',
    '{$user['login']}','{$user['email']}', '{$user['senha']}', 1 )";

    mysqli_query($connection, $query);
}

function updateUser($user){

    $connection = connectDB();

    $query = "UPDATE USUARIO
    SET
    nome = '{$user['nome']}',
    email = '{$user['email']}',
    senha = '{$user['senha']}',
    ativo = {$user['ativo']}
    WHERE id = {$user['id']}";

    mysqli_query($connection, $query);

}

function deleteUserById($id){

    $connection = connectDB();

    $query = "UPDATE USUARIO
    SET ativo = 0
    WHERE id = {$id}";

    mysqli_query($connection, $query);

}

function getUserByLogin($login){
    $connection = connectDB();

    $query = "SELECT * FROM USUARIO WHERE LOGIN LIKE '{$login}'";

    $row = [];

    $rs = mysqli_query($connection, $query);

    if($rs->num_rows > 0) $row = mysqli_fetch_assoc($rs);

    return $row;
}