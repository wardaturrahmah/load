<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Email extends CI_Controller {
	public $emailHost	="";//alamat email
	public $passHost 	="";//password
	public $smptHost 	="";//smtp
	public $smtpPort 	=465;
	function __construct() {
        parent::__construct();
		$this->load->model('master_model', 'master', TRUE);
		$this->load->model('login_model', 'login', TRUE);
		$this->load->model('Dashboard_model', 'dashboard', TRUE);
		$this->load->helper(array('url', 'form','jam_helper'));
	}	
	function index()
	{
		$this->kirim();	
	}
	function cek_login()
	{
		if(($this->session->userdata('login_gdg')!=TRUE) )
		{
			redirect('login/dashboard');
		}
	}
	
	function kirim(){
			$this->load->library('email');
			$config = array(
				'mailtype'	=>'html',
				'charset'	=>'utf-8',
				'protocol'	=>'smtp',
				'smtp_host'	=>$this->smptHost,
				'smtp_user'	=>$this->emailHost,
				'smtp_pass'	=>$this->passHost,
				'smtp_crypto'=>'ssl',
				'smtp_port'	=>$this->smtpPort,
				'crlf'		=>"\r<br/>",
				'newline'	=>"\r<br/>"
			);
			$this->email->initialize($config);
			$this->load->library('email', $config); // Load library email dan konfigurasinya
			$this->email->from($this->emailHost, "Resume Muat PT Siantar Top ");// Email dan nama pengirim
			$this->email->to(array('wardahamaliyah@gmail.com'));
			$pesan='<html>';
			$pesan.='<body>';
			$pesan.=date('Y-m-d H:i')."<br/><br/>";
			$gd=$this->master->gudang_list()->result();
			$area=$this->master->area()->result();
			$regis = $this->dashboard->regis();
			$nonregis = $this->dashboard->non_regis();
			$kopi = $this->dashboard->kopi()->result_array();
			$dock = $this->dashboard->dock_aktif();
			foreach($dock  as $doc)
			{
				$jum[$doc['locid']]=$doc['dock'];
			}
			foreach($gd as $g)
			{
				$d[$g->locid][1]=array();
				$d[$g->locid][2]=array();
			}
			foreach($regis as $r)
			{
				array_push($d[$r['locid']][$r['flag']],$r);
			}
			foreach($area as $a)
			{
				$d2[$a->id]=array();
			}
			foreach($nonregis as $nr)
			{
				array_push($d2[$nr['area']],$nr);
			}
			$kstapel=array();
			$ndo=array();
			$kdo=array();
			$kdoc=array();
			foreach($kopi as $k){
				if($k['NoDo'] == null){
					array_push($ndo,$k);
				}else{
					if($k['flag_muat']==0)
					{
						if($k['next_gd']>0)
						{
							array_push($kdoc,$k);
						}
						else
						{
							array_push($kdo,$k);
						}
						
					}
					else
					{
						array_push($kstapel,$k);
					}
					
				}
			}
			$pesan.= 'Kopi stapel '.count($kstapel)." kendaraan <br/>";
			$pesan.= 'Kopi belum ada DO '.count($ndo)." kendaraan <br/>";
			$pesan.= 'Kopi ada DO belum panggilan muat '.count($kdo).' kendaraan <br/>';
			$pesan.= 'Kopi ada DO sudah panggilan muat '.count($kdoc).' kendaraan <br/>';
			
			foreach($area as $a)
			{
				if($a->id!=1)
				{
					$pesan.= '<br/>Kendaraan pada area '.strtolower($a->area).' tidak daftar gudang : '.count($d2[$a->id]).' kendaraan <br/>';
					foreach($gd as $g)
					{
						if($g->id_area==$a->id)
						{
							$pesan.= 'Antrian '.$g->locid.' : '.count($d[$g->locid][1]).' kendaraan';
							$pesan.= "<br/>";
							$pesan.= 'Muat '.$g->locid.' : '.count($d[$g->locid][2]).' kendaraan';
							$pesan.= "<br/>";
						} 
					}
				}
			}
			$pesan.= "<br/>Gudang Over kendaraan : ";
			$c1=0;
			foreach($gd as $g)
			{
				if((2*$jum[$g->locid])<count($d[$g->locid][1])+count($d[$g->locid][2]))
				{
					$c1++;
					$pesan.= "<br/>";
					$pesan.= $g->locid.' : '.(count($d[$g->locid][1])+count($d[$g->locid][2])).' kendaraan / '.(2*$jum[$g->locid]).' kendaraan';
				}
			}
			if($c1==0)
			{
				$pesan.= " - <br/>";
			}
			else
			{
				$pesan.= "<br/>";
			}
			$c2=0;
			$pesan.= "<br/>Register melebihi 3 jam : ";
			foreach($gd as $g)
			{
				$f1=$d[$g->locid][1];
				foreach($f1 as $f1)
				{
					if(jam2($f1['datetime'])>'03:00')
					{
						$c2++;
						$pesan.= '<br/>'.$g->locid.' '.$f1['do_'].' '.jam2($f1['datetime']);
					}

				}
			}
			if($c2==0)
			{
				$pesan.= " - <br/>";
			}
			else
			{
				$pesan.= "<br/>";
			}
			$c3=0;
			$pesan.= "<br/>Cetak SJ melebihi 1.5 jam : ";
			foreach($area as $a)
			{
				if($a->id!=1)
				{
					foreach($d2[$a->id] as $sj)
					{
						if($sj['durasiSelesaiMuat'] != null)
						{
							if(jam2($sj['durasiSelesaiMuat'])>'01:30')
							{
								$x=$this->dashboard->dtl_non_regis($sj['nopol'])->row();
								if($x->gudang=='Cetak SJ')
								{
									$c3++;
									$pesan.= "<br/>";	
									$pesan.= $a->area.' '.$sj['nopol'].'-'.$sj['jk'].'-'.jam2($sj['durasiSelesaiMuat']);
								}
							}
							
							
						}
					}
				}
			}
			if($c3==0)
			{
				$pesan.= " - <br/>";
			}
			else
			{
				$pesan.= "<br/>";
			}
			$pesan.='</body>';
			$pesan.='</html>';
			$this->email->subject( "Resume Muat PT Siantar Top ".date('Y-m-d H:i'));

			// Isi email
			$this->email->message($pesan);

			// Kirim Email
			if ($this->email->send()) {
				echo 'sukses';
			} else {
				echo 'gagal';
			}
		}
}
