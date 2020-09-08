<?php
namespace abox;
require("../../../../includes.php");

$stts = true;
$mode = post("mode");
$data = post("data");

if($mode == Queries::UPDATE && strlen($data['pswd'])<32){
	$data['pswd'] = hash_it($data['code'].$data['pswd']);
};


if($stts){
	$o = new Data("Users",$data);
	$o->build($mode);
	echo $o->query();
	//echo $o->seeQuery();
}