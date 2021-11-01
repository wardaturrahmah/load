<?php
class login extends CI_Controller{
	function __construct() 
	{
        parent::__construct();
		$this->load->model('Login_model', '', TRUE);
	}
	function index()
	{
		$this->login();
	}
	function consoleLog($msg) {
		echo '<script type="text/javascript">' .
          'console.log("'.$msg.'");</script>';
	}
	function login()
	{
		$data['form_action']	= site_url('login/login_process');
		$this->load->view('login', $data);
	}
	function login_process()
	{
		$basic=array(base_url(),base_url('login'));
		if(secure($basic)==1)
		{
			$username = $this->input->post('username');
			$password = md5($this->input->post('Password'));
			if ($this->Login_model->check_user2($username, $password) == TRUE)
			{
				$login= $this->Login_model->get_akses2($username)->row();
				$data = array('nama_gdg' => $username, 'login_gdg' => TRUE, 'group_gdg' => $login->Group_  );
				$this->session->set_userdata($data);
				$a=$this->Login_model->menu_group3($login->Group_)->row();
				if(count($a)>0)
				{
					redirect($a->url);
				}
				else
				{
					redirect('c_user/edit_form');
				}
				
				
			}
			else
			{
				redirect('login');
			}
		}
		else
		{
			redirect('login');
		}
	}
	function dashboard()
	{
		$data['form_action']	= site_url('login/login_dashboard');
		$this->load->view('login', $data);
	}
	function login_dashboard()
	{
		$basic=array(base_url('login/dashboard'));
		if(secure($basic)==1)
		{
			$username = $this->input->post('username');
			$password = md5($this->input->post('Password'));
			if ($this->Login_model->check_user2($username, $password) == TRUE)
			{
				$login= $this->Login_model->get_akses2($username)->row();
				$data = array('nama_gdg' => $username, 'login_gdg' => TRUE, 'group_gdg' => $login->Group_  );
				$this->session->set_userdata($data);
				redirect('antrian/antrido');
				
			}
			else
			{
				redirect('login/dashboard');
			}
		}
		else
		{
			redirect('login');
		}
	}
	
	function process_logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
}