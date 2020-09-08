<?php
namespace abox;
require("../../../lib/std.php");
ob_start();
?>

<section class="hbar tct ">

	<button class="hpd bspan fntcolor ab-w20%" onclick="ab_apply(function(){ab_load('administrative/jobs/manager/mod.php',{mod:abox.Queries.UPDATE});
		$('#choicejob .ab-close').click();
	})">Gerente</button>

	<button class="hpd bspan fntcolor ab-w20%" onclick="ab_apply(function(){ab_load('administrative/jobs/design/mod.php',{mod:abox.Queries.UPDATE});
		$('#choicejob .ab-close').click();
	})">Design</button>

	<button class="hpd bspan fntcolor ab-w20%" onclick="ab_apply(function(){ab_load('administrative/jobs/dba/mod.php',{mod:abox.Queries.UPDATE});
		$('#choicejob .ab-close').click();
	})">Dba</button><br><br>

	<button class="hpd bspan fntcolor ab-w20%" onclick="ab_apply(function(){ab_load('administrative/jobs/engineer/mod.php');
		$('#choicejob .ab-close').click();
	})">Analista</button>

	<button class="hpd bspan fntcolor ab-w40%" onclick="ab_apply(function(){ab_load('administrative/jobs/developer/mod.php',{mod:abox.Queries.UPDATE});
		$('#choicejob .ab-close').click();
	})">Desenvolvedor</button>


</section>

<script> 

</script>



<?php
$oi = ob_get_clean();

ob_start();
?>



<?php
$janela = new Modal('choicejob','SELECIONE O CARGO','dialog');
$janela->body($oi);
$janela->barpaint('lightgray');
$janela->buttons(["close"]);
$janela->print();
?>