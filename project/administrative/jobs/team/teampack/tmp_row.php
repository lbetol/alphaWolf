<?php
namespace abox;
require("../../../../../lib/std.php");
//<div class="teamrowphoto hpd fbd fn">Logo</div><div class="fbd fn"></div>
?>
<div class="teampackrow ab-w40% ab-h20% bsmoke fdark lt " style="border:1px solid ;margin: 8px;border-color: #515072">
	<div  class="teampackrowcode hpd lt ab-w5% ellipsis"  style="display: none;"  data-bind="code"></div>
	<icon class="teampackrowdel0 rt hpd fn cur fbd ab-tooltip" data-content="Excluir" style="color: red">&#xe019;</icon>
	
	<div class="ab-w14% ab-h100% lt" >
		<img  class="teampackrowphoto ab-tooltip ab-w100 ab-h100 lt" src="img/std/logo.png" data-content="Clique para alterar a logo da equipe">
	</div>
	<div class="teampackrowname ab-w60% ab-h20%">    <div class="lt tlt fbd fn" ></div><div  class=" lt tlt fbd fn "
																										style="margin-left: 10%" 
																										data-bind="name"></div>
	</div>
	<div class="teampackrowedit ab-h10% ab-w70% cur fbd fn tlt  fblue"  
		 style="margin-top: 10%; margin-left: 16%"><icon class="ab-tooltip" data-content="Editar Matilha">&#x6c;</icon>
	</div>


</div>
<script>
	ab_tooltips();

</script>