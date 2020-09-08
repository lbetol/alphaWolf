<?php
namespace abox;
require("../../../../lib/std.php");
$codeproj = post("codeproj");
$viri=qio("select * from FunctionalRequirements where cprj='".$codeproj."'");
if($viri==1)
{
	$cpjrqfun = qout("select * from FunctionalRequirements where cprj='".$codeproj."'" ,Types::ARRAY)[0];
	$cpjrqfun=$cpjrqfun["cprj"];
	$cpjrqfuc=$cpjrqfun;
}else
{
	$cpjrqfun=2;
	$cpjrqfuc=3;
}



ob_start();
?>

<nav class="lt ab-w25% ns tct">
	<div class="ab-hiddenscrollable">
		<nav><input type="search"><label><icon>&#x55;</icon></label></nav>
		<nav class="bar fbd"><div class="hpd lt">FILTROS</div></nav>
		<div class="bar"></div>
		<nav class="ab-t80% abs ab-l1%">
			<button type="submit" class="bspan ab-tooltip" onclick="ab_load('projects/requirement/functional/mod.php',
																{mode:abox.Modes.NEW,codeproj:codeproj},
																 160,
																 null,
																 true)">
				<icon class="fb fntcolor" data-content="Novo Requisito Funcional">&#x4c;&#x67;</icon>
			</button>
			
		</nav>
	</div>
</nav>

<!REQUISITOS FUNCIONAIS>
<section class="abs ns ab-w75% hf" style="top:0;left: 25%;">
	<div class="ab-innerscrollable __FUNCIONAIS__"></div></section>

<script>
ab_switches();
ab_fills();
ab_tooltips();

var functional_hub_tmp = $(ab_strcall("projects/requirement/functional/tmp_row.php"));

function functional_hub_start(args=null){
	if(args==null){return;}
	var fr = new ab_Data({
		table:"FunctionalRequirements",
		mode:abox.Modes.VIEW,
		restrictions:"stts=1 and cprj='<?=$codeproj?>' order by idfr desc"
	});
	fr.bind(functional_hub_tmp,$("#::id .__FUNCIONAIS__"), function(){
		$("#::id .funcrow").each(function(){
			with($(this)){
				if(!data("__BINDED__")){
					data("__BINDED__",1);
					var code = find(".funcrowcode").text().trim();
					var teste = find(".funcrowrela").text(function(){
						var teste = new ab_Data({
							table:"relass",
							mode:abox.Queries.VIEW,
							restrictions:"codeproj='<?=$codeproj?>' having codefunc='"+code+"'"
						});
					})
					find(".funcrowdel0").on('click',function(){
														    $(this).parent().remove();
														    var funcrmv = new ab_Data({
														        table:"FunctionalRequirements",
														        mode:abox.Queries.UPDATE,
														        controller:"projects/requirement/functional/handler.php",
														        restrictions:"code='"+code+"'"
														    });
														    funcrmv.attr('stts',0);
														    funcrmv.query(function(d){
														        if(d==1){funcrmv.attr('stts','0');}
														    });
														    ab_success("Requisito Funcional Removido");
														});
					attr('id',code);
				}
				animate({opacity:1,"margin-top":".75vh"},100+5*index().int());
			}
			
		});
	});
}
functional_hub_start("ReqFuncionais");

</script>

<?php
$oi = ob_get_clean();

ob_start();
?>



<?php
$janela = new Modal('reqfunchub','REQUISITOS FUNCIONAIS','window');
$janela->body($oi);
$janela->barpaint('lightgray');
$janela->print();
?>