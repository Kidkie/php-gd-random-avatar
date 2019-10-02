<?php

// Basic shapes in PHP GD
// http://www.alphadevx.com/a/56-Basic-Shapes-in-PHP-GD

$size = 300;

$width = 400;
$height = 400;

$xpos = $width / 2;
$ypos = $height / 2;

// --------------------------------------------
// Create a blank image
// --------------------------------------------
$image = imagecreatetruecolor($width, $height);

// --------------------------------------------
// Fill the background color
// --------------------------------------------
$background = imagecolorallocate($image, rand(0,255), rand(0,255), rand(0,255));
imagefill($image, 0, 0, $background);

// --------------------------------------------
// Ran color
// --------------------------------------------
$color = imagecolorallocate($image, rand(0,255), rand(0,255), rand(0,255));
$shapecolor = imagecolorallocate($image, rand(0,255), rand(0,255), rand(0,255));
$halfbfcolor = imagecolorallocate($image, rand(0,255), rand(0,255), rand(0,255));

// --------------------------------------------
// Rect
// --------------------------------------------
ImageFilledRectangle($image, 0, $ypos, $width, $height, $halfbfcolor);

// Diamond
function drawDiamond($x, $y, $width, $color) {
    // access the global image reference (the one outside this function)
    global $image;
 
    // here we work out the four points of the diamond
    $p1_x = $x;
    $p1_y = $y+($width/2);
 
    $p2_x = $x+($width/2);
    $p2_y = $y;
 
    $p3_x = $x+$width;
    $p3_y = $y+($width/2);
 
    $p4_x = $x+($width/2);
    $p4_y = $y+$width;
 
    // now create an array of points to store these four points
    $points = array($p1_x, $p1_y, $p2_x, $p2_y, $p3_x, $p3_y, $p4_x, $p4_y);
 
    // the number of vertices for our polygon (four as it is a diamond
    $num_of_points = 4;
	
	ImageFilledPolygon($image, $points, $num_of_points, $color);
}

// --------------------------------------------
// Random shape
// --------------------------------------------
$randomNum = rand(1,5);

if($randomNum == 1) {
	ImageFilledEllipse($image, $xpos, $ypos, $size, $size, $shapecolor);
} elseif($randomNum == 2) {
	$xpos = $xpos - $size / 2;
	$ypos = $ypos - $size / 2;
	drawDiamond($xpos, $ypos, $size, $shapecolor);
} elseif($randomNum == 3) {
	$xpos = $xpos - $size / 2;
	$ypos = $ypos - $size / 2;
	ImageFilledRectangle($image, ($width / 4), ($height / 4), $size, $size, $shapecolor);
} elseif($randomNum == 4) {
	$points = array(
		0,  0,  // Point 1 (x, y)
		($width/2), ($height-100), // Point 2 (x, y)
		$width,  0,  // Point 3 (x, y)
		240, 0,  // Point 4 (x, y)
	);
	ImageFilledPolygon($image, $points, 4, $shapecolor);
} else {
	$num_of_points = 4;
	$points = array(
		70,  ($height-70),  // Point 1 (x, y)
		($height/2), ($height-70), // Point 2 (x, y)
		($width-70), ($height-70),  // Point 3 (x, y)
		($width/2), 70,  // Point 4 (x, y)
	);
	ImageFilledPolygon($image, $points, $num_of_points, $shapecolor);
}

// --------------------------------------------
// Output the picture
// --------------------------------------------
header("Content-type: image/jpg");

imagejpeg($image, NULL, 100);
