<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Form Muat</title>
	    <!--<meta http-equiv="refresh" content="300">-->

	</head>
	<body class="nav-md">
		<!-- page content -->
        <div class="right_col" role="main">
				<div class="title_left">
					<h3>Form Muat</h3>
				
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_antrian">Register antrian</button>
				</div>
				<?php if($this->session->flashdata('muat')!='') 
						{
				?>
				<div class="page-title">
								<div class="alert alert-danger alert-dismissible " role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
						</button>
						<strong><?php echo $this->session->flashdata('muat')?></strong>
					</div>
				</div>
				<?php } ?>
			
            <div class="clearfix"></div>
			
			<div class="row">
				<div class="col-md-4 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<h2>Data Antrian Hari ini</small></h2>
							<ul class="nav navbar-right panel_toolbox">
								<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
								</li>
							</ul>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<div style="overflow-x:auto;overflow-y:auto;">
							<table id="tabel1" class="table table-striped table-bordered tabel1">
								<thead>
									<th>Nomor antrian</th>
									<th>NO DO</th>
									<th>Jam antrian</th>
									<th>Action</th>
									
								</thead>
								<?php
								if(count($tabel1)>0)
								{
									foreach ($tabel1 as $tb1)
									{	
										$action='';
										$dockl= $this->master->dock_sisa($tb1->gd)->result();
										if($auth->c==1)
										{
											if(count($dockl)>0)
											{
												$action.='<button type="button" class="btn btn-success mulai" 
												data-toggle="modal" data-target="#modal_muat_'.$tb1->id.'">
												<a><i class="fa fa-arrow-circle-right green" style="color:#fff;"></i></a></button>';
											}
										}
										if($auth->d==1)
										{
											$kt="return confirm('Anda yakin akan menghapus antrian ini?')";
											$action.='<a href="'.base_url('adm3/delete_antrian').'/'.$tb1->id.'~'.$auth->id.'" onclick="'.$kt.'">
											<button class="btn btn-danger">											
											<i class="fa fa-trash" style="color:#DDDDDD;"></i></button></a>';
										}
										
										echo '<tr>';
										
										echo '<td>'.$tb1->kode.$tb1->antrian.'</td>';
										echo '<td>'.$tb1->do_.'</td>';
										echo '<td>'.date('Y-m-d H:i',strtotime($tb1->datetime)).'</td>';
										
										echo '<td>'.$action.'</td>';
									?>
									<div class="modal fade" id="modal_muat_<?echo $tb1->id?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
												  <h4 class="modal-title">Proses Muat</h4>
												  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												  </button>
												</div>
												<div class="modal-body">
													<form class="form-horizontal muat" action="<?php echo $form; ?>" method="post">
														<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
														<input type="hidden" value="<?php echo $tb1->id ?>" name="id"></input>
														<input type="hidden" value="<?php echo $default['menu'] ?>" name="menu"></input>
														<div class="form-group row">
															<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Nomor antrian</label>
															<div class="col-sm-9">
																<input type="text" value="<?php echo $tb1->antrian ?>" class="form-control form-control-sm" id="inputName" placeholder="Name" name="antri" required="" readonly>
															</div>
														</div>
														<div class="form-group row">
															<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Jam antrian</label>
															<div class="col-sm-9">
																<input type="text" value="<?php echo $tb1->datetime ?>" class="form-control form-control-sm" id="inputName" placeholder="Name" name="datetime" required="" readonly>
															</div>
														</div>
														<div class="form-group row">
															<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">No Do</label>
															<div class="col-sm-9">
																<input type="text" value="<?php echo $tb1->do_?>" class="form-control form-control-sm" name="" readonly>
																<input type="hidden" value="<?php echo $tb1->do_?>" class="form-control form-control-sm" placeholder="No DO" name="do" >
															</div>
														</div>
														<div class="form-group row">
															<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Dock</label>
															<div class="col-sm-9">
																<select class="form-control form-control-sm select2" style="width: 100%;" name="dock" id="dock" required>
																	<?PHP
																	
																	foreach ($dockl as $dc)
																	{?>
																	<option value="<?php echo $dc->id?>"><?PHP echo $dc->dock?></option>
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
														  <input type="submit" name="save" value="Simpan" class="btn btn-primary proses_muat">
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
									
								}								
								?>
							</table>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<h2>Data Muat Hari ini</small></h2>
							<ul class="nav navbar-right panel_toolbox">
								<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
								</li>
							</ul>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<div style="overflow-x:auto;overflow-y:auto;">
							<table id="tabel2" width="100%" class="table table-striped table-bordered">
								<thead>
									<th>Antrian</th>
									<th>dock</th>
									<th>Awal muat</th>
									<th>No DO</th>
									<th>Action</th>
									
								</thead>
								<?php
								if(count($tabel2)>0)
								{
									
									
									foreach ($tabel2 as $tb2)
									{
										$action='';
										echo '<tr>';
										if($auth->c==1)
										{
											$action='
											<button type="button" class="btn btn-success selesai" data-idantrian="'.$tb2->id_antrian.'" 
											data-idmuat="'.$tb2->id_muat.'" data-nodo="'.$tb2->do_.'">
											<i class="fa fa-arrow-circle-right green" style="color:#fff;"></i></button>
											';
										}
										echo '<td>'.$tb2->kode.$tb2->antrian.'</td>';
										echo '<td>'.$tb2->dock.'</td>';
										echo '<td>'.date('Y-m-d H:i',strtotime($tb2->jam_muat)).'</td>';
										echo '<td>'.$tb2->do_.'</td>';
										echo '<td>'.$action.'</td>';
									?>
									
									<?php
									echo '</tr>';
									}
									
								}								
								?>
							</table>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<h2>Data Selesai Muat Hari ini</small></h2>
							<ul class="nav navbar-right panel_toolbox">
								<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
								</li>
							</ul>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<table id="tabel3" class="table table-striped table-bordered">
								<thead>
									<th>Gudang</th>									
									<th>No DO</th>									
									<th>Selesai Muat</th>
									<th>Next Gudang</th>									
									<th>Action</th>
								</thead>
								<?php
								if(count($tabel3)>0)
								{
									foreach ($tabel3 as $tb3)
									{
										$action='';
										echo '<tr>';
										
										if($auth->u==1)
										{
											$action.='
											<button type="button" class="btn btn-info edit_muat"
											data-idmuat="'.$tb3->id_muat.'" data-nodo="'.$tb3->do_.'" data-gd="'.$tb3->next_gd.'">
											<i class="fa fa-edit green" style="color:#fff;"></i></button>
											';
											$action.='
											<button type="button" class="btn btn-success edit_muat2"
											data-idmuat="'.$tb3->id_muat.'" data-nodo="'.$tb3->do_.'" data-gd="'.$tb3->next_gd.'">
											<i class="fa fa-edit green" style="color:#fff;"></i></button>
											';		
										}
										$selesai=date('Y-m-d H:i',strtotime($tb3->selesai_muat));
										
										echo '<td>'.$tb3->locid.'</td>';
										echo '<td>'.$tb3->do_.'</td>';
										echo '<td>'.$selesai.'</td>';
										if($tb3->gd_next==null)
										{
											if($tb3->next_gd==null)
											{
												$next='';
											}
											else if ($tb3->next_gd==0)
											{
												$next='Kopi';
											}
											else if ($tb3->next_gd==-1)
											{
												$next='Cetak SJ';
											}
										}
										else
										{
											$next=$tb3->gd_next;
										}
										echo '<td>'.$next.'</td>';
										echo '<td>'.$action.'</td>';
								?>
									<div class="modal fade" id="modal_edit_<?echo $tb3->id_muat?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
										<div class="modal-dialog">
										  <div class="modal-content">
											<div class="modal-header">
											  <h4 class="modal-title">Edit</h4>
											  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											  </button>
											</div>
											<div class="modal-body">
												<form class="form-horizontal edit" action="<?php echo $form2; ?>" method="post">
												<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
												<input type="hidden" value="<?php echo $tb3->id_muat ?>" name="id"></input>
												<input type="hidden" value="<?php echo $tb3->id_antrian ?>" name="id_antrian"></input>
												
												<div class="form-group row">
													<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">No Do</label>
													<div class="col-sm-9">
														<input type="text" value="<?php echo $tb3->do_?>" class="form-control form-control-sm" readonly>
														<input type="hidden" value="<?php echo $tb3->do_?>" class="form-control form-control-sm" name="nodo" >
													</div>
												</div>
												<div class="form-group row">
													<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Next</label>
													<div class="col-sm-9">
														<input type="hidden" value="<?php echo $tb3->next_gd?>" class="form-control form-control-sm" name="b_gd" >
														<select class="form-control form-control-sm select2" style="width: 100%;" name="gudang" id="gudang" required>
															
															<option value="-1">Proses SJ</option>
															<option value="0">Kopi</option>
															
															<?PHP
															
															foreach ($gudang as $gd)
															{
																	$sel=$tb3->next_gd==$gd->id ? 'selected' : '';
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
													  <input type="submit" value="Simpan" class="btn btn-primary proses_edit">
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
									
								}								
								?>
							</table>
						</div>
					</div>
				</div>
				<div class="modal fade" id="modal_antrian" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
					<div class="modal-dialog">
					  <div class="modal-content">
						<div class="modal-header">
						  <h4 class="modal-title">Register Muat</h4>
						  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
						</div>
						<div class="modal-body">
						  <form class="form-horizontal" action="<?php echo $formp; ?>" method="post" id="register">
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
							<div class="form-group row">
								<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Gudang</label>
								<div class="col-sm-9">
									<select class="form-control form-control-sm" name="gd">
									<?php 
									foreach($gudang_akses as $gd)
									{
										echo '<option value="'.$gd->id.'">'.$gd->gudang.'</option>';
									}
									?>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">No Do</label>
								<div class="col-sm-9">
									<input type="number" autofocus value="" class="form-control form-control-sm" name="do" required="" autocomplete="off" >
								</div>
							</div>
							
							
							<div class="col-3">
							  </div>
							  <div class="modal-footer justify-content-between">
								  <input type="submit" name="save" value="Submit" class="btn btn-primary" id="proses_regis">
								</div>
							
						</form>
						</div>

					  </div>
					  <!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<div class="modal fade" id="modal_selesai" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
					<div class="modal-dialog modal-lg">
					  <div class="modal-content">
						<div class="modal-header">
						  <h4 class="modal-title">Selesai Muat</h4>
						  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
						</div>
						<div class="modal-body">
						  <form class="form-horizontal selesai_muat"  method="post" id="selesai_muat">
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
							<input type="hidden" name="id" id="id_muat"></input>
							<input type="hidden" name="id_antrian" id="id_antrian"></input>
							
							<div class="form-group row">
								<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">No Do</label>
								<div class="col-sm-9">
									<input type="text"  class="form-control form-control-sm" id="nodo" readonly>
									<input type="hidden"  class="form-control form-control-sm" placeholder="No DO" name="nodo" id="nodo2">
								</div>
							</div>
							<div class="form-group row">
								<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Next</label>
								<div class="col-sm-9">
									<input type="hidden" class="form-control form-control-sm" name="b_gd" id="b_gd">
									<select class="form-control form-control-sm select2" style="width: 100%;" name="gudang" id="gudang" required>
										
										<option value="-1">Proses SJ</option>
										<option value="0">Kopi</option>
										
										<?PHP
										
										foreach ($gudang as $gd)
										{?>
										<option value="<?php echo $gd->id?>"><?PHP echo $gd->gudang?></option>
										<?PHP
										}
										?>
									</select>
								</div>
							</div>
							<div class="form-group row table-responsive">
								<table id="tabels" class="table table-striped table-bordered">
									<thead>
										<th>Itemid</th>
										<th>Description</th>
										<th>Qty</th>
										<th>Cek</th>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
							<div class="col-3">
							  </div>
							  <div class="modal-footer justify-content-between">
								  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								  <input type="submit" name="save" value="Simpan" class="btn btn-primary proses_selesai">
								</div>
							
						</form>
						</div>

					  </div>
					  <!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<div class="modal fade" id="modal_selesai3" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
					<div class="modal-dialog modal-lg">
					  <div class="modal-content">
						<div class="modal-header">
						  <h4 class="modal-title">Selesai Muat</h4>
						  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
						</div>
						<div class="modal-body">
						  <form class="form-horizontal selesai_muat3"  method="post" id="selesai_muat3">
							<input type="hidden" name="id" id="id_muat3"></input>							
							<div class="form-group row">
								<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">No Do</label>
								<div class="col-sm-9">
									<input type="text"  class="form-control form-control-sm" id="nodo5" readonly>
									<input type="hidden"  class="form-control form-control-sm" placeholder="No DO" name="nodo" id="nodo6">
								</div>
							</div>
							<div class="form-group row">
								<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Next</label>
								<div class="col-sm-9">
									<input type="hidden" class="form-control form-control-sm" name="b_gd" id="b_gd3">
									<select class="form-control form-control-sm select2" style="width: 100%;" name="gudang" id="gudang3" required>
										
										<option value="-1">Proses SJ</option>
										<option value="0">Kopi</option>
										
										<?PHP
										
										foreach ($gudang as $gd)
										{?>
										<option value="<?php echo $gd->id?>"><?PHP echo $gd->gudang?></option>
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
								  <input type="submit" name="save" value="Simpan" class="btn btn-primary proses_selesai3">
								</div>
							
						</form>
						</div>

					  </div>
					  <!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<div class="modal fade" id="modal_selesai2" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
					<div class="modal-dialog modal-lg">
					  <div class="modal-content">
						<div class="modal-header">
						  <h4 class="modal-title">Selesai Muat</h4>
						  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
						</div>
						<div class="modal-body">
						<form class="form-horizontal selesai_muat2"  method="post" id="selesai_muat2">
							<input type="hidden" name="id" id="id_muat2"></input>							
							<div class="form-group row">
								<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">No Do</label>
								<div class="col-sm-9">
									<input type="text"  class="form-control form-control-sm" id="nodo3" readonly>
									<input type="hidden"  class="form-control form-control-sm" placeholder="No DO" name="nodo" id="nodo4">
								</div>
							</div>
							<div class="form-group row table-responsive">
								<table id="tabels2" class="table table-striped table-bordered">
									<thead>
										<th>Itemid</th>
										<th>Description</th>
										<th>Qty</th>
										<th>Cek</th>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
							
							
							<div class="col-3">
							  </div>
							  <div class="modal-footer justify-content-between">
								  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								  <input type="submit" name="save" value="Simpan" class="btn btn-primary proses_selesai2">
								</div>
							
						</form>
						</div>

					  </div>
					  <!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
			</div>
			
		</div>
		<!-- page content -->
	</body>
	<script type="text/javascript">
		$(document).ready(function() {
			//$('#tabel1').dataTable();
			//$('#tabel2').DataTable();
			$('#tabel3').DataTable({});
		} );
		$( "#register" ).submit(function( event ) {
			  $("#proses_regis").prop('disabled', 'true');
		});
		$( ".muat" ).submit(function( event ) {
			  $(".proses_muat").prop('disabled', 'true');
		});
		$( ".selesai_muat" ).submit(function( event ) {
			  $(".proses_selesai").prop('disabled', 'true');
		});
		$( ".selesai_muat2" ).submit(function( event ) {
			  $(".proses_selesai2").prop('disabled', 'true');
		});
		$( ".edit" ).submit(function( event ) {
			 $(".proses_edit").prop('disabled', 'true');
		});
		$('.selesai').on('click', function (){
			$(".selesai").prop('disabled', 'true');
			var id_antrian	= $(this).attr("data-idantrian"); 
			var id_muat 	= $(this).attr("data-idmuat");
			var nodo		= $(this).attr("data-nodo");
			$('#nodo').val(nodo);
			$('#nodo2').val(nodo);
			$('#id_antrian').val(id_antrian);
			$('#id_muat').val(id_muat);
				$.ajax({
					type : "POST",
					url  : "<?= site_url('adm3/get_dtl_do')?>",
					dataType : "text",
					data : {id_antrian:id_antrian,
							id_muat:id_muat,
							nodo:nodo,
							"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>",
							},
					 success: function(response){
						$("#selesai_muat").attr("action", "<?= $form3 ?>");
						var i=0;
						var html='';
						var obj = jQuery.parseJSON(response); 
						$("#tabels > tbody").html("");
						for(i=0;i<obj.length;i++)
						{
							var cek='';
							if(obj[i].id_muat==null)
							{
								
								cek='<input type="checkbox" name="cek[]" value="'+obj[i].SysDO+'~'+obj[i].Sys+'~'+obj[i].LineNo+'">';
							}
							else
							{
								cek='';
							}
							html+='<tr><td>'+obj[i].ItemID+'</td><td>'+obj[i].Description+'</td><td>'+obj[i].QtyDO+'</td><td>'+cek+'</td></tr>';
						}
						$('#tabels').find('tbody').append(html);

						$('#modal_selesai').modal('show');
					 },
					 error: function (err) {
					console.log("AJAX error in request: " + JSON.stringify(err, null, 2));
				}
				})
		});
		$('.edit_muat').on('click', function (){
			$(".edit_muat").prop('disabled', 'true');
			var gd = $(this).attr("data-gd"); 
			var id_muat  = $(this).attr("data-idmuat");
			var nodo 	= $(this).attr("data-nodo");
			$('#nodo5').val(nodo);
			$('#nodo6').val(nodo);
			$('#id_muat3').val(id_muat);
			$('#b_gd3').val(gd);
			$("#gudang3 option[value='"+gd+"']").prop('selected', true);
			$("#selesai_muat3").attr("action", "<?= $form2 ?>");
			$('#modal_selesai3').modal('show');
		});
		$('.edit_muat2').on('click', function (){
			$(".edit_muat2").prop('disabled', 'true');
			var id_muat  = $(this).attr("data-idmuat");
			var nodo 	= $(this).attr("data-nodo");
			$('#nodo3').val(nodo);
			$('#nodo4').val(nodo);
			$('#id_muat2').val(id_muat);
				$.ajax({
					type : "POST",
					url  : "<?= site_url('adm3/get_dtl_do')?>",
					dataType : "text",
					data : {id_muat:id_muat,nodo:nodo,"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>",},
					 success: function(response){
						$("#selesai_muat2").attr("action", "<?= $form4 ?>");
						var i=0;
						var html='';
						var obj = jQuery.parseJSON(response); 
						console.log(nodo);
						$("#tabels2 > tbody").html("");
						for(i=0;i<obj.length;i++)
						{
							var cek='';
							if(obj[i].id_muat==id_muat)
							{
								cek='<input type="checkbox" name="cek[]" value="'+obj[i].SysDO+'~'+obj[i].Sys+'~'+obj[i].LineNo+'" checked>';
							}
							else
							{
								if(obj[i].id_muat==null)
								{
									cek='<input type="checkbox" name="cek[]" value="'+obj[i].SysDO+'~'+obj[i].Sys+'~'+obj[i].LineNo+'">';
								}
								else
								{
									cek='';									
								}
								
							}
							html+='<tr><td>'+obj[i].ItemID+'</td><td>'+obj[i].Description+'</td><td>'+obj[i].QtyDO+'</td><td>'+cek+'</td></tr>';
						}
						$('#tabels2').find('tbody').append(html);

						$('#modal_selesai2').modal('show');
					 },
					 error: function (err) {
					console.log("AJAX error in request: " + JSON.stringify(err, null, 2));
				}
				})
		});
		
	</script>
</html>