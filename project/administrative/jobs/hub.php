<?php
namespace abox;
require("../../../includes.php");
ob_start();

$checkloadman  = qio('select * from Managers');
$checkloaddesi = qio('select * from Designs');
$checkloaddeve = qio('select * from Developers');
$checkloadeng  = qio('select * from Engineers');
$checkloaddba  = qio('select * from DbaS');
?>

<nav class="lt ab-w25% ns tct">
	<div class="ab-hiddenscrollable">
		<nav>
			<input  type="search"
					name="pesqdestr" 
					onkeypress="ab_apply(function(a){
						str=a;
						seekDestroy.fire();
					},this.value)"><label><icon>&#x55;</icon></label>
		</nav>


		<nav class="bar fbd"><div class="hpd lt">FILTROS</div></nav>

		<div class="bar">
			<div class="lt hpd">Gerente</div>
			<img class="rt ab-switch hpd" 
			     onclick="$(this).parent().find('nav').slideToggle()" 				  
			     data-state="0"
			     data-off="ab_apply(function(){
			     			$('#::id [name=pesqdestr]').val('');
			     			$('#::id .__LOBOS__').remove();
							$('#::id .__INI__').append('\
								<div class=\'ab-innerscrollable bar __LOBOS__ \'></div>');
								loadWolf();	
			 })">
			<nav class="hbar hid">
			</nav>
		</div>

		<div class="bar">
			<div class="lt hpd">Analista</div>
			<img class="rt ab-switch hpd" 
			     onclick="$(this).parent().find('nav').slideToggle()"
			     data-state="0"
			     data-off="ab_apply(function(){
			     			$('#::id [name=pesqdestr]').val('');
			     			$('#::id .__LOBOS__').remove();
							$('#::id .__INI__').append('\
								<div class=\'ab-innerscrollable bar __LOBOS__ \'></div>');
								loadWolf();	
			 })">
			<nav class="hbar hid">
			</nav>
		</div>

		<div class="bar">
			<div class="lt hpd">Desenvolvedor</div>
			<img class="rt ab-switch hpd" 
			     onclick="$(this).parent().find('nav').slideToggle()" 
			     data-state="0"
			     data-off="ab_apply(function(){
			     			$('#::id [name=pesqdestr]').val('');
			     			$('#::id .__LOBOS__').remove();
							$('#::id .__INI__').append('\
								<div class=\'ab-innerscrollable bar __LOBOS__ \'></div>');
								loadWolf();	
			 })">
			<nav class="hbar hid">
			</nav>
		</div>

		<div class="bar">
			<div class="lt hpd">Design</div>
			<img class="rt ab-switch hpd" 
			     onclick="$(this).parent().find('nav').slideToggle()" 
			     data-state="0"
			     data-off="ab_apply(function(){
			     			$('#::id [name=pesqdestr]').val('');
			     			$('#::id .__LOBOS__').remove();
							$('#::id .__INI__').append('\
								<div class=\'ab-innerscrollable bar __LOBOS__ \'></div>');
								loadWolf();	
			 })">
			<nav class="hbar hid">
			</nav>
		</div>

		<div class="bar">
			<div class="lt hpd">DBA</div>
			<img class="rt ab-switch hpd" 
			     onclick="$(this).parent().find('nav').slideToggle()" 
			     data-state="0"
			     data-off="ab_apply(function(){
			     			$('#::id [name=pesqdestr]').val('');
			     			$('#::id .__LOBOS__').remove();
							$('#::id .__INI__').append('\
								<div class=\'ab-innerscrollable bar __LOBOS__ \'></div>');
								loadWolf();	
			 })">
			<nav class="hbar hid">
			</nav>
				</div>

		<div class="bar"></div>
		<nav class="ab-t80% abs ab-l1%">
			<button class="bspan ab-tooltip" 
					onclick="ab_load('/administrative/jobs/choice.php',{mode:abox.Modes.NEW},160,null,true)"
					data-content="ADICIONAR LOBO">
				<icon class="fb fntcolor">&#xe08a;<icon class="fs">&#x4c;</icon></icon>
			</button>
	</nav>
	</div>
