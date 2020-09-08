<?php
namespace abox;
require("../../../includes.php");
ob_start();
$codeproj=post("codeproj");
$check = qout('select * from Projects where code="'.$codeproj.'"',Types::ARRAY)[0];
if(!$check['tpck']==null)
{
	$checkteam = $check['tpck'];
	$selmatilha = qout('select * from TeamPacks where code="'.$checkteam.'"',Types::ARRAY)[0];
	$matilha = $selmatilha['name'];
	$checkloadman  = qio('select * from wolfMan  where IDAlcateia="'.$checkteam.'"');
	$checkloaddesi = qio('select * from wolfDesi where IDAlcateia="'.$checkteam.'"');
	$checkloaddeve = qio('select * from wolfDeve where IDAlcateia="'.$checkteam.'"');
	$checkloadeng  = qio('select * from wolfEng  where IDAlcateia="'.$checkteam.'"');
	$checkloaddba  = qio('select * from wolfDba  where IDAlcateia="'.$checkteam.'"');
}else{
	$matilha="";
	$checkteam ="";
}

?>

<section class="abs ab-w100% ab-h100% hf ns" >
    <div class="ab-scope bar ab-h100% __nome__">

    	<label class="fb flt lt abs hpd">EQUIPE RESPONSÁVEL PELO PROJETO</label>
    	<label class="fb flt hpd .__nome__" style="margin-left: 70%"></label>

    	

    	<div class="xts">
			<select class="ab-fill" name="selteampak" data-content="TeamPacks;name"  data-control="::id;tpck">

			</select>
			<icon class="hpd fn cur fblue fbd ab-tooltip" data-content="Selecionar equipe" onclick="ab_apply(function(){
				matilha__ = $('#::id [name=selteampak] option:selected').text();
				$('#::id .apagar').remove();
				$('#::id .apagar_logo').remove();
				$('#::id .__nome__').append('\
					<label class=\'fb flt apagar hpd\' style=\'margin-left: 70%\'>'+matilha__+'</label>');
				show_logo('0');

				wolfteamc = wolfteamc + wolfteamc;
			 	$('#::id .__wolfs__').append('\
					<div class=\'apagar ab-w100% hpd lt '+wolfteamc+'\'></div>');
				teamman_hub_start('wolfMan','0');

				wolfteamc = wolfteamc + wolfteamc;
			 	$('#::id .__wolfs__').append('\
					<div class=\'apagar ab-w100% hpd lt '+wolfteamc+'\'></div>');
				teamdba_hub_start('wolfDba','0');

				wolfteamc = wolfteamc + wolfteamc;
			 	$('#::id .__wolfs__').append('\
					<div class=\'apagar ab-w100% hpd lt '+wolfteamc+'\'></div>');
				teamdev_hub_start('wolfDeve','0');

				wolfteamc = wolfteamc + wolfteamc;
			 	$('#::id .__wolfs__').append('\
					<div class=\'apagar ab-w100% hpd lt '+wolfteamc+'\'></div>');
				teameng_hub_start('wolfEng','0');

				wolfteamc = wolfteamc + wolfteamc;
			 	$('#::id .__wolfs__').append('\
					<div class=\'apagar ab-w100% hpd lt '+wolfteamc+'\'></div>');
				teamdsi_hub_start('wolfDesi','0');

			})">&#xe033;</icon>

		</div>

		<!LOGO DA MATILHAS                                                   !>
		<div class="__logo__ ab-w5% ab-h10%" style="padding-left: 50%" ></div>

		<!MEBROS DA MATILHAS - LOBOS                                         !>
		<fieldset class="abs ns ab-w99% ab-h90%">
			<div class="ab-innerscrollable sbar ab-h90% __wolfs__"></div>
		</fieldset>

	</div>
</section>



<script>

var codeproj = "<?=$codeproj?>";

var wolfteamc = 1;
<?=$matilha?'var matilha__ = "'.$matilha.'";':'var matilha__;'?>

ab_fills();
ab_tooltips();
<?php
if($checkteam)
{
?>
	loadPack();
<?php
}
?>


var ::id = new ab_Data({
    table:"Projects",
    mode:abox.Queries.UPDATE,
    controller:"projects/team/handler.php",
    restrictions:"code='"+codeproj+"'"
});

function show_logo(load=null){
	if(load=='0')
	{
		var codeteampack = $("#::id [name=selteampak] option:selected").val()
	}else{var codeteampack = load;}
	if(codeteampack)
	{
		$('#::id .__logo__').append('\
			<img class="apagar_logo ab-h100% ab-w100%" src=\'data/teampack/'+codeteampack+'/logo.png\'>');	
	}
}

