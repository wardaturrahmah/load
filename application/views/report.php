<html lang="en">
	<head>
		<title>Laporan Muat</title>
		<style type="text/css">
		table {
		  text-align: left;
		  position: relative;
		}

		th {
		  background: white;
		  position: sticky;
		  top: 0;
		}
	</style>
	</head>
	<body class="nav-md" >

<?php
	$this->load->model('master_model', 'master', TRUE);
	$this->load->model('login_model', 'login', TRUE);
?>	
		<div class="right_col" role="main">
			<div class="page-title">
				
				<div class="title_right">
				</div>
			</div>
			<div class="row">	  
				<div class="col-md-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<h2>Laporan muat</h2>
							<ul class="nav navbar-right panel_toolbox">
								<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
								</li>
							</ul>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<br />
							<form class="form-horizontal form-label-left" action="<?php echo $form?>" method="post">
								
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal</label>
									<div class='col-sm-4'>
										<div class="form-group">
											<div class='input-group date' id='myDatepicker'>
												<input type='text' class="form-control" name="tgl_awal" value="<?php echo  isset($tgl_awal) ? $tgl_awal : ''; ?>"/>
												<span class="input-group-addon">
												   <span class="glyphicon glyphicon-calendar"></span>
												</span>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Akhir</label>
									<div class='col-sm-4'>
										<div class="form-group">
											<div class='input-group date' id='myDatepicker2'>
												<input type='text' class="form-control" name="tgl_akhir" value="<?php echo  isset($tgl_akhir) ? $tgl_akhir : ''; ?>"/>
												<span class="input-group-addon">
												   <span class="glyphicon glyphicon-calendar"></span>
												</span>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">Group</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<select class="form-control" name="gudang">
											<?php
											foreach ($gudang as $gr)
											{
												if($gd == $gr->id)
												{
													$sel="selected";
												}
												else
												{
													$sel="";
												}	
												
												echo '<option '.$sel.' value="'.$gr->id.'">'.$gr->gudang.'</option>';
											}
											?>
										</select>
									</div>
								</div>
								
								<div class="ln_solid"></div>
								<div class="form-group">
									<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
										<input type="submit" class="btn btn-success" value="Submit" onclick="javascript: form.action='<?php echo $form?>';"/>
										<input type="submit" class="btn btn-info" value="Excel" onclick="javascript: form.action='<?php echo $form2?>';"/>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="row">	  
				<div class="col-md-12 col-xs-12">
						<div class="x_panel">
							<div class="x_title">
								<h2>List</h2>
								<ul class="nav navbar-right panel_toolbox">
									<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
									</li>
								</ul>
								<div class="clearfix"></div>
							</div>
						
							<div class="x_content">
								<br />
								<?php
								echo date('Y-m-d H:i:s').'</br>';
								echo ! empty($table) ? $table : '';
							/* 	$tgl1=date('Y-m-d',strtotime($tgl1));
								$tgl2=date('Y-m-d',strtotime($tgl2));
								$listed=$this->master->report_waktu_muat($gd,$tgl1,$tgl2)->result();//ganti
								if(count($listed)>0)
								{
									echo '<div style="overflow-x:auto;overflow-y:auto;height:350px;">';
									echo '<table class="table table-bordered">';
										echo '<thead>';
											echo '<th>No Do</th>';
											echo '<th>Jam Antrian</th>';
											echo '<th>Jam Muat</th>';
											echo '<th>Jam Selesai Muat</th>';
											
											
										echo '</thead>';
										
										foreach($listed as $list)
										{
											echo '<tr>';
												echo '<td>'.$list->do_.'</td>';
												echo '<td>'.date('d-m-Y H:i',strtotime($list->jam_antri)).'</td>';
												echo '<td>'.date('d-m-Y H:i',strtotime($list->jam_muat)).'</td>';
												echo '<td>'.date('d-m-Y H:i',strtotime($list->selesai_muat)).'</td>';
												
												
											echo '</tr>';
										}
										
									echo '</table>';
									echo '</div>';
								} */
								?>
							</div>
					</div>
				</div>			
		
			</div>
			
				
		</div>
		</body>
</html>