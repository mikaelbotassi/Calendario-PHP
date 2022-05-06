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
        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
        </script>
    </main>