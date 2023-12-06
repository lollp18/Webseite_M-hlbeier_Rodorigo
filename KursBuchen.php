<?php

include "./dbAbfragenInit.php";

$DB=new DB();

$Datum=$_GET["Datum"];
$KursID=$_GET["KursID"];
$SchülerID=$_GET["SchülerID"];
$DB->UpdateKurseAnzahlFreiPlus($KursID);
$DB->KurseBuchen($Datum,$KursID,$SchülerID);

?>