<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function  printtgl($tgl)
{
	if($tgl != ''){
	$simbol = strpos($tgl,'-');
	if($simbol != ''){
		$tglcnv = explode('-',$tgl);
	} else {
		$tglcnv = explode('/',$tgl);
	}
	$arrNamaBulan = array("01"=>"Januari", "02"=>"Februari", "03"=>"Maret", "04"=>"April", "05"=>"Mei", "06"=>"Juni", "07"=>"Juli", "08"=>"Agustus", "09"=>"September", "10"=>"Oktober", "11"=>"November", "12"=>"Desember");
	$prin = $tglcnv[2] .' '. $arrNamaBulan[$tglcnv[1]].' '.$tglcnv[0];
	} else {
		$prin ='-';
	}
	return $prin;	
}

function rupiah($angka){
    $hasil_rupiah = number_format($angka,0,',','.');
    return $hasil_rupiah;
} 

?>