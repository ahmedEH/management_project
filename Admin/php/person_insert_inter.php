<?php

session_start();

if(isset($_POST['fonction']))
{
    $_SESSION['fonction'] = $_POST['fonction'];

    header("location:person_insert.php");
}
elseif(isset($_POST{'btn_in'}))
{
    $_SESSION['client'] = $_POST['client'];
    $_SESSION['nom_client'] = $_POST['nom_client'];

    header("location:client_in_form.php");
}
elseif(isset($_POST{'btn_projet'}))
{
    $_SESSION['client'] = $_POST['client'];
    $_SESSION['nom_client'] = $_POST['nom_client'];

    header("location:projet_insert.php");
}
elseif(isset($_GET{'n'}))
{   


    if($_GET['n'] == "out")
    {

        header("location:getout_form.php");
    }
    elseif($_GET['n'] == "ouv")
    {

        header("location:ouvrier_add.php");
    }
}
?>

