<?php
namespace abox;
require("../../../../includes.php");




$stts = true;
$mode = post("mode");
$data = post("data");




if($stts){
	$o = new Data("NoFunctionalRequirements",$data);
	$o->build($mode);
	echo $o->query();
	//echo $o->seeQuery();
}