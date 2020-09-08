<?php
namespace abox;
require("../../includes.php");
ob_start();
?>


<section class="hbar tct">
	<fieldset class="ab-w100% ab-h80% tct ">
			<button class="bspan ab-tooltip" 
					onclick="ab_apply(function(){
							ab_load('/administrative/access/user/hub.php');
							$('#::id .ab-close').click();
					})" 
					data-content="Painel de controle de <br> usuários">
				<icon class="fb fntcolor">&#xe08a; &#xe038;</icon></button>

			<button class="bspan ab-tooltip" 
					onclick="ab_apply(function(){
						ab_load('/administrative/jobs/hub.php')
						$('#::id .ab-close').click();
					})" 

					data-content="Painel de controle de<br> membros da equipe">
				<icon class="fb fntcolor">&#xe08a;</icon></button>

			<button class="bspan ab-tooltip" 
					onclick="ab_apply(function(){
						ab_load('/administrative/jobs/team/hub.php')
						$('#::id .ab-close').click();
					})" 
					data-content="Painel de controle de<br> equipes">
				<icon class="fb fntcolor">&#xe08b;</icon></button>
	</fieldset>
</section>

<script>
	ab_tooltips();


</script>
<?php
$oi = ob_get_clean();

ob_start();
?>



<?php
$janela = new Modal('choicecontrol','Painel de controle','dialog');
$janela->body($oi);
$janela->barpaint('lightgray');
$janela->buttons(["close"]);
$janela->print();
?>
