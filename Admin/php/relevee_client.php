<?php
session_start();

include('db_conn.php');

if(!isset($_SESSION['user']))
{
    header("location:../error.html");

}
if(isset($_POST['client_relevee']))
{
    $client = $_POST['person'];
    $_SESSION['client_relevee'] = $client;
}
elseif(isset($_SESSION['client_relevee']))
{
    $client = $_SESSION['client_relevee'];
}
else
{
    header("location:../error.html");
}

$date_1 = '2021-01-01';
$date_2 = date('Y-m-d');

if(isset($_POST['date_submit']))
{
    $date_1 = $_POST['date_1'];
    $date_2 = $_POST['date_2'];
}

$date_time_1 = $date_1.' 00:00:00';
$date_time_2 = $date_2.' 23:59:59';

?>

<!DOCTYPE html>
<html lang="ar"  dir="rtl">
<head>
  <title>كشف الزبون</title>
  <link href="../../img/fan.png" rel="icon">
  <link href="../../img/fan.png" rel="apple-touch-icon">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <link href="../css/style.css"rel="stylesheet" type="text/css">
  
  <style>
    span{
        font-weight: 900;
        font-size: 150%;

    }
        .badge{
            font-weight: 900;
        font-size: 150%;
        }
  </style>
</head>
<body>

<div style="padding:30px 30px"class="jumbotron jumbotron-fluid">

<div class="row">
    <div class="col">
        <div >
                <h5>الاسم : <?php echo $_SESSION['user'] ;?></h5>
                <h5>الهاتف : <?php echo $_SESSION['user_tel'] ;?></h5>
            </div>
        </div>
    <div class="col">
        <div style="padding-right:45%;padding-left:45%;">
        <a href="../index.php" >
            <img src="../../img/fan.png" />
        </a>
        </div>
    </div>
    <div class="col">
        <div style="float:left">
            <?php

                $req = "SELECT * from personnes where id = '$client'";
                $reponse = mysqli_fetch_assoc(mysqli_query($db,$req));
                $nom = $reponse['nom_prenom'];
                $tel = $reponse['tel'];



            ?>
            <h5>الاسم : <?php echo $nom ;?></h5>
            <h5>الهاتف : <?php echo $tel ;?></h5>
        </div>
    </div>
</div>

</div>

<h1 style="text-align:center"> كشف مداخيل </h1>
<br/><br/>
<div class="container-fluid date-submit d-flex justify-content-center">
    <form style=""class="form-inline " action="relevee_client.php"method="post">


            
             من :&nbsp;&nbsp;<input value = "<?php echo $date_1; ?>"name = "date_1" style="display: inline;"type="date" class="form-control" >&nbsp;&nbsp;&nbsp;&nbsp;
        


            إلى :&nbsp;&nbsp;<input value = "<?php echo $date_2; ?>"name = "date_2" style="display: inline;"type="date" class="form-control" >  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        

            <button name = "date_submit"type="submit" class="btn btn-primary">كشف</button>
        
    </form>
    <form style=""class="form-inline " action="relevee_client.php"method="post">


            
            <input value = "2021-01-01"name = "date_1" style="display: inline;"type="date" class="form-control" hidden>



            <input value = "<?php echo date('Y-m-d'); ?>"name = "date_2" style="display: inline;"type="date" class="form-control" hidden>  



            <button name = "date_submit"type="submit" class="mx-3 btn btn-primary"> كشف الكل</button>

</form>
</div>
<br/><br/>

<div class="container-fluid">

<table class="table">
    <thead class="thead-dark">
      <tr>
        <th>اسم المدخل</th>
        <th>المبلغ</th>
        <th>التاريخ</th>
      </tr>
    </thead>
    <tbody>
    <?php

$sql = "SELECT * from client_compte where client = '$client'  and date_v between '$date_time_1' and '$date_time_2' ORDER BY id desc";
$result = mysqli_query($db, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $verseur = $row['verseur'];
        $montant = $row['montant'];
        $date = $row['date_v'];
        $montant = number_format($montant, 2, ',', ' ');
        echo '<tr>';
        echo '<td >'.$verseur.'</td>';
        echo '<td dir="ltr"><strong>'.$montant.'</strong></td>';
        echo '<td dir="ltr">'.$date.'</td>';


        echo '</tr>';

    }
  }


?>
    </tbody>
  </table>
  <br/><br/><br/><br/><br/>
<div class="justify-content-center"style = "float:left">

      <span style="float:right;"> مجموع المداخيل الكلي : </span><span  style = "float:left"dir ="ltr"class="badge   ">
        <?php
        $req = "select sum(montant) from client_compte where client ='$client'";
        $res = mysqli_fetch_assoc(mysqli_query($db,$req));
        $in = $res['sum(montant)'];
        $montant = $in - 0;
        $montant = number_format($montant, 2, ',', ' ');
        echo $montant ;
        ?>
      </span>
      <br/><br/>
      <span style="float:right;"> مجموع المصاريف الكلي :&nbsp; </span><span  style = "float:left"dir ="ltr"class="badge  ">
    <?php
        $req = "select sum(montant_unitaire * quantite) from depenses where projet in (select id from projets where client = '$client')";        ;
        $res = mysqli_fetch_assoc(mysqli_query($db,$req));
        $out = $res['sum(montant_unitaire * quantite)'];
        $req = "select sum(montant) from ouvriers_projets where projet in (select id from projets where client = '$client')";
        $res = mysqli_fetch_assoc(mysqli_query($db,$req));
        $out_ouv = $res['sum(montant)'];

        $montant = ($out + $out_ouv) - 0;
        $montant = number_format($montant, 2, ',', ' ');
        echo $montant ;
        ?>
    </span>
    <br/><br/>
    <span class="d-flex justify-content-center"style="float:right;"> الباقي : </span><span  style = "float:left"dir ="ltr"class=" badge  ">
      <?php

      $montant = ($in - ($out + $out_ouv)) - 0;
      $montant = number_format($montant, 2, ',', ' ');
      echo $montant ;
      ?>
    </span>
    <br/><br/>
    </div>
</div>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<div style="padding:30px 30px"class="jumbotron jumbotron-fluid">

<div class="row d-flex justify-content-center ">
  <div class="col">
  <h5> المسير</h5>
  </div>
  <div class="col">
  <h5 dir="ltr"style="float:left"> بتاريخ : <?php echo date('d-m-Y'); ?> </h5>
  </div>



</div>
</body>
</html>