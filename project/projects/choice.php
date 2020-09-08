<?php
namespace abox;
require("../../lib/std.php");
$codeproj = post("codeproj");
$control  = post("control");
$version  = post("version"); 
$tamanho  = strlen($version);
$crtfif = 0;
$fim = 0;
$inicio = 0;

$proj     = qout('select * from Projects where code="'.$codeproj.'"',Types::ARRAY)[0];
$arch     = $proj["arch"];
$maxstage = qout('select max(numf) from Stages where arch="'.$arch.'"',Types::ARRAY)[0];
$max 	  = $maxstage['max(numf)'];	

$projstg  = qout('select * from ProjectStages where proj="'.$codeproj.'"',Types::ARRAY)[0];
$current  = qout('select * from Stages where code="'.$projstg["curr"].'"',Types::ARRAY)[0];
$curr     = $current["numf"];

$faseant  = $current["numf"];
$proximo  = $current["numf"];
$proximo++;
$faseant--;

if($curr==$max)
{
	$profase  = qout('select * from Stages where arch="'.$arch.'" having numf="'.$max.'"',Types::ARRAY)[0];
	$nextcurr = $profase["code"];
}else{
	$profase  = qout('select * from Stages where arch="'.$arch.'" having numf="'.$proximo.'"',Types::ARRAY)[0];
	$nextcurr = $profase["code"];
}



if($faseant>0)
{
	$antfase  = qout('select * from Stages where arch="'.$arch.'" having numf="'.$faseant.'"',Types::ARRAY)[0];
	$backcurr = $antfase["code"];
}
$pontosant = $curr;
$pontosant--;
$pontossup = $max;
$pontossup--;
$total = $max + $pontossup;

if($control==1)
{
	$controlc = "avançar";
}else{$controlc = "retroceder";}

ob_start();
?>
<script>
	var codeproj = "<?=$codeproj?>";
</script>
<section class="hbar tct">
	<label class="fb flt lt hpd bar">Deseja realmente <B><?=$controlc?></B> este projeto?</label>

	<fieldset class="ab-w100% ab-h80% " style="padding-top: 10%">
		<button class="hpd bblue fwhite ab-w40%" onclick="ab_apply(function(){
			ab_loading(true);
			<?php

			if ($curr <= $max)
			{
				if($control==1)
				{

					$v = null; 
					$com = "."; 
					$para  = 0;
					$ponto = 0;
					$cntrlin = true;
					for ($i=0; $i < $tamanho; $i++) 
					{
						$v = $version[$i];
						$cntrlfim = true;

						if(strcasecmp($v, $com) == 0)
						{
							$ponto++;
							if($ponto==$curr && $cntrlin = true)
							{	
								$inicio   = 1;
								$inicio   += $i;
								$cntrlin  = false;
								$cntrlfim = false;
							}
							if(!$cntrlin && $cntrlfim)
							{
								$fim = 1;
								$fim += $i;
								$i = $tamanho++;
							}
						}
					} 
					$anterior = $inicio;
					if($fim==0)
					{
						$fim = $inicio;
						$fim++;
						$fim++;
					}
					$superior = $fim;
					$superior--;

					$inrestes= substr($version,0,$anterior);
					$total = $total - $fim;
					$total++;
					$inrestde= substr($version,--$fim,$total);
					$mudar= substr($version,$inicio++,1);
					$soma = ++$mudar;
					$resultado = $inrestes.$soma.$inrestde;
				}else{

					$exato = $curr;
					$exato--;
					if(!$exato==0)
					{
						$v = null; 
						$com = "."; 
						$para  = 0;
						$ponto = 0;
						$cntrlin = true;

						for ($i=0; $i < $tamanho; $i++) 
						{
							$v = $version[$i];
							if(strcasecmp($v, $com) == 0)
							{
								$ponto++;
								if($ponto==$exato)
								{	
									$fim   	= 1;
									$fim   += $i;
									$i  	= $tamanho++;
									$inicio = $fim;
									$inicio = $inicio - 2;
								}

							}
						} 

						$anterior = $inicio;
						$superior = $fim;
						$superior--;

						$inrestes= substr($version,0,$anterior);
						$total = $total - $fim;
						$total++;
						$inrestde= substr($version,--$fim,$total);
						$mudar= substr($version,$inicio++,1);
						
						$soma = ++$mudar;
						$resultado = $inrestes.$soma.$inrestde;
					}

				}
				if($control==1)
				{
				?>
					::id.attr('curr','<?=$nextcurr?>');
					::id.attr('vers','<?=$resultado?>');
				<?php
				}
				if($control==2 && $curr>1)
				{
				?>
					::id.attr('curr','<?=$backcurr?>');
					::id.attr('vers','<?=$resultado?>');
				<?php
				}
			}



			if($curr==1 && $control==2)
			{
				$crtfif = 1;
			?>
				
				$('#::id .ab-close').trigger('click');
				ab_advise('<div class=\'fb hpd tct\'>Não é possível <b>retroceder</b>.<br>\
													O projeto está na primeira fase</div>');

			<?php
			}
			if($curr==$max && $control==1)
			{
				$crtfif = 1;
			?>
				
				$('#::id .ab-close').trigger('click');
				ab_advise('<div class=\'fb hpd tct\'>Não é possível <b>avançar</b>.<br>\
													O projeto está na ultima fase</div>');		
			<?php
			}

			if($crtfif==0)
			{
			?>	
				$('#pjthb .ab-close').trigger('click');
				::id.query(function(d){
					if(d.int()==1){
						setTimeout(function(){
						$('#::id .ab-close').trigger('click');
						ab_load('/projects/hub.php');
						},130);
					}else{ab_error();}
	        		ab_loading(false);
				});
			<?php
			}
			?>
		})"
		>SIM</button>

		<button class="hpd bblue fwhite ab-w40%" onclick="ab_apply(function(){
			$('#::id .ab-close').trigger('click');
		})"
		>NÃO</button>

	</fieldset>
</section>
<script>
	var ::id = new ab_Data({
    table:"ProjectStages",
    mode:abox.Queries.UPDATE,
    controller:"projects/version/handler.php",
    restrictions:"proj='<?=$codeproj?>'"
});

</script>


<?php
$oi = ob_get_clean();

ob_start();
?>



<?php
$janela = new Modal('choiceStgProj','Alterar fase do projeto','dialog');
$janela->body($oi);
$janela->barpaint('lightgray');
$janela->buttons(["close"]);
$janela->print();
?>
