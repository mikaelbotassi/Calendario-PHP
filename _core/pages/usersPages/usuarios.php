<?php
    $msg = isset($_GET['msg']) ? $_GET['msg'] : "";    
?>
<main id="usuarios-page" class="d-flex align-items-center m-4">
    <a href="index.php?p=usuario&acao=add" class="btn btn-primary my-btn-primary btn-default btn-lg">INSERIR<span class='material-icons'>add_circle</span></a>
    <section id="cards-usuarios">
        <?php
            showToastr($msg);
            $logins = loadLogins();
            foreach($logins as $usuario => $dados){
        ?>
                <article class="card card-usuario w-25">
                     <div class="card-body card-usuario">
                         <h3 class="card-title"><?= strtoupper($dados['nome']) ?></h3>
                         <h3 class="card-title"><?= strtoupper($dados['email']) ?></h3>
                         <div id="button-group-usuario">
                             <a href="index.php?p=usuario&usuario=<?= $usuario ?>&acao=edit" class="btn btn-primary my-btn-primary w-25">EDITAR</a>
                             <a href="javascript:;" onclick="if(confirm('Deseja realmente excluir o usuário?')){location='index.php?p=delUsuario&login=<?= $usuario ?>'}" class="btn btn-danger">EXCLUIR</a>
                         </div>
                     </div>
                </article>
        <?php } ?>
    </section>
</main>