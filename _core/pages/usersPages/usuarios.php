<?php
    $msg = isset($_GET['msg']) ? $_GET['msg'] : "";
    include_once __DIR__."/../../db/usuarioRepository.php";
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