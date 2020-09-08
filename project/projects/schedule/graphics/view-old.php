<?php
namespace abox;
require("../../../../lib/std.php");

$new = post("mode")==Modes::NEW?true:false;?>


<div id="choicejob" class="ab-window bdialog">
	<div class="ab-restore ttlecolor fntcolor">CRONOGRAMA</div>
	<nav class="ab-controlbox">
		<div class="ab-close fntcolor rt"></div>
		<div class="ab-maximize fntcolor"></div>
		<div class="ab-minimize fntcolor"></div>
	</nav>
	<div class="stretch">
		<section class="hbar tct ">

			<select class="ab-fill" name="project" ab-content="grafico;name" onchange="ab_apply(function(value){
				console.log(value);
				var banco = new ab_Data({table:'Schedules',restrictions:'code=\''+value+'\''});
				banco.fill();
				console.log(banco.obj);	
				var inicio =  (new ab_Date(banco.obj[0].stage1_start)).days();
				var fim = (new ab_Date(banco.obj[0].stage4_end)).days()-inicio;

				
				var fase1 = new ab_ChartItem('fase1',['red','red'],[
		
					((new ab_Date(banco.obj[0].stage1_end)).days().int())-inicio,0,0,0,0,0,0
					
				]);
				var fase2 = new ab_ChartItem('fase2',['green','green'],[0,0,
					
					((new ab_Date(banco.obj[0].stage2_end)).days().int())-inicio,0,0,0,0
					
				]);
				var fase3 = new ab_ChartItem('fase3',['yellow','yellow'],[0,0,0,0,

					((new ab_Date(banco.obj[0].stage3_end)).days().int())-inicio,0,0
					
				]);
				var fase4 = new ab_ChartItem('fase4',['blue','blue'],[0,0,0,0,0,0,

					((new ab_Date(banco.obj[0].stage4_end)).days().int())-inicio
					
					
				]);
				console.log(fase1,fase2,fase3,fase4);

				var grafico = new ab_Chart('grafico',[
					'','fase1','','fase2','','fase3','','fase4'
				], 'bar');

				grafico.append(fase1);
				grafico.append(fase2);
				grafico.append(fase3);
				grafico.append(fase4);
				grafico.publish();
			},this.value)"></select>


		</section>


		<div class="ab-w50% ab-ab-h50%">
        <canvas id="grafico" ></canvas>
		<script>
			





			ab_fills();
		</script>
	</div>
	</div>


