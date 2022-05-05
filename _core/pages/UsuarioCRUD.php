<?php
  global $table;
  $title = 'USUARIOS';
  $busca = isset($_GET['busca']) ? $_GET['busca'] : "";
  $search = "ativo=1";
  if($busca != "") $search = "NOME LIKE '%{$busca}%' OR EMAIL LIKE '%{$busca}%' AND ATIVO=1";
  $table = 'usuario';
  $fields = [
        [
            'field' => 'login',
            'size' => 4,
            'name' => 'Login'
        ],
        [
            'field' => 'nome',
            'size' => 4,
            'name' => 'Login'
        ],
        [
            'field' => 'email',
            'size' => 4,
            'name' => 'Email'
        ],
    ];

    function saveForm($acao, $id){
        global $table;
        $login = isset($_POST['login']) ? $_POST['login'] : "";
        $nome = isset($_POST['nome']) ? $_POST['nome']: "";
        $email = isset($_POST['email']) ? $_POST['email'] : "";
        $senha = isset($_POST['senha']) ? $_POST['senha'] : "";
        $user = [
            'login' => $login,
            'nome' => $nome,
            'email' => $email,
            'senha' => $senha,
            'ativo' => 1
        ];
        if($acao == 'add'){
            insertElement($table, $user);
            locationMsg($_GET['p']);
            return true;
        }
        unset($user['login']);
        updateElement($table, $user, $id);
        locationMsg($_GET['p']);
        return false;

    }

    function showForm($dados){?>

        <div>
            <label for="login">Login</label>
            <input type="text" name="login" id="usuario" <?= (isset($dados['login']) ? "disabled" : "") ?> value="<?= isset($dados['login']) ? $dados['login'] : '' ?>" placeholder="Digite seu nome de usuário..." required>
        </div>
        <div>
            <label for="nome">Nome:</label>
            <input type="text" name="nome" placeholder="Digite seu nome..." value="<?= isset($dados['nome']) ? $dados['nome'] : '' ?>" required>
        </div>
        <div>
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email"  value="<?= isset($dados['email']) ? $dados['email'] : '' ?>" placeholder="example@mail.com" required>
        </div>
        <div>
            <label for="senha">Senha:</label>
            <input type="text" name="senha" id="senha" value="<?= isset($dados['senha']) ? $dados['senha'] : '' ?>" placeholder="Digite sua senha..." required>
        </div>

    <?php }
    include_once __DIR__."/../inc/CRUD.php";
    ?>