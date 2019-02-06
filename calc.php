<?php
function showRes()
{
    if (empty($_REQUEST['Deposit'])) {
        return;
    }

    /*
     * Первый взнос по ипотеке. (В случае с арендой это та сумма, которой вы располагаете на момент принятия решения).
     */
    $Deposit = intval($_REQUEST['Deposit']);

    /*
     * Стоимость квартиры (вместе с ремонтом и мебелью)
     */
    $Cost = intval($_REQUEST['Cost']);

    /*
     * Плата за арендуемую квартиру (все включено)
     */
    $PaymentByRent = intval($_REQUEST['PaymentByRent']);

    /*
     * Коммунальные платежи (за квартиру купленную в ипотеку)
     */
    $PaymentByOwn = intval($_REQUEST['PaymentByOwn']);

    /*
     * Количество лет ипотеки
     */
    $mortgageYearCount = intval($_REQUEST['mortgageYearCount']);

    /*
     * Ставка по ипотеке
     */
    $mortgageRate = intval($_REQUEST['mortgageRate']) / 100;

    /*
     * Рост цен на недвижимость
     */
    $inflationImmovables = intval($_REQUEST['inflationImmovables']) / 100;


    /*
     * Рост стоимости аренды.
     */
    $inflationRent = intval($_REQUEST['inflationRent']) / 100;

    /*
     *Доход от инвестиций (если вы решили не покупать недвижимость а инвестировать в более ликвидные инструменты)
     */
    $investmentsIncomePercent = intval($_REQUEST['investmentsIncomePercent']) / 100;

    //-------------
    /*
     * Общая стоимость квартиры за (кол-во лет ипотеки) составит
     * Сумма кредита  + сумма обслуживания кредита
     */
    $rentCost = ($Cost - $Deposit) + ($Cost - $Deposit) * $mortgageRate * $mortgageYearCount;

    putLine("Общая стоимость квартиры за $mortgageYearCount лет ипотеки составит",
        "Сумма кредита  + сумма обслуживания кредита",
        $rentCost);

    /*
     * Платеж по ипотеке в месяц
     */
    $rentPayment = $rentCost / $mortgageYearCount / 12;
    putLine("Платеж по ипотеке в месяц",
        "Общая стоимость квартиры / $mortgageYearCount / 12 ",
        $rentPayment);

    /*
     *  Расходы на ипотеку в месяц + коммуналка
     */
    $rentPaymentFull = $rentPayment + $PaymentByOwn;
    putLine("Ипотека + коммуналка ",
        "Расходы на ипотеку в месяц + коммуналка",
        $rentPaymentFull);


    /*
     * Стоимость квартиры черз 20 лет с учетом роста цен
     */

    $finalCost = $Cost * (1 + $inflationImmovables * $mortgageYearCount);
    putLine("Стоимость квартиры",
        "Стоимость квартиры черз $mortgageYearCount лет с учетом роста цен",
        $finalCost);
    /*
     * Вы переплатите за 20 лет с учетом роста цен
     */
    $overpayment = $rentCost - $finalCost;
    putLine("Переплата",
        "Вы переплатите за $mortgageYearCount лет с учетом роста цен: стоимость квартиры по ипотеке - стоимость квартиры с учетом роста цен  ",
        $overpayment);


    /*
     *  Сумма для депозита каждый месяц
     */
    $depositeMonthIncome = $rentPaymentFull - $PaymentByRent;
    putLine("На депозит в месяц ",
        "Сумма на  депозит в месяц если берем квартиру в аренду " . number_format($rentPaymentFull, 2, ',', ' ') . " - " . number_format($PaymentByRent, 2, ',', ' ') . " =",
        $depositeMonthIncome);


    /*
     * Денег на вкладе через 20 лет
     */
    $deposit = $Deposit + $Deposit * $investmentsIncomePercent * $mortgageYearCount;
    putLine("Взнос даст",
        "Первый взнос по ипотеке  $Deposit  через $mortgageYearCount лет даст",
        $deposit);


    /*
     * Доход от инвестиций в месяц
     */
    $investmentsIncomePercentMonth = $investmentsIncomePercent / 12;


    $depositIncome = $Deposit;

    for ($m = 0; $m < $mortgageYearCount * 12; $m++) {
        $depositIncome = $depositIncome + $depositeMonthIncome + $depositIncome * $investmentsIncomePercentMonth;
    }
    putLine("Депозит даст ",
        "Денег на вкладе через $mortgageYearCount лет",
        $depositIncome);

    $message = '';
    if ($rentCost > ($depositIncome - $inflationImmovables * $mortgageYearCount)) {
        $message = 'Ипотека выгоднее';
        newBlock($message);
        /*
      При этом вы сэкономите
      Сумма в рублях с 2-мя знаками после запятой. Например: 450 000,00 руб.
      */
        $economy = $rentCost - ($depositIncome - $inflationImmovables * $mortgageYearCount);
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
            $rentCost);

    } else {
        $message = 'Аренда выгоднее';
        newBlock($message);


        /*
        У вас еще останется
        */
        $free = ($depositIncome - $inflationImmovables * $mortgageYearCount) - $rentCost;
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
        $overpayment = $rentCost - $finalCost;
        putLine("Вы переплатите  ",
            "Вы переплатите $mortgageYearCount лет",
            $overpayment);

        /*
        Денег на вкладе через 20 лет
          */
        putLine("Депозит даст ",
            "Денег на вкладе через $mortgageYearCount лет",
            $depositIncome);
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