</nav>

<!LOBOS CADASTRADOS>
<section class="abs ns ab-w70% hf __INI__" style="top:0;left: 30%;">
	<div class="ab-innerscrollable bar __LOBOS__ "></div>
</section>

<script>
var lobos = 1;
ab_switches();
ab_tooltips();

if($("#::id .ab-switch:eq(0)")[0].dataset.state==0 &&
   $("#::id .ab-switch:eq(1)")[0].dataset.state==0 &&
   $("#::id .ab-switch:eq(2)")[0].dataset.state==0 && 
   $("#::id .ab-switch:eq(3)")[0].dataset.state==0 && 
   $("#::id .ab-switch:eq(4)")[0].dataset.state==0)
{
	loadWolf();
}

//================================ PESQUISA ==============================================================================
var str="";
var seekDestroy = new ab_Throttle(function(){
	var q;
	if(str){
		if($("#::id .ab-switch:eq(0)")[0].dataset.state==1)
		{	
				$('#::id .__LOBOS__').remove();

				$('#::id .__INI__').append('\
					<div class="ab-innerscrollable bar __LOBOS__ "></div>');

				lobos = lobos + lobos;
				$('#::id .__LOBOS__').append('\
					<div class=\'ab-w100% ab-h30% lt '+lobos+'\'></div>');
				q = "name like '"+str+"%'";
				var wolfs_hub_tmp = $(ab_strcall("administrative/jobs/tmp_row.php",{cargo: "Gerente"}));
				(new ab_Data({
					table:"Managers",
					mode:abox.Modes.VIEW,
					restrictions:q+' having stts=1'
				})).bind(wolfs_hub_tmp,$("#::id ."+lobos+""), function(){
					$("#::id .wolfrow").each(function(){
						with($(this)){
							if(!data("__BINDED__")){
								data("__BINDED__",1);
								var code = find(".wolfrowcode").text().trim();
								find(".wolfrowphoto").on('click',function(){ab_load("administrative/jobs/up_photo.php",
																			{mode:abox.Modes.EDIT,
																				code:code,
																				id:this.myId()}, 160, null, false, true);})
								find(".wolfrowedit").on('click',function(){ab_load("projects/mod.php", {mode:abox.Modes.EDIT}, 160, null, false, true);})
								find(".wolfrowdel0").on('click',function(){
																	    $(this).parent().remove();
																	    var teamrmv = new ab_Data({
																	        table:pesqbanc,
																	        mode:abox.Queries.UPDATE,
																	        controller:"administrative/jobs/team/handler.php",
																	        restrictions:"code='"+code+"'"
																	    });
																	    teamrmv.attr('stts',0);
																	    teamrmv.query(function(d){
																	        if(d==1){teamrmv.attr('stts','0');}
																	    });
																	    ab_success("lobinho removido");
																	});
								find(".wolfrowphoto").attr('src', "data/wolf/"+code+"/wolf.png");
								attr('id',code);
							}
							animate({opacity:1,"margin-top":".75vh"},100+5*index().int());
						}
					});
					ab_controllers();
				});
		}

		if($("#::id .ab-switch:eq(1)")[0].dataset.state==1)
		{	
				$('#::id .__LOBOS__').remove();

				$('#::id .__INI__').append('\
					<div class="ab-innerscrollable bar __LOBOS__ "></div>');

				lobos = lobos + lobos;
				$('#::id .__LOBOS__').append('\
					<div class=\'ab-w100% ab-h30% lt '+lobos+'\'></div>');
				q = "name like '"+str+"%'";
				var wolfs_hub_tmp = $(ab_strcall("administrative/jobs/tmp_row.php",{cargo: "Analista"}));
				(new ab_Data({
					table:"Engineers",
					mode:abox.Modes.VIEW,
					restrictions:q+' having stts=1'
				})).bind(wolfs_hub_tmp,$("#::id ."+lobos+""), function(){
					$("#::id .wolfrow").each(function(){
						with($(this)){
							if(!data("__BINDED__")){
								data("__BINDED__",1);
								var code = find(".wolfrowcode").text().trim();
								find(".wolfrowphoto").on('click',function(){ab_load("administrative/jobs/up_photo.php",
																			{mode:abox.Modes.EDIT,
																				code:code,
																				id:this.myId()}, 160, null, false, true);})
								find(".wolfrowedit").on('click',function(){ab_load("projects/mod.php", {mode:abox.Modes.EDIT}, 160, null, false, true);})
								find(".wolfrowdel0").on('click',function(){
																	    $(this).parent().remove();
																	    var teamrmv = new ab_Data({
																	        table:pesqbanc,
																	        mode:abox.Queries.UPDATE,
																	        controller:"administrative/jobs/team/handler.php",
																	        restrictions:"code='"+code+"'"
																	    });
																	    teamrmv.attr('stts',0);
																	    teamrmv.query(function(d){
																	        if(d==1){teamrmv.attr('stts','0');}
																	    });
																	    ab_success("lobinho removido");
																	});
								find(".wolfrowphoto").attr('src', "data/wolf/"+code+"/wolf.png");
								attr('id',code);
							}
							animate({opacity:1,"margin-top":".75vh"},100+5*index().int());
						}
					});
					ab_controllers();
				});
		}
		if($("#::id .ab-switch:eq(2)")[0].dataset.state==1)
		{	
				$('#::id .__LOBOS__').remove();

				$('#::id .__INI__').append('\
					<div class="ab-innerscrollable bar __LOBOS__ "></div>');

				lobos = lobos + lobos;
				$('#::id .__LOBOS__').append('\
					<div class=\'ab-w100% ab-h30% lt '+lobos+'\'></div>');
				q = "name like '"+str+"%'";
				var wolfs_hub_tmp = $(ab_strcall("administrative/jobs/tmp_row.php",{cargo: "Desenvolvedor"}));
				(new ab_Data({
					table:"Developers",
					mode:abox.Modes.VIEW,
					restrictions:q+' having stts=1'
				})).bind(wolfs_hub_tmp,$("#::id ."+lobos+""), function(){
					$("#::id .wolfrow").each(function(){
						with($(this)){
							if(!data("__BINDED__")){
								data("__BINDED__",1);
								var code = find(".wolfrowcode").text().trim();
								find(".wolfrowphoto").on('click',function(){ab_load("administrative/jobs/up_photo.php",
																			{mode:abox.Modes.EDIT,
																				code:code,
																				id:this.myId()}, 160, null, false, true);})
								find(".wolfrowedit").on('click',function(){ab_load("projects/mod.php", {mode:abox.Modes.EDIT}, 160, null, false, true);})
								find(".wolfrowdel0").on('click',function(){
																	    $(this).parent().remove();
																	    var teamrmv = new ab_Data({
																	        table:pesqbanc,
																	        mode:abox.Queries.UPDATE,
																	        controller:"administrative/jobs/team/handler.php",
																	        restrictions:"code='"+code+"'"
																	    });
																	    teamrmv.attr('stts',0);
																	    teamrmv.query(function(d){
																	        if(d==1){teamrmv.attr('stts','0');}
																	    });
																	    ab_success("lobinho removido");
																	});
								find(".wolfrowphoto").attr('src', "data/wolf/"+code+"/wolf.png");
								attr('id',code);
							}
							animate({opacity:1,"margin-top":".75vh"},100+5*index().int());
						}
					});
					ab_controllers();
				});
		}
		if($("#::id .ab-switch:eq(3)")[0].dataset.state==1)
		{	
				$('#::id .__LOBOS__').remove();

				$('#::id .__INI__').append('\
					<div class="ab-innerscrollable bar __LOBOS__ "></div>');

				lobos = lobos + lobos;
				$('#::id .__LOBOS__').append('\
					<div class=\'ab-w100% ab-h30% lt '+lobos+'\'></div>');
				q = "name like '"+str+"%'";
				var wolfs_hub_tmp = $(ab_strcall("administrative/jobs/tmp_row.php",{cargo: "Design"}));
				(new ab_Data({
					table:"Designs",
					mode:abox.Modes.VIEW,
					restrictions:q+' having stts=1'
				})).bind(wolfs_hub_tmp,$("#::id ."+lobos+""), function(){
					$("#::id .wolfrow").each(function(){
						with($(this)){
							if(!data("__BINDED__")){
								data("__BINDED__",1);
								var code = find(".wolfrowcode").text().trim();
								find(".wolfrowphoto").on('click',function(){ab_load("administrative/jobs/up_photo.php",
																			{mode:abox.Modes.EDIT,
																				code:code,
																				id:this.myId()}, 160, null, false, true);})
								find(".wolfrowedit").on('click',function(){ab_load("projects/mod.php", {mode:abox.Modes.EDIT}, 160, null, false, true);})
								find(".wolfrowdel0").on('click',function(){
																	    $(this).parent().remove();
																	    var teamrmv = new ab_Data({
																	        table:pesqbanc,
																	        mode:abox.Queries.UPDATE,
																	        controller:"administrative/jobs/team/handler.php",
																	        restrictions:"code='"+code+"'"
																	    });
																	    teamrmv.attr('stts',0);
																	    teamrmv.query(function(d){
																	        if(d==1){teamrmv.attr('stts','0');}
																	    });
																	    ab_success("lobinho removido");
																	});
								find(".wolfrowphoto").attr('src', "data/wolf/"+code+"/wolf.png");
								attr('id',code);
							}
							animate({opacity:1,"margin-top":".75vh"},100+5*index().int());
						}
					});
					ab_controllers();
				});
		}

		if($("#::id .ab-switch:eq(4)")[0].dataset.state==1)
		{	
				$('#::id .__LOBOS__').remove();

				$('#::id .__INI__').append('\
					<div class="ab-innerscrollable bar __LOBOS__ "></div>');

				lobos = lobos + lobos;
				$('#::id .__LOBOS__').append('\
					<div class=\'ab-w100% ab-h30% lt '+lobos+'\'></div>');
				q = "name like '"+str+"%'";
				var wolfs_hub_tmp = $(ab_strcall("administrative/jobs/tmp_row.php",{cargo: "DBA"}));
				(new ab_Data({
					table:"DbaS",
					mode:abox.Modes.VIEW,
					restrictions:q+' having stts=1'
				})).bind(wolfs_hub_tmp,$("#::id ."+lobos+""), function(){
					$("#::id .wolfrow").each(function(){
						with($(this)){
							if(!data("__BINDED__")){
								data("__BINDED__",1);
								var code = find(".wolfrowcode").text().trim();
								find(".wolfrowphoto").on('click',function(){ab_load("administrative/jobs/up_photo.php",
																			{mode:abox.Modes.EDIT,
																				code:code,
																				id:this.myId()}, 160, null, false, true);})
								find(".wolfrowedit").on('click',function(){ab_load("projects/mod.php", {mode:abox.Modes.EDIT}, 160, null, false, true);})
								find(".wolfrowdel0").on('click',function(){
																	    $(this).parent().remove();
																	    var teamrmv = new ab_Data({
																	        table:pesqbanc,
																	        mode:abox.Queries.UPDATE,
																	        controller:"administrative/jobs/team/handler.php",
																	        restrictions:"code='"+code+"'"
																	    });
																	    teamrmv.attr('stts',0);
																	    teamrmv.query(function(d){
																	        if(d==1){teamrmv.attr('stts','0');}
																	    });
																	    ab_success("lobinho removido");
																	});
								find(".wolfrowphoto").attr('src', "data/wolf/"+code+"/wolf.png");
								attr('id',code);
							}
							animate({opacity:1,"margin-top":".75vh"},100+5*index().int());
						}
					});
					ab_controllers();
				});
		}

		


	}
});


