<?php
session_start();
include('db_conn.php');

if(!isset($_SESSION['user']))
{
header('location:../error.html');
}
if(isset($_POST['projet']))
{
    $project = $_POST['projet'];
    $_SESSION['projet'] = $project;
    $client = $_POST['client'];
    $_SESSION['client'] = $client;

}
elseif(isset($_SESSION['projet']))
{
    $project = $_SESSION['projet'];
    $client = $_SESSION['client'];

}
else
{
    header('location:../error.html');
}

$r = "SELECT * from projets where id = '$project'";
$resu = mysqli_query($db,$r);
$res = mysqli_fetch_assoc($resu);
$nom_projet = $res['nom'];
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
table {
    table-layout: fixed;
    word-wrap: break-word;
}
</style>
</head>
<body>

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

  <a class="" href="../index.php" role="button">الصفحة الرئيسية</a>
<a class="" href="person_insert_inter.php?n=out">اضافة مصروف</a>
<a class=" " href="person_insert_inter.php?n=ouv">اضافة عامل</a>


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
  <p class="lead">اسم المشروع : <?php echo $nom_projet; ?> </p>

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
<div class="row">

<div class="col p-3 mx-3 my-3 rounded bg-success text-white">

      <h4>مجموع مصاريف الادوات</h4>
      <h3 style="float:left;"><span dir ="ltr"class="badge badge-primary">
        <?php
        $req = "select sum(montant_unitaire * quantite) from depenses where projet ='$project' ";
        $res = mysqli_fetch_assoc(mysqli_query($db,$req));
        $out_tools = $res['sum(montant_unitaire * quantite)'];
        $montant = $out_tools - 0;
        $montant = number_format($montant, 2, ',', ' ');
        echo $montant ;

        ?>
      </span></h3>


  </div>

  <div class="col p-3 mx-3 my-3 rounded bg-danger text-white">

    <h4>مجموع مصاريف العمال</h4>
    <h3 style="float:left;"><span dir ="ltr"class="badge badge-primary">
    <?php
        $req = "select sum(montant) from ouvriers_projets where projet = '$project'";
        $res = mysqli_fetch_assoc(mysqli_query($db,$req));
        $out_ouv = $res['sum(montant)'];
        $montant = $out_ouv - 0;
        $montant = number_format($montant, 2, ',', ' ');
        echo $montant ;

        ?>
    </span></h3>


  </div>

  <div class="col p-3 mx-3 my-3 rounded bg-secondary text-white">

    <h4> المجموع الكلي</h4>
    <h3 style="float:left;"><span dir ="ltr"class="badge badge-primary">
      <?php
              $montant = ($out_tools + $out_ouv);
              $montant = number_format($montant, 2, ',', ' ');
              echo $montant ;

      ?>
    </span></h3>


  </div>
</div>
  
</div>
<br/><br/>

<div class="container-fluid">
<div class="row">

<div class="col p-3 mx-3 my-3 rounded bg-light">

      <h4>مجموع المداخيل</h4>
      <h3 style="float:left;"><span dir ="ltr"class="badge badge-primary">
        <?php
        $req = "select sum(montant) from client_compte where client ='$client'";
        $res = mysqli_fetch_assoc(mysqli_query($db,$req));
        $in = $res['sum(montant)'];
        $montant = $in - 0;
        $montant = number_format($montant, 2, ',', ' ');
        echo $montant ;

        ?>
      </span></h3>


  </div>

  <div class="col p-3 mx-3 my-3 rounded bg-light">

    <h4>مجموع المصاريف</h4>
    <h3 style="float:left;"><span dir ="ltr"class="badge badge-primary">
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
    </span></h3>


  </div>

  <div class="col p-3 mx-3 my-3 rounded bg-light">

    <h4> الباقي</h4>
    <h3 style="float:left;"><span dir ="ltr"class="badge badge-primary">
      <?php
      $montant = ($in - ($out + $out_ouv)) - 0;
      $montant = number_format($montant, 2, ',', ' ');
      echo $montant ;
      ?>
    </span></h3>


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
        $montant = number_format($montant, 2, ',', ' ');
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
      echo '<td dir="ltr"><strong>'.$montant.'</strong></td>';
      echo '<td>'.html_entity_decode($quantite).'</td>';
      echo '<td dir="ltr">'.$date.'</td>';
      echo '<td>'.html_entity_decode($desc).'</td>';
      echo "<td class=\"row\"><form class = \"col d-inline\"action=\"delete.php\"method=\"GET\">
      <input type=\"text\" name=\"depense\"value=\"$id_dep\"hidden/>
      <input  class=\"my-1 btn btn-danger\" type=\"button\" onClick=\"confSubmit(this.form);\" value=\"حذف\">
      </form>";
      echo "<form class = \"col d-inline\"action=\"getout_form.php\"method=\"POST\">
      <input type=\"text\" name=\"projet\"value=\"$project\"hidden/>
      <input type=\"text\" name=\"out\"value=\"$id_dep\"hidden/>
      <input name = \"edit_p_d\"class=\"my-1 btn btn-warning\" type=\"submit\" value=\"تعديل\">
      </form></td>";
      echo '</tr>';
      
      

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
        $montant = number_format($montant, 2, ',', ' ');
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
      echo '<td dir="ltr"><strong>'.$montant.'</strong></td>';
      echo '<td dir="ltr">'.$date.'</td>';
      echo '<td>'.html_entity_decode($desc).'</td>';
      echo "<td class=\"row\"><form class = \"col d-inline\"action=\"delete.php\"method=\"GET\">
      <input type=\"text\" name=\"ouvrier\"value=\"$id_ouvrier\"hidden/>
      <input  class=\"my-1 btn btn-danger\" type=\"button\" onClick=\"confSubmit(this.form);\" value=\"حذف\">
      </form>";
      
      echo "<form class = \"col d-inline\"action=\"ouvrier_add.php\"method=\"POST\">
      <input type=\"text\" name=\"projet\"value=\"$project\"hidden/>
      <input type=\"text\" name=\"ouvrier\"value=\"$id_ouvrier\"hidden/>
      <input name=\"edit_p_o\"class=\"my-1 btn btn-warning\" type=\"submit\" value=\"تعديل\">
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

function confSubmit(form) {
if (confirm("هل انت متأكد من انك تريد الحذف؟")) {
form.submit();
}
}
</script>
</body>
</html>