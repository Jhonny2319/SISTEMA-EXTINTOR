<?php

include 'conexao.php';

require('fpdf/fpdf.php');

$id = $_GET['id'];

$sql = "SELECT * FROM orcamentos WHERE id='$id'";

$resultado = mysqli_query($conexao, $sql);

$dados = mysqli_fetch_assoc($resultado);

$pdf = new FPDF();

$pdf->AddPage();


// FUNDO
$pdf->SetFillColor(255,255,255);
$pdf->Rect(0,0,210,297,'F');


// LOGO
$pdf->Image(
'C:/xampp/htdocs/escritorio/img/logo_final.jpg',
75,
8,
55
);


// DATA E NUMERO
$pdf->SetFont('Arial','',11);

$pdf->SetY(40);

$pdf->Cell(
95,
10,
utf8_decode('São Paulo, ').date('d/m/Y'),
0,
0
);

$pdf->Cell(
95,
10,
'N '.($dados['numero_orcamento'] ?? $dados['id']),
0,
1,
'R'
);


$pdf->Ln(5);


// CONTRATANTE
$pdf->SetFont('Arial','B',12);

$pdf->Cell(35,8,'Contratante:',0,0);

$pdf->SetFont('Arial','',12);

$pdf->Cell(
150,
8,
utf8_decode($dados['cliente']),
0,
1
);


// CNPJ
$pdf->SetFont('Arial','B',12);

$pdf->Cell(35,8,'CNPJ:',0,0);

$pdf->SetFont('Arial','',12);

$pdf->Cell(
150,
8,
utf8_decode($dados['cnpj']),
0,
1
);


// ENDEREÇO
$pdf->SetFont('Arial','B',12);

$pdf->Cell(35,8,utf8_decode('Endereço:'),0,0);

$pdf->SetFont('Arial','',12);

$pdf->MultiCell(
150,
8,
utf8_decode($dados['endereco'])
);


$pdf->Ln(5);


// LINHA
$pdf->SetDrawColor(180,180,180);

$pdf->Line(10,78,200,78);


$pdf->Ln(10);


// TITULO
$pdf->SetFont('Arial','B',15);

$pdf->Cell(
190,
10,
utf8_decode('SERVIÇOS DOS EXTINTORES'),
0,
1,
'C'
);


$pdf->Ln(5);


// CABEÇALHO TABELA
$pdf->SetFont('Arial','B',10);

$pdf->SetFillColor(230,230,230);

$pdf->Cell(20,12,'Quant.',1,0,'C',true);

$pdf->Cell(95,12,utf8_decode('Descrição dos serviços'),1,0,'C',true);

$pdf->Cell(35,12,'Valor Unit.',1,0,'C',true);

$pdf->Cell(40,12,'Valor Total',1,1,'C',true);


// DADOS
$pdf->SetFont('Arial','',10);

$pdf->Cell(
20,
12,
utf8_decode($dados['quantidade']),
1,
0,
'C'
);

$pdf->Cell(
95,
12,
utf8_decode($dados['descricao']),
1,
0
);

$pdf->Cell(
35,
12,
'R$ '.utf8_decode($dados['valor_unitario']),
1,
0,
'C'
);

$pdf->Cell(
40,
12,
'R$ '.utf8_decode($dados['valor']),
1,
1,
'C'
);


// TOTAL
$pdf->SetFont('Arial','B',11);

$pdf->Cell(
150,
12,
utf8_decode('Valor Total do Serviço'),
1,
0,
'R'
);

$pdf->Cell(
40,
12,
'R$ '.utf8_decode($dados['valor']),
1,
1,
'C'
);


$pdf->Ln(8);


// OBSERVACOES
$pdf->SetFont('Arial','B',12);

$pdf->Cell(
190,
10,
utf8_decode('Observações:'),
0,
1
);

$pdf->SetFont('Arial','',11);

$pdf->MultiCell(
190,
7,
utf8_decode($dados['observacoes'])
);


$pdf->Ln(5);


// ASSINATURA
$pdf->Line(65,220,145,220);

$pdf->Ln(5);

$pdf->SetFont('Arial','B',11);

$pdf->Cell(
190,
10,
utf8_decode('OJM SEGURANÇA CONTRA INCÊNDIO'),
0,
1,
'C'
);


// RODAPE
$pdf->SetY(270);

$pdf->SetFont('Arial','',10);

$pdf->Cell(
190,
5,
utf8_decode('Rua Affonso Simão, 16 - Americanópolis - São Paulo - SP'),
0,
1,
'C'
);

$pdf->Cell(
190,
5,
utf8_decode('Tel: (11) 5622-1687'),
0,
1,
'C'
);


// GERAR PDF
$pdf->Output();

?>