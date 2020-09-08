<?php
namespace abox{
require("../../includes.php");
ob_start();
	$codeproj 		= $_GET['codigo'];
	$projeto  		= qout("select * from Projects where code='".$codeproj."'" ,Types::ARRAY)[0];
	$nome     		= $projeto["name"];
	$problema 		= $projeto["prbl"];
	$justificativa  = $projeto["jstf"];
	$descricao 		= $projeto["dscr"];
	$objetivo 		= $projeto["objt"];

	

	$html = "
	<html>
	<body>
		 <fieldset>
		 	 <titulo class='pdftitle'>INSTITUTO FEDERAL DE EDUCAÇÃO, CIÊNCIA E TECNOLOGIA DE SÃO PAULO</titulo>
			 <h1>".$nome."</h1><br>
			 <h3>Problema".$problema."</h3>
			 <h3>justificativa".$justificativa."</h3>
			 <h3>Descrição".$descricao."</h3>
			 <h3>Objetivo".$objetivo."</h3>

		 </fieldset>
	</body>
	</html>";


	// $janela = new Modal('pdf', "PDF_PROJETOS", "window");
	// $janela->body($oi);
	// $janela->barpaint('lightgray');
	// //$janela->buttons([""]); selecionar botões que aparecera
	// $janela->print();




} //NÃO APAGAR!!!!!!



namespace{
	ob_start();

	require("mpdf60/mpdf.php");
	$stylesheet = file_get_contents('usr.css');
	$mpdf=new mPDF('c','A4','','' , 5 , 5 , 5 , 5 , 5 , 5); 
	
	$mpdf->SetAuthor('Alberto Barrios'); // Autor
	$mpdf->SetSubject("Projeto - IFSP CJO"); //Assunto
	$mpdf->SetTitle('Projeto'); //Titulo
	$mpdf->SetKeywords('projeto'); //Palavras chave
	$mpdf->SetCreator('Alberto Barrios'); //Criador

	$mpdf->SetDisplayMode("fullpage");
	//$mpdf->WriteHTML($stylesheet);
	$mpdf->WriteHTML($html,0);
	$mpdf->WriteHTML($stylesheet,1);


	$mpdf->Output('projeto' , 'I');
	ob_end_flush();
	exit();
}