//============================================ FIM DA PESQUISA =======================================================

function lobos_hub_start(args=null,job=null){
	var wolfs_hub_tmp = $(ab_strcall("administrative/jobs/tmp_row.php",{cargo: job}));
	if(args==null){return;}
	(new ab_Data({
		table:args,
		mode:abox.Modes.VIEW,
		restrictions:'stts=1'
	})).bind(wolfs_hub_tmp,$("#::id ."+lobos+""), function(){
		$("#::id .wolfrow").each(function(){
			with($(this)){
				if(!data("__BINDED__")){
					data("__BINDED__",1);
					var code = find(".wolfrowcode").text().trim();
					find(".wolfrowphoto").on('click',function(){ab_load("administrative/jobs/up_photo.php",
																{mode:abox.Modes.EDIT,
																	code:code,
																	id:this.myId()}, 160, null, false, true);})
					find(".wolfrowedit").on('click',function(){ab_load("projects/mod.php", {mode:abox.Modes.EDIT}, 160, null, false, true);})
					find(".wolfrowdel0").on('click',function(){
														    $(this).parent().remove();
														    var teamrmv = new ab_Data({
														        table:args,
														        mode:abox.Queries.UPDATE,
														        controller:"administrative/jobs/team/handler.php",
														        restrictions:"code='"+code+"'"
														    });
														    teamrmv.attr('stts',0);
														    teamrmv.query(function(d){
														        if(d==1){teamrmv.attr('stts','0');}
														    });
														    ab_success("lobinho removido");
														});
					find(".wolfrowphoto").attr('src', "data/wolf/"+code+"/wolf.png");
					attr('id',code);
				}
				animate({opacity:1,"margin-top":".75vh"},100+5*index().int());
			}
		});
		ab_controllers();
	});
}

