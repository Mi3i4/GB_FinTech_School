
<?php 
require_once('calc.php');
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Калькулятор</title>

    <!-- Bootstrap core CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <style>
      .bd-value-img {
        font-size: 1.125rem;
        text-anchor: middle;
      }

      @media (min-width: 768px) {
        .bd-value-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.2/examples/checkout/form-validation.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    <div class="container">
  <div class="py-5 text-center">
    <h1>Калькулятор</h1>
  </div>

  <div class="row">
    <div class="col-md-12 order-md-1">
      <form class="needs-validation" novalidate method="post">


        <div class="mb-1">
          <label for="Deposit">Первый взнос по ипотеке. (В случае с арендой это та сумма, которой вы располагаете на момент принятия решения).
        </div>
        <div class="mb-4">
          <input type="number" class="form-control" id="Deposit" name = "Deposit" value="<?php echo isset($_REQUEST['Deposit'])?intval($_REQUEST['Deposit']):2000000.00;?>">
          <div class="invalid-feedback">
            Please enter a valid number
          </div>
        </div>


        <div class="mb-1">
          <label for="Cost">Стоимость квартиры (вместе с ремонтом и мебелью)
        </div>
        <div class="mb-4">
          <input type="number" class="form-control" id="Cost" name = "Cost" value="<?php echo isset($_REQUEST['Cost'])?intval($_REQUEST['Cost']):7000000.00;?>">
          <div class="invalid-feedback">
            Please enter a valid number
          </div>
        </div>


        <div class="mb-1">
          <label for="PaymentByRent">Плата за арендуемую квартиру (все включено)
          </div>
        <div class="mb-4">
          <input type="number" class="form-control" id="PaymentByRent" name = "PaymentByRent" value="<?php echo isset($_REQUEST['PaymentByRent'])?intval($_REQUEST['PaymentByRent']):45000.00;?>">
          <div class="invalid-feedback">
            Please enter a valid number
          </div>
        </div>

        <div class="mb-1">
          <label for="PaymentByOwn">Коммунальные платежи (за квартиру купленную в ипотеку)
          </div>
        <div class="mb-4">
          <input type="number" class="form-control" id="PaymentByOwn" name = "PaymentByOwn" value="<?php echo isset($_REQUEST['PaymentByOwn'])?intval($_REQUEST['PaymentByOwn']):8000.00;?>">
          <div class="invalid-feedback">
            Please enter a valid number
          </div>
        </div>



        <div class="mb-1">
          <label for="mortgageYearCount">Количество лет ипотеки
          </div>
        <div class="mb-4">
          <input type="number" class="form-control" id="mortgageYearCount" name = "mortgageYearCount" value="<?php echo isset($_REQUEST['mortgageYearCount'])?intval($_REQUEST['mortgageYearCount']):15;?>">
          <div class="invalid-feedback">
            Please enter a valid number
          </div>
        </div>


        <div class="mb-1">
          <label for="mortgageRate">Ставка по ипотеке
          </div>
        <div class="mb-4">
          <input type="float" class="form-control" id="mortgageRate" name = "mortgageRate" value="<?php echo isset($_REQUEST['mortgageRate'])?floatval($_REQUEST['mortgageRate']):15;?>">
          <div class="invalid-feedback">
            Please enter a valid number
          </div>
        </div>


        <div class="mb-1">
          <label for="inflationImmovables">Рост цен на недвижимость
          </div>
        <div class="mb-4">
          <input type="number" class="form-control" id="inflationImmovables" name = "inflationImmovables" value="<?php echo isset($_REQUEST['inflationImmovables'])?intval($_REQUEST['inflationImmovables']):1;?>">
          <div class="invalid-feedback">
            Please enter a valid number
          </div>
        </div>


        <div class="mb-1">
          <label for="inflationRent">Рост стоимости аренды.
          </div>
        <div class="mb-4">
          <input type="number" class="form-control" id="inflationRent" name = "inflationRent" value="<?php echo isset($_REQUEST['inflationRent'])?intval($_REQUEST['inflationRent']):3;?>">
          <div class="invalid-feedback">
            Please enter a valid number
          </div>
        </div>

        <div class="mb-1">
          <label for="investmentsIncomePercent">Доход от инвестиций (если вы решили не покупать недвижимость а инвестировать в более ликвидные инструменты)
          </div>
        <div class="mb-4">
          <input type="number" class="form-control" id="investmentsIncomePercent" name = "investmentsIncomePercent" value="<?php echo isset($_REQUEST['investmentsIncomePercent'])?intval($_REQUEST['investmentsIncomePercent']):8.5;?>">
          <div class="invalid-feedback">
            Please enter a valid number
          </div>
        </div>

        <hr class="mb-4">
        <ul class="list-group mb-3">
        <?= showRes() ?>
        </ul>
      
        <hr class="mb-4">
        <div class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit">Считать</button>
        <button class="btn btn-secondary btn-lg btn-block" type="reset">Сбросить</button>
        </div>
      </form>
    </div>
  </div>

  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">&copy; 2017-2018 Company Name</p>
    <ul class="list-inline">
      <li class="list-inline-item"><a href="#">Privacy</a></li>
      <li class="list-inline-item"><a href="#">Terms</a></li>
      <li class="list-inline-item"><a href="#">Support</a></li>
    </ul>
  </footer>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="/docs/4.2/assets/js/vendor/jquery-slim.min.js"><\/script>')</script><script src="https://getbootstrap.com/docs/4.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-zDnhMsjVZfS3hiP7oCBRmfjkQC4fzxVxFhBx8Hkz2aZX8gEvA/jsP3eXRCvzTofP" crossorigin="anonymous"></script>
        <script src="https://getbootstrap.com/docs/4.2/examples/checkout/form-validation.js"></script></body>
</html>




