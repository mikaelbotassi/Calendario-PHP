<?php
include_once __DIR__."/config.php";

function loadDates(){
    global $CONFIG;
    $arq = fopen($CONFIG['fileDatesPath'], 'r+');

    $dates=[];

    while($row=fgetcsv($arq,1024,";")){
        if($row[0] != "" && $row[1] != ""){
            $dates[] = [
                'data' => $row[0],
                'nome' => $row[1],
            ];
        }
    }
    fclose($arq);
    return $dates;
}

function saveDates($data){
    global $CONFIG;
    $arq = fopen($CONFIG['fileDatesPath'], 'a+');

    fputcsv($arq, $data, ";");

    fclose($arq);
}

function hasBday($dia, $mes, $datas){
    $dia = str_pad($dia, 2, "0", STR_PAD_LEFT);
    $mes = str_pad($mes, 2, "0", STR_PAD_LEFT);
    foreach($datas as $data)
        if($data['data'] == $dia.$mes) return $data['nome'];
    return "";
}

function loadLogins(){
    global $CONFIG;
    $arq = fopen($CONFIG['fileLoginsPath'], 'r+');

    $logins = [];

    while($row=fgetcsv($arq,1024,";")){
        if($row[0] != "" && $row[1] != ""){
            $logins += [
                $row[0] => [
                    'nome' => $row[2],
                    'email' => $row[3],
                    'senha' => $row[1],
                ]
            ];
        }
    }

    fclose($arq);

    return $logins;
}

function saveUsers($users){
    global $CONFIG;

    unlink($CONFIG['fileLoginsPath']);

    $file = fopen($CONFIG['fileLoginsPath'], 'a+');

    foreach($users as $login => $d){
        $string = "{$login};{$d['senha']};{$d['nome']};{$d['email']}";
        fwrite($file, $string.PHP_EOL);
    } 

    fclose($file);
}

function locationMsg($p, $msg="success"){
    echo '<script>
        location = "index.php?p='.$p.'&msg='.$msg.'";
    </script>';
    exit;
}

function showToastr($msg){
    if($msg!=""){
        if($msg=="success"){?>
            <div class = "my-toastr sucess" #toastr>
                    <p><?php
                    echo "OPERAÇÃO REALIZADA COM SUCESSO";
                    ?></p>
            </div>
        <?php }
        if($msg=="erro1"){?>
            <div class = "my-toastr warning" #toastr>
                    <p><?php
                    echo "USUÁRIO NÃO ENCONTRADO";
                    ?></p>
            </div>
        <?php }
        if($msg=="erro2"){?>
            <div class = "my-toastr warning" #toastr>
                    <p><?php
                    echo "ARQUIVO NÃO ENCONTRADO";
                    ?></p>
            </div>
        <?php }
    }
}