<div class="container mt-3 mb-3 ml-3 mr-3 table-responsive">
<table class="table table-bordered table-striped">
<thead>
	<tr>
		<th>No</th>
		<th>Deskripsi</th>
		<th>Qty</th>
		<th>Satuan</th>
		<th>Location id</th>
		<th>CEK</th>
	</tr>
</thead>
<tbody>
<?php $no=1;foreach($list as $x):?>
<tr>
<td width="10%"><?= $no++ ?></td>
<td width="50%"><?= $x['Description']; ?></td>
<td width="10%"><?= round($x['QtyDO'],0); ?></td>
<td width="10%"><?= $x['UnitID']; ?></td>
<td width="10%"><?= $x['LocationID']; ?></td>
<td width="10%"><?= $x['id_muat']==null ? '' : ' &#10004'; ?></td>
</tr>
<?php endforeach;?>
</tbody>
</table>
</div>