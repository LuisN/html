<?php
	$_filename=empty($_GET['file']) ? "data/Aria_The_Scarlet_Ammo.jpg" : "data/".$_GET['file'].".".$_GET['ext'];
	$size=(!empty($_GET['w']) || !empty($_GET['h'])) ? array($_GET['w'],$_GET['h']) : array(200,172);
	$img_data=getimagesize($_filename);
	$img=imagecreatetruecolor($size[0],$size[1]);
	switch($img_data['mime']){
		case 'image/png':
			$imagecreate="imagecreatefrompng";
			break;
		case 'image/jpeg':
		case 'image/jpg':
			$imagecreate="imagecreatefromjpeg";
			break;
	}
	$base=$imagecreate($_filename);
	imagecopyresampled($img,$base,0,0,0,0,$size[0],$size[1],$img_data[0],$img_data[1]);
	header("Content-Type: image/png");
	imagepng($img);
	imagedestroy($img);
	imagedestroy($base);
?>