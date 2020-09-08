<?php
namespace abox;
require("../../../../lib/std.php");
$new = post("mode")==Modes::NEW?true:false;
$codeproj = post("codeproj");
if(aval(2));
ob_start();
?>

<section class="abs ab-w100% hf ns tct">
    <div class="ab-innerscrollable">

    	<!CADASTRO DO REQUISITO FUNCIONAL                                                                                                  >
        <fieldset class="sbar tct ">
            <script>
            var idfn;
            <?php
            $maxidfr = qout("select max(idfr) from FunctionalRequirements where cprj='".$codeproj."'" ,Types::ARRAY)[0];
            $max  = $maxidfr['max(idfr)']; 

            if(!$max)
            {
                $idfn = 1;
            }else{$idfn = ++$max;}
           

            ?>
                idfn = <?=$idfn?>;

                var relareqfun = new ab_Data({
                    table:"RelationReqFuns",
                    mode:abox.Queries.<?=$new?"INSERT":"UPDATE"?>,
                    controller:"projects/requirement/functional/relation/handler.php",
                    restrictions:"stts=1 and cprj='<?=$codeproj?>'"
                });

                relareqfun.attr('code',ab_newId(32));
                relareqfun.attr('date',(new ab_Date()).today());
                relareqfun.attr('user',abox.USER);
                relareqfun.attr('stts',1);
                relareqfun.attr('name', 'RF '+idfn);
                relareqfun.attr('cprj','<?=$codeproj?>');
            </script>
            <label class="fb flt lt hpd">Requisitos Funcionais</label>
        	<div class="tct" style="width: 900px">
    			<div class="bar zxp xts">
                    <div><input type="text" data-control="::id;dscr"><label>Descrição</label></div>
                    <div><select data-control="::id;prio">
                            <option >Selecione</option>
                            <option value="Baixo">Baixo</option>
                            <option value="Média">Média</option>
                            <option value="Alta">Alta</option>
                        </select><label>Prioridade</label>
                    </div>
                    <div><select name="rela" 
                                 class="ab-fill" 
                                 data-control="relareqfun;corf" 
                                 data-content="FunctionalRequirements;name"></select><label>Relação RF</label></div>
                    <div><icon class="fh fblue cur ab-tooltip" name="addr" data-content="Adicionar relação">&#x59;</icon></div>
                </div>  		
            </div>
    	</fieldset>

        <fieldset class="sbar tct ">
            <label class="fb flt lt hpd">Requisitos Funcionais Relacionados</label>
            <div class="tct" style="width: 900px">
                <div class="bar zxp xts">
                    <field></field>
                </div>
            </div>
        </fieldset>
    </div>
</section>

<script>
ab_fills();
ab_tooltips();

var codeproj = "<?=$codeproj?>";

var ::id = new ab_Data({
    table:"FunctionalRequirements",
    mode:abox.Queries.<?=$new?"INSERT":"UPDATE"?>,
    controller:"projects/requirement/functional/handler.php"
});

::id.attr('code',ab_newId(32));
::id.attr('date',(new ab_Date()).today());
::id.attr('user',abox.USER);
::id.attr('stts',1);
::id.attr('idfr', idfn);
::id.attr('name', 'RF '+idfn);
::id.attr('cprj','<?=$codeproj?>');


function rmvs(){
    $("#::id [name='rmv']").off("click");
    $("#::id [name='rmv']").click(function(){
        $(this).parent().remove();
        var rrmvs = new ab_Data({
            table:"RelationReqFuns",
            mode:abox.Queries.UPDATE,
            controller:"projects/requirement/functional/relation/handler.php",
            restrictions:"code='"+this.dataset.code+"'"
        });
        rrmvs.attr('stts','0');
        cont--;
        rrmvs.query(function(d){
            if(d==1){rrmvs.attr('stts','0');}
        });
        ab_success("Requisito Funcional Removido");
    });
}

$('[name="addr"]').click(function(){
    var relacoes = this;
    if(relareqfun.attr('code'))
        relareqfun.attr('code',ab_newId(32));
  

        relareqfun.query(function(d){
        if(d==1)
            $(relacoes).closest('fieldset').find('input').not("[type=button]").val('');//dom walk
        });

        $("#::id field").append("\
            <div class='bsmoke zys '>\
                <div class='hpd'>RF "+idfn+"<div class='hpd fn'></div></div>\
                <input type='button' value='excluir' data-code='"+relareqfun.attr('code')+"' name='rmv' class='fsmoke hpd rt srs' style='background:red'>\
             </div><br>"
        );
        rmvs();
        ab_success("Relação Adicionada");
});
</script>


<?php
$oi = ob_get_clean();
ob_start();
?>

<icon class="zpd fn fblack cur hrs rt ab-tooltip" data-content="Salvar"  onclick="ab_apply(function(){
    ab_loading(true);
    if(!ab_checkout('::id')){
        ab_advise('Ops! Preencha os campos indicados em vermelho corretamente...');
        ab_loading(false);
    }else{
        $('#reqfunchub .ab-close').trigger('click');
        ::id.query(function(d){
            if(d.int()==1)
            {
                setTimeout(function(){
                    ab_load('projects/requirement/functional/hub.php',{codeproj:codeproj});
                },130);
                $('#::id .ab-close').trigger('click');
            }else{ab_error();}
            ab_loading(false);

        });
    }
})">&#xe0e8;</icon>



<?php
$btn = ob_get_clean();
$janela = new Modal('reqfuncmod','REQUISITOS FUNCIONAIS','window');
$janela->body($oi);
$janela->barpaint('lightgray');
$janela->appendbutton($btn);
$janela->print();
?>