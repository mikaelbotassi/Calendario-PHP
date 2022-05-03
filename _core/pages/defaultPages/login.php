<?php
    $erroNome = "";
    $erroSenha = "";

    include_once __DIR__."/../../db/usuarioRepository.php";

    if(count($_POST) > 0){

        $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : "";
        $senha = isset($_POST['senha']) ? $_POST['senha'] : "";
        $login = getUserByLogin($usuario);

        if(count($login) > 0){
            if($senha==$login['senha']){
                $_SESSION['logado'] = true;
                $_SESSION['nome'] = $usuario;
                header("Location: index.php");
                exit;
            }
            else $erroSenha = "Senha inválida";
        }
    
        else $erroNome = "Nome de usuário inválido";
    }

?>
<main id="login">
    <div>
        <form action="index.php?p=login" method="post" id="form-login">
            <h1>LOGIN</h1>
            <div>
                <label for="usuario">Usuário: </label>
                <input type="text" name="usuario" id="usuario" placeholder="Digite seu nome de usuário...">
                <?= '<p id="erro">'.$erroNome.'</p>' ?>
            </div>
            <div>
                <label for="senha">Senha: </label>
                <input type="password" name="senha" id="senha" placeholder="Digite sua senha...">
                <?= '<p id="erro">'.$erroSenha.'</p>' ?>
            </div>
            <button type="submit">LOGAR</button>
        </form>
    </div>
</main>