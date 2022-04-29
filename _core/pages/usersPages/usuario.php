<?php 

$logins = loadLogins(); 
$key = isset($_GET['usuario']) ? $_GET['usuario'] : "";
$acao = isset($_GET['acao']) ? $_GET['acao'] : "";

if(isset($logins[$key]) || $acao == 'add'){
   
    if(count($_POST) > 0){
        $nome = isset($_POST['nome']) ? $_POST['nome']: "";
        $email = isset($_POST['email']) ? $_POST['email'] : "";
        $senha = isset($_POST['senha']) ? $_POST['senha'] : "";
        $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : $key;
        
        if($acao=="add"){
            $logins+=[
                $usuario =>[]
            ];
        }

        $logins[$usuario]=[
            'nome' => $nome,
            'email' => $email,
            'senha' => $senha
        ];

        // $logins[$key]['senha'] = $senha;

        saveUsers($logins);
        locationMsg('usuarios');
    }

    $nome = $email = $usuario = $senha = "";

    if($acao=='edit'){
        $nome = $logins[$key]['nome'];
        $email = $logins[$key]['email'];
        $usuario = $key;
        $senha = $logins[$key]['senha'];
    }


?>
<main id="insert-user-page">
    <form action="index.php?p=usuario&usuario=<?= $key ?>&acao=<?= $acao ?>" method="post" id="insert-user-form">
        <div>
            <label for="nome">Nome:</label>
            <input type="text" name="nome" placeholder="Digite seu nome..." value="<?= $nome ?>" required>
        </div>
        <div>
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email"  value="<?= $email ?>" placeholder="example@mail.com" required>
        </div>
        <div>
            <label for="usuario">Usuário</label>
            <input type="text" name="usuario" id="usuario" <?= ($acao=='edit' ? "disabled" : "") ?> value="<?= $usuario ?>" placeholder="Digite seu nome de usuário..." required>
        </div>
        <div>
            <label for="senha">Senha:</label>
            <input type="text" name="senha" id="senha" value="<?= $senha ?>" placeholder="Digite sua senha..." required>
        </div>
        <button type="submit" class="btn btn-primary btn-lg">SALVAR ALTERAÇÕES</button>
    </form>
</main>
<?php }
    else{
        locationMsg('usuarios', 'erro1');
    }
?>