function teamman_hub_start(args=null,load=null){
	var teamman_hub_tmp = $(ab_strcall("projects/team/managers/tmp_row.php"));
	if(load=='0')
	{
		var codeteampack = $("#::id [name=selteampak] option:selected").val()
	}else{var codeteampack = load;}
	
	if(args==null){return;}
	(new ab_Data({
		table:args,
		mode:abox.Modes.VIEW,
		restrictions:'stts=1 having IDAlcateia="'+codeteampack+'"'
	})).bind(teamman_hub_tmp,$("#::id ."+wolfteamc+""), function(){
		$("#::id .teammanrow").each(function(){
			with($(this)){
				if(!data("__BINDED__")){
					data("__BINDED__",1);
					var code = find(".teammanrowcode").text().trim();
					find(".teammanrowedit").on('click',function(){ab_load("projects/mod.php", {mode:abox.Modes.EDIT}, 160, null, false, true);})
					find(".teammanrowphoto").attr('src', "data/wolf/"+ code + "/wolf.png");
					attr('id',code);
				}
				animate({opacity:1,"margin-top":".75vh"},100+5*index().int());
			}
		});
		ab_controllers();
	});
}

function teamdba_hub_start(args=null,load=null){
	var teamdba_hub_tmp = $(ab_strcall("projects/team/dba/tmp_row.php"));
	if(load=='0')
	{
		var codeteampack = $("#::id [name=selteampak] option:selected").val()
	}else{var codeteampack = load;}
	if(args==null){return;}
	(new ab_Data({
		table:args,
		mode:abox.Modes.VIEW,
		restrictions:'stts=1 having IDAlcateia="'+codeteampack+'"'
	})).bind(teamdba_hub_tmp,$("#::id ."+wolfteamc+""), function(){
		$("#::id .teamdbarow").each(function(){
			with($(this)){
				if(!data("__BINDED__")){
					data("__BINDED__",1);
					var code = find(".teamdbarowcode").text().trim();
					find(".teamdbarowedit").on('click',function(){ab_load("projects/mod.php", {mode:abox.Modes.EDIT}, 160, null, false, true);})
					find(".teamdbarowphoto").attr('src', "data/wolf/"+ code + "/wolf.png");
					attr('id',code);
				}
				animate({opacity:1,"margin-top":".75vh"},100+5*index().int());
			}
		});
		ab_controllers();
	});
}

function teamdev_hub_start(args=null,load=null){
	var teamdev_hub_tmp = $(ab_strcall("projects/team/developer/tmp_row.php"));
	if(load=='0')
	{
		var codeteampack = $("#::id [name=selteampak] option:selected").val()
	}else{var codeteampack = load;}
	if(args==null){return;}
	(new ab_Data({
		table:args,
		mode:abox.Modes.VIEW,
		restrictions:'stts=1 having IDAlcateia="'+codeteampack+'"'
	})).bind(teamdev_hub_tmp,$("#::id ."+wolfteamc+""), function(){
		$("#::id .teamdevrow").each(function(){
			with($(this)){
				if(!data("__BINDED__")){
					data("__BINDED__",1);
					var code = find(".teamdevrowcode").text().trim();
					find(".teamdevrowedit").on('click',function(){ab_load("projects/mod.php", {mode:abox.Modes.EDIT}, 160, null, false, true);})
					find(".teamdevrowphoto").attr('src', "data/wolf/"+ code + "/wolf.png");
					attr('id',code);
				}
				animate({opacity:1,"margin-top":".75vh"},100+5*index().int());
			}
		});
		ab_controllers();
	});
}

function teameng_hub_start(args=null,load=null){
	var teameng_hub_tmp = $(ab_strcall("projects/team/engineers/tmp_row.php"));
	if(load=='0')
	{
		var codeteampack = $("#::id [name=selteampak] option:selected").val()
	}else{var codeteampack = load;}
	if(args==null){return;}
	(new ab_Data({
		table:args,
		mode:abox.Modes.VIEW,
		restrictions:'stts=1 having IDAlcateia="'+codeteampack+'"'
	})).bind(teameng_hub_tmp,$("#::id ."+wolfteamc+""), function(){
		$("#::id .teamengrow").each(function(){
			with($(this)){
				if(!data("__BINDED__")){
					data("__BINDED__",1);
					var code = find(".teamengrowcode").text().trim();
					find(".teamengrowedit").on('click',function(){ab_load("projects/mod.php", {mode:abox.Modes.EDIT}, 160, null, false, true);})
					find(".teamengrowphoto").attr('src', "data/wolf/"+ code + "/wolf.png");
					attr('id',code);
				}
				animate({opacity:1,"margin-top":".75vh"},100+5*index().int());
			}
		});
		ab_controllers();
	});
}


