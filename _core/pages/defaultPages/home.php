<?php

    $year = isset($_REQUEST["year"]) ? $_REQUEST["year"] : date('Y');
    $datas = loadDates();
    $acao = isset($_GET['acao']) ? $_GET['acao'] : '';
    if(count($_POST) > 0 && $acao == 'grava'){
        $nome = str_pad($_POST['nome'],  2, "0", STR_PAD_LEFT);
        $dia = str_pad($_POST['dia'],  2, "0", STR_PAD_LEFT);;
        $mes = str_pad($_POST['mes'],  2, "0", STR_PAD_LEFT);;

        $data = [
            'data' => $dia.$mes,
            'nome' => $nome,
        ];

        saveDates($data);

        $datas[] = $data;

    }
?>

    <main id="home">
        <?php
        echo '<div id="botoes-ant-prox"><a href="./index.php?year='.($year - 1).'" class="btn btn-secondary my-btn-secondary btn-lg"> <span class="material-icons">arrow_left</span> '.($year - 1).'</a>';
        echo '<a href="./index.php?year='.($year + 1).'" class="btn btn-secondary my-btn-secondary btn-lg">'.($year + 1).' <span class="material-icons">arrow_right</span> </a></div>';
        
        ?>
            
        <button type="button" class="btn btn-primary my-btn-primary" data-bs-toggle="modal" data-bs-target="#insertDataModal"> CADASTRAR EVENTO <span class='material-icons'>add_circle</span> </button>
        <?php
        
        echo "<h1>Bem vindo {$_SESSION['nome']}</h1><a href='index.php?p=logof'></a>";
        echo '<h2>'."Calendário de {$year}".'</h2>';
        for ($i = 0; $i < 12 ; $i++) {
            echo '<h3>'.$CONFIG['arrayMonth'][$i].'</h3>';
            $firstDayMonth = mktime(0,0,0,$i + 1,1,$year);
            $lastDayMonth = date('t', $firstDayMonth);
            $startWeekDay = date('w', $firstDayMonth);
            $x = 0;
        echo '
        <table class="table table-striped table-bordered">
            <thead>
                <tr><th>'.implode('</th><th>', $CONFIG['arrayWeek']).'</th></tr>
            </thead>
            <tbody>
            <tr>';
        for ($cont=0; $cont < $startWeekDay; $cont++) {
            echo '<td>&nbsp;</td>'.PHP_EOL;
            $x++;
        }
            for ($cont = 1; $cont <= $lastDayMonth; $cont++) {
                if ($x++ == 7) {
                    $x = 1;
                    echo '</tr><tr>'.PHP_EOL;
                }
                $nome = hasBday($cont, $i+1, $datas);
                echo  $nome!= "" ? '<td class="bg-danger"> <a href="#" data-toggle="tooltip" title="'.$nome.'">'.$cont.'</a></td>'.PHP_EOL : '<td>'.$cont.'</td>'.PHP_EOL;
            };
        echo '
            </tr>
            </tbody>
        </table>';
        }
        ?>
            <!-- Modal -->
        <div class="modal fade" id="insertDataModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <form class="modal-content" method="post" action="index.php?acao=grava">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Adicionar Data</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="nome">Nome:</label>
                                <input type="text" name="nome" class="form-control" placeholder="Seu nome..." required/>
                            </div>
                            <div class="col-sm-4">
                                <label for="dia">Dia:</label>
                                <input type="Number" name="dia" class="form-control" placeholder="Dia do seu aniversário..." max="31" min="1" required/>
                            </div>
                            <div class="col-sm-4">
                                <label for="mes">Mês:</label>
                                <input type="Number" name="mes"  class="form-control" placeholder="Mês do seu aniversário..." max="12" min="1" required/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <button type="Submit" class="btn btn-primary my-btn-primary btn-success">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
        </script>
    </main>