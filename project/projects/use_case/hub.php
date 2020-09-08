<?php
namespace abox;
require("../../../lib/std.php");
$codeproj = post("codeproj");
$viri=qio("select * from UseCase where cprj='".$codeproj."'");
if($viri==1)
{
    $cpjcu = qout("select * from UseCase where cprj='".$codeproj."'" ,Types::ARRAY)[0];
    $cpjcu=$cpjcu["cprj"];
    $cpjcuc=$cpjcu;
}else
{
    $cpjcu=2;
    $cpjcuc=3;
}



ob_start();
?>

<nav class="lt ab-w25% ns tct">
    <div class="ab-hiddenscrollable">
        <nav><input type="search"><label><icon>&#x55;</icon></label></nav>
        <nav class="bar fbd"><div class="hpd lt">FILTROS</div></nav>
        <div class="bar"></div>
        <nav class="ab-t80% abs ab-l1%">
            <button type="submit" class="bspan ab-tooltip" onclick="ab_load('projects/use_case/mod.php',
                                                                {mode:abox.Modes.NEW,codeproj:'<?=$codeproj?>'},
                                                                 160,
                                                                 null,
                                                                 true)">
                <icon class="fb fntcolor" data-content="Novo Caso de Uso">&#xe102;<icon class="fs">&#x4c;</icon></icon>
            </button>
            
        </nav>
    </div>
</nav>

<!REQUISITOS NÃO FUNCIONAIS>
<section class="abs ns ab-w75% hf" style="top:0;left: 25%;">
    <div class="ab-innerscrollable __CASOS__"></div></section>

<script>
ab_switches();
ab_fills();
ab_tooltips();

var use_case_hub_tmp = $(ab_strcall("projects/use_case/tmp_row.php"));

function use_case_hub_start(args=null){
    if(args==null){return;}
    var ucase = new ab_Data({
        table:"UseCase",
        mode:abox.Modes.VIEW,
        restrictions:"stts=1 and cprj='<?=$codeproj?>' order by iduc desc"
    });
    ucase.bind(use_case_hub_tmp,$("#::id .__CASOS__"), function(){
        $("#::id .usecaserow").each(function(){
            with($(this)){
                if(!data("__BINDED__")){
                    data("__BINDED__",1);

                    var act = new ab_Data({
                        table:"atores",
                        mode:abox.Queries.VIEW,
                        controller:"projects/use_case/atores/handler.php",
                        restrictions:"cprj='<?=$codeproj?>'"
                    });
                    var load  = act['obj'];
                    var load2 = load[0];
                    var ucat = load2['nome'];

                    var code = find(".usecaserowcode").text().trim();
                    find(".usecaserowactor").append(ucat);
                    find(".usecaserowdel0").on('click',function(){
                                                            $(this).parent().remove();
                                                            var usecasermv = new ab_Data({
                                                                table:"UseCase",
                                                                mode:abox.Queries.UPDATE,
                                                                controller:"projects/use_case/handler.php",
                                                                restrictions:"code='"+code+"'"
                                                            });
                                                            usecase.attr('stts',0);
                                                            usecase.query(function(d){
                                                                if(d==1){usecase.attr('stts','0');}
                                                            });
                                                            ab_success("Caso de Uso Removido");
                                                        });
                    attr('id',code);
                }
                animate({opacity:1,"margin-top":".75vh"},100+5*index().int());
            }
            
        });
    });
}
use_case_hub_start("CasosDeUso");
</script>


<?php
$oi = ob_get_clean();

ob_start();
?>



<?php
$janela = new Modal('caseusehub','PAINEL DE CONTROLE - CASOS DE USO','window');
$janela->body($oi);
$janela->barpaint('lightgray');
$janela->print();
?>