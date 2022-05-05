<?php
  global $table;
  $title = 'CATEGORIAS';
  $busca = isset($_GET['busca']) ? $_GET['busca'] : "";
  $search = "1=1";
  if($busca != "") $search = "NOME LIKE '%{$busca}%'";
  $table = 'categoria';
  $fields = [
        [
            'field' => 'nome',
            'size' => 4,
            'name' => 'Nome'
        ]
    ];

    function saveForm($acao, $id){
        global $table;
        $nome = isset($_POST['nome']) ? $_POST['nome'] : ""; 
        $group = [
                'nome' => $nome
        ];

        if($acao == 'add'){
            insertElement($table, $group);
            locationMsg($_GET['p']);
            return true;
        }
       
        updateElement($table, $group, $id);
        locationMsg($_GET['p']);
        return false;

    }

    function showForm($dados){?>

        <div>
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome"  value="<?= isset($dados['nome']) ? $dados['nome'] : '' ?>" required>
        </div>

    <?php }
    include_once __DIR__."/../inc/CRUD.php";
    ?>