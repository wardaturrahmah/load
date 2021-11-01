<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Create Area</title>
	</head>
	<body class="nav-md">
		<!-- page content -->
        <div class="right_col" role="main">
            <div class="page-title">
				<div class="title_left">
					<h3>Form Create Area </h3>
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
							<h2>Creat Area</h2>
							<ul class="nav navbar-right panel_toolbox">
								<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
								</li>
							</ul>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<form class="form-horizontal form-label-left" action="<?php echo $form?>" method="post">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">Area</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input name="area" type="text" class="form-control" placeholder=""  required="required">
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
							<h2>Tabel List Area</h2>
							<ul class="nav navbar-right panel_toolbox">
								<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
								</li>
							</ul>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<table id="datatable" class="table table-striped table-bordered">
								<thead>
									<th>Area</th>
								</thead>
								<?php
								foreach($tabel as $tb)
								{
									$action='';
									
									echo '<tr>';
									echo '<td>'.$tb->area.'</td>';
								
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