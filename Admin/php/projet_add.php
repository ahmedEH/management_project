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
    $date=date('Y-m-d H:i:s');
    $sql = "INSERT INTO projets (nom,description,date_debut,client)
VALUES ('$nom','$desc','$date','$client')";

if (mysqli_query($db, $sql)) {
  header("location:projet_insert.php");
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($db);
}


}
if(isset($_POST['edit_c_p']))
{
    $nom = $_POST['nom'];
    $projet = $_POST['projet'];
    $desc = $_POST['desc'];
    $sql = "UPDATE projets
    SET nom = '$nom', description = '$desc'
    WHERE id = '$projet'";

if (mysqli_query($db, $sql)) {
  if(isset($_POST['projects']))     
  header("location:projects.php");
  else
  header("location:client.php");
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($db);
}


}
mysqli_close($db);