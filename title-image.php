<?php 

class TitleImage {

	// all dimensions in pixels
	const TITLE_IMAGE_WIDTH = 1200;
	const TITLE_IMAGE_HEIGHT = 628;

	const TEXT_TOP_Y = 200;



	public function createImage($str){
		
		$filename = "title-images/".self::toSlug($str).".jpg";
		
		if (!file_exists($filename)) {

			$bkgImg = imagecreatefrompng('media/title-image-bkg-fb.png');
			var_dump($bkgImg);

			// verify background image dimensions
			if ( ! self::TITLE_IMAGE_HEIGHT == imagesy($bkgImg) ) {
				error_log('self::TITLE_IMAGE_HEIGHT: '.self::TITLE_IMAGE_HEIGHT.' imagesy($bkgImg): '.imagesy($bkgImg));
				throw new Exception("ERROR: Background image provided has incorrect height", 1);
			}
			if ( ! self::TITLE_IMAGE_WIDTH == imagesx($bkgImg) ) {
				error_log('self::TITLE_IMAGE_WIDTH: '.self::TITLE_IMAGE_WIDTH.' imagesx($bkgImg): '.imagesx($bkgImg));
				throw new Exception("ERROR: Background image provided has incorrect height", 1);
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




$str = $_GET['epic_title'];

if ($str) {
	TitleImage::createImage($str);
} else {
	throw new Exception('Error Processing Request; no "epic_title" value was present in the requested url', 1);
}