<?php
namespace abox;
require("../../lib/std.php");
ob_start();

//$stage = qout('select * from ProjectStages',Types::ARRAY)[0];
?>

<nav class="lt ab-w25% ns tct">
	<div class="ab-hiddenscrollable">
		<nav><input type="search" onkeypress="ab_apply(function(a){str=a;seekDestroy.fire();},this.value)"><label><icon>&#x55;</icon></label></nav>
		<div class="bar"></div>
		<nav class="ab-t80% abs ab-l1%">
			<button type="submit" class="bspan ab-tooltip" 	onclick="ab_load('/projects/mod.php',
																	{mode:abox.Modes.NEW,
																	 part:abox.Parts.PT1},
																	 160,
																	 null,
																	 true)"
														 	data-content="Novo Projeto"><icon class="fb fntcolor">&#xe0ec;<icon class="fs">&#x4c;</icon></icon></button>
			<button type="submit" class="bspan ab-tooltip" 	onclick="ab_load('/projects/architecture/mod.php',
																		{mode:abox.Modes.NEW},
																		 160,
																		 null,
																		 true)"
															data-content="Nova Arquitetura"><icon class="fb fntcolor">&#xe038;<icon class="fs">&#x4c;</icon></icon></button>
			
	</nav>
	</div>
</nav>

<!PROJETOS>
<section class="abs ns ab-w75% hf __PROJINI__" style="top:0;left: 25%;">
	<div class="ab-innerscrollable __PROJETOS__"></div></section>


<script>
ab_switches();
ab_fills();
ab_tooltips();

var str="";
var seekDestroy = new ab_Throttle(function()
{
	$("#::id .__PROJETOS__").remove();
	$('#::id .__PROJINI__').append('\
		<div class=\"ab-innerscrollable __PROJETOS__\"></div>');
	var q,projpesq;
	q = "name like '"+str+"%'";
	projpesq = new ab_Data({
		table:"Projects",
		mode:abox.Modes.VIEW,
		restrictions:q+" having stts=1"
	});

	projpesq.bind(project_hub_tmp,$("#::id .__PROJETOS__"), function(){
		$("#::id .projrow").each(function(){
			with($(this)){
				if(!data("__BINDED__")){
					data("__BINDED__",1);

					var code = find(".projrowcode").text().trim();
					var nameproj = find(".projrowname").text().trim();
					var teampack = find(".projrowteampack").text().trim();

					var stcdproj = new ab_Data({
						table:"ProjectStages",
				        mode:abox.Queries.VIEW,
				        controller:"projects/stage/handler.php",
				        restrictions:"stts=1 having proj='"+code+"'"
					});

					var st1 = stcdproj['obj'];
					var st2 = st1[0];
					var st3 = st2['vers'];

					var stgcurr = new ab_Data({
						table:"faseatual",
				        mode:abox.Queries.VIEW,
				        controller:"projects/stage/current/handler.php",
				        restrictions:"codestg='"+st2['curr']+"' having projeto='"+code+"'"
					});

					var cur1 = stgcurr['obj'];
					var cur2 = cur1[0];
					var cur3 = cur2['nome'];

					find(".projrowteam").on('click',function(){ab_load("projects/team/mod.php",{codeproj:code});});
					find(".projrowup").on('click',function(){ab_load("projects/upload.php",{codeproj:code});});
					find(".projrowview").on('click',function(){ var url_ = "project/projects/pdf/pdf.php?codigo="+code; window.open(url_,"_blank");});
					find(".projrowcron").on('click',function(){ab_load("projects/schedule/choice.php",{codeproj:code})});
					find(".projrowedit").on('click',function(){ab_load("projects/mod.php", {mode:abox.Modes.EDIT,
																							codeproj:code,
																							part:abox.Parts.PT1},
																							160,null,true);})
					find(".projrowcaus").on('click',function(){ab_load("projects/use_case/hub.php",{codeproj:code});});
					find(".projrowchrq").on('click',function(){ab_load("projects/requirement/choice.php",{codeproj:code});});
					find(".projrownext").on('click',function(){ab_load("projects/choice.php",{codeproj:code,
																							  control:1,
																							  version:st3,
																							  currentstg:cur2['codearcstg']});});
					find(".projrowback").on('click',function(){ab_load("projects/choice.php",{codeproj:code,
																							  control:2,
																							  version:st3,
																							  currentstg:cur2['codearcstg']});});
					find(".projrowvers").append(st3);
					find(".projrowstage").append(cur3);
					find(".projrowdel0").on('click',function(){
														    $(this).parent().remove();
														    var projrmv = new ab_Data({
														        table:"Projects",
														        mode:abox.Queries.UPDATE,
														        controller:"projects/handler.php",
														        restrictions:"code='"+code+"'"
														    });
														    projrmv.attr('stts',0);
														    projrmv.query(function(d){
														        if(d==1){projrmv.attr('stts','0');}
														    });
														    ab_success("Projeto removido");
														});
					if(teampack!=="teamaboxaboxaboxaboxaboxaboxabox")
					{
						find(".projrowphoto").attr('src', "data/teampack/"+ teampack + "/logo.png");
					}else{find(".projrowphoto").attr('src', "img/std/logo-no.png");}
					
					attr('id',code);
				}
				animate({opacity:1,"margin-top":".75vh"},100+5*index().int());


			}
		});
	});
});

