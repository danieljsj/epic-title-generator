<?php

if( !extension_loaded('gd') ) { error_log("ETG: YOU MUST LOAD THE php5-gd MODULE"); return; }

$path_to_image = require 'title-image-url.php';

header("Content-type: image/png");
readfile($path_to_image);
exit(0);