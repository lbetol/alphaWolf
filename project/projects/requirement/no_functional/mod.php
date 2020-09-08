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

    	<!CADASTRO DO REQUISITO NÃO FUNCIONAL                                                                                                  >
        <fieldset class="sbar tct ">
            <script>
            var idnfn;
            <?php
            $maxidfr = qout("select max(idfr) from NoFunctionalRequirements where cprj='".$codeproj."'" ,Types::ARRAY)[0];
            $max  = $maxidfr['max(idfr)']; 

            if(!$max)
            {
                $idfn = 1;
            }else{$idfn = ++$max;}
           

            ?>
                idnfn = <?=$idfn?>;


                var relareqnofun = new ab_Data({
                    table:"RelationReqNoFuns",
                    mode:abox.Queries.<?=$new?"INSERT":"UPDATE"?>,
                    controller:"projects/requirement/no_functional/relation/handler.php",
                    restrictions:"stts=1 and cprj='<?=$codeproj?>'"
                });

                relareqnofun.attr('code',ab_newId(32));
                relareqnofun.attr('date',(new ab_Date()).today());
                relareqnofun.attr('user',abox.USER);
                relareqnofun.attr('stts',1);
                relareqnofun.attr('name', 'RF '+idnfn);
                relareqnofun.attr('cprj','<?=$codeproj?>');
            </script>
            <label class="fb flt lt hpd">Requisitos Não Funcionais</label>
            <div class="tlt" style="width: 900px">
                <div class="bar zxp xts">
                    <div><input type="text" data-control="::id;dscr"><label>Descrição</label></div>
                    <div><select name="rela" 
                                 class="ab-fill" 
                                 data-control="relareqnofun;corf" 
                                 data-content="NoFunctionalRequirements;name"></select><label>Relação RNF</label></div>
                    <div><icon class="fh fblue cur ab-tooltip" name="addr" data-content="Adicionar relação">&#x59;</icon></div>
                </div>          
            </div>
    	</fieldset>

        <fieldset class="sbar tct ">
            <label class="fb flt lt hpd">Requisitos  Funcionais Relacionados</label>
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
    table:"NoFunctionalRequirements",
    mode:abox.Queries.<?=$new?"INSERT":"UPDATE"?>,
    controller:"projects/requirement/no_functional/handler.php"
});

::id.attr('code',ab_newId(32));
::id.attr('date',(new ab_Date()).today());
::id.attr('user',abox.USER);
::id.attr('stts',1);
::id.attr('idfr', idnfn);
::id.attr('name', 'RNF '+idnfn);
::id.attr('cprj','<?=$codeproj?>');



function rmvs(){
    $("#::id [name='rmv']").off("click");
    $("#::id [name='rmv']").click(function(){
        $(this).parent().remove();
        var rrmvs = new ab_Data({
            table:"RelationReqNoFuns",
            mode:abox.Queries.UPDATE,
            controller:"projects/requirement/no_functional/handler.php",
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
  
        var valor = $('[name=rela]').val();

        relareqfun.query(function(d){
        if(d==1)
            $(relacoes).closest('fieldset').find('input').not("[type=button]").val('');//dom walk
        });

        $("#::id field").append("\
            <div class='bsmoke zys '>\
                <div class='hpd'>RNF "+idnfn+"<div class='hpd fn'></div></div>\
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
        $('#reqnofunchub .ab-close').trigger('click');
        ::id.query(function(d){
            if(d.int()==1)
            {
                setTimeout(function(){
                    ab_load('projects/requirement/no_functional/hub.php',{codeproj:codeproj});
                },130);
                $('#::id .ab-close').trigger('click');
            }else{ab_error();}
            ab_loading(false);

        });
    }
})">&#xe0e8;</icon>



<?php
$btn = ob_get_clean();
$janela = new Modal('reqnofuncmod','REQUISITOS NÃO FUNCIONAIS','panel');
$janela->body($oi);
$janela->barpaint('lightgray');
$janela->buttons(["close"]); 
$janela->appendbutton($btn);
$janela->print();
?>