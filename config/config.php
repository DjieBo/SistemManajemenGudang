<?php
	include 'connect.php';
	include 'system.php';
function defaultView(){?>
<section class="log-project">

	<div class="wrap-project">
		<div class="title-project"></div>
		<div class="form-project default-log">
			<form action="" method="post" class="frm-log">
				<p><label>Username</label><br><input type="text" name="user" autocomplete="off" autofocus></p>
				<p><label>Password</label><br><input type="password" name="pass"></p>
				<p><input type="submit" name="login" value="Login"></p>
			</form>
			<div class="form-img"><img src="img/padlock.png"></div>
		</div>
	
	</div>
</section>
<?php
login();
}
function gatein(){
	session_start();
	if($_SESSION['status'] == 'gatein'){?>
		<head>
			<script>
				function InQty(val){
					var r = confirm("Anda menambahkan quantity sebanyak = " + " " + " " + val);
					if(r == true){
						document.getElementById("inQty").value = val;
					}else{
						document.getElementById("inQty").value = "1";
					}
				}
			</script>
			<script src="js/jquery-1.7.1.js"></script>
			<script>
				function tab(field, event) {
				    if (event.which == 13 || event.keyCode == 13 ) {
				        for (i = 0; i < field.form.elements.length; i++) {
				            if (field.form.elements[i].tabIndex == field.tabIndex + 1) {
				                field.form.elements[i].focus();
				                if (field.form.elements[i].type == "text") {
				                    field.form.elements[i].select();
				                    break;
				                }
				            }
				        }
				        return false;
				    }
				    return true;
				}
			</script>
		</head>
		<section class="gatein-project">
			<div class="form-gatein">
				<div class="title-project"><h2> Product Code </h2></div>
				<div class="admin-project">
					<div class="admin-col-project"> Operator : <?php echo $_SESSION['user'];?> </div>
					<div class="logout-col-project"><a href="logout.php"> Keluar <img src="img/logout.png"> </a></div>
				</div>
				<div class="form-project">
					<form action="" method="post">
						<p><label>ID Barcode</label><br><input type="text" placeholder="ID Barang" name="in_barcode" id="barcode" tabIndex="1" autocomplete="off" onkeydown="return tab(this, event)" autofocus></p>
						<p><label>Quantity</label><br><input type="text" name="in_qty" id="inQty" maxlength="5" style="width:10%" tabIndex="2" autocomplete="off" placeholder="1" onchange="InQty(this.value)" ></p>
						<p><input type="submit" name="in_send" value="Send"></p>
					</form>
					<div class="attent-scc" id="attentinsuskses" style="display: none"><div class="check-dv"><img src="img/check.png"></div><h3>Input Sukses</h3></div>
					<div class="attent-scc" id="attentingagal" style="display: none"><div class="check-dv"><img src="img/check.png"></div><h3>Input Gagal</h3></div>
					<div class="attent-scc" id="attentinupdate" style="display: none"><div class="check-dv"><img src="img/check.png"></div><h3>Stok Terupdate</h3></div>
				</div>
			</div>
		</section>
		<div class="overflow"></div>
		<?php In_data(); ?>	
	<?php
	}
}
function gateout(){?>
<head>
	<script src="js/jquery-3.3.1.js"></script>
	<script>
	$(document).ready(function(){
	    $('#barang').keypress(function(){
	        var brg = $('#barang').val();
	        	$.ajax({
			    type: 'post',
			    url: 'config/deskript.php',
			    data: {
			        'outbarcode': brg        },
			    success: function(data) {
			        $('#textarea').text(data)
			    }
			});
	    });
	});
	</script>
	<script src="js/jquery-1.7.1.js"></script>
	<script>
		function tab(field, event) {
		    if (event.which == 13 || event.keyCode == 13 ) {
		        for (i = 0; i < field.form.elements.length; i++) {
		            if (field.form.elements[i].tabIndex == field.tabIndex + 1) {
		                field.form.elements[i].focus();
		                if (field.form.elements[i].type == "text") {
		                    field.form.elements[i].select();
		                    break;
		                }
		            }
		        }
		        return false;
		    }
		    return true;
		}
	</script>

</head>
<header>
	<div class="left-panel"><?php echo $_SESSION['user'];?></div>
	<div class="right-panel"><a href="logout.php"> Keluar </a></div>
</header>
<section class="gateout-project">
	<div class="row-form">
		<div class="form-gateout">
			<div class="title-project-out"><h2>Product Out System</h2></div>
			<div class="admin-project">
				<div class="admin-col-project"></div>
				<div class="logout-col-project"></div>
			</div>
			<div class="form-project out-form">
				<form action="" method="post">
					<p><label>ID Barcode</label><br><input type="text" id="barang" name="outbarcode" autocomplete="off" onkeydown="return tab(this, event)"></p>
					<p>
						<label>Deskripsi Produk</label><br>
						<textarea id="textarea" name="out_deskrpt"></textarea>
					</p>
					<p><label>Quantity</label><br><input type="text" name="out_qty" maxlength="2" style="width:10%" autocomplete="off" placeholder="1" required></p>
					<p><input type="submit" name="out_send" value="Send"></p>
				</form>
				<div class="attent-scc" id="attentinsuskses" style="display: none"><div class="check-dv"><img src="img/check.png"></div><h3>Input Sukses</h3></div>
				<div class="attent-scc" id="attentingagal" style="display: none"><div class="check-dv"><img src="img/check.png"></div><h3>Input Gagal</h3></div>
				<div class="attent-scc" id="attentinupdate" style="display: none"><div class="check-dv"><img src="img/check.png"></div><h3>Stok Terupdate</h3></div>
			</div>
		</div>
		<form method="post">
		<div class="view-message">
			<h2>View Order</h2>
			<div class="title-view"> Message </div>
			<div class="list-view" id="viewlist"></div>
			<script type="text/javascript">
				$(document).ready(function(){
					setInterval(function(){
						$('#viewlist').load('config/data.php')
					}, 2000);
				});
			</script>
			<input type="submit" name="printout" value="Print" class="print">
			</form>
			<?php printOut();?>
		</div>
		
	</div>
	<?php
		$t = mysql_query("select distinct so from inquirysales where so = '".$_GET['so']."'");
		while ($y = mysql_fetch_array($t)) {?>
			<div class="overso">
				<div class="out-modal" id="outmodal">
					<form method="post" id="validatecode" class="form-chek">
						<div class="row-code">
							<div class="col-code-title"><h3>Cek Field Code</h3></div>
							<div class="col-code-title"><h3 style="text-align: left;padding-left: 35px;">List Inquery Code</h3></div>
						</div>
						<?php
						$n = 1;
						$m = mysql_query("select * from inquirysales where so = '".$y['so']."'");
						while ($b = mysql_fetch_array($m)) {
						$n++;
						$id = $b['ID_Barang'];
						echo'
						<div class="col-code">
						<input type="hidden" name="sno" value="'.$b['so'].'">
						<input type="hidden" name="NoSO[]" value="'.$b['so'].'">
						<li>
							<div class="sub-col-code" style="margin-left: 50px;"><p><label>Product Code</label><br><input type="text" autocomplete="off" name="codemain[]" tabIndex="'.$n++.'" id="codemain'.$id.'" value=""  autofocus></p></div>
							<div class="sub-col-code" style="width:15%"><p><label>Quantity</label><br><input type="text" tabIndex="'.$n++.'" name="qtymain[]" id="qtymain'.$id.'" autocomplete="off" style="width:90%"></p></div>
						</li>

						<li>
							<div class="sub-col-code"><p><label>Product Code</label><br><input type="text" name="codecek[]"  value="'.$b['ID_Barang'].'" id="codecek'.$id.'" readonly></p></div>
							<div class="sub-col-code" style="width: 20%;"><p><label>Quantity</label><br><input type="text" name="qtycek[]" value="'.$b['qty'].'" style="width:75%" id="qtycek'.$id.'" readonly></p></div>
							<div class="alettrt alert-cek img-cek-code" id="attcode'.$id.'"><img src="img/check.png"></div>
							<div class="alettrt img-cek-qty" id="attqty'.$id.'"><img src="img/check.png"><div id="alet"></div></div>
						</li>
						</div>
						';
						
						?>
						<script>
							$(function() {
							    $('#codemain<?php echo $id ?>').keyup(function() {
							        var codemain<?php echo $id ?> = $(this).val();
							        var code<?php echo $id ?> = $("#codecek<?php echo $id ?>").val();
							        if(codemain<?php echo $id ?> == code<?php echo $id ?>){
							        	document.getElementById("attcode<?php echo $id ?>").style.display="block";
							        }else if(codemain<?php echo $id ?> == false){
							        	
							        }else if(codemain<?php echo $id ?> != code<?php echo $id ?>){
							        	alert("Maaf Data Tidak Cocok!!");
							        	document.getElementById("attcode<?php echo $id ?>").style.display="none";
							        	$('#codemain<?php echo $id ?>').val('');
							        }
							    }).keyup();

							    $('#qtymain<?php echo $id ?>').keyup(function() {
							        var qtymain<?php echo $id ?> = $(this).val();
							        var qty<?php echo $id ?> = $("#qtycek<?php echo $id ?>").val();
							        if(qtymain<?php echo $id ?> == qty<?php echo $id ?>){
							        	document.getElementById("attqty<?php echo $id ?>").style.display="block";
							        }else if(qtymain<?php echo $id ?> == false){
							        	
							        }else if(qtymain<?php echo $id ?> != qty<?php echo $id ?>){
							        	document.getElementById("attqty<?php echo $id ?>").style.display="none";
							        }
							    }).keyup();
							});
						</script>
						<?php
						}
						?>
						<input type="submit" name="valid" value="Validate">
						</div>
					</form>
					<?php validate();?>
					<div id="closepanel" class="close-btn"><a href="http://localhost/Shade&Co/"> X </a></div>
				</div>
			</div>
		<?php
		}
	?>
	
</section>
<?php
out_data();
}
function inquerySales(){?>
	<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="js/onchange.js"></script>
	<script src="js/valueseach.js"></script>
</head>
<body>
<?php
	echo'
	<header>
		<div class="head-left"></div>
		<div class="head-right"><form method="post"> <input type="submit" name="out" value="Keluar"></form></div>
	</header>
	<section class="management-project">
		<div class="mag-left">
			<ul>
				<li><a href="?func=stok"><img src="img/arrow.png"> Cek Stok</a></li>
				<li><a href="?func=inquirysales"><img src="img/arrow.png"> Inquiry Sales</a></li>
			</ul>
		</div>
		<div class="mag-right">';
		error_reporting(0);
		if($_GET['func'] == 'stok'){default_page();}
		elseif($_GET['func'] == 'inquirysales'){Order();}
		else{default_page();}
	echo'</div>
	</section>
	';
out();
search();
?>
<?php
}
function default_page(){
	echo'
	<h2>Cek Stok Barang</h2>
			<div class="form-search">
				<p><label>Product Code</label><br><input type="text" name="search" id="searching" placeholder="ID" autocomplete="off"><div id="listProduk"></div></p>
			</div>
			<div class="form-view">
				<h2>Tabel Stok Barang</h2>
				<ul class="head-list">
					<div class="list id-brg">Product Code</div>
					<div class="list desc-brg">Deskripsi</div>
					<div class="list qty-brg">Quantity</div>
				</ul>
				<ul class="head-list" style="border-bottom:2px solid #ddd;background: #fff;">
					<div class="down-list sub-id-brg"></div>
					<div class="down-list sub-desc-brg">
						<div class="sub-list" style="border-right:1px solid #ddd"><b>Width</b></div>
						<div class="sub-list" style="border-right:1px solid #ddd"><b>Height</b></div>
						<div class="sub-list" style="border-right:1px solid #ddd"><b>Fabric Code</b></div>
						<div class="sub-list"><b>Color</b></div>
					</div>
					<div class="down-list sub-qty-brg"></div>
				</ul>
				<ul class="list-produk">';
		$g = mysql_query("select * from stock where ID_Barang = '".$_GET['produk']."'");
		if(mysql_num_rows($g) == 1){
			$f = mysql_fetch_array($g);
			echo'
				<li>
					<div class="list list-id-brg" style="color:#f00">'.$f['ID_Barang'].'</div>
					<div class="list list-desc-brg">
						<div class="sub-list" style="border-right:1px solid #ddd;padding:0;color:#f00">'.$f['width'].'</div>
						<div class="sub-list" style="border-right:1px solid #ddd;padding:0;color:#f00">'.$f['height'].'</div>
						<div class="sub-list" style="border-right:1px solid #ddd;padding:0;color:#f00">'.$f['fc'].'</div>
						<div class="sub-list" style="padding:0;color:#f00">'.$f['color'].'</div>
					</div>
					<div class="list list-qty-brg" style="color:#f00">'.$f['qty'].'</div>
				</li>
			';
		}
					
	echo'
				</ul>
			</div>
	';

}
function Order(){
	?>
		<head>
		<script src="js/jquery-3.3.1.js"></script>
		<script src="js/onchange.js"></script>
		<script>
		$(document).ready(function(){
		    $("#add").click(function(){
		        $("#rowproduct").append('<div class="spe-row" id="rowproduct"><li><label>Product Code</label><br><input type="text" name="pcode[]" autocomplete="off"></li><li><label>Qty</label><br><input type="text" name="qty[]" style="width:30%" autocomplete="off"></li></div>');
		    });
		});
		</script>
		<script>
            $(function() {
              $('#phone').on('keydown', '#nophone', function(e){-1!==$.inArray(e.keyCode,[46,8,9,27,13,110])||(/65|67|86|88/.test(e.keyCode)&&(e.ctrlKey===true||e.metaKey===true))&&(!0===e.ctrlKey||!0===e.metaKey)||35<=e.keyCode&&40>=e.keyCode||(e.shiftKey||48>e.keyCode||57<e.keyCode)&&(96>e.keyCode||105<e.keyCode)&&e.preventDefault()});
            })
        </script>
		</head>
	<?php
	echo'
		<div class="order">
			<h2>Inquiry Sales</h2>
			<form method="post">
				<div class="half-side">
					<p><label>No. SO</label><br><input type="text" name="so" tabIndex="1" autocomplete="off" autofocus required></p>
					<p><label>Project</label><br><input type="text" name="project" tabIndex="2" autocomplete="off" required></p>
					';
					echo '<p><label>Provinsi</label><br><select name="prov" tabIndex="3" onchange="SelectProv(this.value);"><option></option>';
					$t = mysql_query("select distinct provinsi from location");
					while($r = mysql_fetch_array($t)){
						echo '<option value="'.$r['provinsi'].'"> '.$r['provinsi'].' </option>';
					}
	echo'			</select></p>
					<p><label>Kota / Kabupaten </label><br><input type="text" tabIndex="4" name="kota" required></p>
					<p><label>Alamat</label><br><textarea name="address" tabIndex="5" autocomplete="off" required></textarea></p>
					<p><label>PIC</label><br><input type="text" name="pic" tabIndex="6" autocomplete="off" required></p>
					<p id="phone"><label>No. Tlfon</label><br><input type="text" name="phone" id="nophone" tabIndex="7" autocomplete="off" required></p>
				</div>
				<div class="half-side">
					<div class="spe-row" id="rowproduct">
						<li><label>Product Code</label><br><input type="text" name="pcode[]" tabIndex="8" autocomplete="off" required></li>
						<li><label>Qty</label><br><input type="text" name="qty[]" style="width:30%" tabIndex="9" autocomplete="off" required></li>
					</div>
					<div class="bt-add" id="add" tabIndex="10">+</div>
				</div>
				<div class="full-side"><p><input type="submit" name="sendis" value="Kirim"></p></div>
			</form>
		</div>
	';
	ISsystem();
	
}
function reg(){
session_start();
echo'<section class="admin-panel">';
if(!isset($_SESSION['admin'])){
	echo'
	<div class="form-pass">
		<form method="post">
			<p><label>Password :</label><br><input type="password" name="pass"></p>
			<p><input type="submit" name="login" value="Login"></p>
		</form>
	</div>
	';
}else{
	echo'
		<div class="form-admin">
			<form action="" method="post">
				<p><label>Username</label><br><input type="text" name="user" autocomplete="off" autofocus></p>
				<p><label>Password</label><br><input type="text" name="password"></p>
				<p><label>Gate</label><br><select name="gate">
						<option> </option>
						<option value="gatein"> Gate In </option>
						<option value="gateout"> Gate Out </option>
						<option value="inquerysales"> Inquery Sales </option>
						<option value="report"> Admin Report </option>
					</select></p>
				<p><input type="submit" name="reg" value="Register"> <input type="submit" name="logout" value="Logout" style="float:right"></p>
			</form>
		</div>
	';
}
echo'</section>';
register();		
}
function report(){
	?>
	<head>
		<script src="js/jquery-3.3.1.js"></script>
		<script>
			function SelectIslandOut(pulauout)
			{   $.ajax({
			        url: 'config/ware.php',
			        data : 'pulauout='+pulauout,
			        type: "post", 
			        dataType: "html",
			        timeout: 10000,
			        success: function(response){
			            $('#provselect').html(response);
			        }
			    });
			}
		</script>
	</head>
	<?php
	echo'
	<section class="gatein-project">
		<div class="form-gatein" style="width:60%;left:20%;min-height: 550px;">
			<div class="title-project"><h2> Product Code </h2></div>
			<div class="admin-project">
				<div class="admin-col-project"> Operator : '.$_SESSION['user'].' </div>
				<div class="logout-col-project"><a href="logout.php"> Keluar <img src="img/logout.png"> </a></div>
			</div>
			<div class="form-report">
				<form action="" method="post" enctype="multipart/form-data" style="width:100%">
					<div class="row-up"><p><label>Upload Database Master</label><br><input type="file" name="dbmaster"> <br>
					<input type="submit" name="upmain" value="Upload" class="download-tbn" style="margin-top:10px"></p></div>
					<div class="row-up download">
						<h3> Download Report</h3>
						<li>
							<p class="set-down">
								<label>Gate In</label><br>
								<div class="col-date"><label>Start :</label><input type="date" name="inStartDate"></div>
								<div class="col-date"><label>To</label><input type="date" name="inEndDate"></div>
								<input type="submit" name="inset" value="Download" class="download-tbn">
							</p>
						</li>
						<li>
							<p class="set-down"><label>Gate Out</label><br>
								<div class="row-out-report"><label>Pulau :</label>
								<select name="pulauout" onchange="SelectIslandOut(this.value);">
									<option value=""></option>
									<option value="SUMATERA">SUMATERA</option>
									<option value="JAWABALI">JAWA & BALI</option>
									<option value="KALIMANTAN">KALIMANTAN</option>
									<option value="SULAWESI">SULAWESI</option>
									<option value="NUSA TENGGARRA">NUSA TENGGARRA</option>
									<option value="MALUKUPAPUA">MALUKU & PAPUA</option>
								</select>
								<div class="row-out-report"><label>Provinsi :</label>
								<select name="provout" id="provselect" onchange="SelectProvOut(this.value);">
									<option value=""></option>
								</select></div>
								<div class="row-out-report"><label>Kota :</label><select name="kotaout" id="cityout"></select></div>
								<div class="col-date"><label>Start :</label><input type="date" name="outStartDate"></div> 
								<div class="col-date"><label>To</label>	<input type="date" name="outEndDate"></div>
								<input type="submit" name="outset" value="Download" class="download-tbn">
							</p>
						</li>
						<li>
							<p class="set-down"><label>Stock</label><br>';
						echo'	<div class="col-date"><label>Start :</label><input type="date" name="isStartDate"></div>
								<div class="col-date"><label>To</label>	<input type="date" name="isEndDate"></div>
								<input type="submit" name="isset" value="Download" class="download-tbn">
							</p>
						</li>
					</div>
				</form>
			</div>
		</div>
	</section>
	<div class="overflow"></div>
	';
	upload();
	downloadIN();
	downloadStock();
	downloadOut();
}
?>

















