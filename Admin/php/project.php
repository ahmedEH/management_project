<?php
session_start();
include('db_conn.php');

if(!isset($_SESSION['user']))
{
header('location:php/login.php');
}
if(isset($_POST['projet']))
{
    $project = $_POST['projet'];
    $client = $_POST['client'];
}else{
    header('location:../error.html');
}
?>


<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <title>مكتب ادارة المشاريع</title>
  <link href="../../img/fan.png" rel="icon">
  <link href="../../img/fan.png" rel="apple-touch-icon">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link href="../css/style.css"rel="stylesheet" type="text/css">
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

.sidenav a {
  padding: 20px 20px 20px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
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
#myInput1 {
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
#myTable1 {
  border-collapse: collapse;
  width: 100%;
  border: 1px solid #ddd;
  font-size: 18px;
}

#myTable th, #myTable td {
  text-align: right;
  padding: 12px;
}
#myTable1 th, #myTable1 td {
  text-align: right;
  padding: 12px;
}

#myTable tr {
  border-bottom: 1px solid #ddd;
}
#myTable1 tr {
  border-bottom: 1px solid #ddd;
}
#myTable tr.header, #myTable tr:hover {
  background-color: #f1f1f1;
}
#myTable1 tr.header, #myTable1 tr:hover {
  background-color: #f1f1f1;
}
.div2{
    float:left;
}
</style>
</head>
<body>

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

  <a class="" href="../index.php" role="button">الصفحة الرئيسية</a>
<a class="" href="getout_form.php?id=<?php echo $project;?>">اضافة مصروف</a>
<a class=" " href="ouvrier_add.php?id=<?php echo $project;?>">اضافة عامل</a>


</div>






<div id="main">
<?php
if(isset($_GET['e']))
{
  echo '
  <div class="alert alert-success">
  <strong>خبر !</strong>تمت العملية بنجاح
  </div>';
}
?>
<div class="jumbotron"style="padding:10px 40px 10px 10px;margin-bottom:0px">
  <h1 class="display-4"><?php echo $_SESSION['user'];?></h1>
  <p class="lead">هنا بامكانكم ادارة مشروع ما بعينه و ادارة المصاريف و المداخيل الخاصة به و العمال الذين يعملون به </p>
</div>
<!-- Image and text -->
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
  <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; الخيارات</span>
    <a class="navbar-brand" href="../index.php">
      <img src="/cheikh_entrepreneur/img/logo.jpg" alt="" width="150" height="50" class="d-inline-block align-top">
    </a>
    
  </div>
</nav>

<br/><br/>

<div class="container-fluid">
<div class="card-deck">

<div class="card bg-success text-white">
    <div class="card-body">
      <h4>مجموع مصاريف الادوات</h4>
      <h1 style="float:left;"><span class="badge badge-primary">
        <?php
        $req = "select sum(montant_unitaire * quantite) from depenses where projet ='$project' ";
        $res = mysqli_fetch_assoc(mysqli_query($db,$req));
        $out_tools = $res['sum(montant_unitaire * quantite)'];
        echo $out_tools - 0;
        ?>
      </span></h1>

</div>
  </div>

  <div class="card bg-danger text-white">
    <div class="card-body">
    <h4>مجموع مصاريف العمال</h4>
    <h1 style="float:left;"><span class="badge badge-primary">
    <?php
        $req = "select sum(montant) from ouvriers_projets where projet = '$project'";
        $res = mysqli_fetch_assoc(mysqli_query($db,$req));
        $out_ouv = $res['sum(montant)'];
        echo $out_ouv - 0;
        ?>
    </span></h1>

    </div>
  </div>

  <div class="card bg-secondary text-white">
    <div class="card-body">
    <h4> المجموع الكلي</h4>
    <h1 style="float:left;"><span class="badge badge-primary">
      <?php
      echo ($out_tools + $out_ouv);
      ?>
    </span></h1>

    </div>
  </div>
</div>
  
</div>
<br/><br/>

<div class="container-fluid">
<div class="card-deck">

<div class="card bg-light">
    <div class="card-body">
      <h4>مجموع المداخيل</h4>
      <h1 style="float:left;"><span class="badge badge-primary">
        <?php
        $req = "select sum(montant) from client_compte where client ='$client'";
        $res = mysqli_fetch_assoc(mysqli_query($db,$req));
        $in = $res['sum(montant)'];
        echo $in - 0;
        ?>
      </span></h1>

