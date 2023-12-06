<?php


  include './dbAbfragenInit.php';
  $Db= new DB();

  $Nachname=$_GET['Nachname'];
  $Vorname= $_GET['Vorname'];
  $Email= $_GET['Email'];
  $Passwort= $_GET['Passwort'];
  $Passwortwiderholen= $_GET['Passwortwiderholen'];
  $Db->Registriren($Nachname,$Vorname,$Email,$Passwort,$Passwortwiderholen);

  



?>