<?php

function getMinecraftSkin($UsuarioNombre) {
	$filename_def = base_url('img/recursos/steve.png');
	$filename = "http://s3.amazonaws.com/MinecraftSkins/".$UsuarioNombre.".png";

	$default_skin = imagecreatefrompng($filename_def);
	if(@GetImageSize($filename)){$user_skin = imagecreatefrompng($filename);}

	$temp = imagecreatetruecolor(64,32);
	imagealphablending($temp, false);
	imagesavealpha($temp, true);

	imagecopy($temp, $default_skin, 0, 0, 0, 0, 64, 32);
	if(@GetImageSize($filename)){imagecopy($temp, $user_skin, 0, 0, 0, 0, 64, 32);}

	header('Content-type: image/png');
	imagepng($temp);
	imagedestroy($temp);
}

function getMinecraftHead($UsuarioNombre,$NoCache){
	header("Content-type: image/png");
	$image_p = imagecreatetruecolor(300, 300);

	$gen = false;
	$avatar_image = "img/avatares/".$UsuarioNombre.".png";

	if(file_exists($avatar_image) && !$NoCache){
		if(@GetImageSize($avatar_image)){$image = imagecreatefrompng($avatar_image);}else{}
		imagecopyresampled($image_p, $image, 0, 0, 0, 0, 300, 300, 300, 300);
	}else{
		$gen = true;

		$filename_def = base_url('img/recursos/steve.png');
		$filename = "http://s3.amazonaws.com/MinecraftSkins/".$UsuarioNombre.".png";

		if(@GetImageSize($filename)){$image = imagecreatefrompng($filename);}else{$image_def = imagecreatefrompng($filename_def);}
		
		if(@GetImageSize($filename)){
			imagecopyresampled($image_p, $image, 0, 0, 8, 8, 300, 300, 8, 8);
			imagecopyresampled($image_p, $image, 0, 0, 40, 8, 300, 300, 8, 8);
		}else{
			imagecopyresampled($image_p, $image_def, 0, 0, 8, 8, 300, 300, 8, 8);
			imagecopyresampled($image_p, $image_def, 0, 0, 40, 8, 300, 300, 8, 8);
		}
	}

	if($gen){imagepng($image_p,$avatar_image);}
	
	imagepng($image_p);
	imagedestroy($image_p);
}

function renderBody($filename){
	$filename_def = base_url('img/recursos/steve.png');
	header("Content-type: image/png");

	// Load
	$rendered = imagecreatetruecolor(240, 480);
	if(@GetImageSize($filename)){$source = imagecreatefrompng($filename);}else{$source = imagecreatefrompng($filename_def);}
	$b = 120;
	$s = 8;

	// Fill the new image with pink and set pink as the transparent colour
	$pink = imagecolorallocate($rendered, 255, 0, 255);
	imagefilledrectangle($rendered, 0, 0, 240, 480, $pink);
	imagecolortransparent($rendered, $pink);
	
	$fsource = flip($source);

	imagecopyresampled($rendered, $source, $b / 2, 0, $s, $s, $b, $b, $s, $s);// Copy head
	imagecopyresampled($rendered, $source, $b / 2, 0, $s * 5, $s, $b, $b, $s, $s);// Copy the head accesory
	imagecopyresampled($rendered, $source, $b / 2, $b, $s * 2.5, $s * 2.5, $b, $b * 1.5, $s, $s * 1.5);// Copy the body
	imagecopyresampled($rendered, $source, $b * 1.5, $b, $s * 5.5, $s * 2.5, $b / 2, $b * 1.5, $s / 2, $s * 1.5);// Copy the left arm
	imagecopyresampled($rendered, $fsource, 0, $b, $s * 2, $s * 2.5, $b / 2, $b * 1.5, $s / 2, $s * 1.5);// Copy the right arm
	imagecopyresampled($rendered, $source, 60, $b * 2.5, $s / 2, $s * 2.5, $b / 2, $b * 1.5, $s / 2, $s * 1.5);// Copy the left leg
	imagecopyresampled($rendered, $fsource, $b * 1, $b * 2.5, $s * 7, $s * 2.5, $b / 2, $b * 1.5, $s / 2, $s * 1.5);// Copy the right leg

	return imagepng($rendered);
}

function renderBodyBack($filename){
	$filename_def = base_url('img/recursos/steve.png');
	header("Content-type: image/png");

	// Load
	$rendered = imagecreatetruecolor(240, 480);
	if(@GetImageSize($filename)){$source = imagecreatefrompng($filename);}else{$source = imagecreatefrompng($filename_def);}
	$b = 120;
	$s = 8;

	// Fill the new image with pink and set pink as the transparent colour
	$pink = imagecolorallocate($rendered, 255, 0, 255);
	imagefilledrectangle($rendered, 0, 0, 240, 480, $pink);
	imagecolortransparent($rendered, $pink);
	
	$fsource = flip($source);

	imagecopyresampled($rendered, $source, $b / 2, 0, $s * 3, $s, $b, $b, $s, $s); // Copy head
	imagecopyresampled($rendered, $source, $b / 2, 0, $s * 7, $s, $b, $b, $s, $s);// Copy the head accesory
	imagecopyresampled($rendered, $source, $b / 2, $b, $s * 4, $s * 2.5, $b, $b * 1.5, $s, $s * 1.5);// Copy the body
	imagecopyresampled($rendered, $source, $b * 1.5, $b, $s * 6.5, $s * 2.5, $b / 2, $b * 1.5, $s / 2, $s * 1.5);// Copy the left arm
	imagecopyresampled($rendered, $fsource, 0, $b, $s * 1, $s * 2.5, $b / 2, $b * 1.5, $s / 2, $s * 1.5);// Copy the right arm
	imagecopyresampled($rendered, $source, $b * 1, $b * 2.5, $s * 1.5, $s * 2.5, $b / 2, $b * 1.5, $s / 2, $s * 1.5);// Copy the left leg
	imagecopyresampled($rendered, $fsource, 60, $b * 2.5, $s * 6, $s * 2.5, $b / 2, $b * 1.5, $s / 2, $s * 1.5);// Copy the right leg

	return imagepng($rendered);
}


function flip(&$img){
	$size_x = imagesx($img);
	$size_y = imagesy($img);
	$temp = imagecreatetruecolor($size_x, $size_y);
	$x = imagecopyresampled($temp, $img, 0, 0, ($size_x-1), 0, $size_x, $size_y, 0-$size_x, $size_y);
	return $temp;
}

?>