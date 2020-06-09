<?php
mysql_connect('localhost','root','black(rainbow)');
mysql_select_db('gudang');

if(isset($_POST['reqInRep'])){
	$start = $_POST['startDate'];
	$finish = $_POST['finishDate'];
	
	include "Classes/PHPExcel.php";
	date_default_timezone_set("Asia/Jakarta");
	$excelku = new PHPExcel();
	$excelku->getProperties()->setCreator("DjieBo")
	                         ->setLastModifiedBy("DjieBo");

	$excelku->getActiveSheet()->getColumnDimension('A')->setWidth(5);
	$excelku->getActiveSheet()->getColumnDimension('B')->setWidth(15);
	$excelku->getActiveSheet()->getColumnDimension('C')->setWidth(20);
	$excelku->getActiveSheet()->getColumnDimension('D')->setWidth(10);
	$excelku->getActiveSheet()->getColumnDimension('E')->setWidth(20);
	$excelku->getActiveSheet()->getColumnDimension('F')->setWidth(15);

	$excelku->getActiveSheet()->mergeCells('A1:F1');
	$excelku->getActiveSheet()->mergeCells('A2:F2');
		
	$SI = $excelku->setActiveSheetIndex(0);
	$SI->setCellValue('A1', 'Gate In Report')->getStyle('A1')->getFont()->setSize(20);
	$SI->setCellValue('A3', 'No');
	$SI->setCellValue('B3', 'Barcode');
	$SI->setCellValue('C3', 'Tanggal Produk');
	$SI->setCellValue('D3', 'Qty');
	$SI->setCellValue('E3', 'Tanggal Input');
	$SI->setCellValue('F3', 'Admin');

	$SI->getStyle('A1')->getAlignment()->applyFromArray(
    array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
	);

	$headerStylenya = new PHPExcel_Style();
	$bodyStylenya   = new PHPExcel_Style();

	$headerStylenya->applyFromArray(
	    array('fill' 	=> array('type' => PHPExcel_Style_Fill::FILL_SOLID,
		      'color'   => array('argb' => 'CCF4FF')),
		      'borders' => array('bottom'=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
						'right'		=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
						'left'	    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
						'top'	    => array('style' => PHPExcel_Style_Border::BORDER_THIN)),
		      'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
	));
	

	$bodyStylenya->applyFromArray(
	array('fill' 	=> array(
		  'type'	=> PHPExcel_Style_Fill::FILL_SOLID,
		  'color'	=> array('argb' => 'FFFFFFFF')),
		  'borders' => array(
						'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
						'right'		=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
						'left'	    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
						'top'	    => array('style' => PHPExcel_Style_Border::BORDER_THIN)),
		  'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)

    ));

	$excelku->getActiveSheet()->setSharedStyle($headerStylenya, 'A3:F3');

	$get = mysql_query("select * from gatein");
	$baris  = 4;
	$no     = 1;
	while($r = mysql_fetch_array($get)){
		$date = substr($r['tanggalinput'], 0, 10);
		if(($date >= $start) and ($date <= $finish)){
			$SI->setCellValue("A".$baris,$no++);
			 $SI->setCellValue("B".$baris,$r['barcode']);
			 $SI->setCellValue("C".$baris,$r['tanggalproduk']);
			 $SI->setCellValue("D".$baris,$r['qty']);
			 $SI->setCellValue("E".$baris,$r['tanggalinput']);
			 $SI->setCellValue("F".$baris,$r['admin']);
			 $baris++;
		}
	}

	$excelku->getActiveSheet()->setSharedStyle($bodyStylenya, 'A4:F'.$baris.'');

	$excelku->getActiveSheet()->setTitle('GateInReport');

	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename=GateInReport"'.$start.'"to"'.$finish.'".xlsx');
	header('Cache-Control: max-age=0');
	 
	$objWriter = PHPExcel_IOFactory::createWriter($excelku, 'Excel2007');
	$objWriter->save('php://output');
	exit;
}
?>