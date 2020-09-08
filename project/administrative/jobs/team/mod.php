<?php
namespace abox;
require("../../../../includes.php");
$new = post("mode")==Modes::NEW?true:false;
if(aval(2));
ob_start();
$codeteampack=post("codeteampack");

$checkwolfman  = qio('select * from wolfMan  where IDAlcateia="'.$codeteampack.'"');
$checkwolfdesi = qio('select * from wolfDesi where IDAlcateia="'.$codeteampack.'"');
$checkwolfdeve = qio('select * from wolfDeve where IDAlcateia="'.$codeteampack.'"');
$checkwolfeng  = qio('select * from wolfEng  where IDAlcateia="'.$codeteampack.'"');
$checkwolfdba  = qio('select * from wolfDba  where IDAlcateia="'.$codeteampack.'"');

?>


<script>var wolfc = 1;</script>

<section class="ab-w30% abs ab-innerscrollable bar lt">
	<section class="sbar">
		<label class="fb flt lt hpd bar">Identificação</label>
		<div class="xts">
			<div><input type="text" 
						class="ab-fill required"  
						data-control="::id;name" 
						data-content="TeamPacks;name" 
						name="teamname"><label>Nome da equipe</label>
				<button type="submit" class="fwhite bblue fn" onclick="ab_apply(function(){
					ab_loading(true);
					var stts = true;
					$('#::id [required]').each(function(){ $(this).checkout(function(d){ if(!d) stts=false; }); });
					setTimeout(function(){
							if(!stts){
							ab_advise('Ops! Preencha os campos indicados em vermelho corretamente...');
							ab_loading(false);
						}else{
							::id.query(function(d){
								if(d.int()==1){
									<?php
									if($new)
									{
									?>
										$('#teamhb .ab-close').trigger('click');
										$('#::id .ab-close').trigger('click');
										setTimeout(function(){
											ab_load('/administrative/jobs/team/mod.php',{mode:abox.Modes.EDIT,
																						codeteampack: ::id.attr('code')}
																						,160,null,true);
											ab_load('/administrative/jobs/team/hub.php');
										},130);
									<?php
									}else{
									?>
										ab_advise('Nome da equipe alterado com sucesso');
									<?php
									}
									?>
								}else{ab_error();}
								ab_loading(false);
							});
						}
					},400);
					
				})"><icon>&#xe0e8;</icon></button>
			</div>
		</div>
	</section>
	<?php
	if(!$new)
	{
	?>
		<fieldset class="sbar">
			<label class="fb flt lt bar">Colaboradores</label>
			<div class="xts">
				<div class="hpd">
					<div>
					<select data-content="Engineers;name"
							name="seleng" 
							class="ab-fill ab-w85% lt"></select><label>Analista</label>
					</div>
					<button name="btnadden" class="fwhite bblue" onclick="ab_apply(function(){
					 	var lobinho = $('#::id [name=seleng] option:selected').val();
					 	var stts = true;
					 	if(!$('#::id .required').checkout()){stts=false;}
						if(!stts){
							ab_advise('Ops! Preencha o campo indicado em vermelho primeiro e salve');
							ab_loading(false);
						}else{

						 	wolfc = wolfc + wolfc;
						 	$('#::id .__wolfs__').append('\
								<div class=\'ab-w46% hpd lt '+wolfc+'\'></div>');
						 	wolf_hub_start('Engineers','Analista',lobinho);
						 	teamwolfeng.attr('code',ab_newId(32));
							teamwolfeng.attr('engi',lobinho);
							teamwolfeng.query(function(d){
								if(d.int()==1){

								}else{ab_error();}
								ab_loading(false);
							});
						};
					})">+</button>
				</div>
			</div>
			<div>
				<div class="hpd wf">
					<div>
						<select data-content="Developers;name" 
							name="seldev" 
							class="ab-fill ab-w85% lt"></select><label>Desenvolvedor</label>
					</div>
					<button name="btnadddv" class="fwhite bblue" onclick="ab_apply(function(){
					 	var lobinho = $('#::id [name=seldev] option:selected').val();
					 	var stts = true;
					 	if(!$('#::id .required').checkout()){stts=false;}
						if(!stts){
							ab_advise('Ops! Preencha o campo indicado em vermelho primeiro e salve');
							ab_loading(false);
						}else{

						 	wolfc = wolfc + wolfc;
						 	$('#::id .__wolfs__').append('\
								<div class=\'ab-w46% hpd lt '+wolfc+'\'></div>');
						 	wolf_hub_start('Developers','Desenvolvedor',lobinho);
						 	teamwolfdev.attr('code',ab_newId(32));
							teamwolfdev.attr('deve',lobinho);
							teamwolfdev.query(function(d){
								if(d.int()==1){

								}else{ab_error();}
								ab_loading(false);
							});
						};
					})">+</button>
				</div>
			</div>
			<div>
				<div class="hpd wf">
					<div>
						<select data-content="Managers;name"
								name="selman" 
								class="ab-fill ab-w80% lt"></select><label>Gerente</label>
					</div>
					<button name="btnaddmg" class="fwhite bblue" onclick="ab_apply(function(){
					 	var lobinho = $('#::id [name=selman] option:selected').val();
					 	var stts = true;
					 	if(!$('#::id .required').checkout()){stts=false;}
						if(!stts){
							ab_advise('Ops! Preencha o campo indicado em vermelho primeiro e salve');
							ab_loading(false);
						}else{

						 	wolfc = wolfc + wolfc;
						 	$('#::id .__wolfs__').append('\
								<div class=\'ab-w46% hpd lt '+wolfc+'\'></div>');
						 	wolf_hub_start('Managers','Gerente',lobinho);
						 	teamwolfman.attr('code',ab_newId(32));
							teamwolfman.attr('mana',lobinho);
							teamwolfman.query(function(d){
								if(d.int()==1){

								}else{ab_error();}
								ab_loading(false);
							});
						};
					})">+</button>
				</div>
			<div>
				<div class="hpd wf">
					<div>
						<select data-content="Designs;name" 
								name="seldsi" 
								class="ab-fill ab-w85% lt"></select><label>Designs</label>
					</div>
					<button name="btnaddds" class="fwhite bblue" onclick="ab_apply(function(){
					 	var lobinho = $('#::id [name=seldsi] option:selected').val();
					 	var stts = true;
					 	if(!$('#::id .required').checkout()){stts=false;}
						if(!stts){
							ab_advise('Ops! Preencha o campo indicado em vermelho primeiro e salve');
							ab_loading(false);
						}else{

						 	wolfc = wolfc + wolfc;
						 	$('#::id .__wolfs__').append('\
								<div class=\'ab-w46% hpd lt '+wolfc+'\'></div>');
						 	wolf_hub_start('Designs','Design',lobinho);
						 	teamwolfdes.attr('code',ab_newId(32));
						 	teamwolfdes.attr('desi',lobinho);
							teamwolfdes.query(function(d){
								if(d.int()==1){

								}else{ab_error();}
								ab_loading(false);

							});
						};
					})">+</button>
				</div>
			</div>
			<div>
				<div class="hpd wf">
					<div>
						<select data-content="DbaS;name" 
								name="seldba" 
								class="ab-fill ab-w85% lt"></select>
											 <label>DBA</label>
					</div>
					<button name="btnadddb" class="fwhite bblue" onclick="ab_apply(function(){
					 	var lobinho = $('#::id [name=seldba] option:selected').val();
					 	var stts = true;
					 	if(!$('#::id .required').checkout()){stts=false;}
						if(!stts){
							ab_advise('Ops! Preencha o campo indicado em vermelho primeiro e salve');
							ab_loading(false);
						}else{

						 	wolfc = wolfc + wolfc;
						 	$('#::id .__wolfs__').append('\
								<div class=\'ab-w46% hpd lt '+wolfc+'\'></div>');
						 	wolf_hub_start('DbaS','Banco de Dados',lobinho);
						 	teamwolfdba.attr('code',ab_newId(32));
							teamwolfdba.attr('dbas',lobinho);
							teamwolfdba.query(function(d){
								if(d.int()==1){

								}else{ab_error();}
								ab_loading(false);
							});
						};
					})">+</button>
				</div>
			</div>
		</fieldset>
	<?php
	}
	?>
