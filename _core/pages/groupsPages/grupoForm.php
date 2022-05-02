<?php 

include __DIR__."/../../db/grupoRepository.php";

$key = isset($_GET['id']) ? $_GET['id'] : 0;
$group = getGroup($key); 
$acao = isset($_GET['acao']) ? $_GET['acao'] : "add";

if(count($group) > 0 || $acao == 'add'){
   
    if(count($_POST) > 0){
        $nome = isset($_POST['nome']) ? $_POST['nome'] : "";
        
        $group = [
            'id' => $key,
            'nome' => $nome
        ];

        if($acao=="add") insertGroup($group);

        else updateGroup($group);
        
        locationMsg('grupoList');
    }

    $id = $nome = "";

    if($acao=='edit'){
        $id = $key;
        $nome = $group['nome'];
    }


?>
<main id="insert-user-page">
    <form action="index.php?p=grupoForm&id=<?= $key ?>&acao=<?= $acao ?>" method="post" id="insert-user-form">
        
        <?php if($acao == "edit"){ ?>

            <div>
                <label for="id">ID:</label>
                <input type="text" name="id" value="<?= $id ?>" disabled>
            </div>

        <?php } ?>

        <div>
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome"  value="<?= $nome ?>" required>
        </div>

        <div class="d-flex flex-row gap-3">
            <a href="index.php?p=grupoList" class="btn my-btn-secondary btn-secondary bg-danger p-2">CANCELAR</a>
            <button type="submit" class="btn btn-primary my-btn-primary btn-lg">SALVAR</button>
        </div>

    </form>
</main>
<?php }
    else{
        locationMsg('grupoList', 'erro1');
    }
?>