<?php
include "config/connect.php";
    if (isset($_POST['view'])) {
       $p = $_POST['view'];
       $Query = mysql_query("SELECT * FROM stok WHERE ID_Barang LIKE '%$p%'");
       echo '<ul>';
       while($e = mysql_fetch_array($Query)) {
        echo "<a href='?produk=".$e['ID_Barang']."'><li>".$e['ID_Barang']."</li></a>";
      }
    }
    echo'</ul>';
?>