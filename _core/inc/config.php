<?php

session_start();

$CONFIG = [
    'title' => "Calendário",
    'rootPath' => __DIR__."/../../",
    'fileDatesPath' => __DIR__."/../db/datas.txt",
    'fileLoginsPath' => __DIR__."/../db/logins.txt",
    'fileGroupsPath' => __DIR__."/../db/grupos.txt",
    'fileSequenceGroupPath' => __DIR__."/../db/sequenceIdGroup.txt",
    'arrayMonth' => ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
    'arrayWeek' => ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"],
    'directories' => [
        '404' => "defaultPages/404.php",
        'home' => "defaultPages/home.php",
        'servico' => "ServicoCRUD.php",
        'evento' => "EventoCRUD.php",
        "login" => "defaultPages/login.php",
        'usuario' => "UsuarioCRUD.php",
        'grupo' => 'GrupoCRUD.php',
        'categoria' => 'CategoriaCRUD.php',
        'publicacao' => 'PublicacaoCRUD.php'
    ]
];