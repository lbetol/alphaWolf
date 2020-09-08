<?php
namespace abox;
require("../../../../includes.php");

$stts = true;
$mode = post("mode");
$data = post("data");	

if($mode == Queries::INSERT){

$padrao = root("data/wolf/".$data['code'], Types::FOLDER , Locations::ROOT , true);

	

$imgp  = root("img/std/user.png" ,Types::FILE, Locations::ROOT);
	copy($imgp,$padrao."wolf.png");
}



if($stts){
	$o = new Data("Managers",$data);
	$o->build($mode);
	echo $o->query();
	//echo $o->seeQuery();
}

?>