</section>
<!MEBROS DA MATILHAS - LOBOS!>
<section class="abs ns ab-w70% hf" style="top:0;left: 30%;">
	<div class="ab-innerscrollable sbar __wolfs__ ">

	</div>
</section>

<script>

ab_fills();
ab_tooltips();
loadPack();



function wolf_hub_start(args=null,job=null,wolf=null){
	var team_hub_tmp = $(ab_strcall("administrative/jobs/team/tmp_row.php",{cargo: job}));
	if(args==null){return;}
	(new ab_Data({
		table:args,
		mode:abox.Modes.VIEW,
		restrictions:'stts=1 having code="'+wolf+'"'
	})).bind(team_hub_tmp,$("#::id ."+wolfc+""), function(){
		$("#::id .teamrow").each(function(){
			with($(this)){
				if(!data("__BINDED__")){
					data("__BINDED__",1);
					var code = find(".teamrowcode").text().trim();
					find(".teamrowedit").on('click',function(){ab_load("administrative/jobs/team/mod.php", 
																{mode:abox.Modes.NEW}, 160, null, false, true);})
					find(".teamrowdel0").on('click',function(){
														    $(this).parent().remove();
														    var teamrmv = new ab_Data({
														        table:Teams,
														        mode:abox.Queries.UPDATE,
														        controller:"administrative/jobs/team/handler.php",
														        restrictions:"code='"+code+"'"
														    });
														    teamrmv.attr('stts',0);
														    teamrmv.query(function(d){
														        if(d==1){teamrmv.attr('stts','0');}
														    });
														    ab_success("lobo removido da alcateia");
														});
					find(".teamrowphoto").attr('src', "data/wolf/"+ code + "/wolf.png");
					attr('id',code);
				}
				animate({opacity:1,"margin-top":".75vh"},100+5*index().int());
			}
		});
		ab_controllers();
	});
}


