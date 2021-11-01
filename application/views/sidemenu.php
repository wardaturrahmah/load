<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="images/favicon.ico" type="image/ico" />
		<!-- Bootstrap -->
		<link href="<?php echo base_url();?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="<?php echo base_url();?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<!-- NProgress -->
		<link href="<?php echo base_url();?>assets/vendors/nprogress/nprogress.css" rel="stylesheet">
		<!-- iCheck -->
		<link href="<?php echo base_url();?>assets/vendors/iCheck/skins/flat/green.css" rel="stylesheet">		
		<!-- bootstrap-progressbar -->
		<link href="<?php echo base_url();?>assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
		<!-- JQVMap -->
		<link href="<?php echo base_url();?>assets/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
		<!-- bootstrap-daterangepicker -->
		<link href="<?php echo base_url();?>assets/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
		<!-- bootstrap-datetimepicker -->
		<link href="<?php echo base_url();?>assets/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
		<!-- bootstrap-wysiwyg -->
		<link href="<?php echo base_url();?>assets/vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
		<!-- Select2 -->
		<link href="<?php echo base_url();?>assets/vendors/select2/dist/css/select2.min.css" rel="stylesheet">
		<!-- Switchery -->
		<link href="<?php echo base_url();?>assets/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
		<!-- starrr -->
		<link href="<?php echo base_url();?>assets/vendors/starrr/dist/starrr.css" rel="stylesheet">
		<!-- Datatables -->
		<link href="<?php echo base_url();?>assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">	 
		<!-- Custom Theme Style -->
		<link href="<?php echo base_url();?>assets/build/css/custom.min.css" rel="stylesheet">
		<!--Highchart-->
		<script src="<?php echo base_url();?>assets/highcharts/code/highcharts.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery-3.3.1.min.js" type="text/javascript"></script>

	</head>
	<body class="nav-md">
		<div class="container body">
			<div class="main_container">
				<div class="col-md-3 left_col">
					<div class="left_col scroll-view">
						<div class="navbar nav_title" style="border: 0;">
							<a class="site_title"> <span>MUAT</span></a>
						</div>

						<div class="clearfix"></div>
						<br />
						<?php
						$menu=$this->login->menu_group($this->session->userdata('group_gdg'))->result();
						
						?>
						<!-- sidebar menu -->
						
						<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
							<div class="menu_section">
								<?php foreach($menu as $m1)
								{
									if($m1->type==1)
									{
								?>
								<ul class="nav side-menu">
									<li><a><?php echo $m1->nama?><span class="fa fa-chevron-down"></span></a>
										<ul class="nav child_menu">
										<?
										foreach ($menu as $m2)
										{
											if($m2->parent==$m1->id_menu)
											{
										?>
										
											<li><a href="<?echo base_url().$m2->url;?>"><?php echo $m2->nama?></a></li>
										
										
										<?php
											}
										}
										?>
										</ul>
									</li>
								</ul>
								<?
									}
								}
								?>
								
							</div>
						</div>
						<!-- /sidebar menu -->
					</div>
				</div>
				<!-- top navigation -->
				<div class="top_nav">
					<div class="nav_menu">
						<nav>
							<div class="nav toggle">
								<a id="menu_toggle"><i class="fa fa-bars"></i></a>
							</div>
							
							<ul class="nav navbar-nav navbar-right">
								<li class="">
									<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
										<?php echo $this->session->userdata('nama_gdg');?>
										<span class=" fa fa-angle-down"></span>
									</a>
									<ul class="dropdown-menu dropdown-usermenu pull-right">
										<li><a href="<?echo base_url('/');?>c_user/edit_form">Ganti Password</a></li>
									
										<li><a href="<?echo base_url();?>/index.php/login/process_logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
									</ul>
								</li>
							<li class="">
								  <a  class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">PT.SIANTAR TOP TBK</a>
								</li>								
							</ul>
						</nav>
					</div>
				</div>
				<!-- /top navigation -->
				<!-- page content -->
				<?php echo $this->load->view($main_view); ?>
				<!-- /page content -->

       
			</div>
		</div>
		<!-- jQuery -->
		<script src="<?php echo base_url();?>assets/vendors/jquery/dist/jquery.min.js"></script>
		<!-- Bootstrap -->
		<script src="<?php echo base_url();?>assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
		<!-- FastClick -->
		<script src="<?php echo base_url();?>assets/vendors/fastclick/lib/fastclick.js"></script>
		<!-- NProgress -->
		<script src="<?php echo base_url();?>assets/vendors/nprogress/nprogress.js"></script>
		<!-- bootstrap-progressbar -->
		<script src="<?php echo base_url();?>assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
		<!-- iCheck -->
		<script src="<?php echo base_url();?>assets/vendors/iCheck/icheck.min.js"></script>
		<!-- Skycons -->
		<script src="<?php echo base_url();?>assets/vendors/skycons/skycons.js"></script>
		<!-- Flot -->
		<script src="<?php echo base_url();?>assets/vendors/Flot/jquery.flot.js"></script>
		<script src="<?php echo base_url();?>assets/vendors/Flot/jquery.flot.pie.js"></script>
		<script src="<?php echo base_url();?>assets/vendors/Flot/jquery.flot.time.js"></script>
		<script src="<?php echo base_url();?>assets/vendors/Flot/jquery.flot.stack.js"></script>
		<script src="<?php echo base_url();?>assets/vendors/Flot/jquery.flot.resize.js"></script>
		<!-- Flot plugins -->
		<script src="<?php echo base_url();?>assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
		<script src="<?php echo base_url();?>assets/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
		<script src="<?php echo base_url();?>assets/vendors/flot.curvedlines/curvedLines.js"></script>
		<!-- DateJS -->
		<script src="<?php echo base_url();?>assets/vendors/DateJS/build/date.js"></script>
		<!-- JQVMap -->
		<script src="<?php echo base_url();?>assets/vendors/jqvmap/dist/jquery.vmap.js"></script>
		<script src="<?php echo base_url();?>assets/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
		<script src="<?php echo base_url();?>assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
		<!-- bootstrap-daterangepicker -->
		<script src="<?php echo base_url();?>assets/vendors/moment/min/moment.min.js"></script>
		<script src="<?php echo base_url();?>assets/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
		<!-- bootstrap-datetimepicker -->    
		<script src="<?php echo base_url();?>assets/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
		
		<!-- bootstrap-wysiwyg -->
		<script src="<?php echo base_url();?>assets/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
		<script src="<?php echo base_url();?>assets/vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
		<script src="<?php echo base_url();?>assets/vendors/google-code-prettify/src/prettify.js"></script>
		<!-- jQuery Tags Input -->
		<script src="<?php echo base_url();?>assets/vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
		<!-- Switchery -->
		<script src="<?php echo base_url();?>assets/vendors/switchery/dist/switchery.min.js"></script>
		<!-- Select2 -->
		<script src="<?php echo base_url();?>assets/vendors/select2/dist/js/select2.full.min.js"></script>
		<!-- Parsley -->
		<script src="<?php echo base_url();?>assets/vendors/parsleyjs/dist/parsley.min.js"></script>
		<!-- Autosize -->
		<script src="<?php echo base_url();?>assets/vendors/autosize/dist/autosize.min.js"></script>
		<!-- jQuery autocomplete -->
		<script src="<?php echo base_url();?>assets/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
		<!-- starrr -->
		<script src="<?php echo base_url();?>assets/vendors/starrr/dist/starrr.js"></script>
		<!-- validator -->
		<script src="<?php echo base_url();?>assets/vendors/validator/validator.js"></script>
		<!-- Datatables -->
		<script src="<?php echo base_url();?>assets/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url();?>assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
		<script src="<?php echo base_url();?>assets/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>assets/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
		<script src="<?php echo base_url();?>assets/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
		<script src="<?php echo base_url();?>assets/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
		<script src="<?php echo base_url();?>assets/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
		<script src="<?php echo base_url();?>assets/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
		<script src="<?php echo base_url();?>assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
		<script src="<?php echo base_url();?>assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
		<script src="<?php echo base_url();?>assets/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
		<script src="<?php echo base_url();?>assets/vendors/jszip/dist/jszip.min.js"></script>
		<script src="<?php echo base_url();?>assets/vendors/pdfmake/build/pdfmake.min.js"></script>
		<script src="<?php echo base_url();?>assets/vendors/pdfmake/build/vfs_fonts.js"></script>
		<!-- Custom Theme Scripts -->
		<script src="<?php echo base_url();?>assets/build/js/custom.min.js"></script>
			<script>


/* $("#single_cal2").on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY-MM-DD'));
}); */
$('#myDatepicker').datetimepicker({
        format: 'DD-MM-YYYY'
    });
    $('#myDatepicker2').datetimepicker({
        format: 'DD-MM-YYYY'
    });
    $('#myDatepicker3').datetimepicker({
        format: 'DD-MM-YYYY'
    });
    
    $('#myDatepicker4').datetimepicker({
        format: 'DD-MM-YYYY'
    });

    $('#datetimepicker6').datetimepicker();
    
    $('#datetimepicker7').datetimepicker({
        useCurrent: false
    });
    
    $("#datetimepicker6").on("dp.change", function(e) {
        $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
    });
    
    $("#datetimepicker7").on("dp.change", function(e) {
        $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
    });
</script>
	
		</body>
	<!-- footer content -->
	<footer>
		<div class="pull-right">
			Developed By IT 2020
        </div>
		<div class="clearfix"></div>
    </footer>
    <!-- /footer content -->
      
</html>
