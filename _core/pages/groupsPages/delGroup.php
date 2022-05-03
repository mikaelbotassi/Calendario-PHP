<?php

include __DIR__."/../../db/grupoRepository.php";

if(count($_GET) > 0){

    $key = isset($_GET['id']) ? $_GET['id'] : "";

    if(count(getGroup($key)) <= 0){
        locationMsg('usuarios', 'erro1');
    }

    deleteGroup($key);

    echo "<p>Aguarde, excluindo...</p>";

    locationMsg('grupoList');

}