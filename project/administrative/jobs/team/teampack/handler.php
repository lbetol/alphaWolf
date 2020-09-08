<?php
namespace abox;
require("../../../../../includes.php");

$stts = true;
$mode = post("mode");
$data = post("data");

if($mode == Queries::INSERT){

$padrao = root("data/teampack/".$data['code'], Types::FOLDER , Locations::ROOT , true);

	

$imgp  = root("img/std/logo.png" ,Types::FILE, Locations::ROOT);
	copy($imgp,$padrao."logo.png");
}


if($stts){
	$o = new Data("TeamPacks",$data);
	$o->build($mode);
	echo $o->query();
	//echo $o->seeQuery();
}