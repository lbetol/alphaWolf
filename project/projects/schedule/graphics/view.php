<?php
namespace abox;
require("../../../../includes.php");

$codeproj = post("codeproj");
if(aval(2));
ob_start();
?>


<section class="abs ns wfull hfull">
	<iframe src="http://localhost/alphaWolf/stuff/d3-gantt-chart2/d3-gantt-chart/index.php?codeproj=<?=$codeproj?>" 
			class="ab-innerscrollable __PROJETOS__">


	</iframe>

</section>

<script>
ab_fills();
//ab_load("../stuff/d3-gantt-chart/index.html",null,null,"#tag");


 

</script>



<?php
$body = ob_get_clean();
ob_start();
?>
GRÁFICO DO CRONOGRAMA
<?php 
$titulo = ob_get_clean();
ob_start(); 
?>




<?php
$btn = ob_get_clean();
$window = new Modal('viewshed',$titulo, 'window', true);
$window ->appendbutton($btn);
$window ->barpaint('lightgray');
$window ->body($body);
$window ->print();
?>
