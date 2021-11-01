<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="<?= base_url()?>dashboardAssets/bootstrap.min.css" rel="stylesheet">
	<style>
		.blink {
        -webkit-animation: blink .75s linear infinite;
        -moz-animation: blink .75s linear infinite;
        -ms-animation: blink .75s linear infinite;
        -o-animation: blink .75s linear infinite;
        animation: blink .75s linear infinite;
        color: #FF0000;
    }
    
	
    @-webkit-keyframes blink {
        0% { opacity: 1; }
        50% { opacity: 1; }
        50.01% { opacity: 0; }
        100% { opacity: 0; }
    }
    
    @-moz-keyframes blink {
        0% { opacity: 1; }
        50% { opacity: 1; }
        50.01% { opacity: 0; }
        100% { opacity: 0; }
    }
    
    @-ms-keyframes blink {
        0% { opacity: 1; }
        50% { opacity: 1; }
        50.01% { opacity: 0; }
        100% { opacity: 0; }
    }
    
    @-o-keyframes blink {
        0% { opacity: 1; }
        50% { opacity: 1; }
        50.01% { opacity: 0; }
        100% { opacity: 0; }
    }
    
    @keyframes blink {
        0% { opacity: 1; }
        50% { opacity: 1; }
        50.01% { opacity: 0; }
        100% { opacity: 0; }
    }
    
	
	
			.<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?>-<?= $this->session->userdata('info');  ?> p{
			  margin:auto;
			  padding:10px;
			  margin-top:-10px;
			  margin-left:-13px;
			  font-weight:bold;
			  text-align:left;
			  font-size:18px;
			}
			.<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?>-<?= $this->session->userdata('info');  ?>{
			  list-style-type: none;
			  padding:15px;
			  font-family:arial;
			  margin:auto;
			  text-align:center;
			  border:1px solid lightgrey;
			  border-radius:5px;
			  display:inline-block;
			  
			} 
			.<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?>-<?= $this->session->userdata('info');  ?> li{
			  margin-left:15px;
			  margin-right:20px;
			  display:inline-block;
			}

			.<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?>-<?= $this->session->userdata('info');  ?> li:before{
			  position:absolute;
			  margin-left:-20px;
			  width:15px;
			  height:15px;
			  background-color:#95f476;
			  content:"";
			  border-radius:10px;
			}
			.merah{
				color: red;
			}
			
			.orange{
				color:orange;
			}
			
			.hijau{
				color:#95f476;
			}
			
	
	
			.<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?>-<?= $this->session->userdata('info');  ?> .<?= $this->session->userdata('warning');  ?>:before{
			  background-color:orange;
			}
			.<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?>-<?= $this->session->userdata('info');  ?> .<?= $this->session->userdata('offline');  ?>:before{
			  background-color:red;
			}
			.<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('rack');  ?> a{
			  text-decoration:none;
			}
			.<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('rack');  ?>{
				  -webkit-box-sizing: border-box;
						  box-sizing: border-box;
				background-color: #141616;
				width: 225px;
				height: auto;
				border-radius: 10px 10px 0px 0px;
				margin-top: 50px;
				position: relative;
				margin-left:auto;
				margin-right:auto;
				margin-bottom:20px;
			  -webkit-box-shadow:0 31px 40px 0px rgba(0, 0, 0, 0.25);
					  box-shadow:0 31px 40px 0px rgba(0, 0, 0, 0.25);
			}
			
			
			
			 @media only screen and (max-width : 574px) {
					.<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('rack');  ?>{
				 		width: 295px;
					}
				}
			
			

			.<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('rack');  ?>:after{
				width: 100%;
				height: 37px;
				background-color: #6e6d71;
				position: absolute;
				content: "";
				bottom: -27px;
				border-radius: 0px 0px 20px 20px;
				z-index: -1;

			}
			.<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('rack');  ?> .<?= $this->session->userdata('label');  ?>{
				color: white;
				font-weight: bold;
				background-color: #575b5c;
				border-radius: 10px 10px 0 0;
				font-family: arial;
				text-align: center;
				padding: 12px !important;
				font-size: 13px;
			}

			.<?= $this->session->userdata('acak');  ?>-inner{
				border: 1px solid #9da1a6;
				background-color: #f4f4f4;
				border-radius: 5px 5px 0px 0px;
				height: auto;
				width: 90%;
				z-index: 99999;
				position: absolute;
				left: 50%;
				top: 50%;
				-webkit-transform: translate(-50%,-50%);
					-ms-transform: translate(-50%,-50%);
						transform: translate(-50%,-50%);
				overflow: hidden;
			  -webkit-box-shadow:inset 1px 1px 3px 0px #848181;
					  box-shadow:inset 1px 1px 3px 0px #848181;
			}


			.<?= $this->session->userdata('acak');  ?>{
			margin-top: 10px;
				position: relative;
				width: 103%;
				left: -4px;
				border-radius: 5px;
				margin-bottom: 10px;
				height: 45px;
				background-color: #3a3a3a;
				-webkit-transition: all 0.3s ease;
				-o-transition: all 0.3s ease;
				transition: all 0.3s ease;

			}

			.<?= $this->session->userdata('acak');  ?>:hover{
			  -webkit-transform:scale(1.1);
				  -ms-transform:scale(1.1);
					  transform:scale(1.1);
					  cursor: pointer;
			}
			.<?= $this->session->userdata('acak');  ?>:hover .hdd{
			   // background-color: #c5c5c5;
				-webkit-box-shadow: 1px 1px 2px 1px #3636366b;
						box-shadow: 1px 1px 2px 1px #3636366b;
						cursor: pointer;
			}
			.<?= $this->session->userdata('acak');  ?>:hover:before{
			  background-color:white;
			  cursor: pointer;
			}
			/*
			.<?= $this->session->userdata('acak');  ?>:after{
				content: '';
				position: absolute;
				top: 42%;
				left: 84%;
				width: 45px;
				height: 10px;
				transform: rotate(90deg);
				background-color: #8d8d8d;
				border-radius: 3px;
				box-shadow: -1px 2px 1px #0000005e;

			}*/
			.<?= $this->session->userdata('acak');  ?>:before{
				content: '';
				position: absolute;
				top: 44%;
				left: -5%;
				width: 40px;
				height: 6px;
				-webkit-transform: rotate(90deg);
					-ms-transform: rotate(90deg);
						transform: rotate(90deg);
				background-color: #d6d6d6;
				border-radius: 6px;
				-webkit-box-shadow: 0px -1px 1px #3a3a3a;
						box-shadow: 0px -1px 1px #3a3a3a;

			}
			
			
			.<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('info');  ?>{
			    text-align:center;
				color: white;
				font-family: arial;
				font-size:8pt;
				position: absolute;
				width:320px;
				left: 53%;
				top: 45%;
				-webkit-transform: translate(-50%,-50%);
					-ms-transform: translate(-50%,-50%);
						transform: translate(-50%,-50%);
			}
			
			

			.<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?>{
			  list-style-type:none;
			  padding:0;
			  margin-left:10px;
				  -webkit-transform: rotate(90deg);
					  -ms-transform: rotate(90deg);
						  transform: rotate(90deg);
				position: absolute;
			  top: 10px;
			  z-index:999;
			}
			.<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?> li{
				width: 6px;
			  height: 6px;
			  float: left;
			  margin-left: 5px;
			  margin-top: 10px;
			  background: rgba(149,244,118,0.6);
				-webkit-animation: pattern1 0.14s linear infinite;

			}
			.<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?> li:nth-child(2){
			  -webkit-animation: pattern1 0.14s 0.02s linear infinite;
			}

			.<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?> li:last-child{
			  -webkit-animation: pattern1 0.14s 0.05s linear infinite;
			}
			@-webkit-keyframes pattern1{
			  0%{
				background: rgba(149,244,118,0.6);
			  }
			  100%{
				background: rgba(149,244,118,1);
			  }
			}

			.<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('warning');  ?> li{
			  background-color:orange;
			}
			.<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('warning');  ?> li:first-child{
			  -webkit-animation: pattern2 0.14s linear infinite;
			  
			animation: pattern2 0.14s linear infinite;			  		 
			}

			.<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('warning');  ?> li:nth-child(2){
			 -webkit-animation: pattern2 0.14s 0.02s linear infinite;
			animation: pattern2 0.14s 0.02s linear infinite;
			}

			.<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('warning');  ?> li:last-child{
			  -webkit-animation: pattern2 0.14s 0.05s linear infinite;
			animation: pattern2 0.14s 0.05s linear infinite;
			}
			@-webkit-keyframes pattern2{
			  0%{
				background: rgba(245,190,0,0.6);
			  }
			  100%{
				background: rgba(245,190,0,1);
			  }
			}
			.<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('offline');  ?> li{
			  background-color:red;
			}


			.<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('offline');  ?>  li:first-child{
			  -webkit-animation: pattern3 0.9s linear infinite;
			  animation: pattern3 0.14s 0.03s linear infinite;
			}

			.<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('offline');  ?> li:nth-child(2){
			  -webkit-animation: pattern3 0.8s linear infinite;
			  animation: pattern3 0.14s 0.02s linear infinite;
			}

			.<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('offline');  ?> li:last-child{
			  -webkit-animation: pattern3 0.7s linear infinite;
			  animation: pattern3 0.14s 0.01s linear infinite;
			}

			@-webkit-keyframes pattern3{
			  0%{
				background: rgba(236,69,62,0);
			  }
			  80%{
				background: rgba(236,69,62,0.5);
			  }
			  100%{
				background: rgba(236,69,62,1);
			  }
			}

	#atas{
		position:relative;
	}
	
	#keterangan{
		position:fixed;
		top:-30px;
		z-index:9999;
		padding-left:20px;
		
	}
	</style>
	
