<?php
    if(isset($_GET['acao']) > 0 ){
        if(count($_POST) > 0){
            $nome = isset($_POST['nome']) ? $_POST['nome'] : "";
            insertGroup($nome);
        }
    }
?>
<main class="d-flex flex-column align-items-center">
    <h2>GRUPOS</h2>
    <button type="button" class="btn  btn-primary my-btn-primary btn-lg d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#insertGroupModal"> INSERIR <span class='material-icons' style="font-size:16px">add_circle</span> </button>
    <section class="d-flex w-100 gap-3 justify-content-center p-2">
        <?php
            $groups = loadGroups();
            foreach($groups as $group){
        ?>
        <article class="card w-10" style="width: 18rem;">
            <div class="card-body">
                <h3 class="card-title"><?=$group?></h3>
                <div class="d-flex gap-2">
                  <button class="btn  btn-primary my-btn-primary col-sm-4">EDITAR</button>
                  <button class="btn btn-secondary my-btn-secondary bg-danger col-sm-4">EXCLUIR</button>
                </div>
            </div>
        </article>
        <?php } ?>
    </section>
</main>

<!-- Modal -->
<div class="modal fade" id="insertGroupModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adicionar Grupo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="index.php?p=grupoList&acao=add" method="post">
        <div class="modal-body">
            <label for="nome" class="col-form-label mb-3">Nome:</label>
            <input type="text" class="form-control" name="nome" id="nomeGroup" placeholder="Digite o nome do grupo...">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary my-btn-secondary bg-danger" data-bs-dismiss="modal">CANCELAR</button>
            <button type="submit" class="btn btn-primary my-btn-primary col-sm-2 col-md-2 col-lg-4 col-xl-6">SALVAR</button>
        </div>
      </form>
    </div>
  </div>
</div>