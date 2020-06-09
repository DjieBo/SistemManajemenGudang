<?php
include "connect.php";
    if (isset($_POST['search'])) {
       $p = $_POST['search'];
       $Query = mysql_query("SELECT * FROM stock WHERE ID_Barang LIKE '%$p%' LIMIT 8");
       echo '<ul>';
       while($e = mysql_fetch_array($Query)) {
        echo "<a href='?produk=".$e['ID_Barang']."'><li>".$e['ID_Barang']."</li></a>";
      }
    }
    echo'</ul>';
?>