<?php 
include_once 'connection.php';
include_once 'nilai.php';

$sqlGet = mysqli_query($conn, "SELECT GROUP_CONCAT(hobi.hobi) AS hobi, peserta.* FROM peserta INNER JOIN hobi ON hobi.id_peserta=peserta.id_peserta WHERE 1 GROUP BY peserta.nama ORDER BY peserta.nama ASC");
if (mysqli_num_rows($sqlGet) > 0) {
	while ($dataPeserta = mysqli_fetch_assoc($sqlGet)) {
		$data[] = $dataPeserta;
	}
}else{
	$data = [];
}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Data Peserta</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body style="background-color: #333">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card mt-5">
					<div style="background-color: #eee" class="card-header">
						<div class="header">
							<div class="row">
								<div class="col-md-8">
									<h3>Data peserta</h3>
									
								</div>
								<div class="col-md-4">
									<a class="btn btn-primary float-right" href="http://localhost/jwp_crud/tambah_peserta.php">Tambah Peserta</a>
								</div>
							</div>
							<?php if (isset($_GET['message'])) : ?>
										<div class="alert alert-danger mt-2" role="alert">
					  						<?=$_GET['message']?>
										</div>
									<?php endif ?>
						</div>
					</div>
					<div class="card-body">
						<table class="table table-striped">
							<tr>
								<th>No</th>
								<th>Nama</th>
								<th>Gender</th>
								<th>Hobi</th>
								<th>Alamat</th>
								<th>No HP</th>
								<th>Email</th>
								<th>Status</th>
								<th>Aksi</th>
							</tr>
							<?php
							if (!empty($data)) {
							
							$no =1; 
							foreach ($data as $p) {
								$hobi = explode(',', $p['hobi']);
								$id = $p['id_peserta'];
								$getNilai = mysqli_query($conn, "SELECT nilai FROM nilai WHERE id_peserta=$id");
								if (mysqli_num_rows($getNilai) > 0) {
									$dataNilai = mysqli_fetch_assoc($getNilai);
									$nilai = nilai($dataNilai['nilai'])."(".$dataNilai['nilai'].")";
								}else{
									$nilai = "belum input";
								}
							 ?>
							<tr>
								<td><?=$no++?></td>
								<td><?=ucwords($p['nama'])?></td>
								<td><?=$p['gender']?></td>
								<td><?php foreach($hobi AS $h){
									echo '*'.$h.'</br>';
								}?></td>
								<td><?=$p['alamat']?></td>
								<td><?=$p['no_hp']?></td>
								<td><?=$p['email']?></td>
								<td><b><i><?=$nilai?></i></b></td>
								<td><a class="btn btn-success" href="edit_peserta.php?id=<?=$p['id_peserta']?>">Edit</a> <a class="btn btn-warning" href="form_nilai.php?id=<?=$p['id_peserta']?>">Nilai</a> <a class="btn btn-danger" href="delete_peserta.php?id=<?=$p['id_peserta']?>" onclick=" return confirm('Yakin Delete?')">Hapus</a></td>
							</tr>
							<?php
							}
						}else{
							echo '<tr>
							<td colspan="9" class="text-center"><h3>Data Kosong bray</h3></td>
							</tr>';
						}
							 ?>
						</table>
					</div>
				</div>
			</div>		
		</div>
	</div>

</body>
</html>