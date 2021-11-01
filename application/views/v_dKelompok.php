<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="<?= base_url()?>dashboardAssets/bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url()?>assets/dashboardSticky.css" rel="stylesheet">
	
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
		<div class="col-md-4 col-sm-12" >
			<div class="server-rack" >			
					<p class="label">STAPEL
					(<?= count($kopiStapel)?>)
					</P>
					<div id="tes"></div>
			
				
				<?php if( count($kopiStapel)>0 ):?>
				  <?php 
					foreach($kopiStapel as $knd):?>
					<div href="#" class="infokopido" data-do="<?= $knd['NoDo'] ?>" data-flag="1" data-toggle="modal" data-target="#infokopido">
						<div class="server">
						  <ul class="server-status">
							<li></li>
							<li></li>
							<li></li>
						  </ul>
						  <p class="server-info" id="call">
						  <?= $knd['nopol'].'-'.$knd['jenis_kendaraan'].'-'.$knd['NoDo'] ?>
						  <br>
						  <?= $knd['tujuan'] ?>
						  <?= isset($knd['jam_stapel']) ? ' ('.jam2($knd['jam_stapel']).')' : ''; ?>
						  </p>
						</div>
					</div>
				  
				  <?php endforeach;?>
				  <?php else : ?>
				 
					<div class="server">
					  <ul class="server-status server-waning">
						<li></li>
						<li></li>
						<li></li>
					  </ul>
					  <p class="server-info" id="call">
					  Kosong
					  </p>
					</div>
				  
					
				<?php endif; ?>
			</div>
		</div>
		
		<div class="col-md-4 col-sm-12" >
			<div class="server-rack" >			
					<p class="label">Belum dapat Nomer DO 
					(<?= count($kopiNoDO)?>)
					</P>
					<div id="tes"></div>
			
				
				<?php if(count($kopiNoDO) > 0 ):?>
					<?php 
					foreach($kopiNoDO as $knd):?>
					
					<div class="server">
					  <ul class="server-status server-offline">
						<li></li>
						<li></li>
						<li></li>
					  </ul>
					  <p class="server-info" id="call">
					  <?= $knd['nopol'].'-'.$knd['jenis_kendaraan'] ?>
					  <?php 
						if($knd['type_ex']=="EX")
						{
							echo "<br>". jam2($knd['jam_in']);
						}
					  ?>
					  </p>
					</div>
				  
				  <?php endforeach;?>
				  
				  <?php else : ?>
				 
					<div class="server">
					  <ul class="server-status server-waning">
						<li></li>
						<li></li>
						<li></li>
					  </ul>
					  <p class="server-info" id="call">
					  Kosong
					  </p>
					</div>
				  
					
				<?php endif; ?>
			</div>
		</div>
		
		<div class="col-md-4 col-sm-12">
			<div class="server-rack" >			
					<p class="label">KOPI Sudah Ada DO (<?= count($kopiDO)?>)</P>
					<div id="tes"></div>
			
			<?php if(count($kopiDO) > 0):?>			
				<?php foreach($kopiDO as $knd):?>
				<div href="#" class="infokopido" data-do="<?= $knd['NoDo'] ?>" data-flag="0" data-toggle="modal" data-target="#infokopido">
				<div class="server">
				
				<?php if($knd['next_gd'] == 0):?>
				<ul class="server-status server-warning">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				<?php else: ?>
				<ul class="server-status">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				<?php endif; ?>
				  
				  <p class="server-info" id="call">
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
				 
					<div class="server">
					  <ul class="server-status server-waning">
						<li></li>
						<li></li>
						<li></li>
					  </ul>
					  <p class="server-info" id="call">
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
			<div class="server-rack" >			
					<p class="label">Belum Register di Gudang (<?= count($nullPusat)?>)</P>
					
			
				<?php if(count($nullPusat) > 0):?>				
				<?php foreach($nullPusat as $knd):
					$gd=$this->dashboard->dtl_non_regis($knd['nopol'])->row();
				?>
				<div href="#" class="infokopido" data-do="<?= $gd->nodo ?>" data-flag="<?= $gd->flag_muat ?>" data-toggle="modal" data-target="#infokopido">
				<div class="server">
				  <ul class="server-status server-offline">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				  <p class="server-info" id="call">
				  <?= $knd['nopol'].'-'.$knd['jk'].'-'.$gd->gudang ?>
					<br>
					<?php if($knd['durasiSelesaiMuat'] == null):?>
						 <?= jam2($knd['jam_satpam']); ?>
					<?php else:?>
						<?= jam2($knd['durasiSelesaiMuat']); ?>
					<?php endif ?>
					
				  </p>
				</div>
				</div>
			  
				<?php endforeach;?>
				<?php else : ?>
				
					<div class="server">
					  <ul class="server-status server-offline">
						<li></li>
						<li></li>
						<li></li>
					  </ul>
					  <p class="server-info" id="call">
					  Kosong					  
					  </p>
					</div>
				  
					
				<?php endif; ?>
			</div>
		</div>
				
	<div class="col-md-4">
		<div class="server-rack" >			
				<p class="label">Gudang J. Central <?= '('.$gjcf2.'/'.$jum['GJST'].')'?></P>
				<div id="tes"></div>
			
		<?php if(count($gjc) > 0):?>					
			<?php foreach($gjc as $knd):?>
			
			<div class="informasi" data-nodo="<?= $knd['do_'] ?>" data-nopol="<?= $knd['nopol'] ?>" data-flag="<?= $knd['flag'] ?>">
			<div class="server">
				<?php 
				//Belum Register di Gudang dan belum ada flag / posisi 
			 if($knd['do_'] == null && $knd['flag'] == null):?>
			  <ul class="server-status server-offline">
				<li></li>
				<li></li>
				<li></li>
			  </ul>
				<?php elseif($knd['do_'] != null && $knd['flag'] == 1): ?>
			  <ul class="server-status server-warning">
				<li></li>
				<li></li>
				<li></li>
			  </ul>
			  <?php elseif($knd['do_'] != null && $knd['flag'] == 2): ?>
			  <ul class="server-status server-muat">
				<li></li>
				<li></li>
				<li></li>
			</ul>
			 
			<?php endif ?>
			  <p class="server-info" id="call">
			  <?= $knd['nopol'].'-'.$knd['jk'].'-'.$knd['do_'] ?>
			  
			  </p>
			</div>
		  </div>
			<?php endforeach;?>
			<?php else : ?>
			  
				<div class="server">
				  <ul class="server-status server-offline">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				  <p class="server-info" id="call">
				  Kosong
				</p>
				</div>					
			<?php endif; ?>
		</div>
	</div>
		
		<div class="col-md-4">
			<div class="server-rack" >			
					<p class="label">GJCC <?= '('.$gjccf2.'/'.$jum['GJCC'].')' ?></P>
					<div id="tes"></div>
			
			<?php if(count($gjcc) > 0):?>				
				<?php foreach($gjcc as $knd):?>
				<div class="informasi" data-nodo="<?= $knd['do_'] ?>" data-nopol="<?= $knd['nopol'] ?>" data-flag="<?= $knd['flag'] ?>">
				<div class="server">
				<?php if($knd['do_'] == null && $knd['flag'] == null):?>
				  <ul class="server-status server-offline">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
					<?php elseif($knd['do_'] != null && $knd['flag'] == 1): ?>
				  <ul class="server-status server-warning">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				  <?php elseif($knd['do_'] != null && $knd['flag'] == 2): ?>
				  <ul class="server-status server-muat">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				 <?php elseif($knd['do_'] != null && $knd['flag'] == 3): ?>
				  <ul class="server-status">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				<?php endif ?>
				  <p class="server-info" id="call">
				  <?= $knd['nopol'].'-'.$knd['jk'].'-'.$knd['do_'] ?>
				  
				  </p>
				</div>
			  </div>
				<?php endforeach;?>
				<?php else : ?>
				
					<div class="server">
					  <ul class="server-status server-offline">
						<li></li>
						<li></li>
						<li></li>
					  </ul>
					  <p class="server-info" id="call">
					  Kosong
					  
					  </p>
					</div>
				
					
				<?php endif; ?>
			</div>
		</div>
		
		<div class="col-md-4">
			<div class="server-rack" >			
					<p class="label">Hall 3 <?= '('.$gjh3f2.'/'.$jum['GJH3'].')' ?></P>
					<div id="tes"></div>
				
			<?php if(count($gjh3) > 0):?>				
				<?php foreach($gjh3 as $knd):?>
				<div class="informasi" data-nodo="<?= $knd['do_'] ?>" data-nopol="<?= $knd['nopol'] ?>" data-flag="<?= $knd['flag'] ?>">
				<div class="server">
				 <?php if($knd['do_'] == null && $knd['flag'] == null):?>
				  <ul class="server-status server-offline">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
					<?php elseif($knd['do_'] != null && $knd['flag'] == 1): ?>
				  <ul class="server-status server-warning">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				  <?php elseif($knd['do_'] != null && $knd['flag'] == 2): ?>
				  <ul class="server-status server-muat">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				 <?php elseif($knd['do_'] != null && $knd['flag'] == 3): ?>
				  <ul class="server-status">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				<?php endif ?>
				  <p class="server-info" id="call">
				  <?= $knd['nopol'].'-'.$knd['jk'].'-'.$knd['do_'] ?>
				  
				  </p>
				</div>
			  </div>
				<?php endforeach;?>
				<?php else : ?>
					<div class="server">
					  <ul class="server-status server-offline">
						<li></li>
						<li></li>
						<li></li>
					  </ul>
					  <p class="server-info" id="call">
					  Kosong					  
					  </p>
					</div>		
				<?php endif; ?>
			</div>
		</div>
		
		<div class="col-md-4">
			<div class="server-rack" >			
					<p class="label">Gudang J. Depan <?= '('.$gjdf2.'/'.$jum['GJDP'].')'?></P>
					<div id="tes"></div>
			
			<?php if(count($gjd) > 0):?>				
				<?php foreach($gjd as $knd):?>
				<div href="#" class="informasi" data-nodo="<?= $knd['do_'] ?>" data-nopol="<?= $knd['nopol'] ?>" data-flag="<?= $knd['flag'] ?>">
				<div class="server">
				 <?php if($knd['do_'] == null && $knd['flag'] == null):?>
				  <ul class="server-status server-offline">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
					<?php elseif($knd['do_'] != null && $knd['flag'] == 1): ?>
				  <ul class="server-status server-warning">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				  <?php elseif($knd['do_'] != null && $knd['flag'] == 2): ?>
				  <ul class="server-status server-muat">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				 <?php elseif($knd['do_'] != null && $knd['flag'] == 3): ?>
				  <ul class="server-status">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				<?php endif ?>
				  <p class="server-info" id="call">
				  <?= $knd['nopol'].'-'.$knd['jk'].'-'.$knd['do_'] ?>
				  
				  </p>
				</div>
			  </div>
				<?php endforeach;?>
				<?php else : ?>			  
					<div class="server">
					  <ul class="server-status server-offline">
						<li></li>
						<li></li>
						<li></li>
					  </ul>
					  <p class="server-info" id="call">
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
			<div class="server-rack">			
					<p class="label">Belum Register di Gudang(<?= 
				count($GJBCnull)			
			?>)</P>
					<div id="tes"></div>
					
				<?php if(count($GJBCnull) > 0):?>				
				<?php foreach($GJBCnull as $knd):
					$gd=$this->dashboard->dtl_non_regis($knd['nopol'])->row();
				?>
				<div href="#" class="infokopido" data-do="<?= $gd->nodo ?>" data-flag="<?= $gd->flag_muat ?>" data-toggle="modal" data-target="#infokopido">
				<div class="server">
				  <ul class="server-status server-offline">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				  <p class="server-info" id="call">
				   <?= $knd['nopol'].'-'.$knd['jk'].'-'.$gd->gudang ?>
					<br>
				<?php if($knd['durasiSelesaiMuat'] == null):?>
						 <?= jam2($knd['jam_satpam']); ?>
					<?php else:?>
						<?= jam2($knd['durasiSelesaiMuat']); ?>
					<?php endif ?>
					
					
				  </p>
				</div>
				</div>
			  
				<?php endforeach;?>
				<?php else : ?>
				
				<div class="server">
				  <ul class="server-status server-offline">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				  <p class="server-info" id="call">Kosong</p>
				</div>
			  
					
				<?php endif; ?>
			</div>
		</div>
		
		<div class="col-md-6">
			<div class="server-rack" >			
					<p class="label">GJBC <?= '('.$GJBCf2.'/'.$jum['GJBC'].')'?></P>
					<div id="tes"></div>
				
			<?php if(count($GJBC) > 0):?>				
				<?php foreach($GJBC as $knd):?>
				<div class="informasi" data-nodo="<?= $knd['do_'] ?>" data-nopol="<?= $knd['nopol'] ?>" data-flag="<?= $knd['flag'] ?>">
				<div class="server">
				<?php if($knd['do_'] == null && $knd['flag'] == null):?>
				  <ul class="server-status server-offline">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
					<?php elseif($knd['do_'] != null && $knd['flag'] == 1): ?>
				  <ul class="server-status server-warning">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				  <?php elseif($knd['do_'] != null && $knd['flag'] == 2): ?>
				  <ul class="server-status server-muat">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				 <?php elseif($knd['do_'] != null && $knd['flag'] == 3): ?>
				  <ul class="server-status">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				<?php endif ?>
				  <p class="server-info" id="call">
				  <?= $knd['nopol'].'-'.$knd['jk'].'-'.$knd['do_'] ?>
				  
				  </p>
				</div>
			  </div>
				<?php endforeach;?>
				<?php else : ?>
				  
					<div class="server">
					  <ul class="server-status server-offline">
						<li></li>
						<li></li>
						<li></li>
					  </ul>
					  <p class="server-info" id="call">
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
			<div class="server-rack" >			
					<p class="label">Belum Register di Gudang (<?= 
				count($nullGJJBN)			
			?>)</P>
					<div id="tes"></div>
					
				<?php if(count($nullGJJBN) > 0):?>				
				<?php foreach($nullGJJBN as $knd):
				$gd=$this->dashboard->dtl_non_regis($knd['nopol'])->row();
				?>
				<div href="#" class="infokopido" data-do="<?= $gd->nodo ?>" data-flag="<?= $gd->flag_muat ?>" data-toggle="modal" data-target="#infokopido">
				<div class="server">
				  <ul class="server-status server-offline">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				  <p class="server-info" id="call">
				  <?= $knd['nopol'].'-'.$knd['jk'].'-'.$gd->gudang ?>
					<br>
						<?php if($knd['durasiSelesaiMuat'] == null):?>
						 <?= jam2($knd['jam_satpam']); ?>
					<?php else:?>
						<?= jam2($knd['durasiSelesaiMuat']); ?>
					<?php endif ?>
				  </p>
				</div>
				</div>
			  
				<?php endforeach;?>
				<?php else : ?>
				
				<div class="server">
				  <ul class="server-status server-offline">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				  <p class="server-info" id="call">Kosong</p>
				</div>
			  
					
					
				<?php endif; ?>
			</div>
		</div>
		
		
		<div class="col-md-6">
			<div class="server-rack" >			
					<p class="label">Gudang Jabon <?= '('.$GJJBNf2.'/'.$jum['GJJBN'].')'?></P>
					<div id="tes"></div>
			
			<?php if(count($GJJBN) > 0):?>						
				<?php foreach($GJJBN as $knd):?>
				<div  class="informasi" data-nodo="<?= $knd['do_'] ?>" data-nopol="<?= $knd['nopol'] ?>" data-flag="<?= $knd['flag'] ?>">
				<div class="server">
				  <?php if($knd['do_'] == null && $knd['flag'] == null):?>
				  <ul class="server-status server-offline">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
					<?php elseif($knd['do_'] != null && $knd['flag'] == 1): ?>
				  <ul class="server-status server-warning">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				  <?php elseif($knd['do_'] != null && $knd['flag'] == 2): ?>
				  <ul class="server-status server-muat">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				 <?php elseif($knd['do_'] != null && $knd['flag'] == 3): ?>
				  <ul class="server-status">
					<li></li>
					<li></li>
					<li></li>
				  </ul>
				<?php endif ?>
				  <p class="server-info" id="call">
				  <?= $knd['nopol'].'-'.$knd['jk'].'-'.$knd['do_'] ?>
				  
				  </p>
				</div>
			  </div>
				<?php endforeach;?>
				<?php else : ?>
				  
					<div class="server">
					  <ul class="server-status server-offline">
						<li></li>
						<li></li>
						<li></li>
					  </ul>
					  <p class="server-info" id="call">
					  Kosong
					  
					  </p>
					</div>
				 
					
				<?php endif; ?>
			</div>
		</div>
	
	</div>
	

