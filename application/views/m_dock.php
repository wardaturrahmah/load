<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Dock</title>
	</head>
	<body class="nav-md">
		<!-- page content -->
        <div class="right_col" role="main">
            <div class="page-title">
				<div class="title_left">
					<h3>Form Dock </h3>
				</div>
				<div class="title_right">
					<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
					</div>
				</div>
            </div>
            <div class="clearfix"></div>
			<?php if($auth->c==1)
			{?>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<h2>Create Dock</h2>
							<ul class="nav navbar-right panel_toolbox">
								<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
								</li>
							</ul>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<form class="form-horizontal form-label-left" action="<?php echo $form?>" method="post">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">Dock</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input name="dock" type="text" class="form-control" placeholder="Dock"  required="required">
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">Group</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<select class="form-control" name="gudang">
											<?php
											foreach ($gudang as $gr)
											{
												echo '<option value="'.$gr->id.'">'.$gr->gudang.'</option>';
											}
											?>
										</select>
									</div>
								</div>
								<div class="ln_solid"></div>
								<div class="form-group">
									<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
										<button type="submit" class="btn btn-success">Submit</button>
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
							<h2>Tabel List Dock</h2>
							<ul class="nav navbar-right panel_toolbox">
								<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
								</li>
							</ul>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<table id="datatable" class="table table-striped table-bordered">
								<thead>
									
									<th>Gudang</th>
									<th>Dock</th>
									<th>Checker</th>
									<th>Status</th>
									<th>Action</th>
								</thead>
								<?php
								foreach($tabel as $tb)
								{
									$action='';
									
									echo '<tr>';
									echo '<td>'.$tb->gudang.'</td>';
									echo '<td>'.$tb->dock.'</td>';
									echo '<td>'.$tb->checker.'</td>';
									if($tb->status==1)
									{
										$status='Aktif';
										if($auth->u==1)
										{
											$kt="return confirm('Anda yakin akan menonaktifkan dock ini?')";
											$action.='<a href="'.base_url('c_user/edit_dock').'/'.$tb->id_dock.'~0~'.$auth->id.'" onclick="'.$kt.'">
											<button class="btn btn-danger">											
											<i class="fa fa-times" style="color:#DDDDDD;"></i></button></a>';
										}
									}
									else
									{
										$status='Non Aktif';
										if($auth->u==1)
										{
											$kt="return confirm('Anda yakin akan mengaktifkan dock ini?')";
											$action.='<a href="'.base_url('c_user/edit_dock').'/'.$tb->id_dock.'~1~'.$auth->id.'" onclick="'.$kt.'">
											<button class="btn btn-success">											
											<i class="fa fa-check" style="color:#DDDDDD;"></i></button></a>';
										}
									}
									if($auth->u==1)
									{
										$action.='<button type="button" class="btn btn-info" 
										data-toggle="modal" data-target="#modal_edit_'.$tb->id_dock.'">
										<a><i class="fa fa-edit blue" style="color:#DDDDDD;"></i></a></button>';
									}
									echo '<td>'.$status.'</td>';
									echo '<td>'.$action.'</td>';
								?>
								<div class="modal fade" id="modal_edit_<?echo $tb->id_dock?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
										<div class="modal-dialog">
										  <div class="modal-content">
											<div class="modal-header">
											  <h4 class="modal-title">Edit Dock</h4>
											  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											  </button>
											</div>
											<div class="modal-body">
											  <form class="form-horizontal" action="<?php echo $form2; ?>" method="post" id="form1">
												<input type="hidden" value="<?php echo $tb->id_dock ?>" name="id"></input>
												<div class="form-group row">
													<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Gudang</label>
													<div class="col-sm-9">
														<input type="text" value="<?php echo $tb->gudang ?>" class="form-control form-control-sm" name="gudang" required="" readonly>
													</div>
												</div>
												<div class="form-group row">
													<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Dock</label>
													<div class="col-sm-9">
														<input type="text" value="<?php echo $tb->dock ?>" class="form-control form-control-sm" name="dock" required="" readonly>
													</div>
												</div>
												<div class="form-group row">
													<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Checker</label>
													<div class="col-sm-9">
														<input type="text" value="<?php echo $tb->checker ?>" class="form-control form-control-sm" placeholder="Checker" name="checker" required="">
													</div>
												</div>
												<div class="col-3">
												  </div>
												  <div class="modal-footer justify-content-between">
													  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													  <input type="submit" name="save" value="update" class="btn btn-primary">
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
	</body>
</html>