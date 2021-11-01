<?php 
class c_area extends CI_Controller {

	 function __construct() {
        parent::__construct();
		$this->load->model('master_model', 'master', TRUE);
		$this->load->model('login_model', 'login', TRUE);
	}

	public function index()
	{
		
		$this->area();
	}
	
	function cek_login()
	{
		if(($this->session->userdata('login_gdg')!=TRUE) )
		{
			redirect();
		}
		
	}

	function checkaut($idmenu){
		
		$auth = $this->login->checkaut($idmenu)->row();
		return $auth;
		
	}
	function area()
	{
		$this->cek_login();	
		$data['default']['menu']=17;//ganti
		$a=$this->checkaut($data['default']['menu']);
		if(count($a)>0)
		{
			if($a->r==1)
			{
				$data['main_view']='c_area';
				$data['form']=site_url('c_area/add_area');
				$data['tabel'] = $this->master->area()->result();
				$data['auth']=$a;
				$this->load->view('sidemenu',$data);
			}
			else
			{
				$this->load->view('forbidden');
			}
		}
		else
		{
			$this->load->view('forbidden');
		}
	}
	function add_area()
	{
		$basic=array(base_url('c_area/area'));
		if(secure($basic)==1)
		{
			$this->cek_login();	
			$data['default']['menu']=17;//ganti
			$a=$this->checkaut($data['default']['menu']);
			if(count($a)>0)
			{
				if($a->c==1)
				{
					$id=$this->master->maksid('area')->row();
					if(count($id)>0)
					{
						$id=$id->id+1;
					}
					else
					{
						$id=1;
					}
					$form=array('id'=>$id,'area'=>$this->input->post('area'));
					$this->master->add_form($form,'area');
				}
			}
			redirect('c_area/area');
		}
		else
		{
			redirect('login');
		}
	}
	function user($username)
	{
		$basic=array(base_url('c_user/user'),base_url('c_area/user/'.$username));
		if(secure($basic)==1)
		{
			$this->cek_login();
			$data['default']['menu']=17;//ganti
			$a=$this->checkaut($data['default']['menu']);
			if(count($a)>0)
			{
				if($a->u==1)
				{
					$data['main_view']='akses_area';
					$data['id_user']=$username;
					$data['form']=site_url('c_area/add_akses');
					$data['tabel'] = $this->master->akses_area_user($username)->result();
					$data['auth']=$a;
					$this->load->view('sidemenu',$data);
				}
			}
		}
		else
		{
			redirect('login');
		}
	}
	function add_akses()
	{
		$id_user= $this->input->post('id_user');
		$basic=array(base_url('c_area/user/'.$id_user));
		if(secure($basic)==1)
		{
			$this->cek_login();
			$this->master->delete_form2(array('id_user'=>$id_user),'area_akses');
			$area=$this->master->area()->result();
			foreach($area as $a)
			{
				if($this->input->post('c-'.$a->id)!='')
				{
					$form=array('id_area'=>$a->id,'id_user'=>$id_user);
					$this->master->add_form($form,'area_akses');
				}
			}
			redirect('c_area/user/'.$id_user);
		}
		else
		{
			redirect('login');
		}
	}
	function gd($username)
	{
		$basic=array(base_url('c_user/user'),base_url('c_area/gd/'.$username));
		if(secure($basic)==1)
		{
			$this->cek_login();
			$data['default']['menu']=17;//ganti
			$a=$this->checkaut($data['default']['menu']);
			if(count($a)>0)
			{
				if($a->u==1)
				{
					$data['main_view']='akses_gd';
					$data['id_user']=$username;
					$data['form']=site_url('c_area/akses_gd');
					$data['tabel'] = $this->master->akses_gd($username)->result();
					$data['auth']=$a;
					$this->load->view('sidemenu',$data);
				}
			}
		}
		else
		{
			redirect('login');
		}
	}
	function akses_gd()
	{
		$id_user= $this->input->post('id_user');
		$basic=array(base_url('c_area/gd/'.$id_user));
		if(secure($basic)==1)
		{
			$this->cek_login();
			$this->master->delete_form2(array('id_user'=>$id_user),'gudang_akses');
			$gudang=$this->master->gudang_list()->result();
			foreach($gudang as $a)
			{
				if($this->input->post('c-'.$a->id)!='')
				{
					$form=array('id_gd'=>$a->id,'id_user'=>$id_user);
					$this->master->add_form($form,'gudang_akses');
				}
			}
			redirect('c_area/gd/'.$id_user);
		}
		else
		{
			redirect('login');
		}
	}

}