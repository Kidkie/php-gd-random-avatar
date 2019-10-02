<?php
// --------------------------------------------
// Basic vars
// --------------------------------------------
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
$halfbgcolor = imagecolorallocate($image, rand(0,255), rand(0,255), rand(0,255));

// --------------------------------------------
// Rect that covers half canvas size
// --------------------------------------------
ImageFilledRectangle($image, 0, $ypos, $width, $height, $halfbgcolor);

// Diamond
function drawDiamond($x, $y, $width, $color) {
	// --------------------------------------------
    // Access the global image reference 
    // (the one outside this function)
    // --------------------------------------------
    global $image;
	
	// --------------------------------------------
    // Here we work out the four points of the diamond
    // --------------------------------------------
    $p1_x = $x;
    $p1_y = $y + ($width/2);
	
    $p2_x = $x + ($width/2);
    $p2_y = $y;
	
    $p3_x = $x + $width;
    $p3_y = $y + ($width/2);
	
    $p4_x = $x + ($width/2);
    $p4_y = $y + $width;
	
	// --------------------------------------------
    // Now create an array of points to store 
    // these four points
    // --------------------------------------------
    $points = array($p1_x, $p1_y, $p2_x, $p2_y, $p3_x, $p3_y, $p4_x, $p4_y);
	
	ImageFilledPolygon($image, $points, 4, $color);
}

// --------------------------------------------
// Random shape
// --------------------------------------------
$random_number = rand(1,5);

if($random_number == 1) {
	
	ImageFilledEllipse($image, $xpos, $ypos, $size, $size, $shapecolor);
	
} elseif($random_number == 2) {
	
	$xpos = $xpos - ($size/2);
	$ypos = $ypos - ($size/2);
	drawDiamond($xpos, $ypos, $size, $shapecolor);
	
} elseif($random_number == 3) {
	
	$xpos = $width/4;
	$ypos = $height/4;
	ImageFilledRectangle($image, $xpos, $ypos, $size, $size, $shapecolor);
	
} elseif($random_number == 4) {
	
	$points = array(
		0,  0,  // Point 1 (x, y)
		($width/2), ($height-100), // Point 2 (x, y)
		$width,  0,  // Point 3 (x, y)
	);
	ImageFilledPolygon($image, $points, 3, $shapecolor);
	
} else {
	
	$points = array(
		40,  ($height-70),  // Point 1 (x, y)
		($width-40), ($height-70), // Point 2 (x, y)
		($width/2), 70,  // Point 3 (x, y)
	);
	ImageFilledPolygon($image, $points, 3, $shapecolor);
	
}

// --------------------------------------------
// Output the picture
// --------------------------------------------
header("Content-type: image/jpg");

imagejpeg($image, NULL, 100);
