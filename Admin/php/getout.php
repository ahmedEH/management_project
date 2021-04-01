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
  $date=date('Y-m-d H:i:s');
  $sql = "INSERT INTO depenses (date,montant_unitaire,description,quantite,projet,fournisseur,nom) VALUES ('$date','$montant','$desc','$quantite','$projet','$fournisseur','$nom_depense')";
  if (mysqli_query($db, $sql))
  {
    header("location:getout_form.php");
  } 
  else
  {
    echo "Error: " . $sql . "<br>" . mysqli_error($db);
  }
  }
elseif(isset($_POST['edit_p_d']))
{
  $out = $_POST['out'];
  $fournisseur = $_POST['fournisseur'];
  $desc = $_POST['desc'];
  $montant = $_POST['montant'];
  $quantite = $_POST['quantite'];
  $nom_depense = $_POST['nom_depense'];
  $sql = "UPDATE depenses
  SET montant_unitaire = '$montant', quantite= '$quantite', description = '$desc', fournisseur = '$fournisseur', nom = '$nom_depense'
  WHERE id = '$out'";
  if (mysqli_query($db, $sql))
  {
    header("location:project.php");
  } 
  else
  {
    echo "Error: " . $sql . "<br>" . mysqli_error($db);
  }
  }
mysqli_close($db);

?>