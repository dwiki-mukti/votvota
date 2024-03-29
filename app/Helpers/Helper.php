<?php

use Carbon\Carbon;

function Token($length)
{
	$data = 'ABCDEFGHIJKLMNOPQRSTUFWXYZabcdefghijklmnopqrstuvwxyz1234567890';
	$string = '';
	for ($i=0; $i < $length; $i++) { 
		$pos = rand(0, strlen($data)-1);
		$string .= $data{$pos};
	}
	return $string;
}

function DateDetail($date)
{
	return Carbon::parse($date)->format('d-M-Y H:i');
}