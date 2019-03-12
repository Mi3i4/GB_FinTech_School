<?php
function showRes()
{
    if (empty($_REQUEST['Deposit'])) {
        return;
    }

    /*
     * Сумма в рублях с 2-мя знаками после запятой. Например: 2 000 000,00 руб.
     */
    $Deposit = floatval($_REQUEST['Deposit']);

    /*
     * Количество лет. Например: 15 лет.
     */
    $Years = floatval($_REQUEST['Years']);

    /*
     * Ставка
     */
    $Percent = floatval($_REQUEST['Percent'])/100;

    /*
     * Сумма в рублях с 2-мя знаками после запятой. Например: 10 000,00 руб.
     */
    $MonthPayment = floatval($_REQUEST['MonthPayment']);

    //-------------

    /*
     *Сумма возможного дохода с графиком доходности по месяцам.
     */

    $graphPoints = array();

    $income = $Deposit;
    for($y=0;$y< $Years; $y++) {
        for ($i = 0; $i < 12; $i++) {
            $income = ($income + $MonthPayment)*(1 + $Percent/12);
            array_push($graphPoints,[($i + $y*12),$income]);
        }
    }

    putGraph($graphPoints);

    putLine("Сумма возможного дохода",
        " ",
        $income );
}


function putLine($title, $desc, $val)
{
    echo '       
      <li class="list-group-item d-flex justify-content-between lh-condensed">
        <div>
          <h6 class="my-0">' . $title . '</h6>
          <small class="text-muted">' . $desc . '</small>
        </div>
        <span class="text-muted">' . number_format($val, 2, ',', ' ') . '</span>
      </li>';
}


function newBlock($header)
{
    echo ' 
        </ul>
        <h4>' . $header . '</h4>
        <hr class="mb-4">
        <ul class="list-group mb-3">
        ';
}


function putGraph($graphPoints){
    echo "
            <script>
            google.charts.load('current', {packages: ['corechart', 'line']});
            google.charts.setOnLoadCallback(drawBasic);

            function drawBasic() {

                var data = new google.visualization.DataTable();
                data.addColumn('number', 'X');
                data.addColumn('number', 'Руб');

                data.addRows([";

                for($i=0; $i< count($graphPoints);$i++){
                    echo "[".$graphPoints[$i][0].",".$graphPoints[$i][1]."],";
                }

                echo "]);

                var options = {
                    hAxis: {
                        title: 'Вклад'
                    },
                    vAxis: {
                        title: 'Месяц'
                    }
                };

                var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

                chart.draw(data, options);
            }
        </script>
    ";
}
