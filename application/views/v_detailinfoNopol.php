<div class="container">
	<div class="table-responsibe">
	<Table class="table-borderes table-stripped">
			<tr><td>Jenis Kendaraan</td><td>:</td><td><?= $list[0]['jenis_kendaraan'] ?></td></tr>
			<tr><td>Nopol</td><td>:</td><td><?= $list[0]['nopol'] ?></td></tr>
			<tr><td>Sopir</td><td>:</td><td><?= $list[0]['nama_sopir'] ?></td></tr>
		<?php if($flag == 1):?>
			<tr><td>Jam Register</td><td>:</td><td><?= substr($list[0]['datetime'],20,9) ?></td></tr>
			<?php else:?>
		<tr><td>Jam Muat</td><td>:</td><td><?= substr($list[0]['jam_muat'],20,9) ?></td></tr>
		<?php endif;?>
		<Table>
	</div>
</div>