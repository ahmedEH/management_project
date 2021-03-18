<?php
session_start();
include('db_conn.php');

if(!isset($_SESSION['user']))
{
header('location:php/login.php');
}




if(isset($_POST['en']))
{
    $nom = $_POST['nom'];
    $tel = $_POST['tel'];
    $wtsp = $_POST['wtsp'];
    $add = $_POST['add'];
    $fonction = $_POST['fonc'];
    $sql = "INSERT INTO personnes (nom_prenom, tel, wtsp, adresse,fonction)
VALUES ('$nom','$tel','$wtsp','$add','$fonction')";

if (mysqli_query($db, $sql)) {
  header("location:../index.php?e=1");
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($db);
}


}
mysqli_close($db);