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
	<fieldset class="ab-w100% ab-h80% ">
		<button class="hpd bblue fwhite ab-w46%" onclick="ab_apply(function(){
			ab_load('projects/schedule/mod.php',{codeproj:codeproj,mode:abox.Modes.NEW});
			$('#::id .ab-close').click();})"
		>Adicionar ou modificar datas</button>
		<button class="hpd bblue fwhite ab-w46%" onclick="ab_apply(function(){
			ab_load('projects/schedule/graphics/view.php',{codeproj:codeproj});
			//var url_ = 'project/projects/schedule/graphics/d3-timeline-chart/example/index.html?codeproj='+codeproj; window.open(url_,'_blank');
			$('#::id .ab-close').click();})"
		>Visualizar cronograma</button>
	</fieldset>
</section>


<?php
$oi = ob_get_clean();

ob_start();
?>



<?php
$janela = new Modal('choicesched','CRONOGRAMA','dialog');
$janela->body($oi);
$janela->barpaint('lightgray');
$janela->buttons(["close"]);
$janela->print();
?>
