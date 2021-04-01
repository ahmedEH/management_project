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
  header("location:./person_insert.php");
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($db);
}


}
elseif(isset($_POST['edit_p']))
{
    $nom = $_POST['nom'];
    $tel = $_POST['tel'];
    $wtsp = $_POST['wtsp'];
    $add = $_POST['add'];
    $person = $_POST['person'];
    $sql = "UPDATE personnes 
            SET nom_prenom = '$nom', tel = '$tel', wtsp = '$wtsp', adresse = '$add'
            WHERE id = '$person'";

if (mysqli_query($db, $sql)) {
  if(isset($_SESSION['fonction']))
  {
    if($_SESSION['fonction'] == "ouvrier") header("location:workers.php");
    if($_SESSION['fonction'] == "fournisseur") header("location:fournisseurs.php");
    if($_SESSION['fonction'] == "clients") header("location:clients.php");
  }
  else 
    header("location:../error.html");
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($db);
}


}
mysqli_close($db);