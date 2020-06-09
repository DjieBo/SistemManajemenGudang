<?php
include 'connect.php';
$a = $_POST['prov'];
$b = $_POST['provout'];

if($a == true){
	$f = mysql_query("select * from location where provinsi ='$a'");
	while($r = mysql_fetch_array($f)){
		echo '<option value="'.$r['kota'].'"> '.$r['kota'].' </option>';
	}
}elseif($a == false){
	echo '<option>  </option>';
}

if($b == true){
	$g = mysql_query("select distinct kota from inquirysales where provinsi ='$b'");
		while($h = mysql_fetch_array($g)){
		echo '<option value="'.$h['kota'].'"> '.$h['kota'].' </option>';
	}
}elseif($b == false){
	echo '<option>  </option>';
}




/*
$f = mysql_query("select * from location");
while($y = mysql_fetch_array($f)){
	if($a == $y['provinsi']){
	echo '<option value="'.$y['kota'].'"> '.$y['kota'].' </option>';
	}else{
		echo '<option>  </option>';
	}
}*/
?>