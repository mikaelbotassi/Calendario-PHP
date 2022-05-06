<?php 
global $table, $CONFIG, $imgField;
$title = 'SERVIÇOS';
$imgField = 'img';
$busca = isset($_GET['busca']) ? $_GET['busca'] : "";
$search = "1=1";
if($busca != "") $search = "nome LIKE '%{$busca}%'";
$table = 'servico';
$fields = [
    [
        'field' => 'nome',
        'size' => 6,
        'name' => 'Nome'
    ],
    [
        'field' => 'descricao',
        'size' => 4,
        'name' => 'Descrição'
    ],
    [
        'field' => 'img',
        'size' => 6,
        'name' => 'Imagem'
    ],
    [
        'field' => 'video',
        'size' => 6,
        'name' => 'Video'
    ]
];

    function saveForm($acao, $id){
        global $table, $CONFIG, $imgField;
        $nome = isset($_POST['nome']) ? $_POST['nome'] : "";
        $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : "";
        $img = isset($_POST['img']) ? $_POST['img'] : "";
        $nmImg = "";
        $video = isset($_POST['video']) ? $_POST['video'] : "";
        if($_FILES['img']['name'] != ""){
            $nmImg = md5(time())."_".$_FILES['img']['name'];
            if(!move_uploaded_file($_FILES['img']['tmp_name'], $CONFIG['rootPath']."uploads/{$table}/{$nmImg}"))
                $nmImg = "";
            else if($id > 0) deleteImg($table, $id, $imgField);
        }
        $pub = [
                'nome' => $nome,
                'descricao' => $descricao,
                'img' => $nmImg,
                'video' => $video,
        ];

        if($acao == 'add'){
            insertElement($table, $pub);
            return true;
        }

        else if($acao == 'edit'){
            updateElement($table, $pub, $id);
            return true;
        }
        
        return false;

    }

    function showForm($dados){?>

        <div>
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" placeholder="Digite o nome do serviço..." value="<?= isset($dados['nome']) ? $dados['nome'] : '' ?>" class="form-control" required>
        </div>
        <div class="w-25">
            <label for="descricao">Descricao:</label>
            <textarea name="descricao" id="descricao" cols="100" rows="10" class="form-control" onkeypress="javascript:return verifica_qtd();" required> <?= isset($dados['descricao']) ? $dados['descricao'] : '' ?> </textarea>
        </div>
        <div>
            <label for="imagem">Imagem:</label>
            <input type="file" name="img" id="imagem-servicos" value="<?= isset($dados['img']) ? $dados['img'] : '' ?>" placeholder="Selecione uma imagem" class="form-control" required>
        </div>
        <div>
            <label for="video">Vídeo:</label>
            <input type="text" name="video" class="form-control" id="video" placeholder="Digite o link do vídeo..." value="<?= isset($dados['video']) ? $dados['video'] : '' ?>">
        </div>

        <script language="JavaScript" type="text/javascript">
        function verifica_qtd(){
            vQtd = document.getElementById('descricao');
            if(vQtd.value.length >= 100){
                alert('maximo 100 caracteres');
                vQtd.focus();
                return false;
            }
        }
        </script>

    <?php }
    include_once __DIR__."/../inc/CRUD.php";
?>