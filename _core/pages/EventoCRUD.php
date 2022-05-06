<?php
  global $table;
  $title = 'EVENTOS';
  $busca = isset($_GET['busca']) ? $_GET['busca'] : "";
  $search = "1=1";
  if($busca != "") $search = "NOME LIKE '%{$busca}%'";
  $table = 'evento';
  $fields = [
        [
            'field' => 'descricao',
            'size' => 6,
            'name' => 'Descricao'
        ],
        [
            'field' => 'data',
            'size' => 2,
            'name' => 'Data'
        ],
    ];

    function saveForm($acao, $id){
        global $table;
        $descricao = isset($_POST['descricao']) ? $_POST['descricao']: "";
        $data = isset($_POST['data']) ? $_POST['data'] : "";
        $evento = [
            'descricao' => $descricao,
            'data' => $data
        ];
        if($acao == 'add'){
            insertElement($table, $evento);
            locationMsg($_GET['p']);
            return true;
        }
        unset($user['login']);
        updateElement($table, $evento, $id);
        locationMsg($_GET['p']);
        return false;

    }

    function showForm($dados){?>

        <div>
            <label for="nome">Descrição:</label>
            <textarea type="text" name="descricao" placeholder="Digite a descrição do evento..." class="form-control" required><?=isset($dados['descricao']) ? $dados['descricao'] : '' ?></textarea>
        </div>
        <div>
            <label for="data">Data:</label>
            <input type="date" name="data" id="data-evento"  value="<?= isset($dados['data']) ? $dados['data'] : '' ?>" placeholder="dd/mm/aaaa" class="form-control" required>
        </div>

        <script language="JavaScript" type="text/javascript">
        function verifica_qtd(){
            vQtd = document.getElementById('texto');
            if(vQtd.value.length >= 100){
                alert('maximo 500 caracteres');
                vQtd.focus();
                return false;
            }
        }
        </script>

    <?php }
    include_once __DIR__."/../inc/CRUD.php";
    ?>