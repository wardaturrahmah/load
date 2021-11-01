<?php
class email_model extends CI_Model {
	/**
	 * Constructor
	 */
	function __construct() {
        parent::__construct();
	}
	
	// Inisialisasi nama tabel 
	
	function do_gudang()
	{
		$sql="select * from antrian a
			join gudang b on a.gd=b.id
			where flag in (1,2)";
		return $this->db->query($sql);
	}
}