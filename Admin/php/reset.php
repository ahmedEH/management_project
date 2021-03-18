<?php
include('db_conn.php');
if(isset($_GET['id']) && $_GET['d'])
{
$id = $_GET['id'];
$d = $_GET['d'];

?>


<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <title>اعادة تعيين كلمة السر</title>
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
if(time() - $d > 600)
{

    echo '
    <div class="alert alert-danger">
        <strong>خطأ!</strong>لقد تجاوزت 10 دقائق من وقت ايصال رسالتك
    </div>';
    echo "<a href = \"./login.php\" class=\"btn btn-warning\">أعد المحاولة</a>";


}
else{
if(isset($_POST['connect']) )
{

    if($_POST['pass1'] != $_POST['pass2'])
    echo '
    <div class="alert alert-danger">
        <strong>خطأ!</strong>كلمات السر غير متطابقتين
    </div>';

    else{
        
        // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
        // pour éliminer toute attaque de type injection SQL et XSS
        $pass = mysqli_real_escape_string($db,htmlspecialchars(md5($_POST['pass1']))); 
        
        $requete = "UPDATE admins SET passwd='".$pass."' WHERE id='".$id."' ";
        $reponse = mysqli_query($db,$requete);


        if($reponse){
            echo '
            <div class="alert alert-info">
                <strong>خبر !</strong>تم تعيين كلمة السر <a class="btn btn-primary" href="../index.php">تسجيل الدخول</a>
            </div>';}
        else{
            echo '
                <div class="alert alert-danger">
                    <strong>خطأ!</strong> أعد المحاولة لم يتم تعيين كلمة السر 
                </div>';
        }
    }
}
?>





<form action="" method="post">

<div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">كلمة السر</label>
    <input required="required"type="password" name="pass1"class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword2" class="form-label">أعد كلمة السر </label>
    <input type="password" name="pass2"class="form-control" id="exampleInputPassword2">
  </div>
  
  <button required="required"name="connect"type="submit" class="btn btn-primary">اعادة تعيين كلمة السر</button>
</form>

</div>

</body>
</html>
<?php
}
}
mysqli_close($db); // fermer la connexion
?>