<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class report extends CI_Controller {
	function __construct() {
        parent::__construct();
		$this->load->model('master_model', 'master', TRUE);
		$this->load->model('login_model', 'login', TRUE);
	}
	public function index()
	{
		$this->report_muat();
	}
	function cek_login()
	{
		if(($this->session->userdata('login_gdg')!=TRUE) )
		{
			redirect('login');
		}
		
	}
	function checkaut($idmenu){
		
		$auth = $this->login->checkaut($idmenu)->row();
		return $auth;
		
	}
	function report_muat()
	{
		$this->cek_login();
		$data['main_view']='report';
		$data['gudang']=$this->master->gudang_list()->result();
		$data['form']=site_url('report/report_muat');
		$data['form2']=site_url('report/excel_report_muat');
		if($this->input->post('tgl_awal'))
		{

			$data['tgl_awal']=$this->input->post('tgl_awal');
			$data['tgl_akhir']=$this->input->post('tgl_awal');
			$data['gd']=$this->input->post('gudang');
			
		}
		else
		{
			$data['tgl_awal']=date('Y-m-d');
			$data['tgl_akhir']=date('Y-m-d');
			$data['gd']=1;
		}
				$tmpl = array( 'table_open'    => '<table id="datatable" class="table table-striped table-bordered">',
					  'row_alt_start'  => '<tr>',
						'row_alt_end'    => '</tr>'
					  );
		$this->table->set_template($tmpl);

	
		// header table
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('Dock','NO DO','Jam Muat','Jam Selesai Muat');
		$tgl_awal=date('Y-m-d',strtotime($data['tgl_awal']));
		$tgl_akhir=date('Y-m-d',strtotime($data['tgl_akhir']));
		$listed=$this->master->report_waktu_muat($data['gd'],$tgl_awal,$tgl_akhir)->result();//ganti
		$listed=$this->master->report_waktu_muat($data['gd'],$tgl_awal,$tgl_akhir)->result();//ganti
		foreach ($listed as $row)
		{
			$this->table->add_row($row->dock,$row->do_,date('Y-m-d H:i:s',strtotime($row->jam_muat)),date('Y-m-d H:i:s',strtotime($row->selesai_muat)));
		}
		$data['table'] = $this->table->generate();
		$this->load->view('sidemenu',$data);
	}
	function excel_report_muat()
	{
		
		$this->load->library("excel");
		$object = new PHPExcel();
		$tgl1=date("Y-m-d",strtotime($this->input->post('tgl_awal')));
		$tgl2=date("Y-m-d",strtotime($this->input->post('tgl_awal')));
		$gd=$this->input->post('gudang');
		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
		$listed=$this->master->report_waktu_muat($gd,$tgl1,$tgl2)->result();
		if(count($listed)>0)
		{
			$row=1;
			$object->getActiveSheet()->setCellValueByColumnAndRow(0, $row,'Antrian');
			$object->getActiveSheet()->setCellValueByColumnAndRow(1, $row,'Jam Antrian');
			$object->getActiveSheet()->setCellValueByColumnAndRow(2, $row,'Jam Muat');
			$object->getActiveSheet()->setCellValueByColumnAndRow(3, $row,'Jam Selesai Muat');
			$object->getActiveSheet()->setCellValueByColumnAndRow(4, $row,'No Do');
			$object->getActiveSheet()->setCellValueByColumnAndRow(5, $row,'Macem Item');
			$object->getActiveSheet()->setCellValueByColumnAndRow(6, $row,'Jumlah Qty');
			for ($k=0;$k<=6;$k++)//kolom hdr
			{
				$object->getActiveSheet()->getCellByColumnAndRow($k,$row)->getStyle()->getAlignment()->setWrapText(true);
				$object->getActiveSheet()->getCellByColumnAndRow($k,$row)->getStyle()->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				$object->getActiveSheet()->getCellByColumnAndRow($k,$row)->getStyle()->applyFromArray(array('font'  => array('bold'  => true,)));
				$object->getActiveSheet()->getCellByColumnAndRow($k,$row)->getStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$object->getActiveSheet()->getCellByColumnAndRow($k,$row)->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			}
			foreach($listed as $list)
			{
				$row++;
				$object->getActiveSheet()->setCellValueByColumnAndRow(0, $row,$list->antrian);
				$object->getActiveSheet()->setCellValueByColumnAndRow(1, $row,date('d-m-Y H:i',strtotime($list->jam_antri)));
				$object->getActiveSheet()->setCellValueByColumnAndRow(2, $row,date('d-m-Y H:i',strtotime($list->jam_muat)));
				$object->getActiveSheet()->setCellValueByColumnAndRow(3, $row,date('d-m-Y H:i',strtotime($list->selesai_muat)));
				$object->getActiveSheet()->setCellValueByColumnAndRow(4, $row,$list->do);
				if($list->do!=0)
				{
					$dod=$this->master->cek_do($list->do,$list->locid)->row();
					$object->getActiveSheet()->setCellValueByColumnAndRow(5, $row,$dod->item);
					$object->getActiveSheet()->setCellValueByColumnAndRow(6, $row,$dod->qty);
				}
				for ($k=0;$k<=6;$k++)//kolom hdr
				{
					$object->getActiveSheet()->getCellByColumnAndRow($k,$row)->getStyle()->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
					$object->getActiveSheet()->getCellByColumnAndRow($k,$row)->getStyle()->getAlignment()->setWrapText(true);
				}
				
			}
		}
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Laporan Muat.xls"');
		$object_writer->save('php://output');
	}
	function report_selesai()
	{
		$this->cek_login();
		$data['main_view']='report_muat';
		$data['title']='Muat';
		$data['form']=site_url('report/report_selesai');
		$data['form2']=site_url('report/xls_report_selesai');
		if($this->input->post('tgl_awal'))
		{
			$data['tgl_awal']=$this->input->post('tgl_awal');
			$data['tgl_akhir']=$this->input->post('tgl_akhir');			
		}
		else
		{
			$data['tgl_awal']=date('d-m-Y');
			$data['tgl_akhir']=date('d-m-Y');
		}
		$tmpl = array( 'table_open'    => '<table id="datatable" class="table table-striped table-bordered">',
					  'row_alt_start'  => '<tr>',
						'row_alt_end'    => '</tr>'
					  );
		$this->table->set_template($tmpl);

	
		// header table
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('Gudang','Dock','NO DO','Jam Antrian','Jam Muat','Jam Selesai Muat','Next Gudang');
		$tgl_awal=date('Y-m-d',strtotime($data['tgl_awal']));
		$tgl_akhir=date('Y-m-d',strtotime($data['tgl_akhir']));
		$listed=$this->master->muat_all($tgl_awal,$tgl_akhir)->result();//ganti
		foreach ($listed as $row)
		{
			if($row->selesai_muat == null)
			{
				$selesai_muat='';
			}
			else
			{
				$selesai_muat=date('Y-m-d H:i:s',strtotime($row->selesai_muat));
			}
			if($row->gd_next==null)
			{
				if($row->next_gd==null)
				{
					$next='';
				}
				else if ($row->next_gd==0)
				{
					$next='Kopi';
				}
				else if ($row->next_gd==-1)
				{
					$next='Cetak SJ';
				}
			}
			else
			{
				$next=$row->gd_next;
			}
			$this->table->add_row( $row->locid,$row->dock,$row->do_,date('Y-m-d H:i:s',strtotime($row->datetime)),date('Y-m-d H:i:s',strtotime($row->jam_muat)),$selesai_muat,$next);
		}
		$data['table'] = $this->table->generate();
		$this->load->view('sidemenu',$data);
	}
	function xls_report_selesai()
	{
		
		$this->load->library("excel");
		$object = new PHPExcel();
		$tgl1=date("Y-m-d",strtotime($this->input->post('tgl_awal')));
		$tgl2=date("Y-m-d",strtotime($this->input->post('tgl_akhir')));
		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
		$listed=$this->master->muat_all($tgl1,$tgl2)->result();
		if(count($listed)>0)
		{
			$object->getActiveSheet()->getColumnDimension('A')->setWidth(30);
			$object->getActiveSheet()->getColumnDimension('D')->setWidth(18);
			$object->getActiveSheet()->getColumnDimension('E')->setWidth(18);

			$object->getActiveSheet()->setCellValueByColumnAndRow(0, 1,date('Y-m-d H:i:s'));
			$row=3;
			$object->getActiveSheet()->setCellValueByColumnAndRow(0, $row,'Gudang');
			$object->getActiveSheet()->setCellValueByColumnAndRow(1, $row,'Dock');
			$object->getActiveSheet()->setCellValueByColumnAndRow(2, $row,'No Do');
			$object->getActiveSheet()->setCellValueByColumnAndRow(3, $row,'Jam Amtri');
			$object->getActiveSheet()->setCellValueByColumnAndRow(4, $row,'Jam Muat');
			$object->getActiveSheet()->setCellValueByColumnAndRow(5, $row,'Jam Selesai Muat');
			
			for ($k=0;$k<=5;$k++)//kolom hdr
			{
				$object->getActiveSheet()->getCellByColumnAndRow($k,$row)->getStyle()->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				$object->getActiveSheet()->getCellByColumnAndRow($k,$row)->getStyle()->applyFromArray(array('font'  => array('bold'  => true,)));
				$object->getActiveSheet()->getCellByColumnAndRow($k,$row)->getStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$object->getActiveSheet()->getCellByColumnAndRow($k,$row)->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
			}
			foreach($listed as $list)
			{
				$row++;
				$object->getActiveSheet()->setCellValueByColumnAndRow(0, $row,$list->locid);
				$object->getActiveSheet()->setCellValueByColumnAndRow(1, $row,$list->dock);
				$object->getActiveSheet()->setCellValueByColumnAndRow(2, $row,$list->do_);
				$object->getActiveSheet()->setCellValueByColumnAndRow(3, $row,date('d-m-Y H:i',strtotime($list->datetime)));
				$object->getActiveSheet()->setCellValueByColumnAndRow(4, $row,date('d-m-Y H:i',strtotime($list->jam_muat)));
				if($list->selesai_muat == null)
				{
					$selesai_muat='';
				}
				else
				{
					$selesai_muat=date('Y-m-d H:i',strtotime($list->selesai_muat));
				}
				$object->getActiveSheet()->setCellValueByColumnAndRow(5, $row,$selesai_muat);				
				for ($k=0;$k<=5;$k++)//kolom hdr
				{
					$object->getActiveSheet()->getCellByColumnAndRow($k,$row)->getStyle()->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);				
				}
			}
		}
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Laporan Muat '.$tgl1.' - '.$tgl2.'.xls"');
		$object_writer->save('php://output');
	}
	function report_satpam()
	{
		$this->cek_login();
		$data['main_view']='report_muat';
		$data['title']='Register Satpam';
		$data['form']=site_url('report/report_satpam');
		$data['form2']=site_url('report/xls_report_satpam');
		if($this->input->post('tgl_awal'))
		{
			$data['tgl_awal']=$this->input->post('tgl_awal');
			$data['tgl_akhir']=$this->input->post('tgl_akhir');			
		}
		else
		{
			$data['tgl_awal']=date('d-m-Y');
			$data['tgl_akhir']=date('d-m-Y');
		}
		$tmpl = array( 'table_open'    => '<table id="datatable" class="table table-striped table-bordered">',
					  'row_alt_start'  => '<tr>',
						'row_alt_end'    => '</tr>'
					  );
		$this->table->set_template($tmpl);

	
		// header table
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('Area','Nopol','Jenis Kendaraan','Nama sopir','Jam Register in','Jam Register out');
		$tgl_awal=date('Y-m-d',strtotime($data['tgl_awal']));
		$tgl_akhir=date('Y-m-d',strtotime($data['tgl_akhir']));
		$listed=$this->master->trans_area($tgl_awal,$tgl_akhir)->result();//ganti
		foreach ($listed as $row)
		{
			if($row->jam_out == null)
			{
				$jam_out='';
			}
			else
			{
				$jam_out=date('Y-m-d H:i:s',strtotime($row->jam_out));
			}
			$this->table->add_row( $row->area,$row->nopol,$row->jenis_kendaraan,$row->nama_sopir,date('Y-m-d H:i:s',strtotime($row->jam_in)),$jam_out);
		}
		$data['table'] = $this->table->generate();
		$this->load->view('sidemenu',$data);
	}
	function xls_report_satpam()
	{
		
		$this->load->library("excel");
		$object = new PHPExcel();
		$tgl1=date("Y-m-d",strtotime($this->input->post('tgl_awal')));
		$tgl2=date("Y-m-d",strtotime($this->input->post('tgl_akhir')));
		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
		$listed=$this->master->trans_area($tgl1,$tgl2)->result();
		if(count($listed)>0)
		{
			$object->getActiveSheet()->getColumnDimension('A')->setWidth(18);
			$object->getActiveSheet()->getColumnDimension('B')->setWidth(18);
			$object->getActiveSheet()->getColumnDimension('C')->setWidth(18);
			$object->getActiveSheet()->getColumnDimension('D')->setWidth(18);
			$object->getActiveSheet()->getColumnDimension('E')->setWidth(18);
			$object->getActiveSheet()->getColumnDimension('F')->setWidth(18);

			$object->getActiveSheet()->setCellValueByColumnAndRow(0, 1,date('Y-m-d H:i:s'));
			$row=3;
			$object->getActiveSheet()->setCellValueByColumnAndRow(0, $row,'Area');
			$object->getActiveSheet()->setCellValueByColumnAndRow(1, $row,'Nopol');
			$object->getActiveSheet()->setCellValueByColumnAndRow(2, $row,'Jenis Kendaraan');
			$object->getActiveSheet()->setCellValueByColumnAndRow(3, $row,'Nama Sopir');
			$object->getActiveSheet()->setCellValueByColumnAndRow(4, $row,'Jam Register in');
			$object->getActiveSheet()->setCellValueByColumnAndRow(5, $row,'Jam Register out');
			
			for ($k=0;$k<=5;$k++)//kolom hdr
			{
				$object->getActiveSheet()->getCellByColumnAndRow($k,$row)->getStyle()->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				$object->getActiveSheet()->getCellByColumnAndRow($k,$row)->getStyle()->applyFromArray(array('font'  => array('bold'  => true,)));
				$object->getActiveSheet()->getCellByColumnAndRow($k,$row)->getStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$object->getActiveSheet()->getCellByColumnAndRow($k,$row)->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
			}
			foreach($listed as $list)
			{
				$row++;
				$object->getActiveSheet()->setCellValueByColumnAndRow(0, $row,$list->area);
				$object->getActiveSheet()->setCellValueByColumnAndRow(1, $row,$list->nopol);
				$object->getActiveSheet()->setCellValueByColumnAndRow(2, $row,$list->jenis_kendaraan);
				$object->getActiveSheet()->setCellValueByColumnAndRow(3, $row,$list->nama_sopir);
				$object->getActiveSheet()->setCellValueByColumnAndRow(4, $row,date('d-m-Y H:i',strtotime($list->jam_in)));
				if($list->jam_out == null)
				{
					$jam_out='';
				}
				else
				{
					$jam_out=date('Y-m-d H:i:s',strtotime($list->jam_out));
				}
				$object->getActiveSheet()->setCellValueByColumnAndRow(5, $row,$jam_out);				
				for ($k=0;$k<=5;$k++)//kolom hdr
				{
					$object->getActiveSheet()->getCellByColumnAndRow($k,$row)->getStyle()->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);				
				}
			}
		}
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Laporan Satpam '.$tgl1.' - '.$tgl2.'.xls"');
		$object_writer->save('php://output');
	}
	
	function report_do()
	{
		$this->cek_login();
		$data['main_view']='report_muat';
		$data['title']='Gudang DO terambil';
		$data['form']=site_url('report/report_do');
		$data['form2']=site_url('report/xls_report_do');
		if($this->input->post('tgl_awal'))
		{
			$data['tgl_awal']=$this->input->post('tgl_awal');
			$data['tgl_akhir']=$this->input->post('tgl_akhir');			
		}
		else
		{
			$data['tgl_awal']=date('d-m-Y');
			$data['tgl_akhir']=date('d-m-Y');
		}
		$tmpl = array( 'table_open'    => '<table id="datatable" class="table table-striped table-bordered">',
					  'row_alt_start'  => '<tr>',
						'row_alt_end'    => '</tr>'
					  );
		$this->table->set_template($tmpl);
		// header table
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('No DO','Nopol','Ekspedisi','Gudang','Jam ambil DO');
		$tgl_awal=date('Y-m-d',strtotime($data['tgl_awal']));
		$tgl_akhir=date('Y-m-d',strtotime($data['tgl_akhir']));
		$listed=$this->master->do_terambil($tgl_awal,$tgl_akhir)->result();//ganti
		foreach ($listed as $row)
		{
			$this->table->add_row( $row->nodo,$row->nopol,$row->ekspedisi,$row->locid,date('Y-m-d H:i:s',strtotime($row->tgl_do2.' '.$row->jam_do2)));
		}
		$data['table'] = $this->table->generate();
		$this->load->view('sidemenu',$data);
	}
	function xls_report_do()
	{
		
		$this->load->library("excel");
		$object = new PHPExcel();
		$tgl1=date("Y-m-d",strtotime($this->input->post('tgl_awal')));
		$tgl2=date("Y-m-d",strtotime($this->input->post('tgl_akhir')));
		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
		$listed=$this->master->do_terambil($tgl1,$tgl2)->result();
		if(count($listed)>0)
		{
			$object->getActiveSheet()->setCellValueByColumnAndRow(0, 1,date('Y-m-d H:i:s'));
			$row=3;
			$object->getActiveSheet()->setCellValueByColumnAndRow(0, $row,'No Do');
			$object->getActiveSheet()->setCellValueByColumnAndRow(1, $row,'Nopol');
			$object->getActiveSheet()->setCellValueByColumnAndRow(2, $row,'Ekspedisi');
			$object->getActiveSheet()->setCellValueByColumnAndRow(3, $row,'Gudang');
			$object->getActiveSheet()->setCellValueByColumnAndRow(4, $row,'Jam ambil DO');
			
			for ($k=0;$k<=4;$k++)//kolom hdr
			{
				$object->getActiveSheet()->getCellByColumnAndRow($k,$row)->getStyle()->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				$object->getActiveSheet()->getCellByColumnAndRow($k,$row)->getStyle()->applyFromArray(array('font'  => array('bold'  => true,)));
				$object->getActiveSheet()->getCellByColumnAndRow($k,$row)->getStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$object->getActiveSheet()->getCellByColumnAndRow($k,$row)->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
			}
			foreach($listed as $list)
			{
				$row++;
				$object->getActiveSheet()->setCellValueByColumnAndRow(0, $row,$list->nodo);
				$object->getActiveSheet()->setCellValueByColumnAndRow(1, $row,$list->nopol);
				$object->getActiveSheet()->setCellValueByColumnAndRow(2, $row,$list->ekspedisi);
				$object->getActiveSheet()->setCellValueByColumnAndRow(3, $row,$list->locid);
				$object->getActiveSheet()->setCellValueByColumnAndRow(4, $row,date('Y-m-d H:i:s',strtotime($row->tgl_do2.' '.$row->jam_do2)));
				for ($k=0;$k<=4;$k++)//kolom hdr
				{
					$object->getActiveSheet()->getCellByColumnAndRow($k,$row)->getStyle()->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);				
				}
			}
		}
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Laporan Do terambil '.$tgl1.' - '.$tgl2.'.xls"');
		$object_writer->save('php://output');
	}
	function sisa()
	{
		$data['form']=site_url('rekom_antrian');
		if($this->input->post('tgl_awal'))
		{
			$data['tgl_awal']=$this->input->post('tgl_awal');
			$data['tgl_akhir']=$this->input->post('tgl_akhir');			
		}
		else
		{
			$data['tgl_awal']=date('Y-m-d');
			$data['tgl_akhir']=date('Y-m-d');
		}
		$tgl_awal=date('Y-m-d',strtotime($data['tgl_awal']));
		$tgl_akhir=date('Y-m-d',strtotime($data['tgl_akhir']));
		$listed=$this->master->sisa_muat($tgl_awal,$tgl_akhir)->result();//ganti
		$data['listed']=$listed;
		$data['gudang']=$this->master->gudang_list()->result();
		$this->load->view('sisa_muat',$data);
	}
	function list_antrian()
	{
		$area=$this->master->area()->result();
		$data['area']=$area;
		foreach($area as $a)
		{
			$data['list'][$a->id]=$this->master->get_antrian_area3($a->id)->result();
		}
		
		$this->load->view('sisa_muat2',$data);
	}
	function report_next_gd()
	{
		$this->cek_login();
		$data['main_view']='report_list';
		$data['title']='Tujuan DO selanjutnya';
		$tmpl = array( 'table_open'    => '<table id="datatable" class="table table-striped table-bordered">',
					  'row_alt_start'  => '<tr>',
						'row_alt_end'    => '</tr>'
					  );
		$this->table->set_template($tmpl);
		// header table
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('No DO','Nopol','Ekspedisi','Next Tujuan');
		$listed=$this->master->report_next_tujuan()->result();//ganti
		foreach ($listed as $row)
		{
			$gd=isset($row->gudang) ? $row->gudang : 'Kopi';
			$this->table->add_row( $row->NoDo,$row->NoPol,$row->ekspedisi,$gd);
		}
		$data['table'] = $this->table->generate();
		$this->load->view('sidemenu',$data);
	}
	function report_muat_qty()
	{
		$this->cek_login();
		$data['main_view']='report_muat_qty';
		$data['title']='waktu muat dengan total qty';
		$data['form']=site_url('report/report_muat_qty');
		$data['form2']=site_url('report/xls_report_muat_qty');
		if($this->input->post('tgl_awal'))
		{
			$data['tgl_awal']=$this->input->post('tgl_awal');
			$data['tgl_akhir']=$this->input->post('tgl_akhir');			
		}
		else
		{
			$data['tgl_awal']=date('d-m-Y');
			$data['tgl_akhir']=date('d-m-Y');
		}
		/* 
		$tmpl = array( 'table_open'    => '<table id="datatable" class="table table-striped table-bordered">',
					  'row_alt_start'  => '<tr>',
						'row_alt_end'    => '</tr>'
					  );
		$this->table->set_template($tmpl);

	
		// header table
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('Gudang','Dock','NO DO','Jam Muat','Jam Selesai Muat','Lama muat (Menit)','Total QTY');
		foreach ($listed as $row)
		{
			
			$this->table->add_row($row->gudang,$row->dock,$row->do_,date('Y-m-d H:i:s',strtotime($row->jam_muat)),date('Y-m-d H:i:s',strtotime($row->selesai_muat)),$row->lama,round($row->qty));
		}
		$data['table'] = $this->table->generate(); */
		$tgl_awal=date('Y-m-d',strtotime($data['tgl_awal']));
		$tgl_akhir=date('Y-m-d',strtotime($data['tgl_akhir']));
		$listed=$this->master->report_muat_qty($tgl_awal,$tgl_akhir)->result();//ganti
		$data['listed']=$listed;
		$this->load->view('sidemenu',$data);
	}
	function xls_report_muat_qty()
	{
		
		$this->load->library("excel");
		$object = new PHPExcel();
		$tgl1=date("Y-m-d",strtotime($this->input->post('tgl_awal')));
		$tgl2=date("Y-m-d",strtotime($this->input->post('tgl_akhir')));
		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
		$listed=$this->master->report_muat_qty($tgl1,$tgl2)->result();
		if(count($listed)>0)
		{

			$object->getActiveSheet()->setCellValueByColumnAndRow(0, 1,date('Y-m-d H:i:s'));
			$row=3;
			$object->getActiveSheet()->setCellValueByColumnAndRow(0, $row,'Gudang');
			$object->getActiveSheet()->setCellValueByColumnAndRow(1, $row,'Dock');
			$object->getActiveSheet()->setCellValueByColumnAndRow(2, $row,'No Do');
			$object->getActiveSheet()->setCellValueByColumnAndRow(3, $row,'Jam Muat');
			$object->getActiveSheet()->setCellValueByColumnAndRow(4, $row,'Jam Selesai');
			$object->getActiveSheet()->setCellValueByColumnAndRow(5, $row,'Lama muat (Menit)');
			$object->getActiveSheet()->setCellValueByColumnAndRow(6, $row,'Total QTY');
			$object->getActiveSheet()->getColumnDimension('A')->setWidth(25);
			$object->getActiveSheet()->getColumnDimension('D')->setWidth(25);
			$object->getActiveSheet()->getColumnDimension('E')->setWidth(25);
			for ($k=0;$k<=6;$k++)//kolom hdr
			{
				$object->getActiveSheet()->getCellByColumnAndRow($k,$row)->getStyle()->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				$object->getActiveSheet()->getCellByColumnAndRow($k,$row)->getStyle()->applyFromArray(array('font'  => array('bold'  => true,)));
				$object->getActiveSheet()->getCellByColumnAndRow($k,$row)->getStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$object->getActiveSheet()->getCellByColumnAndRow($k,$row)->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
			}
			foreach($listed as $list)
			{
				$row++;
				$object->getActiveSheet()->setCellValueByColumnAndRow(0, $row,$list->gudang);
				$object->getActiveSheet()->setCellValueByColumnAndRow(1, $row,$list->dock);
				$object->getActiveSheet()->setCellValueByColumnAndRow(2, $row,$list->do_);
				$object->getActiveSheet()->setCellValueByColumnAndRow(3, $row,date('d-m-Y H:i',strtotime($list->jam_muat)));
				$object->getActiveSheet()->setCellValueByColumnAndRow(4, $row,date('d-m-Y H:i',strtotime($list->selesai_muat)));
				$object->getActiveSheet()->setCellValueByColumnAndRow(5, $row,$list->lama);				
				$object->getActiveSheet()->setCellValueByColumnAndRow(6, $row,$list->qty);				
				for ($k=0;$k<=6;$k++)//kolom hdr
				{
					$object->getActiveSheet()->getCellByColumnAndRow($k,$row)->getStyle()->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);				
				}
			}
		}
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Laporan Muat dengan total QTY '.$tgl1.' - '.$tgl2.'.xls"');
		$object_writer->save('php://output');
	}
	function dtl_qty()
	{
		$id=$this->input->post('id');
		$data=$this->master->dtl_muat($id)->result();
		echo json_encode($data);
	}
}
