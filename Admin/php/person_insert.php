<?php
session_start();
include('db_conn.php');

$edit = false;

if(!isset($_SESSION['user']))
{
header('location:php/login.php');
}

if(isset($_POST['edit_p']))
{
  $edit = true;
  $person = $_POST['person'];
  $req = "SELECT * from personnes where id = '$person'";
  $row = mysqli_fetch_assoc(mysqli_query($db,$req));
  $nom = $row['nom_prenom'];
  $tel = $row['tel'];
  $wtsp = $row['wtsp'];
  $addresse = $row['adresse'];
  
}
elseif(isset($_SESSION['fonction']))
{
  $nom = NULL;
  $tel = NULL;
  $wtsp = NULL;
  $addresse = NULL;



}
else
  header("location:../error.html");

  $fonction = $_SESSION['fonction'];
  if($fonction == "ouvrier")
      $fonction = "عامل";
  elseif($fonction == "client")
      $fonction = "زبون";
  elseif($fonction == "fournisseur")
      $fonction = "مورد";
  else
      header("location:../error.html");
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <title>اضافة أشخاص</title>
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
  <h1 class="display-4">تسجيل أشخاص</h1>
  <p class="lead">هنا يمكنك تسجيل و حفظ معلومات الموردين و العمال و الزبناء</p>
  <hr class="my-4">
  <p>يمكنك ايضا الرجوع الى الصفحة الرئيسة اذا اردت</p>
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="../index.php" role="button">الصفحة الرئيسية</a>
  </p>
</div>

<div class="container"style="margin-top:1%">
<form action="person_add.php" method="post">
  <!-- 2 column grid layout with text inputs for the first and last names -->


      <div class="form-outline mb-4">
        <input value = "<?php echo $nom ;?>"required="required"type="text" id="form6Example1" name="nom"class="form-control" />
        <label class="form-label" for="form6Example1">الاسم الكامل</label>
      </div>




    <!-- Number input -->
    <div class="form-outline mb-4">
    <input value = "<?php echo $tel ;?>"type="number" name="tel"id="form6Example6" class="form-control" />
    <label class="form-label" for="form6Example6">الهاتف النقال</label>
  </div>

    <!-- Number input -->
    <div class="form-outline mb-4">
    <input value = "<?php echo $wtsp ;?>" type="number" name="wtsp"id="form6Example6" class="form-control" />
    <label class="form-label" for="form6Example6">الواتساب</label>
  </div>
  <!-- Text input -->
  <div class="form-outline mb-4">
    <input value = "<?php echo $addresse ;?>"type="text" name="add"id="form6Example3" class="form-control" />
    <label class="form-label" for="form6Example3">العنوان السكني</label>
  </div>

  <!-- Text input -->
  <div class="form-outline mb-4">
    <input type="text" name="fonc" id="form6Example4" class="form-control" value = "<?php echo $fonction ?>"disabled />
    <label class="form-label" for="form6Example4">الوسم</label>
</div>

<input type="text" name="fonc" id="form6Example4" class="form-control" value = "<?php echo $fonction ?>"hidden />




<?php
if($edit)
{
  echo "<input type = \"text\" value = \"$person\" name = \"person\" hidden />";
  echo '<button type="submit" name="edit_p"class="btn btn-primary btn-block mb-4">حفظ التعديل</button>';
}
else
{
  echo '<button type="submit" name="en"class="btn btn-primary btn-block mb-4">حفظ</button>';
}
?>
  
</form>

</div>



</body>
</html>

<?php

