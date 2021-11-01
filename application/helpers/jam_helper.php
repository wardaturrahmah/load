<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (!function_exists('jam')) {
 function jam($seconds){
	$t = round($seconds);
	return sprintf('%02d:%02d:%02d', ($t/3600),($t/60%60), $t%60);
 }
 function jam2($akhir)
 {
	$awal  = strtotime($akhir);
    $akhir = time(); // Waktu sekarang atau akhir

	$diff  = $akhir - $awal;

	$jam   = floor($diff / (60 * 60));

	$diff = $diff - $jam * (60 * 60);
	$menit=floor( $diff / 60 );
	
	return sprintf('%02d:%02d',$jam,$menit);
 }
 
  function selisihJam($akhir,$awal)
 {
	$awal  = strtotime($awal);
    $akhir = strtotime($akhir);
	$diff  = $akhir - $awal;
	
	//$diff  = date_diff($awal,$akhir);

	$jam   = floor($diff / (60 * 60));

	$diff = $diff - $jam * (60 * 60);
	$menit=floor( $diff / 60 );
	
	
	$diff = $diff - $menit * (60 * 60);
	$detik=floor( $diff / 60 );
	return sprintf('%02d:%02d',$jam,$menit);
	
 }
}
 ?>
