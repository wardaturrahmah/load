<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="<?= base_url()?>dashboardAssets/bootstrap.min.css" rel="stylesheet">
	
    <title>Dashboard list antrian</title>
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
			foreach($area as $a):
		?>
		<div class="col-md-3" >
			<div class="server-rack">
				<p class="label" id="label"><?php echo $a->area.' ('.count($list[$a->id]).') ';?></P>
				<?php foreach($list[$a->id] as $ls) :
					if($a->id==1)
					{
						/* $gd=$this->master->ambil_do($ls->nopol)->row();
						if(count($gd)>0)
						{
							$gudang=$gd->NoDo;
							$bg='background-color: #3a3a3a';
						}
						else
						{
							$gudang='';
							$bg='background-color: #800000';
						} */
						$gudang='';
							$bg='background-color: #3a3a3a';
					}
					else
					{
						
						if($ls->locid == null)
						{
							$gudang='';
							$bg='background-color: #800000';
						}
						else
						{
							$gudang=$ls->locid;
							$bg='background-color: #3a3a3a';
						}
					}
					
					?>
				<div class="server" style="<?php echo $bg; ?>">
				  <p class="server-info" id="call">
					<span><?php 
					
					echo $ls->nopol.'-'.$ls->jenis_kendaraan.'-'.$gudang; ?></span>
				  </p>
				</div>
				<?php endforeach;?>

			</div>
		</div>
			<?php endforeach;?>
	<!-- Rumah end -->
	</div>		

</div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
	<script src="<?= base_url()?>dashboardAssets/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url()?>dashboardAssets/jquery-3.6.0.min.js"></script>
	<script>
		var menit = 1;				
		var detik = 60 + 1;
		var interval = 1000 * detik * menit; // microsecond * second * minutes * hours
		count = detik * menit;
				function countDown() {
                if (count > 0) {
                    count--;
                    $('#detik').html(count);
                } else{
					count = detik * menit;
					location.reload();
				}
				setTimeout("countDown()", 1000);
				
            }
            countDown();
	</script>
	</body>
</html>