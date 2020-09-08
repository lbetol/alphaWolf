<?php
namespace abox;
require("../../../lib/std.php");
$new = post("mode")==Modes::NEW?true:false;
$codeproj = post("codeproj");
if(aval(2));
ob_start();
?>

<section class="abs ab-w100% hf ns tct">
    <div class="ab-innerscrollable">

    	<!CADASTRO DO CASO DE USO                                                                                                  >
        <fieldset class="sbar tct ">
            <script>
                var actcu = new ab_Data({
                    table:"ListActors",
                    mode:abox.Queries.<?=$new?"INSERT":"UPDATE"?>,
                    controller:"projects/use_case/actor/handler.php",
                    restrictions:"stts=1 having cprj='<?=$codeproj?>'"
                });

                actcu.attr('code',ab_newId(32));
                actcu.attr('date',(new ab_Date()).today());
                actcu.attr('user',abox.USER);
                actcu.attr('stts',1);
                actcu.attr('cprj','<?=$codeproj?>');
            </script>
            <label class="fb flt lt hpd">Caso de Uso</label>
        	<div class="tct" style="width: 900px">
    			<div class="bar zxp xts">
                    <div><input type="text" data-control="::id;name" data-content="UseCase;name"><label>Nome</label></div>
                    <div><input type="text" data-control="::id;dscr" data-content="UseCase;dscr"><label>Descrição</label></div>
                    <div><select data-control="::id;prio" data-content="UseCase;prio">
                        <option >Selecione</option>
                        <option value="Baixo">Baixo</option>
                        <option value="Média">Média</option>
                        <option value="Alta">Alta</option>
                    </select><label>Prioridade</label></div>
                    <div><select name="actor" 
                                 class="ab-fill" 
                                 data-control="actcu;acto" 
                                 data-content="Actors;name"></select><label>Ator</label></div>
                    <div><icon class="fh fblue cur" name="addr" data-contente="Adicionar ator">&#x59;</icon></div>
                </div>  		
            </div>
    	</fieldset>

        <fieldset class="sbar tct ">
            <label class="fb flt lt hpd">Atores do caso de uso</label>
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

var iducn;
<?php
$maxiduc = qout("select max(iduc) from UseCase where cprj='".$codeproj."'" ,Types::ARRAY)[0];
$max = $maxiduc['max(iduc)'];
if(!$max)
{
    $iducn = 1;
}else{$iducn = ++$max;}
?>
    iducn = <?=$iducn?>;


var ::id = new ab_Data({
    table:"UseCase",
    mode:abox.Queries.<?=$new?"INSERT":"UPDATE"?>,
    controller:"projects/use_case/handler.php"
});

::id.attr('code',ab_newId(32));
::id.attr('date',(new ab_Date()).today());
::id.attr('user',abox.USER);
::id.attr('stts',1);
::id.attr('iduc', iducn);
::id.attr('cprj','<?=$codeproj?>');

function rmvs(){
    $("#::id [name='rmv']").off("click");
    $("#::id [name='rmv']").click(function(){
        $(this).parent().remove();
        var crmvs = new ab_Data({
            table:"RelationReqFuns",
            mode:abox.Queries.UPDATE,
            controller:"projects/use_case/actor/handler.php",
            restrictions:"code='"+this.dataset.code+"'"
        });
        crmvs.attr('stts','0');
        cont--;
        crmvs.query(function(d){
            if(d==1){crmvs.attr('stts','0');}
        });
        ab_success("Requisito Funcional Removido");
    });
}

$('[name="addr"]').click(function(){
    var atores = this;
    if(actcu.attr('code'))
        actcu.attr('code',ab_newId(32));

        var valor = $('#::id [name=actor] option:selected').text();
        actcu.query(function(d){
        if(d==1)
            $(atores).closest('fieldset').find('input').not("[type=button]").val('');//dom walk
        });


        $("#::id field").append("\
            <div class='bsmoke zys '>\
                <div class='hpd'>"+valor+"<div class='hpd fn'></div></div>\
                <input type='button' value='excluir' data-code='"+actcu.attr('code')+"' name='rmv' class='fsmoke hpd rt srs' style='background:red'>\
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

<icon class="zpd fn fblack cur hrs rt ab-tooltip" data-content="Salvar" onclick="ab_apply(function(){
    ab_loading(true);
    if(!ab_checkout('::id')){
        ab_advise('Ops! Preencha os campos indicados em vermelho corretamente...');
        ab_loading(false);
    }else{
        ::id.query(function(d){
            $('#caseusehub .ab-close').trigger('click');
            if(d.int()==1)
            {
                setTimeout(function(){
                    ab_load('projects/use_case/hub.php',{codeproj:codeproj});
                },130);
                $('#::id .ab-close').trigger('click');
            }else{ab_error();}
            ab_loading(false);

        });
    }
})">&#xe0e8;</icon>



<?php
$btn = ob_get_clean();
$janela = new Modal('usecasemod','CASO DE USO','window');
$janela->body($oi);
$janela->barpaint('lightgray');
$janela->appendbutton($btn);
$janela->print();
?>