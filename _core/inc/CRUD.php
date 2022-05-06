<?php
    $msg = isset($_GET['msg']) ? $_GET['msg'] : "";

    $key = isset($_GET['id']) ? $_GET['id'] : "";
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $dados = [];

    if(in_array($acao, ['add', 'edit'])){
        if($acao == 'edit'){
            $dados = getElementById($table, $key);
            if(count($dados) <= 0) locationMsg('usuario', 'erro1');
        }
        if(count($_POST) > 0){
            // saveForm($acao, $key);
            if(saveForm($acao, $key)) locationMsg($_GET['p']);
            else locationMsg($_GET['p'], 'erro1');
        }
        else{
            ?>
            <main id="main-page" class="d-flex align-items-center flex-column gap-3">
                <form action="index.php?p=<?= $_GET['p'] ?>&id=<?= $key ?>&acao=<?= $acao ?>" enctype="multipart/form-data" method="post" id="insert-user-form">
                    <?php showForm($dados); ?>
                    <div class="d-flex flex-row gap-3">
                        <a href="index.php?p=<?=$_GET['p']?>" class="btn my-btn-secondary btn-secondary bg-danger p-2">CANCELAR</a>
                        <button type="submit" class="btn btn-primary my-btn-primary btn-lg">SALVAR</button>
                    </div>
                </form>
            </main>

        <?php }
    }

    else if($acao == 'del'){
        if(count(getElementById($table, $key)) <= 0){
            locationMsg($_GET['p'], 'erro1');
        }

        tableDel($table, $key, isset($imgField) ? $imgField : '');

        echo "<p>Aguarde, excluindo...</p>";

        locationMsg($_GET['p']);

    }

    else{?>
        <main id="main-page" class="d-flex align-items-center flex-column gap-3">
            <h2><?= $title ?></h2>
            <form action="./" method="get" class="d-flex flex-row col-sm-6" id="search-bar">
                <div style="width: 95%;">
                    <input type="text" name="busca" id="busca-input" class="form-control w-100" placeholder="Digite o que deseja procurar...">
                </div>
                <input type="hidden" name="p" value="<?=$_GET['p']?>">
                <div style="width:5%">
                    <button type="submit" class="material-icons btn btn-primary my-btn-primary w-100">search</button>
                </div>
            </form>
            <a href="index.php?p=<?=$_GET['p']?>&acao=add" class="btn btn-primary my-btn-primary btn-default btn-lg">INSERIR<span class='material-icons'>add_circle</span></a>
            <section id="cards-usuarios">
                <?php
                    showToastr($msg);
                    
                    tableList($table, $fields, $search);

                    ?>
                    
            </section>
        </main>
    <?php } ?>