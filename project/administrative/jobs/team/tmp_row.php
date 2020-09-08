<?php
namespace abox;
require("../../../../lib/std.php");
$cargo = post("cargo");
?>
<div class="teamrow ab-w100% ab-h20% bsmoke fdark lt " style="border:1px solid ;margin: 8px;border-color: #515072">
	<div  class="teamrowcode hpd lt ab-w5% ellipsis"  style="display: none;"  data-bind="code"></div>
	

	<div class="ab-w14% ab-h100% lt" >
		<img  class="teamrowphoto ab-tooltip ab-w100 ab-h100 lt" src="img/std/user.png">
	</div>

	<icon class="teamrowdel0 rt hpd fn cur fbd ab-tooltip ab-w5%" data-content="Excluir" style="color: red">&#xe019;</icon>
	<div class="teamrowname ab-w70% ab-h20% lt"><div  class=" lt tlt fbd fn " style="margin-left: 22%" data-bind="name"></div></div>

	<div class="ab-h10% ab-w70% fbd fs " style="padding-top: 18%"><?=$cargo?></div>
	



</div>
<script>
	ab_tooltips();

</script>

