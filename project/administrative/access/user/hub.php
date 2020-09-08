<?php
namespace abox;
require("../../../../lib/std.php");
ob_start();
?>

<nav class="lt ab-w25% ns tct">
	<div class="ab-hiddenscrollable">
		<nav><input type="search"><label><icon>&#x55;</icon></label></nav>

		<nav class="ab-t80% abs ab-l1%">
			<button class="bspan ab-tooltip" 
					onclick="ab_load('/administrative/access/user/mod.php',{mode:abox.Modes.NEW},160,null,true)" 
					data-content="Novo Usuário">
				<icon class="fb fntcolor">&#xe08a; &#xe038;<icon class="fs">&#x4c;</icon></icon>
			</button>

		</nav>
	</div>
</nav>

<!MOSTRAR USUÁRIOS CADASTRADOS                                                       >
<section class="abs ns ab-w85% hf" style="top:0;left: 25%;">
	<div class="ab-innerscrollable __USU__"></div></section>

<script>
ab_switches();
ab_tooltips();



function user_hub_start(args=null){
	var user_hub_tmp = $(ab_strcall("administrative/access/user/tmp_row.php"));
	if(args==null){return;}
	(new ab_Data({
		table:args,
		mode:abox.Modes.VIEW,
		restrictions:'stts=1'	
	})).bind(user_hub_tmp,$("#::id .__USU__"), function(){
		$("#::id .userrow").each(function(){
			with($(this)){
				if(!data("__BINDED__")){
					data("__BINDED__",1);
					var code = find(".userrowcode").text().trim();

					var eng = new ab_Data({
						table:"Engineers",
						mode:abox.Modes.VIEW,
						restrictions:"stts=1 having proj='"+code+"'"
					});

					var man = new ab_Data({
						table:"Managers",
						mode:abox.Modes.VIEW,
						restrictions:"stts=1 having proj='"+code+"'"
					});

					var dba = new ab_Data({
						table:"DbaS",
						mode:abox.Modes.VIEW,
						restrictions:"stts=1 having proj='"+code+"'"
					});

					var des = new ab_Data({
						table:"Designs",
						mode:abox.Modes.VIEW,
						restrictions:"stts=1 having proj='"+code+"'"
					});

					var dev = new ab_Data({
						table:"Developers",
						mode:abox.Modes.VIEW,
						restrictions:"stts=1 having proj='"+code+"'"
					});


					find(".userrowedit").on('click',function(){ab_load("projects/mod.php", {mode:abox.Modes.EDIT}, 160, null, false, true);})
					find(".userrowdel0").on('click',function(){
														    $(this).parent().remove();
														    var userrmv = new ab_Data({
														        table:args,
														        mode:abox.Queries.UPDATE,
														        controller:"administrative/access/user/handler.php",
														        restrictions:"code='"+code+"'"
														    });
														    userrmv.attr('stts',0);
														    userrmv.query(function(d){
														        if(d==1){userrmv.attr('stts','0');}
														    });
														    ab_success("usuário removido");
														});
					attr('id',code);
				}
				animate({opacity:1,"margin-top":".75vh"},100+5*index().int());
			}
		});
		ab_controllers();
	});
}
user_hub_start('Users');

</script>



<?php
$oi = ob_get_clean();

ob_start();
?>



<?php
$janela = new Modal('userhub','PAINEL DE CONTROLE DE USUÁRIOS','window');
$janela->body($oi);
$janela->barpaint('lightgray');
$janela->print();
?>