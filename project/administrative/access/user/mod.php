<?php
namespace abox;
require("../../../../includes.php");
$new = post("mode")==Modes::NEW?true:false;
if(aval(2));
ob_start();
?>




<div class="stretch ab-raise-usermd ab-scrollscope">
	<nav class="lt ab-w24% lt ns hf ns">
		<div class="ab-innerscrollable">
			<div class="hpd wf tlt ab-hook fxs fbd bvariant fwhite link">Identificação</div>
			<div class="hpd wf tlt ab-hook fxs fbd bvariant fwhite link">Cargo		  </div>
			<div class="hpd wf tlt ab-hook fxs fbd bvariant fwhite link">Colaborador  </div>
		</div>
	</nav>

	<section class="abs ab-w75% hf ns" style="top:5vh;left:25%;border:1px dotted lightgray">
		<div class="ab-innerscrollable ab-scope">  


			<!INDENTIFICAÇÃO                                      >
			<fieldset class="sbar ab-anchor tct xbs">
				<label class="fb flt lt hpd">Identificação</label>
				<div class="xts tct">
					<div><input type="text"     name="name" data-control="usermd;user"><label>Usuário</label></div>
					<div><input type="password" name="pswd" data-control="usermd;pswd"><label>Senha</label>  </div>
				</div>
			</fieldset>

			<!CARGO                                              >
			<fieldset class="sbar ab-anchor tct xbs"> 
				<label class="fb flt lt hpd">Cargo</label>
				<div class="xts tct">
					<script>
						$('#::id [type=radio]').each(function(event){
							$(this).click(function(){
								var x = $(this).attr('value');
								$('#::id [name=team]').attr('data-content',x+';name;;;').refill();
							});
						});
					</script>
					<div><input 		   type="radio" name="job" value="Managers">  <label>Gerente</label>  	 </div>
					<div><input 		   type="radio" name="job" value="Engineers"> <label>Analista</label>	 </div><br>
					<div><input 		   type="radio" name="job" value="Developers"><label>Desenvolvedor</label></div>
					<div><input 		   type="radio" name="job" value="Designs">   <label>Design</label>		 </div><br>
					<div class="lt"><input type="radio" name="job" value="DbaS">      <label>Dba</label>			 </div>
				</div>
			</fieldset>

			<!COLABORADOR                                        >
			<fieldset class="sbar ab-anchor tct xbs">
				<label class="fb flt lt hpd">Colaborador</label>
				<div class="xts tct">
					<select name="team" class="ab-fill">
						<option >Selecione o cargo primeiro</option>
					</select>
				</div>
			</fieldset>
			<div class="wf hf">.</div>
		</div>
	</section>
</div>


<script>
	var cdwolf = $('#::id [name=team] option:selected').val();
	 x = $('#::id [name=job]').attr('value');
	//var userwolf $('#::id [name=team]').attr('data-control',x+';name;;;').refill();

							
	var usermd = new ab_Data({
		table:"Users",
		mode:abox.Queries.INSERT,
		controller:"administrative/access/user/handler.php"
	});

	var Managers = new ab_Data({
		table:"Managers",
		mode:abox.Queries.UPDATE,
		controller:"administrative/jobs/manager/handler.php"
	});

	var Engineers = new ab_Data({
		table:"Engineers",
		mode:abox.Queries.UPDATE,
		controller:"administrative/jobs/engineer/handler.php"
	});

	var Developers = new ab_Data({
		table:"Developers",
		mode:abox.Queries.UPDATE,
		controller:"administrative/jobs/developer/handler.php"
	});

	var Designs = new ab_Data({
		table:"Designs",
		mode:abox.Queries.UPDATE,
		controller:"administrative/jobs/design/handler.php"
	});

	var DbaS = new ab_Data({
		table:"DbaS",
		mode:abox.Queries.UPDATE,
		controller:"administrative/jobs/dba/handler.php"
	});

	<?php
	if($new){?>
		usermd.attr('code',ab_newId(32));
		//usermd.attr('date',(new ab_Date()).today());
		//usermd.attr('staf',abox.USER);
		<?php
	}else{?>
		ab_updateControllers("usermd");
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
<?=$new?"NOVO":"EDITAR"?> USUÁRIO
<?php $titulo = ob_get_clean();
ob_start(); ?>

	<icon class="zpd fn fblack cur hrs rt ab-tooltip" data-content="Salvar" onclick="ab_apply(function(){
		ab_loading(true);
		var stts = true;
		$('#usermd [required]').each(function(){ $(this).checkout(function(d){ if(!d) stts=false; }); });
		setTimeout(function(){
			console.log(stts);
			if(!stts){
				ab_advise('Ops! Preencha os campos indicados em vermelho corretamente...');
				ab_loading(false);
			}else{
				usermd.query(function(d){
					if(d.int()==1){
						


						ab_advise('Cadastro realizado com sucesso');
						$('#usermd .ab-close').trigger('click');
					}else{ab_error();}
					ab_loading(false);
				});

			}
		},400);
	})">&#xe0e8;</icon>

<?php
$btn = ob_get_clean();
$window = new Modal('usermd',$titulo, 'window', true);
$window ->appendbutton($btn);
$window ->barpaint('lightgray');
$window ->body($body);
$window ->print();
?>