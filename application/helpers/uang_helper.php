<?php
	function uang($angka,$type=false){
		$uang = number_format($angka, 2, ',', '.');
		return ($type == false )?$uang:'Rp. '.$uang;
	}

	function nominal($angka,$type=false){
		$uang = number_format($angka, 0, ',', '.');
		return ($type == false )?$uang:'Rp. '.$uang;
	}
?>