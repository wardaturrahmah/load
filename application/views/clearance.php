<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Transaksi Panggilan Muat</title>
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
		</script>
	</head>
	<body class="nav-md">
		<!-- page content -->
        <div class="right_col" role="main">
				
				<div class="title_left">
					<h3>Form Panggilan Muat</h3>
				</div>
				<?php if($this->session->flashdata('clearance')!='') 
						{
				?>
				<div class="page-title">
								<div class="alert alert-danger alert-dismissible " role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
						</button>
						<strong><?php echo $this->session->flashdata('clearance')?></strong>
					</div>
				</div>
				<?php } ?>
            
            <div class="clearfix"></div>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<h2>Transaksi Panggilan Muat</h2>
							<ul class="nav navbar-right panel_toolbox">
								<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
								</li>
							</ul>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<form class="form-horizontal form-label-left" action="<?php echo $form?>" method="post" id="clearance">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">DO</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input name="do" type="number" class="form-control" placeholder=""  required="required">
									</div>
								</div>
								<div class="item form-group">
									<label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">Tujuan Gudang</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<select class="form-control" name="gd" id="gd">
											<?php
											foreach($gudang as $gd)
											{
												echo '<option value="'.$gd->id.'">'.$gd->gudang.'</option>';
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
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<h2>Tabel List Panggilan Muat</h2>
							<ul class="nav navbar-right panel_toolbox">
								<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
								</li>
							</ul>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<table id="datatable" class="table table-striped table-bordered">
								<thead>
									<th>NO DO</th>
									<th>Nopol</th>
									<th>Next gudang</th>
									<th>Jam perizinan</th>
									<th>Action</th>
								</thead>
								<?php
								foreach($list as $tb)
								{
									$action='';
									if($auth->u==1)
									{
										$action.='<button type="button" class="btn btn-info" 
										data-toggle="modal" data-target="#modal_edit_'.$tb->nodo.'">
										<a><i class="fa fa-edit blue" style="color:#DDDDDD;"></i></a></button>';
									}
									echo '<tr>';
									echo '<td>'.$tb->nodo.'</td>';
									echo '<td>'.$tb->nopol.'</td>';
									echo '<td>'.$tb->gudang.'</td>';
									$jam_izin=$tb->jam_izin==null?'':date('Y-m-d H:i:s',strtotime($tb->jam_izin));
									echo '<td>'.$jam_izin.'</td>';
									echo '<td>'.$action.'</td>';
								?>
								<div class="modal fade" id="modal_edit_<?echo $tb->nodo?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
									<div class="modal-dialog">
									  <div class="modal-content">
										<div class="modal-header">
										  <h4 class="modal-title">Edit</h4>
										  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										  </button>
										</div>
										<div class="modal-body">
										  <form class="form-horizontal" action="<?php echo $form2; ?>" method="post">
											<div class="form-group row">
												<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">No Do</label>
												<div class="col-sm-9">
													<input type="text" value="<?php echo $tb->nodo ?>" class="form-control form-control-sm" readonly>
													<input type="hidden" value="<?php echo $tb->nodo ?>" class="form-control form-control-sm" name="nodo" >
												</div>
											</div>
											<div class="form-group row">
												<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Next</label>
												<div class="col-sm-9">
													<select class="form-control form-control-sm select2" style="width: 100%;" name="gd" id="gudang" required>														
														<?PHP
														
														foreach ($gudang as $gd)
														{
																$sel=$tb->next_gd==$gd->id ? 'selected' : '';
														?>
														<option value="<?php echo $gd->id?>" <?= $sel;?>><?PHP echo $gd->gudang?></option>
														<?PHP
														}
														?>
													</select>
												</div>
											</div>
											<div class="col-3">
											  </div>
											  <div class="modal-footer justify-content-between">
												  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												  <input type="submit" name="save" value="Simpan" class="btn btn-primary">
												</div>
											
										</form>
										</div>
			
									  </div>
									  <!-- /.modal-content -->
									</div>
									<!-- /.modal-dialog -->
								</div>
									
								<?php
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
			});
			$( "#clearance" ).submit(function( event ) {
			  $("#proses").prop('disabled', 'true');
			});
		</script>
	</body>
</html>