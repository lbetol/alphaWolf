<?php
namespace abox;
require("../../lib/std.php");
$codeproj = post("codeproj");
?>


<div id="choicejob" class="ab-panel bdialog">
	<div class="ab-restore ttlecolor fntcolor">UPLOAD</div>
	<nav class="ab-controlbox">
		<div class="ab-close fntcolor rt"></div>
		<div class="ab-minimize fntcolor"></div>
	</nav>
	<div class="stretch">
		<section class="hbar tct ">
			

				<input 	type="file"
						onchange="ab_apply(function(){
							ab_loading(true);
							var formu = new FormData();
							formu.append('codigo','<?=$codeproj?>');
							formu.append('name', $('[type=file]').val());
							formu.append('pic0',$('[type=file]')[0].files[0]);
							$.ajax({
								url: 'project/projects/up.php',
								type: 'POST',
								processData: false,
								contentType: false,
								cache: false,
								data: formu
							})
							.done(function(data) {
								if(data.int()==1)
									ab_notify('Postado com sucesso');
								else ab_notify(data);
								ab_loading(false);
							});
						})">
		
			
		</div>
	</section>
	<script> 
		var files = {
		<?php 
			$ou = "";
			$projetos = get_files(__DIR__."/files");
			foreach($projetos as $x ){
				$ou .= "'".$x."':[";
				$y = get_files(__DIR__."/files/".$x.'/');
				$h = "";
				if(is_array($y)&&sizeof($y)>0){
					foreach($y as $a){
						$h.="'".$a."',";
					}
					$h= substr($h,0,strlen($h)-1);
					
				}else $ou.= "'".$y."'";
				$ou.= "],";
			}
			echo substr($ou,0,strlen($ou)-1); 
		?>};

		ab_tooltips();
		ab_fills();
	</script>
</div>