function teamdsi_hub_start(args=null,load=null){
	var teamdsi_hub_tmp = $(ab_strcall("projects/team/designs/tmp_row.php"));
	if(load=='0')
	{
		var codeteampack = $("#::id [name=selteampak] option:selected").val()
	}else{var codeteampack = load;}
	if(args==null){return;}
	(new ab_Data({
		table:args,
		mode:abox.Modes.VIEW,
		restrictions:'stts=1 having IDAlcateia="'+codeteampack+'"'
	})).bind(teamdsi_hub_tmp,$("#::id ."+wolfteamc+""), function(){
		$("#::id .teamdsirow").each(function(){
			with($(this)){
				if(!data("__BINDED__")){
					data("__BINDED__",1);
					var code = find(".teamdsirowcode").text().trim();
					find(".teamdsirowedit").on('click',function(){ab_load("projects/mod.php", {mode:abox.Modes.EDIT}, 160, null, false, true);})
					find(".teamdsirowphoto").attr('src', "data/wolf/"+ code + "/wolf.png");
					attr('id',code);
				}
				animate({opacity:1,"margin-top":".75vh"},100+5*index().int());
			}
		});
		ab_controllers();
	});
}

<?php
if(!$check['tpck']==null)
{
?>
	function loadPack(){
		$('#::id .__nome__').append('\
					<label class=\'fb flt apagar hpd\' style=\'margin-left: 70%\'><?=$matilha?></label>');

		if(<?=$checkloadman?>)
		{
			wolfteamc = wolfteamc + wolfteamc;
			$('#::id .__wolfs__').append('\
			<div class=\'apagar ab-w100% hpd lt '+wolfteamc+'\'></div>');
			teamman_hub_start('wolfMan','<?=$checkteam?>');
		}

		if(<?=$checkloaddba?>)
		{
			wolfteamc = wolfteamc + wolfteamc;
				$('#::id .__wolfs__').append('\
				<div class=\'apagar ab-w100% hpd lt '+wolfteamc+'\'></div>');
			teamdba_hub_start('wolfDba','<?=$checkteam?>');
		}
		if(<?=$checkloaddeve?>)
		{
			wolfteamc = wolfteamc + wolfteamc;
				$('#::id .__wolfs__').append('\
				<div class=\'apagar ab-w100% hpd lt '+wolfteamc+'\'></div>');
			teamdev_hub_start('wolfDeve','<?=$checkteam?>');
		}
		if(<?=$checkloadeng?>)
		{
			wolfteamc = wolfteamc + wolfteamc;
				$('#::id .__wolfs__').append('\
				<div class=\'apagar ab-w100% hpd lt '+wolfteamc+'\'></div>');
			teameng_hub_start('wolfEng','<?=$checkteam?>');
		}
		if(<?=$checkloaddesi?>)
		{
			wolfteamc = wolfteamc + wolfteamc;
				$('#::id .__wolfs__').append('\
				<div class=\'apagar ab-w100% hpd lt '+wolfteamc+'\'></div>');
			teamdsi_hub_start('wolfDesi','<?=$checkteam?>');
		}
		show_logo("<?=$check['tpck']?>");
	}
<?php
}
?>
</script>



<?php
$body = ob_get_clean();
ob_start();
?>

SELECIONAR EQUIPE - MATILHA

<?php $titulo = ob_get_clean();
ob_start(); 
?>

<icon class="zpd fn fblack cur hrs rt ab-tooltip" data-content="Salvar" onclick="ab_apply(function(){
	ab_loading(true);
	::id.query(function(d){
		if(d.int()==1){
			$('#pjthb .ab-close').trigger('click');
            setTimeout(function(){
                ab_load('projects/hub.php');
                ab_advise('Equipe Resposável alterado');
            },130);
            $('#::id .ab-close').trigger('click');
		}else{ab_error();}
        ab_loading(false);
	});
})">&#xe0e8;</icon>

<?php
$btn = ob_get_clean();
$window = new Modal('projectTeamMod',$titulo, 'window', true);
$window ->appendbutton($btn);
$window ->barpaint('lightgray');
$window ->body($body);
$window ->print();
?>