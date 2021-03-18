<?php
session_start();
include('db_conn.php');
if(!isset($_SESSION['user']))
{
  header('location:php/login.php');
}
if(isset($_POST['en_out']))
{
  $projet = $_POST['projet'];
  $fournisseur = $_POST['fournisseur'];
  $desc = $_POST['desc'];
  $montant = $_POST['montant'];
  $quantite = $_POST['quantite'];
  $nom_depense = $_POST['nom_depense'];
  $date=date('Y-m-d');
  $sql = "INSERT INTO depenses (date,montant_unitaire,description,quantite,projet,fournisseur,nom) VALUES ('$date','$montant','$desc','$quantite','$projet','$fournisseur','$nom_depense')";
  if (mysqli_query($db, $sql))
  {
    header("location:../index.php?e=1");
  } 
  else
  {
    echo "Error: " . $sql . "<br>" . mysqli_error($db);
  }
  }
mysqli_close($db);

?>