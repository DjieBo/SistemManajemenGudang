<?php
include 'connect.php';
$b = $_POST['provstock'];
$f = mysql_query("select * from location where provinsi ='$b'");
while($r = mysql_fetch_array($f)){
	if($f){
		echo '<option value="'.$r['kota'].'"> '.$r['kota'].' </option>';
	}elseif($f == false){
		echo '<option>  </option>';
	}
}
?>