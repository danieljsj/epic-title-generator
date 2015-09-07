<pre><?php 

class TitleImage {

	private static $layouts = array(
		"facebook" => array(
			"titleImageWidth" => 1200,
			"titleImageHeight" => 628,
			"textTopY" => 200,
			"bkgImgPath" => "media/title-image-bkg-fb.png",
			"imgFolderSlug" => "-",
		),
	);


	public function createImage($titleStr, $layoutKey){

		$layout = self::$layouts[$layoutKey];
		
		$filename = "title-images/".$layout['imgFolderSlug'].'/'.self::toSlug($titleStr).".jpg";
		var_dump($filename);

		if (!file_exists($filename)) {

			$bkgImg = imagecreatefrompng($layout['bkgImgPath']);
			var_dump($bkgImg);

			// verify background image dimensions
			if ( ! imagesy($bkgImg) == $layout['titleImageHeight'] ) {
				error_log('$layout[\'titleImageHeight\']: '.$layout['titleImageHeight'].' imagesy($bkgImg): '.imagesy($bkgImg));
				throw new Exception("ERROR: Background image provided has incorrect height", 1);
			}
			if ( ! imagesx($bkgImg) == $layout['titleImageWidth'] ) {
				error_log('$layout[\'titleImageWidth\']: '.$layout['titleImageWidth'].' imagesx($bkgImg): '.imagesx($bkgImg));
				throw new Exception("ERROR: Background image provided has incorrect width", 1);
			}


			// coming soon:
			// $colors['grey'] = imagecolorallocate($im, 54, 56, 60);
			// $colors['green'] = imagecolorallocate($im, 55, 189, 102);

		}
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