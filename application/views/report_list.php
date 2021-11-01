<html lang="en">
	<head>
		<title>Laporan Muat</title>
		
	</head>
	<body class="nav-md" >

		<div class="right_col" role="main">
			<div class="page-title">
				
				<div class="title_right">
				</div>
			</div>
			<div class="row">	  
				<div class="col-md-12 col-xs-12">
						<div class="x_panel">
							<div class="x_title">
								<h2>List <?php echo ! empty($title) ? $title : '';?></h2>
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
								?>
							</div>
					</div>
				</div>			
		
			</div>
			
				
		</div>
		</body>
</html>