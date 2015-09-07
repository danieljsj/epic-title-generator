<?php


// link to the font file no the server
$fontname = 'fonts/Capriola-Regular.ttf';
// controls the spacing between text
$i=30;
//JPG image quality 0-100
$quality = 85;

function create_image($text_blocks){

    global $fontname;
    global $quality;
    global $i; 

    $file = "covers/".md5($text_blocks[0]['name'].$text_blocks[1]['name'].$text_blocks[2]['name']).".jpg";

    // if the file already exists dont create it again just serve up the original
    if (!file_exists($file)) {

    // define the base image that we lay our text on
        $im = imagecreatefromjpeg("pass.jpg");

        // setup the text colours
        $color['grey'] = imagecolorallocate($im, 54, 56, 60);
        $color['green'] = imagecolorallocate($im, 55, 189, 102);

        // this defines the starting height for the text block
        $y = imagesy($im) - 365;

        // loop through the array and write the text
        foreach ($text_blocks as $text_block){
            // center the text in our image - returns the x value
            $x = center_text($text_block['name'], $text_block['font-size']);
            imagettftext(
                $im, 
                $text_block['font-size'], 
                0, 
                $x, 
                $y+$i, 
                $color[$text_block['color']], 
                $fontname,$text_block['name']
            );
            // add 32px to the line height for the next text block
            $i = $i+32;

        }
        // create the image
        imagejpeg($im, $file, $quality);

    }

    return $file;
}

function center_text($string, $font_size){
    global $fontname;
    $image_width = 800;
    $dimensions = imagettfbbox($font_size, 0, $fontname, $string);
    return ceil(($image_width - $dimensions[4]) / 2);
}

$text_blocks = array(

    array(
        'name'=> 'Ashley Ford',
        'font-size'=>'27',
        'color'=>'grey'),

    array(
        'name'=> 'Technical Director',
        'font-size'=>'16',
        'color'=>'grey'),

    array(
        'name'=> 'ashley@papermashup.com',
        'font-size'=>'13',
        'color'=>'green'
        )
    );

// run the script to create the image
$filename = create_image($text_blocks);

chmod($filename, 0666); // needs 0, must be octal