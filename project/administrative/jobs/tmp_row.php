<?php
namespace abox;
require("../../../lib/std.php");
$job = post('cargo');
?>
<div class="wolfrow ab-w47% ab-h70% bsmoke fdark lt " style="border:1px solid ;margin: 8px;border-color: #515072">
	<div  class="wolfrowcode hpd lt ab-w5% ellipsis"  style="display: none;"  data-bind="code"></div>
	
	<div class="ab-w14% ab-h100% lt" >
		<img  class="wolfrowphoto ab-tooltip ab-w100 ab-h100 lt" src="img/std/user.png" data-content="Clique para alterar a imagem">
	</div>
	<div class="wolfrowname ab-w80% ab-h20%"><div class="lt tlt fbd fn" ></div><div  class=" lt tlt fbd fn "
																					 style="margin-left: 15%" 
																					 data-bind="name"></div>
	</div>
	<div class="ab-h10% ab-w70% fbd fs " style="padding-top: 20%"><?=$job?></div>
	<icon class="wolfrowdel0 rt hpd fn cur fbd ab-tooltip ab-w5%" data-content="Excluir" style="color: red">&#xe019;</icon>
</div>
<script>
	ab_tooltips();

</script>