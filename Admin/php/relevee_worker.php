<?php
session_start();

include('db_conn.php');

if(!isset($_SESSION['user']))
{
    header("location:../error.html");

}
if(isset($_POST['worker_relevee']))
{
    $worker = $_POST['person'];
    $_SESSION['worker_relevee'] = $worker;
}
elseif(isset($_SESSION['worker_relevee']))
{
    $worker = $_SESSION['worker_relevee'];
}
else
{
    header("location:../error.html");
}

$date_1 = '2021-01-01';
$date_2 = date('Y-m-d');
$client_selected = -1;

if(isset($_POST['date_submit']))
{
    $date_1 = $_POST['date_1'];
    $date_2 = $_POST['date_2'];
    $client_selected = $_POST['client_selected'];

}
elseif(isset($_POST['date_submit1']))
{
  $date_1 = $_POST['date_1'];
    $date_2 = $_POST['date_2'];
    $client_selected = -1;
}
$date_time_1 = $date_1.' 00:00:00';
$date_time_2 = $date_2.' 23:59:59';

?>

<!DOCTYPE html>
<html lang="ar"  dir="rtl">
<head>
  <title>كشف العامل</title>
  <link href="../../img/fan.png" rel="icon">
  <link href="../../img/fan.png" rel="apple-touch-icon">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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

                $req = "SELECT * from personnes where id = '$worker'";
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

<h1 style="text-align:center"> كشف عمليات </h1>
<br/><br/>
<div class="container-fluid date-submit d-flex justify-content-center">
<form style=""class="form-inline " action="relevee_worker.php"method="post">


            
من :&nbsp;&nbsp;<input value = "<?php echo $date_1; ?>"name = "date_1" style="display: inline;"type="date" class="form-control" >&nbsp;&nbsp;&nbsp;&nbsp;



إلى :&nbsp;&nbsp;<input value = "<?php echo $date_2; ?>"name = "date_2" style="display: inline;"type="date" class="form-control" >  &nbsp;&nbsp;&nbsp;&nbsp;


الزبون :&nbsp;&nbsp;

<select id="form6Example1"name="client_selected"class="form-control" aria-label="Default select example">

<?php
$fonction = "زبون";
$sql = "SELECT * from personnes where fonction = '$fonction'";
$result = mysqli_query($db, $sql);
if (mysqli_num_rows($result) > 0) 
{
 if($client_selected == -1)
 {
   echo "<option value=\"-1\" selected>الكل</option>"; 
 }
 else{
   echo "<option value=\"-1\">الكل</option>"; 
 }
 while($row = mysqli_fetch_assoc($result)) 
 {
   $id = $row['id'];
   
   if($client_selected == $id)
   {
     echo "<option value=\"$id\" selected>" .$row['nom_prenom']." | ".$row['tel']."</option>";
   }
   else{

   echo "<option value=\"$id\">" .$row['nom_prenom']." | ".$row['tel']."</option>";
   }
   
 }
}

?>
</select>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


<button name = "date_submit"type="submit" class="btn btn-primary">كشف</button>

</form>
<form style=""class="form-inline " action="relevee_worker.php"method="post">



<input value = "2021-01-01"name = "date_1" style="display: inline;"type="date" class="form-control" hidden>



<input value = "<?php echo date('Y-m-d'); ?>"name = "date_2" style="display: inline;"type="date" class="form-control" hidden>  



<button name = "date_submit1"type="submit" class="mx-3 btn btn-primary"> كشف الكل</button>

</form>
</div>
<br/><br/>

<div class="container-fluid">


    <?php
