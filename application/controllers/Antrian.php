<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Antrian extends CI_Controller {
	function __construct() {
        parent::__construct();
		$this->load->model('master_model', 'master', TRUE);
		$this->load->model('login_model', 'login', TRUE);
		$this->load->model('Dashboard_model', 'dashboard', TRUE);
		$this->load->helper(array('url', 'form','jam_helper'));
	}
	
	function current_url()
	{
		$url      = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		$validURL = str_replace("&", "&amp;", $url);
		return $validURL;
	}
	
	function index()
	{
		/* $this->load->library('user_agent');
       
        $browser      = $this->agent->browser();
        $versi_browser  = $this->agent->version();
        $os            = $this->agent->platform();
        $ip_address     = $this->input->ip_address();
		$page 			= $this->current_url();
		$x = "$page === $browser($versi_browser) - $os - $ip_address \n";
		$tanggal = "Log ".date('d-m-Y');
		if(!file_exists('./assets/'.$tanggal.'.txt')){
			fopen('./assets/'.$tanggal.'.txt', "w");
		}
			$fp = fopen('./assets/'.$tanggal.'.txt', "a");				
			fputs($fp, $x);	
			fclose($fp);
		$this->load->view('v_js'); */
		$this->antriDo();	
	}
	function cek_login()
	{
		if(($this->session->userdata('login_gdg')!=TRUE) )
		{
			redirect('login/dashboard');
		}
	}
	function antriDo(){
		/* $basic=array(base_url('login/dashboard'));
		if(secure($basic)==1)
		{ */
			$this->cek_login();
			/* $this->load->library('user_agent');
			$browser      = $this->agent->browser();
			$versi_browser  = $this->agent->version();
			$os            = $this->agent->platform();
			$ip_address     = $this->input->ip_address();
			$page 			= $this->current_url();
			$x = "$page === $browser($versi_browser) - $os - $ip_address \n";
			$tanggal = "Log ".date('d-m-Y');
			if(!file_exists('./assets/'.$tanggal.'.txt')){
				fopen('./assets/'.$tanggal.'.txt', "w");
			}
				$fp = fopen('./assets/'.$tanggal.'.txt', "a");				
				fputs($fp, $x);	
				fclose($fp);
			 */
			$data['start'] = new DateTime();
			$regis = $this->dashboard->regis();
			$nonregis = $this->dashboard->non_regis();
			$dock = $this->dashboard->dock_aktif();
			$kopiNoDO  = array();
			$kopiDO  = array();
			$kopiStapel  = array();
			$gjd = array();
			$gjc = array();
			$gjcc = array();
			$gjh3 = array();
			$GJBC = array();
			$GJJBN = array();
			$GJBCnull = array();
			$nullPusat = array();
			$nullGJJBN = array();
			foreach($dock as $d)
			{
				$jum[$d['locid']]=$d['dock'];
			}
			foreach($regis as $a){
			
					if($a['area'] == 2 and $a['locid'] == 'GJCC'){
						array_push($gjcc, $a);
					}elseif($a['area'] == 2 and $a['locid'] == 'GJDP'){
						array_push($gjd, $a);
					}elseif($a['area'] == 2 and $a['locid'] == 'GJH3'){
						array_push($gjh3, $a);
					}elseif($a['area']== 2  and $a['locid'] == 'GJST'){
						array_push($gjc, $a);
					}elseif($a['area']== 3 and $a['locid'] == 'GJBC'){
						array_push($GJBC, $a);
					}elseif($a['area']== 4 and $a['locid'] == 'GJJBN'){
						array_push($GJJBN, $a);
					}
				}
			foreach($nonregis as $b){
				if($b['area']== 2){
						array_push($nullPusat, $b);
					} 
				elseif($b['area']== 3){
					array_push($GJBCnull, $b);
				} 
				elseif($b['area']== 4){
					array_push($nullGJJBN, $b);
				} 
			}
			
			$kopi = $this->dashboard->kopi()->result_array();
			foreach($kopi as $k){
				if($k['NoDo'] == null){
					array_push($kopiNoDO,$k);
				}else{
					if($k['flag_muat']==0)
					{
						array_push($kopiDO,$k);
					}
					else
					{
						array_push($kopiStapel,$k);
					}
					
				}
			}
			$data['kopiNoDO'] = $kopiNoDO;
			$data['kopiDO']= $kopiDO;
			$data['kopiStapel']= $kopiStapel;
			$data['gjd']= $gjd ;
			$data['gjc']= $gjc;
			$data['gjcc']= $gjcc;
			$data['gjh3']= $gjh3;
			$data['GJBC']= $GJBC;
			$data['GJJBN']= $GJJBN;
			$data['GJBCnull']= $GJBCnull;
			$data['nullPusat']= $nullPusat;
			$data['nullGJJBN']= $nullGJJBN;
			$data['jum']= $jum;
			
			$max_pusat		= $this->dashboard->rumahDetail(2);
			$max_biskuit	= $this->dashboard->rumahDetail(3);
			$max_jabon		= $this->dashboard->rumahDetail(4);
			
			//flag flag
			$gjdf1 = 0;
			$gjdf2 = 0;
			foreach($gjd as $gjd){
				if($gjd['flag'] == 1){
					$gjdf1++;
				}elseif($gjd['flag'] == 2){
					$gjdf2++;
				}
			}
			//break
			$gjcf1 = 0;
			$gjcf2 = 0;
			foreach($gjc as $gjc){
				if($gjc['flag'] == 1){
					$gjcf1++;
				}elseif($gjc['flag'] == 2){
					$gjcf2++;
				}
			}
			//break
			$gjccf1 = 0;
			$gjccf2 = 0;
			foreach($gjcc as $gjcc){
				if($gjcc['flag'] == 1){
					$gjccf1++;
				}elseif($gjcc['flag'] == 2){
					$gjccf2++;
				}
			}
			//break
			$gjh3f1 = 0;
			$gjh3f2 = 0;
			foreach($gjh3 as $gjh3){
				if($gjh3['flag'] == 1){
					$gjh3f1++;
				}elseif($gjh3['flag'] == 2){
					$gjh3f2++;
				}
			}
			//break
			$GJBCf1 = 0;
			$GJBCf2 = 0;
			foreach($GJBC as $GJBC){
				if($GJBC['flag'] == 1){
					$GJBCf1++;
				}elseif($GJBC['flag'] == 2){
					$GJBCf2++;
				}
			}
			//break
			
			$GJJBNf1 = 0;
			$GJJBNf2 = 0;
			foreach($GJJBN as $GJJBN){
				if($GJJBN['flag'] == 1){
					$GJJBNf1++;
				}elseif($GJJBN['flag'] == 2){
					$GJJBNf2++;
				}
			};
			//break
			//end
			
			$data['max_pusat']		= $max_pusat[0]['max_cap'];	
			$data['max_biskuit']		= $max_biskuit[0]['max_cap'];
			$data['max_jabon']			= $max_jabon[0]['max_cap'];
			$data['gjdf1']				= $gjdf1;
			$data['gjdf2']				= $gjdf2;
			$data['gjcf1']				= $gjcf1;
			$data['gjcf2']				= $gjcf2;
			$data['gjccf1']				= $gjccf1;
			$data['gjccf2']				= $gjccf2;
			$data['gjh3f1']				= $gjh3f1;
			$data['gjh3f2']				= $gjh3f2;
			$data['GJBCf1']				= $GJBCf1;
			$data['GJBCf2']				= $GJBCf2;
			$data['GJJBNf1']				= $GJJBNf1;
			$data['GJJBNf2']				= $GJJBNf2;
			$data['end'] = new DateTime();
			$this->load->view('v_dKelompok',$data);
		/* }
		else
		{
			redirect('login/dashboard');
		} */
	}
	function infoNopol(){
		$this->cek_login();
		$basic=array(base_url('antrian/antrido'),base_url('dashboard2'));
		if(secure($basic)==1)
		{
			$nopol = $this->input->post('nopol');
			$flag = $this->input->post('flag');
			$nodo = $this->input->post('nodo');
			$data['kend']  = $this->dashboard->infoNopol($nopol,$flag);
			$data['list'] = $this->dashboard->infoDO($nodo,0);
			$data['do'] = $nodo;
			$this->load->view('detailkendaraan',$data);
		}
		else
		{
			redirect('login/dashboard');
		}
	}
	
	function infoDO(){
		$this->cek_login();
		$basic=array(base_url('antrian/antrido'),base_url('dashboard2'));
		if(secure($basic)==1)
		{
			$nodo = $this->input->post('nodo');
			$flag = $this->input->post('flag');
			$data['list'] = $this->dashboard->infoDO($nodo,$flag);
			$this->load->view('v_detailKopiDo',$data);
		}
		else
		{
			redirect('login/dashboard');
		}
	}
}
