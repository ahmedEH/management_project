<?php
session_start();
include('db_conn.php');

if(!isset($_SESSION['user']))
{
header('location:php/login.php');
}
?>


<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <title>المشاريع</title>
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

.sidenav a ,.navbar-item{
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
<div style="padding:10px;"class="jumbotron">
  <h1 class="display-4">لائحة المشاريع</h1>
  <p class="lead">هنا يمكنك زيارة مشروع بعينه </p>
  <hr class="my-4">
  <p>يمكنك ايضا الرجوع الى الصفحة الرئيسة اذا اردت</p>
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="../index.php" role="button">الصفحة الرئيسية</a>
  </p>
</div>
<div class="container-fluid">
<h2>المشاريع</h2>

<input type="text" id="myInput" onkeyup="myFunction()" placeholder="البحث عن اسماء المشاريع ..." >

<table id="myTable">
  <tr class="header">
    <th >اسم المشروع</th>
    <th >صاحب المشروع</th>
    <th >وصف المشروع</th>
    <th >تاريخ تسجيل المشروع</th>
    <th >خيارات</th>
  </tr>
<?php

$sql = "SELECT * from projets ORDER BY id desc";
$result = mysqli_query($db, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $id_project = $row['id'];
        $client = $row['client'];
        $sql1 = "SELECT * from personnes where id = '$client'";
        $result1  = mysqli_query($db, $sql1);
        if (mysqli_num_rows($result1) > 0)
          $row1 = mysqli_fetch_assoc($result1);

      echo '<tr>';
      echo '<td>'.$row['nom'].'</td>';
      echo '<td>'.$row1['nom_prenom'].'</td>';
      echo '<td>'.$row['description'].'</td>';
      echo '<td>'.html_entity_decode($row['date_debut']).'</td>';
      echo "<td>  <form action=\"project.php\"method=\"post\">
      <input type=\"text\" name=\"projet\"value=\"$id_project\"hidden/>
      <input type=\"text\" name=\"client\"value=\"$client\"hidden/>
      <button class=\"btn btn-primary\">زيارة</button>
      </form></td>";

      echo '</tr>';

    }
  }
mysqli_close($db);

?>
</table>
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