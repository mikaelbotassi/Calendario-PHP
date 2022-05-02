<?php
  include __DIR__."/../../db/grupoRepository.php";
?>
<main class="d-flex flex-column align-items-center gap-4">
    <h2>GRUPOS</h2>
    <a class="btn  btn-primary my-btn-primary btn-lg d-flex align-items-center gap-1" href="index.php?p=grupoForm&acao=add"> INSERIR <span class='material-icons' style="font-size:16px">add_circle</span> </a>
    <section class="d-flex w-100 gap-3 justify-content-center p-2">
        <?php
            $groups = getGroups();
            foreach($groups as $group){
        ?>
        <article class="card w-10" style="width: 18rem;">
            <div class="card-body">
                <h3 class="card-title"><?=$group['nome']?></h3>
                <div class="d-flex gap-2">
                  <a href="index.php?p=grupoForm&acao=edit&id=<?=$group['id']?>" class="btn  btn-primary my-btn-primary col-sm-4">EDITAR</a>
                  <button class="btn btn-secondary my-btn-secondary bg-danger col-sm-4" onclick="if(confirm('Deseja realmente excluir o grupo?')){location='index.php?p=delGroup&id=<?= $group['id'] ?>'}">EXCLUIR</button>
                </div>
            </div>
        </article>
        <?php } ?>
    </section>
</main>