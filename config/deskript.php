<?php
include "connect.php";
    if (isset($_POST['outbarcode'])) {
       $p = $_POST['outbarcode'];
       $Query = mysql_query("SELECT * FROM stok WHERE ID_Barang = '$p'");
       while($e = mysql_fetch_array($Query)) {
        echo "".$e['Deskripsi']."";
      }
    }
    $a = $_POST['codecek'];
    if($a == 'SRBS1C1'){
    	echo "aaa";
    }else{
    	echo "bbb";
    }
?>