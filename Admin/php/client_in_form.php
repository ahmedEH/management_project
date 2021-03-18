<?php
session_start();
include('db_conn.php');


if(!isset($_SESSION['user']))
{
header('location:php/login.php');
}

if(isset($_POST['client']))
{
    $client = $_POST['client'];
    $nom_client = $_POST['nom_client'];
}
else
    header("location:../error.html");
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <title>تسجيل مدخول للزبون</title>
  <link href="../../img/fan.png" rel="icon">
  <link href="../../img/fan.png" rel="apple-touch-icon">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link href="../css/style.css"rel="stylesheet" type="text/css">
</head>
<body>

<div class="jumbotron">
  <h1 class="display-4">تسجيل مدخول جديد لحساب الزبون</h1>
  <p class="lead"> هنا يمكنكم اضافة مداخيل لحساب الزبون : <?php echo $nom_client; ?></p>
  <hr class="my-4">
  <p>يمكنك ايضا الرجوع الى الصفحة الرئيسة اذا اردت</p>
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="../index.php" role="button">الصفحة الرئيسية</a>
  </p>
</div>

<div class="container"style="margin-top:1%">
<form action="client_in.php" method="post">
  <!-- 2 column grid layout with text inputs for the first and last names -->

<input name="client"type="number" value="<?php echo $client;?>"hidden/>




    <!-- Number input -->
    <div class="form-outline mb-4">
    <input required="required"type="number" name="montant"id="form6Example6" class="form-control" />
    <label class="form-label" for="form6Example6">المبلغ بالاوقية</label>
  </div>

    <!-- Number input -->
    <div class="form-outline mb-4">
    <input required="required"type="text" name="verseur"id="form6Example6" class="form-control" />
    <label class="form-label" for="form6Example6">المدخل</label>
  </div>


  <!-- Text input -->
  <div class="form-outline mb-4">
    <label class="form-label" for="form6Example4">الوصف</label>
    <textarea rows="5"name="desc"id="form6Example6" class="form-control" ></textarea>

</div>






  <!-- Submit button -->
  <button type="submit" name="en_client_in"class="btn btn-primary btn-block mb-4">حفظ</button>
</form>

</div>



</body>
</html>

<?php

