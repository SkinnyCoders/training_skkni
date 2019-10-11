<?php 

/**
 * Class for fungsi database.
 * 
 */
class fungsi_db
{
	
	/**
	 * Adds a data.
	 *
	 * @param      <string>  $nama    inputan nama
	 * @param      <string>  $gender  inputan jenis kelamin
	 * @param      <string>  $alamat  inputan alamat
	 * @param      <int>     $no_hp   inputan No hp
	 * @param      <string>  $email   inputan email
	 * @param      <string>  $hobi    inputan hobi
	 *
	 * @return     boolean   ( description_of_the_return_value )
	 */
	function add_data($nama, $gender, $alamat, $no_hp, $email, $hobi)
	{
		global $conn;
		$sqlCek = mysqli_query($conn, "SELECT email FROM peserta WHERE email = '$email'");

		if (mysqli_num_rows($sqlCek) > 0) {
			header('location: http://localhost/jwp_crud/tambah_peserta.php?message=Email sudah digunakan');
		}else{
			$insert = $conn->prepare("INSERT INTO `peserta`(`nama`, `gender`, `alamat`, `no_hp`, `email`) VALUES (?,?,?,?,?)");
			$insert->bind_param('sssss', $nama, $gender, $alamat, $no_hp, $email);
			if ($insert->execute()) {
				$id = mysqli_insert_id($conn);
				$insert->close();

				foreach ($hobi as $h) {
					$insertHobi = mysqli_query($conn, "INSERT INTO hobi (`id_peserta`, `hobi`) VALUES ($id, '$h')");
				}//end foreach
				return true;
			}else{
				return false;
			}
		}
	}
}

 ?>