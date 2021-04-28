<?php
//select * from depenses where projet in (select id from projets where client = 9);
//select * from ouvriers_projets where projet in (select id from projets where client = 5);
session_start();
include('db_conn.php');

if(!isset($_SESSION['user']))
{
  header('location:../error.html');
}
if(isset($_POST['client']))
{
    $client = $_POST['client'];

}
elseif(isset($_SESSION['client']))
{
    $client = $_SESSION['client'];

}

else{
    header('location:../error.html');
}
$sql = "select * from personnes where id = '$client'";
$resu = mysqli_query($db,$sql);
$ro = mysqli_fetch_assoc($resu);
$nom_client = $ro['nom_prenom'];
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

table {
    table-layout: fixed;
    word-wrap: break-word;
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
  <form action="person_insert_inter.php"method="post">
  <input type="text" name="client"value="<?php echo $client;?>"hidden/>
  <input type="text" name="nom_client"value="<?php echo $nom_client;?>"hidden/>
  <button class="url"name = "btn_in"> اضافة مدخول</button>
  </form>
  <form action="person_insert_inter.php"method="post">
  <input type="text" name="client"value="<?php echo $client;?>"hidden/>
  <input type="text" name="nom_client"value="<?php echo $nom_client;?>"hidden/>
  <button class="url" name = "btn_projet"> اضافة مشروع</button>
  </form>
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
  <p class="lead">مر حبا بكم في مشاريع الزبون : <?php echo $nom_client;?> </p>
</div>
<!-- Image and text -->
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
  <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; الخيارات</span>
    <a class="navbar-brand" href="#">
      <img src="/cheikh_entrepreneur/img/logo.jpg" alt="" width="150" height="50" class="d-inline-block align-top">
    </a>
    
  </div>
</nav>

<br/><br/>

<div class="container-fluid">
<div class="row">

<div class="col mx-3 p-3 rounded my-3 bg-success text-white">

      <h2>مجموع المداخيل</h2>
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

  <div class="col mx-3 p-3 rounded my-3 bg-danger text-white">

    <h2>مجموع المصاريف</h2>
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

  <div style = "overflow: cover;"class="col mx-3 p-3 rounded my-3 bg-warning text-white">

    <h2> الباقي</h2>
    <h3 style="float:left;"><span dir ="ltr"class="badge badge-primary">
      <?php

      $montant = ($in - ($out + $out_ouv)) - 0;
      $montant = number_format($montant, 2, ',', ' ');
      echo $montant ;
      ?>
    </span></h3>


  </div>
  <div class="col mx-3 p-3 rounded my-3 bg-light ">

    <h4> المشاريع</h4>
    <h3 style="float:left;"><span class="badge badge-primary">
    <?php
        $req = "select count(*) from projets where client = '$client'";
        $res = mysqli_fetch_assoc(mysqli_query($db,$req));
        $out = $res['count(*)'];
        echo $out - 0;
        ?>
    </span></h3>


  </div>
</div>
  
</div>
<br/><br/>
<div class="container-fluid">
 <div class="row">
<div class="col">
<h2>المداخيل</h2>

<input type="text" id="myInput" onkeyup="myFunction()" placeholder="البحث عن اسماء المدخلين ...">

<table id="myTable">
  <tr class="header">
    <th >اسم المدخل</th>
    <th > المبلغ</th>
    <th >تاريخ  </th>
    <th >  الوصف</th>
    <th >  الخيارات</th>

  </tr>
<?php

$sql = "SELECT * from client_compte where client = '$client' ORDER BY id desc";
$result = mysqli_query($db, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $verseur = $row['verseur'];
        $montant = $row['montant'];
        $montant = number_format($montant, 2, ',', ' ');
        $date = $row['date_v'];
        $desc = $row['description'];
        $id = $row['id'];
        echo '<tr>';
        echo '<td>'.$verseur.'</td>';
        echo '<td dir="ltr"><strong>'.$montant.'</strong></td>';
        echo '<td dir="ltr">'.$date.'</td>';
        echo '<td>'.html_entity_decode($desc).'</td>';
        echo "<td class = \"row\"><form class=\"col d-inline\"action=\"delete.php\"method=\"GET\">
        <input type=\"text\" name=\"client_compte\"value=\"$id\"hidden/>
        <input class=\"btn btn-danger my-1\" type=\"button\" onClick=\"confSubmit(this.form);\" value=\"حذف\">
        </form>";
        echo "<form class=\"col d-inline\"action=\"client_in_form.php\"method=\"POST\">
        <input type=\"text\" name=\"in\"value=\"$id\"hidden/>
        <input type=\"text\" name=\"client\"value=\"$client\"hidden/>
        <input type=\"text\" name=\"nom_client\"value=\"$nom_client\"hidden/>
        <input name=\"edit_c_i\"class=\"btn btn-warning my-1\" type=\"submit\" value=\"تعديل\">
        </form></td>";

        echo '</tr>';

    }
  }


?>
</table>
</div>


<div class="col">
<h2>المشاريع</h2>

<input type="text" id="myInput1" onkeyup="myFunction1()" placeholder="البحث عن اسماء المشاريع ...">

<table id="myTable1">
  <tr class="header">
  <th >اسم المشروع</th>
    <th >تاريخ التسجيل </th>
    <th > الوصف</th>
    <th > الخيارات</th>


    
  </tr>
<?php

$sql = "SELECT * from projets where client = '$client' ORDER BY id desc ";
$result = mysqli_query($db, $sql);
if ($result) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $nom = $row['nom'];
        $date = $row['date_debut'];
        $desc = $row['description'];
        $projet = $row['id'];
        echo '<tr>';
        echo '<td>'.$nom.'</td>';
        echo '<td dir="ltr">'.$date.'</td>';
        echo '<td>'.$desc.'</td>';
        echo "<td class=\" p-0 container-fluid\"><form class=\"col d-inline  \"action=\"delete.php\"method=\"GET\">
        <input type=\"text\" name=\"projet\"value=\"$projet\"hidden/>
        <input type=\"text\" name=\"client\"value=\"$client\"hidden/>
        <input  class=\"my-1 btn btn-danger\" type=\"button\" onClick=\"confSubmit(this.form);\" value=\"حذف\">
        </form>";

        echo "<form class=\"col d-inline  \"action=\"projet_insert.php\"method=\"POST\">
        <input type=\"text\" name=\"projet\"value=\"$projet\"hidden/>
        <input type=\"text\" name=\"client\"value=\"$client\"hidden/>
        <input type=\"text\" name=\"nom_client\"value=\"$nom_client\"hidden/>
        <input name=\"edit_c_p\"class=\"btn btn-warning my-1\" type=\"submit\" value=\"تعديل\">
        </form>";

        echo "<form class=\"col d-inline  \"action=\"project.php\"method=\"post\">
        <input type=\"text\" name=\"projet\"value=\"$projet\"hidden/>
        <input type=\"text\" name=\"client\"value=\"$client\"hidden/>
        <button class=\"my-1 btn btn-primary\">زيارة</button>
        </form>";

        echo "<form class=\"col d-inline  \"action=\"relevee_project.php\"method=\"POST\">
        <input type=\"text\" name=\"projet\"value=\"$projet\"hidden/>
        <input name=\"project_relevee\"class=\"btn btn-info my-1\" type=\"submit\" value=\"كشف\">
        </form></td>";
      

      echo '</tr>';

    }
  }
  else{
    echo "لا يزال هذا الزبون  بدون مشاريع";
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