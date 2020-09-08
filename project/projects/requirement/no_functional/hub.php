<?php
namespace abox;
require("../../../../lib/std.php");
$codeproj = post("codeproj");
$viri=qio("select * from NoFunctionalRequirements where cprj='".$codeproj."'");
if($viri==1)
{
	$cpjrqnofun = qout("select * from NoFunctionalRequirements where cprj='".$codeproj."'" ,Types::ARRAY)[0];
	$cpjrqnofun=$cpjrqnofun["cprj"];
	$cpjrqnofuc=$cpjrqnofun;
}else
{
	$cpjrqnofun=2;
	$cpjrqnofuc=3;
}



ob_start();
?>

<nav class="lt ab-w25% ns tct">
	<div class="ab-hiddenscrollable">
		<nav><input type="search"><label><icon>&#x55;</icon></label></nav>
		<nav class="bar fbd"><div class="hpd lt">FILTROS</div></nav>
		<div class="bar"></div>
		<nav class="ab-t80% abs ab-l1%">
			<button type="submit" class="bspan ab-tooltip" onclick="ab_load('projects/requirement/no_functional/mod.php',
																{mode:abox.Modes.NEW,codeproj:codeproj},
																 160,
																 null,
																 true)">
				<icon class="fb fntcolor" data-content="Novo Requisito Não Funcional">&#x4c;&#x67;</icon>
			</button>
			
		</nav>
	</div>
</nav>

<!REQUISITOS NÃO FUNCIONAIS>
<section class="abs ns ab-w75% hf" style="top:0;left: 25%;">
	<div class="ab-innerscrollable __NOFUNCIONAIS__"></div></section>

<script>
ab_switches();
ab_fills();
ab_tooltips();

var nofunctional_hub_tmp = $(ab_strcall("projects/requirement/no_functional/tmp_row.php"));

function no_functional_hub_start(args=null){
	if(args==null){return;}
	var nfr = new ab_Data({
		table:"NoFunctionalRequirements",
		mode:abox.Modes.VIEW,
		restrictions:"stts=1 and cprj='<?=$codeproj?>' order by idfr desc"
	});
	nfr.bind(nofunctional_hub_tmp,$("#::id .__NOFUNCIONAIS__"), function(){
		$("#::id .nofuncrow").each(function(){
			with($(this)){
				if(!data("__BINDED__")){
					data("__BINDED__",1);
					var code = find(".nofuncrowcode").text().trim();
					find(".nofuncrowdel0").on('click',function(){
														    $(this).parent().remove();
														    var nofuncrmv = new ab_Data({
														        table:"NoFunctionalRequirements",
														        mode:abox.Queries.UPDATE,
														        controller:"projects/requirement/no_functional/handler.php",
														        restrictions:"code='"+code+"'"
														    });
														    nofuncrmv.attr('stts',0);
														    nofuncrmv.query(function(d){
														        if(d==1){nofuncrmv.attr('stts','0');}
														    });
														    ab_success("Requisito Não Funcional Removido");
														});
					attr('id',code);
				}
				animate({opacity:1,"margin-top":".75vh"},100+5*index().int());
			}
			
		});
	});
}
no_functional_hub_start("ReqNoFuncionais");

</script>


<?php
$oi = ob_get_clean();

ob_start();
?>



<?php
$janela = new Modal('reqnofunchub','REQUISITOS NÃO FUNCIONAIS','window');
$janela->body($oi);
$janela->barpaint('lightgray');
$janela->print();
?>