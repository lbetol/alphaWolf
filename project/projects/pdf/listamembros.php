<?php












$html='<table border=1 style="width: 700px; ">';
$html.='<thead>';
$html.='<tr style="text-align: center;">';
$html.='<td style="width: 50px;">Cod</td>';
$html.='<td  style="width: 300px;">Nome</td>';
$html.='<td style="width: 150px;">Telefone</td>';
$html.='<td style="width: 150px;">Telefone</td>';
$html.='</tr>';
$html.='</thead>';


    $html.='<tbody>';
    $html .=  '<tr><td>id</td>';
    $html .=  '<td>nomemembro</td>';
    $html .=  '<td style="font-size: 500pt">telefone</td>';
    $html .=  '<td>telefone2</td></tr>';
    $html .= '</tbody>';

$html.='</table>';
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

//Exibibir a página
$dompdf->stream(
    "Lista_de_membros.pdf",
    array(
        "Attachment" => false //Para realizar o download somente alterar para true
    )
);
?>
