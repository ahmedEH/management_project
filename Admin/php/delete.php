<?php
session_start();
include('db_conn.php');

if(!isset($_SESSION['user']))
{
header('location:./login.php');
}

if(isset($_GET['client_compte']))
{
    $in = $_GET['client_compte'];
    $req = "delete from client_compte where id = '$in'";
    mysqli_query($db,$req);
    header('location:client.php');


}
elseif(isset($_GET['projet']))
{
    $in = $_GET['projet'];
    $req = "delete from projets where id = '$in'";
    mysqli_query($db,$req);
    header('location:./client.php');
}
elseif(isset($_GET['depense']))
{
    $in = $_GET['depense'];
    $req = "delete from depenses where id = '$in'";
    mysqli_query($db,$req);
    header('location:project.php');


}
elseif(isset($_GET['ouvrier']))
{
    $in = $_GET['ouvrier'];
    $req = "delete from ouvriers_projets where id = '$in'";
    mysqli_query($db,$req);
    header('location:project.php');


}
elseif(isset($_GET['client']))
{
    $in = $_GET['client'];
    $req = "delete from personnes where id = '$in'";
    mysqli_query($db,$req);
    header("location:clients.php");
}
elseif(isset($_GET['work']))
{
    $in = $_GET['work'];
    $req = "delete from personnes where id = '$in'";
    mysqli_query($db,$req);
    header('location:./workers.php');


}
elseif(isset($_GET['four']))
{
    $in = $_GET['four'];
    $req = "delete from personnes where id = '$in'";
    mysqli_query($db,$req);
    header('location:./fournisseurs.php');


}
else{
    header('location:../error.html');
}


mysqli_close($db);

?>