</div>

<div class="modal fade bd-example-modal-lg" id="infokopido" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
	<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Informasi <span id="do"></span></h5>
        
      </div>
      <div class="modal-body">
      </div>
	  <div class="modal-footer">
        <button type="button" class="btn btn-secondary keluarKopiDo" data-dismiss="modal">Close</button>
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
			
	
		$('.keluarKopiDo').on('click', function (){
			 $('#infokopido').modal('hide');
		})
		
		$('.infokopido').on('click', function (){
			var nodo = $(this).attr("data-do");
			var flag = $(this).attr("data-flag");
			 var htmlvalue;
				$.ajax({
					type : "POST",
					url  : "<?= site_url('Antrian/infoDO')?>",
					dataType : "text",
					data : {nodo:nodo,flag:flag},
					 success: function(response){
						 console.log(response);
						  $('.modal-body').html(response);
						  $('#do').html(nodo)	;	
						  // Display Modal
						  $('#infokopido').modal('show'); 
					 },
					 error: function (err) {
					console.log("AJAX error in request: " + JSON.stringify(err, null, 2));
				}
				})
		})
		
	
		$('.informasi').on('click', function (){
			var nopol = $(this).attr("data-nopol"); 
			var flag  = $(this).attr("data-flag");
			var nodo 	= $(this).attr("data-nodo");
					
				$.ajax({
					type : "POST",
					url  : "<?= site_url('Antrian/infoNopol')?>",
					dataType : "text",
					data : {nopol:nopol,flag:flag,nodo:nodo,"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>",},
					 success: function(response){
						$('.modal-body').empty();
						$('.modal-body').html(response);
						$('#do').html("Nopol: "+nopol);	;	
						  // Display Modal
						  $('#infokopido').modal('show'); 
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
					location.reload();
				}
				setTimeout("countDown()", 1000);
				
            }
            countDown();
	</script>
	</body>
</html>