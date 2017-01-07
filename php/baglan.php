<?php
/**
 * Created by PhpStorm.
 * User: Orhan Gazi
 * Date: 31.12.2016
 * Time: 00:11
 */

$baglan =  mysqli_connect("localhost","root","1299","hayvanimibuldular");
if($baglan)
{
	$veri_tabani = mysqli_select_db($baglan,"hayvanimibuldular");
	if($veri_tabani)
	{
		mysqli_query($baglan,"SET NAMES UTF8");
		mysqli_query($baglan,"SET LC_TIME_NAMES = 'tr_TR'");
		session_start();
		ob_start();
	}
	else
	{
		echo "tabloya bağlanılamadı.";
	}
}
else
{
	echo "veri tabanına bağlanılamadı.";
}