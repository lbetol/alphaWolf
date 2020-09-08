<?php
namespace abox;
require("../../../lib/std.php");
$new = post("mode")==Modes::NEW?true:false;
$ctnr= post("ctnr");
$type= post("type");



ob_start();
if(aval(2));
?>
<nav class="lt ab-w24% lt ns hf ns">
    <div class="ab-innerscrollable">
        <div class="hpd wf tlt ab-hook fxs fbd bvariant fwhite link">Identificação</div>
        <div class="hpd wf tlt ab-hook fxs fbd bvariant fwhite link">Decrição     </div>
        <?php
        	if(!$new)
        	{
        ?>
	       		<div class="hpd wf tlt ab-hook fxs fbd bvariant fwhite link">Fases        </div>
    	<?php
    		}
    	?>
    </div>
</nav>

<section class="abs ab-w75% hf ns" style="left:25%;border:1px dotted lightgray">
    <div class="ab-innerscrollable ab-scope">
    <!IDENTIFICAÇÃO                                                                                 > 
    	<fieldset class="sbar ab-anchor tct xbs">
    		<label class="fb flt lt hpd">IDENTIFICAÇÃO</label>
    		<div class="xts tct">
    			<div><input type="text" data-control="::id;name" ><label>Nome</label></div><br>
    		</div>
    	</fieldset>
    	<!DESCRIÇÃO                                                                                  >
    	<fieldset class="sbar ab-anchor tct xbs">
    		<label class="fb flt lt hpd">DESCRIÇÃO</label>
    		<div class="xts tct">
    			<div><textarea rows="10" cols="40" placeholder="Descreva o funcionamento da arquitetura." data-control="::id;dscr"></textarea></div>
    		</div>
    	</fieldset>
		<?php
			if(!$new)
			{
            $data = post("code");
        
		?>    	
	    	<!FASES                                                                                   >
            <script>
                var fase = new ab_Data({
                    table:"Stages",
                    mode:abox.Queries.INSERT,
                    controller:"projects/architecture/stage/handler.php"
                });
                fase.attr('code',ab_newId(32));
                fase.attr('arch','<?=$data?>');
                fase.attr('date',(new ab_Date()).today());
                fase.attr('stts',1);
                fase.attr('user',abox.USER);
            </script>
	    	<fieldset class="sbar ab-anchor tct xbs">
	    		<label class="fb flt lt hpd">FASES</label>
	    		<div class="xts tct">

                    <div class="bar">
                        <div class="ab-w48%" style="margin-right: 5%">
                            <input class="wf zpd lt" 
                                   type="text" 
                                   name="namestg" 
                                   data-control="fase;name"><label>Nome</label></div>
                    </div>
	    			<div class="bar">
                        <textarea name="decrstg"
                                  rows="10" 
                                  cols="40" 
                                  data-control="fase;decr" 
                                  placeholder="Descreva o funcionamento desta fase.">
                        </textarea>
                    </div>
                    <div class="ab-w53%">
                        <button name="addf" class="wf zpd fb lt bgreen fwhite">adicionar</button>
                    </div>

	    			<field class="sbar"></field>
	    		</div>
	    	</fieldset>
	    <?php
	    	}
	    ?>
	    	<div class="wf hf">.</div>

        <?php
        if($new)
        {
        ?>
            <input type="submit" onclick="ab_apply(function(){
                ab_loading(true);
                if(!ab_checkout('::id'))
                {
                    ab_advise('Ops! Preencha os campos indicados em vermelho corretamente...');
                    ab_loading(false);
                }else
                {
                    ::id.query(function(d){
                        if(d.int()==1)
                        {
                            $('#::id .ab-close').trigger('click');
                            setTimeout(function(){
                                ab_load('projects/architecture/mod.php',{code:::id.attr('code'),
                                                                        mode:abox.Modes.EDIT,
                                                                        ctnr:'<?=$ctnr?>',
                                                                        type:'<?=$type?>',
                                                                        name:::id.attr('name')},160,null,true)
                            },130);

                        }
                    });
                }
            })" class="abs dxp syp bspan fwhite fs ab-t85% ab-l70%" value="PRÓXIMO >>" >
        <?php
        }
        ?>
    </div>
