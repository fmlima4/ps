<?php
	require_once 'dompdf/autoload.inc.php';
	use Dompdf\Dompdf;
	
	$dompdf = new Dompdf();
	$processo = $_GET['formulario'];
	$nome = $_GET['nome'];
	$data = '05 de julho de 2019';
	
	//$html = file_get_contents('manifestacao.html');
	$html = '<html><head></head><body style="text-align: justify;"><div class="container">';
	$html .= '<h5>EXCELENTÍSSIMO(A) SENHOR(A) DOUTOR(A) JUIZ(A) DE DIREITO DO JUIZADO DA INFÂNCIA E JUVENTUDE DA COMARCA DE FLORES DA CUNHA/RS.</h5>';
	$html .= '<br>';
	$html .= '<p style="font-weight: bold;">Processo n°';
	$html .= $processo;
	$html .= '<br>';
	$html .= '<br>';
	$html .= '<p style="text-indent:10em; margin-bottom:0px;"><span style="font-weight: bold;">';
	$html .= $nome;
	$html .= '</span>, devidamente qualificada e representada no processo em epígrafe, pelo Defensor Público signatário, ';
	$html .= 'Membro da <span style="font-weight: bold;">Defensoria Pública do Estado</span>, vem, respeitosamente, na forma do artigo 1.018, caput, do NCPC, requerer a juntada,'; 
	$html .= 'com o comprovante de postagem eletrônica, de cópia de agravo remetido ao Egrégio Tribunal de Justiça do Estado, contra a decisão de fls. 21 e 22, ';
	$html .= 'com a finalidade de ciência e possibilidade, querendo, de reforma da decisão, na forma do art. 1.018, §1º do NCPC.</p>';
	$html .= '<p style="text-indent:10em;">Outrossim, informa a parte agravante que instruiu o recurso as peças obrigatórias e, como peças facultativas, cópia integral do processo.</p>';
	$html .= '<p style="text-indent:10em; margin-bottom:0px;">Nesses termos,</p>';
	$html .= '<p style="text-indent:10em;">Pede deferimento.</p>';
	$html .= '<p style="text-indent:10em;">Flores da Cunha, ';
	$html .= $data;
	$html .= '.</p>';
	$html .= '<br>';
	$html .= '<p style="font-weight: bold; text-indent:10em; margin-bottom:0px;">JULIANO VIALI DOS SANTOS,</p>';
	$html .= '<p style="font-weight: bold; text-indent:10em;">Defensor Público.</p>';
	$html .= '</div></body></body>';
	$dompdf->loadHtml($html);
	
	$dompdf->setPaper('A4');
	
	$dompdf->render();
	
	$dompdf->stream();
	
?>