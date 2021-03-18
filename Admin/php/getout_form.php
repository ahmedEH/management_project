<?php
session_start();
include("db_conn.php");

if(!isset($_SESSION['user']))
{
  header('location:php/login.php');
}
if(isset($_GET['id']))
{
  $project = $_GET['id'];
  $sql = "SELECT * FROM projets where id = '$project'";
  $result = mysqli_query($db,$sql);
  $row = mysqli_fetch_assoc($result);
  $project_name = $row['nom'];
}else{
  header('location:../error.html');
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
  <head>
    <title>تسجيل مصروف جديد</title>
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
      <h1 class="display-4">اضافة مصاريف</h1>
      <p class="lead">هنا يمكنك اضافة المصاريف الخاصة بكل مشروع </p>
      <hr class="my-4">
      <p>يمكنك ايضا الرجوع الى الصفحة الرئيسة اذا اردت</p>
      <p class="lead">
        <a class="btn btn-primary btn-lg" href="../index.php" role="button">الصفحة الرئيسية</a>
      </p>
    </div>
    <div class="container"style="margin-top:1%">
      <form action="getout.php" method="post">
        <div class="form-outline mb-4">
          <label class="form-label" for="form6Example1">اسم المشروع</label>
          <input value="<?php echo $project_name;?>"type="text" id="form6Example1" name="nom"class="form-control"disabled />
          <input value="<?php echo $project;?>"type="text" id="form6Example1" name="projet"class="form-control"hidden />
        </div>
        <div class="form-outline mb-4">
          <label class="form-label" for="form6Example1">اسم المصروف</label>
          <input type="text" id="form6Example1" name="nom_depense"class="form-control" />

        </div>
        <div class="form-outline mb-4">
          <label class="form-label" for="form6Example1">اسم المورد</label>
          <select id="form6Example1"name="fournisseur"class="form-control" aria-label="Default select example">
            <?php
            $fonction = "مورد";
            $sql = "SELECT * from personnes where fonction = '$fonction'";
            $result = mysqli_query($db, $sql);
            if (mysqli_num_rows($result) > 0) 
            {
              while($row = mysqli_fetch_assoc($result)) 
              {
                $id = $row['id'];
                echo "<option value=$id>" .$row['nom_prenom']." | ".$row['tel']."</option>";
              }
            }
            mysqli_close($db);
            ?>
          </select>
        </div>
        <div class="form-outline mb-4">
          <label class="form-label" for="form6Example1">مبلغ الوحدة بالاوقية القديمة</label>
          <input type="number" id="form6Example1" name="montant"class="form-control" />
        </div>
        <div class="form-outline mb-4">
          <label class="form-label" for="form6Example1">الكمية</label>
          <input type="number" step="0.5"id="form6Example1" name="quantite"class="form-control" />
        </div>
        <div class="form-outline mb-4">
          <label class="form-label" for="form6Example6">وصف العملية</label>
          <textarea rows="5"name="desc"id="form6Example6" class="form-control" ></textarea>
        </div>
        <button type="submit" name="en_out"class="btn btn-primary btn-block mb-4">حفظ</button>
      </form>
    </div>
  </body>
</html>



