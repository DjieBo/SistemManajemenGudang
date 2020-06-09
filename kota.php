<?php include 'config/connect.php';?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		form.kota{width: 70%;float: left;padding:30px;}
		.kota label{font-weight: bold;}
		.kota input [type=text]{padding:7px; width: 50%}
	</style>
</head>
<body>
	<form method="post" class="kota" enctype="multipart/form-data">
		<p><label>Provinsi</label><br><input type="text" name="prov" style="padding:7px; width: 50%" ></p>
		<p><label>Kota / Kabupaten</label><br><input type="text" name="kota" style="padding:7px; width: 50%" ></p>
		<p><label>Upload</label><br><input type="file" name="uploadkota"></p>
		<p><input type="submit" name="save" value="save"></p>
	</form>
	<?php
	if(isset($_POST['save'])){
		include "config/excel_reader2.php";
		error_reporting(0);
		$data = new Spreadsheet_Excel_Reader($_FILES['uploadkota']['tmp_name']);
		$baris = $data->rowcount($sheet_index=0);
		for ($i=1; $i<=$baris; $i++)
		{
		  $a = $data->val($i, 8);
		  $b = $data->val($i, 9);

		  $q = mysql_query("INSERT INTO location (provinsi, kota) VALUES ('$a', '$b')");
		}
		if($q){
			echo "<script>alert('Upload data Sukses');window.location = 'http://localhost/Shade&Co/kota.php';</script>";
		}else{
			echo "<script>alert('Upload data Gagal');window.location = 'http://localhost/Shade&Co/kota.php';</script>";
		}
	}
	?>
</body>
</html>