if($client_selected == -1)
{
$sql = "SELECT distinct projet from ouvriers_projets where ouvrier = '$worker' ORDER BY id desc";
$result = mysqli_query($db, $sql);

    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $projet = $row['projet'];
        $sql1 = "SELECT nom from projets where id = '$projet'";
        $nom = mysqli_fetch_assoc(mysqli_query($db,$sql1))['nom'];

        echo '<h5 class="bg-default p-3" style="width:auto">اسم المشروع :'.$nom.'</h5>';
        $sql2 = "SELECT  * from ouvriers_projets where ouvrier = '$worker'  and projet = '$projet' and date between '$date_time_1' and '$date_time_2' ORDER BY id desc";
        $result2 = mysqli_query($db,$sql2);
        echo '<table class="table">
        <thead class="thead-dark">
          <tr>
            <th width="50%">المبلغ</th>
            <th width="50%">التاريخ</th>
          </tr>
        </thead>
    
      <tbody>';
        while($row2 = mysqli_fetch_assoc($result2)){
            $montant = $row2['montant'];
            $montant = number_format($montant, 2, ',', ' ');
            echo '<tr>';
            echo '<td width="50%"dir="ltr"><strong>'.$montant.'</strong></td>';
            echo '<td width="50%"dir="ltr">'.$row2['date'].'</td>';
            echo'</tr>';


        }
        echo '</tbody></table>';
        echo '<div class="justify-content-center"style = " width : 400px;float:left">

        <span style="float:right;"> المجموع   : </span><span  style = "float:left"dir ="ltr"class="badge   ">';

          $req = "select sum(montant) from ouvriers_projets where ouvrier ='$worker' and projet = '$projet'";
          $res = mysqli_fetch_assoc(mysqli_query($db,$req));
          $in = $res['sum(montant)'];
          $montant = $in - 0;
          $montant = number_format($montant, 2, ',', ' ');
          echo $montant ;

        echo '</span>
  
      <br/><br/>
      </div>';


    }
    ?>
    <br/><br/><br/><br/><br/>
<div class="justify-content-center"style = "float:left">

    <span style="float:right;"> المجموع  الكلي : </span><span  style = "float:left"dir ="ltr"class="badge   ">
      <?php
      $req = "select sum(montant) from ouvriers_projets where ouvrier ='$worker'";
      $res = mysqli_fetch_assoc(mysqli_query($db,$req));
      $in = $res['sum(montant)'];
      $montant = $in - 0;
      $montant = number_format($montant, 2, ',', ' ');
      echo $montant ;
      ?>
    </span>

  <br/><br/>
  </div>
</div>
<?php

  }
  else{
    $sql = "SELECT distinct projet from ouvriers_projets where ouvrier = '$worker' and projet in (select id from projets where client = '$client_selected') ORDER BY id desc";
$result = mysqli_query($db, $sql);

    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $projet = $row['projet'];
        $sql1 = "SELECT nom from projets where id = '$projet'";
        $nom = mysqli_fetch_assoc(mysqli_query($db,$sql1))['nom'];

        echo '<h5 class="bg-default p-3" style="width:auto">اسم المشروع :'.$nom.'</h5>';
        $sql2 = "SELECT  * from ouvriers_projets where ouvrier = '$worker'  and projet = '$projet' and date between '$date_time_1' and '$date_time_2' ORDER BY id desc";
        $result2 = mysqli_query($db,$sql2);
        echo '<table class="table">
        <thead class="thead-dark">
          <tr>
            <th width="50%">المبلغ</th>
            <th width="50%">التاريخ</th>
          </tr>
        </thead>
    
      <tbody>';
        while($row2 = mysqli_fetch_assoc($result2)){
            $montant = $row2['montant'];
            $montant = number_format($montant, 2, ',', ' ');
            echo '<tr>';
            echo '<td width="50%"dir="ltr"><strong>'.$montant.'</strong></td>';
            echo '<td width="50%"dir="ltr">'.$row2['date'].'</td>';
            echo'</tr>';


        }
        echo '</tbody></table>';
        echo '<div class="justify-content-center"style = " width : 400px;float:left">

        <span style="float:right;"> المجموع   : </span><span  style = "float:left"dir ="ltr"class="badge   ">';

          $req = "select sum(montant) from ouvriers_projets where ouvrier ='$worker' and projet = '$projet'";
          $res = mysqli_fetch_assoc(mysqli_query($db,$req));
          $in = $res['sum(montant)'];
          $montant = $in - 0;
          $montant = number_format($montant, 2, ',', ' ');
          echo $montant ;

        echo '</span>
  
      <br/><br/>
      </div>';


    }
    ?>
      <br/><br/><br/><br/><br/>
<div class="justify-content-center"style = "float:left">

      <span style="float:right;"> المجموع  الكلي : </span><span  style = "float:left"dir ="ltr"class="badge   ">
        <?php
        $req = "select sum(montant) from ouvriers_projets where ouvrier ='$worker' and projet in (select id from projets where client = '$client_selected')";
        $res = mysqli_fetch_assoc(mysqli_query($db,$req));
        $in = $res['sum(montant)'];
        $montant = $in - 0;
        $montant = number_format($montant, 2, ',', ' ');
        echo $montant ;
        ?>
      </span>

    <br/><br/>
    </div>
</div>
<?php
  }

?>


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