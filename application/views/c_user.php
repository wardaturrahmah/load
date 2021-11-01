<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Create User</title>
	</head>
	<body class="nav-md">
		<!-- page content -->
        <div class="right_col" role="main">
            <div class="page-title">
				<div class="title_left">
					<h3>Form Create User </h3>
				</div>
				<div class="title_right">
					<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
					</div>
				</div>
            </div>
            <div class="clearfix"></div>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<h2>Creat User</h2>
							<ul class="nav navbar-right panel_toolbox">
								<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
								</li>
							</ul>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<form class="form-horizontal form-label-left" action="<?php echo $form?>" method="post">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">User</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input name="user" type="text" class="form-control" placeholder="User"  required="required">
									</div>
								</div>
								<div class="item form-group">
									<label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">Password</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input id="password" type="password" name="password" class="form-control col-md-7 col-xs-12">
									</div>
								</div>
								<div class="item form-group">
									<label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Repeat Password</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input id="password2" type="password" name="password2" data-validate-linked="password" class="form-control col-md-7 col-xs-12" required="required">
									</div>
								</div>						  
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">Group</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<select class="form-control" name="grup" id="grup">
											<?php
											foreach ($grup as $gr)
											{
												echo '<option value="'.$gr->id.'">'.$gr->group_.'</option>';
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
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<h2>Tabel List User</h2>
							<ul class="nav navbar-right panel_toolbox">
								<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
								</li>
							</ul>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<table id="datatable" class="table table-striped table-bordered">
								<thead>
									<th>User Name</th>
									<th>Group</th>
									<th>Action</th>
								</thead>
								<?php
								foreach($tabel as $tb)
								{
									$action='';
									if($auth->u==1)
									{
										$action.='<button type="button" class="btn btn-info" 
										data-toggle="modal" data-target="#modal_edit_'.$tb->Username.'">
										<a><i class="fa fa-edit blue" style="color:#DDDDDD;"></i></a></button>';
										$action.='<a href="'.base_url('c_area/user').'/'.$tb->Username.'" target="_blank">
											<button class="btn btn-primary">											
											<i class="fa fa-edit" style="color:#DDDDDD;">Area</i></button></a>';
										$action.='<a href="'.base_url('c_area/gd').'/'.$tb->Username.'" target="_blank">
											<button class="btn btn-success">
											<i class="fa fa-edit" style="color:#DDDDDD;">Gudang</i></button></a>';
									}
									echo '<tr>';
									echo '<td>'.$tb->Username.'</td>';
									echo '<td>'.$tb->group_.'</td>';
									echo '<td>'.$action.'</td>';
								?>
								<div class="modal fade" id="modal_edit_<?echo $tb->Username?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
										<div class="modal-dialog">
										  <div class="modal-content">
											<div class="modal-header">
											  <h4 class="modal-title">Edit User</h4>
											  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											  </button>
											</div>
											<div class="modal-body">
											  <form class="form-horizontal" action="<?php echo $form2; ?>" method="post" id="form1">
												<input type="hidden" value="<?php echo $tb->Username ?>" name="id"></input>
												<input type="hidden" value="<?php echo $default['menu'] ?>" name="menu"></input>
												<div class="form-group row">
													<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Nama</label>
													<div class="col-sm-9">
														<input type="text" value="<?php echo $tb->Username ?>" class="form-control form-control-sm" id="inputName" placeholder="Name" name="name" required="" readonly>
													</div>
												</div>
												<div class="form-group row">
													<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Group</label>
													<div class="col-sm-9">
														<select class="form-control form-control-sm select2" style="width: 100%;" name="grup" id="grup">
															<?PHP
															foreach ($grup as $gr)
															{?>
															<option <?php echo $gr->id == $tb->id ? 'selected="selected"' : '' ?> value="<?php echo $gr->id?>"><?PHP echo $gr->group_?></option>
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
		<script type="text/javascript">
			$(document).ready(function() {
			$('#grup').select2();
			});

		</script>
	</body>
</html>