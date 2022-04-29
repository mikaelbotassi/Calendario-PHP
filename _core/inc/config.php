<?php

session_start();

$CONFIG = [
    'title' => "Calendário",
    'fileDatesPath' => __DIR__."/../db/datas.txt",
    'fileLoginsPath' => __DIR__."/../db/logins.txt",
    'fileGroupsPath' => __DIR__."/../db/grupos.txt",
    'fileSequenceGroupPath' => __DIR__."/../db/sequenceIdGroup.txt",
    'arrayMonth' => ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
    'arrayWeek' => ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"],
    'directories' => [
        'usuarios' => "usersPages/usuarios.php",
        'usuario' => "usersPages/usuario.php",
        'delUsuario' => "usersPages/delUsuario.php",
        '404' => "defaultPages/404.php",
        'home' => "defaultPages/home.php",
        "login" => "defaultPages/login.php",
        'grupoList' => 'groupsPages/grupoList.php'
        ]
];