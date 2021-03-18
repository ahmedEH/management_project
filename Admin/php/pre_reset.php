<?php
session_start();

if(isset($_SESSION['user']))
header("location:../index.php");

include("db_conn.php");

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
if(isset($_POST['connect']))
{
    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $username = mysqli_real_escape_string($db,htmlspecialchars($_POST['login'])); 
    
    $requete = "SELECT count(*) ,id,login FROM admins where 
    login = '".$username."' ";
    $exec_requete = mysqli_query($db,$requete);
    $reponse      = mysqli_fetch_array($exec_requete);
    $count = $reponse['count(*)'];
    $login = $reponse['login'];
    if($count!=0)
    { // nom d'utilisateur et mot de passe correctes
 
        $id =$reponse['id'];
        include("../../email_config.php");
        // Add a recipient 

        $mail->addAddress($login); 


        
        //$mail->addCC('cc@example.com'); 
        //$mail->addBCC('bcc@example.com'); 
        
        // Set email format to HTML 
        $mail->isHTML(true); 
        
        // Mail subject 
        $mail->Subject = html_entity_decode("اعادة تعيين كلمة السر"); 
        
        // Mail body content 
        $t = time();
        $mail->Body    ="
        <!DOCTYPE html>
        <html lang=\"ar\" dir=\"rtl\">
        <head>
        <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css\" rel=\"stylesheet\" integrity=\"sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl\" crossorigin=\"anonymous\">
        <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js\" integrity=\"sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0\" crossorigin=\"anonymous\"></script>
        </head>
        <body >
            <div class=\"card\" style=\"width: 18rem;\">
            <img src=\"https://cdn.pixabay.com/photo/2021/02/02/18/46/city-5974876_960_720.jpg\" class=\"card-img-top\" />
            <div class=\"card-body\">
                <p ><strong>اسم المرسل  :</strong>شركة الشيخ ابراهيم</p>
                <p ><strong>موضوع الرسالة : </strong>اعادة تعيين كلمة السر</p>
                <div class=\"alert alert-success\">
        <strong>ملاحظة !</strong> هذا الرابط صالح لمدة 10دقائق فقط 
        </div>
                <a href=\"http://localhost/cheikh_entrepreneur/Admin/php/reset.php?id=$id&d=$t \"class=\"btn btn-primary\"><strong>اعادة تعيين كلمة السر</strong></a>
            </div>
            </div>
        </body>
        </html>";

        
        // Send email 
        $response=$mail->send();
        echo '
        <div class="alert alert-success">
        <strong>خبر !</strong> تم ارسال رسالة لك في البريد الالكتروني لاعادة تعيين كلمة السر
        </div>';
 


    }
    else
        echo '
            <div class="alert alert-danger">
                <strong>خطأ!</strong>البريد غير صحيح 
            </div>';
}

?>
<form action="pre_reset.php" method="post">

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">البريد الالكتروني</label>
    <input required="required"name="login" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">البريد الالكترونيمهم و سري.</div>
  </div>
  <button name="connect"type="submit" class="btn btn-primary">اعادة تعيين كلمة السر</button>
</form>

</div>

</body>
</html>
<?php
mysqli_close($db); // fermer la connexion
?>