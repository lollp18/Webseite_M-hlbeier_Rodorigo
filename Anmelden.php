<?php

include './dbAbfragenInit.php';
$Db= new DB();
$Email=$_GET["Email"];
$Passwort=$_GET["Passwort"];


$Db->Anmelden($Email,$Passwort);

?>