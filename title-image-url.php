<?php 


class TitleImage {

	const FONT_FILENAME = "fonts/MedievalSharp-Bold.ttf";

	private static $layouts = array(
		"facebook" => array(

			// IMAGE:		
			"titleImageWidth" => 1200,
			"titleImageHeight" => 628,
			"bkgImgPath" => "media/title-image-bkg-fb.png",
			"imgFolderSlug" => "-",
			"imgQuality" => 9, // imagejpeg quality can be up to 100, whereas imagepng maximum quality is 9ls 

			// TEXT BASICS:
			"textColor" => array("r" => 54,	"g" => 56, "b" => 60),
			"textShadowColor" => array("r" => 54,	"g" => 56, "b" => 60, "a" => 93), // "a" / "alpha" is A value between 0 and 127. 0
			"textShadowOffsetY" => 4,
			"textShadowOffsetX" => 4,


			// TEXT-SIZE-DEPENDENT:

			// "fontSize" => 40,
			// "textMaxColumns" => 30,
			// "lineHeight" => 60,
			// "textShiftY" => 10,
			
			"fontSize" => 60,
			"textMaxColumns" => 25,
			"lineHeight" => 85,
			"textShiftY" => 30,
		),
	);


	public function getImgSrc($titleStr, $layoutKey){

		$layout = json_decode(json_encode( self::$layouts[$layoutKey] ));
		
		$titleImageFilename = "title-images/".$layout->imgFolderSlug.'/'.self::toSlug($titleStr).".png";

		// DEBUG SWITCH "true ||"
		if ( true || !file_exists($titleImageFilename)) {
			$dirPath = "title-images/".$layout->imgFolderSlug.'/';
			if( !is_dir($dirPath) ){
				mkdir($dirPath); chmod($dirPath, 0777);
			}

			$newImg = imagecreatefrompng($layout->bkgImgPath);
			
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
	        $textShadowColor = imagecolorallocatealpha( $newImg, $layout->textShadowColor->r, $layout->textShadowColor->g, $layout->textShadowColor->b, $layout->textShadowColor->a );

	        for ($i=0; $i < count($lineTexts); $i++) { 

	        	// SHADOW
				imagettftext(

					 /* image */	$newImg, 				 
					 /* size */		$layout->fontSize, 	 
					 /* angle */	0, // angle	 

					 /* x */		$layout->textShadowOffsetX + self::get_left_x_for_centering_str_in_layout($lineTexts[$i], $layout), 			 
					 /* y */		$layout->textShadowOffsetY +$textTopY + ($i-0)*$layout->lineHeight, 	 
					 /* color */	$textShadowColor, 			 

					 /* fontfile */	self::FONT_FILENAME, 	 
		 			 /* text */		$lineTexts[$i]
				);


				// TEXT
				imagettftext(

					 /* image */	$newImg, 				 
					 /* size */		$layout->fontSize, 	 
					 /* angle */	0, // angle	 

					 /* x */		self::get_left_x_for_centering_str_in_layout($lineTexts[$i], $layout), 			 
					 /* y */		$textTopY + ($i-0)*$layout->lineHeight, 	 
					 /* color */    $textColor, 			 

					 /* fontfile */	self::FONT_FILENAME, 	 
		 			 /* text */		$lineTexts[$i]
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

if ( ! function_exists('_sp') ){
	function _sp($str){return str_replace('_', ' ', $str);}
}

$titleStr = _sp($_GET['epic_title']);
$layoutKey = ( isset($_GET['layout']) ? $_GET['layout'] : 'facebook' );

if ($titleStr) {
	$src = TitleImage::getImgSrc($titleStr, $layoutKey);
	// echo $src; // if this is output, then it breaks title-image.php.
} else {
	$src = "media/banner.png";
	// throw new Exception('Error Processing Request; no "epic_title" value was present in the requested url', 1); // was breaking homepage
}
return $src;