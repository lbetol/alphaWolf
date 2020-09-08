<?php
namespace abox;
require("../../../lib/std.php");
$codeproj = post("codeproj");
ob_start();
?>
<script>
	var codeproj = "<?=$codeproj?>";
</script>
<section class="hbar tct">
	<fieldset class="ab-w100% ab-h80% tct ">
		<button class="hpd bblue fwhite ab-w40%" onclick="ab_apply(function(){
			ab_load('projects/requirement/functional/hub.php',{codeproj:codeproj});
			$('#::id .ab-close').click();})"
		>Requisitos Funcionais</button>
		<button class="hpd bblue fwhite ab-w40%" onclick="ab_apply(function(){
			ab_load('projects/requirement/no_functional/hub.php',{codeproj:codeproj});
			$('#::id .ab-close').click();})"
		>Requisitos Não Funcionais</button>
	</fieldset>
</section>


<?php
$oi = ob_get_clean();

ob_start();
?>



<?php
$janela = new Modal('choicerequirement','SELECIONE REQUISITOS FUNCIONAIS OU NÃO FUNCIONAIS','dialog');
$janela->body($oi);
$janela->barpaint('lightgray');
$janela->buttons(["close"]);
$janela->print();
?>
