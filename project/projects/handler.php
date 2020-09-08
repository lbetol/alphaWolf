<?php
namespace abox;
require("../../includes.php");

$stts = true;
$mode = post("mode");
$data = post("data");




if($stts)
{
	$o = new Data("Projects",$data);
	$o->build($mode);
	echo $o->query();
	//echo $o->seeQuery();
}

if($mode == Queries::INSERT)
{
	$stage    = qout('select * from Stages where arch="'.$data["arch"].'" having numf=1',Types::ARRAY)[0];
	$maxstage = qout('select max(numf) from Stages where arch="'.$data["arch"].'"',      Types::ARRAY)[0];
	$max 	  = $maxstage['max(numf)'];	
	$codestg  = $stage["code"];
	$in       = $max -1;
	$verin    = "1";


	for ($i=$in; $i > 0; $i--) {
	    $verin .= ".0";
	}


	$ob = new Data('ProjectStages',[
	'code'=>get_hash(),
	'stts'=>1,
	'date'=>(new Date())->today(),
	'user'=>user(),
	'curr'=>$codestg,
	'vers'=>$verin,
	'proj'=>$data["code"]
	]);
	$ob->build($mode);
	echo $ob->query();
	//echo $ob->seeQuery();
}

