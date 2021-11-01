<?php
class Login_model extends CI_Model {
	/**
	 * Constructor
	 */
	function __construct() {
        parent::__construct();
	}
	
	// Inisialisasi nama tabel 
	
	
	
	

	
	
	
	function check_user2($username,$password)
	{
		$sql="select * from login_gdg
			where Username='$username' and Password='$password' ";
		$sql=$this->db->query($sql);
		if($sql->num_rows()>0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
			$this->session->set_flashdata('message', 'Maaf, account login anda diblokir');
		}
	}
	

	
	function get_akses2($username)
	{
			$sql="select * from login_gdg
			where Username='$username' ";
		return $this->db->query($sql);
	}
	
	function list_user(){
		$sql="select * from login_gdg a,USER_GROUP b
			where a.group_=b.id
				order by a.username";
		return $this->db->query($sql);
	}
	function list_group(){
		$sql="select * from USER_GROUP
			order by id";
		return $this->db->query($sql);
	}
	function list_group2($id){
		$sql="select * from USER_GROUP
			where id=$id";
		return $this->db->query($sql);
	}
	function menu_group($group)
	{
		$sql="
			select * from akses_group a, user_group b,list_menu c
			where a.id_group=b.id and a.id_menu=c.id
			 and a.id_group=$group and r=1";
		return $this->db->query($sql);
	}
	function menu_group2($idg)
	{
		
		$sql="
			 select * from akses_group a, list_menu b
			 where id_group=$idg and a.id_menu=b.id";
			 return $this->db->query($sql);
	}
	function menu_group3($group)
	{
		
		$sql="
			select * from akses_group a, user_group b,list_menu c
			where a.id_group=b.id and a.id_menu=c.id
			 and a.id_group=$group and r=1 and url!=''";
		return $this->db->query($sql);
	}
	public function checkaut($idm) {
        $idg=$this->session->userdata('group_gdg');
		$sql="
			 select * from akses_group a, list_menu b
			 where id_group=$idg and id_menu=$idm and r=1 and a.id_menu=b.id";
		return $this->db->query($sql);
    }
	
}
