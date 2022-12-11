<?php
    include "Client.php";
?>

<!DOCTYPE html>
	<html>
	<head>
		<title></title>
	</head>
	<body>
		<a href="?page=home">Home</a> | <a href="?page=tambahobat">Tambah Data Obat</a> | <a href="?page=tambahpasien">Tambah Data Pasien</a> | <a href="?page=daftar-data">Data Server</a>
		<br/><br/>

		<fieldset>
			<?php if($_GET['page']=='tambahobat') { ?>
			<legend>Tambah Data Obat</legend>
				<form name="form" method="POST" action="proses.php">
					<input type="hidden" name="aksi" value="tambah"/>
					<label>ID Obat</label>
					<input type="text" name="id_obat"/>
					<br/>
					<label>Nama Obat</label>
					<input type="text" name="nama_obat"/>
					<br/>
					<label>Stok Obat</label>
					<input type="text" name="stok_obat"/>
					<br/>
					<label>Harga Obat</label>
					<input type="text" name="harga_obat"/>
					<br/>
					<button type="submit" name="simpan">Simpan</button>
				</form>

			<?php } elseif($_GET['page']=='tambahpasien') { ?>
			<legend>Tambah Data Pasien</legend>
				<form name="form" method="POST" action="proses.php">
					<input type="hidden" name="aksi" value="tambah"/>
					<label>ID Pasien</label>
					<input type="text" name="id_pasien"/>
					<br/>
					<label>ID Obat</label>
					<input type="text" name="id_obat"/>
					<br/>
					<label>Nama Pasien</label>
					<input type="text" name="nama_pasien"/>
					<br/>
					<button type="submit" name="simpan">Simpan</button>
				</form>

		<?php	} elseif ($_GET['page']=='ubahobat') {
			$r = $abc->tampil_obat($_GET['id_obat']);
		?>
		<legend>Ubah Data Obat</legend>
			<form name="form" method="POST" action="proses.php">
				<input type="hidden" name="aksi" value="ubah"/>
				<input type="hidden" name="id_obat" value="<?=$r->id_obat?>" />
				<label>ID Obat</label>
				<input type="text" value="<?=$r->id_obat?>" disabled>
				<br/>
				<label>Nama Obat</label>
				<input type="text" name="nama_obat" value="<?=$r->nama_obat?>">
				<br/>
				<label>Stok Obat</label>
				<input type="text" name="stok_obat" value="<?=$r->stok_obat?>">
				<br/>
				<label>Harga Obat</label>
				<input type="text" name="harga_obat" value="<?=$r->harga_obat?>">
				<br/>
				<button type="submit" name="ubahobat">Ubah</button>
			</form>

		<?php	} elseif ($_GET['page']=='ubahpasien') {
			$r = $abc->tampil_pasien($_GET['id_pasien']);
		?>
		<legend>Ubah Data Pasien</legend>
			<form name="form" method="POST" action="proses.php">
				<input type="hidden" name="aksi" value="ubah"/>
				<input type="hidden" name="id_pasien" value="<?=$r->id_pasien?>" />
				<label>ID Pasien</label>
				<input type="text" value="<?=$r->id_pasien?>" disabled>
				<br/>
				<label>ID Obat</label>
				<input type="text" name="id_obat" value="<?=$r->id_obat?>">
				<br/>
				<label>Nama Pasien</label>
				<input type="text" name="nama_pasien" value="<?=$r->nama_pasien?>">
				<br/>
				<button type="submit" name="ubahpasien">Ubah</button>
			</form>
			
		<?php unset($r);
			} else if ($_GET['page']=='tambahobat') {
		?>
		
		<legend>Daftar Data Obat</legend>
			<table border="1">
				<tr><th width='5%'>No</th>
					<th width='10%'>ID Obat</th>
					<th width='30%'>Nama Obat</th>
					<th width='15%'>Stok Obat</th>
					<th width='15%'>Harga Obat</th>
					<th width='20%' colspan="2">Aksi</th>
				</tr>
				<?php 	
					$no = 1;
					$data_array = $abc->tampil_obat();
					foreach ($data_array as $r) {
				?>	<tr><td><?=$no?></td>
						<td><?=$r->id_obat?></td>
						<td><?=$r->nama_pasien?></td>
						<td><?=$r->nama_obat?></td>
						<td><?=$r->harga_obat?></td>
						<td><a href="?page=ubahobat&id_obat=<?=$r->id_obat?>">Ubah</a></td>
						<td><a href="proses.php?aksi=hapusobat&id_obat=<?=$r->id_obat?>" onclick="return confirm('Apakah Anda ingin menghapus data ini?')">Hapus</a></td>
					</tr>
				<?php	$no++;
					}
					unset($data_array,$r,$no);
				?>
			</table>

		<?php unset($r);
			} else if ($_GET['page']=='tambahpasien') {
		?>
		
		<legend>Daftar Data Pasien</legend>
			<table border="1">
				<tr><th width='5%'>No</th>
					<th width='10%'>ID Pasien</th>
					<th width='30%'>ID Obat</th>
					<th width='15%'>Nama Pasien</th>
					<th width='20%' colspan="2">Aksi</th>
				</tr>
				<?php 	
					$no = 1;
					$data_array = $abc->tampil_pasien();
					foreach ($data_array as $r) {
				?>	<tr><td><?=$no?></td>
						<td><?=$r->id_pasien?></td>
						<td><?=$r->id_obat?></td>
						<td><?=$r->nama_pasien?></td>
						<td><a href="?page=ubahpasien&id_pasien=<?=$r->id_pasien?>">Ubah</a></td>
						<td><a href="proses.php?aksi=hapuspasien&id_pasien=<?=$r->id_pasien?>" onclick="return confirm('Apakah Anda ingin menghapus data ini?')">Hapus</a></td>
					</tr>
				<?php	$no++;
					}
					unset($data_array,$r,$no);
				?>
			</table>

		<?php unset($r);
			} else if ($_GET['page']=='daftar-data') {
		?>
		
		<legend>Daftar Data Server</legend>
			<table border="1">
				<tr><th width='5%'>No</th>
					<th width='10%'>ID Pasien</th>
					<th width='30%'>Nama Pasien</th>
					<th width='30%'>Nama Obat</th>
					<th width='15%'>Harga Obat</th>
					<th width='20%' colspan="2">Aksi</th>
				</tr>
				<?php 	
					$no = 1;
					$data_array = $abc->tampil_semua_data();
					foreach ($data_array as $r) {
				?>	<tr><td><?=$no?></td>
						<td><?=$r->id_pasien?></td>
						<td><?=$r->nama_pasien?></td>
						<td><?=$r->nama_obat?></td>
						<td><?=$r->harga_obat?></td>
						<td><a href="?page=ubah&id_pasien=<?=$r->id_pasien?>">Ubah</a></td>
						<td><a href="proses.php?aksi=hapus&id_pasien=<?=$r->id_pasien?>" onclick="return confirm('Apakah Anda ingin menghapus data ini?')">Hapus</a></td>
					</tr>
				<?php	$no++;
					}
					unset($data_array,$r,$no);
				?>
			</table>

		<?php } else { ?>
		<legend>Home</legend>
			Aplikasi sederhana ini menggunakan RESTful dengan format data JSON (JavaScript Object Notation).
		</fieldset>
		<?php } ?>
	</body>
</html>