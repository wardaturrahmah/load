<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class clearance extends CI_Controller {
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
		$data['default']['menu']=22;//ganti
		$a=$this->checkaut($data['default']['menu']);
		if(count($a)>0)
		{
			$data['auth']=$a;
			$data['main_view']='clearance';
			$data['form']=site_url('clearance/add');
			$data['form2']=site_url('clearance/update');
			$data['gudang']=$this->master->gudang_list()->result();
			$data['list']=$this->master->list_do_pending()->result();
			
			$this->load->view('sidemenu',$data);
		}
		else
		{
			$this->load->view('forbidden');
		}
	}
	function add()
	{
		$basic=array(base_url('clearance'),base_url('clearance/muat'));
		if(secure($basic)==1)
		{
			$this->cek_login();	
			$data['default']['menu']=22;//ganti
			$a=$this->checkaut($data['default']['menu']);
			if($a->c==1)
			{
				$do= $this->input->post('do');
				$gd=$this->input->post('gd');
				$cek=$this->master->cek_area_do($do,1)->row();
				//if(count($cek)>0)
				if($cek->jam_in!=null)
				{
					if($cek->next_gd==0)
					{
						$ida=array('nodo' => $do, 'nopol' => $cek->nopol);
						$form=array('next_gd' => $gd,'jam_izin'=>date('Y-m-d H:i:s'));
						$this->master->edit_form2($ida,$form,'psdohdr');
						
						$form2=array('nodo' 		=> $do,
									'gudang' 		=> $gd,
									'nopol' 		=> $cek->nopol,
									'jam_izin'		=>date('Y-m-d H:i:s'),
									'created_by' 	=> $this->session->userdata('nama_gdg')
									);
						$this->master->add_form($form2,'clearance');
					}
					else
					{
						$this->session->set_flashdata('clearance','DO sudah di clearance');	
					}
				}
				else
				{
					if($cek->jam_do2==null)
					{
						$this->session->set_flashdata('clearance','DO belum d assign');	
					}
					else
					{
						$this->session->set_flashdata('clearance','Mobil tidak ada pada area');	
					}
					
				}
				redirect('clearance');
			}
			else
			{
				$this->load->view('forbidden');
			}
		}
		else
		{
			redirect('login');
		}
	}
	function update()
	{
		$basic=array(base_url('clearance'),base_url('clearance/muat'));
		if(secure($basic)==1)
		{
			$this->cek_login();	
			$data['default']['menu']=22;//ganti
			$a=$this->checkaut($data['default']['menu']);
			if($a->u==1)
			{
				$do= $this->input->post('nodo');
				$gd=$this->input->post('gd');
				$cek=$this->master->cek_area_do($do,1)->row();
				if($cek->jam_in!=null)
				{
						$ida=array('nodo' => $do, 'nopol' => $cek->nopol);
						$form=array('next_gd' => $gd,'jam_izin'=>date('Y-m-d H:i:s'));
						$this->master->edit_form2($ida,$form,'psdohdr');
						
						$form2=array('nodo' 		=> $do,
									'gudang' 		=> $gd,
									'nopol' 		=> $cek->nopol,
									'jam_izin'		=>date('Y-m-d H:i:s'),
									'created_by' 	=> $this->session->userdata('nama_gdg')
									);
						$this->master->add_form($form2,'clearance');
				}
				else
				{
					if($cek->jam_do2==null)
					{
						$this->session->set_flashdata('clearance','DO belum d assign');	
					}
					else
					{
						$this->session->set_flashdata('clearance','Mobil tidak ada pada area');	
					}
					
				}
				redirect('clearance');
			}
			else
			{
				$this->load->view('forbidden');
			}
		}
		else
		{
			redirect('login');
		}
	}
	function stapel()
	{
		$this->cek_login();	
		$data['default']['menu']=24;
		$a=$this->checkaut($data['default']['menu']);
		if(count($a)>0)
		{
			$data['auth']=$a;
			$data['main_view']='stapel';
			$data['form']=site_url('clearance/add_stapel');
			$data['form2']=site_url('clearance/update_stapel');
			$data['list']=$this->master->list_stapel()->result();
			$this->load->view('sidemenu',$data);
		}
		else
		{
			$this->load->view('forbidden');
		}
	}
	function add_stapel()
	{
		$basic=array(base_url('clearance/stapel'));
		if(secure($basic)==1)
		{
			$this->cek_login();	
			$data['default']['menu']=24;//ganti
			$a=$this->checkaut($data['default']['menu']);
			if($a->c==1)
			{
				$do= $this->input->post('do');
				$cek=$this->master->do_id($do)->row();
				if($cek->flag_muat==1)
				{
					$pssys=array();
					$tujuans=array();
					$dtl=$this->master->psdodtl($cek->SysDO)->result();
					foreach($dtl as $dtl)
					{
						if(!in_array($dtl->Sys,$pssys))
						{
							array_push($pssys,$dtl->Sys);
						}
					}
					foreach($pssys as $pssys)
					{
						$tujuan=$this->master->tujuan_do($pssys)->row();
						if(!in_array($tujuan->city,$tujuans))
						{
							array_push($tujuans,$tujuan->city);
						}
					}
					$tuju=implode ("," ,$tujuans );

					$ida=array('nodo' => $do, 'nopol' => $cek->NoPol);
					$form=array('flag_stapel' => 1,'tujuan'=>$tuju,'jam_stapel'=>date('Y-m-d H:i:s'));
					$this->master->edit_form2($ida,$form,'psdohdr');
				}
				else
				{
					$this->session->set_flashdata('stapel','DO belum proses SJ');	
				}
				redirect('clearance/stapel');
			}
			else
			{
				$this->load->view('forbidden');
			}
		}
		else
		{
			echo "HAYOOO";
			//redirect('login');
		}
	}
	function batal_stapel($ida)
	{
		$basic=array(base_url('clearance/stapel'));
		if(secure($basic)==1)
		{
			$this->cek_login();	
			$data['default']['menu']=24;//ganti
			$a=$this->checkaut($data['default']['menu']);
			if($a->u==1)
			{
				$ida=explode('~',$ida);
				$do= $ida[0];
				$cek=$this->master->do_id($do)->row();
				if($cek->flag_stapel==1)
				{
					$ida=array('nodo' => $do, 'nopol' => $cek->NoPol);
					$form=array('flag_stapel' => 0);
					$this->master->edit_form2($ida,$form,'psdohdr');
				}
				else
				{
					$this->session->set_flashdata('stapel','DO belum ditandai sebagai stapel');
				}
				redirect('clearance/stapel');
			}
			else
			{
				$this->load->view('forbidden');
			}
		}
		else
		{
			echo "HAYOOO";
			//redirect('login');
		}
	}
}