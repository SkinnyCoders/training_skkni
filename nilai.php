<?php 
/**
 * { function_description }
 *
 * @param      <int>      $angka  The angka
 *
 * @return     string  ( description_of_the_return_value )
 */
function nilai($angka){
	$standar_nilai = 70;
	$nilai_peserta = $angka;

	if ($nilai_peserta >= $standar_nilai) {
		$nilai = "LULUS";
	}else{
		$nilai = "TIDAK LULUS";
	}

	return $nilai;
}