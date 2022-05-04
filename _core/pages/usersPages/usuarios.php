<?php
    $msg = isset($_GET['msg']) ? $_GET['msg'] : "";
    include_once __DIR__."/../../db/usuarioRepository.php";

    $key = isset($_GET['id']) ? $_GET['id'] : "";
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";

    if($acao == 'del'){
        
        if(count(getUserByID($key)) <= 0){
            locationMsg('usuarios', 'erro1');
        }

        tableDel('usuario', $key);

        echo "<p>Aguarde, excluindo...</p>";

        locationMsg('usuarios');

    }

?>

<main id="usuarios-page" class="d-flex align-items-center m-4">
    <a href="index.php?p=usuario&acao=add" class="btn btn-primary my-btn-primary btn-default btn-lg">INSERIR<span class='material-icons'>add_circle</span></a>
    <section id="cards-usuarios">
        <?php
            showToastr($msg);
            $users = getUsers();

            $fields = [
                [
                    'field' => 'nome',
                    'size' => 4,
                    'name' => 'Nome'
                ],
                [
                    'field' => 'login',
                    'size' => 2,
                    'name' => 'Login'
                ],
                [
                    'field' => 'email',
                    'size' => 5,
                    'name' => 'Email'
                ]
                ];
            
            tableList('usuario', $fields, 'ativo=1');

            ?>
            
    </section>
</main>