<title>Dashboard Do dan No DO</title>
		<meta name="title" content="Dashboard Do dan No DO">
		<meta name="description" content="untuk melihat data DO dan NO di setiap area apakah sudah ada DO atau belum, di rangkum berdasarkan gudang yang ada di area tsb.">
  </head>
  <body>
  
<div class="container">

	<!-- Area KOPI -->
	<div class="row justify-content-center" >
	<div class="alert alert-primary mt-4 mb-4" role="alert">
	  Konten diperbaharui dalam <span id="detik"></span> detik 	 
	</div>
		<div class="col-md-12 mt-5">
		<h3 class="text-center">AREA KOPI (<?= count($kopiNoDO) + count($kopiDO) + count($kopiStapel) ?>/<span>&#8734;</span>)</h3>
	</div>
		<div class="col-md-6 col-sm-12" >
			<div class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('rack');  ?>" >			
					<p class="<?= $this->session->userdata('label');  ?>">Belum dapat Nomer DO 
					(<?= count($kopiNoDO)+ count($kopiStapel)?>)
					</P>
					<div id="<?= $this->session->userdata('tes');  ?>"></div>
			
				
				<?php if(count($kopiNoDO) > 0 || count($kopiStapel)>0 ):?>
					<?php 
					foreach($kopiNoDO as $knd):?>
					
					<div class="<?= $this->session->userdata('acak');  ?>">
					  <ul class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?> <?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('offline');  ?>">
						<li></li>
						<li></li>
						<li></li>
					  </ul>
					  <p class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('info');  ?>" id="<?= $this->session->userdata('call');  ?>">
					  <?= $knd['nopol'].'-'.$knd['jenis_kendaraan'] ?>
					  
					  </p>
					</div>
				  
				  <?php endforeach;?>
				  <?php 
					foreach($kopiStapel as $knd):?>
					
					<div class="<?= $this->session->userdata('acak');  ?>">
					  <ul class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?>">
						<li></li>
						<li></li>
						<li></li>
					  </ul>
					  <p class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('info');  ?>" id="<?= $this->session->userdata('call');  ?>">
					  <?= $knd['nopol'].'-'.$knd['jenis_kendaraan'].'-'.$knd['NoDo'] ?>
					  
					  </p>
					</div>
				  
				  <?php endforeach;?>
				  <?php else : ?>
				 
					<div class="<?= $this->session->userdata('acak');  ?>">
					  <ul class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?> <?= $this->session->userdata('acak');  ?>-waning">
						<li></li>
						<li></li>
						<li></li>
					  </ul>
					  <p class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('info');  ?>" id="<?= $this->session->userdata('call');  ?>">
					  Kosong
					  </p>
					</div>
				  
					
				<?php endif; ?>
			</div>
		</div>
		
		<div class="col-md-6 col-sm-12">
			<div class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('rack');  ?>" >			
					<p class="<?= $this->session->userdata('label');  ?>">KOPI Sudah Ada DO (<?= count($kopiDO)?>)</P>
					<div id="<?= $this->session->userdata('tes');  ?>"></div>
			
			<?php if(count($kopiDO) > 0):?>			
				<?php foreach($kopiDO as $knd):?>
				
				<div href="#" class="<?= $this->session->userdata('info').$this->session->userdata('kopido');?>" data-do="<?= $knd['NoDo'] ?>" data-toggle="modal" data-target="#<?= $this->session->userdata('info');  ?><?= $this->session->userdata('kopido'); ?>">
				<div class="<?= $this->session->userdata('acak');  ?>">
				
				<?php if($knd['next_gd'] == 0):?>
				<ul class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?> <?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('warning');  ?>">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				<?php else: ?>
				<ul class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?>">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				<?php endif; ?>
				  
				  <p class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('info');  ?>" id="<?= $this->session->userdata('call');  ?>">
				  <?= 
						$knd['NoPol'].'-'.$knd['jenis_kendaraan'].'-'.$knd['NoDo']
				  ?>
					<br>
					<?= jam2($knd['tgl_do2'].' '.$knd['jam_do2']); ?>
				  </p>
				</div>
			  </div>
				<?php endforeach;?>
				<?php else : ?>
				 
					<div class="<?= $this->session->userdata('acak');  ?>">
					  <ul class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?> <?= $this->session->userdata('acak');  ?>-waning">
						<li></li>
						<li></li>
						<li></li>
					  </ul>
					  <p class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('info');  ?>" id="<?= $this->session->userdata('call');  ?>">
					  Kosong
					  
					  </p>
					</div>
				  
					
				<?php endif; ?>
			</div>
		</div>
	
	</div>
<br><br>
<hr>

<!-- Area PUSAT -->
<div class="row" >
	<div class="col-md-12">
		<h3 
			<?php if((count($nullPusat)+count($gjd)+count($gjc)+count($gjcc)+count($gjh3)) >= $max_pusat):?>
			class="text-center blink"
			<?php else:?>
			class="text-center" 
			<?php endif;?>
		>AREA PUSAT 
			(<?= 
			count($nullPusat)+
			count($gjd)+
			count($gjc)+
			count($gjcc)+
			count($gjh3)
			?>/<?= $max_pusat ?>)
			
		</h3>
	</div>
	<div class="col-md-4" >
			<div class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('rack');  ?>" >			
					<p class="<?= $this->session->userdata('label');  ?>">Belum Register di Gudang (<?= count($nullPusat)?>)</P>
					
			
				<?php if(count($nullPusat) > 0):?>				
				<?php foreach($nullPusat as $knd):?>
				
				<div class="<?= $this->session->userdata('acak');  ?>">
				  <ul class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?> <?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('offline');  ?>">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				  <p class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('info');  ?>" id="<?= $this->session->userdata('call');  ?>">
				  <?= $knd['nopol'].'-'.$knd['jk'] ?>
					<?php if($knd['durasiSelesaiMuat'] == null):?>
						 <?= '('.jam2($knd['jam_satpam']).')'; ?>
					<?php else:?>
						<?= '('.jam2($knd['durasiSelesaiMuat']).')'; ?>
					<?php endif ?>
				  </p>
				</div>
			  
				<?php endforeach;?>
				<?php else : ?>
				
					<div class="<?= $this->session->userdata('acak');  ?>">
					  <ul class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?> <?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('offline');  ?>">
						<li></li>
						<li></li>
						<li></li>
					  </ul>
					  <p class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('info');  ?>" id="<?= $this->session->userdata('call');  ?>">
					  Kosong					  
					  </p>
					</div>
				  
					
				<?php endif; ?>
			</div>
		</div>
				
	<div class="col-md-4">
		<div class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('rack');  ?>" >			
				<p class="<?= $this->session->userdata('label');  ?>">Gudang J. Central <?= '('.$gjcf2.'/'.$jum['GJST'].')'?></P>
				<div id="<?= $this->session->userdata('tes');  ?>"></div>
			
		<?php if(count($gjc) > 0):?>					
			<?php foreach($gjc as $knd):?>
			
			<div class="<?= $this->session->userdata('info');  ?>" data-nodo="<?= $knd['do_'] ?>" data-nopol="<?= $knd['nopol'] ?>" data-flag="<?= $knd['flag'] ?>">
			<div class="<?= $this->session->userdata('acak');  ?>">
				<?php 
				//Belum Register di Gudang dan belum ada flag / posisi 
			 if($knd['do_'] == null && $knd['flag'] == null):?>
			  <ul class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?> <?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('offline');  ?>">
				<li></li>
				<li></li>
				<li></li>
			  </ul>
				<?php elseif($knd['do_'] != null && $knd['flag'] == 1): ?>
			  <ul class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?> <?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('warning');  ?>">
				<li></li>
				<li></li>
				<li></li>
			  </ul>
			  <?php elseif($knd['do_'] != null && $knd['flag'] == 2): ?>
			  <ul class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?> <?= $this->session->userdata('acak');  ?>-muat">
				<li></li>
				<li></li>
				<li></li>
			</ul>
			 
			<?php endif ?>
			  <p class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('info');  ?>" id="<?= $this->session->userdata('call');  ?>">
			  <?= $knd['nopol'].'-'.$knd['jk'].'-'.$knd['do_'] ?>
			  
			  </p>
			</div>
		  </div>
			<?php endforeach;?>
			<?php else : ?>
			  
				<div class="<?= $this->session->userdata('acak');  ?>">
				  <ul class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?> <?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('offline');  ?>">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				  <p class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('info');  ?>" id="<?= $this->session->userdata('call');  ?>">
				  Kosong
				</p>
				</div>					
			<?php endif; ?>
		</div>
	</div>
		
		<div class="col-md-4">
			<div class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('rack');  ?>" >			
					<p class="<?= $this->session->userdata('label');  ?>">GJCC <?= '('.$gjccf2.'/'.$jum['GJCC'].')' ?></P>
					<div id="<?= $this->session->userdata('tes');  ?>"></div>
			
			<?php if(count($gjcc) > 0):?>				
				<?php foreach($gjcc as $knd):?>
				<div class="<?= $this->session->userdata('info');  ?>" data-nodo="<?= $knd['do_'] ?>" data-nopol="<?= $knd['nopol'] ?>" data-flag="<?= $knd['flag'] ?>">
				<div class="<?= $this->session->userdata('acak');  ?>">
				<?php if($knd['do_'] == null && $knd['flag'] == null):?>
				  <ul class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?> <?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('offline');  ?>">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
					<?php elseif($knd['do_'] != null && $knd['flag'] == 1): ?>
				  <ul class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?> <?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('warning');  ?>">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				  <?php elseif($knd['do_'] != null && $knd['flag'] == 2): ?>
				  <ul class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?> <?= $this->session->userdata('acak');  ?>-muat">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				 <?php elseif($knd['do_'] != null && $knd['flag'] == 3): ?>
				  <ul class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?>">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				<?php endif ?>
				  <p class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('info');  ?>" id="<?= $this->session->userdata('call');  ?>">
				  <?= $knd['nopol'].'-'.$knd['jk'].'-'.$knd['do_'] ?>
				  
				  </p>
				</div>
			  </div>
				<?php endforeach;?>
				<?php else : ?>
				
					<div class="<?= $this->session->userdata('acak');  ?>">
					  <ul class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?> <?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('offline');  ?>">
						<li></li>
						<li></li>
						<li></li>
					  </ul>
					  <p class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('info');  ?>" id="<?= $this->session->userdata('call');  ?>">
					  Kosong
					  
					  </p>
					</div>
				
					
				<?php endif; ?>
			</div>
		</div>
		
		<div class="col-md-4">
			<div class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('rack');  ?>" >			
					<p class="<?= $this->session->userdata('label');  ?>">Hall 3 <?= '('.$gjh3f2.'/'.$jum['GJH3'].')' ?></P>
					<div id="<?= $this->session->userdata('tes');  ?>"></div>
				
			<?php if(count($gjh3) > 0):?>				
				<?php foreach($gjh3 as $knd):?>
				<div class="<?= $this->session->userdata('info');  ?>" data-nodo="<?= $knd['do_'] ?>" data-nopol="<?= $knd['nopol'] ?>" data-flag="<?= $knd['flag'] ?>">
				<div class="<?= $this->session->userdata('acak');  ?>">
				 <?php if($knd['do_'] == null && $knd['flag'] == null):?>
				  <ul class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?> <?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('offline');  ?>">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
					<?php elseif($knd['do_'] != null && $knd['flag'] == 1): ?>
				  <ul class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?> <?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('warning');  ?>">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				  <?php elseif($knd['do_'] != null && $knd['flag'] == 2): ?>
				  <ul class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?> <?= $this->session->userdata('acak');  ?>-muat">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				 <?php elseif($knd['do_'] != null && $knd['flag'] == 3): ?>
				  <ul class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?>">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				<?php endif ?>
				  <p class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('info');  ?>" id="<?= $this->session->userdata('call');  ?>">
				  <?= $knd['nopol'].'-'.$knd['jk'].'-'.$knd['do_'] ?>
				  
				  </p>
				</div>
			  </div>
				<?php endforeach;?>
				<?php else : ?>
					<div class="<?= $this->session->userdata('acak');  ?>">
					  <ul class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?> <?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('offline');  ?>">
						<li></li>
						<li></li>
						<li></li>
					  </ul>
					  <p class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('info');  ?>" id="<?= $this->session->userdata('call');  ?>">
					  Kosong					  
					  </p>
					</div>		
				<?php endif; ?>
			</div>
		</div>
		
		<div class="col-md-4">
			<div class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('rack');  ?>" >			
					<p class="<?= $this->session->userdata('label');  ?>">Gudang J. Depan <?= '('.$gjdf2.'/'.$jum['GJDP'].')'?></P>
					<div id="<?= $this->session->userdata('tes');  ?>"></div>
			
			<?php if(count($gjd) > 0):?>				
				<?php foreach($gjd as $knd):?>
				
				<div href="#" class="<?= $this->session->userdata('info');  ?>" data-nodo="<?= $knd['do_'] ?>" data-nopol="<?= $knd['nopol'] ?>" data-flag="<?= $knd['flag'] ?>">
				<div class="<?= $this->session->userdata('acak');  ?>">
				 <?php if($knd['do_'] == null && $knd['flag'] == null):?>
				  <ul class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?> <?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('offline');  ?>">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
					<?php elseif($knd['do_'] != null && $knd['flag'] == 1): ?>
				  <ul class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?> <?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('warning');  ?>">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				  <?php elseif($knd['do_'] != null && $knd['flag'] == 2): ?>
				  <ul class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?> <?= $this->session->userdata('acak');  ?>-muat">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				 <?php elseif($knd['do_'] != null && $knd['flag'] == 3): ?>
				  <ul class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?>">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				<?php endif ?>
				  <p class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('info');  ?>" id="<?= $this->session->userdata('call');  ?>">
				  <?= $knd['nopol'].'-'.$knd['jk'].'-'.$knd['do_'] ?>
				  
				  </p>
				</div>
			  </div>
				<?php endforeach;?>
				<?php else : ?>			  
					<div class="<?= $this->session->userdata('acak');  ?>">
					  <ul class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?> <?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('offline');  ?>">
						<li></li>
						<li></li>
						<li></li>
					  </ul>
					  <p class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('info');  ?>" id="<?= $this->session->userdata('call');  ?>">
					  Kosong					  
					  </p>
					</div>
				<?php endif; ?>
			</div>
		</div>
	
	</div>	
<br><br>
<hr>
<!-- Area BISKUIT CENTER -->
	<div class="row mt-5" >
	<div class="col-md-12">
		<h3 
			<?php if(count($GJBC)+count($GJBCnull) >= $max_biskuit):?>
			class="text-center blink"
			<?php else:?>
			class="text-center" 
			<?php endif;?>
		>AREA BISKUIT PUSAT 
			(<?= 
			count($GJBC)+
			count($GJBCnull)			
			?>/<?= $max_biskuit ?>)
		</h3>
		
		
	</div>
		<div class="col-md-6" >
			<div class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('rack');  ?>">			
					<p class="<?= $this->session->userdata('label');  ?>">Belum Register di Gudang(<?= 
				count($GJBCnull)			
			?>)</P>
					<div id="<?= $this->session->userdata('tes');  ?>"></div>
					
				<?php if(count($GJBCnull) > 0):?>				
				<?php foreach($GJBCnull as $knd):?>
				
				<div class="<?= $this->session->userdata('acak');  ?>">
				  <ul class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?> <?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('offline');  ?>">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				  <p class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('info');  ?>" id="<?= $this->session->userdata('call');  ?>">
				  <?= $knd['nopol'].'-'.$knd['jk'] ?>
				<?php if($knd['durasiSelesaiMuat'] == null):?>
						 <?= '('.jam2($knd['jam_satpam']).')'; ?>
					<?php else:?>
						<?= '('.jam2($knd['durasiSelesaiMuat']).')'; ?>
					<?php endif ?>
				  </p>
				</div>
			  
				<?php endforeach;?>
				<?php else : ?>
				
				<div class="<?= $this->session->userdata('acak');  ?>">
				  <ul class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?> <?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('offline');  ?>">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				  <p class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('info');  ?>" id="<?= $this->session->userdata('call');  ?>">Kosong</p>
				</div>
			  
					
				<?php endif; ?>
			</div>
		</div>
		
		<div class="col-md-6">
			<div class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('rack');  ?>" >			
					<p class="<?= $this->session->userdata('label');  ?>">GJBC <?= '('.$GJBCf2.'/'.$jum['GJBC'].')'?></P>
					<div id="<?= $this->session->userdata('tes');  ?>"></div>
				
			<?php if(count($GJBC) > 0):?>				
				<?php foreach($GJBC as $knd):?>
				<div class="<?= $this->session->userdata('info');  ?>" data-nodo="<?= $knd['do_'] ?>" data-nopol="<?= $knd['nopol'] ?>" data-flag="<?= $knd['flag'] ?>">
				<div class="<?= $this->session->userdata('acak');  ?>">
				<?php if($knd['do_'] == null && $knd['flag'] == null):?>
				  <ul class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?> <?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('offline');  ?>">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
					<?php elseif($knd['do_'] != null && $knd['flag'] == 1): ?>
				  <ul class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?> <?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('warning');  ?>">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				  <?php elseif($knd['do_'] != null && $knd['flag'] == 2): ?>
				  <ul class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?> <?= $this->session->userdata('acak');  ?>-muat">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				 <?php elseif($knd['do_'] != null && $knd['flag'] == 3): ?>
				  <ul class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?>">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				<?php endif ?>
				  <p class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('info');  ?>" id="<?= $this->session->userdata('call');  ?>">
				  <?= $knd['nopol'].'-'.$knd['jk'].'-'.$knd['do_'] ?>
				  
				  </p>
				</div>
			  </div>
				<?php endforeach;?>
				<?php else : ?>
				  
					<div class="<?= $this->session->userdata('acak');  ?>">
					  <ul class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?> <?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('offline');  ?>">
						<li></li>
						<li></li>
						<li></li>
					  </ul>
					  <p class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('info');  ?>" id="<?= $this->session->userdata('call');  ?>">
					  Kosong					  
					  </p>
					</div>
				  
					
				<?php endif; ?>
			</div>
		</div>
	
	</div>
	
<br><br>
<hr>
<!-- Area BISKUIT JABON -->
	<div class="row mt-5 mb-5" >
	<div class="col-md-12">
		<h3 
			<?php if(count($GJJBN)+count($nullGJJBN) >= $max_jabon):?>
			class="text-center blink"
			<?php else:?>
			class="text-center" 
			<?php endif;?>
		>AREA JABON 
			(<?= 
			count($GJJBN)+
			count($nullGJJBN)			
			?>/<?= $max_jabon ?>)
		</h3>
	</div>
		<div class="col-md-6" >
			<div class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('rack');  ?>" >			
					<p class="<?= $this->session->userdata('label');  ?>">Belum Register di Gudang (<?= 
				count($nullGJJBN)			
			?>)</P>
					<div id="<?= $this->session->userdata('tes');  ?>"></div>
					
				<?php if(count($nullGJJBN) > 0):?>				
				<?php foreach($nullGJJBN as $knd):?>
				
				<div class="<?= $this->session->userdata('acak');  ?>">
				  <ul class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?> <?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('offline');  ?>">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				  <p class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('info');  ?>" id="<?= $this->session->userdata('call');  ?>">
				  <?= $knd['nopol'].'-'.$knd['jk'] ?>
						<?php if($knd['durasiSelesaiMuat'] == null):?>
						 <?= '('.jam2($knd['jam_satpam']).')'; ?>
					<?php else:?>
						<?= '('.jam2($knd['durasiSelesaiMuat']).')'; ?>
					<?php endif ?>
				  </p>
				</div>
			  
				<?php endforeach;?>
				<?php else : ?>
				
				<div class="<?= $this->session->userdata('acak');  ?>">
				  <ul class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?> <?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('offline');  ?>">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				  <p class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('info');  ?>" id="<?= $this->session->userdata('call');  ?>">Kosong</p>
				</div>	
				<?php endif; ?>
			</div>
		</div>
		
		
		<div class="col-md-6">
			<div class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('rack');  ?>" >			
					<p class="<?= $this->session->userdata('label');  ?>">Gudang Jabon <?= '('.$GJJBNf2.'/'.$jum['GJJBN'].')'?></P>
					<div id="<?= $this->session->userdata('tes');  ?>"></div>
			
			<?php if(count($GJJBN) > 0):?>						
				<?php foreach($GJJBN as $knd):?>
				<div  class="<?= $this->session->userdata('info');  ?>" data-nodo="<?= $knd['do_'] ?>" data-nopol="<?= $knd['nopol'] ?>" data-flag="<?= $knd['flag'] ?>">
				<div class="<?= $this->session->userdata('acak');  ?>">
				  <?php if($knd['do_'] == null && $knd['flag'] == null):?>
				  <ul class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?> <?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('offline');  ?>">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
					<?php elseif($knd['do_'] != null && $knd['flag'] == 1): ?>
				  <ul class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?> <?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('warning');  ?>">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				  <?php elseif($knd['do_'] != null && $knd['flag'] == 2): ?>
				  <ul class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?> <?= $this->session->userdata('acak');  ?>-muat">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				 <?php elseif($knd['do_'] != null && $knd['flag'] == 3): ?>
				  <ul class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?>">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				<?php endif ?>
				  <p class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('info');  ?>" id="<?= $this->session->userdata('call');  ?>">
				  <?= $knd['nopol'].'-'.$knd['jk'].'-'.$knd['do_'] ?>
				  
				  </p>
				</div>
			  </div>
				<?php endforeach;?>
				<?php else : ?>
				  
					<div class="<?= $this->session->userdata('acak');  ?>">
					  <ul class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('status');  ?> <?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('offline');  ?>">
						<li></li>
						<li></li>
						<li></li>
					  </ul>
					  <p class="<?= $this->session->userdata('acak');  ?>-<?= $this->session->userdata('info');  ?>" id="<?= $this->session->userdata('call');  ?>">
					  Kosong
					  
					  </p>
					</div>
				 
					
				<?php endif; ?>
			</div>
		</div>
	
	</div>
	

</div>

<div class="modal fade bd-example-modal-lg" id="<?= $this->session->userdata('info');  ?><?= $this->session->userdata('kopido'); ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
	<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Info <span id="do"></span></h5>
        
      </div>
      <div class="modal-body">
      </div>	  
    </div>
	
  </div>
</div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
	<script src="<?= base_url()?>dashboardAssets/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url()?>dashboardAssets/jquery-3.6.0.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script>
$('.dropdown-toggle').dropdown()
</script>
		<script>
			
		//keluarKopiDo
		$('.<?= $this->session->userdata('keluar')?><?= $this->session->userdata('kopido')?>').on('click', function (){
			 $('#<?= $this->session->userdata('info')?><?= $this->session->userdata('kopido')?>').modal('hide');
		})
		
		//infokopido
		$('.<?= $this->session->userdata('info')?><?= $this->session->userdata('kopido')?>').on('click', function (){
			var nodo = $(this).attr("data-do");
			 var htmlvalue;
				$.ajax({
					type : "POST",
					url  : "<?= site_url('AntriHash/infoDO')?>",
					dataType : "text",
					data : {nodo:nodo,token:"<?= sha1($this->session->userdata('kopido'))?>"},
					 success: function(response){
						 	console.log(response);
						  $('.modal-body').html(response);
						  $('#do').html(nodo)	;	
						  // Display Modal
						  $('#<?= $this->session->userdata('info')?><?= $this->session->userdata('kopido')?>').modal('show'); 
					 },
					 error: function (err) {
					console.log("AJAX error in request: " + JSON.stringify(err, null, 2));
				}
				})
		})
		
		//informasi
		$('.<?= $this->session->userdata('info')?>').on('click', function (){
			var nopol = $(this).attr("data-nopol"); 
			var flag  = $(this).attr("data-flag");
			var nodo 	= $(this).attr("data-nodo");
					
				$.ajax({
					type : "POST",
					url  : "<?= site_url('AntriHash/infoNopol')?>",
					dataType : "text",
					data : {nopol:nopol,flag:flag,nodo:nodo,token:"<?= sha1($this->session->userdata('informasi'))?>"},
					 success: function(response){
						
						$('.modal-body').empty();
						$('.modal-body').html(response);
						console.log(response);
						$('#do').html("Nopol: "+nopol);	;	
						  // Display Modal
						  $('#<?= $this->session->userdata('info')?><?= $this->session->userdata('kopido')?>').modal('show'); 
					 },
					 error: function (err) {
					console.log("AJAX error in request: " + JSON.stringify(err, null, 2));
				}
				})
		})
	
		var menit = 3;				
		var detik = 60 + 1;
		var interval = 1000 * detik * menit; // microsecond * second * minutes * hours
		count = detik * menit;
				function countDown() {
                if (count > 0) {
                    count--;
                    $('#detik').html(count);
                } else{
					count = detik * menit;
					window.location.href = "<?= base_url()?>Antrihash";
				}
				setTimeout("countDown()", 1000);
				
            }
            countDown();
	</script>
	</body>
</html>

