<?php
class Master_model extends CI_Model {
	/**
	 * Constructor
	 */
	function __construct() {
        parent::__construct();
	}
	
	// Inisialisasi nama tabel 
	
	
	function add_form($form,$table)
	{
		$this->db->insert($table, $form);
	}
	function edit_form($id,$waktu_jeda,$table)
	{
		$this->db->where('id', $id);
		$this->db->update($table, $waktu_jeda);
	}
	function edit_form2($id,$waktu_jeda,$table)
	{
		$this->db->where($id);
		$this->db->update($table, $waktu_jeda);
	}
	function delete_form($id,$table)
	{
		$this->db->delete($table, array('id' => $id));
	}
	function delete_form2($key,$table)
	{
		$this->db->delete($table, $key);
	}
	function maksid($tabel)
	{
			$sql="SELECT max(id) as id from $tabel";
		return $this->db->query($sql);
	}
	function antrian()
	{
			$sql="SELECT * from antrian ";
		return $this->db->query($sql);
	}
	function antrian_by_id($id)
	{
			$sql="SELECT * from antrian where id=$id";
		return $this->db->query($sql);
	}
	function antrian_now($gd)
	{
			$sql="
			SELECT top 1 * from antrian 
			where cast(datetime as date)=CAST(getdate() as date) and gd=$gd
			order by antrian desc";
		return $this->db->query($sql);
	}
	function gudang_user()
	{
		$nama=$this->session->userdata('nama_gdg');
		$sql="			
			select *
			from gudang_akses b, gudang c
			where b.id_user='$nama' and c.id=b.id_gd
		";
		return $this->db->query($sql);
	}
	function no_antrian($gd)
	{
			$sql="
			SELECT max(antrian) as antrian from antrian 
			where cast(datetime as date)=CAST(getdate() as date) and gd=$gd";
		return $this->db->query($sql);
	}
	function list_antrian()
	{
		$nama=$this->session->userdata('nama_gdg');
		$sql="			
			select a.*,c.gudang,c.kode,c.locid
			from antrian a, gudang_akses b, gudang c
			where flag=1 and a.gd=b.id_gd and b.id_user='$nama' and c.id=b.id_gd
		";
		return $this->db->query($sql);
	}
	function muat_by_id($id)
	{
			$sql="SELECT * from muat where id=$id";
		return $this->db->query($sql);
	}
	function muat_by_antrian($id_antrian)
	{
		$sql="
			SELECT * from muat 
			where id_antrian=$id_antrian
			";
		return $this->db->query($sql);
	}
	function muat_now_gdg($gdg)
	{
		$sql="
			select *,a.id  as id_muat from muat a, antrian b
			 where a.id_antrian=b.id and cast(jam_muat as date)=cast(getdate() as date)
			 and gd=$gdg
			";
		return $this->db->query($sql);
	}
	function antrian_now_gdg($gdg)
	{
		$sql="
			select * from antrian 
			 where cast(datetime as date)=cast(getdate() as date)
			 and gd=$gdg
			";
		return $this->db->query($sql);
	}
	function antrian_nomer_gdg($gdg,$no)
	{
		$sql="
			select * from antrian 
			 where cast(datetime as date)=cast(getdate() as date)
			 and gd=$gdg and antrian=$no
			";
		return $this->db->query($sql);
	}
	function gudang_list()
	{
		$sql="
			select * from gudang
			
			";
		return $this->db->query($sql);
	}
	function dock_list()
	{
		$sql="
			select *,a.id as id_dock from dock a, gudang b
			where a.gudang=b.id
			
			";
		return $this->db->query($sql);
	}
	function dock_id($id)
	{
		$sql="
			select *,a.id as id_dock from dock a, gudang b
			where a.gudang=b.id and a.id=$id
			
			";
		return $this->db->query($sql);
	}
	function dock_akses()
	{
		$nama=$this->session->userdata('nama_gdg');
		$sql="
			select *,a.id as id_dock from dock a, gudang b,gudang_akses c
			where a.gudang=b.id and b.id=c.id_gd and id_user='$nama'";
			return $this->db->query($sql);
	}
	function gudang($gdg)
	{
		$sql="
			select * from gudang where id=$gdg
			";
		return $this->db->query($sql);
	}
	function antrian_sisa($gdg)
	{
		$sql="
			
			select a.* from antrian a
			left join muat b on a.id=b.id_antrian
			where jam_muat is null --and  cast(datetime as date)=cast(getdate() as date)
			 and gd=$gdg and flag=1
			 order by a.datetime
			";
		return $this->db->query($sql);
	}
	function proses_muat($gdg)
	{
		$sql="
			
			 select a.*,b.*,a.id as id_muat ,c.dock 
			 from muat a, antrian b,dock c
			 where a.id_antrian=b.id and a.dock=c.id
			--and cast(a.jam_muat as date)=cast(getdate() as date)
			 and a.selesai_muat is null
			 and b.gd=$gdg
			 order by a.jam_muat
			";
		return $this->db->query($sql);
	}
	function list_muat()
	{
		$nama=$this->session->userdata('nama_gdg');
		$sql="
				select a.*,b.*,a.id as id_muat ,c.dock,e.kode
			 from muat a, antrian b,dock c,gudang_akses d,gudang e
			 where a.selesai_muat is null and
			 a.id_antrian=b.id and a.dock=c.id
             and d.id_user='$nama' and d.id_gd=b.gd 
            and d.id_gd=e.id
			 ";
			 return $this->db->query($sql);
	}
	function selesai_muat($gdg)
	{
		$sql="
			
			 select *,a.id as id_muat  from muat a, antrian b
			 where a.id_antrian=b.id and cast(a.selesai_muat as date)=cast(getdate() as date)
			 and a.selesai_muat is not null
			 and b.gd=$gdg
			 order by selesai_muat desc
			";
		return $this->db->query($sql);
	}
	function list_selesai()
	{
		$nama=$this->session->userdata('nama_gdg');
		/* $sql="
			select *,a.id as id_muat  from muat a, antrian b,gudang_akses d,gudang e
			 where a.id_antrian=b.id and cast(a.selesai_muat as date)=cast(getdate() as date)
			 and a.selesai_muat is not null
                and d.id_user='$nama' and d.id_gd=b.gd 
            and d.id_gd=e.id"; */
			$sql="select a.*,b.*,d.*,e.*,a.id as id_muat,f.locid as gd_next
				from muat a
				join antrian b on cast(a.selesai_muat as date)=cast(getdate() as date) and a.id_antrian=b.id 
				join gudang_akses d on d.id_user='$nama' and d.id_gd=b.gd 
				join gudang e on d.id_gd=e.id
				left join gudang f on a.next_gd=f.id
				where a.selesai_muat is not null";
			return $this->db->query($sql);
	}
	function dock_sisa($gdg)
	{
	$sql="
		select a.* from dock a
		left join muat b on a.id=b.dock and b.selesai_muat is null
		where a.gudang=$gdg and b.dock is null and a.status=1";
		return $this->db->query($sql);
	}
	function report_waktu_muat($gd,$tgl1,$tgl2)
	{
		$sql="select a.antrian,a.datetime as jam_antri,b.jam_muat,b.selesai_muat,b.do_,c.locid,d.dock
				from antrian a, muat b, gudang c,dock d
				where a.id=b.id_antrian and a.gd=$gd and c.id=a.gd
				and cast(a.datetime as date) between '$tgl1' and '$tgl2'
				and b.dock=d.id
				order by a.antrian";
		return $this->db->query($sql);
	}
	function cek_do($nodo,$gudang)
	{
		$this->orlan = $this->load->database('default2', TRUE);
		$sql="  
			select count(c.itemid) as item,sum(qtydo) as qty
			from PSDOHDR a, PSDODTL b, PSTransDtl c
			where nodo=$nodo and a.sysdo=b.sysdo and b.sys=c.sys 
			and b.lineno=c.lineno and c.locationid like '%$gudang%'			 
			";
		return $this->orlan->query($sql);
	}
	function get_type()
	{
		
		$sql="SELECT id,type,meterkubik,tonase
		from dba.STT_TYPE_Ekspedisi
		order by type
		";
		return $this->db->query($sql);
	}
	function area()
	{
		$sql="
			Select * from area
		";
		return $this->db->query($sql);
	}
	function get_antrian_area()
	{
		$nama=$this->session->userdata('nama_gdg');
		
		$sql="    

				Select a.*,c.area as nama_area,d.flag_muat,d.flag_stapel
					from trans_area a
					join area_akses b on b.id_user='$nama' and a.area=b.id_area
					join area c on a.area=c.id
					left join psdohdr d on (d.flag_muat=0 or d.flag_stapel=1) and a.nopol=d.nopol
					where jam_out is null
			";
		return $this->db->query($sql);
	}
	function get_antrian_area2($nopol)
	{
		$sql="
			Select * from trans_area a, area b
			where jam_out is null and nopol='$nopol' and a.area=b.id
		";
		return $this->db->query($sql);
	}
	function get_antrian_area3($area)
	{
		/* $sql="
			Select * from trans_area a
			where jam_out is null and area=$area
            
		"; */
		$sql="select * from trans_area a
			left join antrian b on a.id=b.id_trans_area and flag in (1,2)
			left join gudang c on b.gd=c.id
			where jam_out is null and area=$area
			order by c.locid
			";
		return $this->db->query($sql);
	}
	function allow_area()
	{
		$nama=$this->session->userdata('nama_gdg');
		$sql="
			select * from area_akses a, area b
			where id_user='$nama' and a.id_area=b.id
			order by id_area
		";
		return $this->db->query($sql);
	}
	function akses_area_user($user)
	{
		$sql="select * from area a
			left join area_akses b on a.id=b.id_area and b.id_user='$user'";
			return $this->db->query($sql);
	}
	function akses_gd($user)
	{
		$sql="
			select * from gudang a
			left join gudang_akses b on a.id=b.id_gd and b.id_user='$user'";
		return $this->db->query($sql);
	}
	function cek_antrian($do)
	{
		$sql="
				select * from antrian a, gudang b
				where do_='$do' and flag in (1,2) and a.gd=b.id";
		return $this->db->query($sql);
	}
	function cek_satpam($do,$gd)
	{
		/* $sql="select a.*,c.*,b.* from psdohdr a, trans_area b, gudang c
			where a.nodo=$do and b.jam_out is null and a.nopol=b.nopol
			and c.id=$gd
			and b.area=c.id_area"; */
		$sql="
			select a.*,b.nopol as nopol_satpam,c.id as id_gudang,b.id as id_trans_area
			from psdohdr a
			left join trans_area b on  b.jam_out is null and a.NoPol=b.nopol
			left join gudang c on c.id=$gd and b.area=c.id_area 
			where a.nodo=$do
		";
			return $this->db->query($sql);
	}
	function cek_gd($nopol,$area)
	{
		$sql="
			select * from gudang b,antrian c, psdohdr d
			where b.id_area=$area and c.flag in (1,2) and c.gd=b.id 
			and c.do_=d.nodo and d.nopol='$nopol'";
		return $this->db->query($sql);
	}
	function muat_all($tgl,$tgl2)
	{
		/* $sql="
			select do_,jam_muat,selesai_muat,c.locid,b.dock
			from muat a, dock b, gudang c
			where cast(jam_muat as date) between '$tgl' and '$tgl2'
			and  a.dock=b.id and b.gudang=c.id"; */
		$sql="select a.do_,datetime,jam_muat,selesai_muat,c.locid,b.dock,a.next_gd,d.locid as gd_next
			from muat a
			join dock b on a.dock=b.id 
			join gudang c on b.gudang=c.id
			join antrian e on a.id_antrian=e.id
			left join gudang d on a.next_gd=d.id
			where cast(jam_muat as date) between '$tgl' and '$tgl2'";
		return $this->db->query($sql);
	}
	function do_terambil($tgl,$tgl2)
	{
		$sql="select a.nodo,a.nopol,a.ekspedisi,substring(c.locationid,1,4) as locid,a.tgl_do2,a.jam_do2
			 from psdohdr a,psdodtl b,pstransdtl c
			where a.tgl_do2 between '$tgl' and '$tgl2'
			and a.sysdo=b.sysdo and b.sys=c.sys and b.lineno=c.lineno
			group by a.nodo,a.nopol,a.ekspedisi,c.locationid,a.tgl_do2,a.jam_do2";
			/* $sql="
				select a.nodo,a.nopol,a.ekspedisi,substring(c.locationid,1,4) as locid,a.tgl_do2,a.jam_do2
				from psdohdr a
				left join psdodtl b on a.sysdo=b.sysdo
				left join pstransdtl c on  b.sys=c.sys and b.lineno=c.lineno
				where a.tgl_do2 between '$tgl' and '$tgl2'
				group by a.nodo,a.nopol,a.ekspedisi,c.locationid,a.tgl_do2,a.jam_do2"; */
		return $this->db->query($sql);
	}
	function trans_area($tgl,$tgl2)
	{
		$sql="
			select * from trans_area a, area b
			where a.area=b.id and cast(jam_in as date)between '$tgl' and '$tgl2'";
			return $this->db->query($sql);
	}
	function sisa_muat($tgl,$tgl2)
	{
		$sql="select * from antrian_report ('$tgl','$tgl2')";
		return $this->db->query($sql);
	}
	function list_nopol_area($area)
	{
		$sql="select * from trans_area a 
				left join psdohdr b on a.nopol=b.nopol
				left join antrian c on b.nodo=c.do_ and flag in (1,2)
				left join gudang d on c.gd=d.id
				where a.area=$area and a.jam_out is null
				order by d.id desc
				";
		return $this->db->query($sql);
	}
	/* function ambil_do($nopol)
	{
		$sql="
			select * from psdohdr a
			left join intranshdr b on b.transcode = 3 and b.approved = 1 and a.nodo=b.numeric1
			where nopol='$nopol' and b.sys is null";
		return $this->db->query($sql);
	} */
	function cek_area_do($do,$area)
	{
		/* $sql="
			select * from trans_area a, psdohdr b
			where a.jam_out is null and a.area=$area and  a.nopol=b.nopol
			and b.nodo=$do"; */
			$sql="
			select * from  psdohdr b
			left join trans_area a on a.jam_out is null and a.area=$area and  a.nopol=b.nopol
			where b.nodo=$do";
			return $this->db->query($sql);
	}
	function cek_clearance($nopol)
	{
		$sql="
			select * from psdohdr 
			where flag_muat=0 and nopol='$nopol'
		";
		return $this->db->query($sql);
	}
	function cek_clearance2($do,$gd)
	{
		$sql="
			select * from psdohdr
			where flag_muat=0 and nodo=$do and next_gd=$gd
		";
		return $this->db->query($sql);
	}
	function cek_clearance3($nopol,$area)
	{
		$sql="
			select * from PSDOHDR a, gudang b
			where flag_muat=0 and nopol='$nopol' and b.id_area=$area
			and a.next_gd=b.id
		";
		return $this->db->query($sql);
	}
	function cek_clearance4($nopol)
	{
		$sql="
			select * from PSDOHDR a
			left join gudang b on a.next_gd=b.id
			where flag_muat=0 and nopol='$nopol' 
		";
		return $this->db->query($sql);
	}
	function master_nopol()
	{
		$sql="
			select * from master_nopol
		";
		return $this->db->query($sql);
	}
	function list_do_pending()
	{
		$sql="
				select nodo,nopol,gudang,jam_izin,next_gd from psdohdr a, gudang b
				where flag_muat=0 and a.next_gd=b.id";
		return $this->db->query($sql);
	}
	function do_id($do)
	{
		$sql="
				select * from psdohdr where nodo=$do";
		return $this->db->query($sql);
	}
	function tes_satpam($nopol,$gd)
	{
		$sql="
				select *,a.id as id_trans_area from trans_area a ,gudang b
				where nopol='$nopol' and jam_out is null 
				and b.id=$gd  and a.area=b.id_area ";
		return $this->db->query($sql);
	}
	function cek_bsc($nopol)
	{
		$sql="
				select top 1 * from psdohdr a, antrian b
				where a.flag_muat=1 and a.nopol='$nopol' and a.nodo=b.do_
				order by b.datetime desc";
		return $this->db->query($sql);
	}
	function report_next_tujuan()
	{
		$sql="select * from psdohdr a
				left join gudang b on a.next_gd=b.id
				where flag_muat=0 and tgl_do2 is not null";
		return $this->db->query($sql);
	}
	function report_jam_muat($tgl,$tgl2,$jam)
	{
		$sql="
			select c.gudang,b.dock,count(do_) as jum_do
			from muat a, dock b, gudang c
			where cast(a.jam_muat as date) between '$tgl' and '$tgl2'
			and $jam between hour(jam_muat) and hour(selesai_muat)
			and a.dock=b.id and b.gudang=c.id
			group by c.gudang,b.dock
		";
		return $this->db->query($sql);
	}
	function report_muat_qty($tgl,$tgl2)
	{
		$sql="
			select a.id,a.do_,c.gudang,b.dock,a.jam_muat,a.selesai_muat,DATEDIFF ( minute, a.jam_muat, a.selesai_muat ) as lama, sum(e.qtydo) as qty
			from muat a, dock b, gudang c, psdohdr d, psdodtl e
			where cast(a.jam_muat as date) between '$tgl' and '$tgl2'
			and a.dock=b.id and b.gudang=c.id and a.do_=d.nodo and d.sysdo=e.sysdo and e.id_muat=a.id
			group by a.id,c.gudang,b.dock,a.jam_muat,a.selesai_muat,a.do_
		";
		return $this->db->query($sql);
	}
	function dtl_muat($id_muat)
	{
		$sql="select * from psdodtl a, pstransdtl b
			where a.id_muat=$id_muat and a.sys=b.sys and a.lineno=b.lineno";
		return $this->db->query($sql);
	}
	function list_stapel()
	{
		$sql="select * from psdohdr a
				where flag_stapel=1";
		return $this->db->query($sql);
	}
	function dtl_do($do)
	{
		$sql = "select * from psdohdr a
			join psdodtl b on a.sysdo=b.sysdo 
			join pstransdtl c on b.sys=c.sys and b.lineno=c.lineno
			where a.nodo=$do
			order by c.locationid";
		return $this->db->query($sql);
		
	}
	function dtl_do_diambil($do)
	{
		$sql = "select * from psdohdr a
			join psdodtl b on a.sysdo=b.sysdo 
			join pstransdtl c on b.sys=c.sys and b.lineno=c.lineno
			where a.flag_muat=0 and a.nodo=$do
			order by c.locationid";
		return $this->db->query($sql);
		
	}
	function psdodtl($sys)
	{
		$sql = "select * from psdodtl
				where sysdo=$sys";
		return $this->db->query($sql);
	}
	function tujuan_do($sys)
	{
		$sql = "select b.city from pstranshdr a, arcustomer b
				where a.sys=$sys and a.custshipto=b.custid
				";
		return $this->db->query($sql);
	}
}
