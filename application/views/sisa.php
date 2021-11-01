<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sisa Antrian</title>
    <meta http-equiv="refresh" content="10">

	<style type="text/css">
	body {
		background-color: #323232;
		color:white;
	}
	.judul {
		height : 150px;
		border: 1px solid #323232;
		border-radius: 10px;
	}
	.right_col{
		width:100%;
	}
	.pusat{
		width:40%;
		border: 5px solid #03AC13;
		border-radius: 10px;float: left;
		margin: 15px;
	}
	.jabon{
		
		width:25%;
		border: 5px solid #03AC13;
		border-radius: 10px;float: left;
		margin: 15px;
	}
	.tile-stats {
		width : 200px;
		height : 210px;
		float: left;
		margin-left: 50px;
		margin-bottom: 50px;
		color:#03AC13;
		border: 5px solid #03AC13;
		border-radius: 10px;
	}
	
	</style>
</head>
<body class="nav-md">
<div class="judul">
<h1 style="font-size:45px;"><center>Antrian Muat Gudang</center></h1>
<h1 style="font-size:25px;"><center>PT. SIANTAR TOP, TBK</center></h1>
</div>
<div class="right_col" role="main">
	<div class="pusat">
		<h1 style="font-size:45px;"><center>PUSAT</center></h1>
		<div class="tile-stats">
			<h3><center>Sisa Antrian</center></h3>
			<h1 style="font-size:45px;"><center><?php echo $sisa[1]?></center></h1>
			<h3><center>Lokasi</br>Gudang Jadi Depan</center></h3>
		</div>
		<div class="tile-stats">
			<h3><center>Sisa Antrian</center></h3>
			<h1 style="font-size:45px;"><center><?php echo $sisa[2]?></center></h1>
			<h3><center>Lokasi</br>Gudang Jadi Central</center></h3>			
		</div>
		<div class="tile-stats">
			
			<h3><center>Sisa Antrian</center></h3>
			<h1 style="font-size:45px;"><center><?php echo $sisa[3]?></center></h1>
			<h3><center>Lokasi</br>Gudang Jadi Belakang</center></h3>
			
		</div>
	</div>
	<div class="jabon">
		<h1 style="font-size:45px;"><center>BISCUIT</center></h1>

		<div class="tile-stats">		
			<h3><center>Sisa Antrian</center></h3>
			<h1 style="font-size:45px;"><center><?php echo $sisa[4]?></center></h1>
			<h3><center>Lokasi</br>Gudang Jadi Biscuit</center></h3>
			
		</div>
	</div>
	<div class="jabon">
		<h1 style="font-size:45px;"><center>JABON</center></h1>
		<div class="tile-stats">
			
			<h3><center>Sisa Antrian</center></h3>
			<h1 style="font-size:45px;"><center><?php echo $sisa[5]?></center></h1>
			<h3><center>Lokasi</br>Gudang Jadi Jabon</center></h3>
			
		</div>
	</div>
		
</div>
			
</body>
</html>
