<?php
namespace abox;
require("../../../includes.php");
$new = post("mode")==Modes::NEW?true:false;
$codeproj = post("codeproj");
$projeto  = qout('select * from Projects where code="'.$codeproj.'"',Types::ARRAY)[0];
$arch     = $projeto["arch"];
$maxstage = qout('select max(numf) from Stages where arch="'.$arch.'"',Types::ARRAY)[0];
$max 	  = $maxstage['max(numf)'];
$stage    = qout('select * from Stages where arch="'.$arch.'" order by numf asc' ,Types::ARRAY)[0];
$stge     = $stage["numf"];


if(aval(2));
ob_start();
?>


<!FASES                                                                                                                   >
<fieldset class="sbar ab-innerscrollable tct xbs ">
	<?php
	$contr = $max;
	$contr++;

	for ($i=$stage["numf"]; $i < $contr; $i++) 
	{	
		$num  = qout('select * from Stages where arch="'.$arch.'" having numf="'.$i.'"' ,Types::ARRAY)[0];
		$name = $num["name"];
		$cstg = $num["code"];
	?>
		<div class="sbar">
			<label class="fb flt lt hpd ">Fase <?=$i?> - <?=$name?></label>
			<div class="xts hpd tlt lt">
				<div><input type="date" name="dtin" data-control="::id;dtst"> <label>Data Início</label></div>
				<div><input type="date" name="dtfn" data-control="::id;dtfs">  <label>Data Término</label></div>
				<icon class="zpd fn fblack cur hrs rt ab-tooltip" data-content="Salvar" onclick="ab_apply(function(){
					ab_loading(true);
					var stts = true;
					$('#::id [required]').each(function(){ $(this).checkout(function(d){ if(!d) stts=false; }); });
					setTimeout(function(){
						if(!stts){
							ab_advise('Ops! Preencha os campos indicados em vermelho corretamente...');
							ab_loading(false);
						}else{
							::id.attr('code',ab_newId(32));
							::id.attr('stts',1);
							::id.attr('date',(new ab_Date()).today());
							::id.attr('user',abox.USER);
							::id.attr('proj','<?=$codeproj?>');
							::id.attr('stge','<?=$cstg?>');
							::id.query(function(d){
								if(d.int()==1){
									ab_advise('Fase Atualizada');
								}else{ab_error();}
								ab_loading(false);
							});
						}
					},400);
				})">&#xe0e8;</icon>
			</div>
		</div>
	<?php
	}
	?>


</fieldset>


<script>

	var ::id = new ab_Data({
		table:"Schedules",
		mode:abox.Queries.<?=$new?"INSERT":"UPDATE"?>,
		controller:"projects/schedule/handler.php"
	});
	<?php
	if($new){?>
		::id.attr('user',abox.USER);
		<?php
	}else{?>
		ab_updateControllers("shedmod");
		$("#input").attr("readonly",true);
		<?php
	}
	if((int)post("view")){?>
    	$("select, input, textarea","#::id").attr("readonly",true);
    <?php
	} ?> 
	
	ab_tooltips();
	ab_fills();
	ab_scrolls();
</script>



<?php
$body = ob_get_clean();
ob_start();
?>
<?=$new?"NOVO":"EDITAR"?> CRONOGRAMA
<?php 
$titulo = ob_get_clean();
ob_start(); 
?>




<?php
$btn = ob_get_clean();
$window = new Modal('shedmod',$titulo, 'dialog', true);
$window ->appendbutton($btn);
$window ->barpaint('lightgray');
$window ->body($body);
$window ->print();
?>

