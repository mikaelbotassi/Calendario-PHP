<?php

include __DIR__."/../../db/grupoRepository.php";

if(count($_GET) > 0){
    global $CONFIG;
    $key = isset($_GET['id']) ? $_GET['id'] : "";

    if(count(getGroup($con, $key)) <= 0){
        locationMsg('usuarios', 'erro1');
    }

    deleteGroup($con, $key);

    echo "<p>Aguarde, excluindo...</p>";

    locationMsg('grupoList');

}