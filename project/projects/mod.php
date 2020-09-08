<?php
namespace abox;
require("../../includes.php");
$new = post("mode")==Modes::NEW?true:false;
$pt1 = post("part")==Parts::PT1?true:false;
$pt2 = post("part")==Parts::PT2?true:false;
$pt3 = post("part")==Parts::PT3?true:false;
if(aval(2));?>

<div id="projectmd" class="ab-window bwindow">
	<div class="ab-restore ttlecolor fntcolor"><?=$new?"NOVO":"EDITAR"?> PROJETO</div>
	<nav class="ab-controlbox">

		<div class="ab-close fntcolor">	  </div>
		<div class="ab-maximize fntcolor"></div>
		<div class="ab-minimize fntcolor"></div>

		<!BOTÃO SALVAR                                                                                                                       >	
		<?php
			if(!$new || $pt2 || $pt3)
			{
		?>
				<icon class="zpd fn fblack cur hrs rt ab-tooltip" data-content="Salvar" onclick="ab_apply(function(){
					ab_loading(true);
					setTimeout(function(){
						projectmd.query(function(d){
							if(d.int()==1){
								ab_advise('Projeto Salvo');
								$('#pjthb .ab-close').trigger('click');
								setTimeout(function(){
								$('#projectmd .ab-close').trigger('click');
								ab_load('/projects/hub.php');
								},130);
							}else{ab_error();}
							ab_loading(false);
						});					
					},400);
				})">&#xe0e8;</icon>
		<?php
			}
		?>


	</nav>
	<div class="stretch ab-raise-projectmd ab-scrollscope">
		<nav class="lt ab-w24% lt ns hf ns">
            <div class="ab-innerscrollable">
                <?php
                if($pt1)
                {
                ?>		
                	<div class="hpd wf tlt ab-hook fxs fbd bvariant fwhite link">Identificação</div>
                	<div class="hpd wf tlt ab-hook fxs fbd bvariant fwhite link">Arquitetura</div>
                	
                <?php
                }elseif($pt2)
                {
                ?>
                	<div class="hpd wf tlt ab-hook fxs fbd bvariant fwhite link">Introdução</div>
                	<div class="hpd wf tlt ab-hook fxs fbd bvariant fwhite link">Problema</div>
                	<div class="hpd wf tlt ab-hook fxs fbd bvariant fwhite link">Justificativa</div>
                	
                <?php
            	}elseif($pt3)
            	{
                ?>
                	<div class="hpd wf tlt ab-hook fxs fbd bvariant fwhite link">Objetivo</div>
                	<div class="hpd wf tlt ab-hook fxs fbd bvariant fwhite link">Usuários</div>
                	
                	
                <?php
            	}
                ?>
            </div>

            <!BOTÃO PRÓXIMO                                                                                                            >
            <?php
            if(!$pt3)
            {
            ?>
	            <input type="submit" onclick="ab_apply(function()
				{

					ab_loading(true);
					if(!ab_checkout('projectmd'))
					{
		                ab_advise('Ops! Preencha os campos indicados em vermelho corretamente...');
		                ab_loading(false);
		            }else{


				            	projectmd.query(function(d)
				            	{

				            		<?php
				            		if($new)
				            		{
				            		?>
					            		if(d.int()==11)
					            		{
						            		$('#projectmd .ab-close').trigger('click');
						            		setTimeout(function(){
					            				ab_load('/projects/mod.php',{mode:abox.Modes.EDIT,
																			 part:abox.Parts.PT2,
																			 code:projectmd.attr('code')
																			},160,null,true);
											},130);
									    }else{ab_error();}
										ab_loading(false);
						            <?php
						        	}else{
						            ?>
							            if(d.int()==1)
					            		{
						            		$('#projectmd .ab-close').trigger('click');
						            		setTimeout(function(){
					            				ab_load('/projects/mod.php',{mode:abox.Modes.EDIT,
																			 part:abox.Parts.PT3,
																			 code:projectmd.attr('code')
																			},160,null,true);
											},130);
								    }else{ab_error();}
									ab_loading(false);
					            	<?php
					           		}
					            	?>
					            });
  
			        } 
				})" class="abs syp bspan fwhite fs ab-t85% ab-l1%" value="PRÓXIMO >>" >
		<?php
		}
		?>
        </nav>

		<section class="abs ab-w75% hf ns" style="top:5vh;left:25%;border:1px dotted lightgray">
            <div class="ab-innerscrollable ab-scope">

            	<!PRIMEIRA PARTE DO CADASTRO                                                                                                  >
            	<?php
            	if($pt1)
            	{
            	?>
		        	<!INDENTIFICAÇÃO>
		            <fieldset class="sbar ab-anchor tct xbs">
		                    <label class="fb flt lt hpd">IDENTIFICAÇÃO</label>
		                    <div class="xts tct">
		                        <div><input name="name" type="text" class="required" data-control="projectmd;name"><label>Nome do Projeto</label></div>
		                    </div>
		            </fieldset>
		            <!ARQUITETURA>
		            <fieldset class="sbar ab-anchor tct xbs">
		                <label class="fb flt lt hpd">ARQUITETURA</label>
	                    <div class="xts tct">
	                        <div>
				                <select name="archt" 
				                        class="ab-fill"
				                        data-content="Architectures;name"
				                        data-control="projectmd;arch"
				                        data-callback="$(this).prepend('<option value=\'null\'>Nova arquitetura</option>')"
				                        onchange='ab_apply(function(){
				                            var x = $("[name=archt]");
				                            if(x.val()=="null"){
				                            ab_load("projects/architecture/mod.php" , {
				                                mode:abox.Modes.NEW,
				                                ctnr:x.myId(),
				                                type:abox.Objects.SELECTBOX
				                            });
				                             x.val("");
				                         }
				                        })'>
				                </select>
	                        </div>
	                    </div>
		            </fieldset>
		            

		        <!SEGUNDA PARTE DO CADASTRO                                                                                                  >
                <?php
                }elseif($pt2)
                {
                	$code=post("code");
                ?>
                	<!INTRODUÇÃO>
		            <fieldset class="sbar ab-anchor tct xbs">
		                    <label class="fb flt lt hpd">INTRODUÇÃO</label>
		                    <div class="xts tct">
		                        <div><textarea rows="10" cols="40" placeholder="Descreva o projeto ou escreva uma breve introdução." data-control="projectmd;dscr"></textarea></div>
		                    </div>
		            </fieldset>
		            <!PROBLEMA>
		            <fieldset class="sbar ab-anchor tct xbs">
		                    <label class="fb flt lt hpd">PROBLEMA</label>
		                    <div class="xts tct">
		                        <div><textarea rows="10" cols="40" data-control="projectmd;prbl" placeholder="Descreva o problema que este projeto irá atuar."></textarea></div>
		                    </div>
		            </fieldset>
		            <!JUSTIFICATIVA>
		            <fieldset class="sbar ab-anchor tct xbs">
		                    <label class="fb flt lt hpd">JUSTIFICATIVA</label>
		                    <div class="xts tct">
		                        <div><textarea rows="10" cols="40" data-control="projectmd;jstf" placeholder="Descreva a justificativa do projeto."></textarea></div>
		                    </div>
		            </fieldset>

		        <!TERCEIRA PARTE DO CADASTRO                                                                                                  >
		        <?php
		    	}elseif($pt3)
		    	{	
		    		$code=post("code");
		        ?>
				    <!OBJETIVO>
		            <fieldset class="sbar ab-anchor tct xbs">
		                    <label class="fb flt lt hpd">OBJETIVO</label>
		                    <div class="xts tct">
		                        <div><textarea rows="10" cols="40" data-control="projectmd;objt" placeholder="Descreva a objetivo do projeto."></textarea></div>
		                    </div>
		            </fieldset>
		            <!USUÁRIOS 'ATORES'>
		            <script>
		            	var ator =  new ab_Data({
		            		table:"Actors",
		            		mode:abox.Queries.INSERT,
		            		controller:"projects/actor/handler.php"
		            	});
		                ator.attr('code',ab_newId(32));
		                ator.attr('date',(new ab_Date()).today());
		                ator.attr('stts',1);
		                ator.attr('user',abox.USER);
		                ator.attr('cprj','<?=$code?>');
		            </script>
		            <fieldset class="sbar ab-anchor tct xbs">
		                    <label class="fb flt lt hpd">USUÁRIOS</label>
		                    <div class="xts tct">
		                        <div class="wf">
		                        	<input class="ab-w93%" name="namea" data-control="ator;name"  type="text" ><label>Nome</label>
		                        </div><br> 
		                        <div><textarea  name="task"
		                        				rows="5"
		                        				cols="40"
		                        				data-control="ator;task"
		                        				placeholder="Tarefas que este usuário irá realizar.">
		                        	 </textarea></div><br>
		                        <div><textarea  name="objv"
		                        				rows="5"
					                        	cols="40" 		
					                        	data-control="ator;objv" 
					                        	placeholder="Objetivos que este usuário terá que realizar.">
					                 </textarea></div><br>
		                        <button name="adda" class="spd fb lt bgreen fwhite">adicionar</button><br>
		                        <field class="sbar"></field>
		                    </div>
		            </fieldset>
		        <?php
		    	}
		        ?>
                <div class="wf hf">.</div>
			</div>
		</section>


	</div>
