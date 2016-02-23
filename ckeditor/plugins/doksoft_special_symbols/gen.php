<?php

require_once('gen.config.php');

function calculateTextBox($font_size, $font_angle, $font_file, $text) {
	$box   = imagettfbbox($font_size, $font_angle, $font_file, $text);
	if( !$box )
		return false;
	$min_x = min( array($box[0], $box[2], $box[4], $box[6]) );
	$max_x = max( array($box[0], $box[2], $box[4], $box[6]) );
	$min_y = min( array($box[1], $box[3], $box[5], $box[7]) );
	$max_y = max( array($box[1], $box[3], $box[5], $box[7]) );
	$width  = ( $max_x - $min_x );
	$height = ( $max_y - $min_y );
	$left   = abs( $min_x ) + $width;
	$top    = abs( $min_y ) + $height;
	// to calculate the exact bounding box i write the text in a large image
	$img     = @imagecreatetruecolor( $width << 2, $height << 2 );
	$white   =  imagecolorallocate( $img, 255, 255, 255 );
	$black   =  imagecolorallocate( $img, 0, 0, 0 );
	imagefilledrectangle($img, 0, 0, imagesx($img), imagesy($img), $black);
	// for sure the text is completely in the image!
	imagettftext( $img, $font_size,
	$font_angle, $left, $top,
	$white, $font_file, $text);
	// start scanning (0=> black => empty)
	$rleft  = $w4 = $width<<2;
	$rright = 0;
	$rbottom   = 0;
	$rtop = $h4 = $height<<2;
	for( $x = 0; $x < $w4; $x++ )
		for( $y = 0; $y < $h4; $y++ )
		if( imagecolorat( $img, $x, $y ) ){
		$rleft   = min( $rleft, $x );
		$rright  = max( $rright, $x );
		$rtop    = min( $rtop, $y );
		$rbottom = max( $rbottom, $y );
	}
	// destroy img and serve the result
	imagedestroy( $img );
	return array( "left"   => $left - $rleft,
			"top"    => $top  - $rtop,
			"width"  => $rright - $rleft + 1,
			"height" => $rbottom - $rtop + 1 );
}


if (!isset($_GET['code']))
	die("`code` parameter not set");

if (!isset($_GET['font']))
	die("`font` parameter not set");

if (!isset($_GET['size']))
	die("`size` parameter not set");

$code = intval($_GET['code']);
$size = intval($_GET['size']);
$font = $_GET['font'];

if ($code < 0 || $code > 65535)
	die('Incorrect `code` value');

if ($size < 1 || $size > $config['maxSize'])
	die('Incorrect `size` value');

if (!array_key_exists($font, $config['fonts']))
	die('Incorrect `font` value');
$fontFile = $config['fonts'][$font];

$text = html_entity_decode('&#' . $code . ';', ENT_COMPAT, 'UTF-8');
$dim = imagettfbbox($size, 0,  $fontFile, $text);

$dim = calculateTextBox($size, 0, $fontFile, $text);
$width = $dim['width'];
$height = $dim['height'];
$left = $dim['left'];
$top = $dim['top'];

$img = @imagecreatetruecolor($width, $height) or die("Cannot Initialize new GD image stream. Check GD library in installed on server and selected font for existence.");
imagesavealpha($img, true);
$trans_colour = imagecolorallocatealpha($img, 0, 0, 0, 127);
imagefill($img, 0, 0, $trans_colour);

$color = imagecolorallocate($img, $config['color_r'], $config['color_g'], $config['color_b']);

imagettftext($img, $size, 0, $left, $top, $color, $fontFile, $text);

header("Content-type: image/png");
imagepng($img);
imagedestroy($img);

?>