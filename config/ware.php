<?php
include 'connect.php';
$a = $_POST['pulauout'];
if($a == 'SUMATERA'){
	echo '
	<option value=""></option>
	<option value="ACEH">ACEH</option>
	<option value="SUMATERA UTARA">SUMATERA UTARA</option>
	<option value="SUMATERA BARAT">SUMATERA BARAT</option>
	<option value="RIAU">RIAU</option>
	<option value="JAMBI">JAMBI</option>
	<option value="SUMATERA SELATAN">SUMATERA SELATAN</option>
	<option value="BENGKULU">BENGKULU</option>
	<option value="LAMPUNG">LAMPUNG</option>
	<option value="KEPULAUAN BANGKA BELITUNG">KEPULAUAN BANGKA BELITUNG</option>
	<option value="KEPULAUAN RIAU">KEPULAUAN RIAU</option>
	';
}elseif($a == 'JAWABALI'){
	echo '
	<option value=""></option>
	<option value="DKI JAKARTA">DKI JAKARTA</option>
	<option value="JAWA BARAT">JAWA BARAT</option>
	<option value="JAWA TENGAH">JAWA TENGAH</option>
	<option value="DI YOGYAKARTA">DI YOGYAKARTA</option>
	<option value="JAWA TIMUR">JAWA TIMUR</option>
	<option value="BANTEN">BANTEN</option>
	<option value="BALI">BALI</option>
	';
}elseif($a == 'KALIMANTAN'){
	echo '
	<option value=""></option>
	<option value="KALIMANTAN BARAT">KALIMANTAN BARAT</option>
	<option value="KALIMANTAN TENGAH">KALIMANTAN TENGAH</option>
	<option value="KALIMANTAN SELATAN">KALIMANTAN SELATAN</option>
	<option value="KALIMANTAN TIMUR">KALIMANTAN TIMUR</option>
	';
}elseif($a == 'SULAWESI'){
	echo '
	<option value=""></option>
	<option value="SULAWESI UTARA">SULAWESI UTARA</option>
	<option value="SULAWESI TENGAH">SULAWESI TENGAH</option>
	<option value="SULAWESI SELATAN">SULAWESI SELATAN</option>
	<option value="SULAWESI TENGGARA">SULAWESI TENGGARA</option>
	<option value="SULAWESI BARAT">SULAWESI BARAT</option>
	<option value="GORONTALO">GORONTALO</option>
	';
}elseif($a == 'NUSA TENGGARRA'){
	echo '
	<option value=""></option>
	<option value="NUSA TENGGARA BARAT">NUSA TENGGARA BARAT</option>
	<option value="NUSA TENGGARA TIMUR">NUSA TENGGARA TIMUR</option>
	';
}elseif($a == 'MALUKUPAPUA'){
	echo '
	<option value=""></option>
	<option value="MALUKU">MALUKU</option>
	<option value="MALUKU UTARA">MALUKU UTARA</option>
	<option value="PAPUA BARAT">PAPUA BARAT</option>
	<option value="PAPUA">PAPUA</option>
	';
}elseif($a = false){
	echo '<option value=""></option>';
}
?>