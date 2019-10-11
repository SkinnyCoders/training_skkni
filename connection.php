<?php 

$conn = mysqli_connect('localhost', 'root', '', 'training_jwp');

if (mysqli_connect_errno()) {
	echo "Koneksi Gagal";
}