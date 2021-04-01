<?php
session_start();
if(isset($_SESSION['user']))
{
  header("location:../index.php");
}
include("db_conn.php");
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
  <head>
    <title>تسجيل الدخول</title>
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
  <div class="container"style="margin-top:10%">
  <?php
  if(isset($_POST['connect']))
  {
    $username = mysqli_real_escape_string($db,htmlspecialchars($_POST['login'])); 
    $password = mysqli_real_escape_string($db,htmlspecialchars(md5($_POST['pass'])));


    $requete = "SELECT count(*), nom, prenom , tel FROM admins where 
    login = '".$username."' and passwd = '".$password."' ";
    $exec_requete = mysqli_query($db,$requete);
    $reponse      = mysqli_fetch_array($exec_requete);
    $count = $reponse['count(*)'];
    if($count!=0)
    { 
      $_SESSION['user'] = $reponse['nom']." ".$reponse['prenom'];
      $_SESSION['user_tel'] = $reponse['tel'];
      header("location:../index.php");
    }
    else
    {
    echo '
    <div class="alert alert-danger">
    <strong>خطأ!</strong> كلمة السر او البريد غير صحيح 
    </div>';
    
    }
  }
  if(isset($_POST['forget']))
  {
  header("location:pre_reset.php");
  }
  
  ?>
  <form action="" method="post">

    <div dir="rtl"class="mb-3">
    <label for="exampleInputEmail1" class="form-label">البريد الالكتروني</label>
    <input required="required"type="email"name="login"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">البريد الالكتروني مهم و لا يجب ان يعلمه احد.</div>
    </div>
    <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">كلمة السر</label>
    <input required="required"type="password" name="pass"class="form-control" id="exampleInputPassword1">
    </div>
    <button name="connect"type="submit" class="btn btn-primary">تسجيل الدخول</button>
    <button name="forget"type="submit" class="btn btn-danger">إعادة تعيين كلمة المرور</button>
  </form>

  </div>

  </body>
</html>
<?php
mysqli_close($db); // fermer la connexion
?>