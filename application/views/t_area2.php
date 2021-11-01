<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Transaksi Area</title>
		<meta http-equiv="refresh" content="300">
		<script>
		function cek_spasi(my_text)
		{
			var ket=document.getElementsByName(my_text)[0];
			cek=ket.value.substring((ket.value.length-1), ket.value.length);
			if (cek == " ") {
			var msg = "Tidak boleh ada spasi";
			alert(msg);
			ket.value = ket.value.substring(0, ket.value.length-1);
			 }
			 
		}
		document.body.addEventListener('change', function (e) {
			let target = e.target;
			if(target.id=='IN')
			{
				document.getElementById("nopol").required = false;
				$(".internal").show();
				$(".eksternal").hide();
			}
			else if(target.id=='EX')
			{
				document.getElementById("nopol").required = true;
				$(".internal").hide();
				$(".eksternal").show();
			}
		});
							
		function selesai(arr)
		{
			$(".proses").prop('disabled', 'true');
			var a=arr.split("~");
			var id=a[0];
			var nopol=a[1];
			var area=a[2];
			var flag=a[3];
			var ket='';
			if(flag==1)
			{
				ket = prompt("No SJ?");
				if(ket===null)
				{
					$(".proses").prop('disabled', false);
				}
				if(ket.trim()!="")
				{
					$.ajax({
					url:'<?php echo base_url();?>area2/selesai2/',
					method:'post',
					data:{
							
							keterangan:ket,
							id:id,
							nopol:nopol,
							area:area,
							flag:flag,
							
						},
						success:function(data)
						{
							location.reload();
						}
					});	
				}
				else
				{
					$(".proses").prop('disabled', false);
					alert('Tidak bisa. Harap isi nomer SJ');
				}
			}
			else
			{
				$.ajax({
					url:'<?php echo base_url();?>area2/selesai2/',
					method:'post',
					data:{
							
							keterangan:ket,
							id:id,
							nopol:nopol,
							area:area,
							flag:flag,
							
						},
						success:function(data)
						{
							location.reload();
						}
					});	
			}
			
		}
		</script>
		

	</head>
	<body class="nav-md">
		<!-- page content -->
        <div class="right_col" role="main">
				
				<div class="title_left">
					<h3>Form Masuk Area</h3>
				</div>
				<?php if($this->session->flashdata('tarea')!='') 
						{
				?>
				<div class="page-title">
								<div class="alert alert-danger alert-dismissible " role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
						</button>
						<strong><?php echo $this->session->flashdata('tarea')?></strong>
					</div>
				</div>
				<?php } ?>
            
            <div class="clearfix"></div>
			<?php
			if($auth->c==1)
			{
			?>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<h2>Transaksi Area</h2>
							<ul class="nav navbar-right panel_toolbox">
								<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
								</li>
							</ul>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<form class="form-horizontal form-label-left" action="<?php echo $form?>" method="post" id="trans">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
									<input type="radio" id="IN" name="ekspedisi" value="IN" checked required> 
									<label for="IN">Internal</label>
									<input type="radio" id="EX" name="ekspedisi" value="EX" required> 
									<label for="EX">External</label>
								</div>
								<div class="eksternal">
									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Nopol</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input name="nopol" type="text" id="nopol" class="form-control" placeholder="" onKeyUp="cek_spasi('nopol');">
										</div>
									</div>
									<div class="item form-group">
										<label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Kendaraan</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<select class="form-control" name="jenis" id="jenis">
												<?php
												foreach($options_kendaraan as $kend)
												{
													echo '<option value="'.$kend->type.'">'.$kend->type.'</option>';
												}
												?>
											</select>
										</div>
									</div>
								</div>
								<div class="internal">
									<div class="item form-group">
										<label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">Nopol</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<select class="form-control" name="nopols" id="nopols">
												<?php
												foreach($list_nopol as $nopol)
												{
													echo '<option value="'.$nopol->nopol.'~'.$nopol->jenis_kendaraan.'">'.$nopol->nopol.' - '.$nopol->nama_sopir.'</option>';
												}
												?>
											</select>
										</div>
									</div>
								</div>
								<div class="item form-group">
									<label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Nama sopir</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input name="nama_sopir" type="text" class="form-control" placeholder=""  required="required">
									</div>
								</div>
								<div class="item form-group">
									<label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">Area</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<select class="form-control" name="area" id="area">
											<?php
											foreach($area as $area)
											{
												echo '<option value="'.$area->id.'">'.$area->area.'</option>';
											}
											?>
										</select>
									</div>
								</div>
								<div class="ln_solid"></div>
								<div class="form-group">
									<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
										<button type="submit" class="btn btn-success" id="proses">Submit</button>
										<button type="button" class="btn btn-primary">Cancel</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<?
			}
			?>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<h2>Tabel List Kendaraan</h2>
							<ul class="nav navbar-right panel_toolbox">
								<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
								</li>
							</ul>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<table id="datatable" class="table table-bordered">
								<thead>
									<th>No</th>
									<th>Area</th>
									<th>Nopol</th>
									<th>Jenis Kendaraan</th>
									<th>Nama Sopir</th>
									<th>Action</th>
								</thead>
								<?php
								$no=0;
								foreach($list as $tb)
								{
									$no++;
									$action='';
									if($tb->area!=1)
									{
										if(isset($tb->flag_muat))
										{
											echo '<tr>';
											$flag=0;
										}
										else
										{
											echo '<tr style="background:#FFB6C1	;">';
											$flag=1;
										}
									}
									else
									{
										if(isset($tb->flag_stapel))
										{
											echo '<tr style="background:#dbffec	;">';
										}
										else
										{
											echo '<tr>';
										}
										$flag=0;
									}
									if($auth->u==1)
									{
										//$action.='<a href="'.base_url('area2/selesai').'/'.$tb->id.'~'.$tb->nopol.'~'.$tb->area.'" class="selesai"><button type="button" class="btn btn-success"><i class="fa fa-check green" style="color:#DDDDDD;"></i></button></a>';
										$var="'".$tb->id.'~'.$tb->nopol.'~'.$tb->area.'~'.$flag."'";
										$action='<button type="button" class="btn btn-success proses" onClick="selesai('.$var.')"><i class="fa fa-check green" style="color:#DDDDDD;"></i></button>';
									}
									echo '<td>'.$no.'</td>';
									echo '<td>'.$tb->nama_area.'</td>';
									echo '<td>'.$tb->nopol.'</td>';
									echo '<td>'.$tb->jenis_kendaraan.'</td>';
									echo '<td>'.$tb->nama_sopir.'</td>';
									echo '<td>'.$action.'</td>';
									echo '</tr>';
								}
								?>
							</table>
							
						</div>
					</div>
				</div>
			</div>	
			
		</div>
		<!-- page content -->
		<script type="text/javascript">
			$(document).ready(function() {
				$('#jenis').select2();
				$('#nopols').select2();
				$(".internal").show();
				$(".eksternal").hide();
			});
			$( "#trans" ).submit(function( event ) {
			  $("#proses").prop('disabled', 'true');
			});
		</script>
	</body>
</html>