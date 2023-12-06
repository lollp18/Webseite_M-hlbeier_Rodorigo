<?php

include "./dbAbfragenInit.php";

$DB=new DB();

$SchülerID=$_GET["SchülerID"];
$KursID=$_GET["KursID"];
$DB->EndBuchen($SchülerID,$KursID);
$DB->UpdateKurseAnzahlFreiMinus($KursID);

?>