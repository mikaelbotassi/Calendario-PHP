<?php

    include_once __DIR__."/functions.php";

    $sessao = isset($_SESSION['logado']) ? $_SESSION['logado'] : false;

    if($sessao == false){
        header("Location: index.php?p=login");
        exit;
    }