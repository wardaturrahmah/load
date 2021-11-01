<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class area2 extends CI_Controller {
	function __construct() {
        parent::__construct();
		$this->load->model('master_model', 'master', TRUE);
		$this->load->model('login_model', 'login', TRUE);
	}
	public function index()
	{
		$this->trans();
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
	function trans()
	{
		$this->cek_login();	
		
		$menu=13;
		$a=$this->checkaut($menu);
		if(count($a)>0)
		{
			$data['auth']=$a;
			$data['main_view']='t_area2';
			$data['form']=site_url('area2/add_trans');
			
			$list=$this->master->get_antrian_area()->result();
			$data['list']=$list;
			$kend= $this->master->get_Type()->result();
			if(count($kend)>0)
			{
					$data['options_kendaraan']=$kend;
			}
			else
			{	
				$data['options_kendaraan']='';
			}
			$data['area']=$this->master->allow_area()->result();
			$data['list_nopol']=$this->master->master_nopol()->result();
			$this->load->view('sidemenu',$data);
			$this->session->set_userdata('parid', '');	
		}
		else
		{
			echo "Deny";
		}
	}
	function add_trans()
	{
		$basic=array(base_url('area2/trans'));
		if(secure($basic)==1)
		{
			$this->cek_login();
			$menu=13;
			$a=$this->checkaut($menu);
			if($a->c==1)
			{
				$eks=$this->input->post('ekspedisi');
				if($eks=='IN')
				{
					$arr=explode('~',$this->input->post('nopols'));
					$nopol=$arr[0];
					$jk=$arr[1];
					
				}
				else if($eks=='EX')
				{
					$nopol=str_replace(" ","",$this->input->post('nopol'));
					$jk=$this->input->post('jenis');
				}
				$area=$this->input->post('area');
				$cek=$this->master->get_antrian_area2($nopol)->row();
				if(count($cek)==0)
				{
					if($area==1)
					{
						$stat=1;
					}
					else if($area==2)
					{
						$cek2=$this->master->cek_clearance4($nopol)->row();
						if(count($cek2)>0)
						{
							if($cek2->id_area==$area)
							{
								$stat=1;
							}
							else
							{
								$stat=0;
								if($cek2->next_gd==0)
								{
									$gd='Kopi';
								}
								else
								{
									$gd=$this->master->gudang($cek2->next_gd)->row()->gudang;
								}
								$this->session->set_flashdata('tarea','Anda tidak di ijinkan menuju area ini. Silahkan menuju area '.$gd);
							}
						}
						else
						{
							$cek3=$this->master->cek_bsc($nopol)->row();
							if($cek3->gd==4)
							{
								$stat=1;
							}
							else
							{
								$stat=0;
								$this->session->set_flashdata('tarea','Tidak ada do yang diassign dengan nopol tersebut/cek pada report');
							}
							
						}
					}
					else
					{
						$cek2=$this->master->cek_clearance4($nopol)->row();
						if(count($cek2)>0)
						{
							if($cek2->id_area==$area)
							{
								$stat=1;
							}
							else
							{
								$stat=0;
								if($cek2->next_gd==0)
								{
									$gd='Kopi';
								}
								else
								{
									$gd=$this->master->gudang($cek2->next_gd)->row()->gudang;
								}
								$this->session->set_flashdata('tarea','Anda tidak di ijinkan menuju area ini. Silahkan menuju area '.$gd);
							}
						}
						else
						{
							$stat=0;
							$this->session->set_flashdata('tarea','Tidak ada do yang diassign dengan nopol tersebut/cek pada report');
						}
					}
					if($stat==1)
					{
						
						$form=array('nopol' =>$nopol
							,'jenis_kendaraan' =>$jk
							,'nama_sopir' 	=>str_replace("'","''",$this->input->post('nama_sopir'))
							,'area' 		=>$this->input->post('area')
							,'jam_in'		=>date('Y-m-d H:i:s')
							,'ekspedisi' 	=>$eks
						);
						$this->master->add_form($form,'trans_area');
					}
				}
				else
				{
					$this->session->set_flashdata('tarea','Tidak dapat register, Silahkan menuju satpam '.$cek->area.' untuk register out');
				}
				
				
			}
			redirect('area2/trans');
		}
		else
		{
			redirect('login');
		}
	}
	function selesai($id)
	{
		$this->cek_login();
		$menu=13;
		$a=$this->checkaut($menu);
		/* if($a->u==1)
		{
			$ida=explode('~',$id);
			$id=$ida[0];
			$nopol=$ida[1];
			$area=$ida[2];
			if($area==1)
			{
				$cek2=$this->master->cek_clearance($nopol)->row();
				if(count($cek2)>0)
				{
					if($cek2->next_gd==0)
					{
						$stat=0;
						$this->session->set_flashdata('tarea','Belum ada perizinan. Silahkan menuju logistik');
					}
					else
					{
						$stat=1;
					}
				}
				else
				{
					$stat=1;
				}
				
			}
			else
			{
				$cek=$this->master->cek_gd($nopol,$area)->row();
				$stat= count($cek)==0 ? 1 : 0;
				$this->session->set_flashdata('tarea','Tidak dapat register out, Silahkan menuju '.$cek->gudang);
			}
			if($stat==1)
			{
				$form=array('jam_out'	=>date('Y-m-d H:i:s')
					);
				$this->master->edit_form($id,$form,'trans_area');
				$this->session->set_flashdata('tarea','');
			}
		}
		redirect('area2/trans');
	 */
	}
	
	function selesai2()
	{
		$basic=array(base_url('area2/trans'));
		if(secure($basic)==1)
		{
			$this->cek_login();
			$menu=13;
			$a=$this->checkaut($menu);
			if($a->u==1)
			{
				$id=$this->input->post('id');
				$nopol=$this->input->post('nopol');
				$area=$this->input->post('area');
				$keterangan=$this->input->post('keterangan');
				
				if($area==1)
				{
					$cek2=$this->master->cek_clearance($nopol)->row();
					if(count($cek2)>0)
					{
						if($cek2->next_gd==0)
						{
							$stat=0;
							$this->session->set_flashdata('tarea','Belum ada perizinan. Silahkan menuju logistik');
						}
						else
						{
							$stat=1;
						}
					}
					else
					{
						$ida=array('NoPol'=>$nopol,'flag_stapel' => 1);
						$form=array('flag_stapel' => 0);
						$this->master->edit_form2($ida,$form,'psdohdr');
						$stat=1;
					}
					
				}
				else
				{
					$cek=$this->master->cek_gd($nopol,$area)->row();
					$stat= count($cek)==0 ? 1 : 0;
					$this->session->set_flashdata('tarea','Tidak dapat register out, Silahkan menuju '.$cek->gudang);
				}
				if($stat==1)
				{
					$form=array('jam_out'	=>date('Y-m-d H:i:s')
								,'keterangan' =>$keterangan
						);
					$this->master->edit_form($id,$form,'trans_area');
					$this->session->set_flashdata('tarea','');
				}
			
			}
			//redirect('area2/trans');
		}
		else
		{
			redirect('login');
		}
	
	}
	
}