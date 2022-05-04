<?php

include_once __DIR__."/../../db/usuarioRepository.php";

$key = isset($_GET['id']) ? $_GET['id'] : "";
$user = getUserById($key);
$acao = isset($_GET['acao']) ? $_GET['acao'] : "";

if($acao == 'del'){
    
    if(count(getUserByID($key)) <= 0){
        locationMsg('usuarios', 'erro1');
    }

    tableDel('usuario', $key);

    echo "<p>Aguarde, excluindo...</p>";

    locationMsg('usuarios');

}

if(count($user) > 0 || $acao == 'add'){

    if(count($_POST) > 0){
        $login = isset($_POST['login']) ? $_POST['login'] : "";
        $nome = isset($_POST['nome']) ? $_POST['nome']: "";
        $email = isset($_POST['email']) ? $_POST['email'] : "";
        $senha = isset($_POST['senha']) ? $_POST['senha'] : "";
        
        $user = [
            'id' => $key,
            'login' => $login,
            'nome' => $nome,
            'email' => $email,
            'senha' => $senha,
            'ativo' => 1
        ];

        if($acao=="add") insertUser($user);

        else updateUser($user);

        locationMsg('usuarios');
    }

    $nome = $email = $login = $senha = "";

    if($acao=='edit'){
        $id=$key;
        $login = $user['login'];
        $nome = $user['nome'];
        $email = $user['email'];
        $senha = $user['senha'];
    }


?>
<main id="insert-user-page">
    <form action="index.php?p=usuario&id=<?= $key ?>&acao=<?= $acao ?>" method="post" id="insert-user-form">
    
        <div>
            <label for="login">Login</label>
            <input type="text" name="login" id="usuario" <?= ($acao=='edit' ? "disabled" : "") ?> value="<?= $login ?>" placeholder="Digite seu nome de usuário..." required>
        </div>
        <div>
            <label for="nome">Nome:</label>
            <input type="text" name="nome" placeholder="Digite seu nome..." value="<?= $nome ?>" required>
        </div>
        <div>
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email"  value="<?= $email ?>" placeholder="example@mail.com" required>
        </div>
        <div>
            <label for="senha">Senha:</label>
            <input type="text" name="senha" id="senha" value="<?= $senha ?>" placeholder="Digite sua senha..." required>
        </div>

        <div class="d-flex flex-row gap-3">
            <a href="index.php?p=usuarios" class="btn my-btn-secondary btn-secondary bg-danger p-2">CANCELAR</a>
            <button type="submit" class="btn btn-primary my-btn-primary btn-lg">SALVAR</button>
        </div>
        
    </form>
</main>
<?php }
    else{
        locationMsg('usuarios', 'erro1');
    }
?>