<?php
session_start();
include('db_conn.php');

if(!isset($_SESSION['user']))
{
header('location:php/login.php');
}




if(isset($_POST['en_ouv']))
{
    $projet = $_POST['projet'];
    $ouvrier = $_POST['ouvrier'];
    $desc = $_POST['desc'];
    $montant = $_POST['montant'];
    $date=date('Y-m-d  H:i');
    $sql = "INSERT INTO ouvriers_projets (ouvrier,projet,montant,date,description)
VALUES ('$ouvrier','$projet','$montant','$date','$desc')";

if (mysqli_query($db, $sql)) {
  header("location:../index.php?e=1");
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($db);
}


}
mysqli_close($db);