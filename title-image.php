<pre><?php 

class TitleImage {

	const FONT_FILENAME = "fonts/MedievalSharp-Bold.ttf";

	private static $layouts = array(
		"facebook" => array(
			"titleImageWidth" => 1200,
			"titleImageHeight" => 628,
			"textShiftY" => 10,
			"textColor" => array("r" => 54,	"g" => 56, "b" => 60),
			"textMaxColumns" => 30,
			"fontSize" => 40,
			"lineHeight" => 60,
			"bkgImgPath" => "media/title-image-bkg-fb.png",
			"imgFolderSlug" => "-",
			"imgQuality" => 9, // imagejpeg quality can be up to 100, whereas imagepng maximum quality is 9ls 
		),
	);


	public function getImgSrc($titleStr, $layoutKey){

		$layout = json_decode(json_encode( self::$layouts[$layoutKey] ));
		
		$titleImageFilename = "title-images/".$layout->imgFolderSlug.'/'.self::toSlug($titleStr).".png";

		if (!file_exists($titleImageFilename)) {
			$dirPath = "title-images/".$layout->imgFolderSlug.'/';
			if( !is_dir($dirPath) ){
				mkdir($dirPath); chmod($dirPath, 0777);
			}

			$newImg = imagecreatefrompng($layout->bkgImgPath);
			var_dump($newImg);

			// verify background image dimensions
			if ( ! imagesy($newImg) == $layout->titleImageHeight ) {
				error_log('$layout->titleImageHeight: '.$layout->titleImageHeight.' imagesy($newImg): '.imagesy($newImg));
				throw new Exception("ERROR: Background image provided has incorrect height", 1);
			}
			if ( ! imagesx($newImg) == $layout->titleImageWidth ) {
				error_log('$layout->titleImageWidth: '.$layout->titleImageWidth.' imagesx($newImg): '.imagesx($newImg));
				throw new Exception("ERROR: Background image provided has incorrect width", 1);
			}

			// prep the dynamic parameters
	        
	        $lineTexts = explode('|', wordwrap($titleStr, $layout->textMaxColumns, '|'));

	        $textTopY = $layout->textShiftY + self::get_top_y_for_centering_linetexts_in_layout($lineTexts, $layout);

	        $textColor = imagecolorallocate( $newImg, $layout->textColor->r, $layout->textColor->g, $layout->textColor->b );

	        for ($i=0; $i < count($lineTexts); $i++) { 

		        // add (each) line of text to the image:

				imagettftext(

					 /* image */    $newImg, 				 

					 /* size */    $layout->fontSize, 	 

					 /* angle */    0, // angle	 

					 /* x */    self::get_left_x_for_centering_str_in_layout($lineTexts[$i], $layout), 			 

					 /* y */    $textTopY + ($i-0)*$layout->lineHeight, 	 

					 /* color */    $textColor, 			 

					 /* fontfile */    self::FONT_FILENAME, 	 

		 			 /* text */    $lineTexts[$i]
				);

	        }


			imagepng($newImg, $titleImageFilename, $layout->imgQuality);
			chmod($titleImageFilename, 0666);
		}

		return $titleImageFilename;
	}




	private function get_left_x_for_centering_str_in_layout($str, $layout){
	    $dimensions = imagettfbbox($layout->fontSize, 0, self::FONT_FILENAME, $str);
	    return ceil(($layout->titleImageWidth - $dimensions[4]) / 2); // mathematically the same as layoutWidth/2 - textWidth/2, but more performant
	}
	private function get_top_y_for_centering_linetexts_in_layout($lineTexts, $layout){
		$textBlockHeight = count($lineTexts) * $layout->lineHeight;
	    return ceil(($layout->titleImageHeight - $textBlockHeight) / 2); // mathematically the same as layoutHeight/2 - textsHeight/2, but more performant		
	}




	private function toSlug($str){
		setlocale(LC_ALL, 'en_US.UTF8');
		$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
		$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
		$clean = strtolower(trim($clean, '-'));
		$clean = preg_replace("/[\/_|+ -]+/", '-', $clean);
		return $clean;
	}
}






// RUNTIME:

$titleStr = $_GET['epic_title'];
$layoutKey = ( isset($_GET['layout']) ? $_GET['layout'] : 'facebook' );

if ($titleStr) {
	$src = TitleImage::getImgSrc($titleStr, $layoutKey);
	var_dump($src);
	echo "<img src='$src' />";
} else {
	throw new Exception('Error Processing Request; no "epic_title" value was present in the requested url', 1);
}