</div>
  </div>

  <div class="card bg-light">
    <div class="card-body">
    <h4>مجموع المصاريف</h4>
    <h1 style="float:left;"><span class="badge badge-primary">
    <?php
        $req = "select sum(montant_unitaire * quantite) from depenses where projet in (select id from projets where client = '$client')";        ;
        $res = mysqli_fetch_assoc(mysqli_query($db,$req));
        $out = $res['sum(montant_unitaire * quantite)'];
        $req = "select sum(montant) from ouvriers_projets where projet in (select id from projets where client = '$client')";
        $res = mysqli_fetch_assoc(mysqli_query($db,$req));
        $out_ouv = $res['sum(montant)'];
        echo ($out + $out_ouv) - 0;
        ?>
    </span></h1>

    </div>
  </div>

  <div class="card bg-light">
    <div class="card-body">
    <h4> الباقي</h4>
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
 <div class="row">

<div class="col" >
<h2>المصاريف</h2>

<input type="text" id="myInput" onkeyup="myFunction()" placeholder="البحث عن اسماء المصاريف ...">

<table id="myTable">
  <tr class="header">
  <th >اسم المصروف</th>
    <th >اسم المورد</th>
    <th > مبلغ الوحدة</th>
    <th > الكمية</th>
    <th > تاريخ المصروف</th>
    <th >الوصف</th>
    <th> خيارات</th>
  </tr>
<?php

$sql = "SELECT * from depenses where projet = '$project' ORDER BY id desc";
$result = mysqli_query($db, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $nom = $row['nom'];
        $fournisseur = $row['fournisseur'];
        $montant = $row['montant_unitaire'];
        $quantite = $row['quantite'];
        $date = $row['date'];
        $desc = $row['description'];
        $id_dep = $row['id'];
        $sql1 = "SELECT * from personnes where id = '$fournisseur'";
        $result1  = mysqli_query($db, $sql1);
        if (mysqli_num_rows($result1) > 0)
          $row1 = mysqli_fetch_assoc($result1);
          $fournisseur = $row1['nom_prenom'];

      echo '<tr>';
      echo '<td>'.$nom.'</td>';
      echo '<td>'.$fournisseur.'</td>';
      echo '<td>'.$montant.'</td>';
      echo '<td>'.html_entity_decode($quantite).'</td>';
      echo '<td>'.html_entity_decode($date).'</td>';
      echo '<td>'.html_entity_decode($desc).'</td>';
      echo "<td><form action=\"delete.php\"method=\"GET\">
      <input type=\"text\" name=\"depense\"value=\"$id_dep\"hidden/>
      <button type=\"submit\"class=\"btn btn-danger\">حذف</button>
      </form></td>";
      

      echo '</tr>';

    }
  }


?>
</table>
</div>
<div class="col">
<h2>العمال</h2>

<input type="text" id="myInput1" onkeyup="myFunction1()" placeholder="البحث عن اسماء العمال ...">

<table id="myTable1">
  <tr class="header">
  <th >اسم العامل</th>
    <th >المبلغ </th>
    <th >  التاريخ</th>
    <th > الوصف</th>
    <th>خيارات</th>
  </tr>
<?php

$sql = "SELECT * from ouvriers_projets where projet = '$project' ORDER BY id desc";
$result = mysqli_query($db, $sql);
if ($result) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $ouvrier = $row['ouvrier'];
        $montant = $row['montant'];
        $date = $row['date'];
        $desc = $row['description'];
        $id_ouvrier = $row['id'];
        $sql1 = "SELECT * from personnes where id = '$ouvrier'";
        $result1  = mysqli_query($db, $sql1);
        if (mysqli_num_rows($result1) > 0)
          $row1 = mysqli_fetch_assoc($result1);
          $ouvrier = $row1['nom_prenom'];

      echo '<tr>';
      echo '<td>'.$ouvrier.'</td>';
      echo '<td>'.$montant.'</td>';
      echo '<td>'.$date.'</td>';
      echo '<td>'.html_entity_decode($desc).'</td>';
      echo "<td><form action=\"delete.php\"method=\"GET\">
      <input type=\"text\" name=\"ouvrier\"value=\"$id_ouvrier\"hidden/>
      <button type=\"submit\"class=\"btn btn-danger\">حذف</button>
      </form></td>";
      

      echo '</tr>';

    }
  }

mysqli_close($db);

?>
</table></div>
</div>
</div>
</div>
<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
function myFunction1() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput1");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable1");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

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