<?php

require_once('fpdf/fpdf.php');

include('conexao.php');

$pdf = new FPDF();

$pdf->AddPage();

/* TITULO */

$pdf->SetFont('Arial','B',18);

$pdf->Cell(190,10,'Lista de Extintores',0,1,'C');

$pdf->Ln(8);

/* CABECALHO */

$pdf->SetFillColor(0,123,255);

$pdf->SetTextColor(255,255,255);

$pdf->SetFont('Arial','B',10);

$pdf->Cell(12,10,'ID',1,0,'C',true);

$pdf->Cell(25,10,'Numero',1,0,'C',true);

$pdf->Cell(28,10,'Tipo',1,0,'C',true);

$pdf->Cell(25,10,'Capacidade',1,0,'C',true);

$pdf->Cell(30,10,'Validade',1,0,'C',true);

$pdf->Cell(30,10,'Recarga',1,0,'C',true);

$pdf->Cell(40,10,'Cliente',1,0,'C',true);

$pdf->Ln();

/* DADOS */

$sql = "SELECT * FROM extintores";

$resultado = mysqli_query($conexao, $sql);

$pdf->SetFont('Arial','',9);

$pdf->SetTextColor(0,0,0);

while($dados = mysqli_fetch_assoc($resultado)){

    $pdf->Cell(12,10,$dados['id'],1);

    $pdf->Cell(25,10,$dados['numero_extintor'],1);

    $pdf->Cell(28,10,utf8_decode($dados['tipo']),1);

    $pdf->Cell(25,10,$dados['capacidade'],1);

    $pdf->Cell(30,10,date('d/m/Y', strtotime($dados['validade'])),1);

    $pdf->Cell(30,10,date('d/m/Y', strtotime($dados['recarga'])),1);

    $pdf->Cell(40,10,utf8_decode($dados['cliente']),1);

    $pdf->Ln();
}

/* GERAR PDF */

$pdf->Output();

?>