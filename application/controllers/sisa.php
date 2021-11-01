<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class sisa extends CI_Controller {
	function __construct() {
        parent::__construct();
		$this->load->model('master_model', 'master', TRUE);
	}
	public function index()
	{
		for($i=1;$i<=5;$i++)
		{
			$sisa=$this->master->antrian_sisa($i)->num_rows();
			$data['sisa'][$i]=$sisa;
		
		}
		
		
		
		$this->load->view('sisa',$data);
	}
}
