<?php
include 'connect.php';
function login(){
if(isset($_POST['login'])){
		$user = mysql_real_escape_string($_POST['user']);
		$pass = md5(mysql_real_escape_string($_POST['pass']));

		if(empty($user) or empty($pass)){
			echo "<script>alert('Maaf Username atau Password tidak boleh kosong..!!');window.location='http://localhost/Shade&Co/;</script>";
		}else{
			$sql = mysql_query("select * from superadmin where username='$user' and password='$pass'");
			if(mysql_num_rows($sql) == 1){
				$check = mysql_fetch_array($sql);
				if($check['gate'] == true){
					session_start();
					$_SESSION['user'] = $check['username'];
					$_SESSION['status'] = $check['gate'];
					echo "<script>window.location = 'http://localhost/Shade&Co/';</script>";
				}else{
					echo "<script>alert('Maaf anda belum memilih Gate');window.location='http://localhost/Shade&Co/;</script>";
				}
			}else{
				echo "<script>alert('Maaf Username anda belum terdaftar');window.location='http://localhost/Shade&Co/;</script>";
			}
		}
	}
}
function register(){
	if(isset($_POST['reg'])){
		$user = mysql_real_escape_string($_POST['user']);
		$pass = md5(mysql_real_escape_string($_POST['password']));
		$gate = mysql_real_escape_string($_POST['gate']);
		$in = mysql_query("insert into superadmin (username, password, gate)values('$user', '$pass', '$gate')");
		if($in){
			echo "<script>alert('Admin Baru Udah Kedaftar Bro..!!')</script>";
		}
	}

	session_start();
	if(isset($_POST['login'])){
		$pass = md5(mysql_real_escape_string($_POST['pass']));
		if ($pass == '67a8e7a241e97718b4819c17d1d5eaed') {
			$admin = 'Master Admin';
			$_SESSION['admin'] = $admin;
			echo"<script>window.location = 'http://localhost/Shade&Co/?sys=admin';</script>";
		}	
	}elseif(isset($_POST['logout'])){
		session_destroy();
		echo"<script>window.location = 'http://localhost/Shade&Co/';</script>";
	}
}

