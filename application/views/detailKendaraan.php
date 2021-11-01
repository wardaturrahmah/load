<?php if($kend != false or $kend != null):?>
<div class="container mt-3 mb-3 ml-3 mr-3 table-responsive">

<table class="table table-bordered table-striped">
	<tr>
		<td >NOPOL</td>
		
		<td ><?= $kend[0]['nopol']?></td>
	</tr>
	<tr>
		<td >SOPIR</td>
		
		<td ><?= $kend[0]['nama_sopir']?></td>
	</tr>
	<tr>
		<td >JENIS KENDARAAN</td>
		
		<td ><?= $kend[0]['jk']?></td>
	</tr>
	<tr>
		<td >NOMER DO</td>
		
		<td ><?= $do ?></td>
	</tr>
	<?php if($kend[0]['flag'] == '1'):?>
	<tr>
		<td>JAM REGISTER</td>
		
		<td><?= substr($kend[0]['datetime'], 11, 8)?></td>
	</tr>
	
	<tr>
		<td>WAKTU TUNGGU REGISTER</td>
		
		<td><?= jam2($kend[0]['datetime']) ?></td>
	</tr>
	<?php else:?>
	<tr>
		<td>JAM REGISTER</td>
		
		<td><?= substr($kend[0]['datetime'], 11, 8)?></td>
	</tr>
	
	<tr>
		<td>JAM MUAT</td>
		
		<td><?= substr($kend[0]['jam_muat'], 11, 8)?></td>
	</tr>
	<tr>
		<td>WAKTU TUNGGU REGISTER KE MUAT</td>
		
		<td><?= selisihJam($kend[0]['jam_muat'],$kend[0]['datetime']) ?></td>
	</tr>
	
	<tr>
		<td>DURASI MUAT</td>
		
		<td><?= jam2($kend[0]['jam_muat']) ?></td>
	</tr>
	<?php endif;?>
</table>

<br><br>


<table class="table table-bordered table-striped">
<thead>
	<tr>
		<th>No</th>
		<th>Deskripsi</th>
		<th>Qty</th>
		<th>Satuan</th>
		<th>Location id</th>
		<th>Cek</th>
	</tr>
</thead>
<tbody>
<?php $no=1;foreach($list as $x):?>
<tr>
<td width="10%"><?= $no++ ?></td>
<td width="50%"><?= $x['Description']; ?></td>
<td width="20%"><?= round($x['QtyDO'],0); ?></td>
<td width="10%"><?= $x['UnitID']; ?></td>
<td width="10%"><?= $x['LocationID']; ?></td>
<td width="10%"><?= $x['id_muat']==null ? '' : ' &#10004'; ?></td>
</tr>
<?php endforeach;?>
</tbody>
</table>
</div>
<?php else:?>
<h1>Mohon Refresh Browser, Posisi Kendaran berubah</h1>
<?php endif;?>