<?php 
class c_user extends CI_Controller {

	 function __construct() {
        parent::__construct();
		$this->load->model('master_model', 'master', TRUE);
		$this->load->model('login_model', 'login', TRUE);
	}

	public function index()
	{
		
		$this->user();
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
	function user()
	{
		$this->cek_login();
		$data['default']['menu']=9;//ganti
		$a=$this->checkaut($data['default']['menu']);
		if(count($a)>0)
		{
			if($a->c==1)
			{
				$data['main_view']='c_user';
				$data['form']=site_url('c_user/add_user2');
				$data['form2']=site_url('c_user/edit_user');
				$tmpl = array( 'table_open'    => '<table id="datatable" class="table table-striped table-bordered">',
									  'row_alt_start'  => '<tr class="zebra">',
										'row_alt_end'    => '</tr>'
							);
				$this->table->set_template($tmpl);
				$this->table->set_empty("&nbsp;");
				$this->table->set_heading('User','Group');
				$data['grup']=$this->login->list_group()->result();
				$data['tabel'] = $this->login->list_user()->result();
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
	function add_user2()
	{
		$basic=array(base_url('c_user/user'));
		if(secure($basic)==1)
		{
			$this->cek_login();
			$data['default']['menu']=9;//ganti
			$a=$this->checkaut($data['default']['menu']);
			if($a->c==1)
			{
				$form = array(			
							'Username'		=> $this->input->post('user'),
							'Password'		=> md5($this->input->post('password')),
							'Group_'		=> $this->input->post('grup'),
							);
				$this->master->add_form($form,'login_gdg');
				redirect($a->url);
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
	function edit_user()
	{
		$basic=array(base_url('c_user/user'));
		if(secure($basic)==1)
		{
			$this->cek_login();
			$a=$this->checkaut($this->input->post('menu'));
			if($a->u==1)
			{
				$form=array(
					'Group_'		=>$this->input->post('grup'));
				$id=array('Username'=>$this->input->post('name'));
				$this->master->edit_form2($id,$form,'login_gdg');
				redirect($a->url); 
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
	function edit_form()
	{
		$this->cek_login();	
		$data['main_view']='edit_pass';
		$data['form2']='edit_pass';
		$data['user']=$this->session->userdata('nama_gdg');
		$this->load->view('sidemenu',$data);
	}
	function edit_pass()
	{
		$basic=array(base_url('c_user/edit_form'));
		if(secure($basic)==1)
		{
			$this->cek_login();
			$user=$this->session->userdata('nama_gdg');
			$pl=md5($this->input->post('password3'));
			$pb=md5($this->input->post('password4'));
			if($this->login->check_user2($user,$pl) == TRUE){
				$this->session->set_userdata('parid', '');
				$form=array(
					'password'		=>md5($this->input->post('password4'))
				);
				$id=array('Username'=>$user);
				$this->master->edit_form2($id,$form,'login_gdg');
				
			}
			else{
				$this->session->set_userdata('parid', $user);
				redirect('c_user/edit_form');
			}
			redirect('login');
		}
		else
		{
			redirect('login');
		}
	}
	function grup()
	{
		$this->cek_login();	
		$data['default']['menu']=10;//ganti
		$a=$this->checkaut($data['default']['menu']);
		if(count($a)>0)
		{
			if($a->c==1)
			{
				$data['main_view']='grup';
				$data['form']=site_url('c_user/add_grup');
				$tmpl = array( 'table_open'    => '<table id="datatable" class="table table-striped table-bordered">',
									  'row_alt_start'  => '<tr class="zebra">',
										'row_alt_end'    => '</tr>'
							);
				$this->table->set_template($tmpl);
				$this->table->set_empty("&nbsp;");
				$this->table->set_heading('Group','Action');
				$list=$this->login->list_group()->result();
				foreach($list as $list){
					if($a->u==1)
					{
						$action='<button type="button" class="btn btn-info">
								<a href="akses/'.$list->id.'"><i class="fa fa-edit blue" style="color:#DDDDDD;"></i></a></button>';
					}
					else
					{
						$action='';
					}
					$this->table->add_row($list->group_,$action);
				} 
				$data['table'] = $this->table->generate();
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
	function add_grup()
	{
		$basic=array(base_url('c_user/grup'));
		if(secure($basic)==1)
		{
			$this->cek_login();
			$data['default']['menu']=10;//ganti
			$a=$this->checkaut($data['default']['menu']);
			if($a->c==1)
			{
				$form = array(			
							
							'group_'		=> $this->input->post('grup'),
							);
				$this->master->add_form($form,'user_group');
				redirect($a->url);
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
	function akses($id)
	{
		$basic=array(base_url('c_user/grup'),base_url('c_user/akses/'.$id));
		if(secure($basic)==1)
		{
			$this->cek_login();	
			$data['default']['menu']=10;//ganti
			$a=$this->checkaut($data['default']['menu']);
			if(count($a)>0)
			{
				if($a->u==1)
				{
					
					$data['main_view']='akses';
					$data['form']=site_url('c_user/edit_akses');
					$data['tabel']=$this->login->menu_group2($id)->result();
					$data['id_group']=$id;
					$gr=$this->login->list_group2($id)->row();
					$data['nama']=$gr->group_;
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
		else
		{
			redirect('login');
		}
	}
	function edit_akses()
	{
		$id_group=$this->input->post('id_group');
		$basic=array(base_url('c_user/akses/'.$id_group));
		if(secure($basic)==1)
		{
			$this->cek_login();	
			$dt=$this->login->menu_group2($id_group)->result();
			foreach($dt as $d)
			{
				//echo $d->id;
				if($this->input->post('c-'.$d->id)=='')
				{
					$c=0;
				}
				else
				{
					$c=1;
				}
				//echo $c;
				if($this->input->post('r-'.$d->id)=='')
				{
					$r=0;
				}
				else
				{
					$r=1;
				}
				//echo $r;
				if($this->input->post('u-'.$d->id)=='')
				{
					$u=0;
				}
				else
				{
					$u=1;
				}
				//echo $u;
				if($this->input->post('d-'.$d->id)=='')
				{
					$dl=0;
				}
				else
				{
					$dl=1;
				}
				//echo $dl;
				//echo '<br>';
				$id=array('id_group'=>$id_group,
					'id_menu'=>$d->id);
				$form=array('c'=>$c,'r'=>$r,'u'=>$u,'d'=>$dl);
				$this->master->edit_form2($id,$form,'akses_group');
			}
			redirect('c_user/akses/'.$id_group);
		}
		else
		{
			redirect('login');
		}
	}
	function dock()
	{
		$this->cek_login();	
		$data['default']['menu']=11;//ganti
		$a=$this->checkaut($data['default']['menu']);
		if(count($a)>0)
		{
			if($a->r==1)
			{
				$data['main_view']='m_dock';
				$data['form']=site_url('c_user/add_dock');
				$data['form2']=site_url('c_user/edit_dock2');
				
				$data['gudang']=$this->master->gudang_list()->result();
				$data['tabel']=$this->master->dock_akses()->result();
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
	function add_dock()
	{
		$basic=array(base_url('c_user/dock'));
		if(secure($basic)==1)
		{
			$this->cek_login();
			$data['default']['menu']=11;//ganti
			$a=$this->checkaut($data['default']['menu']);
			if($a->c==1)
			{
				$form = array(			
							'dock'		=> $this->input->post('dock'),
							'gudang'	=> $this->input->post('gudang'),
							'status'		=> 1,
							);
				$this->master->add_form($form,'dock');
				redirect($a->url);
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
	function edit_dock($id)//aktifasi dock
	{
		$basic=array(base_url('c_user/dock'));
		if(secure($basic)==1)
		{
			$this->cek_login();
			echo $id;
			$arr=explode('~',$id);
			$dock=$arr[0];
			$flag=$arr[1];
			$menu=$arr[2];
			
			 $a=$this->checkaut($menu);
			if($a->u==1)
			{
				$form=array(
					'status'		=>$flag);
				$id=array('id'=>$dock);
				$this->master->edit_form2($id,$form,'dock');
				redirect($a->url); 
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
	function edit_dock2()//aktifasi dock
	{
		$basic=array(base_url('c_user/dock'));
		if(secure($basic)==1)
		{
			$this->cek_login();
			$id=$this->input->post('id');
			$checker=$this->input->post('checker');
			$menu=11;
			 $a=$this->checkaut($menu);
			if($a->u==1)
			{
				$form=array(
					'checker'		=>$checker);
				$id=array('id'=>$id);
				$this->master->edit_form2($id,$form,'dock');
				redirect($a->url); 
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

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