function loadwolf_hub_start(args=null,job=null,codeteampack=null,remmv=null){
	var team_hub_tmp = $(ab_strcall("administrative/jobs/team/tmp_row.php",{cargo: job}));
	if(args==null){return;}
	(new ab_Data({
		table:args,
		mode:abox.Modes.VIEW,
		restrictions:'stts=1 having IDAlcateia="'+codeteampack+'"'
	})).bind(team_hub_tmp,$("#::id ."+wolfc+""), function(){
		$("#::id .teamrow").each(function(){
			with($(this)){
				if(!data("__BINDED__")){
					data("__BINDED__",1);
					var code = find(".teamrowcode").text().trim();
					find(".teamrowedit").on('click',function(){ab_load("administrative/jobs/team/mod.php", 
																{mode:abox.Modes.NEW}, 160, null, false, true);})
					find(".teamrowdel0").on('click',function(){
														    $(this).parent().remove();
														    var teamrmv = new ab_Data({
														        table:Teams,
														        mode:abox.Queries.UPDATE,
														        controller:"administrative/jobs/team/handler.php",
														        restrictions:"code='"+code+"'"
														    });
														    teamrmv.attr('stts',0);
														    teamrmv.query(function(d){
														        if(d==1){teamrmv.attr('stts','0');}
														    });
														    ab_success("lobo removido da alcateia");
														});
					find(".teamrowphoto").attr('src', "data/wolf/"+ code + "/wolf.png");
					attr('id',code);
				}
				animate({opacity:1,"margin-top":".75vh"},100+5*index().int());
			}
		});
		ab_controllers();
	});
}


function loadPack(){
	if(<?=$checkwolfman?>)
	{
		wolfc = wolfc + wolfc;
		$('#::id .__wolfs__').append('\
		<div class=\'ab-w46% hpd lt '+wolfc+'\'></div>');
		loadwolf_hub_start('wolfMan','Gerente','<?=$codeteampack?>','Managers');
	}

	if(<?=$checkwolfdba?>)
	{
		wolfc = wolfc + wolfc;
			$('#::id .__wolfs__').append('\
			<div class=\'ab-w46% hpd lt '+wolfc+'\'></div>');
		loadwolf_hub_start('wolfDba','Banco de dados','<?=$codeteampack?>','DbaS');
	}
	if(<?=$checkwolfdeve?>)
	{
		wolfc = wolfc + wolfc;
			$('#::id .__wolfs__').append('\
			<div class=\'ab-w46% hpd lt '+wolfc+'\'></div>');
		loadwolf_hub_start('wolfDeve','Desenvolvedor','<?=$codeteampack?>','Developers');
	}
	if(<?=$checkwolfeng?>)
	{
		wolfc = wolfc + wolfc;
			$('#::id .__wolfs__').append('\
			<div class=\'ab-w46% hpd lt '+wolfc+'\'></div>');
		loadwolf_hub_start('wolfEng','Analista','<?=$codeteampack?>','Engineers');
	}
	if(<?=$checkwolfdesi?>)
	{
		wolfc = wolfc + wolfc;
			$('#::id .__wolfs__').append('\
			<div class=\'ab-w46% hpd lt '+wolfc+'\'></div>');
		loadwolf_hub_start('wolfDesi','Design','<?=$codeteampack?>','Designs');
	}
}

