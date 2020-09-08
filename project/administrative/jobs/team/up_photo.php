<?php
namespace abox;
require("../../../../includes.php");
ob_start();
?>


<fieldset class="sbar ab-anchor tct xbs">
    <label class="fb flt lt hpd">Clique na imagem para altera-la</label>
    <div class="xts tct">
	    <input 
	        type="file"
	        style="display: none;"
	        class="hid" 
	        name="foto"
	        onchange="this.up('logo.png', 'data/teampack/<?=post("code")?>/', function(d){
	            d = JSON.parse(d);
	                if (d.file) {
	                    ab_success('Imagem carregada com sucesso');
	                    $('#::id [type=file]').parent().find('img').attr('src',d.file+'?_='+(Math.random() * 1000));
	                    $('#<?=post('id')?>').attr('src',d.file+'?_='+(Math.random() * 1000));
	                    $('#::id progress').attr('value',0);


	                }else ab_notify('Não foi possivel realizar o upload da imagem!');
	        },abox.Modes.REPLACE,1,0)">
	    <img class="ab-tooltip ab-square"
	         data-map="ab-w100:ab-w200" 
	         data-content="Clique para alterar a imagem" 
	         src="data/teampack/<?=post("code")?>/logo.png">
	    <script>
	        $("#::id [type='file']:first").parent().find("img").click(function(){ 
	            $("#::id [type='file']:first").trigger("click"); 
	    	});
	    	;
	    </script>
    </div>
</fieldset>



<?php
$oi = ob_get_clean();

ob_start();
?>


<?php

$janela = new Modal('upLogoTeam', "ALTERAR LOGO", "dialog");
$janela->body($oi);
$janela->barpaint('lightgray');
$janela->buttons(["close"]);
$janela->print();

?>