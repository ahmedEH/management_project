<?php
session_start();
include('php/db_conn.php');

if(!isset($_SESSION['user']))
{
header('location:php/login.php');
}
?>


<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <title>مكتب الادارة</title>
  <link href="../img/fan.png" rel="icon">
  <link href="../img/fan.png" rel="apple-touch-icon">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link href="css/style.css"rel="stylesheet" type="text/css">
  <style>
body {
  font-family: "Lato", sans-serif;

}

.sidenav {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  right: 0;
  background-color: #111;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}
button.url {
    border: 0;
    padding: 0;
    display: inline;
    background: none;
    margin:20px 20px 20px 32px;

}
button.url:hover {

}
.sidenav a,.url ,.navbar-item{
  padding: 20px 20px 20px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover,.url:hover {
  color: #f1f1f1;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  left: 10px;
  font-size: 36px;
  margin-right: 50px;
}

#main {
  transition: margin-right .5s;

}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}

* {
  box-sizing: border-box;
}

#myInput {
  background-image: url('/css/searchicon.png');
  background-position: 10px 10px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}

#myTable {
  border-collapse: collapse;
  width: 100%;
  border: 1px solid #ddd;
  font-size: 18px;
}

#myTable th, #myTable td {
  text-align: right;
  padding: 12px;
}

#myTable tr {
  border-bottom: 1px solid #ddd;
}

#myTable tr.header, #myTable tr:hover {
  background-color: #f1f1f1;
}

</style>
</head>
<body>

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

  <a class="" href="../index.html" role="button">الصفحة الرئيسية</a>
  <form class=" " action="php/person_insert.php"method="post">
  <input type="text" name="fonction"value="ouvrier"hidden/>
  <button class="url">اضافة عامل</button>
  </form>
  <form class=" " action="php/person_insert.php"method="post">
  <input type="text" name="fonction"value="client"hidden/>
  <button class="url"> اضافة زبون</button>
  </form>
  <form class=" " action="php/person_insert.php"method="post">
  <input type="text" name="fonction"value="fournisseur"hidden/>
  <button class="url">اضافة مورد</button>
  </form>



</div>






<div id="main">

<div class="jumbotron"style="padding:10px 40px 10px 10px;margin-bottom:0px">
  <h1 class="display-4"><?php echo $_SESSION['user'];?></h1>
  <p class="lead">هنا بامكانكم ادارة المشاريع و الاشخاص </p>
</div>
<!-- Image and text -->
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
  <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; الخيارات</span>
  <a href="php/projects.php" class="navbar-item">المشاريع</a>
  <a href="php/workers.php" class="navbar-item">العمال</a>
  <a href="php/clients.php" class="navbar-item">الزبناء</a>
  <a href="php/fournisseurs.php" class="navbar-item">الموردين</a>
  <a href="php/logout.php" class="navbar-item">تسجيل الخروج</a>
    <a class="navbar-brand" href="./index.php">
      <img src="/cheikh_entrepreneur/img/logo.jpg" alt="" width="150" height="50" class="d-inline-block align-top">
    </a>

    
  </div>
</nav>
 <br/><br/>

<div class="container-fluid">
<div class="card-deck">

<div class="card bg-success text-white">
    <div class="card-body">
      <h2>مجموع المداخيل</h2>
      <h1 style="float:left;"><span class="badge badge-primary">
        <?php
        $req = "select sum(montant) from client_compte ";
        $res = mysqli_fetch_assoc(mysqli_query($db,$req));
        $in = $res['sum(montant)'];
        echo $in - 0;
        ?>
      </span></h1>

</div>
  </div>

  <div class="card bg-danger text-white">
    <div class="card-body">
    <h2>مجموع المصاريف</h2>
    <h1 style="float:left;"><span class="badge badge-primary">
    <?php
        $req = "select sum(montant_unitaire * quantite) from depenses ";
        $res = mysqli_fetch_assoc(mysqli_query($db,$req));
        $out = $res['sum(montant_unitaire * quantite)'];
        $req = "select sum(montant) from ouvriers_projets ";
        $res = mysqli_fetch_assoc(mysqli_query($db,$req));
        $out_ouv = $res['sum(montant)'];
        echo ($out + $out_ouv) - 0;
        ?>
    </span></h1>

    </div>
  </div>

  <div class="card bg-secondary text-white">
    <div class="card-body">
    <h2> الباقي</h2>
    <h1 style="float:left;"><span class="badge badge-primary">
      <?php
      echo ($in - ($out + $out_ouv)) - 0;
      ?>
    </span></h1>

    </div>
  </div>
</div>
  
</div>

<br/><br/>

<div class="container-fluid">
<div class="card-deck">

<div class="card bg-light ">
    <div class="card-body">
      <h4> المشاريع</h4>
      <h1 style="float:left;"><span class="badge badge-info">
        <?php
        $req = "select count(*) from projets ";
        $res = mysqli_fetch_assoc(mysqli_query($db,$req));
        $in = $res['count(*)'];
        echo $in - 0;
        ?>
      </span></h1>

</div>
  </div>

  <div class="card bg-light ">
    <div class="card-body">
    <h4> الزبناء</h4>
    <h1 style="float:left;"><span class="badge badge-info">
    <?php
    $fonction = "زبون";
        $req = "select count(*) from personnes where fonction ='$fonction' ";
        $res = mysqli_fetch_assoc(mysqli_query($db,$req));
        $out = $res['count(*)'];
        echo $out - 0;
        ?>
    </span></h1>

    </div>
  </div>
  

  <div class="card bg-light ">
    <div class="card-body">
    <h4> الموردين</h4>
    <h1 style="float:left;"><span class="badge badge-info">
      <?php
    $fonction = "مورد";
    $req = "select count(*) from personnes where fonction ='$fonction' ";
    $res = mysqli_fetch_assoc(mysqli_query($db,$req));
    $out = $res['count(*)'];
    echo $out - 0;
      ?>
    </span></h1>

    </div>
  </div>
  <div class="card bg-light ">
    <div class="card-body">
    <h4> العمال</h4>
    <h1 style="float:left;"><span class="badge badge-info">
      <?php
    $fonction = "عامل";
    $req = "select count(*) from personnes where fonction ='$fonction' ";
    $res = mysqli_fetch_assoc(mysqli_query($db,$req));
    $out = $res['count(*)'];
    echo $out - 0;
      ?>
    </span></h1>

    </div>
  </div>

</div>
  
</div>



<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>




    
<script>





function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("main").style.marginRight = "250px";

}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginRight= "0";

}
</script>

</body>
</html>