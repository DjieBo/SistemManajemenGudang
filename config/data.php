<?php
include 'connect.php';
$i = 0;
$t = mysql_query("select distinct so from inquirysales");
while($g = mysql_fetch_array($t)){
	$i++;
	$h = mysql_query("select * from gateout where so ='".$g['so']."'");
	if(mysql_num_rows($h) >= 1){
		$b = mysql_fetch_array($h);
		if(empty($b['status'])){
			echo'<li>
				<input type="hidden" name="outso[]" value="'.$g['so'].'">
				<div class="id-view">
					<div class="number">'.$i.'.</div> 
					<div class="id-view-test">
						<a href="?so='.$g['so'].'">'.$g['so'].'</a>
			';
			echo'
					<div class="img-symbol">
						<img src="img/message.png"></div>
					</div>
					';
			echo'	</div>
			<li>';
		}elseif($b['status'] == 'done'){
			if($b['act'] == ''){
				echo'<li>
					<input type="hidden" name="outso[]" value="'.$g['so'].'">
					<div class="id-view">
						<div class="number">'.$i.'.</div> 
						<div class="id-view-test">
							<a href="#">'.$g['so'].'</a>
				';
				echo'
						<div class="img-symbol">
							<img src="img/check.png"></div>
						</div>
						';
				echo'	</div>
				<li>';
			}elseif($b['act'] == 'd'){}
		}
	}elseif(mysql_num_rows($h) == 0){
		echo'<li>
				<input type="hidden" name="outso[]" value="'.$g['so'].'">
				<div class="id-view">
					<div class="number">'.$i.'.</div> 
					<div class="id-view-test">
						<a href="?so='.$g['so'].'">'.$g['so'].'</a>
			';
			echo'
					<div class="img-symbol">
						<img src="img/message.png"></div>
					</div>
					';
			echo'	</div>
			<li>';
	}
}
?>