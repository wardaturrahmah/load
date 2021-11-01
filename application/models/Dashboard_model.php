<?php
class Dashboard_model extends CI_Model {
	/**
	 * Constructor
	 */
	function __construct() {
        parent::__construct();
	}
	
	// Inisialisasi nama tabel 
	
	function infoDO($nodo,$flag){
		$sql = "select * from psdohdr a
			join psdodtl b on a.sysdo=b.sysdo 
			join pstransdtl c on b.sys=c.sys and b.lineno=c.lineno
			where a.flag_muat=$flag and a.nodo=$nodo
			order by c.locationid";
		return $this->db->query($sql)->result_array();
	}
	
	function rumahDetail($id){
		$sql = "select * from area where id = $id";
		return $this->db->query($sql)->result_array();
	}
	function getRumah(){
		$sql = "select * from area";
		return $this->db->query($sql)->result();
	}
	
	function antrian($rumah){
		$sql = "select a.nopol as nopol, a.jenis_kendaraan as jk from trans_area a 
				left join psdohdr b on a.nopol=b.nopol
				left join antrian c on b.nodo=c.do_ and flag in (1,2)
				left join gudang d on c.gd=d.id
				where a.area= $rumah and a.jam_out is null";
		return $this->db->query($sql)->result_array();
	}
	
	function getGudangAndDock($idRumah){
		$sql = "select 
			a.gudang as gudang,a.id as idGudang, b.dock as dok, b.id as idDok, b.status as status
			 from gudang a
			left join dock b on b.gudang = a.id
			where b.status=1 and a.id_area = $idRumah";
		return $this->db->query($sql)->result();
	}
	function detailGudangNdock($gudang,$dock){
		$sql= "select * from gudang a, dock b
			where a.id = b.gudang
			and a.id = $gudang AND b.id = $dock";
		return $this->db->query($sql);
	}
	function getStatus($rumah,$gudang,$dok){
		$sql = "select * from muat a, dock b, gudang c, psdohdr d
		where a.selesai_muat is null and a.do_=d.nodo
		and a.dock=b.id and b.gudang=c.id 
		and c.id_area=$rumah AND c.id = $gudang AND b.id=$dok";
		//echo $sql;
		return $this->db->query($sql);
	}
	
	function kopi(){
		/*
		$sql = "select * from trans_area a
				left join area b on b.id = a.area
				where a.jam_out is NULL AND b.id = 1";
				*/
		/* $sql = "select * from trans_area a
				left join psdohdr b on a.nopol=b.nopol and flag_muat=0
				where jam_out is null and area=1"; */
		$sql="select *,a.ekspedisi as type_ex from trans_area a
			left join psdohdr b on a.nopol=b.nopol and (flag_muat=0 or flag_stapel=1)
			where jam_out is null and area=1
		";
		return $this->db->query($sql);
	}
	
	function jumlah($rumah){
		$sql = "select * from trans_area a
				left join area b on b.id = a.area
				where a.jam_out is NULL AND b.id = $rumah";
		return $this->db->query($sql);
	}
	
	function listOfAntrian($rumah){
		$sql = "select * from trans_area a
			left join antrian b on a.id=b.id_trans_area and flag in (1,2)
			left join gudang c on b.gd=c.id
			where jam_out is null and a.area is not null and a.area = $rumah
            order BY a.area ASC ";
		return $this->db->query($sql);
	}
	
	/*
	function cekDoKopi($nopol) {
		$sql = "select 
			a.JenisKendaraan as jk, a.NoPol as nopol, a.nama_sopir as sopir, a.NoDo as do_
			 from psdohdr a
			left join intranshdr b on b.transcode = 3 and b.approved = 1 and a.nodo=b.numeric1
			where nopol='$nopol' and b.sys is null";
		return $this->db->query($sql)->result_array();
	}
	*/
	
	function infoNopol($nopol,$flag){
		$sql= "select *, a.jenis_kendaraan as jk
				 from trans_area a
				join antrian b on a.id=b.id_trans_area and flag in (1,2,3)
				join gudang c on b.gd=c.id
                 left join muat d on b.id=d.id_antrian
				where a.jam_out is null 
    and a.nopol='$nopol' and flag = '$flag'";
	return $this->db->query($sql)->result_array();
	}
	
	function getAntrian($rumah){
		$sql  = "select a.nopol as nopol, a.jenis_kendaraan as jk, a.nama_sopir as sopir, b.do_ , c.locid from trans_area a
			left join antrian b on a.id=b.id_trans_area and flag in (1,2)
			left join gudang c on b.gd=c.id
			where jam_out is null and area=$rumah 
			order by c.locid ASC";
		return $this->db->query($sql)->result_array();
	}
	
	function antriBos(){
		$sql  = "select 
				datediff(second,d.selesai_muat,DATEADD(second,60,GETDATE())) as durasiSelesaiMuat, 
				datediff(second,a.jam_in,DATEADD(second,60,GETDATE())) as jam_satpam,
				b.flag as flag,a.area as area, c.locid as locid, a.nopol as nopol, a.jenis_kendaraan as jk, a.nama_sopir as sopir, b.do_ , c.locid from trans_area a
				left join antrian b on a.id=b.id_trans_area and flag in (1,2)
				left join gudang c on b.gd=c.id
				 LEFT join muat d on b.antrian = d.id
			where jam_out is null and a.nopol is not null and a.area != 1 order by a.area ASC";
		return $this->db->query($sql)->result_array();
	}
	function regis()
	{
		$sql="
				select *, a.jenis_kendaraan as jk
				 from trans_area a
				join antrian b on a.id=b.id_trans_area and flag in (1,2)
				join gudang c on b.gd=c.id
				
				where a.jam_out is null
		";
		return $this->db->query($sql)->result_array();
	}
	function non_regis()
	{
		$sql="		
			select a.area,a.id,a.nopol,a.jenis_kendaraan as jk,max(jam_in) as jam_satpam, max(selesai_muat) as durasiSelesaiMuat
			from trans_area a
			left join antrian b on a.id=b.id_trans_area and flag in (1,2)
			left join psdohdr c on a.nopol=c.nopol
			left join muat d on c.nodo=d.do_ and d.selesai_muat>a.jam_in
			where a.jam_out is null and a.area!=1 and b.id is null
			group by a.area,a.id,a.nopol,a.jenis_kendaraan
		";
		return $this->db->query($sql)->result_array();
	}
	function dock_aktif()
	{
		$sql="
			select locid,count(dock) as dock
			from dock a, gudang b
			where a.gudang=b.id and a.status=1
			group by locid";
		return $this->db->query($sql)->result_array();
	}
	function dtl_non_regis($nopol)
	{
		$sql="
			
			select top 1 case when a.next_gd = 0 then 'Kopi' else case when a.next_gd=-1 then 'Cetak SJ' else b.locid end end as gudang,a.nodo,a.flag_muat
			from psdohdr a
			left join gudang b on a.next_gd=b.id
			where nopol='$nopol'
			order by jam_izin desc
		";
		return $this->db->query($sql);
	}
}
