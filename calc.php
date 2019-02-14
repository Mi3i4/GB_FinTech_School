<?php
function showRes()
{
    if (empty($_REQUEST['Deposit'])) {
        return;
    }

    /*
     * Первый взнос по ипотеке. (В случае с арендой это та сумма, которой вы располагаете на момент принятия решения).
     */
    $Deposit = floatval($_REQUEST['Deposit']);

    /*
     * Стоимость квартиры (вместе с ремонтом и мебелью)
     */
    $Cost = floatval($_REQUEST['Cost']);

    /*
     * Плата за арендуемую квартиру (все включено)
     */
    $PaymentByRent = floatval($_REQUEST['PaymentByRent']);

    /*
     * Коммунальные платежи (за квартиру купленную в ипотеку)
     */
    $PaymentByOwn = floatval($_REQUEST['PaymentByOwn']);

    /*
     * Количество лет ипотеки
     */
    $mortgageYearCount = floatval($_REQUEST['mortgageYearCount']);

    /*
     * Ставка по ипотеке
     */
    $mortgageRate = floatval($_REQUEST['mortgageRate']) / 100;

    /*
     * Рост цен на недвижимость
     */
    $inflationImmovables = floatval($_REQUEST['inflationImmovables']) / 100;


    /*
     * Рост стоимости аренды.
     */
    $inflationRent = floatval($_REQUEST['inflationRent']) / 100;

    /*
     *Доход от инвестиций (если вы решили не покупать недвижимость а инвестировать в более ликвидные инструменты)
     */
    $investmentsIncomePercent = floatval($_REQUEST['investmentsIncomePercent']) / 100;

    //-------------


    /*
     * Платеж по ипотеке в месяц
     */
    $rentPayment = ($Cost - $Deposit)*(($mortgageRate/12) +  (($mortgageRate/12)/ ( pow(( 1 + ($mortgageRate/12)),($mortgageYearCount* 12) ) - 1) ));

    putLine("Платеж по ипотеке в месяц",
        "Общая стоимость квартиры / $mortgageYearCount / 12 ",
        $rentPayment);

    /*
     * Общая стоимость квартиры за (кол-во лет ипотеки) составит
     * Сумма кредита  + сумма обслуживания кредита
     */

    $rentCost = $rentPayment * $mortgageYearCount *12 + $Deposit;

    putLine("Общая стоимость квартиры за $mortgageYearCount лет ипотеки составит",
        "Сумма кредита  + сумма обслуживания кредита",
        $rentCost);





    /*
     *  Расходы на ипотеку в месяц + коммуналка
     */
    $rentPaymentFull = $rentPayment + $PaymentByOwn;
    putLine("Ипотека + коммуналка ",
        "Расходы на ипотеку в месяц + коммуналка",
        $rentPaymentFull);


    $owerPay = $rentCost - $Cost;
    putLine("Вы переплатите  ",
        "",
        $owerPay);



    /*
     * Стоимость квартиры черз 20 лет с учетом роста цен
     */

    $finalCost = $Cost;

    for($i=0;$i< $mortgageYearCount;$i++) {
        $finalCost = $finalCost * (1 + $inflationImmovables);
    }
    putLine("Стоимость квартиры",
        "Стоимость квартиры черз $mortgageYearCount лет с учетом роста цен",
        $finalCost);



    /*
     * Вы переплатите за 20 лет с учетом роста цен
     */
    $overpayment = $Deposit + ($overpayment + $rentPaymentFull - $PaymentByRent);

    for($y=0;$y< $mortgageYearCount; $y++) {
        if($y!=0){
            $PaymentByRent = $PaymentByRent*(1 + $inflationRent);

        }
        for ($i = 0; $i < 12; $i++) {
            if($i==0 && $y==0){continue;}
            $overpayment = (($overpayment + $rentPaymentFull - $PaymentByRent) * (1 + $investmentsIncomePercent / 12));
        }
    }


    putLine("Денег на вкладе ",
        "за $mortgageYearCount лет  ",
        $overpayment);



    $message = '';
    if ($overpayment < $finalCost) {
        $message = 'Ипотека выгоднее';
        newBlock($message);
        /*
      При этом вы сэкономите
      Сумма в рублях с 2-мя знаками после запятой. Например: 450 000,00 руб.
      */
        $economy = $finalCost - $overpayment;
        putLine("Экономия",
            "При этом вы сэкономите",
            $economy);
        /*
        Платеж по ипотеке в месяц
        */
        putLine("Платеж по ипотеке в месяц",
            "Общая стоимость квартиры / $mortgageYearCount / 12 ",
            $rentPayment);

        /*
        Общая стоимость квартиры за (кол-во лет ипотеки) составит
          */
        putLine("Общая стоимость квартиры за $mortgageYearCount лет ипотеки составит",
            "Сумма кредита  + сумма обслуживания кредита",
            $finalCost);

    } else {
        $message = 'Аренда выгоднее';
        newBlock($message);


        /*
        У вас еще останется
        */
        $free = $overpayment - $finalCost;
        putLine("У вас еще останется",
            "У вас еще останется",
            $free);
        /*

        /*
      Платеж по ипотеке в месяц
      */
        putLine("Платеж по ипотеке в месяц",
            "Общая стоимость квартиры / $mortgageYearCount / 12 ",
            $rentPayment);

        /*
        Общая стоимость квартиры за (кол-во лет ипотеки) составит
        */
        putLine("Общая стоимость квартиры за $mortgageYearCount лет ипотеки составит",
            "Сумма кредита  + сумма обслуживания кредита",
            $rentCost);

        /*
        Вы переплатите за 20 лет
        */
        putLine("Вы переплатите  ",
            "Вы переплатите $mortgageYearCount лет",
            $owerPay);

        /*
        Денег на вкладе через 20 лет
          */
        putLine("Депозит даст ",
            "Денег на вкладе через $mortgageYearCount лет",
            $overpayment);
    }


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
