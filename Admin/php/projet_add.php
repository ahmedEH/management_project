<?php
session_start();
include('db_conn.php');

if(!isset($_SESSION['user']))
{
header('location:php/login.php');
}




if(isset($_POST['en_project']))
{
    $nom = $_POST['nom'];
    $client = $_POST['client'];
    $desc = $_POST['desc'];
    $date=date('Y-m-d');
    $sql = "INSERT INTO projets (nom,description,date_debut,client)
VALUES ('$nom','$desc','$date','$client')";

if (mysqli_query($db, $sql)) {
  header("location:../index.php?e=1");
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($db);
}


}
mysqli_close($db);