function loadWolf(){
	if(<?=$checkloadman?>)
	{
		lobos = lobos + lobos;
		$('#::id .__LOBOS__').append('\
			<div class=\'ab-w100% ab-h30% lt '+lobos+'\'></div>');
		lobos_hub_start('Managers','Gerente');
	}

	if(<?=$checkloaddba?>)
	{
		lobos = lobos + lobos;
		$('#::id .__LOBOS__').append('\
			<div class=\'ab-w100% ab-h30% lt '+lobos+'\'></div>');
		lobos_hub_start('DbaS','Banco de Dados');
	}
	if(<?=$checkloaddeve?>)
	{
		lobos = lobos + lobos;
			$('#::id .__LOBOS__').append('\
			<div class=\'ab-w100% ab-h30% lt '+lobos+'\'></div>');
		lobos_hub_start('Developers','Desenvolvedor');
	}
	if(<?=$checkloadeng?>)
	{
		lobos = lobos + lobos;
			$('#::id .__LOBOS__').append('\
			<div class=\'ab-w100% ab-h30% lt '+lobos+'\'></div>');
		lobos_hub_start('Engineers','Analista');
	}
	if(<?=$checkloaddesi?>)
	{
		lobos = lobos + lobos;
			$('#::id .__LOBOS__').append('\
			<div class=\'ab-w100% ab-h30% lt '+lobos+'\'></div>');
		lobos_hub_start('Designs','Design');
	}
}



/*wolfs_hub_start('Engineers','Analista');
wolfs_hub_start('Developers','Desenvolvedor');
wolfs_hub_start('Managers','Gerente');
wolfs_hub_start('Designs','Design');
wolfs_hub_start('DbaS','Banco de Dados');*/
</script>

<?php
$oi = ob_get_clean();

ob_start();
?>


<?php

$janela = new Modal('wolfhb', "PAINEL DE CONTROLE MEMBROS DE EQUIPE", "window");
$janela->body($oi);
$janela->barpaint('lightgray');
//$janela->buttons([""]); selecionar botões que aparecera
$janela->print();

?>