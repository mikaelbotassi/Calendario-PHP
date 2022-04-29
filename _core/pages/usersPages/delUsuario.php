<?php

if(count($_GET) > 0){
    global $CONFIG;
    $usuario = isset($_GET['login']) ? $_GET['login'] : "";
    $logins = loadLogins();

    if(!isset($logins[$usuario])){
        locationMsg('usuarios', 'erro1');
    }
    unset($logins[$usuario]);

    echo "<p>Aguarde, excluindo...</p>";

    saveUsers($logins);

    locationMsg('usuarios');

}

