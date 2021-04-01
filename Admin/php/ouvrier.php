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
    $date=date('Y-m-d H:i:s');
    $sql = "INSERT INTO ouvriers_projets (ouvrier,projet,montant,date,description)
VALUES ('$ouvrier','$projet','$montant','$date','$desc')";

if (mysqli_query($db, $sql)) {
  header("location:ouvrier_add.php");
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($db);
}


}
elseif(isset($_POST['edit_p_o']))
{
    $ouvrier = $_POST['ouvrier'];
    $desc = $_POST['desc'];
    $montant = $_POST['montant'];
    $id = $_POST['ouv'];
    $sql = "UPDATE ouvriers_projets
    SET montant = '$montant', ouvrier= '$ouvrier', description = '$desc'
    WHERE id = '$id'";

if (mysqli_query($db, $sql)) {
  header("location:project.php");
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($db);
}


}

mysqli_close($db);