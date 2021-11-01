<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Edit Password</title>
	</head>
	<body class="nav-md">
		<!-- page content -->
        <div class="right_col" role="main">
            <div class="page-title">
				<div class="title_left">
					<h3>Form User </h3>
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
							<h2>Edit Password</small></h2>
							<ul class="nav navbar-right panel_toolbox">
								<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
								</li>
							</ul>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<form class="form-horizontal form-label-left" action="<?php echo $form2?>" method="post">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">User</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input name="user" type="text" class="form-control" placeholder="User" value="<?php echo $user;?>" readonly="readonly">
									</div>
								</div>
								<div class="item form-group">
									<label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">Password Lama</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input id="password" type="password" name="password3" class="form-control col-md-7 col-xs-12">
									</div>
									<div class="col-md-3 col-sm-3 col-xs-12 col-md-offset-3">
										<div class="red"id="notice">
											<?php if($this->session->userdata('parid')!=''){
												echo "Maaf Password lama Salah";
												}
											?>
										</div>
									</div>
								</div>
								<div class="item form-group">
									<label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">Password baru</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input id="password" type="password" name="password4" class="form-control col-md-7 col-xs-12">
									</div>
								</div>
								<div class="item form-group">
									<label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Repeat Password</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input id="password2" type="password" name="password5" data-validate-linked="password4" class="form-control col-md-7 col-xs-12" required="required">
									</div>
								</div>						  
								<div class="ln_solid"></div>
								<div class="form-group">
									<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
										<button type="submit" class="btn btn-success">Submit</button>
										<button type="reset" class="btn btn-primary">Reset</button>
										<button type="button" class="btn btn-primary">Cancel</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>	
			
				
		</div>
		<!-- page content -->
	</body>
</html>