<?php

include "./dbAbfragenInit.php";

$DB=new DB();

$SchülerID=$_GET["SchülerID"];
$DB->GetGebucht($SchülerID)
?>