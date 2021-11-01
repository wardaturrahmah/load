<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Setting Access Menu</title>
	</head>
	<body class="nav-md">
		<!-- page content -->
        <div class="right_col" role="main">
            <div class="page-title">
				<div class="title_left">
					<h3>Setting Access Menu</h3>
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
							<h2>Akses <?php echo $id_user;?></h2>
							<ul class="nav navbar-right panel_toolbox">
								<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
								</li>
							</ul>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<form class="form-horizontal form-label-left" action="<?php echo $form?>" method="post">
								<table class=" table table-bordered">
									<thead>
										<th><center>Gudang</center></th>
										<th><center>Akses</center></th>
										
									</thead>
									<input type="hidden" name="id_user" value="<?php echo $id_user;?>">
									<?php
										foreach ($tabel as $tb)
										{
											echo '<tr>';
											echo '<td>'.$tb->gudang.'</td>';
											if(strtolower($tb->id_user)==strtolower($id_user))
											{
												$c='checked="checked"';
												$cv=1;
											}
											else
											{
												$c="";
												$cv=0;
											}
											$name1="c-".$tb->id;
											echo '<td><input name="'.$name1.'" type="checkbox" '.$c.' value="'.$cv.'"></td>';
											echo '</tr>';
										}
									?>
								</table>
								
								<div class="ln_solid"></div>
								<div class="form-group">
									<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
										<button type="submit" class="btn btn-success">Submit</button>
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