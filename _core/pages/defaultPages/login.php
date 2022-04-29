<?php
    $erroNome = "";
    $erroSenha = "";

    if(count($_POST) > 0){

        $logins = loadLogins();

        $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : "";
        $senha = isset($_POST['senha']) ? $_POST['senha'] : "";

        if(isset($logins[$usuario])){
            if($senha==$logins[$usuario]['senha']){
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