<script>
	ab_tooltips();
    ab_scrolls();
    ab_fills();

    $("#projectmd [name='namea']").val("");
    $("#projectmd [name='task']").val("");
    $("#projectmd [name='objv']").val("");

	var projectmd = new ab_Data({
		table:"Projects",
		mode:abox.Queries.<?=$new?"INSERT":"UPDATE"?>,
		controller:"projects/handler.php",
		restrictions:'<?=$new?'':'code="'.post('code').'"'?>'

	});


	<?php
	if($new && $pt1){?>
		projectmd.attr('code',ab_newId(32));
		projectmd.attr('date',(new ab_Date()).today());
		projectmd.attr('user',abox.USER);
		projectmd.attr('tpck','teamaboxaboxaboxaboxaboxaboxabox');
			<?php
	}else{?>
			ab_updateControllers("projectmd");
			$("#input").attr("readonly",true);
			<?php
	}?>  


function rmva(){
    $("#projectmd [name='rmv']").off("click");
    $("#projectmd [name='rmv']").click(function(){
        $(this).parent().remove();
        var armvs = new ab_Data({
            table:"Actors",
            mode:abox.Queries.UPDATE,
            controller:"projects/actor/handler.php",
            restrictions:"code='"+this.dataset.code+"'"
        });
        armvs.attr('stts','0');
        armvs.query(function(d){
            if(d==1){armvs.attr('stts','0');}
        });
        ab_success("Ator removido");
    });
}


$('[name="adda"]').click(function(){
    var atores = this;
    if(ator.attr('code'))
        ator.attr('code',ab_newId(32));
    {
        if(ator.attr('name') && ator.attr('task') && ator.attr('objv'))
        {
 
            $("#projectmd field").append("\
                <div class='bsmoke zys '>\
                <div class='hpd'>"+ator.attr('name')+"</div>\
                 <input type='button' value='excluir' data-code='"+ator.attr('code')+"' name='rmv' class='fsmoke hpd rt srs' style='background:red'>\
                 </div><br>"
            );
            rmva();
            ab_success("Ator adicionado");
            $("#projectmd [name='namea']").val("");
            $("#projectmd [name='task']").val("");
            $("#projectmd [name='objv']").val("");
        }else{
            ab_error("Campos não preenchidos");
        }
    }


    ator.query(function(d){
    if(d==1)
        $(atores).closest('fieldset').find('input').not("[type=button]").val('');//dom walk
    });
});
</script>	
</div>

