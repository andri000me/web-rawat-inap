<?php
$pdf = new FPDF('P', 'mm','Letter');
$image1 = base_url() . "assets/img/logo-puskesmas.jpeg";
$image2 = base_url() . "assets/img/logo-puskesmas.jpeg";
/* tinggal diganti image yang 1 dengan logo agan*/
$pdf->AddPage();
$gambar1 = $pdf->Image($image1, 15, 10, 35);
$gambar2 = $pdf->Image($image2, 160, 10, 35);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,7,'Laporan Hasil Periksa',0,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,7,'Pemerintah Kabupaten Dhamasraya',0,1,'C');
$pdf->Cell(0,7,'Dinas Kesehatan',0,1,'C');
$pdf->Cell(0,7,'UPT Puskesmas Sitiung 1',0,1,'C');
$pdf->Cell(0,7,'',0,5);
$pdf->Ln(-2);

$x1 = 10;
$y1 = 10;
$x2 = 10;
$y2 = 10;

$pdf->SetLineWidth(0);
$pdf->Line(12, 40, 198, 40);
$pdf->SetLineWidth(1);
$pdf->Line(12, 41, 198, 41);
$pdf->SetLineWidth(0);
$pdf->Ln(5);
if(isset($tanggal1)){
    $pdf->Ln(-4);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(0,10,'Dari Tanggal '.$tanggal1. ' Sampai Tanggal '.$tanggal2,0,1,'C');
}elseif(isset($bulan)){
   $pdf->Ln(-4);
   $pdf->SetFont('Arial','B',10);
   $pdf->Cell(0,10,'Dari Bulan '.$bulan. ' dan Tahun '.$tahun,0,1,'C');
}elseif(isset($tahun)){
   $pdf->Ln(-4);
   $pdf->SetFont('Arial','B',10);
   $pdf->Cell(0,10,'Di Tahun '.$tahun,0,1,'C');
}
$pdf->SetFont('Arial','B',10);

$pdf->Cell(8,6,'No',1,0,'C');
$pdf->Cell(35,6,'Kode Pasien',1,0,'C');
$pdf->Cell(30,6,'Nama Pasien',1,0,'C');
$pdf->Cell(35,6,'Ketentuan Dirawat',1,0,'C');
$pdf->Cell(30,6,'Lama Rawat',1,1,'C');

$pdf->SetFont('Arial','',10);
$no=1;
foreach ($detail_pasien as $data){
    $pdf->Cell(8,6,$no,1,0);
    $pdf->Cell(35,6,$data['id_detail_pasien'],1,0,'C');
    $query = $this->db->query("SELECT * FROM tb_pasien WHERE id_pasien = '". $data['id_pasien']."' ")->row_array();
    $pdf->Cell(30,6,$query['nama_p'],1,0,'C');
    $pdf->Cell(35,6,$data['ketentuan_dirawat'],1,0,'C');
    $pdf->Cell(30,6,$data['lama_inap'],1,1,'C');
    $no++;
}
$pdf->Output();
?>