var ::id = new ab_Data({
table:"TeamPacks",
mode:abox.Queries.<?=$new?"INSERT":"UPDATE"?>,
controller:"administrative/jobs/team/teampack/handler.php",
restrictions:'<?=$new?'':'code="'.$codeteampack.'"'?>'
});


<?php
if($new)
{
?>
	::id.attr('code',ab_newId(32));
	::id.attr('date',(new ab_Date()).today());
	::id.attr('user',abox.USER);
	::id.attr('stts',1);
<?php
}else{
?>
	ab_updateControllers("::id");
	//$("#::id [name='teamname']").attr("readonly",true);
<?php
}
if((int)post("view")){?>
    $("select, input, textarea","#::id").attr("readonly",true);
<?php
} 
?> 



<?php
if(!$new)
{
?>
	var teamwolfman = new ab_Data({
	table:"Teams",
	mode:abox.Queries.INSERT,
	controller:"administrative/jobs/team/handler.php",
	restrictions:'<?=$new?'':'tepk="'.$codeteampack.'"'?>'
	});

	teamwolfman.attr('date',(new ab_Date()).today());
	teamwolfman.attr('user',abox.USER);
	teamwolfman.attr('stts',1);
	teamwolfman.attr('tepk','<?=$codeteampack?>');

	var teamwolfdev = new ab_Data({
	table:"Teams",
	mode:abox.Queries.INSERT,
	controller:"administrative/jobs/team/handler.php",
	restrictions:'<?=$new?'':'tepk="'.$codeteampack.'"'?>'
	});

	teamwolfdev.attr('date',(new ab_Date()).today());
	teamwolfdev.attr('user',abox.USER);
	teamwolfdev.attr('stts',1);
	teamwolfdev.attr('tepk','<?=$codeteampack?>');
	
	var teamwolfdes = new ab_Data({
	table:"Teams",
	mode:abox.Queries.INSERT,
	controller:"administrative/jobs/team/handler.php",
	restrictions:'<?=$new?'':'tepk="'.$codeteampack.'"'?>'
	});

	teamwolfdes.attr('date',(new ab_Date()).today());
	teamwolfdes.attr('user',abox.USER);
	teamwolfdes.attr('stts',1);
	teamwolfdes.attr('tepk','<?=$codeteampack?>');
	
	var teamwolfdba = new ab_Data({
	table:"Teams",
	mode:abox.Queries.INSERT,
	controller:"administrative/jobs/team/handler.php",
	restrictions:'<?=$new?'':'tepk="'.$codeteampack.'"'?>'
	});

	teamwolfdba.attr('date',(new ab_Date()).today());
	teamwolfdba.attr('user',abox.USER);
	teamwolfdba.attr('stts',1);
	teamwolfdba.attr('tepk','<?=$codeteampack?>');
	
	var teamwolfeng = new ab_Data({
	table:"Teams",
	mode:abox.Queries.INSERT,
	controller:"administrative/jobs/team/handler.php",
	restrictions:'<?=$new?'':'tepk="'.$codeteampack.'"'?>'
	});

	teamwolfeng.attr('date',(new ab_Date()).today());
	teamwolfeng.attr('user',abox.USER);
	teamwolfeng.attr('stts',1);
	teamwolfeng.attr('tepk','<?=$codeteampack?>');
	

<?php
}
?>



</script>


<?php
$body = ob_get_clean();
ob_start();
?>
<?=$new?"NOVA":"EDITAR"?> EQUIPE
<?php $titulo = ob_get_clean();
ob_start(); ?>


<?php
$btn = ob_get_clean();
$window = new Modal('teammod',$titulo, 'window', true);
$window ->appendbutton($btn);
$window ->barpaint('lightgray');
$window ->body($body);
$window ->print();
?>