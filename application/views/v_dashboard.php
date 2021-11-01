<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="<?= base_url()?>dashboardAssets/bootstrap.min.css" rel="stylesheet">
	
    <title>Dashboard alpha 3.0</title>
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
    
	
	
			.server-status-info p{
			  margin:auto;
			  padding:10px;
			  margin-top:-10px;
			  margin-left:-13px;
			  font-weight:bold;
			  text-align:left;
			  font-size:18px;
			}
			.server-status-info{
			  list-style-type: none;
			  padding:15px;
			  font-family:arial;
			  margin:auto;
			  text-align:center;
			  border:1px solid lightgrey;
			  border-radius:5px;
			  display:inline-block;
			  
			} 
			.server-status-info li{
			  margin-left:15px;
			  margin-right:20px;
			  display:inline-block;
			}

			.server-status-info li:before{
			  position:absolute;
			  margin-left:-20px;
			  width:15px;
			  height:15px;
			  background-color:#95f476;
			  content:"";
			  border-radius:10px;
			}
			.server-status-info .warning:before{
			  background-color:orange;
			}
			.server-status-info .offline:before{
			  background-color:red;
			}
			.server-rack a{
			  text-decoration:none;
			}
			.server-rack{
				  -webkit-box-sizing: border-box;
						  box-sizing: border-box;
				background-color: #141616;
				width: 215px;
				height: auto;
				border-radius: 10px 10px 0px 0px;
				margin-top: 20px;
				position: relative;
			  -webkit-box-shadow:0 31px 40px 0px rgba(0, 0, 0, 0.25);
					  box-shadow:0 31px 40px 0px rgba(0, 0, 0, 0.25);
			}
			.server-rack:after{
				width: 100%;
				height: 37px;
				background-color: #6e6d71;
				position: absolute;
				content: "";
				bottom: -27px;
				border-radius: 0px 0px 20px 20px;
				z-index: -1;

			}
			.server-rack .label{
				color: white;
				font-weight: bold;
				background-color: #575b5c;
				border-radius: 10px 10px 0 0;
				font-family: arial;
				text-align: center;
				padding: 12px !important;
				font-size: 13px;
			}

			.server-inner{
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


			.server{
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

			.server:hover{
			  -webkit-transform:scale(1.1);
				  -ms-transform:scale(1.1);
					  transform:scale(1.1);
					  
			}
			.server:hover .hdd{
			   // background-color: #c5c5c5;
				-webkit-box-shadow: 1px 1px 2px 1px #3636366b;
						box-shadow: 1px 1px 2px 1px #3636366b;
			}
			.server:hover:before{
			  background-color:white;
			}
			/*
			.server:after{
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
			.server:before{
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
			
			
			.server-info{
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
			
			

			.server-status{
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
			.server-status li{
				width: 6px;
			  height: 6px;
			  float: left;
			  margin-left: 5px;
			  margin-top: 10px;
			  background: rgba(149,244,118,0.6);
				-webkit-animation: pattern1 0.14s linear infinite;

			}
			.server-status li:nth-child(2){
			  -webkit-animation: pattern1 0.14s 0.02s linear infinite;
			}

			.server-status li:last-child{
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

			.server-warning li{
			  background-color:orange;
			}
			.server-warning li:first-child{
			  -webkit-animation: pattern2 0.14s linear infinite;
			  
			animation: pattern2 0.14s linear infinite;			  		 
			}

			.server-warning li:nth-child(2){
			  			  -webkit-animation: pattern2 0.14s 0.02s linear infinite;
			animation: pattern2 0.14s 0.02s linear infinite;
			}

			.server-warning li:last-child{
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
			.server-offline li{
			  background-color:red;
			}


			.server-offline  li:first-child{
			  -webkit-animation: pattern3 0.9s linear infinite;
			}

			.server-offline li:nth-child(2){
			  -webkit-animation: pattern3 0.9s linear infinite;
			}

			.server-offline li:last-child{
			  -webkit-animation: pattern3 0.9s linear infinite;
			}

			@-webkit-keyframes pattern3{
			  0%{
				background: rgba(236,69,62,0.6);
			  }
			  80%{
				background: rgba(236,69,62,0.6);
			  }
			  100%{
				background: rgba(236,69,62,1);
			  }
			}


		
	</style>
  </head>
  <body>
 
<div class="container" >

	<div class="row" >
	<div class="alert alert-primary mt-4" role="alert">
	  Konten diperbaharui dalam <span id="detik"></span> detik
	</div>
	<!-- rumah -->
		<?php 
			$CI =& get_instance();
			$CI->load->model('Dashboard_model');

		foreach($rumah as $kr=>$r):
		$gnd = $CI->Dashboard_model->getGudangAndDock($r->id);
		?>
		<?php if($kr == 0):?>
			<div class="col-md-3" >
			<div class="server-rack" >			
					<p class="label" id="labelKopi"> <?=  $r->area?></P>
					<diV id="tes"></div>
		</div>
		</div>
		<?php else: ?>
			<div class="col-md-3" >
			<div class="server-rack" >			
			<?php foreach($gnd as $key=>$g):?>
				
				<?php if($kr != 0 && $key == 0):?>
					<p class="label" id="label<?= $r->id.$g->idGudang.$g->idDok ?>"> <?=  $r->area?></P>
				<?php endif;?>

			  	<?php if($r->id != 1):?>
				<a href="#" class="informasi" data-rumah="<?= $r->id?>" data-gudang="<?= $g->idGudang?>" data-dok="<?= $g->idDok?>">
				<div class="server">
				  <ul class="" id="cl<?= $r->id.$g->idGudang.$g->idDok ?>">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				  <p class="server-info" id="call<?= $r->id.$g->idGudang.$g->idDok ?>" data-rumah="<?= $r->id?>" data-gudang="<?= $g->idGudang?>" data-dok="<?= $g->idDok?>"><?= $g->gudang.'-'.$g->dok?>
				  <span></span>
				  </p>
				</div>
			  </a>
				<?php endif?>
		
			<?php endforeach;?>
		</div>
		</div>
			<?php endif?>
		<?php endforeach;?>
	<!-- Rumah end -->
	</div>		

</div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
	<script src="<?= base_url()?>dashboardAssets/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url()?>dashboardAssets/jquery-3.6.0.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script>
		$('.informasi').on('click',function(e) {
			
			e.preventDefault();
				var rumah	= $(this).attr("data-rumah");
				var gudang	= $(this).attr("data-gudang");
				var dok		= $(this).attr("data-dok");
				
				
				
				$.ajax({
					type : "POST",
					url  : "<?= site_url('Dashboard/klik')?>",
					dataType : "text",
					data : {rumah:rumah,gudang:gudang,dok:dok},
					 success: function(data){
						var panjang =Object.keys(data).length;
						if(panjang > 0){
							data = JSON.parse(data)[0]
							console.log(data)
							Swal.fire({
							  title: 'Informasi',
							  icon: 'info',
							  html: '<Table width="100%">'+
										'<tr><td>Jenis Kendaraan</td><td>:</td><td>'+data.JenisKendaraan+'</td></tr>' +
										'<tr><td>Nopol</td><td>:</td><td>'+data.NoPol+'</td></tr>' +
										'<tr><td>Jam Muat</td><td>:</td><td>'+data.jam_muat.substring(20,10)+'</td></tr>' +
									'<Table>',
							  confirmButtonText: 'Keluar'
							})
						}else{
							Swal.fire({
							  title: 'Informasi',
							  icon: 'info',
							  html: 'Tidak ada kendaraan di bagian ini',
							  confirmButtonText: 'Keluar'
							})
						}
					 },
					 error: function (err) {
					console.log("AJAX error in request: " + JSON.stringify(err, null, 2));
				}
				})
		})
	
		var menit = 1;				
		var detik = 60 + 1;
		var interval = 1000 * detik * menit; // microsecond * second * minutes * hours
		<?php
		foreach($rumah as $kr=>$r):
		$gnd = $CI->Dashboard_model->getGudangAndDock($r->id);?>
			//4 kopi
				<?php if($kr == 0): ?>
				//kopi kopi
				$('#tes').empty();
			function kopiData(){
				$.ajax({
					type : "POST",
					url  : "<?= site_url('Dashboard/cekKopi')?>",
					dataType : "text",
					data : {rumah:1},
					 success: function(data){
						// console.log("kopi"+data);
						 if(data != 'null'){
						 data = JSON.parse(data)
						 //console.log(data)
						 data.forEach(function (item){
							$('#tes').append('<a href="#/" onClick="'+item.nopol+'()"><div class="server"><ul class="server-status server-waning"><li></li><li></li><li></li></ul><p class="server-info">'+item.jenis_kendaraan+'-'+item.nopol+'</p></div> </a>')
							})				 
						 		 $.ajax({
										type : "POST",
										url  : "<?= site_url('Dashboard/cekJumlah')?>",
										dataType : "text",
										data : {rumah:1},
										 success: function(data){
											  var dataParse = JSON.parse(data);
											  //console.log(dataParse.kapasitas);
											// $('#labelKopi').empty();
											 $('#labelKopi').html("KOPI ("+dataParse.kapasitas+")");
										 }
									})
						}
					 }
				})
				}
				kopiData();
				<?php endif; ?>
			//end 4 kopi
			<?php foreach($gnd as $kg=>$g):?>
			function call<?= $r->id.$g->idGudang.$g->idDok ?>() {
				//$('#call<?= $r->id.$g->idGudang.$g->idDok ?>').empty()
				var rumah	= $('#call<?= $r->id.$g->idGudang.$g->idDok ?>').attr("data-rumah");
				var gudang	= $('#call<?= $r->id.$g->idGudang.$g->idDok ?>').attr("data-gudang");
				var dok	= $('#call<?= $r->id.$g->idGudang.$g->idDok ?>').attr("data-dok");
				
				var value = $('#call<?= $r->id.$g->idGudang.$g->idDok ?>').html();
				var label = $('#label<?= $r->id.$g->idGudang.$g->idDok ?>');
				var cl = $('#cl<?= $r->id.$g->idGudang.$g->idDok ?>')
				
				//area selain kopi
				if(rumah != 1){
				$.ajax({
					type : "POST",
					url  : "<?= site_url('Dashboard/cekdok')?>",
					dataType : "text",
					data : {rumah:rumah,gudang:gudang,dok:dok},
					 success: function(data){
						// console.log(data)
						// console.log("lain id"+<?= $r->id.$g->idGudang.$g->idDok ?>+' konten: '+data);
						if(data.trim() != ''){
						//console.log(data);
						$('#call<?= $r->id.$g->idGudang.$g->idDok ?>').empty();
						//$('#call<?= $r->id.$g->idGudang.$g->idDok ?>').html('loading ...');
						$('#call<?= $r->id.$g->idGudang.$g->idDok ?>').html(data);
						cl.removeClass("server-status");
						cl.addClass("server-status server-offline");
						}else{
							
							cl.removeClass("server-status server-offline");
							cl.addClass("server-status")
						}
					$.ajax({
					type : "POST",
					url  : "<?= site_url('Dashboard/cekJumlah')?>",
					dataType : "text",
					data : {rumah:rumah},
					 success: function(data){
						 var dataParse = JSON.parse(data);
								//get max cap
									$.ajax({
									type : "POST",
									url  : "<?= site_url('Dashboard/areaDetail')?>",
									dataType : "text",
									data : {rumah:rumah},
									 success: function(result){
											var parseResult = JSON.parse(result);
											//console.log(parseResult);
											//console.log(dataParse);
											label.empty();
											if(parseResult.maxcap >= (dataParse.kapasitas)+1){
												label.html(parseResult.area+'('+ dataParse.kapasitas +')');
											}else{
												label.html(parseResult.area+'('+ dataParse.kapasitas +')');
												label.css('color','#FF0000')
												label.addClass('blink');
											}
											
										}})
								//end get max cap
						 
							
							 }
							  })
					
					 }
				})
				}
			};
				call<?= $r->id.$g->idGudang.$g->idDok ?>();
				
			<?php endforeach;?>
		<?php endforeach;?>
	
	//fungsi
	count = detik * menit;
				function countDown() {
                if (count > 0) {
                    count--;
                    $('#detik').html(count);
                } else{
					//console.clear();
		<?php foreach($rumah as $kr=>$r):
		$gnd = $CI->Dashboard_model->getGudangAndDock($r->id);
		?>
				
			<?php foreach($gnd as $key=>$g):?>
					//$('#call<?= $r->id.$g->idGudang.$g->idDok ?>').empty();
					call<?= $r->id.$g->idGudang.$g->idDok ?>();
					//console.log("refresh call"+<?= $r->id.$g->idGudang.$g->idDok ?>);
			<?php endforeach;?>
		
		<?php endforeach;?>
					$('#tes').empty();
					kopiData();
					//console.log("kopi refresh");
					count = detik * menit;
					location.reload();
				}
				setTimeout("countDown()", 1000);
				
            }
            countDown();
	</script>
	</body>
</html>