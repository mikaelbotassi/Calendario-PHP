<?php 
global $table, $CONFIG;
$title = 'PUBLICAÇÕES';
$imgField = 'img';
$busca = isset($_GET['busca']) ? $_GET['busca'] : "";
$search = "1=1";
if($busca != "") $search = "TITULO LIKE '%{$busca}%' OR AUTOR LIKE '%{$busca}%' OR DATA='%{$busca}%'";
$table = 'publicacao';
$fields = [
    [
        'field' => 'titulo',
        'size' => 6,
        'name' => 'Titulo'
    ],
    [
        'field' => 'autor',
        'size' => 4,
        'name' => 'Autor'
    ],
    [
        'field' => 'data',
        'size' => 2,
        'name' => 'Data'
    ],
];

    function saveForm($acao, $id){
        global $table, $CONFIG;
        $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : "";
        $subtitulo = isset($_POST['subtitulo']) ? $_POST['subtitulo']: "";
        $data = isset($_POST['data']) ? $_POST['data'] : "";
        $autor = isset($_POST['autor']) ? $_POST['autor'] : "";
        $nmImg = "";
        $texto = isset($_POST['texto']) ? $_POST['texto'] : "";
        $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : "";
        if($_FILES['img']['name'] != ""){
            $nmImg = md5(time())."_".$_FILES['img']['name'];
            if(!move_uploaded_file($_FILES['img']['tmp_name'], $CONFIG['rootPath']."uploads/publicacao/{$nmImg}"))
                $nmImg = "";
            else if($id > 0) deleteImg($table, $id, 'img');
        }
        $pub = [
                'titulo' => $titulo,
                'subtitulo' => $subtitulo,
                'data' => $data,
                'autor' => $autor,
                'img' => $nmImg,
                'texto' => $texto,
                'id_categoria' => $categoria
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
            <label for="titulo">Título</label>
            <input type="text" name="titulo" id="titulo" placeholder="Digite o título da publicação..." value="<?= isset($dados['titulo']) ? $dados['titulo'] : '' ?>" class="form-control" required>
        </div>
        <div>
            <label for="subtitulo">Subtítulo:</label>
            <input type="text" name="subtitulo" placeholder="Digite o título..." value="<?= isset($dados['subtitulo']) ? $dados['subtitulo'] : '' ?>" class="form-control" required>
        </div>
        <div class="w-25">
            <label for="data">Data:</label>
            <input type="date" name="data" id="data" value="<?= isset($dados['data']) ? $dados['data'] : '' ?>" placeholder="dd/mm/yyyy" class="form-control" required>
        </div>
        <div>
            <label for="autor">Autor:</label>
            <input type="text" name="autor" id="autor" value="<?= isset($dados['autor']) ? $dados['autor'] : '' ?>" placeholder="Digite o nome do autor..." class="form-control" required>
        </div>
        <div>
            <label for="imagem">Imagem:</label>
            <input type="file" name="img" id="imagem" value="<?= isset($dados['img']) ? $dados['img'] : '' ?>" placeholder="Selecione uma imagem" class="form-control" required>
        </div>
        <select class="form-select form-control" aria-label="Default select example">
            <?php foreach(getList('categoria') as $categoria){ ?>
                <option value="<?= $categoria['id'] ?>" <?= isset($dados['id_categoria']) && ($dados['id_categoria'] == $categoria['id']) ? "selected" : "" ?> > <?= $categoria['nome'] ?></option>
            <?php } ?>
        </select>
        <div>
            <label for="texto">Texto:</label>
            <textarea name="texto" class="form-control" id="texto" cols="90" rows="10" onkeypress="javascript:return verifica_qtd();"><?= isset($dados['texto']) ? $dados['texto'] : '' ?></textarea>
        </div>

        <script language="JavaScript" type="text/javascript">
        function verifica_qtd(){
            vQtd = document.getElementById('texto');
            if(vQtd.value.length >= 500){
                alert('maximo 500 caracteres');
                vQtd.focus();
                return false;
            }
        }
        </script>

    <?php }
    include_once __DIR__."/../inc/CRUD.php";
?>