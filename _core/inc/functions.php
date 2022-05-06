<?php
include_once __DIR__."/config.php";
include_once __DIR__."/../db/repository.php";

function hasEvent($dia,$mes,$ano, $events){
    $dia = str_pad($dia, 2, "0", STR_PAD_LEFT);
    $mes = str_pad($mes, 2, "0", STR_PAD_LEFT);
    $data = $ano.'-'.$mes.'-'.$dia;

    foreach($events as $event)
        if($event['data'] == $data) return $event['descricao'];
    return "";
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

function getMaior($fields){
    $maior = -9999;

    foreach($fields as $field)
        if($field['size'] > $maior) $maior = $field['size'];

    return $maior;

}

function tableList($table, $fields, $search="1=1"){

    $array = getList($table, $search);

    if(count($array) <= 0) echo "NENHUM REGISTRO ENCONTRADO";
    
    else{
        foreach($array as $element){ ?>

        <article class="card card-usuario col-sm-<?=getMaior($fields)?>">
                <div class="card-body card-usuario">
                    <?php foreach($fields as $field){
                        if($field['field'] == 'data')
                            $element[$field['field']] = convertDate($element[$field['field']], "d-m-Y");
                        ?>
                        <h4 class="card-title"><?= strtoupper($element[$field['field']]) ?></h4>
                    <?php } ?>
                    <div id="button-group-usuario">
                        <a href="index.php?p=<?=$_GET['p']?>&id=<?=$element['id']?>&acao=edit" class="btn btn-primary my-btn-primary">EDITAR</a>
                        <button onclick="if(confirm('Deseja realmente excluir o usuario?')){location='index.php?p=<?=$_GET['p']?>&acao=del&id=<?=$element['id']?>'}" class="btn btn-danger">EXCLUIR</button>
                    </div>
                </div>
        </article>


<?php   }
    }

}

function deleteImg($table,$id,$field){
    global $CONFIG;
    $img=getList($table, "ID={$id} AND {$field} <>''");
    if(count($img) > 0){
        unlink($CONFIG['rootPath']."uploads/publicacao/{$img[0][$field]}");
    }
}

function tableDel($table, $id, $field=""){
    if($field != '') deleteImg($table,$id,$field);
    deleteElement($table, $id);
}

function convertDate($data, $format){
    $data = new DateTime($data);
    return $data->format($format);
}