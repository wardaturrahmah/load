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
		.pointer {cursor: pointer;}
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
							<h2>Laporan <?php echo $title;?></h2>
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
								<h2>List <?php echo $title;?></h2>
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
								?>
								<table id="datatable" class="table table-striped table-bordered">
									<thead>
										<td>Gudang</td>
										<td>Dock</td>
										<td>DO</td>
										<td>Jam Muat</td>
										<td>Jam Selesai Muat</td>
										<td>Lama muat (Menit)</td>
										<td>Total QTY</td>
									</thead>
									<tbody>
										<?php
										foreach ($listed as $row)
										{
											echo '<tr>';
											echo '<td>'.$row->gudang.'</td>';
											echo '<td>'.$row->dock.'</td>';
											echo '<td>'.$row->do_.'</td>';
											echo '<td>'.date('Y-m-d H:i:s',strtotime($row->jam_muat)).'</td>';
											echo '<td>'.date('Y-m-d H:i:s',strtotime($row->selesai_muat)).'</td>';
											echo '<td>'.$row->lama.'</td>';
											echo "<td  class='pointer' data-nodo='".$row->do_."' data-id='".$row->id."' data-gudang='".$row->gudang."' data-dock='".$row->dock."' data-mulai='".date('Y-m-d H:i:s',strtotime($row->jam_muat))."' data-selesai='".date('Y-m-d H:i:s',strtotime($row->selesai_muat))."' data-lama='".$row->lama."'><u>".round($row->qty)."</u></td>";
											echo '</tr>';
										}
										?>
									</tbody>
								</table>
							</div>
					</div>
				</div>			
		
			</div>
			
				
		</div>
		<div class="modal fade bd-example-modal-lg" id="info" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Informasi <span id="do"></span></h5>
					
					</div>
					<div class="modal-body">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary keluarKopiDo" data-dismiss="modal">Close</button>
					</div>
				</div>
				
			</div>
		</div>
		<script>
		
		$("#datatable tr td:nth-child(7)").click(function () {
			  var id = $(this).attr('data-id');
			  var nodo = $(this).attr('data-nodo');
			  var gudang = $(this).attr('data-gudang');
			  var dock = $(this).attr('data-dock');
			  var mulai = $(this).attr('data-mulai');
			  var selesai = $(this).attr('data-selesai');
			  var lama = $(this).attr('data-lama');
			  $.ajax({
				type : "POST",
				url  : "<?= site_url('report/dtl_qty')?>",
				dataType : "text",
				data : {id:id},
				 success: function(response){
					var object=jQuery.parseJSON(response);
					var html='';
					html+='<table class="table table-bordered">';
					html+='<tr><td>No DO</td><td>'+nodo+'</td></tr>';
					html+='<tr><td>Gudang</td><td>'+gudang+'</td></tr>';
					html+='<tr><td>Dock</td><td>'+dock+'</td></tr>';
					html+='<tr><td>Mulai muat</td><td>'+mulai+'</td></tr>';
					html+='<tr><td>Selesai muat</td><td>'+selesai+'</td></tr>';
					html+='<tr><td>Lama muat</td><td>'+lama+'</td></tr>';
					html+='</table>';
				
					html+='</br>';
					html+='<table class="table table-striped table-bordered">';
					html+='<tr>';
					html+='<td><center><b>Description</b></center></td>';
					html+='<td><center><b>QTY</b></center></td>';
					html+='<td><center><b>Unit</b></center></td>';
					html+='</tr>';
					var sum=0;
					for(var i=0;i<object.length;i++)
					{
						sum+=Math.round(object[i].QtyDO);
						html+='<tr>';
						html+='<td>'+object[i].Description+'</td>';
						html+='<td>'+Math.round(object[i].QtyDO)+'</td>';
						html+='<td>'+object[i].UnitID+'</td>';
						html+='</tr>';
					}
						html+='<tr>';
						html+='<td><b>Total</b></td>';
						html+='<td colspan="2">'+sum+'</td>';
						html+='</tr>';
					$('.modal-body').html(html);
					$('#do').html(nodo);	
					$('#info').modal('show'); 
				 },
				 error: function (err) {
				console.log("AJAX error in request: " + JSON.stringify(err, null, 2));
			}
			})
		})
		</script>
		</body>
</html>