var project_hub_tmp = $(ab_strcall("projects/tmp_row.php"));
function project_hub_start(args=null){
	if(args==null){return;}
	prrj = new ab_Data({
		table:"Projects",
		mode:abox.Modes.VIEW,
		restrictions:"stts=1"
	});

	prrj.bind(project_hub_tmp,$("#::id .__PROJETOS__"), function(){
		$("#::id .projrow").each(function(){
			with($(this)){
				if(!data("__BINDED__")){
					data("__BINDED__",1);

					var code = find(".projrowcode").text().trim();
					var nameproj = find(".projrowname").text().trim();
					var teampack = find(".projrowteampack").text().trim();

					var stcdproj = new ab_Data({
						table:"ProjectStages",
				        mode:abox.Queries.VIEW,
				        controller:"projects/stage/handler.php",
				        restrictions:"stts=1 having proj='"+code+"'"
					});

					var st1 = stcdproj['obj'];
					var st2 = st1[0];
					var st3 = st2['vers'];

					var stgcurr = new ab_Data({
						table:"faseatual",
				        mode:abox.Queries.VIEW,
				        controller:"projects/stage/current/handler.php",
				        restrictions:"codestg='"+st2['curr']+"' having projeto='"+code+"'"
					});

					var cur1 = stgcurr['obj'];
					var cur2 = cur1[0];
					var cur3 = cur2['nome'];



					find(".projrowteam").on('click',function(){ab_load("projects/team/mod.php",{codeproj:code});});
					find(".projrowup").on('click',function(){ab_load("projects/upload.php",{codeproj:code});});
					find(".projrowview").on('click',function(){ var url_ = "project/projects/pdf/pdf.php?codigo="+code; window.open(url_,"_blank");});
					find(".projrowcron").on('click',function(){ab_load("projects/schedule/choice.php",{codeproj:code})});
					find(".projrowedit").on('click',function(){ab_load("projects/mod.php", {mode:abox.Modes.EDIT,
																							codeproj:code,
																							part:abox.Parts.PT1},
																							160,null,true);})
					find(".projrowcaus").on('click',function(){ab_load("projects/use_case/hub.php",{codeproj:code});});
					find(".projrowchrq").on('click',function(){ab_load("projects/requirement/choice.php",{codeproj:code});});
					find(".projrownext").on('click',function(){ab_load("projects/choice.php",{codeproj:code,
																							  control:1,
																							  version:st3,
																							  currentstg:cur2['codearcstg']});});
					find(".projrowback").on('click',function(){ab_load("projects/choice.php",{codeproj:code,
																							  control:2,
																							  version:st3,
																							  currentstg:cur2['codearcstg']});});
					find(".projrowvers").append(st3);
					find(".projrowstage").append(cur3);
					find(".projrowdel0").on('click',function(){
														    $(this).parent().remove();
														    var projrmv = new ab_Data({
														        table:"Projects",
														        mode:abox.Queries.UPDATE,
														        controller:"projects/handler.php",
														        restrictions:"code='"+code+"'"
														    });
														    projrmv.attr('stts',0);
														    projrmv.query(function(d){
														        if(d==1){projrmv.attr('stts','0');}
														    });
														    ab_success("Projeto removido");
														});
					if(teampack!=="teamaboxaboxaboxaboxaboxaboxabox")
					{
						find(".projrowphoto").attr('src', "data/teampack/"+ teampack + "/logo.png");
					}else{find(".projrowphoto").attr('src', "img/std/logo-no.png");}
					
					attr('id',code);
				}
				animate({opacity:1,"margin-top":".75vh"},100+5*index().int());


			}
		});
	});
}
project_hub_start("Projetos");
</script>


<?php
$oi = ob_get_clean();

ob_start();
?>


<?php

$janela = new Modal('pjthb', "PAINEL DE CONTROLE PROJETOS", "window");
$janela->body($oi);
$janela->barpaint('lightgray');
//$janela->buttons([""]); selecionar botões que aparecera
$janela->print();

?>