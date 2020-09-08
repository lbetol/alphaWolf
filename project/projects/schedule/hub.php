<?php
namespace abox;
require("../../../lib/std.php");
$codeproj = post("codeproj");
ob_start();
?>



<nav class="lt ab-w25% ns tct">
	<div class="ab-hiddenscrollable">
		<nav><input type="search"><label><icon>&#x55;</icon></label></nav>
		<nav class="bar fbd"><div class="hpd lt">FILTROS</div></nav>
		<div class="bar"></div>
		<nav class="ab-t80% abs ab-l1%">
			<button type="submit" class="bspan ab-tooltip" 	onclick="ab_load('/projects/schedule/mod.php',
																	{mode:abox.Modes.NEW,
																	 codeproj:codeproj},160, null,true)"
														 	data-content="Novo cronograma"><icon class="fb fntcolor">&#xe025;<icon class="fs">&#x4c;</icon></icon></button>
			<button type="submit" class="bspan ab-tooltip" 	onclick="ab_load('/projects/schedule/graphics/view.php',
																		{mode:abox.Modes.NEW,
																		 codeproj:codeproj},160,null,true)"
															data-content="Visualizar cronograma"><icon class="fb fntcolor">&#xe0e9;</icon></button>

		</nav>
	</div>
</nav>

<script>
var codeproj = "<?=$codeproj?>";
</script>

<?php
$oi = ob_get_clean();
ob_start();
?>


<?php
$janela = new Modal('schedhb', "PAINEL DE CONTROLE CRONOGRAMAS", "window");
$janela->body($oi);
$janela->barpaint('lightgray');
//$janela->buttons([""]); selecionar botões que aparecera
$janela->print();

?>