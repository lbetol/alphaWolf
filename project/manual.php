<?php
namespace abox;
require("../includes.php");
ob_start();
?>




<section class="abs ab-w100% ab-h100% hf ns" >
    <div class="ab-scope bar ab-h100% ">


    	<div class="xts">
			<select name="selectmanu">
				<option value="1">Cadastrar Projeto</option>
				<option value="2">Alterar Logo</option>
				<option value="3">Cadastrar Gerente</option>
				<option value="4">Cadastrar Analista</option>
				<option value="5">Cadastrar DBA</option>
				<option value="6">Cadastrar Desenvolvedor</option>
				<option value="7">Cadastrar Gerente</option>
				<option value="8">Cadastrar Arquitetura</option>
				<option value="9">Cadastrar Usuário</option>
				<option value="10">Cadastrar Equipe</option>
				<option value="11">Adicionar Membros na Equipe</option>
				<option value="12">Adicionar Equipe no projeto</option>
				<option value="13">Alterar Foto do membro</option>
	
			</select>

			<icon class="hpd fn cur fblue fbd ab-tooltip" data-content="Selecionar tutorial" onclick="ab_apply(function(){
				manu__ = $('#::id [name=select] option:selected').val();
				$('#::id .apagar').remove();
				show_manu();


			})">&#xe033;</icon>

		</div>

		<!MEBROS DA MATILHAS - LOBOS                                         !>
		<fieldset class="abs ns ab-w99% ab-h90%">
			<div class="ab-innerscrollable sbar ab-h90% __print__">
				<img class="apagar ab-h100% ab-w100%">
			</div>
		</fieldset>

	</div>
</section>



<script>
	ab_tooltips();

function show_manu(){

	var valmanu = $("#::id [name=selectmanu] option:selected").val()
	if(valmanu)
	{
		$('#::id .__print__').append('\
			<img class="apagar manus" src=\'img/manual/'+valmanu+'.gif\'>');	
	}
}
</script>




<?php
$oi = ob_get_clean();

ob_start();
?>


<?php

$janela = new Modal('pnlmanu', "Manual", "window");
$janela->body($oi);
$janela->barpaint('lightgray');
$janela->print();

?>