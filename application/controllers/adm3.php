<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class adm3 extends CI_Controller {
	function __construct() {
        parent::__construct();
		$this->load->model('master_model', 'master', TRUE);
		$this->load->model('login_model', 'login', TRUE);
	}
	public function index()
	{
		$this->muat();
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
	function muat()
	{
		$this->cek_login();	
		$data['default']['menu']=18;//ganti
		$a=$this->checkaut($data['default']['menu']);
		if(count($a)>0)
		{
			$data['auth']=$a;
			$data['main_view']='muatb2';
			$data['formp']=site_url('adm3/regis');
			$data['gudang_akses']=$this->master->gudang_user()->result();
			$data['gudang']=$this->master->gudang_list()->result();
			$data['tabel1']=$this->master->list_antrian()->result();
			$data['form']=site_url('adm3/proses_muat');
			$data['tabel2']=$this->master->list_muat()->result();
			$data['tabel3']=$this->master->list_selesai()->result();
			$data['form2']=site_url('adm3/edit_form');
			$data['form3']=site_url('adm3/selesai_muat');
			$data['form4']=site_url('adm3/edit_form2');
			
			$this->load->view('sidemenu',$data);
		}
		else
		{
			$this->load->view('forbidden');
		}
	}
	function regis()
	{
		$basic=array(base_url('adm3'),base_url('adm3/muat'));
		if(secure($basic)==1)
		{
			$this->cek_login();	
			$data['default']['menu']=18;//ganti
			$a=$this->checkaut($data['default']['menu']);
			if($a->c==1)
			{
				$gd=$this->input->post('gd');
				$do=$this->input->post('do');
				$cek0=$this->master->do_id($do)->row();
				if(isset($cek0->tgl_do2))
				{
					if($cek0->flag_muat==0)
					{
						$cek1=$this->master->tes_satpam($cek0->NoPol,$gd)->row();
						if(count($cek1)>0)
						{
							/* if($cek0->next_gd==$gd)
							{ */
								$cek=$this->master->cek_antrian($do)->row();						
								if(count($cek)==0)
								{
									$dt=$this->master->no_antrian($gd)->row();
									if(count($dt)==0)
									{
										$no=1;
									}
									else
									{
										$no=$dt->antrian+1;
									}
									$form=array('antrian'=>$no,
												'datetime'=>date('Y-m-d H:i:s'),
												'flag' =>1,
												'gd'=>$gd,
												'do_' => $do,
												'added_by' =>$this->session->userdata('nama_gdg'),
												'id_trans_area'=>$cek1->id_trans_area);
									//print_r($form);
									$this->master->add_form($form,'antrian');
								}
								else
								{
									$this->session->set_flashdata('muat','Tidak bisa regis masih terdaftar pada '.$cek->gudang);
								}
							/* }
							else
							{
								$gd=$this->master->gudang($cek0->next_gd)->row();
								echo 'Tidak diizinkan pada gudang ini. Silahkan ke '.$gd->locid;
								$this->session->set_flashdata('muat','Tidak diizinkan pada gudang ini. Silahkan ke '.$gd->locid);
							} */
						}
						else
						{
							$this->session->set_flashdata('muat','Nopol '.$cek0->NoPol.' belum di regis satpam area');
						}
					}
					else
					{
						$this->session->set_flashdata('muat','DO '.$do.' ditujukan untuk proses sj');
					}
				}
				else
				{
					$this->session->set_flashdata('muat','DO '.$do.' belum di assign logistik');
				}
				redirect('adm3/muat');
			}
		}
		else
		{
			//echo "HAYOOO";
			redirect('login');
		}
	}
	function proses_muat()
	{
		$basic=array(base_url('adm3'),base_url('adm3/muat'));
		if(secure($basic)==1)
		{
			$this->cek_login();
			$data['default']['menu']=18;//ganti
			$a=$this->checkaut($data['default']['menu']);
			if($a->c==1)
			{
					$idb=$this->input->post('id');//id_antrian
					$cek=$this->master->muat_by_antrian($idb)->row();
					if(count($cek)==0)
					{
						$form=array('do_' 			=> $this->input->post('do'),
									'id_antrian' 	=> $idb,
									'jam_muat' 		=> date('Y-m-d H:i:s'),
									'dock' 		=> $this->input->post('dock'),
									'added_by' =>$this->session->userdata('nama_gdg')
									);
						$this->master->add_form($form,'muat');
						$form2=array('flag'=>2,
									'update_by' =>$this->session->userdata('nama_gdg'));
						$this->master->edit_form($idb,$form2,'antrian');
						redirect($a->url);
					}
					else
					{
						$this->session->set_flashdata('muat','Nomer antrian sudah dimuat');
						redirect($a->url);
					}
			}
			else
			{
				$this->load->view('forbidden');
			}
		}
		else
		{
			//echo "HAYOOO";
			redirect('login');
		}
		
	}
	function selesai_muat()
	{
		$basic=array(base_url('adm3'),base_url('adm3/muat'));
		if(secure($basic)==1)
		{
			$this->cek_login();
			
			$id=$this->input->post('id');
			$id_antrian=$this->input->post('id_antrian');
			$nodo=$this->input->post('nodo');
			$gudang=$this->input->post('gudang');
			$data['default']['menu']=18;//ganti
			$a=$this->checkaut($data['default']['menu']);
			if($a->c==1)
			{

				$form=array('selesai_muat'=>date('Y-m-d H:i:s'),
									'update_by' =>$this->session->userdata('nama_gdg'),
									'next_gd'=>$gudang);
				$this->master->edit_form($id,$form,'muat');
				$form2=array('flag'=>3,
							'update_by' =>$this->session->userdata('nama_gdg'));
				$this->master->edit_form($id_antrian,$form2,'antrian');
				if($gudang>=0)
				{
					$idd=array('nodo'=>$nodo,'flag_muat'=>0);
					$form=array('next_gd'=>$gudang,'jam_izin'=>date('Y-m-d H:i:s'));
					$this->master->edit_form2($idd,$form,'psdohdr');	
				}
				else
				{
					$idd=array('nodo'=>$nodo,'flag_muat'=>0);
					$form=array('next_gd'=>$gudang,'flag_muat'=>1,'jam_izin'=>date('Y-m-d H:i:s'));
					$this->master->edit_form2($idd,$form,'psdohdr');	
				}
				$cek=$this->input->post('cek');
				for($i=0;$i<count($cek);$i++)
				{
					if(isset($cek[$i]))
					{
						$ida=explode('~',$cek[$i]);
						$sysdo=$ida[0];
						$sys=$ida[1];
						$lineno=$ida[2];
						$idd=array('sysdo'=>$sysdo,'sys'=>$sys,'lineno'=>$lineno);
						$form=array('id_muat'=>$id);
						$this->master->edit_form2($idd,$form,'psdodtl');
					}
				}
				$cek2=$this->master->do_id($nodo)->row();
				$form2=array('nodo' 		=> $nodo,
							'gudang' 		=> $gudang,
							'nopol' 		=> $cek2->NoPol,
							'jam_izin'		=>date('Y-m-d H:i:s'),
							'created_by' 	=> $this->session->userdata('nama_gdg')
							);
				$this->master->add_form($form2,'clearance');
				redirect($a->url);
			}
			else
			{
				$this->load->view('forbidden');
			}	
		}
		else
		{
			//echo "HAYOOO";
			redirect('login');
		}
	}
	function edit_form()
	{
		$basic=array(base_url('adm3'),base_url('adm3/muat'));
		if(secure($basic)==1)
		{
			$this->cek_login();
			$data['default']['menu']=18;//ganti
			$a=$this->checkaut($data['default']['menu']);
			if($a->u==1)
			{
				$id= $this->input->post('id');
				$do=$this->input->post('nodo');
				$b_gd=$this->input->post('b_gd');
				$gd= $this->input->post('gudang');
				$cek=$this->master->cek_antrian($do)->row();
				if(count($cek)==0)
				{
					$cek2=$this->master->do_id($do)->row();
					if($cek2->next_gd==$b_gd)
					{
						echo 'Boleh';
						$flags= $b_gd>=0 ? 0 : 1;
						$flag_muat= $gd>=0 ? 0 : 1;
						$idd=array('nodo'=>$do,'flag_muat'=>$flags);
						$form=array('next_gd'=>$gd,'flag_muat'=>$flag_muat
									,'jam_izin'=>date('Y-m-d H:i:s'));
						$this->master->edit_form2($idd,$form,'psdohdr');
						
						$form2=array('nodo' 		=> $do,
									'gudang' 		=> $gd,
									'nopol' 		=> $cek2->NoPol,
									'jam_izin'		=>date('Y-m-d H:i:s'),
									'created_by' 	=> $this->session->userdata('nama_gdg')
									);
						$this->master->add_form($form2,'clearance');
						
						$form=array('update_by' =>$this->session->userdata('nama_gdg'),
									'next_gd'=>$gd);
						$this->master->edit_form($id,$form,'muat');
					}
					else
					{
						$this->session->set_flashdata('muat','Tidak bisa diubah, ini bukan planning terbaru');
					}
				}
				else
				{
					$this->session->set_flashdata('muat','Tidak bisa. kendaraan sedang muat pada gudang lain');
				}
				redirect($a->url);
			}
			else
			{
				$this->load->view('forbidden');
			}
		}
		else
		{
			//echo "HAYOOO";
			redirect('login');
		}
	}
	function edit_form2()
	{
		$basic=array(base_url('adm3'),base_url('adm3/muat'));
		if(secure($basic)==1)
		{
			$this->cek_login();
			$data['default']['menu']=18;//ganti
			$a=$this->checkaut($data['default']['menu']);
			if($a->u==1)
			{
				
				$id= $this->input->post('id');
				$do=$this->input->post('nodo');
				$idd=array('id_muat'=>$id);
				$form=array('id_muat'=>null);
				$this->master->edit_form2($idd,$form,'psdodtl');
				$cek=$this->input->post('cek');
				for($i=0;$i<count($cek);$i++)
				{
					if(isset($cek[$i]))
					{
						$ida=explode('~',$cek[$i]);
						$sysdo=$ida[0];
						$sys=$ida[1];
						$lineno=$ida[2];
						$idd=array('sysdo'=>$sysdo,'sys'=>$sys,'lineno'=>$lineno);
						$form=array('id_muat'=>$id);
						$this->master->edit_form2($idd,$form,'psdodtl');
					}
				}
				redirect($a->url);
			}
			else
			{
				$this->load->view('forbidden');
			}
		}
		else
		{
			//echo "HAYOOO";
			redirect('login');
		}
	}
	
	function delete_antrian($id)
	{
		$basic=array(base_url('adm3'),base_url('adm3/muat'));
		if(secure($basic)==1)
		{
			$this->cek_login();
			$arr=explode('~',$id);
			//print_r ($arr);
			$id=$arr[0];
			$id_menu=$arr[1];
			
			$a=$this->checkaut($id_menu);
			if($a->d==1)
			{
				$form=array('flag'=> 0);
				$this->master->edit_form($id,$form,'antrian');
				redirect($a->url);
				/* $this->master->delete_form($id,'antrian');
				redirect($a->url); */
			}
			else
			{
				$this->load->view('forbidden');
			}
		}
		else
		{
			//echo "HAYOOO";
			redirect('login');
		}
		
	}
	function get_dtl_do()
	{
		$basic=array(base_url('adm3'),base_url('adm3/muat'));
		if(secure($basic)==1)
		{
			$this->cek_login();	
			$data['default']['menu']=18;//ganti
			$a=$this->checkaut($data['default']['menu']);
			if($a->c==1)
			{
				$do=$this->input->post('nodo');
				$data=$this->master->dtl_do($do)->result();
				echo json_encode($data);
			}
		}
		else
		{
			//echo "HAYOOO";
			redirect('login');
		}
	}
}