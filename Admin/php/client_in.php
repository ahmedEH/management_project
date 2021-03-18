<?php
session_start();
include('db_conn.php');

if(!isset($_SESSION['user']))
{
header('location:php/login.php');
}




if(isset($_POST['en_client_in']))
{
    $verseur = $_POST['verseur'];
    $client = $_POST['client'];
    $desc = $_POST['desc'];
    $montant = $_POST['montant'];
    $date=date('Y-m-d');
    $sql = "INSERT INTO client_compte (client,montant,date_v,verseur,description)
VALUES ('$client','$montant','$date','$verseur','$desc')";

if (mysqli_query($db, $sql)) {
  header("location:../index.php?e=1");
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($db);
}


}
mysqli_close($db);