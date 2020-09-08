<?php
namespace abox;
require("../../../../lib/std.php");
$new = (bool)(post("mode")!=Queries::UPDATE);
if(aval(2));?>

<div id="dsnmd" class="ab-window bwindow">
    <div class="ab-restore ttlecolor fntcolor"><icon>&#x24;</icon> <?=$new?"NOVO":"EDITAR"?> DESIGN <icon>&#x24;</icon> Data de cadastro: <div class="ab-date"></div></div>
    <nav class="ab-controlbox">
            
            <div    class="ab-close rt fntcolor">     </div>
            <div    class="ab-maximize rt fntcolor">  </div>
            <div    class="ab-minimize fntcolor">     </div>
            <icon class="zpd fn fblack cur hrs rt ab-tooltip" data-content="Salvar" onclick="ab_apply(function(){
                ab_loading(true);
                var stts = true;
                $('#dsnmd [required]').each(function(){$(this).checkout(function(d){if(!d) stts=false; })});
                   setTimeout(function(){
                    console.log(stts);
                    if(!stts){
                        ab_advise('Ops! Preencha os campos indicados em vermelho corretamente...');
                        ab_loading(false);
                    }else{
                        dsnmd.query(function(d){
                            if(d.int()==1){
                                $('#wolfhb .ab-close').trigger('click');
                                setTimeout(function(){
                                    ab_load('administrative/jobs/hub.php');
                                    ab_advise('Cadastro realizado com sucesso');
                                },130);
                                $('#dsnmd .ab-close').trigger('click');
                            }else{ab_error();}
                            ab_loading(false);
                        });
                    }   
                   },400);
            })">&#xe0e8;</icon>
            
        </nav>
    <div class="stretch ab-rise-dsnmd ab-scrollscope">
        
        
        <nav class="lt ab-w24% lt ns hf ns">
            <div class="ab-innerscrollable">
                <div class="hpd wf tlt ab-hook fxs fbd bvariant fwhite link">Identificação</div>
                <div class="hpd wf tlt ab-hook fxs fbd bvariant fwhite link">Localização  </div>
                <div class="hpd wf tlt ab-hook fxs fbd bvariant fwhite link">Contato      </div>
            </div>
        </nav>

        <section class="abs ab-w75% hf ns" style="top:5vh;left:25%;border:1px dotted lightgray">
            <div class="ab-innerscrollable ab-scope">
                <!INDENTIFICAÇÃO>
                <fieldset class="sbar ab-anchor tct xbs">
                        <label class="fb flt lt hpd">Identificação</label>
                        <div class="xts tct">
                            <div><input id="name" name="name" type="text" class="required" data-control="dsnmd;name"><label>Nome completo</label></div>
                        </div>
                </fieldset>

                <!LOCALIZAÇÃO>
                <fieldset class="sbar ab-anchor tct xbs">
                        <label class="fb flt lt hpd">Localização</label>
                        <div class="xts tct">
                            <div><select name="uf" 
                                class="ab-fill"
                                data-content="UFs;shrt"
                                data-control="engmd;uf"
                                onchange='ab_apply(function(){
                                    $("[name=city]").attr("data-content", "Cities;name;uf=\""+$("[name=uf]").val()+"\"").refill();
                                })'></select><label>UF</label>
                            </div>

                            <div><select name="city" class="ab-fill" data-control="engmd;city">
                                <option value="0">Selecione o estado primeiro</option>
                            </select><label>Cidade</label></div><br>
                            <div><input name="cep"        type="text" data-control="engmd;cep" maxlength="9" ab-masks="number"><label>CEP</label></div>
                            <div><input name="adrs"       type="text" data-control="engmd;adrs">                               <label>Endereço</label></div><br>
                            <div><input name="number"     type="text" data-control="engmd;num">                                <label>Nº</label></div>
                            <div><input name="district"   type="text" data-control="engmd;district">                           <label>Bairro</label></div><br>
                            <div><input name="complement" type="text" data-control="engmd;complement" class="wfull"><label>Complemento</label></div>
                        </div>
                    </fieldset>

                    <!CONTATO>
                    <fieldset class="sbar ab-anchor tct xbs">
                            <label class="fb flt lt hpd">Contato</label>
                            <div class="ab-w80% xts tct">

                                <div><input type="tel"   name="tel"   data-control="dsnmd;tel">  <label>Telefone</label></div>
                                <div><input type="tel"   name="cel"   data-control="dsnmd;cel">  <label>Celular</label> </div><br>
                                <div><input type="email" name="email" data-control="dsnmd;email"><label>Email</label>   </div>
                            </div>
                    </fieldset>
                    <div class="wf hf">.</div>
                </section>   
            </div>

    <script>
        var dsnmd = new ab_Data({
        table:"Designs",
        mode:abox.Queries.<?=$new?"INSERT":"UPDATE"?>,
        controller:"administrative/jobs/design/handler.php"
        });
        <?php
            if($new){?>
                dsnmd.attr('code',ab_newId(32));
                dsnmd.attr('date',(new ab_Date()).today());
                dsnmd.attr('staff',abox.USER);
        <?php
            }else{?>
                ab_updateControllers("dsnmd");
                $("#input").attr("readonly",true);
                <?php
            }
            if((int)post("view")){?>
                $("select, input, textarea","#dsnmd").attr("readonly",true);
                <?php
            } ?> 

            ab_tooltips();
            ab_masks();
            ab_scrolls();
            ab_fills();
        </script>
</div>
        