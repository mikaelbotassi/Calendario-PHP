<?php

    $year = isset($_REQUEST["year"]) ? $_REQUEST["year"] : date('Y');
    $acao = isset($_GET['acao']) ? $_GET['acao'] : '';
    $events = getList('evento', "YEAR(data)={$year}");
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
        for ($month = 0; $month < 12 ; $month++) {
            echo '<h3>'.$CONFIG['arrayMonth'][$month].'</h3>';
            $firstDayMonth = mktime(0,0,0,$month + 1,1,$year);
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
        for ($day=0; $day < $startWeekDay; $day++) {
            echo '<td>&nbsp;</td>'.PHP_EOL;
            $x++;
        }
            for ($day = 1; $day <= $lastDayMonth; $day++) {
                if ($x++ == 7) {
                    $x = 1;
                    echo '</tr><tr>'.PHP_EOL;
                }
                $nome = hasEvent($day, $month + 1,$year ,$events);
                echo  $nome!= "" ? '<td class="bg-danger"> <a href="#" data-toggle="tooltip" title="'.$nome.'">'.$day.'</a></td>'.PHP_EOL : '<td>'.$day.'</td>'.PHP_EOL;
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
                <form class="modal-dayent" method="post" action="index.php?acao=grava">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Adicionar Data</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="nome">Nome:</label>
                                <input type="text" name="nome" class="form-dayrol" placeholder="Seu nome..." required/>
                            </div>
                            <div class="col-sm-4">
                                <label for="dia">Dia:</label>
                                <input type="Number" name="dia" class="form-dayrol" placeholder="Dia do seu aniversário..." max="31" min="1" required/>
                            </div>
                            <div class="col-sm-4">
                                <label for="mes">Mês:</label>
                                <input type="Number" name="mes"  class="form-dayrol" placeholder="Mês do seu aniversário..." max="12" min="1" required/>
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