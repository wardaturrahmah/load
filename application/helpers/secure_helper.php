<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (!function_exists('secure')) {
function secure($basic) {
		$headers = array();
		foreach($_SERVER as $key => $value) {
			if (substr($key, 0, 5) <> 'HTTP_') {
				continue;
			}
			$header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
			$headers[$header] = $value;
		}
		$ref=0;
		foreach ($headers as $header => $value) {
			if($header=="Referer")
			{
				if(in_array(strtolower(rtrim($value,"/")),$basic))
				{
					$ref=1;
					//echo "bener";
				}
				else
				{
					$ref=-1;
					//echo "salah";
				}
			}
			
		}
		return $ref;
	}
	function getRequestHeaders() {
		$headers = array();
		foreach($_SERVER as $key => $value) {
			if (substr($key, 0, 5) <> 'HTTP_') {
				continue;
			}
			$header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
			$headers[$header] = $value;
		}
		return $headers;
	}
}
 ?>
