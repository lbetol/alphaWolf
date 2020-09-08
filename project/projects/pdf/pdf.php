<?php
namespace abox{
require("../../../includes.php");
ob_start();
	$codeproj 		= $_GET['codigo'];
	$projeto  		= qout("select * from Projects where code='".$codeproj."'" ,Types::ARRAY)[0];
	$nome     		= $projeto["name"];
	$problema 		= $projeto["prbl"];
	$justificativa  = $projeto["jstf"];
	$descricao 		= $projeto["dscr"];
	$objetivo 		= $projeto["objt"];

	

	$html = "
			<style>
		    body {
		        height: 842px;
		        width: 595px;
		        margin-left: auto;
		        margin-right: auto;
		    }
		    </style>
		    <body>

			<h1>INSTITUTO FEDERAL DE EDUCAÇÃO, <br>CIÊNCIA E TECNOLOGIA DE SÃO PAULO </h1><br><br><br>

			<br><br><br><br><br><br><br><br><br><br>
			<h1>".$nome."</h1>



			<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
			<h1 style='text-align= center'>Problema</h1><br><br><br>
			<p>".$problema."</p>
			<br><br><br><br><br><br><br>
			<h1 style='text-align= center'>Justificativa</h1><br><br><br>
			<p>".$justificativa."</p>
			<br><br><br><br><br><br><br><br><br><br>

			<h1 style='text-align= center'>Descrição</h1><br><br><br><br><br>
			<p>".$descricao."</p>
		    <br><br><br><br><br><br><br><br><br>
			<h1 style='text-align= center'>Objetivo</h1><br><br><br>
			<p>".$objetivo."</p>

			</body>

			";





	// $janela = new Modal('pdf', "PDF_PROJETOS", "window");
	// $janela->body($oi);
	// $janela->barpaint('lightgray');
	// //$janela->buttons([""]); selecionar botões que aparecera
	// $janela->print();




} //NÃO APAGAR!!!!!!



namespace{
	ob_start();

	//referenciar o DomPDF com namespace
	use Dompdf\Dompdf;


	// include autoloader
	require_once("dompdf/autoload.inc.php");

	//Criando a Instancia
	$dompdf = new DOMPDF();
	// Carrega seu HTML
	$dompdf->loadHtml('


	     '.$html .'
			
			
			');

	//Renderizar o html
	$dompdf->render();
	$dompdf->setPaper("legal", "landscape");

	//Exibir a página
	$dompdf->stream(
	    "Documento-Projeto.pdf",
	    array(
	        "Attachment" => false //Para realizar o download somente alterar para true
	    )
	);
	ob_end_flush();
	exit();
}
