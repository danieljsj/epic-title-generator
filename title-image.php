<pre><?php 

class TitleImage {

	const FONT_FILENAME = "fonts/Capriola-Regular.ttf";

	private static $layouts = array(
		"facebook" => array(
			"titleImageWidth" => 1200,
			"titleImageHeight" => 628,
			"textTopY" => 200,
			"fontSize" => '20', // todo::try this not in quotes; would feel better...
			"bkgImgPath" => "media/title-image-bkg-fb.png",
			"imgFolderSlug" => "-",
			"textColor" => array("r" => 54,	"g" => 56, "b" => 60),
			),
		),
	);


	public function createImage($titleStr, $layoutKey){

		$layout = json_decode(json_encode( self::$layouts[$layoutKey] ));
		
		$filename = "title-images/".$layout->imgFolderSlug.'/'.self::toSlug($titleStr).".jpg";
		var_dump($filename);

		if (!file_exists($filename)) {

			$bkgImg = imagecreatefrompng($layout->bkgImgPath);
			var_dump($bkgImg);

			// verify background image dimensions
			if ( ! imagesy($bkgImg) == $layout->titleImageHeight ) {
				error_log('$layout->titleImageHeight: '.$layout->titleImageHeight.' imagesy($bkgImg): '.imagesy($bkgImg));
				throw new Exception("ERROR: Background image provided has incorrect height", 1);
			}
			if ( ! imagesx($bkgImg) == $layout->titleImageWidth ) {
				error_log('$layout->titleImageWidth: '.$layout->titleImageWidth.' imagesx($bkgImg): '.imagesx($bkgImg));
				throw new Exception("ERROR: Background image provided has incorrect width", 1);
			}

			// prep the dynamic parameters
			$textLeftX = get_x_to_center_str_in_layout($titleStr, $layout);
	        
	        $textColor = imagecolorallocate(
	        	$bkgImg,
	        	$layout->textColor->r,
	        	$layout->textColor->g,
	        	$layout->textColor->b
	        );

	        // build the image
			imagettftext(
				 $bkgImg, 				// image 
				 $layout->fontSize, 	// font-size 
				 0, 					// angle 
				 $textLeftX, 			// x 
				 $layout->textTopY, 	// y 
				 $textColor, 			// text color 
				 self::FONT_FILENAME, 	// font filename
	 			 $titleStr 				// text		
			);
		}
	}




	private function get_x_to_center_str_in_layout($str, $layout){
	    $dimensions = imagettfbbox($layout->fontSize, 0, self::FONT_FILENAME, $str);
	    return ceil(($layout->titleImageWidth - $dimensions[4]) / 2); // mathematically the same as layoutWidth/2 - imgWidth/2, but more performant
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




$titleStr = $_GET['epic_title'];
$layoutKey = ( isset($_GET['layout']) ? $_GET['layout'] : 'facebook' );

if ($titleStr) {
	TitleImage::createImage($titleStr, $layoutKey);
} else {
	throw new Exception('Error Processing Request; no "epic_title" value was present in the requested url', 1);
}