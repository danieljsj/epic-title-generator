<?php
$path_to_image = require 'title-image-url.php';
// error_log('$path_to_image: '.$path_to_image);
header("Content-type: image/png");
readfile($path_to_image);
exit(0);