function In_data(){
	if(isset($_POST['in_send'])){
	$barcode = mysql_real_escape_string($_POST['in_barcode']);
	$qty = mysql_real_escape_string($_POST['in_qty']);
	date_default_timezone_set("Asia/Jakarta");
    $waktu = date("Y-m-d H:i:s");
    if($qty == ''){$qty = 1;}
    $l = mysql_query("select * from databasemaster where ID_Barang = '$barcode'");
    if(mysql_num_rows($l) == 1){
    	$des = mysql_fetch_array($l);
    	$in = mysql_query("insert into gatein (ID_Barang, qty, tanggalinput, admin)values('$barcode', '$qty', '$waktu', '".$_SESSION['user']."')");
    
        $h = mysql_query("select * from stock where ID_Barang = '".$barcode."'");
        if(mysql_num_rows($h) == 1){
        	$q = mysql_fetch_array($h);
        	$qtty = $q['qty'] + $qty;
        	$r = mysql_query("update stock set qty='$qtty', width='".$des['width']."', height='".$des['height']."', fc='".$des['fc']."', color='".$des['color']."', lastupdate='$waktu' where ID_Barang = '".$barcode."'");
        }elseif(mysql_num_rows($h) == 0){
        	$stok = mysql_query("insert into stock (ID_Barang, width, height, fc, color, qty, lastupdate, admin)values('$barcode', '".$des['width']."', '".$des['height']."', '".$des['fc']."', '".$des['color']."', '$qty', '$waktu', '".$_SESSION['user']."')");
        }
    }elseif(mysql_num_rows($l) == 0){
    	$ff = mysql_query("insert into stock (ID_Barang, qty, lastupdate, admin)values('$barcode', '$qty', '$waktu', '".$_SESSION['user']."')");
    	$gg = mysql_query("insert into gatein (ID_Barang, qty, tanggalinput, admin)values('$barcode', '$qty', '$waktu', '".$_SESSION['user']."')");
    }
    

    if($r and $in){
    	echo "<script>
				document.getElementById('attentinupdate').style.display='block';
				setTimeout(function() {
				    $('#attentinupdate').fadeOut('slow');
				}, 1000);
			  </script>";
    }elseif($stok and $in){
    	echo "<script>
				document.getElementById('attentinsuskses').style.display='block';
				setTimeout(function() {
				    $('#attentinsuskses').fadeOut('slow');
				}, 1000);
			  </script>";
	}elseif($ff and $gg){
    	echo "<script>
				document.getElementById('attentinsuskses').style.display='block';
				setTimeout(function() {
				    $('#attentinsuskses').fadeOut('slow');
				}, 1000);
			  </script>";
	}else{
		echo "<script>
				document.getElementById('attentingagal').style.display='block';
				setTimeout(function() {
				    $('#attentinsuskses').fadeOut('slow');
				}, 1000);
			  </script>";
	}
    
}
}
function out_data(){
	if(isset($_POST['out_send'])){
		$a = mysql_real_escape_string($_POST['outbarcode']);
		$b = mysql_real_escape_string($_POST['out_deskrpt']);
		$c = mysql_real_escape_string($_POST['out_qty']);
		date_default_timezone_set("Asia/Jakarta");
	    $waktu = date("Y-m-d H:i:s");
	    $h = mysql_query("select * from stock where ID_Barang = '".$a."'");
	        if(mysql_num_rows($h) == 1){
	        	$q = mysql_fetch_array($h);
	        	$qtty = $q['qty'] - $c;
	        	$r = mysql_query("update stock set qty='$qtty', lastupdate='$waktu' where ID_Barang = '".$a."'");
	        }
	    

	    if($r){
	    	echo "<script>
					document.getElementById('attentinupdate').style.display='block';
					setTimeout(function() {
					    $('#attentinupdate').fadeOut('slow');
					}, 1000);
				  </script>";
	    }else{
			echo "<script>
					document.getElementById('attentingagal').style.display='block';
					setTimeout(function() {
					    $('#attentinsuskses').fadeOut('slow');
					}, 1000);
				  </script>";
		}
	    
	}
}
function ISsystem(){
	if(isset($_POST['sendis'])){
		date_default_timezone_set("Asia/Jakarta");
	    $time = date("Y-m-d H:i:s");
		$a = mysql_real_escape_string($_POST['so']);
		$b = mysql_real_escape_string($_POST['project']);
		$pro = mysql_real_escape_string($_POST['prov']);
		$kot = mysql_real_escape_string($_POST['kota']);
		$c = mysql_real_escape_string($_POST['address']);
		$d = mysql_real_escape_string($_POST['pic']);
		$e = mysql_real_escape_string($_POST['phone']);
		$f = $_POST['pcode'];
		$g = $_POST['qty'];
		foreach ($f as $key => $val) {
			$u = mysql_query("insert into inquirysales (so, project, provinsi, kota, address, pic, phone, ID_Barang, qty, request)values('$a', '$b', '$pro', '$kot', '$c', '$d', '$e', '$val', '".$g[$key]."', '$time')");
		}
		if($u){
			echo '<div class="att"><div class="message" id="attscc">
				<div class="img-message"><img src="img/send.png"></div>
				<div class="text-message"><h2>Inquiry Telah Terkirim</h2></div>
			</div></div>';
			echo "<script>
					document.getElementById('attscc').style.display='block';
					setTimeout(function() {
					    $('#attscc').fadeOut('slow');
					}, 1000);
					setTimeout(function() {
					    window.location = 'http://localhost/Shade&Co/?func=inquirysales';
					}, 1400);
				  </script>";

		}else{
			echo '<div class="att"><div class="message" id="attfail">
				<div class="img-fail-message"><img src="img/failed.jpg"></div></div>
			</div></div>';

			echo "<script>
					document.getElementById('attfail').style.display='block';
					setTimeout(function() {
					    $('#attfail').fadeOut('slow');
					}, 1000);
					setTimeout(function() {
					    window.location = 'http://localhost/Shade&Co/?func=inquirysales';
					}, 1400);
				  </script>";
		}
	}
}
function out(){
	if(isset($_POST['out'])){
		session_start();
		session_destroy();
		echo "<script>window.location = 'http://localhost/Shade&Co/';</script>";
	}
}
function search(){
    if (isset($_POST['search'])) {
       $product = $_POST['search'];
       $Query = mysql_query("SELECT * FROM stock WHERE ID_Barang LIKE '%$product%'");
       
       echo '<ul>';
       while($e = mysql_fetch_array($Query)) {
        echo "<li><a href='#'>".$e['ID_Barang']."</a></li>";
      }
    }
    echo'</ul>';
}
function upload(){
	if(isset($_POST['upmain'])){
		include "excel_reader2.php";
		error_reporting(0);
		$data = new Spreadsheet_Excel_Reader($_FILES['dbmaster']['tmp_name']);
		$baris = $data->rowcount($sheet_index=0);
		for ($i=2; $i<=$baris; $i++)
		{
		  $width = $data->val($i, 1);
		  $height = $data->val($i, 2);
		  $fc = $data->val($i, 3);
		  $color = $data->val($i, 4);
		  $code = $data->val($i, 5);

		  $q = mysql_query("INSERT INTO databasemaster (ID_Barang, width, height, fc, color) VALUES ('$code', '$width', '$height', '$fc', '$color')");
		}
		if($q){
			echo "<script>alert('Upload data Sukses');window.location = 'http://localhost/Shade&Co/';</script>";
		}else{
			echo "<script>alert('Upload data Gagal');window.location = 'http://localhost/Shade&Co/';</script>";
		}
	}
}
function downloadIN(){
	if(isset($_POST['inset'])){
	$start = $_POST['inStartDate'];
	$finish = $_POST['inEndDate'];
	
	if(empty($start) or empty($finish)){
		echo "<script>alert('Maaf anda belum memasukan tanggal!!');window.loction='http://localhost/Shade&Co/';</script>";
	}else{
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

	$excelku->getActiveSheet()->mergeCells('A1:E1');
	$excelku->getActiveSheet()->mergeCells('A2:E2');
		
	$SI = $excelku->setActiveSheetIndex(0);
	$SI->setCellValue('A1', 'Gate In Report')->getStyle('A1')->getFont()->setSize(20);
	$SI->setCellValue('A3', 'No');
	$SI->setCellValue('B3', 'Barcode');
	$SI->setCellValue('C3', 'Qty');
	$SI->setCellValue('D3', 'Operator');
	$SI->setCellValue('E3', 'Tanggal Input');

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

	$excelku->getActiveSheet()->setSharedStyle($headerStylenya, 'A3:E3');

	$get = mysql_query("select * from gatein");
	$baris  = 4;
	$no     = 1;
	while($r = mysql_fetch_array($get)){
		$date = substr($r['tanggalinput'], 0, 10);
		if(($date >= $start) and ($date <= $finish)){
			$SI->setCellValue("A".$baris,$no++);
			 $SI->setCellValue("B".$baris,$r['ID_Barang']);
			 $SI->setCellValue("C".$baris,$r['qty']);
			 $SI->setCellValue("D".$baris,$r['admin']);
			 $SI->setCellValue("E".$baris,$r['tanggalinput']);
			 $baris++;
		}
	}

	$excelku->getActiveSheet()->setSharedStyle($bodyStylenya, 'A4:E'.$baris.'');

	$excelku->getActiveSheet()->setTitle('GateInReport');

	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename=Shade&Co_GateIn_"'.$start.'"to"'.$finish.'".xlsx');
	header('Cache-Control: max-age=0');
	ob_end_clean();
	$objWriter = PHPExcel_IOFactory::createWriter($excelku, 'Excel2007');
	$objWriter->save('php://output');
	exit;
	}
}
}
function downloadStock(){
	if(isset($_POST['isset'])){
	$start = $_POST['isStartDate'];
	$finish = $_POST['isEndDate'];
	
	if(empty($start) or empty($finish)){
		echo "<script>alert('Maaf anda belum memasukan tanggal!!');window.loction='http://localhost/Shade&Co/';</script>";
	}else{
		include "Classes/PHPExcel.php";
		date_default_timezone_set("Asia/Jakarta");
		$excelku = new PHPExcel();
		$excelku->getProperties()->setCreator("DjieBo")
		                         ->setLastModifiedBy("DjieBo");

		$excelku->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$excelku->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$excelku->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$excelku->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$excelku->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$excelku->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$excelku->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		$excelku->getActiveSheet()->getColumnDimension('H')->setWidth(20);

		$excelku->getActiveSheet()->mergeCells('A1:H1');
		$excelku->getActiveSheet()->mergeCells('A2:H2');
			
		$SI = $excelku->setActiveSheetIndex(0);
		$SI->setCellValue('A1', 'Stock Report')->getStyle('A1')->getFont()->setSize(20);
		$SI->setCellValue('A3', 'No');
		$SI->setCellValue('B3', 'Quantity');
		$SI->setCellValue('C3', 'Width');
		$SI->setCellValue('D3', 'Height');
		$SI->setCellValue('E3', 'Fabric Code');
		$SI->setCellValue('F3', 'Color');
		$SI->setCellValue('G3', 'Product Code');
		$SI->setCellValue('H3', 'Last Update');

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

		$excelku->getActiveSheet()->setSharedStyle($headerStylenya, 'A3:H3');

		$get = mysql_query("select * from stock");
		$baris  = 4;
		$no     = 1;
		while($r = mysql_fetch_array($get)){
			$date = substr($r['lastupdate'], 0, 10);
			if(($date >= $start) and ($date <= $finish)){
				$SI->setCellValue("A".$baris,$no++);
				 $SI->setCellValue("B".$baris,$r['qty']);
				 $SI->setCellValue("C".$baris,$r['width']);
				 $SI->setCellValue("D".$baris,$r['height']);
				 $SI->setCellValue("E".$baris,$r['fc']);
				 $SI->setCellValue("F".$baris,$r['color']);
				 $SI->setCellValue("G".$baris,$r['ID_Barang']);
				 $SI->setCellValue("H".$baris,$r['lastupdate']);
				 $baris++;
			}
		}

		$excelku->getActiveSheet()->setSharedStyle($bodyStylenya, 'A4:H'.$baris.'');

		$excelku->getActiveSheet()->setTitle('Stock Report');

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename=Shade&Co_Stock_"'.$start.'"to"'.$finish.'".xlsx');
		header('Cache-Control: max-age=0');
		ob_end_clean();
		$objWriter = PHPExcel_IOFactory::createWriter($excelku, 'Excel2007');
		$objWriter->save('php://output');
		exit;
		}
	}
}
function downloadOut(){
	if(isset($_POST['outset'])){
	session_start();
	$prov = $_POST['provout'];
	$kota = $_POST['kotaout'];
	$_SESSION['kota'] = $kota;
	$start = $_POST['outStartDate'];
	$finish = $_POST['outEndDate'];
	if(empty($start) or empty($finish)){
		echo "<script>alert('Maaf anda belum memasukan tanggal!!');window.loction='http://localhost/Shade&Co/';</script>";
	}else{
		$g = mysql_query("select * from gateout where kota='".$_SESSION['kota']."'");
		if(mysql_num_rows($g) >= 1){
			include "Classes/PHPExcel.php";
			date_default_timezone_set("Asia/Jakarta");
			$excelku = new PHPExcel();
			$excelku->getProperties()->setCreator("DjieBo")
			                         ->setLastModifiedBy("DjieBo");

			$excelku->getActiveSheet()->getColumnDimension('A')->setWidth(5);
			$excelku->getActiveSheet()->getColumnDimension('B')->setWidth(20);
			$excelku->getActiveSheet()->getColumnDimension('C')->setWidth(20);
			$excelku->getActiveSheet()->getColumnDimension('D')->setWidth(20);
			$excelku->getActiveSheet()->getColumnDimension('E')->setWidth(20);
			$excelku->getActiveSheet()->getColumnDimension('F')->setWidth(20);
			$excelku->getActiveSheet()->getColumnDimension('G')->setWidth(20);
			$excelku->getActiveSheet()->getColumnDimension('H')->setWidth(20);
			$excelku->getActiveSheet()->getColumnDimension('I')->setWidth(20);
			$excelku->getActiveSheet()->getColumnDimension('J')->setWidth(20);
			$excelku->getActiveSheet()->getColumnDimension('K')->setWidth(20);

			$excelku->getActiveSheet()->mergeCells('A1:K1');
			$excelku->getActiveSheet()->mergeCells('A2:K2');
				
			$SI = $excelku->setActiveSheetIndex(0);
			$SI->setCellValue('A1', 'Gate Out Report')->getStyle('A1')->getFont()->setSize(20);
			$SI->setCellValue('A3', 'No');
			$SI->setCellValue('B3', 'SO');
			$SI->setCellValue('C3', 'Project');
			$SI->setCellValue('D3', 'Provinsi');
			$SI->setCellValue('E3', 'Kota');
			$SI->setCellValue('F3', 'Alamat');
			$SI->setCellValue('G3', 'PIC');
			$SI->setCellValue('H3', 'Phone');
			$SI->setCellValue('I3', 'Product Code');
			$SI->setCellValue('J3', 'Quantity');
			$SI->setCellValue('K3', 'Tanggal');

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

			$excelku->getActiveSheet()->setSharedStyle($headerStylenya, 'A3:K3');

			$get = mysql_query("select * from gateout");
			$baris  = 4;
			$no     = 1;
			while($r = mysql_fetch_array($get)){
				$date = substr($r['tanggal'], 0, 10);
				if($r['kota'] == $_SESSION['kota']){
					if(($date >= $start) and ($date <= $finish)){
						 $SI->setCellValue("A".$baris,$no++);
						 $SI->setCellValue("B".$baris,$r['so']);
						 $SI->setCellValue("C".$baris,$r['project']);
						 $SI->setCellValue("D".$baris,$r['provinsi']);
						 $SI->setCellValue("E".$baris,$r['kota']);
						 $SI->setCellValue("F".$baris,$r['address']);
						 $SI->setCellValue("G".$baris,$r['pic']);
						 $SI->setCellValue("H".$baris,$r['phone']);
						 $SI->setCellValue("I".$baris,$r['ID_Barang']);
						 $SI->setCellValue("J".$baris,$r['qty']);
						 $SI->setCellValue("K".$baris,$r['tanggal']);
						 $baris++;
					}
				}
			}

			$excelku->getActiveSheet()->setSharedStyle($bodyStylenya, 'A4:K'.$baris.'');

			$excelku->getActiveSheet()->setTitle('Gate Out Report');

			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename=Shade&Co_GateOut_"'.$start.'"to"'.$finish.'".xlsx');
			header('Cache-Control: max-age=0');
			ob_end_clean();
			$objWriter = PHPExcel_IOFactory::createWriter($excelku, 'Excel2007');
			$objWriter->save('php://output');
			exit;
		}else{
			echo "<script>alert('Maaf Tidak Ada Lokasi ".$kota." di Data Gate Out');window.loction='http://localhost/Shade&Co/';</script>";
		}
	}
	}
}
function printOut(){
	if(isset($_POST['printout'])){
		date_default_timezone_set("Asia/Jakarta");
	    $time = date("Y-m-d H:i:s");
		$a = $_POST['outso'];
		foreach ($a as $key => $val) {
			$f = mysql_query("select * from inquirysales where so='".$val."'");
			while($g = mysql_fetch_array($f)){
				/*echo "<script>alert('".$g['so']."');</script>";*/
				$v = $g['qty'];

				$h = mysql_query("update gateout set act='d' where so='".$val."'");

				$t = mysql_query("select * from stock where ID_Barang = '".$g['ID_Barang']."'");
				while($y = mysql_fetch_array($t)){
					$s = $y['qty'];
					$qnow = $s - $v;
					$l = mysql_query("update stock set qty = '$qnow', lastupdate='$time' where ID_Barang = '".$g['ID_Barang']."'");
				}
			}
		}
		if($h and $t){
			echo "<script>alert('Input Gate Out dan Update Stock SUKSES');</script>";
		}elseif($h){
			echo "<script>alert('Input Gate Out SUKSES dan Update Stock GAGAL');</script>";
		}else{
			echo "<script>alert('GAGAL Semua');</script>";
		}
	}
}
function validate(){
	if(isset($_POST['valid'])){
		$id = $_POST['sno'];
		$a = $_POST['NoSO'];
		$b = $_POST['codemain'];
		$c = $_POST['qtymain'];
		$d = $_POST['codecek'];
		$e = $_POST['qtycek'];
		date_default_timezone_set("Asia/Jakarta");
	    $time = date("Y-m-d H:i:s");
		$i = 0;
		foreach ($a as $k => $value) {		
			$p = count($a);
			if( $b[$k] == $d[$k] and $c[$k] == $e[$k] ){
				$l = 1;
			}else{$l = 0;}
			$sum += $l;
		}
		if($p == $sum){
			$r = mysql_query("insert into gateout(so, project, provinsi, kota, address, pic, phone, ID_Barang, qty) select so, project, provinsi, kota, address, pic, phone, ID_Barang, qty from inquirysales where so = '".$id."'");
			$y = mysql_query("update gateout set tanggal='$time', status='done' where so = '$id'");
			if($r){
				echo "<script>alert(' Data Cocok !! ');window.location='http://localhost/Shade&Co/';</script>";
			}
		}else{
			echo "<script>alert(' Data Tidak Cocok ')</script>";
		}
		
	}
}