</section>

<script>
    $("#::id [name='namestg']").val("");
    $("#::id [name='decrstg']").val("");


var ::id = new ab_Data({
    table:"Architectures",
    mode:abox.Queries.<?=$new?"INSERT":"UPDATE"?>,
    controller:"projects/architecture/handler.php",
    restrictions:'<?=$new?'':'code="'.post('code').'"'?>'
    });
<?php
if($new)
{
?>
    ::id.attr('code',ab_newId(32));
    ::id.attr('date',(new ab_Date()).today());
    ::id.attr('user',abox.USER);
<?php
}else{?>
        ab_updateControllers("::id");
        $("#input").attr("readonly",true);
<?php
}
?>  




var cont = 1;
ab_tooltips();
ab_scrolls();
ab_fills();
<?php
    if(!$new){?>
    setTimeout(function(){
        $('#::id .ab-hook:eq(2)').trigger('click');
    },500);
        
        
<?php }
?>

function rmvs(){
    $("#::id [name='rmv']").off("click");
    $("#::id [name='rmv']").click(function(){
        $(this).parent().remove();
        var brmvs = new ab_Data({
            table:"Stages",
            mode:abox.Queries.UPDATE,
            controller:"projects/architecture/stage/handler.php",
            restrictions:"code='"+this.dataset.code+"'"
        });
        brmvs.attr('stts','0');
        cont--;
        brmvs.query(function(d){
            if(d==1){brmvs.attr('stts','0');}
        });
        ab_success("Fase removida");
    });
}

$('[name="addf"]').click(function(){
    var fases = this;
    if(fase.attr('code'))
        fase.attr('code',ab_newId(32));
    {
        if(fase.attr('arch') && fase.attr('decr'))
        {
            fase.attr('numf',cont);
            //$("#::id .__campo__").append(cont);
            $("#::id field").append("\
                <div class='bsmoke zys '>\
                <div class='hpd'>Fase "+cont++ +"</div>\
                 <input type='button' value='excluir' data-code='"+fase.attr('code')+"' name='rmv' class='fsmoke hpd rt srs' style='background:red'>\
                 </div><br>"
                );
            rmvs();
            var apre = cont;
            apre = apre -1;
            ab_success("Fase "+apre+" Adicionada");
            $("#::id [name='namestg']").val("");
            $("#::id [name='decrstg']").val("");
        }else{
            ab_error("Adicione uma descrição");
        }
    }


    fase.query(function(d){
    if(d==1)
        $(fases).closest('fieldset').find('input').not("[type=button]").val('');//dom walk
    });



});

</script>

<?php
$main = ob_get_clean();
ob_start();
if(!$new)
{
?>
    <icon class="zpd fn fblack cur hrs rt ab-tooltip" data-content="Salvar" onclick="ab_apply(function(){
        ab_loading(true);
        if(!ab_checkout('::id'))
        {
            ab_advise('Ops! Preencha os campos indicados em vermelho corretamente...');
            ab_loading(false);
        }else
        {
            ::id.query(function(d){
                if(d.int()==1)
                {
                    $('#archmod .ab-close').trigger('click');
                    setTimeout(function(){
                        ab_advise('Arquitetura alterada');
                        if(<?=(post('ctnr')&&post('type')==Objects::SELECTBOX?1:0)?>)
                        {
                            $('#<?=post("ctnr")?>').attr('data-content','Architectures;name;;'+::id.attr('name')).refill();
                        }
                    },130);
                }else{ab_error();}
                ab_loading(false);
            });
        }
    })">&#xe0e8;</icon>

<?php
}
?>


<?php
$button = ob_get_clean();
$window = new Modal('archmod','ARQUITETURA','window', true);
$window->body($main);
$window->appendbutton($button);
$window->print();
?>