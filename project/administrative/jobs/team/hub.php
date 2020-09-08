<?php
namespace abox;
require("../../../../includes.php");
ob_start();
?>

<nav class="lt ab-w25% ns tct">
	<div class="ab-hiddenscrollable">
		<nav><input type="search"><label><icon>&#x55;</icon></label></nav>
		<nav class="bar fbd"><div class="hpd lt">FILTROS</div></nav>
		<div class="bar"></div>
		<nav class="ab-t80% abs ab-l1%">
			<button class="bspan ab-tooltip" 
					onclick="ab_load('/administrative/jobs/team/mod.php',{mode:abox.Modes.NEW},160,null,true)"
					data-content="NOVA MATILHA">
				<icon class="fb fntcolor">&#xe08b;<icon class="fs">&#x4c;</icon></icon>
			</button>
	</nav>
	</div>
</nav>

<!MATILHAS CADASTRADAS>
<section class="abs ns ab-w85% hf" style="top:0;left: 25%;">
	<div class="ab-innerscrollable __MATILHAS__"></div></section>

<script>
function wolfpack_hub_start(args=null){
	var teampack_hub_tmp = $(ab_strcall("administrative/jobs/team/teampack/tmp_row.php"));
	if(args==null){return;}
	(new ab_Data({
		table:args,
		mode:abox.Modes.VIEW,
		restrictions:'stts=1'
	})).bind(teampack_hub_tmp,$("#::id .__MATILHAS__"), function(){
		$("#::id .teampackrow").each(function(){
			with($(this)){
				if(!data("__BINDED__")){
					data("__BINDED__",1);
					var code = find(".teampackrowcode").text().trim();
					find(".teampackrowedit").on('click',function(){ab_load("administrative/jobs/team/mod.php", 
																{mode:abox.Modes.EDIT,
																	codeteampack:code}, 160, null, false, true);})
					find(".teampackrowphoto").on('click',function(){ab_load("administrative/jobs/team/up_photo.php",
																{mode:abox.Modes.EDIT,
																 code:code,
																 id:this.myId()}, 160, null, false, true);})
					find(".teampackrowdel0").on('click',function(){
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
					find(".teampackrowphoto").attr('src', "data/teampack/"+code+"/mini_logo.png");
					attr('id',code);
				}
				animate({opacity:1,"margin-top":".75vh"},100+5*index().int());
			}
		});
		ab_controllers();
	});
}
wolfpack_hub_start("TeamPacks");

</script>

<?php
$oi = ob_get_clean();

ob_start();
?>


<?php

$janela = new Modal('teamhb', "PAINEL DE CONTROLE DE EQUIPES", "window");
$janela->body($oi);
$janela->barpaint('lightgray');
//$janela->buttons([""]); selecionar botões que aparecera
$janela->print();

?>